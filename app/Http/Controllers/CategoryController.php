<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function IndexCategory()
    {
        $datas = DB::table('categorys_tbl')->whereNull('deleted_at')->select('id', 'name', 'desc', 'created_at')->get();
        return view('admin.category.index', compact('datas'));
    }


    public function CreateCategory(Request $request)
    {
        if($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required|unique:categorys_tbl'
            ], [
    
                'name.required' => 'Tên danh mục không được trống',
                'name.unique' => 'Tên danh mục này đã tồn tại'
    
            ]);
            $data = [
                'name' => $request->name,
                'created_at' => now(),
                'desc' => $request->desc != null ? $request->desc : 'Chưa có mô tả'
            ];
            $insertData = Category::create($data);

            if($insertData->id) {
                return redirect()->route('devC-cate-add')->with('success', 'Thêm mới danh mục thành công');
            }
        }

        return view('admin.category.add');

    }



    public function DeleteCategory(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $category = Category::find($id);
            if ($category) {
                $result = $category->delete();
                if ($result) {
                    return response()->json(['message' => 'Delete Successfully']);
                }
                return response()->json(['message' => 'Delete Fail']);
            }
        }


    }
}
