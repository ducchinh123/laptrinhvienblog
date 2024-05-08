<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class PostController extends Controller
{
    //

    public function DetailPost(Request $request)
    {

        $id = $request->id;
        $post_detail = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.desc_detail', 'posts_tbl.created_at', 'categorys_tbl.name')->find($id);
        // Top 6 bài viết hiển thị Tranding & Old
        $posts_tranding = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id','posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('view_post', 'desc')->take(6)->get();
        $posts_old = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug','posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('created_at', 'asc')->take(6)->get();
        // header & footer
        $title = $post_detail->title . " | Blog";
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $post_detail->desc_short;
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // ======================
        return view('client.detail_post', compact('title', 'brand', 'description', 'category_menu', 'posts_menu', 'post_detail','posts_tranding', 'posts_old'));
    }
}
