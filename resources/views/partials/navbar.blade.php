@auth
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <nav class="navbar navbar-expand-lg navbar-light p-0 d-flex">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
         </button>
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
               <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
            </div>
         </div>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto"></ul>
         </div>
         <ul class="navbar-list ml-auto">
            <li>
               <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                  <!-- Generic User Image -->
                  <img src="{{ asset('images/user/default-avatar.jpeg') }}" class="img-fluid rounded mr-3" alt="user">
                  <div class="caption">
                     <h6 class="mb-0 line-height text-white">
                        {{ Auth::user()->name ?? 'Usuario' }} <!-- Dynamically show the logged-in user's name -->
                     </h6>
                     <span class="font-size-12 text-white">Disponible</span>
                  </div>
               </a>
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card shadow-none m-0">
                     <div class="iq-card-body p-0">
                        <div class="bg-primary p-3">
                           <h5 class="mb-0 text-white line-height">Hola {{ Auth::user()->name ?? 'Usuario' }}</h5>
                           <span class="text-white font-size-12">Disponible</span>
                        </div>
                        <div class="d-inline-block w-100 text-center p-3">
                           <!-- Logout Form -->
                           <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit" id="logoutButton" class="btn btn-primary dark-btn-primary">
                                 Cerrar sesión<i class="ri-login-box-line ml-2"></i>
                              </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
</div>
<!-- TOP Nav Bar END -->
@endauth