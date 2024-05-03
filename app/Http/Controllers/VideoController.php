<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    //

    public function IndexVideo()
    {
        $videos = DB::table('videos_tbl')->whereNull('videos_tbl.deleted_at')->select('videos_tbl.id', 'videos_tbl.title', 'videos_tbl.link_youtube', 'categorys_tbl.name')->join('categorys_tbl', 'videos_tbl.category_id', '=', 'categorys_tbl.id')->orderBy('id', 'desc')->paginate(5);
        $countDeleted = Video::onlyTrashed()->count();
        return view('admin.video.index', compact('videos', 'countDeleted'));
    }

    public function CreateVideo()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.video.add', compact('categories'));
    }


    public function CreateVideoStart(Request $request)
    {
        if ($request->isMethod('video')) {
            $validated = $request->validate(
                [
                    'title' => ['required'],
                    'link_youtube' => ['required'],
                    'category_id' => ['required'],
                    'image_video' => ['required']
                ],
                [
                    'title.required' => 'Tiêu đề video không được để trống',
                    'link_youtube.required' => 'URL video không được để trống',
                    'category_id.required' => 'Danh mục video không được để trống',
                    'image_video.required' => 'Ảnh đại diện video không được trống'
                ]
            );

            if ($request->hasFile('image_video')) {

                $file = $request->file('image_video');
                $new_file_name = uniqid() . "_" . $file->getClientOriginalName();
                $image = $file->move(public_path('assets/overview_photos'), $new_file_name);
                $path_then = env("APP_SERVER") . "assets/overview_photos/" . $new_file_name;
            }

            $data_video = [
                'title' => $request->title,
                'link_youtube' => $request->link_youtube,
                'category_id' => $request->category_id,
                'image_video' => $path_then
            ];

            $video = Video::create($data_video);

            if ($video->id) {
                return redirect()->route('devC-video-add')->with('success', 'Thêm mới video thành công');
            }
            return redirect()->route('devC-video-add')->with('error', 'Thêm mới video không thành công');
        }
        return view('admin.video.add');
    }

    public function UpdateVideo(Request $request)
    {
        $id = $request->id;

        if ($id > 0) {
            $video = Video::find($id);
            $categories = Category::select('id', 'name')->get();
            return view('admin.video.update', compact('categories', 'video'));
        }
        abort(404);

    }

    public function UpdateVideoStart(Request $request)
    {
        if ($request->isMethod('video')) {
            $id = $request->id;
            $video = Video::find($id);
            $validated = $request->validate(
                [
                    'title' => ['required'],
                    'category_id' => ['required']
                ],
                [
                    'title.required' => 'Tiêu đề video không được để trống',
                    'category_id.required' => 'Danh mục video không được để trống'
                ]
            );

            if ($request->hasFile('image_video')) {

                $file = $request->file('image_video');
                $new_file_name = uniqid() . "_" . $file->getClientOriginalName();
                $image = $file->move(public_path('assets/overview_photos'), $new_file_name);
                $path_then = env("APP_SERVER") . "assets/overview_photos/" . $new_file_name;
            }

            $data_video = [
                'title' => $request->title ?? $video->title,
                'link_youtube' => $request->link_youtube ?? $video->link_youtube,
                'category_id' => $request->category_id ?? $video->category_id,
                'image_video' => $path_then ?? $video->image_video
            ];

            $video = Video::where('id', $id)->update($data_video);

            if ($video) {
                return redirect()->route('devC-video-update', ['id' => $id])->with('success', 'Cập nhật video thành công');
            }
            return redirect()->route('devC-video-update', ['id' => $id])->with('error', 'Cập nhật video không thành công');
        }
        return view('admin.video.update');
    }

    public function DeleteVideo(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $video = Video::find($id);
            if ($video) {
                $result = $video->delete();
                if ($result) {
                    return response()->json(['message' => 'Delete Successfully']);
                }
                return response()->json(['message' => 'Delete Fail']);
            }
        }
    }

    public function TrashVideo()
    {
        $videos = Video::onlyTrashed()->select('videos_tbl.id', 'videos_tbl.title', 'videos_tbl.link_youtube', 'categorys_tbl.name')->join('categorys_tbl', 'videos_tbl.category_id', '=', 'categorys_tbl.id')->orderBy('id', 'desc')->paginate(5);
        $categories = Category::select('id', 'name')->get();
        return view('admin.video.trash', compact('videos'));
    }

    public function RestoreVideo($id)
    {
        if ($id > 0) {
            $video = Video::withTrashed()->find($id);
            $category_id = $video->category_id;
            $CateInstance = Category::find($category_id);
            if ($CateInstance == null) {
                $Cate = DB::table('categorys_tbl')->where('name', 'Chưa phân loại')->select('id')->first();
                $data = [
                    'title' => $video->title,
                    'link_youtube' => $video->link_youtube,
                    'category_id' => $Cate->id,
                    'image_video' => $video->image_video
                ];
                $updateVideo = $video->update($data);
            }

            $video->restore();
            return redirect()->route('devc-video-trash')->with('success', 'Khôi phục video thành công');
        }
    }
}
