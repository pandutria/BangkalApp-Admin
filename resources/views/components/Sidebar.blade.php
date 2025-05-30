<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SideBar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <ul class="navbar-nav bodyPrimary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-icon">
                <i class="fas fa-user-cog" style="font-size: 20px;"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Bangkal App</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-home"></i>
                <span>Beranda</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Desa
        </div>

        <li class="nav-item">
            <a class="nav-link" href="/news">
                <i class="fas fa-newspaper"></i>
                <span>Berita</span>
            </a>
            <a class="nav-link" href="/announcement">
                <i class="fas fa-bullhorn rotate-n-15"></i>
                <span>Pengumuman</span>
            </a>
            <a class="nav-link" href="/history">
                <i class="fas fa-book"></i>
                <span>Sejarah</span>
            </a>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Penduduk
        </div>

        <li class="nav-item">
            <a class="nav-link" href="/potential">
                <i class="fas fa-map-marked-alt"></i>
                <span>Potensi</span>
            </a>
            <a class="nav-link" href="/village">
                <i class="fas fa-users"></i>
                <span>Desa</span>
            </a>
            <a class="nav-link" href="/organization">
                <i class="fas fa-house-user"></i>
                <span>Organisasi</span>
            </a>
        </li>        

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Penduduk
        </div>

        <li class="nav-item">
            <a class="nav-link" href="/letter-types">
                <i class="fas fa-envelope-square"></i>
                <span>Kategori Surat</span>
            </a>
            <a class="nav-link" href="/letters">
                <i class="fas fa-envelope-open-text"></i>
                <span>Surat</span>
            </a>
        </li>        

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</body>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>