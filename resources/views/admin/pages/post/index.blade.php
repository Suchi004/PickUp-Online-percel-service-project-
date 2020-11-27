
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">

      <div class="card-header">Manage Posts</div>
       @include('admin.partials.messages')
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
       <td><a href="{{route('admin.posts.show',$post->slug)}}" class="btn btn-outline-success">View Post</a>
         <a href="#deleteModal{{$post->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
         <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{!! route('admin.posts.delete',$post->id) !!}"  method="post">
          {{ csrf_field() }}
             <button type="submit" class="btn btn-danger">Permanent Delete</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>

      </div>
    </div>
  </div>
  </div>
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

 @endsection
