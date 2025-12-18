<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="#users" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.users.create') }}">Create</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}">Listing</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#donations" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash-plus
                        "></i>
                        <span> Donations </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="donations">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#projects" data-bs-toggle="collapse">
                        <i class="mdi mdi-folder-outline"></i>
                        <span> Projects </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="projects">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Create</a>
                            </li>
                            <li>
                                <a href="#">Listing</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#events" data-bs-toggle="collapse">
                        <i class="mdi mdi-calendar"></i>
                        <span> Events </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="events">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Create</a>
                            </li>
                            <li>
                                <a href="#">Listing</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#trees" data-bs-toggle="collapse">
                        <i class="mdi mdi-calendar"></i>
                        <span> Trees </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="trees">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Create</a>
                            </li>
                            <li>
                                <a href="#">Listing</a>
                            </li>
                            <li>
                                <a href="#">Photos</a>
                            </li>
                            <li>
                                <a href="#">Types</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-message"></i>
                        <span> Contact Us Messages </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>