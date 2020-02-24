<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestion = $this->voteQuestions();
        if ($voteQuestion->where('votable_id', $question->id)->exists()) {
            $voteQuestion->updateExistingPivot($question, ['vote' => $vote]);
        } else {
            $voteQuestion->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');

        $upVotes = (int) $question->upVote()->sum('vote');
        $downVotes = (int) $question->downVote()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswer = $this->voteAnswers();
        if ($voteAnswer->where('votable_id', $answer->id)->exists()) {
            $voteAnswer->updateExistingPivot($answer, ['vote' => $vote]);
        } else {
            $voteAnswer->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votes');

        $upVotes = (int) $answer->upVote()->sum('vote');
        $downVotes = (int) $answer->downVote()->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();
    }

    public function getUrlAttribute()
    {
        return "#";
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites');
    }
}