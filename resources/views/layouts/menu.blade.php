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
