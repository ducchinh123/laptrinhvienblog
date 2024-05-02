<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //

    public function IndexPost()
    {
        $datas = DB::table('posts_tbl')->select('id', 'title', 'desc_short', 'created_at')->whereNull('deleted_at')->orderBy('id', 'desc')->paginate(5);
        $deletedCount = Post::onlyTrashed()->count();
        return view('admin.post.index', compact('datas', 'deletedCount'));
    }

    public function TrashPost()
    {
        $datas = Post::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.post.trash', compact('datas'));
    }

    public function CreatePost(Request $request)
    {
        $categories = Category::all();
        return view('admin.post.add', compact('categories'));
    }

    public function CreatePostStart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validate = $request->validate(
                [
                    'title' => ['required'],
                    'desc_short' => ['required'],
                    'desc_detail' => ['required'],
                    'date_submitted' => ['required'],
                    'category_id' => ['required'],
                    'author' => ['required'],
                    'overview_photo' => ['required']
                ],
                [
                    'title.required' => 'Tiêu đề bài viết không được trống',
                    'desc_short.required' => 'Mô tả ngắn không được để trống',
                    'desc_detail.required' => 'Mô tả chi tiết không được để trống',
                    'date_submitted.required' => 'Ngày xuất bản không được để trống',
                    'category_id.required' => 'Danh mục bài viết không được để trống',
                    'author.required' => 'Tác giả viết bài không được để trống',
                    'overview_photo.required' => 'Ảnh đại diện không được để trống'
                ]
            );


            if ($request->hasFile('overview_photo')) {
                $overview_photo = $request->file('overview_photo');
                $new_file_name = uniqid() . "_" . $overview_photo->getClientOriginalName();
                $storePath = $overview_photo->move(public_path('assets/overview_photos'), $new_file_name);
                $path_then = env("APP_SERVER") . "assets/overview_photos/" . $new_file_name;
            }


            $data_post = [
                'title' => $request->title,
                'desc_short' => $request->desc_short,
                'desc_detail' => $request->desc_detail,
                'date_submitted' => $request->date_submitted,
                'category_id' => $request->category_id,
                'author' => $request->author,
                'overview_photo' => $path_then
            ];



            $post = Post::create($data_post);

            if ($post->id) {
                return redirect()->route('devC-post-add')->with('success', 'Thêm mới bài viết thành công');
            }


        }
        return redirect()->route('devC-post-add');
    }

    public function EditPost(Request $request)
    {
        $id = $request->id;
        $post = [];
        if ($id > 0) {
            $instance = Post::find($id);
            $filter = $instance->makeVisible(["*"])->makeHidden(['deleted_at', 'view_post', 'updated_at'])->toArray();
            $post = json_decode(json_encode($filter));
        }
        $categories = Category::all();
        return view('admin.post.update', compact('categories', 'post'));
    }


    public function UpdatePostStart(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $instance = Post::find($id);
            $filter = $instance->makeVisible(["*"])->makeHidden(['deleted_at', 'view_post', 'updated_at'])->toArray();
            $post = json_decode(json_encode($filter));
            if ($request->isMethod('POST')) {
                $validate = $request->validate(
                    [
                        'title' => ['required'],
                        'desc_short' => ['required'],
                        'desc_detail' => ['required'],
                        'date_submitted' => ['required'],
                        'category_id' => ['required'],
                        'author' => ['required']
                    ],
                    [
                        'title.required' => 'Tiêu đề bài viết không được trống',
                        'desc_short.required' => 'Mô tả ngắn không được để trống',
                        'desc_detail.required' => 'Mô tả chi tiết không được để trống',
                        'date_submitted.required' => 'Ngày xuất bản không được để trống',
                        'category_id.required' => 'Danh mục bài viết không được để trống'
                    ]
                );


                if ($request->hasFile('overview_photo')) {
                    $overview_photo = $request->file('overview_photo');
                    $new_file_name = uniqid() . "_" . $overview_photo->getClientOriginalName();
                    $storePath = $overview_photo->move(public_path('assets/overview_photos'), $new_file_name);
                    $path_then = env("APP_SERVER") . "assets/overview_photos/" . $new_file_name;
                    $pos = strpos($post->overview_photo, 'overview_photos/');
                    $localPath = substr($post->overview_photo, $pos + strlen('overview_photos/'));
                    unlink(public_path('assets/overview_photos/' . $localPath));
                }


                $data_post = [
                    'title' => $request->title ?? $post->title,
                    'desc_short' => $request->desc_short ?? $post->desc_short,
                    'desc_detail' => $request->desc_detail ?? $post->desc_detail,
                    'date_submitted' => $request->date_submitted ?? $post->date_submitted,
                    'category_id' => $request->category_id ?? $post->category_id,
                    'author' => $request->author ?? $post->author,
                    'overview_photo' => $path_then ?? $post->overview_photo
                ];



                $post = Post::where('id', $id)->update($data_post);

                if ($post) {
                    return redirect()->route('devC-post-update', ['id' => $id])->with('success', 'Cập nhật bài viết thành công');
                }

                return redirect()->route('devC-post-update', ['id' => $id])->with('error', 'Lỗi cập nhật bài viết');


            }
        }

        abort(404);
    }

    public function RestorePost($id)
    {
        if ($id > 0) {
            $post = Post::withTrashed()->find($id);
            $category_id = $post->category_id;
            $CateInstance = Category::find($category_id);
            if ($CateInstance == null) {
                $Cate = DB::table('categorys_tbl')->where('name', 'Chưa phân loại')->select('id')->first();
                $data = [
                    'title' => $post->title,
                    'desc_short' => $post->desc_short,
                    'desc_detail' => $post->desc_detail,
                    'date_submitted' => $post->date_submitted,
                    'category_id' => $Cate->id,
                    'author' => $post->author,
                    'overview_photo' => $post->overview_photo
                ];
                $updateCate = $post->update($data);
            }

            $post->restore();
            return redirect()->route('devC-post-trash')->with('success', 'Khôi phục bài viết thành công');
        }
    }


    public function DeletePost(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $post = Post::find($id);
            if ($post) {
                $result = $post->delete();
                if ($result) {
                    return response()->json(['message' => 'Delete Successfully']);
                }
                return response()->json(['message' => 'Delete Fail']);
            }
        }


    }
}
