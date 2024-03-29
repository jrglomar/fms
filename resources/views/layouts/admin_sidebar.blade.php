    <div class="container">
        <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/admin/dashboard">PUPQCFMS</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/admin/dashboard">FMS</a>
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
                        </figure>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : ''}}">
                            <a class="nav-link" href="/admin/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">System Setup</li>
                        <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                        <li class="dropdown {{ Request::segment(2) == 'role' ||
                                                Request::segment(2) == 'designation' ||
                                                Request::segment(2) == 'specialization' ||
                                                Request::segment(2) == 'program' ||
                                                Request::segment(2) == 'academic_rank' ||
                                                Request::segment(2) == 'faculty_type'
                                            ? 'active' : ''}}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-book-reader"></i>
                                <span>Account</span></a>
                            <ul class="dropdown-menu">
                                <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                                <li class="{{ Request::segment(2) == 'role' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/role">
                                        <span>Roles</span></a>
                                </li>
                                <li class="{{ Request::segment(2) == 'designation' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/designation">
                                        <span>Designation</span></a>
                                </li>
                                <li class="{{ Request::segment(2) == 'specialization' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/specialization">
                                        <span>Specialization</span></a>
                                </li>
                                <li class="{{ Request::segment(2) == 'program' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/program">
                                        <span>Program</span></a>
                                </li>
                                <li class="{{ Request::segment(2) == 'academic_rank' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/academic_rank">
                                        <span>Academic Rank</span></a>
                                </li>
                                <li class="{{ Request::segment(2) == 'faculty_type' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/faculty_type">
                                        <span>Faculty Type</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-header">Account Management</li>
                        <li class="dropdown {{ Request::segment(2) == 'user' ||
                                                Request::segment(2) == 'user_role'
                                            ? 'active' : ''}}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-book-reader"></i>
                                <span>User Setup</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::segment(2) == 'user' ? 'active' : ''}}" >
                                    <a class="nav-link" href="/admin/user">
                                        <span>Users</span></a></li>
                                {{-- <li class="{{ Request::segment(2) == 'user_role' ? 'active' : ''}}">
                                    <a class="nav-link" href="/admin/user_role">
                                        <span>User Roles</span></a>
                                </li> --}}
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


