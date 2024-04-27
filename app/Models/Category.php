<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categorys_tbl';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'name', 'desc', 'created_at', 'updated_at'];



}
