<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('frontend.pages.carts');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'post_id'=>'required'],
            [
             'post_id.required'=>'Please give a post.'
            ]);


          if(Auth::check())  {
                $cart=Cart::where('user_id',Auth::id())
               ->where('post_id',$request->post_id)
               ->where('order_id',NULL)
               ->first();
             }else{
               $cart=Cart::where('ip_address',request()->ip())
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

      }else{
        $cart->ip_address=request()->ip();
      }
        $cart->post_id=$request->post_id;
        $cart->save();
    }
        session()->flash('success','post is added to cart');
        return back();



    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart=Cart::find($id);
        if(!is_null($cart)){
            $cart->post_quantity=$request->post_quantity;
            $cart->save();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('success','Your cart has updated successfully!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $cart=Cart::find($id);
        if(!is_null($cart)){
            $cart->delete();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('success','cart Item has deleted successfully!!');
        return back();
    }
}
