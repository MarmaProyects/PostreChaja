<x-auth-layout>
    <div class="d-flex dashboard">
        <div class="contenedor">
            <h2>Productos más visitados</h2>
            <div class="chart-container">
                <canvas id="mostVisitedProductsChart"></canvas>
            </div>
        </div>
        <div class="contenedor">
            <h2>Productos por Categoría</h2>
            <div class="chart-container">
                <canvas id="productsByCategoryChart" style="display:flex; text-align:center"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('mostVisitedProductsChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($products_visit->pluck('name')) !!},
                    datasets: [{
                        label: 'Número de Visitas',
                        data: {!! json_encode($products_visit->pluck('visits')) !!},
                        backgroundColor: '#880a0a50',
                        borderColor: '#880a0a',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            const ctx2 = document.getElementById('productsByCategoryChart').getContext('2d');
            const chart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($categories_with_products->pluck('name')) !!},
                    datasets: [{
                        label: 'Cantidad de Productos',
                        data: {!! json_encode($categories_with_products->pluck('products_count')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.4)',
                            'rgba(54, 162, 235, 0.4)',
                            'rgba(255, 206, 86, 0.4)',
                            'rgba(75, 192, 192, 0.4)',
                            'rgba(153, 102, 255, 0.4)',
                            'rgba(255, 159, 64, 0.4)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Productos por Categoría'
                        }
                    }
                }
            });
        });
    </script>
</x-auth-layout>
