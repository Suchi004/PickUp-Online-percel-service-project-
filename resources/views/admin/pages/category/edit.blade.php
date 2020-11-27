
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Edit Category</div>
    <form action="{{ Route('admin.category.update',$category->id)}}"method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
      @include('admin.partials.messages')
   <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  value="{{$category->name}}">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description(Optional)</label>
    <textarea name="description" rows="8" cols="8" class="form-control" {!! $category->description !!}></textarea>
  </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Parent Category(optional)</label>
    <select class="form-control" name="parent_id">
      <option value=" " placeholder="Please Select a Parent category">select</option>
     @foreach($main_categories as $cat)
     <option value="{{ $cat->id}}" {{$cat->id==$category->parent_id?'selected':''}}> {{ $cat->name }}</option>
     @endforeach
    </select>
  </div>
 
  <div class="form-group">
    <label for="image">Category Old Image</label><br/>
     <img src="{!!asset('images/categories/'. $category->image)!!}" width='100'><br/>
     <label for="image">Category New Image(Optional)</label>
    <input type="file" class="form-control" name="image" id="image">

  </div>
  
  <button type="submit" class="btn btn-success">Update Category</button> 
</form>
</div>
        

 </div>
 </div>
 @endsection