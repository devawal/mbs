<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TransactionCode extends Model
{
    protected $table = 'transaction_code';
    protected $primaryKey = 'trcode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name', 
                    'is_active'
                ];
}
