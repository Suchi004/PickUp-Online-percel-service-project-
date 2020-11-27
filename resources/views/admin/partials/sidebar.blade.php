<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="user-info">
            <img src="{{asset('/images/suchi.jpg')}}" alt="Suchi">
            <p class="name">Afroza Sultana</p>
            <p class="designation">Manager</p>
            <span class="online"></span>
          </div>
          <ul class="nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('admin.index')}}">
                <img src="/images/icons/1.png" alt="">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>







            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#post-pages" aria-expanded="false" aria-controls="post-pages">

                <span class="menu-title">Posts<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="post-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.posts')}}">
                      Manage Posts
                    </a>
                  </li>
                  </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="false" aria-controls="user-pages">

                <span class="menu-title">Users<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="user-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.users')}}">
                      Manage users
                    </a>
                  </li>
              </ul>
            </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#order-pages" aria-expanded="false" aria-controls="order-pages">

                <span class="menu-title">Orders<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="order-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.orders')}}">
                      Manage Orders
                    </a>
                  </li>
                  </ul>
              </div>
            </li>


               <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#category-pages" aria-expanded="false" aria-controls="category-pages">

                <span class="menu-title">Categories<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="category-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.categories')}}">
                      Manage Categories
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.category.create')}}">
                      Create Categories
                    </a>
                  </li>
                  </ul>
              </div>
            </li>


             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#division-pages" aria-expanded="false" aria-controls="division-pages">

                <span class="menu-title">Divisions<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="division-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.divisions')}}">
                      Manage Divisions
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.division.create')}}">
                      Create Divisions
                    </a>
                  </li>
                  </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#district-pages" aria-expanded="false" aria-controls="district-pages">
                <span class="menu-title">Districts<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="district-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.districts')}}">
                      Manage Districts
                    </a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.district.create')}}">
                      Create Districts
                    </a>
                  </li>
                  </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#slider-pages" aria-expanded="false" aria-controls="slider-pages">
                <span class="menu-title">Sliders<i class="fa fa-sort-down"></i></span>
              </a>
              <div class="collapse" id="slider-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('admin.sliders')}}">
                      Manage Sliders
                    </a>
                  </li>
                  </ul>
              </div>
            </li>


                  <li class="nav-item">
                    <a class="nav-link" href="#logout">
                    <form class="form-inline" action="{{route('admin.logout')}}" method="post">
                      @csrf
                      <input type="submit" name="" value="Logout" class="btn btn-danger">
                    </form>
                    </a>
                  </li>



          </ul>
        </nav>
