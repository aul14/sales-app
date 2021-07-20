<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (\Auth::user()->can('manage-module')) {
            if ($request->ajax()) {
                $data = Module::select()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return view('datatable-modal._action', [
                            'row_id' => $data->id,
                            'can_edit' => 'edit-module',
                            'can_delete' => 'delete-module'
                        ]);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('module.index');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('create-module')) {
            # code...
            $this->validate($request, [
                'name' => 'required|unique:modules,name'
            ]);

            Module::updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->name]
            );

            return response()->json(['success' => 'Module saved successfully']);
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::user()->can('edit-module')) {
            # code...

            $module = Module::find($id);
            return response()->json($module);
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->can('delete-module')) {
            # code...
            Module::find($id)->delete();
            return response()->json(['success' => 'Module deleted successfully']);
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
