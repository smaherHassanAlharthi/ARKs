@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('consumption_access')
            <li>
                <a href="{{ route('admin.consumptions.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.consumption.title')</span>
                </a>
            </li>@endcan
            
            @can('alert_access')
            <li>
                <a href="{{ route('admin.alerts.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.alerts.title')</span>
                </a>
            </li>@endcan
            
            @can('control_access')
            <li>
                <a href="{{ route('admin.controls.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.control.title')</span>
                </a>
            </li>@endcan
            

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-line-chart"></i>
                    <span class="title">Generated Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   <li class="{{ $request->is('/reports/sum-usage') }}">
                        <a href="{{ url('/admin/reports/sum-usage') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">SUM Usage</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/avg-usage') }}">
                        <a href="{{ url('/admin/reports/avg-usage') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">AVG Usage</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/sum-cost') }}">
                        <a href="{{ url('/admin/reports/sum-cost') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">SUM Cost</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/avg-usage-month') }}">
                        <a href="{{ url('/admin/reports/avg-usage-month') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">AVG Usage Month</span>
                        </a>
                    </li>
                </ul>
            </li>

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

