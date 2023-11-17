@extends('layouts.app')

@section('title')
Tambah Order | {{ config('app.name') }}
@endsection

@push('css-libraries')
<link rel="stylesheet" href={{ asset("assets/module/select2/dist/css/select2.min.css") }}>
<link rel="stylesheet" href={{ asset("assets/module/bootstrap-daterangepicker/daterangepicker.css") }}>
@endpush

@section('content')
<div class="section-header">
    <h1>Tambah Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Tambah Order</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.orders.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="vehicle_id">Kendaraan</label>
                            <select name="vehicle_id" class="form-control select2">
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id')==$vehicle->id ? 'selected' : ''
                                    }}>
                                    {{ $vehicle->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="driver_id">Driver</label>
                            <select name="driver_id" class="form-control select2">
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id')==$driver->id ?
                                    'selected' : ''
                                    }}>
                                    {{ $driver->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mine_id">Tambang</label>
                            <select name="mine_id" class="form-control select2">
                                @foreach($mines as $mine)
                                <option value="{{ $mine->id }}" {{ old('mine_id')==$mine->id ?
                                    'selected' : ''
                                    }}>
                                    {{ $mine->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="approver_1">Approver 1</label>
                            <select name="approver_1" class="form-control select2">
                                @foreach($approver1 as $item)
                                <option value="{{ $item->id }}" {{ old('approver_1')==$item->id ?
                                    'selected' : ''
                                    }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="approver_2">Approver 2</label>
                            <select name="approver_2" class="form-control select2">
                                @foreach($approver2 as $item)
                                <option value="{{ $item->id }}" {{ old('approver_2')==$item->id ?
                                    'selected' : ''
                                    }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai Pinjam</label>
                            <input type="text" class="form-control datepicker" id="start_date" name="start_date"
                                required value="{{ old('start_date') }}">
                            @error('start_date')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="return_date">Tanggal Kembali</label>
                            <input type="text" class="form-control datepicker" id="return_date" name="return_date"
                                required value="{{ old('return_date') }}">
                            @error('return_date')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-primary">Batal</a>
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