<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    @php 
        $user = \Auth::guard('admin')->user();
        $role = \Spatie\Permission\Models\Role::where('name', 'Manager')->first();
    @endphp 

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-text mx-3">Easy Bangladesh</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gig Category Management
    </div>

    
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
                aria-expanded="true" aria-controls="categories">
                <i class="fas fa-fw fa-cog"></i>
                <span>Category Manage</span>
            </a>
            <div id="categories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Categories</h6>
                    <a class="collapse-item" href="{{ route('admin.categories.index') }}">Categories</a>
                    <a class="collapse-item" href="{{ route('admin.subcategories.index') }}">Subcategories</a>
                    <a class="collapse-item" href="{{ route('admin.subsubcategories.index') }}">Sub Subcategories</a>
                </div>
            </div>
        </li> 
   
        

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gigs"
                aria-expanded="true" aria-controls="gigs">
                <i class="fas fa-fw fa-cog"></i>
                <span>Gigs Manage</span>
            </a>
            <div id="gigs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gigs pages</h6>
                    <a class="collapse-item" href="buttons.html">All</a>
                </div>
            </div>
        </li> 

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orders"
                aria-expanded="true" aria-controls="orders">
                <i class="fas fa-fw fa-cog"></i>
                <span>Orders</span>
            </a>
            <div id="orders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Order pages</h6>
                    <a class="collapse-item" href="{{ route('admin.orders', ['status' => 'all']) }}">All</a>
                    <a class="collapse-item" href="{{ route('admin.orders', ['status' => 'pending']) }}">Pending</a>
                    <a class="collapse-item" href="{{ route('admin.orders', ['status' => 'inprogress']) }}">Inprogress</a>
                    <a class="collapse-item" href="{{ route('admin.orders', ['status' => 'completed']) }}">Completed</a>
                    <a class="collapse-item" href="{{ route('admin.orders', ['status' => 'cancel']) }}">Cancelled</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#withrawRequests"
                aria-expanded="true" aria-controls="withrawRequests">
                <i class="fas fa-fw fa-cog"></i>
                <span>Withdraw Requests</span>
            </a>
            <div id="withrawRequests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Withdraw Requests</h6>
                    <a class="collapse-item" href="{{ route('admin.withdraw.requests', ['status' => 'all']) }}">All</a>
                    <a class="collapse-item" href="{{ route('admin.withdraw.requests', ['status' => 'pending']) }}">Pending</a>
                    <a class="collapse-item" href="{{ route('admin.withdraw.requests', ['status' => 'inprogress']) }}">Inprogress</a>
                    <a class="collapse-item" href="{{ route('admin.withdraw.requests', ['status' => 'completed']) }}">Completed</a>
                    <a class="collapse-item" href="{{ route('admin.withdraw.requests', ['status' => 'reject']) }}">Reject</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.transactions') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Transactions</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Business Settings
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.settings') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Settings</span></a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Permission Settings
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#permissionsRole"
                aria-expanded="true" aria-controls="permissionsRole">
                <i class="fas fa-fw fa-cog"></i>
                <span>Permissions Settings</span>
            </a>
            <div id="permissionsRole" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Permissions</h6>
                    <a class="collapse-item" href="{{ route('admin.employees.index') }}">Employees</a>
                    <a class="collapse-item" href="{{ route('admin.permissions.index') }}">Permissions</a>
                    <a class="collapse-item" href="{{ route('admin.roles.index') }}">Roles</a>
                
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Chatting
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.chatting') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Chatting</span></a>
        </li>

    
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Sidebar Toggle -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>