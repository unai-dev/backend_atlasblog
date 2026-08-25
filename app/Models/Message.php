<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["content", "post_id"];
    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
