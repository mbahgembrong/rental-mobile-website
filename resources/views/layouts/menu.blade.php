<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
        {{-- <i class=" icon-ion-person"></i> --}}
        <span>Pegawai</span>
    </a>
</li>
<li class="nav-item {{ Request::is('pelanggans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pelanggans.index') }}">
        <i class="nav-icon fa fa-users"></i>
        <span>Pelanggan</span>
    </a>
</li>
<li class="nav-item {{ Request::is('sopirs*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('sopirs.index') }}">
        <i class="nav-icon fa fa-id-card"></i>
        <span>Sopir</span>
    </a>
</li>
<li class="nav-item {{ Request::is('kategoriMobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kategoriMobils.index') }}">
        <i class="nav-icon fa fa-tags"></i>
        <span>Kategori Mobil</span>
    </a>
</li>
<li class="nav-item {{ Request::is('mobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('mobils.index') }}">
        <i class="nav-icon fa fa-car"></i>
        <span>Mobil</span>
    </a>
</li>
<li class="nav-item {{ Request::is('rentals*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('rentals.index') }}">
        <i class="nav-icon fa fa-taxi"></i>
        <span>Rental</span>
    </a>
</li>
