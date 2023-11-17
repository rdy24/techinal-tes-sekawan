@extends('layouts.app')

@section('title')
Tambang | {{ config('app.name') }}
@endsection

@push('css-libraries')
<link rel="stylesheet" href={{ asset("assets/module/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}>
<link rel="stylesheet" href={{ asset("assets/module/datatables.net-select-bs4/css/select.bootstrap4.min.css") }}>
@endpush

@section('content')
<div class="section-header">
    <h1>Tambang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Tambang</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <a href="{{ route('dashboard.mines.create') }}" class="btn btn-primary"><i class="fas fa-plus"
                            aria-hidden="true"></i>
                        Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tambang</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mines as $mine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mine->name }}</td>
                                    <td>{{ $mine->address }}</td>
                                    <td>{{ $mine->status }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.mines.edit', $mine->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('dashboard.mines.destroy', $mine->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                data-confirm-delete="true"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js-libraries')
<script src={{ asset("assets/module/datatables/media/js/jquery.dataTables.min.js") }}></script>
<script src={{ asset("assets/module/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("assets/module/datatables.net-select-bs4/js/select.bootstrap4.min.js") }}></script>
<script src={{ asset("assets/module/sweetalert/dist/sweetalert.min.js") }}></script>
@endpush

@push('js-page')
<script src={{ asset("assets/js/page/modules-datatables.js") }}></script>
@endpush