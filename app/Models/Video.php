<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos_tbl';
    protected $fillable = ['id', 'title', 'link_youtube', 'category_id', 'image_video', 'author_id', 'desc_video'];
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
