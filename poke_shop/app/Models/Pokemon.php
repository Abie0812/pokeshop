<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Pokemon extends Model
{
    protected $fillable = [
        'name', 'image_path', 'gender', 'description', 'price', 'slug', 'element_id',
    ];

    protected $table = 'pokemons';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function element() 
    {
        return $this->belongsTo('App\Models\Element');
    }

    public function isOwner()
    {
        /** Kalo guest */
        if(Auth::guest()) return false;

        /** Kalo bukan guest */
        return Auth::user()->id == $this->user->id;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
