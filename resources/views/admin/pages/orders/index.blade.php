@extends('admin.layouts.master')
@section('content')

  <div class="content-wrapper">
  <div class="card">
    <div class="card-header">Manage Orders</div>
    <div class="card-body">

    @include('admin.partials.messages')
   <table class="table table-hover table-striped mt-2" id="dataTable">
<thead>
  <tr>
   <th>#</th>
   <th>Order ID</th>
   <th>Orderer Name</th>
   <th>Orderer Phone NO</th>
   <th>Order Status</th>
   <th>Action</th>
  </tr>
</thead>

<tbody>
  @foreach($orders as $order)
  <tr>
     <td>{{$loop->index+1}}</td>
     <td>#PU{{ $order->id }}</td>
     <td>{{ $order->name }}</td>
     <td>{{ $order->phone_no }}</td>
     <td>
       <p>
         @if($order->is_seen_by_admin)
         <button class="btn btn-success btn-sm" type="button">seen</button>
         @else
        <button class="btn btn-warning btn-sm" type="button">Unseen</button>
      @endif
    </p>
    <p>
      @if($order->is_completed)
      <button class="btn btn-success btn-sm" type="button">Completed</button>
      @else
     <button class="btn btn-warning btn-sm" type="button">Not Completed</button>
   @endif
 </p>
      <p>
        @if($order->is_paid)
        <button class="btn btn-success btn-sm" type="button">Paid</button>
        @else
       <button class="btn btn-danger btn-sm" type="button">Unpaid</button>
     @endif
   </p>
     </td>
     <td>
          <a href="{{route('admin.order.show',$order->id)}}"  class="btn btn-outline-success">View</a>
         <a href="#deleteModal{{$order->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
         <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{!! route('admin.order.delete',$order->id) !!}"  method="post">
          {{ csrf_field() }}
             <button type="submit" class="btn btn-danger">Permanent Delete</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel </button>

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
   <th>Order ID</th>
   <th>Orderer Name</th>
   <th>Orderer Phone NO</th>
   <th>Order Status</th>
   <th>Action</th>
  </tr>
</tfoot>
</table>
</div>
</div>
</div>
 </div>

 @endsection
