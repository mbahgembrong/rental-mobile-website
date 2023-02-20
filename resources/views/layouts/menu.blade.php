<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
        {{-- <i class=" icon-ion-person"></i> --}}
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('pelanggans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pelanggans.index') }}">
        <i class="nav-icon fa fa-users"></i>
        <span>Pelanggans</span>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}">
        <i class="nav-icon fa fa-sitemap"></i>
        <span>Roles</span>
    </a>
</li>
<li class="nav-item {{ Request::is('sopirs*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('sopirs.index') }}">
        <i class="nav-icon fa fa-id-card"></i>
        <span>Sopirs</span>
    </a>
</li>
<li class="nav-item {{ Request::is('kategoriMobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kategoriMobils.index') }}">
        <i class="nav-icon fa fa-tags"></i>
        <span>Kategori Mobils</span>
    </a>
</li>
<li class="nav-item {{ Request::is('mobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('mobils.index') }}">
        <i class="nav-icon fa fa-car"></i>
        <span>Mobils</span>
    </a>
</li>
{{-- <li class="nav-item {{ Request::is('detailMobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('detailMobils.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Detail Mobils</span>
    </a>
</li> --}}
<li class="nav-item {{ Request::is('rentals*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('rentals.index') }}">
        <i class="nav-icon fa fa-taxi"></i>
        <span>Rentals</span>
    </a>
</li>
