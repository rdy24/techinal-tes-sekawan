@extends('layouts.app')

@section('title')
Detail Order
@endsection

@section('content')
<div class="section-header">
    <h1>Detail Order </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('dashboard.orders.index') }}">Data Order</a></div>
        <div class="breadcrumb-item">Detail Data</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Kendaraan</th>
                                <td>{{ $order->vehicle->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Driver</th>
                                <td>{{ $order->driver->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tambang</th>
                                <td>{{ $order->mine->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Peminjaman</th>
                                <td>{{ $order->start_date }} s/d {{ $order->return_date }}</td>
                            </tr>
                            <tr>
                                <th>Approver 1</th>
                                <td>{{ $order->approver1->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Disetujui Approver 1 Oleh</th>
                                <td>{{ $order->approved1By->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Disetujui Approver 1 Pada</th>
                                <td>{{ $order->approved_1_at ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Approver 2</th>
                                <td>{{ $order->approver2->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Disetujui Approver 2 Oleh</th>
                                <td>{{ $order->approved2By->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Disetujui Approver 2 Pada</th>
                                <td>{{ $order->approved_2_at ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Ditolak Oleh</th>
                                <td>{{ $order->rejectedBy->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Ditolak Pada</th>
                                <td>{{ $order->rejected_at ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dipesan Oleh</th>
                                <td>{{ $order->createdBy->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dipesan Pada</th>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $order->status }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection