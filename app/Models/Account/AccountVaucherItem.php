<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account\AccountPayment;
use Auth;
use DB;

class AccountVaucherItem extends Model
{
    protected $table = 'ac_voucher_item';
    protected $primaryKey = 'vci_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'vaucher_id', 
                    'particular_id', 
                    'amount', 
                    'discount', 
                    'vat', 
                    'comission', 
                    'service_charge', 
                    'total_amount', 
                    'currency', 
                    'is_active', 
                    'created_by'
                ];

}
