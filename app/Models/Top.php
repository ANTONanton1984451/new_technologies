<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    use HasFactory;


    protected $fillable = [
       'date',
       'ratings'
    ];


    public $hidden = [
       'date'
    ];


    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'date';

    public function getRatingsAttribute($value)
    {
        return json_decode($value,true);
    }
}
