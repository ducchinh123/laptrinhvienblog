<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
class Post extends Model
{
    use HasFactory, SoftDeletes, Commentable;
    protected $table = 'posts_tbl';
    protected $fillable = ['id', 'title', 'desc_short', 'desc_detail', 'author', 'date_submitted', 'category_id', 'overview_photo', 'view_post', 'author_id', 'slug'];
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
