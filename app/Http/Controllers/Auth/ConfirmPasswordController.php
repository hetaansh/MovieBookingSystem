<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Operator;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */
    public function adminCreate(Request $request)
    {   
        $uname = 'admin';
        return view('auth.passwords.reset', ['request' => $request],compact('uname'));
    }

    public function operatorCreate(Request $request)
    {   
        $uname = 'operator';
        return view('auth.passwords.reset', ['request' => $request],compact('uname'));
    }

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth:admin');
        $this->middleware('auth:operator');
    }



       /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
       ]);

       $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
       ])->first();

       if(!$check_token){
           return back()->withInput()->with('fail', 'Invalid token');
       }else{
           Admin::where('email', $request->email)->update([
               'password'=>\Hash::make($request->password)
           ]);

           \DB::table('password_resets')->where([
               'email'=>$request->email
           ])->delete();

           return redirect()->route('admin')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
       }
}

public function operatorStore(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:operators,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
       ]);

       $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
       ])->first();

       if(!$check_token){
           return back()->withInput()->with('fail', 'Invalid token');
       }else{
           Operator::where('email', $request->email)->update([
               'password'=>\Hash::make($request->password)
           ]);

           \DB::table('password_resets')->where([
               'email'=>$request->email
           ])->delete();

           return redirect()->route('operator')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
       }
}

 
}
