@extends('layouts.app')

@section('title')
Tambah Tambang | {{ config('app.name') }}
@endsection

@section('content')
<div class="section-header">
    <h1>Tambah Tambang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Tambah Tambang</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.mines.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Tambang</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Tambang</label>
                            <input type="text" class="form-control" id="address" name="address" required
                                value="{{ old('address') }}">
                            @error('address')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="active" {{
                                    old('status')=='active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="inactive"
                                    {{ old('status')=='inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status1">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard.companies.index') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection