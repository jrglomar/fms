    <div class="container">
        <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/director/dashboard">PUPQCFMS</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/director/dashboard">FMS</a>
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
                        
                        ><a class="nav-link" href="/director/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>


                        <li class="{{ Request::segment(2) == 'profile' ? 'active' : ''}}" >
                            <a class="nav-link" href="/director/profile/{{ Auth::user()->id }}">
                        <i class="fas fa-user"></i><span>Profile</span></a></li>

                        {{-- SCHEDULE MANAGEMENT --}}
                        <li class="menu-header">Schedule Management</li>
                        <li class="dropdown {{ Request::segment(2) == 'schedule' || 
                                                Request::segment(2) == 'schedule_view' ||
                                                Request::segment(2) == 'class_observation' ||
                                                Request::segment(2) == 'class_observation_view'
                                                ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>Observation</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'schedule' || 
                                            Request::segment(2) == 'schedule_view' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/director/schedule">
                                    <span>Class Schedules</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'class_observation' || 
                                            Request::segment(2) == 'class_observation_view' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/director/class_observation">
                                    <span>Observation</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    

                        {{-- SRD MANAGEMENT --}}
                        <li class="menu-header" style="padding-bottom: 12px">Documents Management</li>
                        <li class="dropdown {{ Request::segment(2) == 'requirement_type' || 
                                                Request::segment(2) == 'requirement_bin' ||
                                                Request::segment(2) == 'requirement_list_type' 
                                                ? 'active' : ''}}" style="padding-bottom: 12px">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>Submission of Documents</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'requirement_bin' || 
                                            Request::segment(2) == 'requirement_list_type' 
                                            
                                            ? 'active' : ''}}">
                                <a class="nav-link" href="/director/requirement_bin">
                                    <span>Requirement Bins</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'requirement_type' ? 'active' : ''}}">
                                <a class="nav-link" href="/director/requirement_type">
                                    <span>Requirement Types</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- MEETING MANAGEMENT --}}
                    <!-- <li class="menu-header">Meeting Management</li>
                    <li class="dropdown {{ Request::segment(2) == 'meeting_type' || 
                                            Request::segment(2) == 'meeting'
                                        ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-calendar"></i>
                        <span>Meeting</span></a>
                        <ul class="dropdown-menu">
                            THIS IS REQUIRED FOR CHECKING ACTIVE CLASS
                            <li class="{{ Request::segment(2) == 'meeting' ? 'active' : ''}}">
                                <a class="nav-link" href="/director/meeting">
                                    <span>Meetings</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'meeting_type' ? 'active' : ''}}">
                                <a class="nav-link" href="/director/meeting_type">
                                    <span>Meeting Types</span></a>
                            </li>
                        </ul>
                    </li> -->

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
                                <a class="nav-link" href="/director/activity">
                                    <span>Activities</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'activity_type' ? 'active' : ''}}">
                                <a class="nav-link" href="/director/activity_type">
                                    <span>Activity Types</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-header">Reports</li>
                        <li class="dropdown {{ Request::segment(2) == 'srd_reports' || 
                                                Request::segment(2) == 'meeting_reports' ||
                                                Request::segment(2) == 'activity_reports' ||
                                                Request::segment(2) == 'class_observation_reports' 
                                                ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-book-reader"></i>
                        <span>Reports</span></a>
                        <ul class="dropdown-menu">
                            <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                            <li class="{{ Request::segment(2) == 'class_observation_reports'
                            ? 'active' : ''}}">
                                <a class="nav-link" href="/director/class_observation_reports">
                                    <span>Class Observation Reports</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'srd_reports' ? 'active' : ''}}">
                                    <a class="nav-link" href="/director/srd_reports">
                                        <span>SRD Report</span></a>
                            </li>
                            <li class="{{ Request::segment(2) == 'activity_reports' ? 'active' : ''}}">
                                <a class="nav-link" href="/director/activity_reports">
                                    <span>Activity Report</span></a>
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


