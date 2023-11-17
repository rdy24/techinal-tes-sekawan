@extends('layouts.app')

@section('title')
Ubah Kendaraan | {{ config('app.name') }}
@endsection

@push('css-libraries')
<link rel="stylesheet" href={{ asset("assets/module/select2/dist/css/select2.min.css") }}>
<link rel="stylesheet" href={{ asset("assets/module/bootstrap-daterangepicker/daterangepicker.css") }}>
@endpush

@section('content')
<div class="section-header">
    <h1>Ubah Kendaraan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Ubah Kendaraan</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.vehicles.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Kendaraan</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name', $vehicle->name) }}">
                            @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="license_plate">Plat Nomor</label>
                            <input type="text" class="form-control" id="license_plate" name="license_plate" required
                                value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                            @error('license_plate')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ownership">Kepemilikan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ownership" id="ownership" value="own"
                                    {{ old('ownership', $vehicle->ownership)=='Milik Perusahaan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="ownership">
                                    Milik Perusahaan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ownership" id="ownership1"
                                    value="rent" {{ old('ownership', $vehicle->ownership)=='Sewa Perusahaan Persewaan' ?
                                'checked' : '' }}>
                                <label class="form-check-label" for="ownership1">
                                    Sewa Perusahaan Persewaan
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label for="company_id">Perusahaan</label>
                            <select name="company_id" class="form-control select2">
                                <option value="">Pilih Perusahaan Penyewa</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $vehicle->
                                    company_id)==$company->id ? 'selected' : ''
                                    }}>
                                    {{ $company->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="load_type">Tipe Angkutan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="load_type" id="load_type"
                                    value="person" {{ old('load_type', $vehicle->load_type)=='Orang' ? 'checked' : ''
                                }}>
                                <label class="form-check-label" for="load_type">
                                    Orang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="load_type" id="load_type1"
                                    value="item" {{ old('load_type', $vehicle->load_type)=='Barang' ? 'checked' : '' }}>
                                <label class="form-check-label" for="load_type1">
                                    Barang
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fuel_capacity">Kapasitas BBM</label>
                            <input type="number" class="form-control" id="fuel_capacity" name="fuel_capacity" required
                                value="{{ old('fuel_capacity', $vehicle->fuel_capacity) }}" required>
                            @error('fuel_capacity')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="available"
                                    {{ old('status', $vehicle->status)=='available' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Available
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status1"
                                    value="unavailable" {{ old('status', $vehicle->status)=='unavailable' ? 'checked' :
                                '' }}>
                                <label class="form-check-label" for="status1">
                                    Unavailable
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_schedule">Jadwal Service</label>
                            <input type="text" class="form-control datepicker" id="service_schedule"
                                name="service_schedule" required
                                value="{{ old('service_schedule', $vehicle->service_schedule) }}">
                            @error('service_schedule')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard.drivers.index') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-libraries')
<script src={{ asset("assets/module/bootstrap-daterangepicker/daterangepicker.js") }}></script>
<script src={{ asset("assets/module/select2/dist/js/select2.full.min.js") }}></script>
@endpush

@push('js-page')
<script>
    const ownershipRadio = document.querySelectorAll('input[name="ownership"]');
    const companyDiv = document.querySelector('.form-group.d-none');

    ownershipRadio.forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (radio.value === 'rent') {
                companyDiv.classList.remove('d-none');
            } else {
                companyDiv.classList.add('d-none');
            }
        });
    });
</script>
@endpush