@extends('layouts.app')

@section('content')
<div class="bg-light border-bottom py-4 mb-5">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 60px; height: 60px; background-color: var(--moroccan-green); font-size: 1.5rem;">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h2 class="playfair mb-0">Espace Client</h2>
                <p class="text-muted mb-0">Bienvenue, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-5">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush rounded-4 overflow-hidden">
                        <a href="{{ route('client.favorites') }}" class="list-group-item list-group-item-action py-3 px-4 {{ request()->routeIs('client.favorites') ? 'active bg-primary border-primary text-white' : 'text-dark' }}" style="{{ request()->routeIs('client.favorites') ? 'background-color: var(--moroccan-green) !important; border-color: var(--moroccan-green) !important;' : '' }}">
                            <i class="bi bi-heart me-2"></i> Mes Favoris
                        </a>
                        <a href="{{ route('client.profile') }}" class="list-group-item list-group-item-action py-3 px-4 {{ request()->routeIs('client.profile') ? 'active bg-primary border-primary text-white' : 'text-dark' }}" style="{{ request()->routeIs('client.profile') ? 'background-color: var(--moroccan-green) !important; border-color: var(--moroccan-green) !important;' : '' }}">
                            <i class="bi bi-person me-2"></i> Mon Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="list-group-item list-group-item-action py-3 px-4 text-danger border-top">
                                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('client_content')
        </div>
    </div>
</div>
@endsection
