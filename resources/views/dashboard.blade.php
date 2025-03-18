@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Visão Geral - Dashboard</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card card-custom bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Custo Total</h5>
                    <p class="card-text">R$ 50,000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-custom bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Receita</h5>
                    <p class="card-text">R$ 100,000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-custom bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Lucro</h5>
                    <p class="card-text">R$ 50,000</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h3>Despesas e Receitas por Mês</h3>
            
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="splitByCategory">
                <label class="form-check-label" for="splitByCategory">Dividir por Categoria</label>
            </div>
            <div style="position: relative; height: 400px; width: 100%;">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h3>Número Atual de Empregados</h3>
            <p class="lead">{{$employees}} Empregado(s)</p> <!-- Replace with dynamic data -->
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    let chart;

    function updateChart(splitByCategory) {
        if (chart) chart.destroy();

        let datasets = [];
        if (splitByCategory) {
            @foreach ($categories as $category)
                datasets.push({
                    label: '{{ $category->name }} (R$)',
                    data: @json($categoryExpenses[$category->id]),
                    borderColor: '{{ '#' . dechex(rand(0x000000, 0xFFFFFF)) }}', // Random color
                    fill: false
                });
            @endforeach
        } else {
            datasets = [
                {
                    label: 'Despesas Totais (R$)',
                    data: @json($totalExpenses),
                    borderColor: '#dc3545', // Red
                    fill: false
                },
                {
                    label: 'Receitas (R$)',
                    data: @json($earnings),
                    borderColor: '#28a745', // Green
                    fill: false
                }
            ];
        }

        chart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: datasets
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { labels: { color: '#000' } } }
            }
        });
    }

    document.getElementById('splitByCategory').addEventListener('change', function() {
        updateChart(this.checked);
    });

    // Initial chart load (default: total expenses and revenue)
    updateChart(false);
</script>
@endsection