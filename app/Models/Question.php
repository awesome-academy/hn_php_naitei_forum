<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'views',
        'answers',
        'up_vote',
        'down_vote',
        'user_id',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function bestAnswer()
    {
        return $this->hasOne(Answer::class)->ofMany('votes_count', 'max');
    }

    public function latestAnswer()
    {
        return $this->hasOne(Answer::class)->latestOfMany();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_question');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function getStatusAttribute()
    {
        if ($this->answers > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return 'answered';
        }
        return "unaswered";
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function isFavorite()
    {
        if (Auth::check()) {
            return $this->favoriteUsers()->where('user_id', Auth::id())->count() > 0;
        }
        
        return false;
    }

    public function getFavoriteAttribute()
    {
        return $this->isFavorite();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favoriteUsers()->count();
    }
}
