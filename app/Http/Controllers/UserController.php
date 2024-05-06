<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function boot_account()
    {
        $user = auth()->user();
        $filter_info = json_decode(json_encode([
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'updated_at' => $user->updated_at,
            'avatar' => $user->avatar
        ]));
        return view('admin.setting.boot', compact('filter_info'));
    }


    public function boot_account_update(Request $request)
    {

        $user = auth()->user();
        $filter_info = json_decode(json_encode([
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'updated_at' => $user->updated_at,
            'avatar' => $user->avatar
        ]));

        if ($request->isMethod('POST')) {

            if (isset($request->password) || isset($request->password_new)) {

                $password = $request->only('password');
                if (!Auth::attempt(['email' => $filter_info->email, 'password' => $request->password])) {
                    return redirect()->route('devC-boot')->with('passwordError', 'Mật khẩu cũ không đúng');
                }

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $new_file_name = uniqid() . "_" . $file->getClientOriginalName();
                    $avatar = $file->move(public_path('assets/avatar'), $new_file_name);
                    $path_then = env("APP_SERVER") . "assets/avatar/" . $new_file_name;
                    $pos = strpos($filter_info->avatar, 'avatar/');
                    $localPath = substr($filter_info->avatar, $pos + strlen('avatar/'));
                    unlink(public_path('assets/avatar/' . $localPath));
                }

                $data = [
                    'avatar' => $path_then ?? $filter_info->avatar,
                    'username' => $request->username ?? $filter_info->username,
                    'name' => $request->name ?? $filter_info->name,
                    'password' => $request->password_new != "" ? Hash::make($request->password_new) : $filter_info->password,
                    'email' => $request->email ?? $filter_info->email,
                    'updated_at' => now()
                ];

                $updateAccount = User::where('id', $filter_info->id)->update($data);
                if ($updateAccount) {
                    return redirect()->route('devC-boot')->with('success', 'Cập nhật tài khoản thành công');
                }

            } else {

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    $new_file_name = uniqid() . "_" . $file->getClientOriginalName();
                    $avatar = $file->move(public_path('assets/avatar'), $new_file_name);
                    $path_then = env("APP_SERVER") . "assets/avatar/" . $new_file_name;
                    $pos = strpos($filter_info->avatar, 'avatar/');
                    $localPath = substr($filter_info->avatar, $pos + strlen('avatar/'));
                    unlink(public_path('assets/avatar/' . $localPath));
                }

                $data = [
                    'avatar' => $path_then ?? $filter_info->avatar,
                    'username' => $request->username ?? $filter_info->username,
                    'name' => $request->name ?? $filter_info->name,
                    'password' => $filter_info->password,
                    'email' => $request->email ?? $filter_info->email,
                    'updated_at' => now()
                ];
                $updateAccount = User::where('id', $filter_info->id)->update($data);

                if ($updateAccount) {
                    return redirect()->route('devC-boot')->with('success', 'Cập nhật tài khoản thành công');
                }
            }




        }
    }

    public function management_user()
    {
        $users = User::where('is_admin', '<>', 1)->orwhereNull('is_admin')->select('id', 'name', 'email', 'created_at')->get();
        return view('admin.setting.users', compact('users'));
    }


    public function DeleteAccount(Request $request)
    {

        $id_user = $request->id;

        if ($id_user > 0) {


            $model_has_roles_check = DB::table('model_has_roles')->where('model_id', $id_user)->exists();

            if ($model_has_roles_check) {
                $model_has_roles = DB::table('model_has_roles')->where('model_id', $id_user)->delete();
            }

            $model_has_permissions_check = DB::table('model_has_permissions')->where('model_id', $id_user)->exists();

            if ($model_has_permissions_check) {
                $model_has_permissions = DB::table('model_has_permissions')->where('model_id', $id_user)->delete();
            }

            $user = User::find($id_user);
            $user->delete();


            return response()->json(['message' => 'Delete Successfully'], 200);
        }
        return response()->json(['message' => 'Delete Fail'], 404);
    }
}
