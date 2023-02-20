<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('pelanggans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pelanggans.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Pelanggans</span>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Roles</span>
    </a>
</li>
<li class="nav-item {{ Request::is('sopirs*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('sopirs.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Sopirs</span>
    </a>
</li>
<li class="nav-item {{ Request::is('kategoriMobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kategoriMobils.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Kategori Mobils</span>
    </a>
</li>
<li class="nav-item {{ Request::is('mobils*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('mobils.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Mobils</span>
    </a>
</li>
