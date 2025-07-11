<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/images/logojb.png') }}" alt="Jastip Besties Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JB Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(Auth::guard('admin')->user()->image))
                <img src="{{ asset('admin/images/photos/' . Auth::guard('admin')->user()->image) }}"
                    class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('admin/images/no_image.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Session::get('page') == 'dashboard')
                @php $active='active' @endphp
                @else
                @php $active='' @endphp
                @endif

                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                @if (Auth::guard('admin')->user()->type == 'admin')
                @if (Session::get('page') == 'update-password' ||
                Session::get('page') == 'update-details' ||
                Session::get('page') == 'subadmins')
                @php $active='active' @endphp
                @php $open='menu-open' @endphp
                @else
                @php $active='' @endphp
                @php $open='' @endphp
                @endif
                <li class="nav-item {{ $open }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manajemen Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'update-password')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-password') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perbarui Sandi Admin</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'update-details')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-details') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perbarui Detail Admin</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'subadmins')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/subadmins') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Admin Manjemen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Session::get('page') == 'user')
                @php $active='active' @endphp
                @else
                @php $active='' @endphp
                @endif

                <li class="nav-item">
                    <a href="{{ url('admin/user') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                @endif



                @if (Session::get('page') == 'cms-pages' || Session::get('page') == 'banners')
                @php $active='active' @endphp
                @php $open='menu-open' @endphp
                @else
                @php $active='' @endphp
                @php $open='' @endphp
                @endif

                <li class="nav-item {{ $open }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Manajemen Halaman
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'cms-pages')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/cms-pages') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Halaman CMS</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'banners')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/banners') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (Session::get('page') == 'categories' ||
                Session::get('page') == 'products' ||
                Session::get('page') == 'brands' ||
                Session::get('page') == 'banners')
                @php $active='active' @endphp
                @php $open='menu-open' @endphp
                @else
                @php $active='' @endphp
                @php $open='' @endphp
                @endif
                <li class="nav-item {{ $open }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Katalog
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'categories')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/categories') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'products')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/products') }}" class="nav-link {{ $active }}">
                                <i class="nav-icon far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'brands')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/brands') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Merek</p>
                            </a>
                        </li>

                    </ul>
                </li>


                @if (Session::get('page') == 'pesanan' ||
                Session::get('page') == 'request' ||
                Session::get('page') == 'laporan')
                @php $active='active' @endphp
                @php $open='menu-open' @endphp
                @else
                @php $active='' @endphp
                @php $open='' @endphp
                @endif
                <li class="nav-item {{ $open }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Order
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'pesanan')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/pesanan') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pesanan</p>
                            </a>
                        </li>

                        @if (Session::get('page') == 'request')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/request') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Product</p>
                            </a>
                        </li>

                        @if (Session::get('page') == 'laporan')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/laporan') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan</p>
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