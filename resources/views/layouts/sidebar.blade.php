<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light px-4" style="font-size: 1.1em;">KZ Coffee</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon icon ion-md-pulse"></i>
                            <p>
                                About Us
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon icon ion-md-apps"></i>
                            <p>
                                Apps
                                <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Category::class)
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Type::class)
                                <li class="nav-item">
                                    <a href="{{ route('types.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Jenis</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Menu::class)
                                <li class="nav-item">
                                    <a href="{{ route('menus.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Menu</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Stock::class)
                                <li class="nav-item">
                                    <a href="{{ route('stocks.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Stok</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Customer::class)
                                <li class="nav-item">
                                    <a href="{{ route('customers.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Pelanggan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Table::class)
                                <li class="nav-item">
                                    <a href="{{ route('tables.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Meja</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Order::class)
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Orders</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Employee::class)
                                <li class="nav-item">
                                    <a href="{{ route('employees.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Karyawan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\User::class)
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\ProdukTitipan::class)
                                <li class="nav-item">
                                    <a href="{{ route('produk-titipans.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Produk Titipan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Transaction::class)
                                <li class="nav-item">
                                    <a href="{{ route('transaction.index') }}" class="nav-link">
                                        <i class="nav-icon icon ion-md-radio-button-off"></i>
                                        <p>Transaksi</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                            Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon icon ion-md-key"></i>
                                <p>
                                    Access
                                    <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('view-any', Spatie\Permission\Models\Role::class)
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view-any', Spatie\Permission\Models\Permission::class)
                                    <li class="nav-item">
                                        <a href="{{ route('permissions.index') }}" class="nav-link">
                                            <i class="nav-icon icon ion-md-radio-button-off"></i>
                                            <p>Permissions</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                @endauth

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon icon ion-md-exit"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
