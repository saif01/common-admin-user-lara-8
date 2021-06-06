 <nav class="pcoded-navbar navbar-image-5">
     <div class="navbar-wrapper">
         <div class="navbar-brand header-logo">
             <a href="{{ route('admin.index') }}" class="b-brand">
                 <img src="{{ asset('all-assets/common/logo/cpb/cpb.png') }}" class="navbar-brand rotate" alt="CPB-Logo"
                     height="40">
                 <span class="b-title">Admin</span>
             </a>
             <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
         </div>
         <div class="navbar-content scroll-div">
             <ul class="nav pcoded-inner-navbar">
                 <li class="nav-item pcoded-menu-caption">
                     <label>Navigation</label>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                 class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                 </li>

                 <li class="nav-item pcoded-hasmenu">
                     <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                 class="feather icon-menu"></i></span><span class="pcoded-mtext">Admin
                             Managment</span></a>
                     <ul class="pcoded-submenu">
                         @can('adminManage')
                         <li><a href="{{ route('admin.all') }}">Admins All</a></li>
                         @endcan

                         @can('roleManage')
                         <li><a href="{{ route('roles.all') }}">Roles All</a></li>
                         @endcan
                     </ul>
                 </li>


               
                 <li class="nav-item pcoded-menu-caption">
                     <label>All Pages</label>
                 </li>

                 {{-- <li class="nav-item pcoded-hasmenu">
                     <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                 class="feather icon-menu"></i></span><span class="pcoded-mtext">News</span></a>
                     <ul class="pcoded-submenu">
                         @can('news')
                         <li><a href="{{ route('admin.new.press') }}">Press</a></li>
                         <li><a href="{{ route('admin.new.event') }}">Event</a></li>
                         <li><a href="{{ route('admin.new.gallery') }}">Gallery</a></li>
                         @endcan
                     </ul>
                 </li> --}}

                 <li class="nav-item pcoded-menu-caption">
                     <label>Admin Logout</label>
                 </li>
                 <li data-username="Logout" class="nav-item"><a href="{{ route('logout') }}" class="nav-link"><span
                             class="pcoded-micon"><i class="feather icon-log-out text-danger"></i></span><span
                             class="pcoded-mtext">Logout</span></a></li>
             </ul>
         </div>
     </div>
 </nav>
