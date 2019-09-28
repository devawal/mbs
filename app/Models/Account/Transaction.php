<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account\Account;
use App\Models\Account\AccountLedger;
use Auth;
use DB;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'trid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'account_id', 
                    'amount', 
                    'currency', 
                    'trcode', 
                    'tr_time', 
                    'card_number', 
                    'card_type', 
                    'bank_acc_number', 
                    'remarks', 
                    'user_id', 
                    'created_by'
                ];

    /**
     * Deposit money
     *
     * @param array $data
     * @return boolean
     */
    public static function depositMoney($data)
    {
        try {
            DB::beginTransaction();

            $userID = Auth::user()->id;
            $accountDetails = Account::where('user_id', $userID)->first();
            $processing_fee = ($data['amount']*1.75)/100;
            $debit_amount   = ($data['amount'] - $processing_fee) + $accountDetails->current_balance;

            $transaction                = new Transaction();
            $transaction->account_id    = $accountDetails->account_number;
            $transaction->amount        = $data['amount'];
            $transaction->currency      = $accountDetails->currency;
            $transaction->trcode        = 1; // transaction code is 1 for deposit
            $transaction->tr_time       = date('Y-m-d H:i:s');
            $transaction->card_number   = $data['card_number'];
            $transaction->card_type     = $data['card_type'];
            $transaction->user_id       = $userID;
            $transaction->created_by    = $userID;
            $transaction->save();

            // Ledger entry for deposit
            $ledger                     = new AccountLedger();
            $ledger->account_id         = $accountDetails->account_number;
            $ledger->trid               = $transaction->trid;
            $ledger->trcode             = 1; // transaction code is 1 for deposit;
            $ledger->dr_amount          = $data['amount'] - $processing_fee;
            $ledger->is_active          = 1;
            $ledger->created_by         = $userID;
            $ledger->save();

            // Ledger entry for service change
            $ledger                     = new AccountLedger();
            $ledger->account_id         = $accountDetails->account_number;
            $ledger->trid               = $transaction->trid;
            $ledger->trcode             = 3; // transaction code is 3 for service charge;
            $ledger->cr_amount          = $processing_fee;
            $ledger->is_active          = 1;
            $ledger->created_by         = $userID;
            $ledger->save();

            // Update Account current balance
            $account = Account::where('user_id', $userID)->update(['current_balance' => $debit_amount]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    /**
     * Transfer money
     *
     * @param array $data
     * @return boolean
     */
    public static function transferMoney($data)
    {
        try {
            DB::beginTransaction();

            $userID = Auth::user()->id;
            $accountDetails = Account::where('user_id', $userID)->first();
            $debit_amount   = $accountDetails->current_balance - $data['amount'];

            $transaction                = new Transaction();
            $transaction->account_id    = $accountDetails->account_number;
            $transaction->amount        = $data['amount'];
            $transaction->currency      = $accountDetails->currency;
            $transaction->trcode        = 2; // transaction code is 2 for Withdraw
            $transaction->tr_time       = date('Y-m-d H:i:s');
            $transaction->bank_acc_number = $data['to_account'];
            $transaction->user_id       = $userID;
            $transaction->remarks       = $data['remerks'];
            $transaction->created_by    = $userID;
            $transaction->save();

            // Ledger entry for deposit
            $ledger                     = new AccountLedger();
            $ledger->account_id         = $accountDetails->account_number;
            $ledger->trid               = $transaction->trid;
            $ledger->trcode             = 2; // transaction code is 2 for Withdraw;
            $ledger->cr_amount          = $data['amount'];
            $ledger->is_active          = 1;
            $ledger->created_by         = $userID;
            $ledger->save();

            // Update Account current balance
            $account = Account::where('user_id', $userID)->update(['current_balance' => $debit_amount]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    /**
     * Withdraw money
     *
     * @param array $data
     * @return boolean
     */
    public static function withdrawMoney($data)
    {
        try {
            DB::beginTransaction();

            $userID = Auth::user()->id;
            $accountDetails = Account::where('user_id', $userID)->first();
            $processing_fee = ($data['amount']*2.5)/100;
            $current_amount = $accountDetails->current_balance - ($data['amount'] + $processing_fee);

            $transaction                = new Transaction();
            $transaction->account_id    = $accountDetails->account_number;
            $transaction->amount        = $data['amount'];
            $transaction->currency      = $accountDetails->currency;
            $transaction->trcode        = 2; // transaction code is 2 for Withdraw
            $transaction->tr_time       = date('Y-m-d H:i:s');
            $transaction->bank_acc_number = $data['to_account'];
            $transaction->user_id       = $userID;
            $transaction->created_by    = $userID;
            $transaction->save();

            // Ledger entry for Withdraw
            $ledger                     = new AccountLedger();
            $ledger->account_id         = $accountDetails->account_number;
            $ledger->trid               = $transaction->trid;
            $ledger->trcode             = 2; // transaction code is 2 for Withdraw
            $ledger->dr_amount          = $data['amount'] - $processing_fee;
            $ledger->is_active          = 1;
            $ledger->created_by         = $userID;
            $ledger->save();

            // Ledger entry for service change
            $ledger                     = new AccountLedger();
            $ledger->account_id         = $accountDetails->account_number;
            $ledger->trid               = $transaction->trid;
            $ledger->trcode             = 3; // transaction code is 3 for service charge;
            $ledger->cr_amount          = $processing_fee;
            $ledger->is_active          = 1;
            $ledger->created_by         = $userID;
            $ledger->save();

            // Update Account current balance
            $account = Account::where('user_id', $userID)->update(['current_balance' => $current_amount]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
