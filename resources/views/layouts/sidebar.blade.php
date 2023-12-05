@switch(strtolower(Auth::user()->role))
    @case('banksampah')
        <div class="sidebar bg-dark">
            <ul class="list-unstyled mt-4">
                <li class="mb-3">
                    <a href="/dashboard" class="nav-link" aria-current="page">
                        <i class="bi bi-house-door-fill mr-3"></i>
                        Home
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('banksampah.petugas') }}" class="nav-link link-body-emphasis ">
                        <i class="bi bi-person-badge-fill mr-3"></i>
                        Petugas
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('banksampah.penerimaan') }}" class="nav-link link-body-emphasis">
                        <i class="bi bi-cart-plus-fill mr-3"></i>
                        Penerimaan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('banksampah.histori') }}" class="nav-link link-body-emphasis">
                        <i class="bi bi-cart-plus-fill mr-3"></i>
                        Histori
                    </a>
                </li>
            </ul>
        </div>
    @break

    @default
        <div class="sidebar bg-dark">
            <ul class="list-unstyled mt-4">
                <li class="mb-3">
                    <a href="/dashboard" class="nav-link" aria-current="page">
                        <i class="bi bi-house-door-fill mr-3"></i>
                        Home
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pengguna.buangsampah') }}" class="nav-link link-body-emphasis ">
                        <i class="bi bi-trash3-fill mr-3"></i>
                        Buang sampah
                    </a>
                </li>
                <li class="mb-3">
                    <a href="{{ route('pengguna.transaksi') }}" class="nav-link link-body-emphasis ">
                        <i class="bi bi-cash mr-3"></i>
                        Transaksi
                    </a>
                </li>
            </ul>
        </div>

@endswitch
