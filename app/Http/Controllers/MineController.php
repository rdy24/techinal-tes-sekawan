<?php

namespace App\Http\Controllers;

use App\Http\Requests\MineRequest;
use App\Models\Log;
use App\Models\Mine;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mines = Mine::all();
        $title = 'Hapus Tambang';
        $text = "Apakah anda yakin ingin menghapus tambang ini?";
        confirmDelete($title, $text);

        return view('pages.mines.index', [
            'mines' => $mines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.mines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MineRequest $request): RedirectResponse
    {
        Mine::create([
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Mine',
            'details' => 'Mine ' . $request->name . ' ditambahkan.'
        ]);

        return redirect()->route('dashboard.mines.index')->with('success', 'Tambang berhasil ditambahkan');
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
    public function edit(Mine $mine): View
    {
        return view('pages.mines.edit', [
            'mine' => $mine
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MineRequest $request, Mine $mine): RedirectResponse
    {
        $mine->update([
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Mine',
            'details' => 'Mine ' . $mine->name . ' diubah.'
        ]);

        return redirect()->route('dashboard.mines.index')->with('success', 'Tambang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mine $mine): RedirectResponse
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Mine',
            'details' => 'Mine ' . $mine->name . ' dihapus.'
        ]);
        
        $mine->delete();


        return redirect()->route('dashboard.mines.index')->with('success', 'Tambang berhasil dihapus');
    }
}
