<?php

namespace App;

use App\Exceptions\ApprovedRequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        'user_id',
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

    public function approve()
    {
        if ($this->done) {
            throw new ApprovedRequestException();
        }

        $user = User::where('id', $this->user_id)->first();
        DB::transaction(function () use ($user) {
            $user->changeRole(User::ROLE_SETTER);

            $this->done = true;
            $this->save();

            Log::info(sprintf('Request for promotion by %s(id: %s) is approved', $user->name, $user->id));
        });
    }
}
