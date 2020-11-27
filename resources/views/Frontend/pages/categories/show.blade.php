  @extends('Frontend.layouts.master')
 <!-- Start Sidebar + content  -->
 @section('content')
   <div class="container margin-top-20">
      <div class="row">
         @include('Frontend.partials.product-sidebar')
         <div class="col-md-8 ">
          <div class="widget">
            <h3>Products in <span class="badge badge-success">Category : {{ $category->name }}</span></h3>
            @php
            $posts=$category->posts()->paginate(10);
            @endphp

            @if($posts->count()>0)
           @include('Frontend.pages.partials.all_product')
           @else
           <div class="alert alert-warning">
              No product is added yet in this category..
           </div>
           @endif

         </div>
         </div>
      </div>
</div>
@endsection

    <!-- End Sidebar + content  -->
