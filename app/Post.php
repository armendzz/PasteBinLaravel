<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{

	use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
        }

    protected $fillable = [

    'title', 'content', 'status', 'expire', 'syntax', 'published_at', 'url', 'user_id'
    ];
}
