<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceText extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'content_az',
        'content_en',
        'content_ru',
    ];
}
