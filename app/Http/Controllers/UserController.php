<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use App\RoleUser;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (\Auth::user()->can('manage-user')) {
            # code...
            if ($request->ajax()) {
                # code...
                $user = User::with('roles');
                return DataTables::of($user)
                    ->addColumn('action', function ($user) {
                        return view('datatable-modal.action-user', [
                            'model' => '$user',
                            'form_url' => route('user.destroy', $user->id),
                            'edit_url' => route('user.edit', $user->id),
                            'reset_url' => route('reset.password', $user->id),
                            'confirm_message' => 'Apakah anda yakin ?'
                        ]);
                    })
                    ->make(true);
            }
            return view('user.index');
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        //
        if (\Auth::user()->can('create-user')) {
            # code...
            return view('user.create');
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        //

        if (\Auth::user()->can('create-user')) {
            # code...
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confitmation' => 'min:6',
                'role_id' => 'required'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->alamat = $request->alamat;
            $user->gender = $request->gender;
            $user->password = bcrypt($request->password);
            $user->save();

            $role_user = new RoleUser();
            $role_user->user_id = $user->id;
            $role_user->role_id = $request->role_id;
            $role_user->user_type = 'App\User';
            $role_user->save();

            return redirect()->route('user.index')->with('success', __('User successfully created'));
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
        //
        if (\Auth::user()->can('edit-user')) {
            # code...
            $user = DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->select(
                    'users.id as id',
                    'users.name as name',
                    'users.email as email',
                    'users.gender as gender',
                    'users.no_hp',
                    'users.alamat',
                    'roles.name as role_name',
                    'roles.id as role_id'
                )
                ->where('users.id', $id)
                ->first();

            if ($user->role_name == 'User') {
                # code...
                return redirect()->route('user.index');
            } else {
                # code...
                return view('user.edit', compact('user'));
            }
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        //
        if (\Auth::user()->can('edit-user')) {
            # code...
            $this->validate($request, [
                'email' => 'required|unique:users,email,' . $id,
                'role_id' => 'required',
                'name' => 'required'
            ]);

            $user = User::find($id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->no_hp = $request->no_hp;
            $user->alamat = $request->alamat;
            $user->gender = $request->gender;
            $user->update();

            // $role_user = RoleUser::where('user_id', $id)->first();
            // $role_user->role_id = $request->role_id;
            // $role_user->update();
            DB::table('role_user')->where('user_id', '=', $id)
                ->update(['role_id' => $request->role_id]);

            return redirect()->route('user.index')->with('success', __('User successfully updated'));
        } else {
            # code...
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function reset_password($id)
    {
        if (\Auth::user()->can('reset-password')) {
            # code...
            $user = DB::table('role_user')
                ->join('users', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->select('role_user.*', 'users.name', 'users.email', 'users.id', 'roles.display_name')
                ->where('users.id', '=', $id)
                ->first();
            return view('user.reset-password')->with(compact('user'));
        } else {
            # code...
        }
    }

    public function updatePass(Request $request, $id)
    {
        if (\Auth::user()->can('reset-password')) {
            # code...
            $this->validate($request, ['password' => 'required']);
            $password = bcrypt($request->password);
            DB::table('users')->where('id', '=', $id)->update(['password' => $password]);

            return redirect()->route('user.index')->with('success', __('Password successfully updated'));;
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function profile()
    {
        $userDetail = \Auth::user();

        return view('user.profile')->with('userDetail', $userDetail);
    }

    public function editprofile(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = User::findOrFail($userDetail['id']);
        $this->validate(
            $request,
            [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $userDetail['id'],
            ]
        );
        if ($request->hasFile('profile')) {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $dir        = storage_path('app/public/avatar/');
            $image_path = $dir . $userDetail['avatar'];

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $request->file('profile')->storeAs('public/avatar/', $fileNameToStore);
        }

        if (!empty($request->profile)) {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();

        return redirect()->route('home')->with(
            'success',
            'Profile successfully updated.'
        );
    }

    public function updatePassword(Request $request)
    {
        if (\Auth::user()) {
            if (Auth::Check()) {
                $request->validate(
                    [
                        'current_password' => 'required',
                        'new_password' => 'required|min:6',
                        'confirm_password' => 'required|same:new_password',
                    ]
                );
                $objUser          = Auth::user();
                $request_data     = $request->All();
                $current_password = $objUser->password;
                if (Hash::check($request_data['current_password'], $current_password)) {
                    $user_id            = Auth::User()->id;
                    $obj_user           = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['new_password']);;
                    $obj_user->save();

                    return redirect()->route('profile', $objUser->id)->with('success', __('Password successfully updated.'));
                } else {
                    return redirect()->route('profile', $objUser->id)->with('error', __('Please enter correct current password.'));
                }
            } else {
                return redirect()->route('profile', \Auth::user()->id)->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
