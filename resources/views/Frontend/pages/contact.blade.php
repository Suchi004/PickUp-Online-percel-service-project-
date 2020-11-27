@extends('Frontend.layouts.master')
<!-- Start Sidebar + content  -->
@section('content')
<div class="our-slider">

  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="{{ asset('images/contact.jpg') }}" class="d-block w-100" style="height:450px;">
      <div class="carousel-caption d-none d-md-block">
       <h3 style="color:#fff;">Contact Us</h3>

 </div>
    </div>

  </div>

</div>
<div class="container margin-top-20">
 <div class="row">

    <div class="col-md-6">
      <div class="widget">

         <h5><i class="fa fa-phone-square" aria-hidden="true"></i>   01775342345 </h5>
          <h5><i class="fa fa-envelope" aria-hidden="true"></i>      example@mail.com</h5>
          <h5><i class="fa fa-facebook-official" aria-hidden="true"></i>     www.facebook.com/pickup</h5>
          <h5><i class="fa fa-twitter" aria-hidden="true"></i>      www.twitter.com/pickup</h5>
          <h5><i class="fa fa-instagram" aria-hidden="true"></i>   www.instagram.com/pickup</h5>
          <h5><i class="fa fa-whatsapp" aria-hidden="true"></i>    01775342345</h5>




     </div>

     </div>

     <div class="col-md-6">
       <div class="widget">

          <h5 style="text-align: right;"> About Us </h5>
           <h5 style="text-align: right;"> <p>This is a Online parcel servicing website.It makes easy to send parcel from one place to another within short period</p> </h5>





      </div>

      </div>
</div>
   </div>
@endsection
