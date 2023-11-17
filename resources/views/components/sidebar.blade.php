<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">Tambang Nikel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard">TN</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard.') ? 'active' : '' }}"><a href="/dashboard" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @can('hasRole', 'admin')

            <li class="menu-header">Master</li>
            <li class="{{ request()->routeIs('dashboard.mines.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.mines.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Tambang</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.companies.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.companies.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Perusahaan</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.drivers.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.drivers.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Driver</span></a>
            </li>
            <li class="{{ request()->routeIs('dashboard.vehicles.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.vehicles.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Kendaraan</span></a>
            </li>
            @endcan
            <li class="menu-header">Orders</li>
            <li class="{{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.orders.index') }}" class="nav-link"><i
                        class="fas fa-box-open"></i><span>Pemesanan Kendaraan</span></a>
            </li>
        </ul>
    </aside>
</div>