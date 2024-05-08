<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    //

    public function HomeAbout() {
        // header & footer
        $title = 'Về tôi | Devc Blog';
        $brand = DB::table('settings_tbl')->where('id', 1)->select('text_logo')->first();
        $description = $brand->text_logo . " là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.";
        $category_menu = Category::select('id', 'name')->get();
        $posts_menu = Post::join('categorys_tbl', 'categorys_tbl.id', '=', 'posts_tbl.category_id')->select('posts_tbl.id as idPost', 'posts_tbl.title', 'posts_tbl.slug','posts_tbl.overview_photo', 'categorys_tbl.name')->orderBy('posts_tbl.created_at', 'desc')->take(4)->get();
        // dd($posts_menu);
        // ======================
        return view('client.about', compact('title', 'description', 'category_menu', 'posts_menu'));
    }
}
