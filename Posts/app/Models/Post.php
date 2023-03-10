<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mysql_posts';

    protected $fillable = [
        'name',
        'description'
    ];

    protected $table = 'post';
}
