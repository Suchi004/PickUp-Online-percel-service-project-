@extends('frontend.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card ml-2 mt-2 mr-2">
        <div class="card-header">
          My Post
        </div>
        <div class="card-body ml-2 mt-2 mr-2">

          <table class="table table-bordered table-striped">
              <tr>
                  <th>No.</th>
                  <th>Product Title</th>
                  <th>Product Image</th>
                  <th>Product Quantity</th>
                  <th>Charge</th>
                  <th>Action</th>

              </tr>
              @foreach($posts as $post)
                <tr>

                    <td>{{$loop->index +1 }}</td>
                    <td>
                      <a href="{{ route('post.show',$post->slug) }}">
                        {{ $post->title }}
                      </a>
                    </td>
                    <td>
                        @foreach($post->images as $image)
                        <img src="{{ asset('images/products/'. $image->image)}}" width="30">
                      @endforeach </td>

                    <td>
                      {{ $post->quantity }}
                    </td>

                    <td>
                      {{ $post->price }} Taka
                    </td>

                    {{-- <td>{{ $post->post_quantity }}</td> --}}
                    <td>
                      <a href="#editPostModal{{$post->id}}" data-toggle="modal"  class="btn btn-success">Edit</a>
                      <a href="#deleteModal{{ $post->id }}" data-toggle="modal"  class="btn btn-danger">Delete</a>

                      <!-- Delete Modal -->
                      <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{!! route('post.delete',$post->id) !!}" method="post">
                                          {{ csrf_field() }}
                                          <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                      </form>

                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!--edit modal-->
                      <div class="modal fade" id="editPostModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{!! route('post.update',$post->id) !!}"  method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
      <label for="exampleInputEmail1">Title</label>
      <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->title}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Description</label>
      <textarea name="description" rows="8" cols="8" class="form-control" value="{{$post->description}}"></textarea>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Charge</label>
      <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->price}}">

    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Weight</label>
      <input type="number" class="form-control" name="weight" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->weight}}">

    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Quantity</label>
      <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->quantity}}">

    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Phone</label>
      <input type="text" class="form-control" name="user_phone_no" value="{{$post->user_phone_no}}">

    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" name="user_email" value="{{$post->user_email}}">

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
      <label for="exampleInputEmail1">Select Destination District</label>
      <select class="form-control" name="source_district_id" id="division_id">
        <option value="">Please Select a Division</option>
        @foreach(App\Models\District::orderBy('name','asc')->get() as $district)
           <option value="{{ $district->id }}">{{ $district->name}}</option>

       @endforeach
      </select>
    </div>


    <div class="form-group">
    <label for="exampleInputEmail1">Source Stoppage</label>
    <input type="text" class="form-control" name="source_stoppage" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->source_stoppage}}">
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
    <select class="form-control" name="destination_district_id" id="division_id">
      <option value="">Please Select a District</option>
      @foreach(App\Models\District::orderBy('name','asc')->get() as $district)
         <option value="{{ $district->id }}">{{ $district->name}}</option>

     @endforeach
    </select>
  </div>

  <div class="form-group">
  <label for="exampleInputEmail1">Destination Stoppage</label>
  <input type="text" class="form-control" name="destination_stoppage" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->destination_stoppage}}">

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
  </div>

  <!-- main-panel ends -->
@endsection
