<?php

namespace App\Http\Controllers\Admin_access;

use App\Http\Controllers\Controller;
use App\Models\Account\Account;
use Auth;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return Response
     */
    public function getIndex()
    {
        $title = "Dashboard";
        $account = Account::where('user_id', Auth::user()->id)->first();
        
        return view('admin_access.dashboard', compact('title', 'account'));
    }
}