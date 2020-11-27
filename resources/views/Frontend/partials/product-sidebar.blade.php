 <div class="col-md-4">
  <div class="list-group">
    @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent )
   <a href="#main-{{$parent->id}}" class="list-group-item list-group-item-action" data-toggle="collapse">
    <img src="{!! asset('images/categories/'.$parent->image)!!}" width="50">
    {{$parent->name}}
 </a>
   <div class="collapse" id="main-{{$parent->id}}">
   	<div class="child-rows">
 	   @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',$parent->id)->get() as $child )
 	   <a href="{!!route('categories.show',$child->id)!!}" class="list-group-item list-group-item-action
      @if(Route::is('categories.show'))
      @if(App\Models\Category::ParentorNotCategory($parent->id,$category->id))
      show
      @endif
      @endif
      " >
    <img src="{!! asset('images/categories/'.$child->image)!!}" width="30">
    {{$child->name}}
 </a>
 	   @endforeach
 	   </div>
  </div>
 @endforeach


</div>
</div>
