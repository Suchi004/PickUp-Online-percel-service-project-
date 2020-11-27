
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Edit District</div>
    <form action="{{ Route('admin.district.update',$district->id)}}"method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
      @include('admin.partials.messages')
   <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name"  value="{{$district->name}}">
    
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Select Divison</label>
    <select class="form-control" name="division_id">
      <option value="">Please Select a division for the district</option>
      @foreach(App\Models\Division::orderBy('name','asc')->get() as $br)
         <option value="{{ $br->id }}" {{ $br->id == $district->division->id  ? 'selected' : ''}}>{{ $br->name}}</option>

     @endforeach
    </select>
  </div>

  
  <button type="submit" class="btn btn-success">Update district</button> 
</form>
</div>
        

 </div>
 </div>
 @endsection