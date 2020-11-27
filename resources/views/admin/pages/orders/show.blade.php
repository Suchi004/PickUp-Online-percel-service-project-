@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper">
  <div class="card">
    <div class="card-header">View Orders #PU{{ $order->id }}</div>
    <div class="card-body">
    @include('admin.partials.messages')
    <h3>Order Information</h3>
    <div class="row">
      <div class="col-md-6 border-right">
        <p><strong>Orderer Name : </strong>{{$order->name}}</p>
          <p><strong>Orderer Phone : </strong>{{$order->phone_no}}</p>
            <p><strong>Orderer Email : </strong>{{$order->email}}</p>
              <p><strong>Orderer Shipping Address : </strong>{{$order->shipping_address}}</p>
      </div>
      <div class="col-md-6">
       <p> <strong> Order Payment Method : </strong>{{$order->payment->name}} </p>
        <p> <strong> Order Payment Transaction: </strong>{{$order->transaction_id}} </p>
      </div>
    </div>
    <hr>
    <h3>Ordered Items :</h3>
    @if($order->carts->count() >0)
    <table class="table table-bordered table-stripe">
    <thead>
     <tr>
         <th>No.</th>
         <th>Post Title</th>
         <th>Post Image</th>
          <th>Post Quantity</th>
         <th>Action</th>
         <th>Unit Price</th>
          <th>Sub-total Price</th>
     </tr>
    </thead>
    <tbody>
    	@php
    	$total_price= 0;
    	@endphp
      @foreach($order->carts as $cart)

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
             <input type="number" name="product_quantity" class="form-control " value="{{$cart->product_quantity}}">
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
 @endif
 <hr>
 <form  action="{{route('admin.order.completed',$order->id)}}"  style="display:inline-block ! important;" method="post">
   @csrf
  @if($order->is_completed)
   <input type="submit" name="" value="Cancel Order" class="btn btn-danger">
   @else
    <input type="submit" name="" value="Complete Order" class="btn btn-success">
    @endif

 </form>

 <form  action="{{route('admin.order.paid',$order->id)}}"  style="display:inline-block ! important;" method="post">
   @csrf
   @if($order->is_paid)
    <input type="submit" name="" value="Cancel Payment" class="btn btn-danger">
    @else
     <input type="submit" name="" value="Paid Order" class="btn btn-success">
     @endif

 </form>


  </div>
</div>
</div>
  @endsection
