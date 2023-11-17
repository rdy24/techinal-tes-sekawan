<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Company;
use App\Models\Log;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $vehicles = Vehicle::all();
        $title = 'Hapus Kendaraan';
        $text = "Apakah anda yakin ingin menghapus Kendaraan ini?";
        confirmDelete($title, $text);

        return view('pages.vehicles.index', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $companies = Company::all();
        return view('pages.vehicles.create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request): RedirectResponse
    {
        Vehicle::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'license_plate' => $request->license_plate,
            'ownership' => $request->ownership,
            'load_type' => $request->load_type,
            'fuel_capacity' => $request->fuel_capacity,
            'status' => $request->status,
            'service_schedule' => $request->service_schedule,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Vehicle',
            'details' => 'Vehicle ' . $request->name . ' ditambahkan.'
        ]);

        return redirect()->route('dashboard.vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle): View
    {
        $companies = Company::all();
        return view('pages.vehicles.edit', [
            'vehicle' => $vehicle,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'license_plate' => $request->license_plate,
            'ownership' => $request->ownership,
            'load_type' => $request->load_type,
            'fuel_capacity' => $request->fuel_capacity,
            'status' => $request->status,
            'service_schedule' => $request->service_schedule,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Vehicle',
            'details' => 'Vehicle ' . $vehicle->name . ' diubah.'
        ]);

        return redirect()->route('dashboard.vehicles.index')->with('success', 'Kendaraan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Vehicle',
            'details' => 'Vehicle ' . $vehicle->name . ' dihapus.'
        ]);

        $vehicle->delete();
        
        return redirect()->route('dashboard.vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
