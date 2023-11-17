<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Material;
use App\Models\Mine;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index()
{
    $countMine = Mine::count();
    $countCompany = Company::count();
    $countDriver = Driver::count();
    $countVehicle = Vehicle::count();

    // Menghitung kendaraan yang dipinjam per start date
    $countVehicleOrder = Order::select(DB::raw('DATE(start_date) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->pluck('total', 'date');

    return view('pages.dashboard', [
        'countMine' => $countMine,
        'countCompany' => $countCompany,
        'countDriver' => $countDriver,
        'countVehicle' => $countVehicle,
        'countVehicleOrder' => $countVehicleOrder,
    ]);
}

}
