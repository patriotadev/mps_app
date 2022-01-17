<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $primaryKey = 'id';

    protected $dates = ['created_at'];

    protected $fillable = ['comment_desc', 'from_user_id', 'created_at', 'to_post_id', 'updated_at'];
}