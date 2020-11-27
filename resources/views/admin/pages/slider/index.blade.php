
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
 <div class="card">
<div class="card-header">Manage Sliders</div>
      @include('admin.partials.messages')
      <a href="#addSliderModal" data-toggle="modal" class="btn btn-info float-right mb-2">
      <i class="fa fa-plus"></i> Add New Slider
      </a>
      <div class="clearfix"></div>
   <!--Add Slider Modal-->
      <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.slider.store')}}"  method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
           <label for="title">Slider Title <small class="text-danger">(required)</small> </label>
           <input type="text" class="form-control" name="title" id="title"  placeholder="Slider Title" required>
           </div>

           <div class="form-group">
            <label for="title">Slider Image <small class="text-danger">(required)</small> </label>
            <input type="file" class="form-control" name="image" id="image"  placeholder="SliderImage" required>
            </div>

            <div class="form-group">
             <label for="button_text">Slider Button Text <small class="text-info">(Optional)</small> </label>
             <input type="text" class="form-control" name="button_text" id="button_text"  placeholder="Button Text (If Needed)">
             </div>

             <div class="form-group">
              <label for="button_link">Slider Button Link <small class="text-info">(Optional)</small> </label>
              <input type="url" class="form-control" name="button_linkt" id="button_link"  placeholder="Button Link (If Needed)">
              </div>
              <div class="form-group">
               <label for="priority">Slider Button Text <small class="text-danger">(required)</small> </label>
               <input type="number" class="form-control" name="priority" id="priority"  placeholder="Priority"value="10" required>
               </div>

             <button type="submit" class="btn btn-success">Add New</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
  </div>

  <div class="card-body">
    <table class="table table-hover table-striped">
 <tr>
  <th>#</th>
  <th>Title</th>
  <th>Image</th>
  <th>Priority</th>
     <th>Action</th>
 </tr>

 @foreach($sliders as $slider)
 <tr>
    <td>#</td>
    <td>{{ $slider->name }}</td>
    <td> <img src="{{asset('images/sliders/'.$slider->image)}}" width="60"> </td>
    <td>{{ $slider->priority }}</td>
    <td><a href="#editSliderModal{{$slider->id}}" data-toggle="modal" class="btn btn-outline-success">Edit</a>
        <a href="#deleteModal{{$slider->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
        <!-- Delete Modal -->
     <div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <form action="{!! route('admin.slider.delete',$slider->id) !!}"  method="post">
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
<!--Edit Modal -->
<div class="modal fade" id="editSliderModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLongTitle">Edit Slider</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form action="{!! route('admin.slider.update',$slider->id) !!}"  method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
     <label for="title">Slider Title <small class="text-danger">(required)</small> </label>
     <input type="text" class="form-control" name="title" id="title"  placeholder="Slider Title" value="{{$slider->title}}" required>
     </div>

     <div class="form-group">
      <label for="title">Slider Image
       <a href="{{asset('images/sliders/'.$slider->image)}}" target="_blank">Previous Image</a>
         <small class="text-danger">(required)</small> </label>
      <input type="file" class="form-control" name="image" id="image"  placeholder="SliderImage">
      </div>

      <div class="form-group">
       <label for="button_text">Slider Button Text <small class="text-info">(Optional)</small> </label>
       <input type="text" class="form-control" name="button_text" id="button_text"  placeholder="Button Text (If Needed)" value="{{$slider->button_text}}">
       </div>

       <div class="form-group">
        <label for="button_link">Slider Button Link <small class="text-info">(Optional)</small> </label>
        <input type="url" class="form-control" name="button_linkt" id="button_link"  placeholder="Button Link (If Needed)" value="{{$slider->button_link}}">
        </div>
        <div class="form-group">
         <label for="priority">Slider Button Text <small class="text-danger">(required)</small> </label>
         <input type="number" class="form-control" name="priority" id="priority"  placeholder="Priority"value="{{$slider->priority}}" required>
         </div>

       <button type="submit" class="btn btn-success">Update</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  </form>

</div>
<div class="modal-footer">

</div>
</div>
</div>
</div>
</td>
 </tr>
 @endforeach
</table>


</div>
</div>
</div>
@endsection
