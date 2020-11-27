
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">
      <div class="card-header">Add District</div>
<form action="{{ Route('admin.district.store')}}"method="post" enctype="multipart/form-data">
  {{ csrf_field()}}
  @include('admin.partials.messages')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter District Name">
    

  <div class="form-group">
    <label for="exampleInputEmail1">Select Division</label>
    <select class="form-control" name="division_id">
      <option value="">Please Select a Division for the district</option>
      @foreach(App\Models\Division::orderBy('name','asc')->get() as $division)
         <option value="{{ $division->id }}">{{ $division->name}}</option>

     @endforeach
    </select>
  </div>
 
<button type="submit" class="btn btn-primary">Add District</button>
</form>
</div>
        

 </div>
 </div>
 @endsection