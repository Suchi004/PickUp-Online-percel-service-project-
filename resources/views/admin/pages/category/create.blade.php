
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Add Category</div>
<form action="{{ Route('admin.category.store')}}"method="post" enctype="multipart/form-data">
  {{ csrf_field()}}
  @include('admin.partials.messages')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Category Name">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea name="description" rows="8" cols="8" class="form-control"></textarea>
  </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Parent Category(optional)</label>
    <select class="form-control" name="parent_id">
      <option value="" placeholder="Please Select a Parent category">Select</option>
     @foreach($main_categories as $category)
     <option value="{{ $category->id}}"> {{ $category->name }}</option>
     @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="image">Category Image(optional)</label>
      
         <input type="file" class="form-control" name="image" id="image">

  </div>
  
  <button type="submit" class="btn btn-primary">Add Category</button>
</form>
</div>
        

 </div>
 </div>
 @endsection