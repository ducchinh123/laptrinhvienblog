<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DecentralizationController extends Controller
{
    //

    public function IndexDecentralization()
    {
        return view('admin.decentralization.index');
    }

    // Nhóm function cho Roles

    public function IndexRole()
    {
        return view('admin.decentralization.roles.index');
    }

    public function CreateRole()
    {
        return view('admin.decentralization.roles.add');
    }

    public function CreateRoleStart(Request $request)
    {

        if ($request->isMethod('POST')) {

            $validated = $request->validate([
                'name' => 'required'
            ], [
                'name.required' => 'Tên vai trò không được để trống'
            ]);

            $data = [
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'desc_role' => $request->desc_role ?? 'Chưa có mô tả'
            ];

            $createRole = DB::table('roles')->insert($data);

            if ($createRole) {
                return redirect()->route('role-add')->with('success', 'Thêm mới vai trò thành công');
            }


        }
    }
}
