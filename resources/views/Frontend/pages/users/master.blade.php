@extends('Frontend.layouts.master')
<!-- Start Sidebar + content  -->
@section('content')
  <div class="container mt-2">
   <div class="row">
   <div class="col-md-4">
        <div class="list-group">
         <a href="" class="list-group-item">
                   <img src="{{App\Helpers\ImageHelper::getUserIamge( Auth::user()->id)}}" style="width:100px" class="img rounded-circle">
         </a>
         <a href="{{ route('user.dashboard') }}" class="list-group-item {{Route::is('user.dashboard' ? 'active' : '')}}">Dashboard</a>
         <a href="{{ route('user.profile') }}" class="list-group-item {{Route::is('user.profile' ? 'active' : '')}} ">Update Profile</a>

      <a class="list-group-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                   </a>

        </div>
   </div>
   <div class="col-md-8">
    <div class="card card-body">
     @yield('sub-content')
    </div>
  </div>
</div>
</div>

@endsection
