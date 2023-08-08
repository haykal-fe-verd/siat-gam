<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                <img alt="Logo Desa" src="/logo.png" class="header-logo" />
                <span class="logo-name">{{ config('app.name') }}</span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i data-feather="layers"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @can('admin')
                <li class="dropdown {{ request()->routeIs('berita*') ? 'active' : '' }}">
                    <a href="{{ route('berita.index') }}" class="nav-link">
                        <i data-feather="file-text"></i>
                        <span>Berita</span>
                    </a>
                </li>
                <li class="dropdown {{ request()->routeIs('verifikasi*') ? 'active' : '' }}">
                    <a href="{{ route('verifikasi.index') }}" class="nav-link">
                        <i data-feather="zap"></i>
                        <span>Verifikasi</span>
                    </a>
                </li>
                <li class="dropdown {{ request()->routeIs('pemasukan*') ? 'active' : '' }}">
                    <a href="{{ route('pemasukan.index') }}" class="nav-link">
                        <i data-feather="trending-up"></i>
                        <span>Pemasukan</span>
                    </a>
                </li>
                <li class="dropdown {{ request()->routeIs('pengeluaran*') ? 'active' : '' }}">
                    <a href="{{ route('pengeluaran.index') }}" class="nav-link">
                        <i data-feather="trending-down"></i>
                        <span>Pengeluaran</span>
                    </a>
                </li>
            @endcan

            @can('keuchik')
                <li class="dropdown {{ Str::startsWith(request()->path(), 'keuchik/verifikasi') ? 'active' : '' }}">
                    <a href="{{ route('verifikasi.keuchik.index') }}" class="nav-link">
                        <i data-feather="check-square"></i>
                        <span>Verifikasi</span>
                    </a>
                </li>

                <li class="dropdown {{ Str::startsWith(request()->path(), 'keuchik/pengaduan') ? 'active' : '' }}">
                    <a href="{{ route('pengaduan.keuchik.index') }}" class="nav-link">
                        <i data-feather="volume-2"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>
            @endcan


            <li class="dropdown {{ request()->routeIs('profile*') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="nav-link">
                    <i data-feather="user"></i>
                    <span>Profil</span>
                </a>
            </li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="dropdown">
                    <a href="{{ route('logout') }}" class="nav-link text-danger"
                        onclick="event.preventDefault();
                this.closest('form').submit();">
                        <i data-feather="log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </form>
        </ul>
    </aside>
</div>
