<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        'name', 'image_path',
    ];

    protected $table = "elements";

    public function pokemon()
    {
        return $this->hasOne('App\Models\Pokemon');
    }   
}
