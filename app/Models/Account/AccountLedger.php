<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AccountLedger extends Model
{
    protected $table = 'ac_ledger';
    protected $primaryKey = 'ledger_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'account_id', 
                    'trid', 
                    'trcode', 
                    'cr_amount', 
                    'dr_amount', 
                    'is_active', 
                    'created_by'
                ];
}
