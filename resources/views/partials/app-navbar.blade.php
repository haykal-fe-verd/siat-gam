<div class="navbar-bg"></div>
<nav class="sticky navbar navbar-expand-lg main-navbar text-dark">
    <div class="mr-auto form-inline">
        <ul class="mr-3 navbar-nav">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" id="current-time" class="nav-link nav-link-lg text-dark">{{ date('H:i:s') }}</a>
        </li>
        <li class="dropdown">
            {{-- <a href="#" class="nav-link nav-link-lg text-dark">{{ date('l\, d F Y') }}</a> --}}
            <a href="#"
                class="nav-link nav-link-lg text-dark">{{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}</a>
        </li>
    </ul>
</nav>
