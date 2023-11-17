<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::all();
        $title = 'Hapus Perusahaan';
        $text = "Apakah anda yakin ingin menghapus Perusahaan ini?";
        confirmDelete($title, $text);

        return view('pages.companies.index', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'unique:companies'
        ]); 
        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Company',
            'details' => 'Company ' . $request->name . ' ditambahkan.'
        ]);

        return redirect()->route('dashboard.companies.index')->with('success', 'Perusahaan berhasil ditambahkan');
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
    public function edit(Company $company): View
    {
        return view('pages.companies.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        if ($request->email !== $company->email) {
            $request->validate([
                'email' => 'unique:companies'
            ]);
        }
        $company->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Company',
            'details' => 'Company ' . $company->name . ' diubah.'
        ]);

        return redirect()->route('dashboard.companies.index')->with('success', 'Perusahaan berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Company',
            'details' => 'Company ' . $company->name . ' dihapus.'
        ]);
        
        $company->delete();


        return redirect()->route('dashboard.companies.index')->with('success', 'Perusahaan berhasil dihapus');
    }
}
