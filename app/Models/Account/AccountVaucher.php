<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class AccountVaucher extends Model
{
    protected $table = 'ac_vaucher';
    protected $primaryKey = 'vaucher_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'invoice_id', 
                    'vaucher_date', 
                    'user_id', 
                    'is_active', 
                    'created_by'
                ];
}
