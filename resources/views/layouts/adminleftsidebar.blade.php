    <!--Start Left Navbar-->

    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light">
            <div id="nav" class="navbar-collapse">
                <div class="container-fluid">
                    <div class="row">
                    <!--Start Left Sidebar-->
                    <div class="col-lg-2 col-md-3 fixed-top vh-100 overflow-auto sidebars">
                        <ul class="navbar-nav flex-column mt-4">
                            <li class="nav-item nav-categories ">Main</li>
                            <li class="nav-item nav-categories"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-lg me-3"></i>Dashboard</a></li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks " data-bs-target="#pagelayout" data-bs-toggle="collapse"><i class="fas fa-cloud-download-alt fa-md me-3"></i>Download<i class="fas fa-angle-left mores"></i></a>

                            <ul id="pagelayout" class="collapse ps-2">
                                <li><a href="{{route('edulinks.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Education</a></li>
                                <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Software</a></li>
                            </ul>

                            </li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#sidebarlayout" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Form<i class="fas fa-angle-left mores"></i></a>

                                <ul id="sidebarlayout" class="collapse ps-2">
                                    <li><a href="{{route('attendances.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Att Form</a></li>
                                    <li><a href="{{route('leaves.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Leave Form</a></li>
                                    <li><a href="{{route('enrolls.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Enrolls</a></li>

                                </ul>

                            </li>

                            <li class="nav-item nav-categories">Widgets</li>

                            <li class="nav-item nav-categories">UI Features</li>

                            @if(auth()->user()->hasRole(["Admin","Teacher"]))
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#basicui" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Articles<i class="fas fa-angle-left mores"></i></a>

                                <ul id="basicui" class="collapse ps-2">
                                    <li><a href="{{route('posts.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Post</a></li>

                                    <li><a href="{{route('attendances.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Attendance</a></li>

                                    <li><a href="{{route('announcements.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Announcement</a></li>


                                </ul>

                            </li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#advanceui" data-bs-toggle="collapse"><i class="fas fa-users-group fa-lg me-3"></i>Students<i class="fas fa-angle-left mores"></i></a>

                                <ul id="advanceui" class="collapse ps-2">
                                    <li><a href="{{route('students.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>All Students</a></li>
                                    <li><a href="{{route('leads.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>All Lead</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Sliders</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Carousel</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Loaders</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Tree Views</a></li>

                                </ul>

                            </li>
                            @endif

                            @if(auth()->user()->hasRole(["Admin","Teacher","Student"]))
                            <li class="nav-item nav-categories"><a href="{{route('pointtransfers.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-exchange-alt fa-md me-4"></i>Transfer</a></li>
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#shopping" data-bs-toggle="collapse"><i class="fas fa-share-alt-square fa-lg me-3"></i>Shopping<i class="fas fa-angle-left mores"></i></a>

                                <ul id="shopping" class="collapse ps-2">
                                    <li class="nav-item nav-categories"><a href="{{route('plans.index')}}" class="nav-link text-white sidebarlinks">Plans</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('packages.index')}}" class="nav-link text-white sidebarlinks">Billing</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('packages.index')}}" class="nav-link text-white sidebarlinks">Payment</a></li>

                                </ul>

                            </li>


                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#iconselement" data-bs-toggle="collapse"><i class="fas fa-share-alt-square fa-lg me-3"></i>Apps<i class="fas fa-angle-left mores"></i></a>

                                <ul id="iconselement" class="collapse ps-2">
                                    <li><a href="{{route('contacts.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Contacts</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Todo</a></li>

                                </ul>

                            </li>

                            @endif

                            

                            <!-- end home work -->
                           

                            

                            @if(auth()->user()->hasRole(["Admin"]))
                            <li class="nav-item nav-categories">Date Representation</li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#addon" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Add On <i class="fas fa-angle-left mores"></i></a>
                                <ul id="addon" class="collapse ps-2">

                                

                                   
                                    <li class="nav-item nav-categories"><a href="{{route('paymenttypes.index')}}" class="nav-link text-white sidebarlinks">Payment Type</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('relatives.index')}}" class="nav-link text-white sidebarlinks">Relative</a></li>


                                    <li class="nav-item nav-categories"><a href="{{route('socialapplications.index')}}" class="nav-link text-white sidebarlinks">Social App</a></li>

                                    <li class="nav-item nav-categories"><a href="{{route('warehouses.index')}}" class="nav-link text-white sidebarlinks">Warehouse</a></li>
                                    
                                    <li class="nav-item nav-categories"><a href="{{route('userpoints.index')}}" class="nav-link text-white sidebarlinks">User Points</a></li>


                                </ul>
                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#fixedrole" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Fixed Analysis<i class="fas fa-angle-left mores"></i></a>
                                <ul id="fixedrole" class="collapse ps-2">
                                    <li class="nav-item nav-categories"><a href="{{route('countries.index')}}" class="nav-link text-white sidebarlinks">Countries</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('cities.index')}}" class="nav-link text-white sidebarlinks">Cities</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('religions.index')}}" class="nav-link text-white sidebarlinks">Religions</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('regions.index')}}" class="nav-link text-white sidebarlinks">Regions</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('genders.index')}}" class="nav-link text-white sidebarlinks">Genders</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('stages.index')}}" class="nav-link text-white sidebarlinks">Stages</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('paymentmethods.index')}}" class="nav-link text-white sidebarlinks">Payment Method</a></li>

                                    <li class="nav-item nav-categories"><a href="{{route('roles.index')}}" class="nav-link text-white sidebarlinks">Roles</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('roleusers.index')}}" class="nav-link text-white sidebarlinks">Role Users</a></li>
                                    <li class="nav-item nav-categories"><a href="{{route('permissionroles.index')}}" class="nav-link text-white sidebarlinks">Permission Role</a></li>

                                    <li class="nav-item nav-categories"><a href="{{route('packages.index')}}" class="nav-link text-white sidebarlinks">Packagse</a></li>

                                    <li class="nav-item nav-categories"><a href="{{route('statuses.index')}}" class="nav-link text-white sidebarlinks">Status</a></li>

                                    <!-- end home work -->
                                    <!-- name / slug / status_id / user_id -->
                                    <li class="nav-item nav-categories"><a href="{{route('tags.index')}}" class="nav-link text-white sidebarlinks">Tag</a></li>
                                    <!--  -->
                                    <!-- name / slug / status_id / user_id -->
                                    <li class="nav-item nav-categories"><a href="{{route('categories.index')}}" class="nav-link text-white sidebarlinks">Category</a></li>

                                    <!-- categories အတိုင်းဖြစ်ရမည် sunday/monday/thuday/wed/tuesday/friday/saturday -->
                                    <li class="nav-item nav-categories"><a href="{{route('days.index')}}" class="nav-link text-white sidebarlinks">Days</a></li>

                                    <li class="nav-item nav-categories"><a href="{{route('types.index')}}" class="nav-link text-white sidebarlinks">Type</a></li>
                                </ul>

                            
                            
                            

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#chartelement" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Charts<i class="fas fa-angle-left mores"></i></a>

                                <ul id="chartelement" class="collapse ps-2">
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Pie Chart</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Map Chart</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Line Chart</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Chart Js</a></li>

                                </ul>

                            </li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#tableelement" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Tables<i class="fas fa-angle-left mores"></i></a>

                                <ul id="tableelement" class="collapse ps-2">
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Basic Table</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Data Table</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Sortable table</a></li>
                                </ul>

                            </li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-target="#mapelement" data-bs-toggle="collapse"><i class="fas fa-file-alt fa-lg me-3"></i>Maps<i class="fas fa-angle-left mores"></i></a>

                                <ul id="mapelement" class="collapse ps-2">
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Google Map</a></li>
                                    <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Vector Map</a></li>
                                </ul>

                            </li>

                            @endif

                        </ul>
                    </div>
                    <!--End Left Sidebar-->

                    <!--Start Top Sidebar-->
                    @include('layouts.adminnavbar')
                    <!--End Top Sidebar-->

                    </div>

                </div>
            </div>
        </nav>
    </div>


    <!--End Left Navbar-->
