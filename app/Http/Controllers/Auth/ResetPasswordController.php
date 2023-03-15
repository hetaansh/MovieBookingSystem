<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;



    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showAdminResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('auth.passwords.email')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }



    public function showOperatorResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('auth.passwords.email')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

        /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function sendAdminResetForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);

        $action_link = route('admin.password.confirm',['token'=>$token,'email'=>$request->email]);

        $body = "We have received a request to reset the password for <b>Admin</b> account associated with ".$request->email.". You can reset your password by clicking the link below.";
        
        \Mail::send('email-forget',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
            $message->from('noreply@example.com', 'Your App Name');
            $message->to($request->email, 'Admin Name')
                    ->subject('Reset Password');
       });

    
    }

    public function sendOperatorResetForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:operators,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);

        $action_link = route('operator.password.confirm',['token'=>$token,'email'=>$request->email]);

        $body = "We have received a request to reset the password for <b>Operator</b> account associated with ".$request->email.". You can reset your password by clicking the link below.";
        
        \Mail::send('email-forget',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
            $message->from('noreply@example.com', 'Your App Name');
            $message->to($request->email, 'Operator Name')
                    ->subject('Reset Password');
       });

       
    
    }
}
