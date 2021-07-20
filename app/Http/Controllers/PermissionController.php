<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\Module;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if (\Auth::user()->can('manage-permission')) {
            if ($request->ajax()) {
                $permission = Permission::with('module')->select();
                return DataTables::of($permission)
                    ->addColumn('action', function ($permission) {
                        return view('datatable-modal._no-delete', [
                            'model' => $permission,
                            'edit_url' => route('permission.edit', $permission->id),
                            'can_edit' => 'edit-permission',
                        ]);
                    })
                    ->make(true);
            }
            return view('permission.index');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        //
        if (\Auth::user()->can('create-permission')) {
            # code...
            return view('permission.create');
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        //

        if (\Auth::user()->can('create-permission')) {
            # code...
            $this->validate($request, [
                'module_id' => 'required',
            ]);



            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->module_id = $request->module_id;
            $permission->save();

            return redirect()->route('permission.index')->with('success', __('Permission successfully updated'));
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
        if (\Auth::user()->can('edit-permission')) {
            $permission = Permission::find($id);
            return view('permission.edit', compact('permission'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit-permission')) {
            # code...
            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required'
            ]);

            $permission = Permission::find($id);
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->module_id = $request->module_id;
            $permission->update();

            return redirect()->route('permission.index')->with('success', __('Permission successfully updated'));
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function attachPermission(Request $request, $role_id)
    {
        $role = Role::find($role_id);
        $role->attachPermission($request->permission);
    }

    public function detachPermission(Request $request, $role_id)
    {

        $role = Role::find($role_id);
        $role->detachPermission($request->permission);
    }
}
