@extends('Frontend.layouts.master')
@section('content')
<div class="wrapper">
<div class="container margin-top-20">
  <div class="row">

    <div class="col-md-12">
  <div class="card">
     <div class="card-body">
      <div class="card-header"><h3>Add Post</h3></div>
     <form action="{{ Route('post.store')}}"method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  @include('Frontend.partials.messages')
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Post Title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea name="description" rows="8" cols="8" class="form-control"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Charge</label>
    <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Charge">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="number" class="form-control" name="weight" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight in kg">

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quantity">

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control" name="user_phone_no" value="">

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" name="user_email" value="">

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
    <label for="exampleInputEmail1">Select Source Division</label>
    <select class="form-control" name="source_division_id" id="division_id">
      <option value="">Please Select a Division</option>
      @foreach(App\Models\Division::orderBy('name','asc')->get() as $division)
         <option value="{{ $division->id }}">{{ $division->name}}</option>

     @endforeach
    </select>
  </div>


  <div class="form-group">

    <label for="exampleInputEmail1">Select Source District</label>
    <select class="form-control" name="source_district_id" id="district_id">

    </select>
  </div>


  <div class="form-group">
  <label for="exampleInputEmail1">Source Stoppage</label>
  <input type="text" class="form-control" name="source_stoppage" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Source Stoppage">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Select Destination Division</label>
  <select class="form-control" name="destination_division_id" id="division_id">
    <option value="">Please Select a Division</option>
    @foreach(App\Models\Division::orderBy('name','asc')->get() as $division)
       <option value="{{ $division->id }}">{{ $division->name}}</option>

   @endforeach
  </select>
</div>




<div class="form-group">
  <label for="exampleInputEmail1">Select Destination District</label>
  <select class="form-control" name="destination_district_id" id="district_id">
    <option value="">Please Select a District</option>
    @foreach(App\Models\District::orderBy('name','asc')->get() as $district)
       <option value="{{ $district->id }}">{{ $district->name}}</option>

   @endforeach
  </select>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Destination Stoppage</label>
<input type="text" class="form-control" name="destination_stoppage" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Destination Stoppage">

</div>


  <div class="form-group">
    <label for="product_image">Image</label>
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

  <button type="submit" class="btn btn-primary">Add Post</button>
</form>
</div>
</div>
</div>
</div>

</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script>
$("#division_id").change(function(){
  var division=$("#division_id").val();
  //Send an ajax request to server with this divison
  $("#district_id").html("");
  var option ="";
  $.get( "http://localhost/PU/public/get-dictricts/"+division,
   function( data ) {
     data= JSON.parse(data);
     data.forEach( function(element){
        option+="<option value='"+ element.id +"'>"+element.name+"</option>";
     });

     $("#district_id").html(option);
   });
});
</script>

@endsection
