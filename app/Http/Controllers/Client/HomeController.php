<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        // header & footer
        $title = 'Lập trình viên | Blog';
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // ======================
        // Top 4 bài viết hiển thị slide show
        $posts_slide_show = Post::orderBy('view_post', 'desc')->take(4)->get();
        // Top 5 bài viết hiển thị Tranding
        $posts_tranding = Post::orderBy('view_post', 'desc')->take(5)->get();
        // Lấy setting
        $settings = DB::table('settings_tbl')->where('id', 1)->select('choose_banner', 'choose_social', 'text_logo')->first();
        // Hiển thị cho bài viết có view cao nhất
        $post_big = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')
            ->join('users', 'users.id', '=', 'posts_tbl.author_id')
            ->select('posts_tbl.id','posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.desc_short', 'posts_tbl.overview_photo', 'categorys_tbl.name as category_name', 'users.name as author_name', 'users.avatar', 'posts_tbl.slug')
            ->orderBy('view_post', 'desc')->take(1)->first();
        // List bài viết
        $posts_list = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as id_post', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.overview_photo', 'posts_tbl.slug','categorys_tbl.name')->paginate(6);
        // List video
        $videos_list = Video::join('categorys_tbl', 'categorys_tbl.id', '=', 'videos_tbl.category_id')->join('users', 'users.id', '=', 'videos_tbl.author_id')->select('videos_tbl.id as id_video', 'videos_tbl.title', 'videos_tbl.link_youtube', 'videos_tbl.desc_video', 'videos_tbl.created_at', 'videos_tbl.image_video', 'categorys_tbl.name as category_name', 'users.name as author_name', 'users.avatar')->paginate(4);
        // Top 6 video gần đây
        $videos_recently = Video::join('categorys_tbl', 'categorys_tbl.id', '=', 'videos_tbl.category_id')->join('users', 'users.id', '=', 'videos_tbl.author_id')->orderBy('created_at', 'desc')->select('videos_tbl.id as id_video', 'videos_tbl.title', 'videos_tbl.link_youtube', 'videos_tbl.created_at', 'categorys_tbl.name as category_name', 'users.name as author_name')->take(6)->get();
        return view('client.home', compact('posts_slide_show', 'settings', 'posts_tranding', 'post_big', 'posts_list', 'videos_list', 'videos_recently', 'title', 'description', 'category_menu', 'posts_menu'));
    }
}
