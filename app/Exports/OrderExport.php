<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::with('mine', 'driver', 'vehicle', 'approver1', 'approver2', 'approved1By', 'approved2By','rejectedBy', 'createdBy')->whereBetween('created_at', [$this->startDate . " 00:00:00", $this->endDate . " 23:59:59"])->get();


        $data = [];

        foreach ($orders as $key => $order) {
            $data[] = [
                'No' => $key+1,
                'Kendaraan' => $order->vehicle->name,
                'Nama Driver' => $order->driver->name,
                'Tambang' => $order->mine->name,
                'Tanggal Pemninjaman' => $order->start_date,
                'Approver 1' => $order->approver1->name,
                'Disetujui Approver 1 Oleh' => $order->approved1By->name ?? '-',
                'Tanggal Disetujui Approver 1' => $order->approved_1_at ?? '-',
                'Approver 2' => $order->approver2->name ?? '-',
                'Disetujui Approver 2 Oleh' => $order->approved2By->name ?? '-',
                'Tanggal Disetujui Approver 2' => $order->approved_2_at ?? '-',
                'Ditolak Oleh' => $order->rejectedBy->name ?? '-',
                'Ditolak Pada' => $order->rejected_at ?? '-',
                'Dipesan Oleh' => $order->createdBy->name ?? '-',
                'Dipesan Pada' => $order->created_at,
                'Status' => $order->status,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Kendaraan',
            'Nama Driver',
            'Tambang',
            'Tanggal Peminjaman',
            'Approver 1',
            'Disetujui Approver 1 Oleh',
            'Tanggal Disetujui Approver 1',
            'Approver 2',
            'Disetujui Approver 2 Oleh',
            'Tanggal Disetujui Approver 2',
            'Ditolak Oleh',
            'Ditolak Pada',
            'Dipesan Oleh',
            'Dipesan Pada',
            'Status'
        ];
    }
}
