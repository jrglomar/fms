    <div class="container">
        <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/checker/dashboard">PUPQCFMS</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/checker/dashboard">FMS</a>
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
                            <img id="sidebar_icon2" class="mr-3 rounded-circle" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png"
                                    alt="Avatar image">
                            <i class="avatar-presence online"></i>
                            <i class="avatar-presence online"></i>
                        </figure>
                    </div>

                    <ul class="sidebar-menu">
                        {{-- DASHBOARD --}}
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown {{ Request::segment(2) == 'dashboard'
                                            ? 'active' : ''}}"
                        
                        ><a class="nav-link" href="/checker/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>


                        <li class="{{ Request::segment(2) == 'profile' ? 'active' : ''}}" >
                            <a class="nav-link" href="/checker/profile/{{ Auth::user()->id }}">
                        <i class="fas fa-user"></i><span>Profile</span></a></li>

                        {{-- SCHEDULE MANAGEMENT --}}
                        <li class="menu-header">Class Schedule Management</li>
                        <li class="dropdown {{ Request::segment(2) == 'schedule' || 
                                                Request::segment(2) == 'schedule_view' ||
                                                Request::segment(2) == 'class_observation' ||
                                                Request::segment(2) == 'class_observation_view' ||
                                                Request::segment(2) == 'class_attendance' ||
                                                Request::segment(2) == 'class_observation_reports'
                                                ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>Class Section</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'schedule' || 
                                            Request::segment(2) == 'schedule_view' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/checker/schedule">
                                    <span>Class Schedules</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'class_attendance' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/checker/class_attendance">
                                    <span>Class Attendances</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    


                    <li class="menu-header">Reports</li>
                        <li class="dropdown {{ Request::segment(2) == 'class_attendance_reports'
                                                ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>Reports</span></a>
                        <ul class="dropdown-menu">
                            <li style="padding-bottom: 1rem" class=" {{ Request::segment(2) == 'class_attendance_reports'
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/checker/class_attendance_reports">
                                    <span>Class Attendance Reports</span></a>
                            </li>
                            
                        </ul>
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


