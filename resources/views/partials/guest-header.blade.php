<header id="header" class="fixed-top d-flex align-items-center {{ request()->is('/') ? 'header-transparent' : '' }}">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid"></a>
            {{-- <h1 class="text-light"><a href="index.html"><span>{{ config('app.name') }}</span></a></h1> --}}
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                <li><a class="{{ request()->is('artikel*') ? 'active' : '' }}"
                        href="{{ route('all.berita') }}">Berita</a></li>
                <li><a class="{{ request()->is('pemasukans*') ? 'active' : '' }}"
                        href="{{ route('all.pemasukan') }}">Pemasukan</a></li>
                <li><a class="{{ request()->is('pengeluarans*') ? 'active' : '' }}"
                        href="{{ route('all.pengeluaran') }}">Pengeluaran</a></li>
                <li><a class="{{ request()->is('pengaduan') ? 'active' : '' }}"
                        href="{{ route('pengaduan') }}">Pengaduan</a>
                </li>
                <li><a class="{{ request()->is('laporan-akhir*') ? 'active' : '' }}"
                        href="{{ route('all.lap.akhir') }}">Laporan Akhir</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
