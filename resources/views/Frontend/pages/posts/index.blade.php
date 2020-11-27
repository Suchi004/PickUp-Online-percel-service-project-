
@extends('Frontend.layouts.master')
@section('content')

<div class="container margin-top-20">
<div class="row">

  <div class="col-md-12">
  <div class="card">
     <div class="card-body">

      <div class="card-header">My Posts</div>
       @include('Frontend.partials.messages')
<table class="table table-hover table-striped" id="dataTable">
  <thead>
    <tr>
     <th>#</th>
     <th>By whom Posted</th>
     <th>Post Code</th>
     <th>Title</th>
      <th>Image</th>
     <th>Description</th>
     <th>Address</th>
     <th>Charge</th>
     <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
       <td>{{$loop->index+1}}</td>
       <td> <a href="{{route('user.show',$post->user->id)}}">{{ $post->user->first_name }}</a></td>
       <td>PPU{{ $post->id }}</td>
       <td>{{ $post->title }}</td>
       <td>
           @foreach($post->images as $image)
           <img src="{{ asset('images/products/'. $image->image)}}" width="30">
         @endforeach </td>
        <td>{{ $post->description }}</td>
        <td><p>{{$post->source_stoppage}}</p></td>
       <td>{{ $post->price }}</td>
       <td><a href="{{route('post.show',$post->slug)}}" class="btn btn-outline-success">View Post</a>
            @include('Frontend.pages.partials.cart-button')
         </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>#</th>
      <th>By whom Posted</th>
      <th>Post Code</th>
      <th>Title</th>
      <th>Description</th>
      <th>Address</th>
      <th>Charge</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>


</div>
 </div>
</div>
 </div>
 </div>
 @endsection
