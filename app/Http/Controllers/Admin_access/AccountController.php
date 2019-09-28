<?php

namespace App\Http\Controllers\Admin_access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\Account;
use App\Models\Account\Transaction;
use Session;
use Auth;

class AccountController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return Response
     */
    public function depositIndex()
    {
        $title = "Deposit money";
        
        return view('admin_access.deposit.index', compact('title'));
    }

    /**
     * Render deposit form
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function depositForm(Request $request)
    {
        $card_type = $request->get('card_type');

        return view('admin_access.deposit.form', compact('card_type'));
    }

    /**
     * Post deposit to account
     *
     * @param Request $request
     * @return json
     */
    public function postDeposit(Request $request)
    {
        $data = $request->all();
        $tran = Transaction::depositMoney($data);

        if ($tran) {
            return response()->json(['flag' => 1, 'message' => 'Deposit successfully']);
        }
        return response()->json(['flag' => 0, 'message' => 'Something went wrong, please try again later!']);
    }

    /**
     * Show the fund transfer page.
     *
     * @return Response
     */
    public function fundTransfer()
    {
        $title = "Fund Transfer";
        $account = Account::where('user_id', Auth::user()->id)->first();
        
        return view('admin_access.fund_transfer.index', compact('title', 'account'));
    }

    /**
     * Return the account balance with currency
     *
     * @param Request $request
     * @return json
     */
    public function getBalance(Request $request)
    {
        $data = array();
        $account = Account::where('account_number', $request->get('account_id'))->first();
        if (!empty($account)) {
            $data = array('balance' => $account->current_balance, 'currency' => ucfirst($account->currency));
        }
        
        return response()->json($data);
    }

    /**
     * Transfer money
     *
     * @param  array  $request
     * @return Response
     */
    public function postTransfer(Request $request)
    {
        $this->validate($request, [
            'from_account'  => 'required',
            'to_account'    => 'required',
            'amount'        => 'required',
            'remerks'       => 'required',
        ]);
        
        $data = $request->all(); //echo '<pre>';print_r($data);exit;
        $tran = Transaction::transferMoney($data);
        if ($tran) {
            Session::flash('success', 'Transfer successfully');
            return redirect()->back();
        }

        Session::flash('error', 'Something went wrong, please try again later!');
        return redirect()->back();
    }

}