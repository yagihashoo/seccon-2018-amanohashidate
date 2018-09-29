<?php

namespace App\Models;

use App\Exceptions\InvalidRoleIdException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    public $incrementing = false;

    const ROLE_USER = 0;
    const ROLE_SETTER = 1;
    const ROLE_ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate(4)->string;
        });
    }

    public function changeRole($role_id): void
    {
        if (!isset($role_id) or !in_array($role_id, [self::ROLE_USER, self::ROLE_SETTER, self::ROLE_ADMIN])) {
            throw new InvalidRoleIdException();
        }

        $this->role_id = $role_id;
        $this->save();
    }

    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }
}
