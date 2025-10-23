<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-light d-lg-none" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav ms-auto">

        {{-- Gunakan directive @auth untuk mengecek --}}
        @auth
            {{-- Kode ini HANYA akan tampil jika user sudah login --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i>
                    {{ Auth::user()->nama_lengkap }} {{-- Aman di sini --}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        @else
            {{-- Opsional: Tampilkan link Login jika user belum login --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </li>
        @endauth

    </ul>
    </div>
</nav>
