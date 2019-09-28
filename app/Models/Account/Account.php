<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'account_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'account_number', 
                    'account_type', 
                    'personal_code', 
                    'current_balance', 
                    'currency', 
                    'user_id', 
                    'is_active'
                ];

    /**
     * Create new account
     *
     * @param array $data
     * @return void
     */
    public static function createNewAccount($data)
    {
        $user               = new User();
        $user->first_name   = $data['first_name'];
        $user->last_name    = $data['last_name'];
        $user->email        = $data['email'];
        $user->password     = bcrypt($data['password']);
        $user->is_active    = 1;
        $user->save();

        $userID = $user->id;

        $account                    = new Account();
        $account->account_number    = '210'.rand(111,999).time();
        $account->account_type      = 'GENERAL';
        $account->personal_code     = $data['code'];
        $account->current_balance   = 0;
        $account->currency          = 'euro';
        $account->user_id           = $userID;
        $account->is_active         = 1;
        $account->save();
    }
}
