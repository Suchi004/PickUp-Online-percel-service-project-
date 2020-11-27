
@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
  <div class="card">
     <div class="card-body">

      <div class="card-header">Manage Users</div>
       @include('admin.partials.messages')
<table class="table table-hover table-striped" id="dataTable">
  <thead>
    <tr>
     <th>#</th>
     <th>Name</th>
     <th>Address</th>
     <th>Email</th>
     <th>Phone</th>
     <th>Status</th>
     <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
       <td>{{$loop->index+1}}</td>
       <td> <a href="{{route('user.show',$user->id)}}">{{$user->first_name.' '.$user->last_name}}</a></td>
       <td>{{$user->street_address}},
       @foreach(App\Models\District::where('id',$user->district_id)->get() as $district)
          {{$district->name}},
         @endforeach
         @foreach(App\Models\Division::where('id',$user->division_id)->get() as $division)
          {{$division->name}}
         @endforeach</td>
       <td>{{ $user->email }}</td>

        <td>{{$user->phone_no }}</td>
        <td>@if(Cache::has('is_online' . $user->id))
       <span class="text-success">Online</span>
        @else
       <span class="text-secondary">Offline</span>
       @endif</td>
        <td>
         <a href="#deleteModal{{$user->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
         <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{!! route('admin.users.delete',$user->id) !!}"  method="post">
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
      <th>Name</th>
      <th>Address</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>


</div>
 </div>
</div>

 @endsection
