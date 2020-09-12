
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>الرئيسية</span></a>
        </li>
    @if(auth()->user()->hasPermission('read_governorates'))
        <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('governorates.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>المحافظات</span></a>
        </li>
        @endif
        @if(auth()->user()->hasPermission('read_cities'))

        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('cities.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> المدن </span></a>
        </li>
        @endif
        @if(auth()->user()->hasPermission('read_bloodTypes'))

        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('blood-types.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> فصيلة الدم </span></a>
        </li>
        @endif
        @if(auth()->user()->hasPermission('read_categories'))

        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> الأقسام </span></a>
        </li>
        @endif
        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('setting.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> الاعدادات </span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('reports.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> التقارير </span></a>
        </li>
        @if(auth()->user()->hasPermission('read_posts'))
        <hr class="sidebar-divider">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('post.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> المقالات </span></a>
        </li>
        @endif
        <hr class="sidebar-divider">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('donation.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> طلبات التبرع </span></a>
        </li>
        @if(auth()->user()->hasPermission('read_users'))
        <hr class="sidebar-divider">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> المشرفين </span></a>
        </li>
        @endif
        <hr class="sidebar-divider">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('clients.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span> العملاء </span></a>
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
