<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $primaryKey = 'post_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['post_title', 'post_img', 'post_desc', 'created_at', 'id_user'];
}
