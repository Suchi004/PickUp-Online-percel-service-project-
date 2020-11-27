 <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
 <script src="{{asset('js/popper.min.js')}}"></script>
 <script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/datatables.min.js')}}"></script>

<!--alertify-->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



<script>

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 function addToCart(post_id){
   $.post( "http://localhost/PU/public/api/cart/store",
     { post_id:post_id })
     .done(function( data ) {
       data=JSON.parse(data);
       if(data.status=='success'){
         //toast
         alertify.set('notifier','position','top-center');
         alertify.success('Item added to cart successfully !! Total Items : '+data.totalItems
       + '<br/>To checkout <a href="{{route('carts')}}">go to checkout page </a> ');
         $("#totalItems").html(data.totalItems);
       }
     });
 }
</script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
  } );
</script>
