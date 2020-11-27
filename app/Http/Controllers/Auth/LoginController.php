<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo ='/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Find User by this email
        $user=User::where('email',$request->email)->first();

        if($user->status==1){
            //user log in
            if(Auth::guard('web')->attempt(['email' =>$request->email,'password'=>$request->password],$request->remember))
            {
                //log him now
                return redirect()->intended(route('index'));
            }
            else{
                session()->flash('error','Invalid login!!');
                return redirect()->route('login');
            }
        }
        else{
          // send him a token again
            if(!is_null($user)){
                $user->notify(new VerifyRegistration($user));
                session()->flash('success','A New confirmation email has sent...please check email and confirm your mail..');
                return redirect('/');
            }
            else
            {
                session()->flash('error','Please log in first !!');
                return redirect()->route('login');
            }
        }
    }
}
