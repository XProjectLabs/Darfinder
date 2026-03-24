@extends('layouts.owner')

@section('title', 'Statistiques et Performance')

@section('content')
<div class="row g-4">
    <div class="col-lg-12">
        <div class="card card-custom p-4">
            <h5 class="playfair fw-bold mb-4">Vue d'ensemble de la performance</h5>
            <canvas id="performanceChart" height="100"></canvas>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-custom p-4">
            <h5 class="playfair fw-bold mb-4">Vues par Propriété</h5>
            <canvas id="viewsChart"></canvas>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-custom p-4">
            <h5 class="playfair fw-bold mb-4">Favoris par Propriété</h5>
            <canvas id="favoritesChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const propertyLabels = {!! json_encode($properties->pluck('title')) !!};
    const propertyViews = {!! json_encode($properties->pluck('views_count')) !!};
    const propertyFavorites = {!! json_encode($properties->pluck('favorites_count')) !!};

    // Performance Chart (Bar chart for views)
    new Chart(document.getElementById('performanceChart'), {
        type: 'bar',
        data: {
            labels: propertyLabels,
            datasets: [{
                label: 'Nombre de vues',
                data: propertyViews,
                backgroundColor: 'rgba(0, 98, 65, 0.6)',
                borderColor: '#006241',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Views Pie Chart
    new Chart(document.getElementById('viewsChart'), {
        type: 'doughnut',
        data: {
            labels: propertyLabels,
            datasets: [{
                data: propertyViews,
                backgroundColor: [
                    '#006241', '#D4AF37', '#0076B6', '#E63946', '#F1FAEE', '#A8DADC'
                ]
            }]
        }
    });

    // Favorites Chart
    new Chart(document.getElementById('favoritesChart'), {
        type: 'line',
        data: {
            labels: propertyLabels,
            datasets: [{
                label: 'Mises en favoris',
                data: propertyFavorites,
                borderColor: '#D4AF37',
                backgroundColor: 'rgba(212, 175, 55, 0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });
</script>
@endsection
