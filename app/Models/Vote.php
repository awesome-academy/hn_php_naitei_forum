<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = "voteables";
    protected $fillable = [
        'up_vote',
        'down_vote',
        'create_at',
        'update_at',
        'user_id',
    ];

    public function voteable()
    {
        return $this->morphTo();
    }
}
