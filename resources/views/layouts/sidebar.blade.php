<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">MANAJEMEN Admin</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('matkul.index') }}">
                <i class="nav-icon icon-drop"></i>Mata Kuliah
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kelas.index') }}">
                <i class="nav-icon icon-drop"></i>Kelas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dosen.index') }}">
                <i class="nav-icon icon-drop"></i>Dosen
            </a>
        </li>
    </ul>
</nav>
