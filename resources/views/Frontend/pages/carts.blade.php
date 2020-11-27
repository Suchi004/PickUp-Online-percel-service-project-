@extends('frontend.layouts.master')
@section('content')
<div class='container margin-top-20'>
 <h2>My Cart Items</h2>
 @if(App\Models\Cart::totalItems() >0)
 <table class="table table-bordered table-stripe">
 <thead>
  <tr>
      <th>No.</th>
      <th>Title</th>
      <th>Image</th>
       <th>Product Quantity</th>
      <th>Action</th>
      <th>Unit Price</th>
       <th>Sub-total Price</th>
  </tr>
 </thead>
 <tbody>
 	@php
 	$total_price= 0;
 	@endphp
@foreach(App\Models\Cart::totalCarts() as $cart)

 <tr>
	<td>{{$loop->index+1 }}</td>
	<td>
		<a href="{{route('post.show',$cart->post->slug)}}">{{$cart->post->title}}</a>
	</td>
	<td>
		@if($cart->post->images->count()>0)
		<img src="{{asset('images/products/'.$cart->post->images->first()->image)}}" width="60px">
		@endif
	</td>
     <td>
         <form class="form-inline" action="{{route('carts.update',$cart->id)}}" method="post">
          @csrf
          <input type="number" name="post_quantity" class="form-control " value="{{$cart->post_quantity}}">
          <button type="submit" class="btn btn-success ml-1">Update</button>
          </form>
     </td>
<td>
      <form class="form-inline" action="{{route('carts.delete',$cart->id)}}" method="post">
       @csrf
       <input type="hidden" name="cart_id">
       <button type="submit" class="btn btn-danger">Delete</button>
        </form>
</td>
<td>
     {{$cart->post->price}} Taka
</td>

<td>
	@php
	$total_price +=$cart->post->price * $cart->post_quantity ;
	@endphp
  {{$cart->post->price * $cart->post_quantity }} Taka
</td>
</tr>
@endforeach
<tr>
<td colspan="4">
 <td>Total Amount:</td>
</td>
<td colspan="2"><strong>{{$total_price}}</strong></td>
</tr>
 </tbody>
 </table>

 <div class="col-md-12 text-right">
 	 <a href="{{route('posts')}}" class="btn btn-info btn-lg">Continue Picking..</a>
  <a href="{{route('checkouts')}}" class="btn btn-warning btn-lg">Checkout</a>
 </div>
 @else
 <div class="alert alert-warning">
   <strong>There is no Item in your cart</strong>
   <br>
 <a href="{{route('posts')}}" class="btn btn-info btn-lg">Continue Picking..</a>
 </div>
 @endif

</div>
 @endsection
