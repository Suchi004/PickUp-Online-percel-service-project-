<div class="modal fade" id="reviewModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLongTitle">Rate Us</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div>
  <form action={{route('review.store')}} method="post">
  @csrf
  <div class="form-group">
   <label for="">Rate </label>
    <input type="number" class="form-control" name="rating" id="rating"  placeholder="Headline">
   </div>



    <div class="form-group">
     <label for="title">Headline <small class="text-info">(optional)</small> </label>
     <input type="text" class="form-control" name="headline" id="headline"  placeholder="Headline">
     </div>

     <div class="form-group">
       <label for="button_text">Description<small class="text-info">(Optional)</small> </label>
       <input type="text" class="form-control" name="description" id="description">
       </div>

        <input type="hidden"  name="user_id" value="{{$user->id }}">

         <button type="submit" class="btn btn-success">Submit</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  </form>
<div class="modal-footer">

</div>
</div>
</div>
</div>
</div>
</div>
