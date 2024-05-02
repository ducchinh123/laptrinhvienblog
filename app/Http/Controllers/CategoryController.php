<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function IndexCategory()
    {
        $datas = DB::table('categorys_tbl')->whereNull('deleted_at')->select('id', 'name', 'desc', 'created_at')->orderBy('id', 'desc')->paginate(5);
        $dataDeleted = Category::onlyTrashed()->count();
        return view('admin.category.index', compact('datas', 'dataDeleted'));
    }
    public function TrashCategory()
    {
        $datas = Category::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.category.trash', compact('datas'));
    }

    public function RestoreCategory($id)
    {
        if ($id > 0) {
            $category = Category::withTrashed()->find($id);
            $category->restore();
            return redirect()->route('devC-cate-trash')->with('success', 'Khôi phục danh mục thành công');
        }
    }


    public function CreateCategory(Request $request)
    {
        if ($request->isMethod('POST')) {
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

            if ($insertData->id) {
                return redirect()->route('devC-cate-add')->with('success', 'Thêm mới danh mục thành công');
            }
        }

        return view('admin.category.add');

    }


    public function EditCategory(Request $request, $id)
    {

        $idCate = $id;
        if ($idCate > 0) {
            $category = Category::find($idCate);
            if (isset($category->id) && $category->id != null) {
                return view('admin.category.update', compact('category'));
            } else {
                abort(404);
            }
        }
        abort(404);
    }


    public function UpdateCategory(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => [
                    'required',
                    Rule::unique('categorys_tbl')->ignore($request->id)
                ]
            ], [

                'name.required' => 'Tên danh mục không được trống',
                'name.unique' => 'Tên danh mục này đã tồn tại'

            ]);
            $data = [
                'name' => $request->name,
                'created_at' => now(),
                'desc' => $request->desc != null ? $request->desc : 'Chưa có mô tả'
            ];
            $updateData = Category::where('id', $request->id)->update($data);

            if ($updateData) {
                return redirect()->route('devC-cate-update', ['id' => $request->id])->with('success', 'Cập nhật danh mục thành công');
            }
            return redirect()->route('devC-cate-update', ['id' => $request->id])->with('error', 'Cập nhật danh mục không thành công');
        }
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
