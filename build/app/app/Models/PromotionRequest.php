<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionRequest extends Model
{
    protected $table = 'promotion_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'use_id',
        'role_id',
        'done',
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
