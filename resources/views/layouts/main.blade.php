<!doctype html>
<html lang="es">
   <head>
      @include('partials.header')
   </head>
   <body class="sidebar-main-active right-column-fixed header-top-bgcolor">
      <!-- loader Start 
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>-->
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         @include('partials.sidebar')
         <!-- TOP Nav Bar -->
         @include('partials.navbar')
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <!-- Planeado: Hacer de este lugar el punto central de toda la pag -->
               @yield('content')
            </div>
         </div>
      </div>
 
      <!-- Planeado: Barra de la derecha, tal vez la vaya a necesitar -->  
      @include('partials.rightsidebar')

      <!-- Wrapper END -->
      <!-- Footer -->
      @include('partials.footer')
      <!-- Footer END -->

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <!-- Appear JavaScript -->
      <!-- Countdown JavaScript -->
      <!-- Counterup JavaScript -->
      <!-- Wow JavaScript -->
      <!-- Apexcharts JavaScript -->
      <!-- Slick JavaScript -->
      <!-- Select2 JavaScript -->
      <!-- Magnific Popup JavaScript -->
      <!-- Smooth Scrollbar JavaScript -->
      <!-- lottie JavaScript -->
      <!-- am core JavaScript -->
      <!-- am charts JavaScript -->
      <!-- am animated JavaScript -->
      <!-- am kelly JavaScript -->
      <!-- Morris JavaScript -->
      <!-- am maps JavaScript -->
      <!-- am worldLow JavaScript -->
      <!-- ChartList Js -->
      <!-- Chart Custom JavaScript -->
      <!-- Custom JavaScript -->
      <!-- Include the global scripts -->
      <!-- Include scripts -->
      <script src="{{ Vite::asset('resources/js/jquery.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/popper.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/bootstrap.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/jquery.appear.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/countdown.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/waypoints.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/jquery.counterup.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/wow.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/apexcharts.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/slick.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/select2.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/smooth-scrollbar.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/lottie.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/core.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/charts.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/animated.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/kelly.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/morris.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/maps.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/worldLow.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/chartist/chartist.min.js') }}"></script>
      <script async src="{{ Vite::asset('resources/js/chart-custom.js') }}"></script>
      <script src="{{ Vite::asset('resources/js/custom.js') }}"></script>

      <script>
         // Initialize WOW.js
         document.addEventListener('DOMContentLoaded', function() {
            new WOW().init();
         });
      </script>

   </body>
</html>
