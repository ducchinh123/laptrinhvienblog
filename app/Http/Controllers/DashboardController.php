<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function IndexDashboard()
    {
        // các tống số
        $post_total = Post::whereNull('deleted_at')->count();
        $video_total = Video::whereNull('deleted_at')->count();
        $category_total = Category::whereNull('deleted_at')->count();
        $user_total = User::where('status', 1)->count();
        $comment_total = DB::table('comments')->whereNull('deleted_at')->count();
        // cụ thể báo cáo
        $vtop_post = Post::select('id', 'title', 'date_submitted', 'slug', 'view_post')->where(DB::raw('WEEK(date_submitted)'), '=', DB::raw('WEEK(NOW())'))
            ->whereYear('date_submitted', date('Y'))
            ->orderBy('view_post', 'desc')
            ->take(10)
            ->get();

        $ctop_post = Post::select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.slug', DB::raw('COUNT(comments.id) as comment_count'))
            ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
            ->where(DB::raw('YEARWEEK(posts_tbl.date_submitted)'), '=', DB::raw('YEARWEEK(NOW())'))
            ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
            ->groupBy('posts_tbl.id', 'posts_tbl.title')
            ->get();

        $catetop_post = Post::select(
            'categorys_tbl.id',
            'categorys_tbl.name',
            'categorys_tbl.created_at',
            DB::raw('COUNT(comments.id) as comment_count'),
            DB::raw('SUM(posts_tbl.view_post) as total_views')
        )
            ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
            ->join('categorys_tbl', 'posts_tbl.category_id', '=', 'categorys_tbl.id')
            ->where(DB::raw('YEARWEEK(posts_tbl.date_submitted)'), '=', DB::raw('YEARWEEK(NOW())'))
            ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
            ->groupBy('categorys_tbl.id', 'categorys_tbl.name')
            ->get();

        // dd(Post::select('id', 'title', 'date_submitted', 'slug', 'view_post')
        // ->whereMonth('date_submitted', date('m'))
        // ->whereYear('date_submitted', date('Y'))
        // ->orderBy('view', 'desc')
        // ->take(10)
        // ->get());

        return view('admin.index', compact('post_total', 'video_total', 'category_total', 'user_total', 'comment_total', 'vtop_post', 'ctop_post', 'catetop_post'));
    }

    public function PostViewTallest(Request $request)
    {
        $option = trim($request->option);

        if (!empty($option)) {

            if ($option == 'tw-pvt') {
                $vtop_post = Post::select('id', 'title', 'date_submitted', 'slug', 'view_post')->where(DB::raw('WEEK(date_submitted)'), '=', DB::raw('WEEK(NOW())'))
                    ->whereYear('date_submitted', date('Y'))
                    ->orderBy('view_post', 'desc')
                    ->take(10)
                    ->get();
                return response()->json(['data' => $vtop_post]);
            }

            if ($option == 'tm-pvt') {
                $vtop_post =
                    Post::select('id', 'title', 'date_submitted', 'slug', 'view_post')
                        ->whereMonth('date_submitted', date('m'))
                        ->whereYear('date_submitted', date('Y'))
                        ->orderBy('view_post', 'desc')
                        ->take(10)
                        ->get();
                return response()->json(['data' => $vtop_post]);
            }


            if ($option == 'ty-pvt') {
                $vtop_post =
                    Post::select('id', 'title', 'date_submitted', 'slug', 'view_post')
                        ->whereYear('date_submitted', date('Y'))
                        ->orderBy('view_post', 'desc')
                        ->take(10)
                        ->get();
                return response()->json(['data' => $vtop_post]);
            }


        }
        return [];
    }



    public function PostCareAbout(Request $request)
    {
        $option = trim($request->option);

        if (!empty($option)) {

            if ($option == 'tw-ctp') {
                $ctop_post = Post::select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.slug', DB::raw('COUNT(comments.id) as comment_count'))
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->where(DB::raw('YEARWEEK(posts_tbl.date_submitted)'), '=', DB::raw('YEARWEEK(NOW())'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('posts_tbl.id', 'posts_tbl.title')
                    ->get();
                return response()->json(['data' => $ctop_post]);
            }

            if ($option == 'tm-ctp') {
                $ctop_post = Post::select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.slug', DB::raw('COUNT(comments.id) as comment_count'))
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->whereYear('posts_tbl.date_submitted', '=', date('Y'))
                    ->whereMonth('posts_tbl.date_submitted', '=', date('m'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('posts_tbl.id', 'posts_tbl.title')
                    ->get();
                return response()->json(['data' => $ctop_post]);
            }


            if ($option == 'ty-ctp') {
                $ctop_post = Post::select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.slug', DB::raw('COUNT(comments.id) as comment_count'))
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->whereYear('posts_tbl.date_submitted', '=', date('Y'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('posts_tbl.id', 'posts_tbl.title')
                    ->get();
                return response()->json(['data' => $ctop_post]);
            }


        }
        return [];
    }


    public function CategoryPostTop(Request $request)
    {
        $option = trim($request->option);

        if (!empty($option)) {

            if ($option == 'tw-catp') {
                $catetop_post = Post::select(
                    'categorys_tbl.id',
                    'categorys_tbl.name',
                    'categorys_tbl.created_at',
                    DB::raw('COUNT(comments.id) as comment_count'),
                    DB::raw('SUM(posts_tbl.view_post) as total_views')
                )
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->join('categorys_tbl', 'posts_tbl.category_id', '=', 'categorys_tbl.id')
                    ->where(DB::raw('YEARWEEK(posts_tbl.date_submitted)'), '=', DB::raw('YEARWEEK(NOW())'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('categorys_tbl.id', 'categorys_tbl.name')
                    ->get();
                return response()->json(['data' => $catetop_post]);
            }

            if ($option == 'tm-catp') {
                $catetop_post = Post::select(
                    'categorys_tbl.id',
                    'categorys_tbl.name',
                    'categorys_tbl.created_at',
                    DB::raw('COUNT(comments.id) as comment_count'),
                    DB::raw('SUM(posts_tbl.view_post) as total_views')
                )
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->join('categorys_tbl', 'posts_tbl.category_id', '=', 'categorys_tbl.id')
                    ->whereYear('posts_tbl.date_submitted', '=', date('Y'))
                    ->whereMonth('posts_tbl.date_submitted', '=', date('m'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('categorys_tbl.id', 'categorys_tbl.name')
                    ->get();
                return response()->json(['data' => $catetop_post]);
            }


            if ($option == 'ty-catp') {
                $catetop_post = Post::select(
                    'categorys_tbl.id',
                    'categorys_tbl.name',
                    'categorys_tbl.created_at',
                    DB::raw('COUNT(comments.id) as comment_count'),
                    DB::raw('SUM(posts_tbl.view_post) as total_views')
                )
                    ->join('comments', 'posts_tbl.id', '=', 'comments.commentable_id')
                    ->join('categorys_tbl', 'posts_tbl.category_id', '=', 'categorys_tbl.id')
                    ->whereYear('posts_tbl.date_submitted', '=', date('Y'))
                    ->where('comments.commentable_type', '=', 'App\Models\Post') // Chỉ đếm comment của bài viết
                    ->groupBy('categorys_tbl.id', 'categorys_tbl.name')
                    ->get();
                return response()->json(['data' => $catetop_post]);
            }


        }
        return [];
    }
}
