<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $dateFormat = 'U';

    protected $fillable = [
        'images', 'name', 'price', 'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
}
