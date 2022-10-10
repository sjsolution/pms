  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('admin.dashboard')}}" class="brand-link">
          <img src="{{ asset('public/hms/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Real Estate</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <br>
                  @if (Auth::user()->hasRole('admin'))
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon far fa-building"></i>
                              <p>
                                  Property Registration
                                  <i class="fas fa-angle-left right"></i>
                                  <span class="badge badge-info right"></span>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('admin.property.create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('admin.property.index') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon far fa-building"></i>
                              <p>
                                  FlatType
                                  <i class="fas fa-angle-left right"></i>
                                  <span class="badge badge-info right"></span>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('admin.flattype.create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('admin.flattype.index') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon far fa-building"></i>
                              <p>
                                  Property Rentals
                                  <i class="fas fa-angle-left right"></i>
                                  <span class="badge badge-info right"></span>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('admin.propertyrental.create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('admin.propertyrental.index') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  @endif

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-building"></i>
                          <p>
                              Property Rentals Daily
                              <i class="fas fa-angle-left right"></i>
                              <span class="badge badge-info right"></span>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('admin.propertyrentaldaily.create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.propertyrentaldaily.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @if (Auth::user()->hasRole('admin'))
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fa fa-users"></i>
                              <p>
                                  Users
                                  <i class="fas fa-angle-left right"></i>
                                  <span class="badge badge-info right"></span>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('admin.user.create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('admin.user.index') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fa fa-file"></i>
                              <p>
                                  Documents
                                  <i class="fas fa-angle-left right"></i>
                                  <span class="badge badge-info right"></span>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('admin.document.create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('admin.document.index') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  @endif
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-duotone fa-flag"></i>
                          <p>
                              Reports
                              <i class="fas fa-angle-left right"></i>
                              <span class="badge badge-info right"></span>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('admin.report.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Period wise Report</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.report.prostatus') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Property Status</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.report.propertywise') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Property Wise Report</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.report.receiveable_status') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Receiveable Status</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.report.paymentproperty') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Property Payment</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
