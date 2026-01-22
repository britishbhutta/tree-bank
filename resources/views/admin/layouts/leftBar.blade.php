<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>

                <!-- Dashboard -->
                <li class="{{ request()->routeIs('dashboard') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Users -->
                @if(auth('admin')->check())
                    <li class="{{ request()->routeIs('users.*') ? 'menuitem-active' : '' }}">
                        <a href="#users" data-bs-toggle="collapse"
                            class="{{ request()->routeIs('users.*') ? '' : 'collapsed' }}">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span>Users</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="users">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('users.create') }}"
                                        class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('users.index') }}"
                                        class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Donations -->
                <li class="{{ request()->routeIs('donation.*') ? 'menuitem-active' : '' }}">
                    <a href="#donations" data-bs-toggle="collapse"
                        class="{{ request()->routeIs('donation.*') ? '' : 'collapsed' }}">
                        <i class="mdi mdi-cash-plus"></i>
                        <span>Donations</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('donation.*') ? 'show' : '' }}" id="donations">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('donation.create') }}"
                                    class="{{ request()->routeIs('donation.create') ? 'active' : '' }}">
                                    Create
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('donation.index')}}"
                                    class="{{ request()->routeIs('donation.index') ? 'active' : '' }}">
                                    List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Projects -->
                @if(auth('admin')->check())
                    <li class="{{ request()->routeIs('projects.*') ? 'menuitem-active' : '' }}">
                        <a href="#projects" data-bs-toggle="collapse"
                            class="{{ request()->routeIs('projects.*') ? '' : 'collapsed' }}">
                            <i class="mdi mdi-folder-outline"></i>
                            <span>Projects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('projects.*') ? 'show' : '' }}" id="projects">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('projects.create') }}"
                                        class="{{ request()->routeIs('projects.create') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('projects.index') }}"
                                        class="{{ request()->routeIs('projects.index') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Events / Workshops -->
                    <li class="{{ request()->routeIs('workshop.*') ? 'menuitem-active' : '' }}">
                        <a href="#events" data-bs-toggle="collapse"
                            class="{{ request()->routeIs('workshop.*') ? '' : 'collapsed' }}">
                            <i class="mdi mdi-calendar"></i>
                            <span>Workshop</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('workshop.*') ? 'show' : '' }}" id="events">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('workshop.create') }}"
                                        class="{{ request()->routeIs('workshop.create') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('workshop.index') }}"
                                        class="{{ request()->routeIs('workshop.index') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Trees -->
                <li>
                    <a href="#trees" data-bs-toggle="collapse">
                        <i class="mdi mdi-tree"></i>
                        <span>Trees</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="trees">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('trees.create') }}">Create</a></li>
                            <li><a href="{{ route('trees.index') }}">Listing</a></li>
                            <li><a href="#">Photos</a></li>
                        </ul>
                    </div>
                </li>

                @if(auth('admin')->check())
                    <li class="{{ request()->routeIs('tree_types.*') ? 'menuitem-active' : '' }}">
                        <a href="#treeTypes" data-bs-toggle="collapse"
                            class="{{ request()->routeIs('tree_types.*') ? '' : 'collapsed' }}">
                            <i class="mdi mdi-calendar"></i>
                            <span>Tree Type</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->routeIs('tree_types.*') ? 'show' : '' }}" id="treeTypes">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('tree_types.create') }}"
                                        class="{{ request()->routeIs('tree_types.create') ? 'active' : '' }}">
                                        Create
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tree_types.index') }}"
                                        class="{{ request()->routeIs('tree_types.index') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tree_names.add') }}"
                                        class="{{ request()->routeIs('tree_names.add') ? 'active' : '' }}">
                                        Add Tree Names
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('tree_names_index') }}"
                                        class="{{ request()->routeIs('tree_names_index') ? 'active' : '' }}">
                                        Detail Tree Names
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
                                        <a href="{{ route('createCurrency') }}"
                                            class="{{ request()->routeIs('createCurrency') ? 'active' : '' }}">
                                            Create
                                        </a>
                                    </li>

                                <li>
                                    <a href="{{ route('currencies') }}"
                                        class="{{ request()->routeIs('currencies') ? 'active' : '' }}">
                                        Listing
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Contact Us Messages -->
                    <li>
                        <a href={{ route('contact.index') }}>
                            <i class="mdi mdi-message"></i>
                            <span>Contact Us Messages</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
