<template>
    <div class="container">
        <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">PUPQCSS</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">SS</a>
                    </div>
                    <div class="p-3 hide-sidebar-mini">
                        <div class="media">
                            <figure class="avatar mr-2 avatar">
                                <!-- <img class="mr-3 rounded-circle" src="../../public/img/avatar/avatar-1.png" -->
                                    alt="Avatar image">
                                <i class="avatar-presence online"></i>
                            </figure>
                            <div class="media-body">
                                <h6 class="mt-1 mb-0"> Faculty Name</h6>
                                <p class="mb-0">Admin</p>
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
                        <li class="menu-header">Dashboard</li>
                        <li class="active"><a class="nav-link" href="/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Setup</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-book-reader"></i>
                                <span>Activity</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" 
                                        href="/programs">Activity List</a></li>
                                <li><a class="nav-link" 
                                        href="/subjects">Activity Types</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                                    class="fas fa-user-tie"></i>
                                <span>Faculty</span></a>
                            <ul class="dropdown-menu ">

                                <li ><a class="nav-link "
                                        href="/faculties">Faculties</a></li>
                                <li ><a class="nav-link "
                                        href="/available_hrs">Available Hours</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                                    class="fas fa-chalkboard-teacher"></i>
                                <span>Class</span></a>
                            <ul class="dropdown-menu ">
                                <li ><a class="nav-link "
                                        href="/rooms">Rooms</a></li>
                                <li ><a class="nav-link "
                                        href="/batches">Batches</a></li>
                                <li><a class="nav-link"
                                        href="/sections">Sections</a></li>
                                <!-- personal info and available schedule -->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-calendar-alt"></i>
                                <span>Scheduling</span></a>
                            <ul class="dropdown-menu">
                                <li ><a class="nav-link"
                                        href="/subject_offerings">Subject Offering</a></li>
                                <li ><a class="nav-link"
                                        href="/class_schedules">Class Schedules</a></li>
                                <li ><a class="nav-link"
                                        href="/change_requests">Change Requests</a></li>

                            </ul>
                        </li>
                        <li class="menu-header">User Management</li>
                        <li>
                            <a class="nav-link" href="/roles"><i class="fas fa-user-cog"></i>
                                <span>Roles</span></a>
                        </li>
                        <li><a class="nav-link" href="/users">
                                <i class="fas fa-users"></i><span>Users</span></a></li>
                        <li >
                            <a class="nav-link" href="/user_roles"><i class="fas fa-users-cog"></i>
                                <span>User Roles</span></a>
                        </li>



                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split logout-btn"
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
</template>

<script>
    export default {
        mounted() {
            console.log('Sidebar component mounted.')
        }
    }
</script>
