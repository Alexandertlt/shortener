<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    // Список полей, которые можно добавлять:
    protected $fillable = ['origin', 'path'];

    /**
     * Вычисляемое поле -- Подставляем домен
     * @return string
     */
    public function getShortenedAttribute()
    {
        return env('APP_URL') . '/' . $this->attributes['path'];
    }
}
