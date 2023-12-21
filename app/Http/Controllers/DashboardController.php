<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikePurchase;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bikeCount = Bike::count();
        $userCount = User::count();
        $successfulBikePurchases = BikePurchase::count();

        return view('dashboard', compact('bikeCount', 'userCount', 'successfulBikePurchases'));
    }
}
