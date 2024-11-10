<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ url('/') }}/images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/images/logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ url('/') }}/dashboard" class="nav-link treeview-dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/calendar" class="nav-link treeview-calendar">              
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Calendar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/reservations" class="nav-link treeview-reservations">              
              <i class="nav-icon fas fa-book"></i>
              <p>Reservations</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/rooms" class="nav-link treeview-rooms">              
              <i class="nav-icon fas fa-person-booth"></i>
              <p>Rooms</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/employees" class="nav-link treeview-employees">              
              <i class="nav-icon fas fa-address-book"></i>
              <p>Employees</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/reports" class="nav-link treeview-reports">              
              <i class="nav-icon fas fa-chart-pie"></i>
              
              <p>Reports</p>
            </a>
          </li>            
          <li class="nav-item">          
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <i class="nav-icon fas fa-th"></i>
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!-- 
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="{{ url('/') }}/dashboard" class="brand-link">
      <img src="{{ url('/') }}/dist/img/AdminLTELogo.png" alt="5MServices" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">5MServices</span>
    </a>

    
    <div class="sidebar">
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('/') }}/dashboard" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ url('/') }}/pos" class="nav-link treeview-pos-order">
              <i class="nav-icon fa fa-plus-circle"></i>
              <p>ORDER</p>
            </a>
          </li>
          <li class="nav-item menu-products">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/categories" class="nav-link treeview-pos-category">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/products" class="nav-link treeview-pos-products">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
               
            </ul>
          </li>
          <li class="nav-item menu-posreports">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/reports/orders" class="nav-link treeview-pos-category">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/products" class="nav-link treeview-pos-products">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-posreports">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Accounting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/reports/orders" class="nav-link treeview-pos-category">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/products" class="nav-link treeview-pos-products">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-posreports">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                HR
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/reports/orders" class="nav-link treeview-pos-category">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/products" class="nav-link treeview-pos-products">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-posreports">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Tax
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/reports/orders" class="nav-link treeview-pos-category">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/') }}/pos/products" class="nav-link treeview-pos-products">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      
    </div>
    
  </aside> -->