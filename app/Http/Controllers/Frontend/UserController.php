<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;
use Image;
use File;
use Cache;
use Carbon\Carbon;

class UserController extends Controller
{

	   public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
    	$user=Auth::user();
    	return view('Frontend.pages.users.dashboard',compact('user'));
    }

      public function profile(){
      	$divisions=Division :: orderBy('priority','asc')->get();
        $districts=District :: orderBy('id','asc')->get();
    	  $user=Auth::user();
    	return view('Frontend.pages.users.profile',compact('user','divisions','districts'));
    }

     public function update(Request $request){
     	$user=Auth::user();
     	$this->validate($request,[
            'first_name' => ['required', 'string', 'max:30'],
            'last_name'  => ['required', 'string', 'max:30'],
            'last_name'  => ['required', 'alpha_dash', 'max:30', 'unique:users,username,'.$user->id],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_no'   => ['required', 'string', 'max:15','unique:users,phone_no,'.$user->id],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'street_address'  => ['required', 'max:100'],
						'avatar'  =>'nullable|image',
            ]);

     	$user->first_name=$request->first_name;
     	$user->last_name=$request->last_name;
     	$user->username=$request->username;
     	$user->email=$request->email;
     	$user->email=$request->email;
     	$user->phone_no=$request->phone_no;
     	$user->division_id=$request->division_id;
     	$user->district_id=$request->district_id;
     	$user->street_address=$request->street_address;
     	$user->shipping_address=$request->shipping_address;
     	$user->ip_address=request()->ip();
			if($request->hasFile('avatar')){
			$image=$request->file('avatar');
			$img=time().'.'.$image->getClientOriginalExtension();
			$location =public_path('images/users/'.$img);
			Image::make($image)->save($location);
			$user->image=$img;
}
     	if($request->password !=NULL || $request->password !="" ){
     		$user->password = Hash::make($request->password);
     	}

     	$user->save();
     	session()->flash('success','Your profile is updated successfully!!');
         return back();
    }

		public function show($id){

        $user = User::where('id',$id)->first();
				if(!is_null($id)){

            return view('frontend.pages.users.show',compact('user'));
        }
        else{
            session()->flash('Errors','Sorry! There is no user with this URL...');
            return redirect()->route('index');
        }
    }

}
