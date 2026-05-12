<nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3 mb-0 shadow" style="background-color: var(--p-purple) !important; border-bottom: 3px solid var(--s-gold);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-black fs-3" href="{{ route('dashboard') }}">
            <div class="bg-white p-2 rounded-3 me-2">
                <i class="bi bi-book-half fs-4" style="color: var(--p-purple);"></i>
            </div>
            <span class="text-white">NGAWI <span style="color: var(--s-gold);">PERPUS</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list text-white fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-lg-4 gap-2">
                <li class="nav-item">
                    <a class="nav-link text-white opacity-75 {{ request()->routeIs('dashboard') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('dashboard') }}">DASHBOARD</a>
                </li>
                
                @if(Auth::user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('admin.inventory') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('admin.inventory') }}">INVENTARIS</a></li>
                    <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('admin.reports') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('admin.reports') }}">LAPORAN</a></li>
                @endif

                @if(Auth::user()->role === 'pegawai' || Auth::user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('staff.books.*') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('staff.books.index') }}">KELOLA BUKU</a></li>
                    <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('staff.loans.index') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('staff.loans.index') }}">SIRKULASI</a></li>
                @endif

                <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('books.browse') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('books.browse') }}">KATALOG</a></li>
                <li class="nav-item"><a class="nav-link text-white opacity-75 {{ request()->routeIs('chat.index') ? 'active fw-bold opacity-100' : '' }}" href="{{ route('chat.index') }}">CHAT Q&A</a></li>
            </ul>

            <div class="dropdown">
                <button class="btn btn-warning rounded-pill px-4 dropdown-toggle fw-bold d-flex align-items-center gap-2 shadow-sm" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2 rounded-4">
                    <li><h6 class="dropdown-header text-uppercase x-small fw-bold opacity-50">Akun Saya</h6></li>
                    <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                    <li><a class="dropdown-item rounded-3 py-2" href="{{ route('loans.mine') }}"><i class="bi bi-clock-history me-2"></i> Riwayat Pinjam</a></li>
                    <li><hr class="dropdown-divider opacity-10"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-bold">
                                <i class="bi bi-box-arrow-right me-2"></i> KELUAR
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
