<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "Commentables";
    protected $fillable = [
        'content',
        'create_at',
        'update_at',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
