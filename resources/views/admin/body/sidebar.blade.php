@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"> <img alt="image" src="{{ asset('assets/img/logo.png') }}"
                    class="header-logo" />
                <span class="logo-name">NB-AUTOMOTIVE</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="menu"></i><span
                        class="active">Dashboard</span></a>
            </li>

            <li class="dropdown {{ $prefix == '/purchase' ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="shopping-bag"></i></i><span>purchase</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'purchase.view' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('purchase.view') }}">Manage Purchases</a></li>
                </ul>
            </li>

            <li class="dropdown {{ $prefix == '/inventory' ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="package"></i></i><span>Inventory</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'inventory.view' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('inventory.view') }}">Manage Inventory</a></li>
                </ul>
            </li>

            <li class="dropdown {{ $prefix == '/reports' ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="server"></i></i><span>Reports</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'reports.view' ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('reports.view') }}">View Reports</a></li>
                </ul>
            </li>

            <li class="menu-header">User</li>
            <li class="{{ $route == 'users' ? 'active' : '' }}">
                <a href="{{ route('users') }}" class="nav-link"><i data-feather="users"></i><span
                        class="active">Users</span></a>
            </li>


        <li class="menu-header">Contacts</li>
            <li class="{{ $route == 'comment' ? 'active' : '' }}">
                <a href="{{ route('comment') }}" class="nav-link"><i data-feather="message-circle"></i><span
                        class="active">Comments</span></a>
            </li>
        </ul>
    </aside>
</div>



{{-- <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1"
                            class="selectgroup-input-radio select-layout" checked>
                        <span class="selectgroup-button">Light</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2"
                            class="selectgroup-input-radio select-layout">
                        <span class="selectgroup-button">Dark</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="1"
                            class="selectgroup-input select-sidebar">
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="2"
                            class="selectgroup-input select-sidebar" checked>
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                    <ul class="choose-theme list-unstyled mb-0">
                        <li title="white" class="active">
                            <div class="white"></div>
                        </li>
                        <li title="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li title="black">
                            <div class="black"></div>
                        </li>
                        <li title="purple">
                            <div class="purple"></div>
                        </li>
                        <li title="orange">
                            <div class="orange"></div>
                        </li>
                        <li title="green">
                            <div class="green"></div>
                        </li>
                        <li title="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox"
                            class="custom-switch-input" id="mini_sidebar_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Mini Sidebar</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox"
                            class="custom-switch-input" id="sticky_header_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Sticky Header</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                    <i class="fas fa-undo"></i> Restore Default
                </a>
            </div>
        </div>
    </div>
</div> --}}
