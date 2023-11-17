<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $drivers = Driver::all();
        $title = 'Hapus Driver';
        $text = "Apakah anda yakin ingin menghapus Driver ini?";
        confirmDelete($title, $text);

        return view('pages.drivers.index', [
            'drivers' => $drivers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'unique:drivers',
            'phone' => 'unique:drivers',
        ]);


        Driver::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Driver',
            'details' => 'Driver ' . $request->name . ' ditambahkan.'
        ]);

        return redirect()->route('dashboard.drivers.index')->with('success', 'Driver berhasil ditambahkan');
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
    public function edit(Driver $driver): View
    {
        return view('pages.drivers.edit', [
            'driver' => $driver,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, Driver $driver): RedirectResponse
    {
        $request->validate([
            'email' => 'unique:drivers,email,' . $driver->id,
            'phone' => 'unique:drivers,phone,' . $driver->id,
        ]);

        $driver->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Driver',
            'details' => 'Driver ' . $driver->name . ' diubah.'
        ]);

        return redirect()->route('dashboard.drivers.index')->with('success', 'Driver berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Driver',
            'details' => 'Driver ' . $driver->name . ' dihapus.'
        ]);
        
        $driver->delete();

        return redirect()->route('dashboard.drivers.index')->with('success', 'Driver berhasil dihapus');
    }
}
