@if($errors->any())

 <div class="alert alert-success alert-dismissible">
 <button type="button" class="close" data-dismiss="alert">&times;</button>
 	<ul>
   	@foreach($errors->all() as $error)
   	<p>{{ $error }}</p>
   	@endforeach
   </ul>

 	</div>
@endif 

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
 <p>{{ Session::get('success') }}</p>
</div>
</div>
</div>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-success alert-dismissible">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
 <p>{{ Session::get('error') }}</p>
</div>
</div>
</div>
</div>
@endif