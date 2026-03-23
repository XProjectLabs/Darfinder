<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darfinder - Trouvez votre perle rare au Maroc</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Outfit & Playfair Display for Elegance -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --moroccan-green: #006241;
            --moroccan-gold: #D4AF37;
            --moroccan-blue: #0076B6;
            --cream-bg: #FEF9F3;
            --dark-text: #1A1A1A;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--cream-bg);
            color: var(--dark-text);
        }

        h1, h2, h3, .playfair {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 3px solid var(--moroccan-green);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--moroccan-green) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 8px;
            color: var(--moroccan-gold);
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark-text) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--moroccan-green) !important;
        }

        .btn-primary {
            background-color: var(--moroccan-green);
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004d33;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 98, 65, 0.2);
        }

        .btn-outline-primary {
            color: var(--moroccan-green);
            border: 2px solid var(--moroccan-green);
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--moroccan-green);
            color: white;
        }

        .zellige-pattern {
            background-image: url('https://www.transparenttextures.com/patterns/az-subtle.png');
            background-color: var(--moroccan-green);
        }

        .footer {
            background-color: #121212;
            color: #ffffff;
            padding: 80px 0 40px;
            border-top: 5px solid var(--moroccan-gold);
        }

        .footer h5 {
            color: var(--moroccan-gold);
            font-weight: 700;
            margin-bottom: 25px;
        }

        .hero-section {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 85vh;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 0 0 50px 50px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.2));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .card-price {
            color: var(--moroccan-green);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .badge-status {
            background-color: rgba(0, 98, 65, 0.1);
            color: var(--moroccan-green);
            font-weight: 600;
            padding: 6px 15px;
            border-radius: 50px;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 60%;
            height: 4px;
            background-color: var(--moroccan-gold);
            border-radius: 2px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-house-heart-fill"></i> Darfinder
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Propriétés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Villes</a>
                    </li>
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary" href="{{ route('register') }}">Commencer</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i> Favoris</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4">
                    <h4 class="playfair text-white mb-3">Darfinder</h4>
                    <p class="text-secondary">Votre plateforme de référence pour l'immobilier au Maroc. Authenticité, modernité et proximité.</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Navigation Rapide</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none hover-white">Acheter une propriété</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Louer un appartement</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Villes populaires</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Aide & Support</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p class="text-secondary mb-2"><i class="bi bi-geo-alt-fill me-2 text-gold"></i> Casablanca, Maroc</p>
                    <p class="text-secondary mb-2"><i class="bi bi-telephone-fill me-2 text-gold"></i> +212 5 22 00 00 00</p>
                    <p class="text-secondary mb-4"><i class="bi bi-envelope-fill me-2 text-gold"></i> contact@darfinder.ma</p>
                    <div class="input-group">
                        <input type="email" class="form-control bg-transparent border-secondary text-white" placeholder="Votre email">
                        <button class="btn btn-primary" type="button">Joindre</button>
                    </div>
                </div>
            </div>
            <hr class="mt-5 mb-4 border-secondary opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-secondary">&copy; 2026 Darfinder Maroc. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-secondary text-decoration-none small me-3">Mentions légales</a>
                    <a href="#" class="text-secondary text-decoration-none small">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
