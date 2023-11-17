@extends('layouts.app')

@section('title')
Dashboard | {{ config('app.name') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Tambang</h4>
                    </div>
                    <div class="card-body">
                        {{ $countMine }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-beer"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Perusahaan</h4>
                    </div>
                    <div class="card-body">
                        {{ $countCompany }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-beer"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Driver</h4>
                    </div>
                    <div class="card-body">
                        {{ $countDriver }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-beer"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        {{ $countVehicle }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-xl-6 col-md-6 mb-4">
            <canvas id="myChart" width="800" height="400"></canvas>
        </div>
    </div>
</section>
@endsection

@push('js-page')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: {!! json_encode(array_keys($countVehicleOrder->sortKeys()->toArray())) !!},
        datasets: [{
            label: 'Jumlah Kendaraan Dipinjam',
            data: {!! json_encode(array_values($countVehicleOrder->toArray())) !!},
            backgroundColor: 'blue',
            borderWidth: 1,
        }]
    };

    const options = {
        responsive: true,
        maintainAspectRatio: false,
    };

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik
        data: data,
        options: options,
    });
</script>
@endpush