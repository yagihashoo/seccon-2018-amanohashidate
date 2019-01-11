<?php

namespace App;

use App\Exceptions\VerifiedChallengeException;
use App\Exceptions\SolvedChallengeException;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Challenge extends Model
{
    public static $status_none = 'NONE';
    public static $status_verified = 'VERIFIED';
    public static $status_solved = 'SOLVED';
    public static $status_failed = 'FAILED';
    public static $status_error = 'SERVER ERROR';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'html',
        'model_answer',
        'status',
        'setter_id',
        'file_id',
        'from_ip0',
        'from_ip1',
        'from_ip2',
        'from_ip3',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'model_answer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate(4)->string;
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
