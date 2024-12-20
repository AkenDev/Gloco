<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
       <a href="index.html">
       <div class="iq-light-logo">
          <div class="iq-light-logo">
             <!--- <img src="images/logo.gif" class="img-fluid" alt="">--->
           </div>
             <div class="iq-dark-logo">
                <!---<img src="images/logo-dark.gif" class="img-fluid" alt="">--->
             </div>
       </div>
       <div class="iq-dark-logo">
          <!---<img src="images/logo-dark.gif" class="img-fluid" alt="">--->
       </div>
       <span>Vito</span>
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
                <a href="index.html" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Panel principal</span></a>
             </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Aplicaciones</span></li>
             
             <li><a href="todo.html" class="iq-waves-effect" aria-expanded="false"><i class="ri-chat-check-line"></i><span>Cotizador</span></a></li>
             <li>
                <a href="#userinfo" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-user-line"></i><span>User</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="profile.html"><i class="ri-profile-line"></i>User Profile</a></li>
                   <li><a href="profile-edit.html"><i class="ri-file-edit-line"></i>User Edit</a></li>
                   <li><a href="add-user.html"><i class="ri-user-add-line"></i>User Add</a></li>
                   <li><a href="user-list.html"><i class="ri-file-list-line"></i>User List</a></li>
                </ul>
             </li>
             <li><a href="" class="iq-waves-effect"><i class="ri-profile-line"></i><span>Facturas</span></a></li>
             <li><a href="{{ route('inventarios.index') }}" class="iq-waves-effect"><i class="ri-message-line"></i><span>Inventario</span></a></li>
             <li><a href="{{ route('clientes.index') }}" class="iq-waves-effect"><i class="ri-message-line"></i><span>Clientes</span></a></li>
             <li><a href="{{ route('lote-inventarios.index') }}" class="iq-waves-effect"><i class="ri-message-line"></i><span>Lotes</span></a></li>                  
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
 </div>