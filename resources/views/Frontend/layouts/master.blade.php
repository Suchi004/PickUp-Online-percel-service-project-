<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
     @yield('title','Pick UP')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   @include('Frontend.partials.styles')
  </head>

   <body>
      <div class="wrapper mb-10">
     <!--- Navigation Bar-->

    @include('Frontend.partials.nav')
    @include('Frontend.partials.messages')

      <!-- End Nav bar-->
     @yield('content')
     <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.0/mapbox-gl-directions.js'></script>
      <!-- Start footer  -->
    @include('Frontend.partials.footer')

         </div>
 <!-- End Footer  -->

      @include('Frontend.partials.scripts')
      @yield('scripts')

   </body>
</html>
