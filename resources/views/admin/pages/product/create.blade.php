
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Add Product</div>
<form action="{{ Route('admin.product.store')}}"method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  @include('admin.partials.messages')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product Name">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea name="description" rows="8" cols="8" class="form-control"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price">
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quantity">
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Select Category</label>
    <select class="form-control" name="category_id">
      <option value="">Please Select a category for the product</option>
      @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent)
         <option value="{{ $parent->id }}">{{ $parent->name}}</option>

      @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',$parent->id)->get() as $child )
          <option value="{{ $child->id }}">___{{ $child->name}}</option>
     @endforeach
     
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Select Brand</label>
    <select class="form-control" name="brand_id">
      <option value="">Please Select a brand for the product</option>
      @foreach(App\Models\Brand::orderBy('name','asc')->get() as $brand)
         <option value="{{ $brand->id }}">{{ $brand->name}}</option>

     @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="product_image">Product Image</label>
      <div class="row">
       <div class="col-md-4">
         <input type="file" class="form-control" name="product_image[]" id="product_image">
       </div>

       <div class="col-md-4">
         <input type="file" class="form-control" name="product_image[]" id="product_image">
       </div>

       <div class="col-md-4">
         <input type="file" class="form-control" name="product_image[]" id="product_image">
       </div>
      </div>
    
  </div>
  
  <button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>
        

 </div>
 </div>
 @endsection