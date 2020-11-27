@extends('admin.layouts.master')

 <!-- Start Sidebar + content  -->
 @section('content')
  <div class="content-wrapper">

   <div class="row">


    <div class="col-md-4">

    </div>


  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    @php $i=1; @endphp
    @foreach($post->images as $image)
    <div class="product-item carousel-item {{$i==1?'active':''}}">
      <img class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image)}}" alt="First slide">
    </div>
     @php $i++; @endphp
    @endforeach


  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
  </div>

         <div class="col-md-4 ">
          <div class="widget">
             <h3>Title : {{$post->title}}</h3>
             <div class="mt-3">
             <p> <h5><strong>Category: </strong>{{$post->category->name}}</h5></p>
             <p><h5><strong>Charge :</strong>{{$post->price}} Taka</h5></p>
           </div>
            <hr>
              <div class="post-description"><h5><strong>Description: </strong>{{$post->description}}<h5></div>
              <div class="post-description"><h5><strong>Source Address: </strong>{{$post->source_stoppage}},<h5></div>
          </div>
         </div>
  </div>
   </div>

@endsection
