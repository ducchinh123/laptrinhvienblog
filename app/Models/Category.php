<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categorys_tbl';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'desc', 'created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
        static::deleted(function ($category) {
            // những post ở đây tôi thấy sẽ toàn là post với điều kiện chưa được xóa mềm, thì việc cập nhật sẽ đúng
            $posts = $category->posts()->get();
            $boolean = DB::table('categorys_tbl')->where('name', 'Chưa phân loại')->exists();
            if (!$boolean) {
                $insert = DB::table('categorys_tbl')->insertGetId([
                    'name' => 'Chưa phân loại',
                    'desc' => 'Chưa có mô tả',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                foreach ($posts as $post) {
                    $data = [
                        'title' => $post->title,
                        'desc_short' => $post->desc_short,
                        'desc_detail' => $post->desc_detail,
                        'date_submitted' => $post->date_submitted,
                        'category_id' => $insert,
                        'author' => $post->author,
                        'overview_photo' => $post->overview_photo
                    ];

                    $updateCate = Post::where('id', $post->id)->update($data);
                }

            } else {
                $Cate = DB::table('categorys_tbl')->where('name', 'Chưa phân loại')->select('id')->first();
                foreach ($posts as $post) {
                    $data = [
                        'title' => $post->title,
                        'desc_short' => $post->desc_short,
                        'desc_detail' => $post->desc_detail,
                        'date_submitted' => $post->date_submitted,
                        'category_id' => $Cate->id,
                        'author' => $post->author,
                        'overview_photo' => $post->overview_photo
                    ];

                    $updateCate = Post::where('id', $post->id)->update($data);
                }
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}
