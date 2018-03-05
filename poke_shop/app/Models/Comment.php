<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $fillable = [
        'description', 'pokemon_id', 'user_id', 
    ];

    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pokemon()
    {
        return $this->belongsTo('App\Models\Pokemon');
    }

    public function isOwner()
    {
        /** Kalo guest */
        if(Auth::guest()) return false;

        /** Kalo bukan guest */
        return Auth::user()->id == $this->user->id;
    }
}
