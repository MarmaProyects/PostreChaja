<x-auth-layout>
    <div class="dashboard">
        <div class="d-flex">
            <div class="contenedor">
                <h2>Compras Mensuales</h2>
                <div class="chart-container">
                    <canvas id="monthlyPurchasesChart"></canvas>
                </div>
            </div>
            <div class="contenedor">
                <h2>Productos más vendidos</h2>
                <div class="chart-container">
                    <canvas id="mostSoldProductsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="contenedor">
                <h2>Productos más visitados</h2>
                <div class="chart-container">
                    <canvas id="mostVisitedProductsChart"></canvas>
                </div>
            </div>
            <div class="contenedor">
                <h2>Productos favoritos de los clientes</h2>
                <div class="chart-container">
                    <canvas id="favoriteChart" style="display:flex; text-align:center"></canvas>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="contenedor">
                <h2>Productos por Categoría</h2>
                <div class="chart-container">
                    <canvas id="productsByCategoryChart" style="display:flex; text-align:center"></canvas>
                </div>
            </div>
            <div class="contenedor">
                <h2>Clientes con más estrellas</h2>
                <div class="chart-container">
                    <canvas id="topClientsChart"></canvas>
                </div>
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

            const ctx3 = document.getElementById('favoriteChart').getContext('2d');
            const chart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($products_favorites->pluck('name')) !!},
                    datasets: [{
                        label: 'Cantidad de Favoritos',
                        data: {!! json_encode($products_favorites->pluck('favorites_count')) !!},
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
                            text: 'Productos Favoritos'
                        }
                    }
                }
            });

            const ctx4 = document.getElementById('monthlyPurchasesChart').getContext('2d');
            const monthlyPurchasesChart = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($monthly_data->pluck('month')) !!},
                    datasets: [{
                            label: 'Ganancias Totales',
                            data: {!! json_encode($monthly_data->pluck('total_revenue')) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.4)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Cantidad de Compras',
                            data: {!! json_encode($monthly_data->pluck('total_purchases')) !!},
                            backgroundColor: 'rgba(255, 99, 132, 0.4)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Compras Mensuales y Ganancias'
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value.toFixed(2);
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return value;
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            const ctx5 = document.getElementById('mostSoldProductsChart').getContext('2d');
            const mostSoldProductsChart = new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($products_sold->pluck('name')) !!},
                    datasets: [{
                        label: 'Cantidad Vendida',
                        data: {!! json_encode($products_sold->pluck('total_sold')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.4)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
                            text: 'Productos Más Vendidos'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx6 = document.getElementById('topClientsChart').getContext('2d');
            const topClientsChart = new Chart(ctx6, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($clients_with_stars->pluck('fullname')) !!},
                    datasets: [{
                        label: 'Total de Estrellas',
                        data: {!! json_encode($clients_with_stars->pluck('total_stars')) !!},
                        backgroundColor: 'rgba(255, 206, 86, 0.4)',
                        borderColor: 'rgba(255, 206, 86, 1)',
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
                            text: 'Clientes con Más Estrellas'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-auth-layout>
