<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{ url('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building-o"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.product.index') }}">
                            <i class="fa fa-briefcase"></i> <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.category.index') }}">
                            <i class="fa fa-book"></i> <span>Categories</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building-o"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.product.orders') }}">
                            <i class="fa fa-briefcase"></i> <span>Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.order.delivered') }}">
                            <i class="fa fa-book"></i> <span>Delivered</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ url('backend/sliders') }}">
                    <i class="fa fa-picture-o"></i> <span>Sliders</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('customers.index') }}"><i class="fa fa-circle-o"></i> Customer</a></li>
                    <li><a href="{{ route('admins.index') }}"><i class="fa fa-circle-o"></i> Admin</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ route('backend.image-manager') }}">
                    <i class="fa fa-file-image-o"></i> <span>Image Manager</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('settings.index') }}">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
