<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartsController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request,[
            'post_id'=>'required'],
            [
             'post_id.required'=>'Please give a post.'
            ]);

        if(Auth::check()){
        $cart=Cart::where('user_id',Auth::id())
        ->where('post_id',$request->post_id)
        ->where('order_id',NULL)
        ->first();
        }else{

        $cart=Cart::Where('ip_address',request()->ip())
        ->where('post_id',$request->post_id)
          ->where('order_id',NULL)
        ->first();
        }

        if(!is_null($cart)){
         $cart->increment('post_quantity');
        }
        else{
        $cart=new Cart();
        if(Auth::check()){
        $cart->user_id=Auth::id();

        }
        $cart->ip_address=request()->ip();
        $cart->post_id=$request->post_id;
        $cart->save();
    }
        return  json_encode(['status'=>'success','Message'=>'Item Added to Cart','totalItems'=>Cart::totalItems()]);



    }




}
