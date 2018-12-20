<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payload',
        'user_id',
        'challenge_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
