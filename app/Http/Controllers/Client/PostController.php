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


    public function HomePost(Request $request)
    {

        // List bài viết
        $posts_list = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.overview_photo', 'users.avatar', 'categorys_tbl.name', 'users.name as author_name')->paginate(5);
        // Top 6 bài viết hiển thị Tranding & Old
        $posts_tranding = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('view_post', 'desc')->take(6)->get();
        $posts_old = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('created_at', 'asc')->take(6)->get();
        // header & footer
        $title = "Bài viết của DevC | Blog";
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as idPost', 'posts_tbl.title', 'posts_tbl.slug', 'posts_tbl.overview_photo', 'categorys_tbl.name')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // dd($posts_menu);
        // ======================
        return view('client.post', compact('title', 'brand', 'description', 'category_menu', 'posts_menu', 'posts_list', 'posts_tranding', 'posts_old'));
    }

    public function DetailPost(Request $request)
    {

        $id = $request->id;
        $post_detail = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id', 'posts_tbl.title', 'posts_tbl.desc_detail', 'posts_tbl.created_at', 'categorys_tbl.name')->find($id);
        // Top 6 bài viết hiển thị Tranding & Old
        $posts_tranding = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('view_post', 'desc')->take(6)->get();
        $posts_old = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('created_at', 'asc')->take(6)->get();
        // header & footer
        $title = $post_detail->title . " | Blog";
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as idPost', 'posts_tbl.title', 'posts_tbl.slug', 'posts_tbl.overview_photo', 'categorys_tbl.name')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // dd($posts_menu);
        // ======================
        return view('client.detail_post', compact('title', 'brand', 'description', 'category_menu', 'posts_menu', 'post_detail', 'posts_tranding', 'posts_old'));
    }


    public function BindPostById(Request $request)
    {

        // List bài viết
        $posts_list = Post::where('posts_tbl.category_id', $request->id)->join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.overview_photo', 'users.avatar', 'categorys_tbl.name', 'users.name as author_name')->paginate(5);
        // Top 6 bài viết hiển thị Tranding & Old
        $posts_tranding = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('view_post', 'desc')->take(6)->get();
        $posts_old = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('created_at', 'asc')->take(6)->get();
        // header & footer
        $title = "Bài viết của DevC | Blog";
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as idPost', 'posts_tbl.title', 'posts_tbl.slug', 'posts_tbl.overview_photo', 'categorys_tbl.name')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // dd($posts_menu);
        // ======================
        return view('client.result', compact('title', 'brand', 'description', 'category_menu', 'posts_menu', 'posts_list', 'posts_tranding', 'posts_old'));
    }



    public function SearchPost(Request $request)
    {

        if($request->isMethod('POST')) {
            // List bài viết
        $posts_list = Post::where('posts_tbl.title', 'like', "%".$request->title."%")->join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.date_submitted', 'posts_tbl.overview_photo', 'users.avatar', 'categorys_tbl.name', 'users.name as author_name')->paginate(5);
        // Top 6 bài viết hiển thị Tranding & Old
        $posts_tranding = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('view_post', 'desc')->take(6)->get();
        $posts_old = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->join('users', 'users.id', '=', 'posts_tbl.author_id')->select('posts_tbl.id', 'posts_tbl.slug', 'posts_tbl.title', 'posts_tbl.created_at', 'categorys_tbl.name', 'users.name as author_name')->orderBy('created_at', 'asc')->take(6)->get();
        // header & footer
        $title = "Bài viết của DevC | Blog";
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as idPost', 'posts_tbl.title', 'posts_tbl.slug', 'posts_tbl.overview_photo', 'categorys_tbl.name')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // dd($posts_menu);
        // ======================
        return view('client.post', compact('title', 'brand', 'description', 'category_menu', 'posts_menu', 'posts_list', 'posts_tranding', 'posts_old'));
        }
        return redirect('/');
    }


}
