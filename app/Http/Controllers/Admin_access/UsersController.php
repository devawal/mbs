<?php

namespace App\Http\Controllers\Admin_access;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserDetails;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use Session;
use Storage;
use Validator;
use DB;
use Auth;
use Hash;

class UsersController extends Controller
{
    /**
     * Show the user profile.
     *
     * @param $request
     * @param $id
     * @return Response
     */
    public function userProfile(Request $request)
    {
        $data['title']      = "User prifile";
        $data['user_info']  = Auth::user();

        return view('admin_access.user.profile')->with($data);
    }

    /**
     * Update user password.
     *
     * @param $request
     * @return Response
     */
    public function updateUserPassword(Request $request)
    {
        $validator = $this->validate($request, [
            'password'    => 'required|min:6'
        ]);

        $currPass = $request->get('currentpassword');
        $user = Auth::user();

        $hash = DB::table('users')->where('id', $user->id)->select('password')->first();
        if (!Hash::check($currPass, $hash->password)) {
            Session::flash('error', 'Password not match!');
            return redirect()->back();
        }

        $user = User::find($user->id);
        $user->password = bcrypt($request->get('password'));
        $user->save();

        Session::flash('success', 'User password successfully!!');
        return redirect()->back();
    }
}