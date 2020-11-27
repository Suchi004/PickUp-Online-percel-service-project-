<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;


class CheckoutsController extends Controller
{
    public function index(){
      $payments=Payment::orderBy('priority','asc')->get();
    	 return view('Frontend.pages.checkouts',compact('payments'));
    }


    public function store(Request $request){
      $this->validate($request,[
        'name'=>'required',
        'phone_no'=>'required',
        'shipping_address'=>'required',
        'payment_method_id'=>'required'
      ]);

      $order=new Order();
      //check transaction ID given or not
      if($request->payment_method_id !='cash_in'){
        if($request->transaction_id == NULL || empty($request->transaction_id))
        {
           session()->flash('error','Please Enter Transaction ID..');
           return back();
        }
      }
      $order->name=$request->name;
      $order->email=$request->email;
      $order->phone_no=$request->phone_no;
      $order->shipping_address=$request->shipping_address;
      $order->message=$request->message;
      $order->ip_address=request()->ip();
      $order->transaction_id=$request->transaction_id;
      if(Auth::check()){
        $order->user_id=Auth::id();
      }
      $order->payment_id=Payment::where('short_name',$request->payment_method_id)->first()->id;
      $order->save();
      foreach (Cart::totalCarts() as $cart) {
        $cart->order_id=$order->id;
        $cart->save();
      }
       session()->flash('success','Your order has been placed successfully||Admin will confirm it soon..');
      return redirect()->route('index');
}
}
