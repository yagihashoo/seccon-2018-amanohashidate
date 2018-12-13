<?php

namespace App;

use App\Exceptions\VerifiedChallengeException;
use App\Exceptions\SolvedChallengeException;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Challenge extends Model
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'model_answer',
        'verified',
        'solved',
        'setter_id',
        'file_id',
        'from_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'from_ip',
        'model_answer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

    public function verify()
    {
        if ($this->verified) {
            throw new VerifiedChallengeException();
        }

        // TODO: Implement verification process

        $this->verified = true;
        $this->save();
    }

    public function solve()
    {
        if ($this->solved) {
            throw new SolvedChallengeException();
        }

        $this->solved = true;
        $this->save();
    }

    public function enqueue()
    {
        //
    }

    public function storeChallengeHtml(string $html)
    {
        //
    }
}
