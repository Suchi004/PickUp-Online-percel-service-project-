<div class="container mt-2">
 <div class="row">
 <div class="col-md-4">
      <div class="list-group">
       <a href="" class="list-group-item">
                 <img src="{{App\Helpers\ImageHelper::getUserIamge($user->id)}}" style="width:100px" class="img rounded-circle">
       </a>

      </div>
      <div class="item-wrapper">
       <p>  <h4>Reviews : </h4> </p>
            @php
            $stars =$user->getStarRating();
            @endphp

            @for($i = 0; $i < 5; $i++)

            @if($i < $stars)
              <i class="fas fa-star"  style="color:#F55A0C;"></i>
            @else
              <i class="fas fa-star"></i>
            @endif
            @endfor
            @foreach($user->reviews as $review)
            <div class="list-group">
           <h5 class="panel-title">
          <a data-toggle="collapse" class="list-group-item list-group-item-action" href="#collapse{{$review->id}}">{{$review->headline}}</a>
        </h5>
        </div>
       <div id="collapse{{$review->id}}" class="panel-collapse collapse">
      <div class="panel-body">
        @foreach(App\Models\User::where('id',$review->reviewer_id)->get() as $reviewer)
         <a href="#">{{ $reviewer->name }}</a>
         @endforeach
      </div>
      <div class="panel-footer">--{{$review->description}}</div>
    </div>
     @endforeach
      <br>
      @if(Auth::check())
      <a href="#reviewModal{{ $user->id }}" data-toggle="modal"  class="btn btn-success">Rate This User</a>
      @include('Frontend.pages.users.partials.review_form')
      @else
      <a href="{{route('index')}}" data-toggle="modal"  class="btn btn-success">Rate This User</a>
      @endif
      </div>

  </div>


 <div class="col-md-8">
  <div class="card card-body">
       <h3>Name :{{$user->first_name.' '.$user->last_name}}</h3><br>
         <h5>@if(Cache::has('is_online' . $user->id))
        <span class="text-success">Online</span>
         @else
        <span class="text-secondary">Offline</span>
        @endif
        {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
      </h5>
              <hr>
             <div class="row">
               <div class="col-md-4">
              <ul>
                <li><p> <strong>Phone No : </strong> {{$user->phone_no }}</p> </li>
                <li><p><strong>Address :</strong> {{$user->street_address}},
                @foreach(App\Models\District::where('id',$user->district_id)->get() as $district)
                   {{$district->name}},
                  @endforeach
                  @foreach(App\Models\Division::where('id',$user->division_id)->get() as $division)
                   {{$division->name}}
                  @endforeach
                  </p>
                  <li><p><strong>Shipping Address : </strong>{{$user->shipping_address}}</p></li>
               </li>

              </ul>
               </div>
             </div>
       </div>
  </div>
</div>
</div>
