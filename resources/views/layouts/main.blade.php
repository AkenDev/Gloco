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
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <!-- Planeado: Hacer de este lugar el punto central de toda la pag -->
                        @yield('content')
                     </div>
                  </div>
               </div>
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
      @vite([
         'resources/js/vendor.js',
         //'resources/js/waypoints.min.js',
         //'resources/js/smooth-scrollbar.js',
         //'resources/js/core.js',
         //'resources/js/charts.js',
         //'resources/js/morris.js',
         'resources/js/custom.js',
         'resources/js/logout.js',
     ])

      <!-- Section-specific Scripts -->
      @yield('scripts')

   </body>
</html>
