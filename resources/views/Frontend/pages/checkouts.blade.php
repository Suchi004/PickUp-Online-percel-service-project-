@extends('frontend.layouts.master')
@section('content')
<div class="card card-body container margin-top-20">
<div class="card card-body">
<h2>Confirm Items</h2>
<hr>
<div class="row">
<div class="col-md-7 border-right">
@foreach(App\Models\Cart::totalCarts() as $cart)

<p>{{$cart->post->title}} -
<strong>{{$cart->post->price}} taka</strong>
- {{$cart->post_quantity}} item
</p>

@endforeach
</div>
<div class="col-md-5">
  @php
  $total_price= 0;
  @endphp
  @foreach(App\Models\Cart::totalCarts() as $cart)
  @php
  $total_price+=$cart->post->price * $cart->post_quantity;
  @endphp
  @endforeach
  <p>Total Price : <strong>{{$total_price}}</strong> taka </p>
    <p>Total Price with Shipping Cost : <strong>{{ $total_price + App\Models\Setting::first()->Shipping_cost}}</strong> taka </p>

</div>
</div>
<p>
<a href="{{route('carts')}}">Change Cart Items </a>
</p>
</div>

<div class="card card-body mt-2 ">
  <h2>Confirm Shipping Address </h2>
<hr>
<form method="POST" action="{{ route('checkout.store') }}">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('first_Name') is-invalid @enderror" name="name" value="{{Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name:'' }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

<div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::check() ? Auth::user()->email:'' }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

        <div class="col-md-6">
            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{Auth::check() ? Auth::user()->phone_no:'' }}" required autocomplete="phone_no">

            @error('phone_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


      <div class="form-group row">
        <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address (Optional)') }}</label>

        <div class="col-md-6">
            <textarea id="shipping_address"  class="form-control @error('shipping_address') is-invalid @enderror" rows="4" name="shipping_address">{{Auth::check() ? Auth::user()->shipping_address:'' }}</textarea>

            @error('shipping_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
      <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message (Optional)') }}</label>

      <div class="col-md-6">
          <textarea id="message"  class="form-control @error('message') is-invalid @enderror" rows="4" name="message"></textarea>

          @error('message')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
  </div>

    <div class="form-group row">
      <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>
       <div class="col-md-6">
        <select class="form-control" name="payment_method_id" required id="payments">
          <option value="">Please select a payment method.</option>
          @foreach ($payments as $payment)
            <option value="{{$payment->short_name}}">{{$payment->name}}</option>
          @endforeach
         </select>
         @foreach ($payments as $payment)

          @if($payment->short_name=="cash_in")
          <div id="payment-{{$payment->short_name}}" class="alert alert-success text-center hidden mt-2">
           <div>
             <h3>For cash in there is nothing necessary.Just click finish order.</h3>
             <br>
             <small>You will get your Product within two or three business days.</small>

           </div>
           </div>

           @else
           <div id="payment-{{$payment->short_name}}" class=" alert alert-success text-center hidden mt-2">
           <div>
             <h3>{{$payment->name}} Payment </h3>
             <p><strong>{{$payment->name}} No : {{$payment->no}}</strong>
             <br>
             <strong>Account Type : {{$payment->type}} </strong>
             </p>
             <div class="alert alert-success">
               Please send the money in this bkash number and give the transaction id below.
               </div>

             </div>
           </div>
         @endif
         @endforeach
         <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden"  placeholder="Enter Transaction ID">
       </div>
  </div>
  <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary">
              {{ __('Done') }}
          </button>
      </div>
  </div>
</form>

</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
 $("#payments").change(function(){
   $payment_method= $("#payments").val();
   if ( $payment_method =="cash_in") {
     $("#payment-cash_in").removeClass('hidden');
     $("#payment-bkash").addClass('hidden');
      $("#payment-rocket").addClass('hidden');
   }else if ($payment_method =="bkash") {
     $("#payment-bkash").removeClass('hidden');
     $("#payment-cash_in").addClass('hidden');
     $( "#payment-rocket").addClass('hidden');
      $("#transaction_id").removeClass('hidden');
   }else if ($payment_method =="rocket"){
     $("#payment-rocket").removeClass('hidden');
     $("#payment-bkash").addClass('hidden');
     $("#payment-cash_in").addClass('hidden');
     $("#transaction_id").removeClass('hidden');

   }
 })
</script>
@endsection
