<!doctype html>
<html lang="en">
   <head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.authheader')
   </head>
   <body>
      <!-- loader Start 
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>-->
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                @yield('signincontent')
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @vite(['resources/js/vendor.js',])


    <!-- Custom JavaScript -->
    @vite(['resources/js/custom.js'])

   </body>
</html>