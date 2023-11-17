<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Http\Requests\OrderRequest;
use App\Models\Driver;
use App\Models\Log;
use App\Models\Mine;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::all();
        $title = 'Hapus Order';
        $text = "Apakah anda yakin ingin menghapus Order ini?";
        confirmDelete($title, $text);

        return view('pages.orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $mines = Mine::all();
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        $approver1 = User::where('role', 'supervisor')->get();
        $approver2 = User::where('role', 'manager')->get();

        return view('pages.orders.create', [
            'mines' => $mines,
            'drivers' => $drivers,
            'vehicles' => $vehicles,
            'approver1' => $approver1,
            'approver2' => $approver2,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        Order::create([
            'mine_id' => $request->mine_id,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'start_date' => $request->start_date,
            'return_date' => $request->return_date,
            'approver_1' => $request->approver_1,
            'approver_2' => $request->approver_2,
            'created_by' => auth()->user()->id,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Order',
            'details' => 'Order Kendaraan ' . $request->vehicle_id . ' ditambahkan.'
        ]);

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        return view('pages.orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        $mines = Mine::all();
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        $approver1 = User::where('role', 'supervisor')->get();
        $approver2 = User::where('role', 'manager')->get();

        return view('pages.orders.edit', [
            'order' => $order,
            'mines' => $mines,
            'drivers' => $drivers,
            'vehicles' => $vehicles,
            'approver1' => $approver1,
            'approver2' => $approver2,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        $order->update([
            'mine_id' => $request->mine_id,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'start_date' => $request->start_date,
            'return_date' => $request->return_date,
            'approver_1' => $request->approver_1,
            'approver_2' => $request->approver_2,
            'created_by' => auth()->user()->id,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Order',
            'details' => 'Order Kendaraan ' . $order->vehicle_id . ' diubah.'
        ]);

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Order',
            'details' => 'Order Kendaraan ' . $order->vehicle_id . ' dihapus.'
        ]);

        $order->delete();

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil dihapus.');
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(Order $order): RedirectResponse
    {
        if (auth()->user()->role == 'supervisor' && $order->status == 'pending') {
            $order->update([
                'status' => 'approved',
                'approved_1_by' => auth()->user()->id,
                'approved_1_at' => now(),
            ]);
        }
        
        if(auth()->user()->role == 'manager' && $order->status == 'pending') {
            $order->update([
                'status' => 'approved',
                'approved_2_by' => auth()->user()->id,
                'approved_2_at' => now(),
            ]);
        }

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'approve',
            'model' => 'Order',
            'details' => 'Order ' . $order->id . ' disetujui.'
        ]);

        

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil diapprove.');
    }

    /**
     * Reject the specified resource from storage.
     */

    public function reject(Order $order): RedirectResponse
    {
        if (auth()->user()->role == 'supervisor') {
            $order->update([
                'rejected_by' => auth()->user()->id,
                'rejected_at' => now(),
                'status' => 'rejected',
            ]);
        } elseif(auth()->user()->role == 'manager') {
            $order->update([
                'rejected_by' => auth()->user()->id,
                'rejected_at' => now(),
                'status' => 'rejected',
            ]);
        }

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'reject',
            'model' => 'Order',
            'details' => 'Order ' . $order->id . ' ditolak.'
        ]);

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil direject.');
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'export',
            'model' => 'Order',
            'details' => 'Order dari tanggal ' . $startDate . ' sampai ' . $endDate . ' diexport.'
        ]);

        return Excel::download((new OrderExport($startDate, $endDate)), 'orders.xlsx');
    }
}
