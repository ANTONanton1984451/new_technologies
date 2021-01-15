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

    /**
     * @param $value
     * @return mixed
     * Декодирует json со списком рейтинга.
     * Модели при создании уже имеют в себе декодированный список
     */
    public function getRatingsAttribute($value)
    {
        return json_decode($value,true);
    }
}
