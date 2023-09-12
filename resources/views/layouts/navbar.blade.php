{{-- CÁC MENU HIỂN THỊ Ở TRANG ADMIN --}}
<!-- Sidebar-->
<style>
   @media (min-width: 1300px) {
    .main-circle {
      display: none;
    }
   }
</style>
<div class="iq-sidebar">
   <div class="iq-sidebar-logo d-flex justify-content-between">
      <a href="{{route('dashboard')}}" class="header-logo">
         <img src="{{asset('imgs/img-logo/logo.png')}}" class="img-fluid rounded-normal" alt="4K Cinema">
      </a>
      <div class="iq-menu-bt-sidebar">
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i style="color: #ffff" class="fa-solid fa-angle-left"></i></div>
            </div>
         </div>
      </div>
   </div>
   <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu">
         <ul id="iq-sidebar-toggle" class="iq-menu">

            <li>
               <a href="{{ url('/') }}" class="text-primary"
                 ><i class="fa-solid fa-film" style="color: #c20000"></i
                 ><span>Trang Chủ</span></a
               >
             </li>
             <li class="active active-menu">
               <a href="{{route('dashboard')}}" class="iq-waves-effect"
                 ><i class="fa-solid fa-house" style="color: #c20000"></i
                 ><span>Trang Admin</span></a
               >
             </li>
             <li>
               <a href="{{route('notification.create')}}" class="iq-waves-effect"
                 ><i class="fa-regular fa-comment"></i><span>Thông báo</span></a
               >
             </li>
             <li>
               <a href="{{route('packageVIP.create')}}" class="iq-waves-effect"
                 ><i class="fa-solid fa-crown" style="color: #ffffff"></i
                 ><span>Gói VIP</span></a
               >
             </li>
             <li>
               <a href="{{route('crud_bookmark')}}" class="iq-waves-effect"
                 ><i class="fa-solid fa-bookmark" style="color: #ffffff"></i><span>Bookmark</span></a
               >
             </li>
             <li>
               <a href="#show" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-circle-user"></i><span>Tài Khoản</span><i class="fa fa-chevron-down iq-arrow-right"
                  style="color: #ffffff" ></i>
               </a>
               <ul id="show" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="{{route('manageUser.create')}}"><i class="fa-solid fa-plus"></i> Thêm tài khoản</a></li>
                  <li><a href="{{route('manageUser.index')}}"><i class="fa-solid fa-list" style="color: #ffffff"></i> Danh sách tài khoản</a></li>
               </ul>
            </li>
            <li>
               <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-star-of-david"></i><span>Thể Loại</span><i class="fa fa-chevron-down iq-arrow-right" style="color: #ffffff" ></i></a>
               <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="{{route('genre.create')}}"><i class="fa-solid fa-plus"></i> Thêm thể loại</a></li>
                  <li><a href="{{route('genre.index')}}"><i class="fa-solid fa-list" style="color: #ffffff"></i> Danh sách thể loại</a></li>
               </ul>
            </li>
             <li>
               <a href="#category" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-globe" style="color: #ffffff"></i><span>Quốc Gia</span><i class="fa fa-chevron-down iq-arrow-right" style="color: #ffffff" ></i></a>
               <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="{{route('country.create')}}"><i class="fa-solid fa-plus"></i> Thêm quốc gia</a></li>
                  <li><a href="{{route('country.index')}}"><i class="fa-solid fa-list" style="color: #ffffff"></i> Danh sách quốc gia</a></li>
               </ul>
            </li>
             <li>
               <a
                 href="#movie"
                 class="iq-waves-effect collapsed"
                 data-toggle="collapse"
                 aria-expanded="false"
                 ><i class="fa-solid fa-clapperboard" style="color: #fafafa"></i
                 ><span>Phim</span
                 ><i
                   class="fa fa-chevron-down iq-arrow-right"
                   style="color: #ffffff"
                 ></i
               ></a>
               <ul
                 id="movie"
                 class="iq-submenu collapse"
                 data-parent="#iq-sidebar-toggle"
               >
                 <li>
                   <a href="{{route('movies.create')}}"
                     ><i class="fa-solid fa-plus"></i>Thêm phim mới</a
                   >
                 </li>
                 <li>
                   <a href="{{route('movies.index')}}"
                     ><i class="fa-solid fa-list" style="color: #ffffff"></i>Danh
                     sách phim</a
                   >
                 </li>
               </ul>
             </li>

         </ul>
      </nav>
   </div>
</div>
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
         <div class="iq-menu-bt d-flex align-items-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i style="color: #ffff" class="fa-solid fa-bars"></i></div>
            </div>
            <div class="iq-navbar-logo d-flex justify-content-between">
               <a href="{{route('dashboard')}}" class="header-logo">
                  <img src="{{asset('imgs/img-logo/logo.png')}}" class="img-fluid rounded-normal" alt="4K Cinema">
               </a>
            </div>
         </div>
         <div class="iq-search-bar ml-auto">
         </div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
            <i class="fa-solid fa-caret-down"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
               <li class="nav-item nav-icon search-content">
               </li>
               <li class="nav-item nav-icon">
                  <div class="iq-sub-dropdown">
                     <div class="iq-card shadow-none m-0">
                        
                     </div>
                  </div>
               </li>
               <li class="nav-item nav-icon dropdown">
                  <div class="iq-sub-dropdown">
                     <div class="iq-card shadow-none m-0">
                        
                     </div>
                  </div>
               </li>
               <li class="line-height pt-3">
                  <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                     <button class="button" >{{ Auth::user()->name }} <i class="fa-solid fa-caret-down"></i></button>
                  </a>
                  <div class="iq-sub-dropdown iq-user-dropdown">
                     <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                           <div class="bg-primary p-3">
                              <h5 class="mb-0 text-white line-height">
                                 @if(Auth::user()->role==0 )
                                    ADMIN
                                 @else
                                    AGENT
                                 @endif
                                 
                              </h5>
                              <span class="text-white font-size-12">Gói dịch vụ: 
                                 @if(Auth::user()->package_id==1)
                                       < FREE >
                                 @elseif(Auth::user()->package_id==2)
                                       < GOLD >
                                 @elseif(Auth::user()->package_id==4)
                                       < PLATINUM >
                                 @else
                                    < PREMIUM >
                                 @endif
                              </span>
                           </div>
                           <div class="d-inline-block w-100 text-center p-3">
                              <form
                                 id="logout-form"
                                 action="{{ route('logout') }}"
                                 method="POST"
                              >
                                 @csrf
                                 <button type="submit" style="background-color: rgb(35, 34, 34)">
                                    <a class="bg-primary iq-sign-btn" role="button"
                                    >Thoát
                                    <i
                                       class="fa-solid fa-right-from-bracket"
                                       style="color: #ffffff"
                                    ></i
                                    ></a>
                                 </button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </nav>
   </div>
</div>
<!-- TOP Nav Bar END -->



