 @extends('Frontend.layouts.master')
 <!-- Start Sidebar + content  -->
 @section('content')
   <div class="container margin-top-20">
      <div class="row">
         @include('Frontend.partials.product-sidebar')
         <div class="col-md-8 ">
          <div class="widget">
             <h3>Searched  for - <span class="badge badge-primary">
                 {{ $search }}
             </span></h3>
            @include('Frontend.pages.partials.all_product')

          </div>
         </div>
      </div>
</div>
@endsection
