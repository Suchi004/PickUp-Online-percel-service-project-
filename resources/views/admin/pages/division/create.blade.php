
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Add Division</div>
<form action="{{ Route('admin.division.store')}}"method="post" enctype="multipart/form-data">
  {{ csrf_field()}}
  @include('admin.partials.messages')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Division Name">
    
  </div>
   <div class="form-group">
    <label for="priority">Priority</label>
    <input type="number" class="form-control" name="priority" id="priority" aria-describedby="emailHelp" placeholder="Enter Division priority">
    
  </div>
 
<button type="submit" class="btn btn-primary">Add Division</button>
</form>
</div>
        

 </div>
 </div>
 @endsection