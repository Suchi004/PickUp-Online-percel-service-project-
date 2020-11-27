<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Division;
use App\Models\District;
use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

/**
     * @override.
     *
     * ShowRegistrationForm
     * Display regiatration form
     *
     */

    public function ShowRegistrationForm(){
        $divisions=Division :: orderBy('priority','asc')->get();
        $districts=District :: orderBy('id','asc')->get();
        return view('auth.register',compact('divisions','districts'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name'  => ['required', 'string', 'max:30'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no'   => ['required', 'string', 'max:15'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
             'street_address'  => ['required', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $user=User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Str::slug($request->first_name,$request->last_name),
            'phone_no' => $request->phone_no,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'street_address'=>$request->street_address,
            'ip_address'=>request()->ip(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' =>Str::random(50),
            'status'=>  0,
            ]);
        $user->notify(new VerifyRegistration($user));

        session()->flash('success','A confirmation email has sent...please check email and confirm your mail..');
        return redirect('/');

    }
}
