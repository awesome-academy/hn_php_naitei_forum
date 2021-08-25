<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = "Commentables";
    protected $fillable = [
        'up_vote',
        'down_vote',
        'create_at',
        'update_at',
    ];

    public function voteable()
    {
        return $this->morphTo();
    }
}
