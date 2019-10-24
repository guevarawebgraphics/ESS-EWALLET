 <!-- page container area start -->
 <div class="page-container">
 <!-- sidebar menu area start -->
 <div class="sidebar-menu nav-custom">
    <div class="sidebar-header nav-custom">
        <div class="logo">
        <router-link to="/dashboard"><h6 class="text-white">E-Wallet</h6></router-link>
        </div>
    </div>
    <div class="main-menu side-custom">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="#dashboard" aria-expanded="true"><i class="ti-bell text-blue"></i><span>Notification Template</span></a>
                        {{-- <ul class="collapse">
                            <li class="active"><a href="#">Active Menu Item</a></li>
                            <li><a href="#">Menuitem 2</a></li>
                            <li><a href="#">Menuitem 3</a></li>
                        </ul> --}}
                    </li>
                    <li>
                        <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Account Types</span></a>
                    </li>
                    <li>
                        <router-link to="/walletaccounts" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Accounts</span></router-link>
                    </li>
                    <li>
                        <router-link to="/servicetypes" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Service Types</span></router-link>
                    </li>
                    <li>
                        <router-link to="/serviceslist" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Services List</span></router-link>
                    </li>
                    <li>
                        <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Prepaid Service Gateway</span></a>
                    </li>
                    <li>
                        <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Rates</span></a>
                    </li>
                    <li>
                        <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Admin Reports</span></a>
                    </li>
                    <li>
                        
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-wallet text-blue"></i>
                            <span>Service Matrix</span></a>
                        <ul class="collapse">
                            <li><router-link to="/ServiceGroup" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Grouping</span></router-link></li>
                            <li><router-link to="/ServiceMatrix" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Matrix</span></router-link></li>
                        </ul>
                    </li>
                    {{-- <li><a href="#"><i class="ti-map-alt"></i><span>Not expanding</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i>
                            <span>Multi
                                level menu</span></a>
                        <ul class="collapse">
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#">Item level (1)</a></li>
                            <li><a href="#" aria-expanded="true">Item level (1)</a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                    <li><a href="#">Item level (2)</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Item level (1)</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
 <!-- main content area start -->
 <div class="main-content">
        <!-- header area start -->
        <div class="header-area nav-custom">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    {{-- <div class="search-box pull-left">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div> --}}
                </div>
                <!-- profile info & task notification -->
                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="notification-area pull-right">
                        {{-- <li id="full-view"><i class="ti-fullscreen"></i></li> --}}
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        <li class="dropdown">
                            <i class="ti-bell dropdown-toggle text-white" data-toggle="dropdown">
                                <span>2</span>
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <i class="fa fa-envelope-o dropdown-toggle text-white" data-toggle="dropdown"><span>3</span></i>
                            <div class="dropdown-menu notify-box nt-enveloper-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">
                                        <img src="{{ asset('str_dash/images/author/author-img1.jpg') }}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>Aglae Mayer</p>
                                            <span class="msg">Hey I am waiting for you...</span>
                                            <span>3:15 PM</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        {{-- <li class="settings-btn">
                            <i class="ti-settings"></i>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- header area end -->
        
        