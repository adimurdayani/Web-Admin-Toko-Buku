<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'phone',
        'password',
        'user_id',
        'fcm'
    ];
}
