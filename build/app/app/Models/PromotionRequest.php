<?php

namespace App\Models;

use App\Exceptions\ApprovedRequestException;
use App\Exceptions\InsufficientRoleException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function approve(User $transaction_user)
    {
        if (!$transaction_user) {
            $transaction_user = Auth::user();
        }

        if ($this->done) {
            throw new ApprovedRequestException();
        }

        if (!$transaction_user->isAdmin()) {
            throw new InsufficientRoleException();
        }
        $user = User::where('id', $this->user_id)->first();
        DB::transaction(function () use ($user, $transaction_user) {
            $user->changeRole(User::ROLE_SETTER);

            $this->done = true;
            $this->save();
            Log::info(sprintf('Request for promotion by %s(id: %s) is approved', $user->name, $user->id));
        });
    }
}
