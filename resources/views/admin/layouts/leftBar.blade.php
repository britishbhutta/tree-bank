<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>

                <!-- Dashboard -->
                <li class="{{ request()->routeIs('admin.dashboard') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Users -->
                <li class="{{ request()->routeIs('admin.users.*') ? 'menuitem-active' : '' }}">
                    <a href="#users" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('admin.users.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span>Users</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="users">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.users.create') }}"
                                    class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                    Listing
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Donations -->
                <li class="{{ request()->routeIs('admin.donation.*') ? 'menuitem-active' : '' }}">
                    <a href="#donations" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('admin.donation.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-cash-plus"></i>
                        <span>Donations</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.donation.*') ? 'show' : '' }}" id="donations">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.donation.create') }}"
                                    class="{{ request()->routeIs('admin.donation.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.donation.index') }}"
                                    class="{{ request()->routeIs('admin.donation.index') ? 'active' : '' }}">
                                    List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Projects -->
                <li class="{{ request()->routeIs('admin.projects.*') ? 'menuitem-active' : '' }}">
                    <a href="#projects" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('admin.projects.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span>Projects</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.projects.*') ? 'show' : '' }}" id="projects">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.projects.create') }}"
                                    class="{{ request()->routeIs('admin.projects.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.projects.index') }}"
                                    class="{{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">
                                    Listing
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Events / Workshops -->
                <li class="{{ request()->routeIs('admin.workshop.*') ? 'menuitem-active' : '' }}">
                    <a href="#events" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('admin.workshop.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-calendar"></i>
                        <span>Workshop</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.workshop.*') ? 'show' : '' }}" id="events">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.workshop.create') }}"
                                    class="{{ request()->routeIs('admin.workshop.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.workshop.index') }}"
                                    class="{{ request()->routeIs('admin.workshop.index') ? 'active' : '' }}">
                                    Listing
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Trees -->
                <li>
                    <a href="#trees" data-bs-toggle="collapse">
                        <i class="mdi mdi-tree"></i>
                        <span>Trees</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="trees">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('admin.trees.create') }}">Create</a></li>
                            <li><a href="{{ route('admin.trees.index') }}">Listing</a></li>
                            <li><a href="#">Photos</a></li>
                        </ul>
                    </div>
                </li>

                <li class="{{ request()->routeIs('admin.tree_types.*') ? 'menuitem-active' : '' }}">
                    <a href="#treeTypes" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('admin.tree_types.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-calendar"></i>
                        <span>Tree Type</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.tree_types.*') ? 'show' : '' }}" id="treeTypes">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.tree_types.create') }}"
                                    class="{{ request()->routeIs('admin.tree_types.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tree_types.index') }}"
                                    class="{{ request()->routeIs('admin.tree_types.index') ? 'active' : '' }}">
                                    Listing
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Currencies -->
                <li class="{{ request()->routeIs('currencies*') ? 'menuitem-active' : '' }}">
                    <a href="#currencies" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('currencies*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-currency-usd"></i>
                        <span>Currencies</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse {{ request()->routeIs('currencies*') ? 'show' : '' }}" id="currencies">
                        <ul class="nav-second-level">
                           
                                <li>
                                    <a href="{{ route('admin.createCurrency') }}"
                                        class="{{ request()->routeIs('createCurrency') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>

                            <li>
                                <a href="{{ route('admin.currencies') }}"
                                    class="{{ request()->routeIs('currencies') ? 'active' : '' }}">
                                    Listing
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Contact Us Messages -->
                <li>
                    <a href="#">
                        <i class="mdi mdi-message"></i>
                        <span>Contact Us Messages</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
