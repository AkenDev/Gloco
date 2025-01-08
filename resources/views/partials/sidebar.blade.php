<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
       <a href="{{ route('home') }}" class="iq-waves-effect">
       <div class="iq-light-logo">
          <div class="iq-light-logo">
               <!--- <img src="images/logo.gif" class="img-fluid" alt="">--->
           </div>
            <div class="iq-dark-logo">
               <!---<img src="images/logo-dark.gif" class="img-fluid" alt="">--->
            </div>
            <span>Gloco</span>
       </div>
       </a>
       <div class="iq-menu-bt-sidebar">
          <div class="iq-menu-bt align-self-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
             </div>
          </div>
       </div>
    </div>
    <div id="sidebar-scrollbar">
       <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Inicio</span></li>
             <li class="active">
                <a href="{{ route('home') }}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Bienvenido</span></a>
             </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Aplicaciones</span></li>
             
             <li><a href="{{ route('facturas.select-cliente') }}" class="iq-waves-effect" aria-expanded="false"><i class="ri-currency-line"></i><span>Facturación</span></a></li>
             <li><a href="{{ route('inventarios.index') }}" class="iq-waves-effect"><i class="ri-stack-line"></i><span>Inventario</span></a></li>
             <li><a href="{{ route('clientes.index') }}" class="iq-waves-effect"><i class="ri-user-5-fill"></i><span>Clientes</span></a></li>
             <li><a href="{{ route('lote-inventarios.index') }}" class="iq-waves-effect"><i class="ri-archive-drawer-fill"></i><span>Lotes</span></a></li>                  
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
 </div>