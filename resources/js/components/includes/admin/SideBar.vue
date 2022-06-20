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
                        <li class=""><a class="nav-link" href="/dashboard"><i class="fas fa-th-large"></i>
                                <span>Dashboard</span></a></li>
                        <li class="menu-header">Setup</li>

                        <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                        <li class="dropdown"
                        :class="{ active: isActive_Activity, 'text-primary': isActive_Activity}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-book-reader"></i>
                                <span>Activity</span></a>
                            <ul class="dropdown-menu">
                                
                                <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                                <li><a class="nav-link"
                                        :class="{ active: isActive_ActivityList, 'text-primary': isActive_ActivityList}">
                                        Activity List</a></li>
                                <li><a class="nav-link" 
                                        href="/subjects">Activity Types</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                                    class="fas fa-user-tie"></i>
                                <span>Faculty</span></a>
                            <ul class="dropdown-menu ">

                                <li ><a class="nav-link">
                                        Faculties</a></li>
                                <li ><a class="nav-link "
                                        href="/available_hrs">Available Hours</a></li>
                            </ul>
                        </li> 

                        <!-- ACCOUNT MANAGEMENT -->
                        <li class="dropdown"
                        :class="{ active: isActive_AccountManagement, 'text-primary': isActive_AccountManagement}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-user"></i>
                                <span>Account Management</span></a>
                            <ul class="dropdown-menu">
                                
                                <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                                <li><a class="nav-link" href="/admin/academic_rank"
                                        :class="{ active: isActive_AcademicRankList, 'text-primary': isActive_AcademicRankList}">
                                        Academic Rank</a></li>
                            </ul>
                            <ul class="dropdown-menu">
                                <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                                <li><a class="nav-link" href="/admin/designation"
                                        :class="{ active: isActive_DesignationList, 'text-primary': isActive_DesignationList}">
                                        Designation</a></li>
                            </ul>
                            <ul class="dropdown-menu">
                                
                                <!-- THIS IS REQUIRED FOR CHECKING ACTIVE CLASS -->
                                <li><a class="nav-link" href="/admin/faculty_type"
                                        :class="{ active: isActive_FacultyTypeList, 'text-primary': isActive_FacultyTypeList}">
                                        Faculty Type</a></li>
                            </ul>
                        </li>

                        
                        <li class="menu-header">User Management</li>
                        <li>
                            <a class="nav-link" href="/admin/role"><i class="fas fa-user-cog"></i>
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
            this.checkUrl();
        },

        data() {
        return {
            isActive_Activity: false,
            isActive_ActivityList: false,
            //------- ACCOUNT MANAGEMENT-------//
            isActive_AccountManagement: false,
            // ACADEMIC RANK
            isActive_AcademicRankList: false,
            // DESIGNATION
            isActive_DesignationList: false,
            // FACULTY TYPE
            isActive_FacultyTypeList: false,
            // ROLE
            isActive_Role: false,
            isActive_RoleList: false
        }
        },

        methods:{
            checkUrl(){
                if (window.location.pathname == "/admin/activity"){
                    this.isActive_Activity = true;
                    this.isActive_ActivityList = true;
                };

                // ACADEMIC RANK
                if (window.location.pathname == "/admin/academic_rank"){
                    this.isActive_AccountManagement = true;
                    this.isActive_AcademicRankList = true;
                };

                // DESIGNATION
                if (window.location.pathname == "/admin/designation"){
                    this.isActive_AccountManagement = true;
                    this.isActive_DesignationList = true;
                };

                // FACULTY TYPE
                if (window.location.pathname == "/admin/faculty_type"){
                    this.isActive_AccountManagement = true;
                    this.isActive_FacultyTypeList = true;
                };

                // ROLE
                if (window.location.pathname == "/admin/role"){
                    this.isActive_Role = true;
                    this.isActive_RoleList = true;
                };
            }
        }
    }
</script>
