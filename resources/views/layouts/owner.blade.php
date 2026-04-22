<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Propriétaire - Darfinder</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Outfit & Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --moroccan-green: #006241;
            --moroccan-gold: #D4AF37;
            --cream-bg: #FEF9F3;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--cream-bg);
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--moroccan-green);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            background-image: url('https://www.transparenttextures.com/patterns/az-subtle.png');
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand i {
            color: var(--moroccan-gold);
        }

        .nav-sidebar {
            padding: 1.5rem 0;
        }

        .nav-sidebar .nav-link {
            padding: 0.8rem 1.5rem;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .nav-sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid var(--moroccan-gold);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .topbar {
            height: 70px;
            background-color: white;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-bottom: 2px solid var(--moroccan-gold);
        }

        .page-container {
            padding: 2rem;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .badge-owner {
            background-color: rgba(0, 98, 65, 0.1);
            color: var(--moroccan-green);
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 50px;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-house-heart-fill"></i> Darfinder
        </div>
        <div class="nav-sidebar">
            <a href="{{ route('owner.dashboard') }}" class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Tableau de Bord
            </a>
            <a href="{{ route('owner.properties.index') }}" class="nav-link {{ request()->routeIs(['owner.properties.index', 'owner.properties.edit', 'owner.properties.show']) ? 'active' : '' }}">
                <i class="bi bi-buildings"></i> Mes Propriétés
            </a>
            <a href="{{ route('owner.properties.create') }}" class="nav-link {{ request()->routeIs('owner.properties.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Ajouter un Bien
            </a>

            <a href="{{ route('owner.profile') }}" class="nav-link {{ request()->routeIs('owner.profile') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Mon Profil
            </a>
            <div class="mt-5 pt-5 border-top border-secondary opacity-25 mx-3"></div>
            <a href="/" class="nav-link">
                <i class="bi bi-arrow-left-circle"></i> Retour au Site
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-grid mt-2 mx-3">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm border-0 d-flex align-items-center">
                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <header class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn d-lg-none me-3" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <h4 class="mb-0 fw-bold header-title">@yield('title', 'Espace Propriétaire')</h4>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-4 d-none d-md-block">
                    <span class="badge badge-owner">Propriétaire Privilège</span>
                </div>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="bg-moroccan-green text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; background-color: var(--moroccan-green);">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="fw-600 d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                        <li><a class="dropdown-item" href="{{ route('owner.profile') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-settings me-2"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="page-container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    @yield('scripts')
</body>
</html>
