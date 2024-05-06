<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DecentralizationController extends Controller
{
    //

    public function IndexDecentralization()
    {
        $users_roles = User::with('roles')->whereHas('roles')->get();
        return view('admin.decentralization.index', compact('users_roles'));
    }

    // =========================================== Nhóm function cho Roles =========================================

    public function IndexRole()
    {
        $roles = Role::all();
        return view('admin.decentralization.roles.index', compact('roles'));
    }

    public function CreateRole()
    {
        $permissions = DB::table('permissions')->whereNot('name', 'admin')->select('id', 'name')->get();
        return view('admin.decentralization.roles.add', compact('permissions'));
    }

    public function CreateRoleStart(Request $request)
    {

        if ($request->isMethod('POST')) {

            $validated = $request->validate([
                'name' => ['required', 'unique:roles'],
                'permissions' => 'required'
            ], [
                'name.required' => 'Tên vai trò không được để trống',
                'name.unique' => 'Vai trò này đã tồn tại trong hệ thống',
                'permissions.required' => 'Vai trò trên chưa được chọn quyền'
            ]);

            $data = [
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'desc_role' => $request->desc_role ?? 'Chưa có mô tả'
            ];

            $createRole = Role::create($data);
            if ($createRole->id) {
                // Gán quyền cho vai trò vừa tạo
                $role = Role::find($createRole->id);
                $permissions = $request->permissions;
                // chuyển đổi các id value sang int để insert được vào trong table permissions
                $numericPermissionArray = [];
                foreach ($permissions as $permission) {
                    $numericPermissionArray[] = intval($permission);
                }
                $role->syncPermissions($numericPermissionArray);
                $role->save();
                return redirect()->route('role-add')->with('success', 'Thêm mới vai trò thành công');
            }
            return redirect()->route('role-add')->with('error', 'Thêm mới vai trò không thành công');

        }
    }

    public function UpdateRole(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $role = Role::find($id);
            $role_has_per = DB::table('role_has_permissions')
                ->where('role_id', $id)
                ->select('permission_id')
                ->get()
                ->pluck('permission_id')
                ->toArray();
            $permissions = DB::table('permissions')->whereNot('name', 'admin')->select('id', 'name')->get();
            return view('admin.decentralization.roles.update', compact('permissions', 'role', 'role_has_per'));
        }
        abort(404);

    }

    public function UpdateRoleStart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->id;
            $role = Role::find($id);

            $validated = $request->validate([
                'name' => ['required', Rule::unique('roles')->ignore($request->id)],
                'permissions' => 'required'
            ], [
                'name.required' => 'Tên vai trò không được để trống',
                'name.unique' => 'Vai trò này đã tồn tại trong hệ thống',
                'permissions.required' => 'Vai trò trên chưa được chọn quyền'
            ]);

            $data = [
                'name' => $request->name ?? $role->name,
                'guard_name' => $request->guard_name ?? $role->guard_name,
                'desc_role' => $request->desc_role ?? $role->desc_role,
                'updated_at' => now()
            ];

            $updateRole = Role::where('id', $id)->update($data);
            $permissions = $request->permissions;
            // chuyển đổi các id value sang int để insert được vào trong table permissions
            $numericPermissionArray = [];
            foreach ($permissions as $permission) {
                $numericPermissionArray[] = intval($permission);
            }
            $role->syncPermissions($numericPermissionArray);
            $users = User::role($role->name)->get();
            foreach ($users as $user) {
                $user->syncPermissions($numericPermissionArray);
            }

            $role->save();
            return redirect()->route('role-update', ['id' => $id])->with('success', 'Cập nhật vai trò thành công');
        }
    }

    public function DeleteRole(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $role = Role::find($id);

            // nhóm quyền của role trên

            $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->select('permission_id')->get()->pluck('permission_id')->toArray();
            $permissions_role_current_clean = array_unique($permissions);

            // Tìm nhóm users dựa vào role id

            // #1: Xem user còn role nào khác role trên ko???
            $users = DB::table('model_has_roles')->where('role_id', $id)->select('model_id')->get()->pluck('model_id')->toArray();

            foreach ($users as $user) {

                $check_role_other = DB::table('model_has_roles')->where('model_id', $user)->where('role_id', '<>', $role->id)->exists();
                if ($check_role_other) {
                    $user_role_other = DB::table('model_has_roles')->where('role_id', '<>', $role->id)->where('model_id', $user)->select('role_id')->get()->pluck('role_id')->toArray();

                    $permissions = [];
                    foreach ($user_role_other as $role_other) {
                        $permissions[] = DB::table('role_has_permissions')->where('role_id', $role_other)->select('permission_id')->get()->pluck('permission_id')->toArray();
                    }

                    // các quyền khác của user
                    $permissions_clean = array_unique(call_user_func_array('array_merge', $permissions));

                    // So sánh sự khác nhau giữa nhóm per của role muốn xóa và nhóm per khác user (user thuộc role)


                    // sẽ trả về các phần tử của mảng đầu tiên mà không có trong các mảng sau đó 
                    $permission_delete = array_diff($permissions_role_current_clean, $permissions_clean);

                    foreach ($permission_delete as $permission) {
                        DB::table('model_has_permissions')->where('model_id', $user)->where('permission_id', $permission)->delete();
                    }

                } else {
                    foreach ($permissions_role_current_clean as $permission) {
                        DB::table('model_has_permissions')->where('model_id', $user)->where('permission_id', $permission)->delete();
                    }
                }

            }
            // ======
            $role->delete();
            // DB::table('role_has_permissions')->where('role_id', $id)->delete();
            return response()->json(['message' => 'Delete successfully'], 200);
        }
        return response()->json(['message' => 'Delete fail', 404]);
        // Khi xóa đi một roles => Spatie sẽ giúp ta tác động lên cả 2 bảng cùng với bảng role đó là:role_has_per, model_has_role
        // nhưng bảng model_has_per thì ko

        // Vậy nên: Để đảm bảo tính toàn vẹn về dữ liệu, ta cũng cần xóa đi các bản ghi phù hợp trong model_has_pers


    }

    // =========================================== Nhóm function cho Allocation / Phân bổ quyền =========================================

    public function CreateAllocation()
    {
        $users = DB::table('users')->where('is_admin', '<>', 1)->orWhereNull('is_admin')->select('id', 'email')->get();
        $roles = Role::select('id', 'name')->get();
        return view('admin.decentralization.allocation.add', compact('users', 'roles'));
    }

    public function CreateAllocationStart(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validated = $request->validate([
                'model_id' => 'required',
                'role_id' => 'required'
            ], [
                'model_id.required' => 'Người dùng được cấp quyền đang trống',
                'role_id.required' => 'Vai trò cho người dùng chưa được chọn'
            ]);

            $model_type = $request->model_type;
            // lấy id của user được chọn
            $model_id = $request->model_id;
            // lấy list vai trò được chọn
            $roles_ids = $request->role_id;

            $permissions_simple = [];
            // lặp để thực hiện insert vào bảng model_has_roles
            $roles = [];
            foreach ($roles_ids as $role) {
                $permission = DB::table('role_has_permissions')->where('role_id', $role)->select('permission_id')->get()->pluck('permission_id')->toArray();
                $permissions_simple[] = $permission;
                // chuyển đổi list role_ids sang các giá trị INT id để phục vụ cho công việc bên dưới
                $roles[] = intval($role);
            }
            // làm sạch mảng thô
            $permissions_clean = array_unique(call_user_func_array('array_merge', $permissions_simple));

            $user = User::find($model_id);
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'username' => $user->username,
                'is_admin' => 3,
                'status' => 1,
                'avatar' => $user->avatar
            ];
            $update_is_admin = User::where('id', $model_id)->update($data);
            $user->syncRoles($roles);
            $user->syncPermissions($permissions_clean);

            return redirect()->route('allocation-add')->with('success', 'Cấp quyền cho người dùng thành công');


        }
    }


    public function UpdateAllocation(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $users = DB::table('users')->where('is_admin', '<>', 1)->orWhereNull('is_admin')->select('id', 'email')->get();
            $roles = Role::select('id', 'name')->get();
            $user_current = User::where('id', $id)->with('roles')->whereHas('roles')->first();
            return view('admin.decentralization.allocation.update', compact('users', 'roles', 'user_current'));
        }
        abort(404);
    }

    public function UpdateAllocationStart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'model_id' => 'required',
                'role_id' => 'required'
            ], [
                'model_id.required' => 'Người dùng được cấp quyền đang trống',
                'role_id.required' => 'Vai trò cho người dùng chưa được chọn'
            ]);
            // chọn người khác
            $user_choose = $request->model_id;
            // giữ nguyên người hiện tại
            $user_id = $request->id;

            // Nếu vẫn là user cũ ko thay đổi user thì giữ nguyên
            if ($user_choose == $user_id) {
                $user = User::find($user_id);
                $data = $request->all();
                $roles = $data['role_id'];
                if (!empty($roles)) {
                    $permissions = [];
                    $role_ids = [];
                    foreach ($roles as $item) {
                        $permission = DB::table('role_has_permissions')->where('role_id', $item)->select('permission_id')->get()->pluck('permission_id')
                            ->toArray();
                        $permissions[] = $permission;
                        $role_ids[] = intval($item);
                    }
                    if (!empty($permissions)) {
                        $permissions = array_unique(call_user_func_array('array_merge', $permissions));
                        $user->syncPermissions($permissions);
                        $user->syncRoles($role_ids);
                    }
                    return redirect()->route('allocation-update', ['id' => $user_id])->with('success', 'Cập nhật lại vai trò cho người dùng thành công');
                }
            } else {

                // Nếu là user mới thì xóa vai trò và quyền của user cũ đi
                $user_roles = User::where('id', $user_id)->with('roles')->whereHas('roles')->first();
                $roles = $user_roles->roles;
                $permissions = [];
                foreach ($roles as $role) {
                    $model_has_roles_delete = DB::table('model_has_roles')->where('model_id', $user_id)->where('role_id', $role->id)->delete();
                    $permissions[] = DB::table('role_has_permissions')->where('role_id', $role->id)->select('permission_id')->get()->pluck('permission_id')->toArray();
                }

                $permissions_clean = array_unique(call_user_func_array('array_merge', $permissions));
                foreach ($permissions_clean as $permission_id) {

                    $model_has_permissions_delete = DB::table('model_has_permissions')->where('model_id', $user_id)->where('permission_id', $permission_id)->delete();
                }


                // Người mới được bổ sung


                $user = User::find($user_choose);
                $data = $request->all();
                $roles = $data['role_id'];
                if (!empty($roles)) {
                    $permissions = [];
                    $role_ids = [];
                    foreach ($roles as $item) {
                        $permission = DB::table('role_has_permissions')->where('role_id', $item)->select('permission_id')->get()->pluck('permission_id')
                            ->toArray();
                        $permissions[] = $permission;
                        $role_ids[] = intval($item);
                    }
                    if (!empty($permissions)) {
                        $permissions = array_unique(call_user_func_array('array_merge', $permissions));
                        $user->syncPermissions($permissions);
                        $user->syncRoles($role_ids);
                    }
                    return redirect()->route('allocation-update', ['id' => $user_choose])->with('success', 'Cập nhật lại vai trò cho người dùng thành công');
                }
            }
        }
    }

    public function DeleteAllocation(Request $request)
    {

        $id_user = $request->id;

        if ($id_user > 0) {

            $model_has_roles = DB::table('model_has_roles')->where('model_id', $id_user)->delete();
            $model_has_permissions = DB::table('model_has_permissions')->where('model_id', $id_user)->delete();
            $user = User::find($id_user);
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'username' => $user->username,
                'is_admin' => NULL,
                'status' => 1,
                'avatar' => $user->avatar
            ];

            $update_is_admin = User::where('id', $id_user)->update($data);

            return response()->json(['message' => 'Delete Successfully'], 200);
        }
        return response()->json(['message' => 'Delete Fail'], 404);
    }
}
