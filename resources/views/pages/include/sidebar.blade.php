{{-- List Phim bên phải màn hình 1 --}}
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
       <div class="section-bar clearfix">
          <div class="section-title">
             <span>Phim Sắp Chiếu <i class="fa-regular fa-lightbulb"></i></span>
             
          </div>
       </div>
       <section class="tab-content">
          <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
             <div class="halim-ajax-popular-post-loading hidden"></div>
             <div id="halim-ajax-popular-post" class="popular-post">
                @foreach($hot_trailer as $key => $hot_trailer)
                <div class="item post-37176">
                   <a href="{{route('movie',$hot_trailer->slug)}}" title="{{$hot_trailer->title}}">
                      <div class="item-link">
                         <img src="{{asset('uploads/poster/'.$hot_trailer->poster)}}" class="lazy post-thumb" alt="{{$hot_trailer->title}}" title="{{$hot_trailer->title}}" />
                         <span class="is_trailer">
                            @if($hot_trailer->resolution==0)
                               720p
                            @elseif($hot_trailer->resolution==1)
                               1080p
                            @elseif($hot_trailer->resolution==2)
                               4K
                            @else
                               Trailer
                            @endif
                         </span>
                      </div>
                      <p class="title">{{$hot_trailer->title}}</p>
                   </a>
                   <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                   <div style="float: left;">
                      <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                      <span style="width: 0%"></span>
                      </span>
                   </div>
                </div>
                @endforeach
             </div>
          </div>
       </section> 
       <div class="clearfix"></div>
    </div>
 </aside>
 {{-- End List phim bên phải màn hình 1 --}}
 
 {{-- List Phim bên phải màn hình 2 --}}
 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
     <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
           <div class="section-title">
              <span>Top Trending <i class="fa-regular fa-star"></i></span>
              
           </div>
        </div>
        <section class="tab-content">
           <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
              <div class="halim-ajax-popular-post-loading hidden"></div>
              <div id="halim-ajax-popular-post" class="popular-post">
                 @foreach($hot_sidebar as $key => $hot_sidebar)
                 <div class="item post-37176">
                  
                    <a href="{{route('movie',$hot_sidebar->slug)}}" title="{{$hot_sidebar->title}}">
                       <div class="item-link">
                          <img src="{{asset('uploads/poster/'.$hot_sidebar->poster)}}" class="lazy post-thumb" alt="{{$hot_sidebar->title}}" title="{{$hot_sidebar->title}}" />
                          <span class="is_trailer">
                             @if($hot_sidebar->resolution==0)
                                720p
                             @elseif($hot_sidebar->resolution==1)
                                1080p
                             @elseif($hot_sidebar->resolution==2)
                                4K
                             @else
                                Trailer
                             @endif
                          </span>
                       </div>
                       <p class="title">{{$hot_sidebar->title}}</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                       <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                       <span style="width: 0%"></span>
                       </span>
                    </div>
                 </div>
                 @endforeach
              </div>
           </div>
        </section> 
        <div class="clearfix"></div>
     </div>
  </aside>
  {{-- End List phim bên phải màn hình 2--}}
 
  {{-- List Phim bên phải màn hình 3--}}
  <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4" clearfix="overflow: auto;">
     <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
           <div class="section-title">
              <span>Top Views</span>
             </div>
        </div>
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
             <li class="nav-item active">
             <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true" >Day</a>
             </li>
             <li class="nav-item">
             <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Week</a>
             </li>
             <li class="nav-item">
             <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Month</a>
             </li>
         </ul>
        <div class="tab-content" id="pills-tabContent">
             
             {{-- Top View Default - Theo Ngày --}}
             <div id="halim-ajax-popular-post-default" class="popular-post">
                 <span id="show_data_default"></span>
             </div>
 
 
             {{-- Top View Theo Tuần / Tháng --}}
             <div class="tab-pane fade active" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">
                 <div id="halim-ajax-popular-post" class="popular-post">
                     
                     <span id="show_data"></span>
                 </div>
             </div>
        </div>
 
     
     <div class="clearfix"></div>
     </div>
 </aside>
  {{-- End List phim bên phải màn hình 3--}}