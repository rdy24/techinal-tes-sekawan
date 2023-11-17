@extends('layouts.app')

@section('title')
Order | {{ config('app.name') }}
@endsection

@push('css-libraries')
<link rel="stylesheet" href={{ asset("assets/module/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}>
<link rel="stylesheet" href={{ asset("assets/module/datatables.net-select-bs4/css/select.bootstrap4.min.css") }}>
@endpush

@section('content')
<div class="section-header">
    <h1>Order</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Order</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @can('hasRole', 'admin')
                <div class="card-body d-flex justify-content-between">
                    <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i class="fas fa-plus"
                            aria-hidden="true"></i>
                        Tambah Data</a>
                </div>
                @endcan
                <div class="row ml-3">
                    <div class="col-md-3">
                        <form action="{{ route('dashboard.orders.export') }}" target="_blank">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>

                            <button type="submit" class="btn btn-dark">Export Excel</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Approver 1</th>
                                    <th>Approver 2</th>
                                    <th>Dipesan Oleh</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->vehicle->name ?? '-' }}</td>
                                    <td>{{ $order->start_date }} s/d {{ $order->return_date }}</td>
                                    <td>{{ $order->approver1->name ?? '-' }}</td>
                                    <td>{{ $order->approver2->name ?? '-' }}</td>
                                    <td>{{ $order->createdBy->name ?? '-' }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                        </a>
                                        @can('hasRole', 'admin')
                                        <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                data-confirm-delete="true"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                        @if ($order->isApprover && $order->status == 'pending')

                                        <a href="{{ route('dashboard.orders.approve', $order->id) }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('dashboard.orders.reject', $order->id) }}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-window-close"></i>
                                        </a>

                                        @endif

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