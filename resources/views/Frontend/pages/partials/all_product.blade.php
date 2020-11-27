  <div class="row">
              @foreach($posts as $post)
               <div class="col-md-4">

               <div class="card">
                @php
                $i=1;
                @endphp
                @foreach ($post->images as $image)
                @if($i>0)
                <a href="{!! route('post.show',$post->slug) !!}">
                <img class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image)}}" alt="{{$post->title}}"></a>
                @endif
                  @php $i--; @endphp
                 @endforeach
               <div class="card-body">
                <h5 class="card-title">
                  <a href="{!! route('post.show',$post->slug) !!}">{{ $post->title }}</a>
                </h5>
               <p class="card-text">{{ $post->price }}</p>
               <p class="card-text">{{ $post->source_stoppage }}</p>
               @include('Frontend.pages.partials.cart-button')
               </div>
               </div>

              </div>
              @endforeach
             </div>


  <div class="mt-4 pagination ">
    {{ $posts->links() }}
</div>
