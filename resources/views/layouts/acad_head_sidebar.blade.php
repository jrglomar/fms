    <div class="container">
        <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">PUPQCFMS</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">FMS</a>
                    </div>
                    <div class="p-3 hide-sidebar-mini">
                        <div class="media">
                            <figure class="avatar mr-2 avatar">
                               <img id="sidebar_icon" class="mr-3 rounded-circle" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png"
                                    alt="Avatar image">
                                <i class="avatar-presence online"></i>
                            </figure>
                            <div class="media-body">
                                <h6 class="mt-1 mb-0" id="userNameSidebar"></h6>
                                <p class="mb-0" id="userRoleSidebar"></p>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <figure class="avatar avatar">
                            <!-- <img class=" rounded-circle" src="../../public/img/avatar/avatar-1.png" alt="Avatar image"> -->
                            <i class="avatar-presence online"></i>
                        </figure>
                    </div>

                    <ul class="sidebar-menu">
                        {{-- DASHBOARD --}}
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown {{ Request::segment(2) == 'dashboard'
                                            ? 'active' : ''}}"
                        
                        ><a class="nav-link" href="/acad_head/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>

                        {{-- SRD MANAGEMENT --}}
                        <li class="menu-header">SRD Management</li>
                        <li class="dropdown {{ Request::segment(2) == 'requirement_type' || 
                                                Request::segment(2) == 'requirement_bin' ||
                                                Request::segment(2) == 'requirement_list_type' 
                                                ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>SRD</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'requirement_bin' || 
                                            Request::segment(2) == 'requirement_list_type' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/acad_head/requirement_bin">
                                    <span>Requirement Bins</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- MEETING MANAGEMENT --}}
                    <li class="menu-header">Meeting Management</li>
                    <li class="dropdown {{ Request::segment(2) == 'meeting_type' || 
                                            Request::segment(2) == 'meeting'
                                        ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-calendar"></i>
                        <span>Meeting</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'meeting' ? 'active' : ''}}">
                                <a class="nav-link" href="/acad_head/meeting">
                                    <span>Meetings</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- ACTIVITY MANAGEMENT --}}
                    <li class="menu-header">Activity Management</li>
                    <li class="dropdown {{ Request::segment(2) == 'activity_type' || 
                                            Request::segment(2) == 'activity' ||
                                            Request::segment(2) == 'activity_view'
                                        ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-clipboard"></i>
                        <span>Activity</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'activity' ||
                                        Request::segment(2) == 'activity_view'
                            ? 'active' : ''}}">
                                <a class="nav-link" href="/acad_head/activity">
                                    <span>Activities</span></a>
                            </li>
                        </ul>
                    </li>

                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <button type="button" class="btn btn-danger btn-lg btn-block btn-icon-split logout-btn" onclick="location.href='/logout'"
                            name="logout_btn">
                            Logout <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="https://getstisla.com/docs" class="btn btn-danger text-white" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </aside>
            </div>
    </div>


