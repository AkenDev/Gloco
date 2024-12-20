<!doctype html>
<html lang="en">
   <head>
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
    <script src="{{ Vite::asset('resources/js/jquery.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/popper.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/bootstrap.min.js') }}"></script>

    <!-- Custom JavaScript -->
    <script src="{{ Vite::asset('resources/js/custom.js') }}"></script>

   </body>
</html>