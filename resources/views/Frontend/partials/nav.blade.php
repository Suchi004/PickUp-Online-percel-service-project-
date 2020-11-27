<nav class="navbar navbar-expand-lg navbar-light my-light">
   	<div class="container font" >
  <a class="navbar-brand" href="{{Route('index')}}" style="color:#ffffff; margin-bottom:14px;">
     <img src="{{asset('images/logo.png')}}" style="height:55px; width:100px;" alt="PickUp">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" style="color:#ffffff;"  href="{{Route('index')}}" >Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{Route('posts')}}" style="color:#ffffff;" >Posts</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('post.create')}}" style="color:#ffffff;" >Add Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('Myposts')}}" style="color:#ffffff;" >My Posts</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{route('contact')}}" style="color:#ffffff;" >Contact</a>
      </li>

      <li class="nav-item">
      <form class="form-inline  my-lg-0" action="{{route('search')}}" method="get">
      <div class="input-group mb-3">
      <input class="form-control" name="search" type="text" placeholder="search" aria-label="search">
      <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button"  style="background:#ecb3ff;"><i class="fas fa-search"></i></button>
      </div>
      </div>
    </form>
      </li>



    </ul>
    <!--right side of navbar profile-->
     <ul class="navbar-nav ml-auto">
                            <li>
                                <a class="nav-link" href="{{ route('carts') }}">
                                 <button class="btn btn-outline-danger"> <span class="mt-1" style="color:#fff;"><i class="fas fa-shopping-cart"></i></span>
                                   <span class="badge badge-warning" id="totalItems">
                                    {{ App\Models\Cart::totalItems()}}
                                   </span></button>
                                </a>
                            </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color:#ffffff;">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color:#ffffff;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a style="color:#ffffff;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{App\Helpers\ImageHelper::getUserIamge( Auth::user()->id)}}" style="width:40px" class="img rounded-circle">
                                    {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

  </div>
  </div>

</nav>
