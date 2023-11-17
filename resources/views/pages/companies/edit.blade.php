@extends('layouts.app')

@section('title')
Edit Perusahaan | {{ config('app.name') }}
@endsection

@section('content')
<div class="section-header">
    <h1>Edit Perusahaan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Edit Perusahaan</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.companies.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name', $company->name) }}">
                            @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Perusahaan</label>
                            <input type="text" class="form-control" id="address" name="address" required
                                value="{{ old('address', $company->address) }}">
                            @error('address')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">No Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" required
                                value="{{ old('phone', $company->phone) }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            @error('phone')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email', $company->email) }}" oninput="validateEmail(this)" required>
                            <p class="text-danger mt-1 text-sm" id="email-error"></p>
                            @error('email')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <a href="{{ route('dashboard.mines.index') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-page')
<script>
    function validateEmail(input) {
        const email = input.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            document.getElementById("email-error").textContent = "Email tidak valid";
            input.focus();
        } else {
            document.getElementById("email-error").textContent = "";
        }
    }
</script>
@endpush