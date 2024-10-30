<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationOrder;
use App\Models\Tourist;
use App\Models\TouristOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort');

        $touristsQuery = Tourist::query();
        $accommodationsQuery = Accommodation::query();

        if ($search) {
            $touristsQuery->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
            $accommodationsQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($sort) {
            $touristsQuery->orderBy($sort);
            $accommodationsQuery->orderBy($sort);
        }

        $tourists = $touristsQuery->get();
        $accommodations = $accommodationsQuery->get();

        $touristsCount = Tourist::count();
        $accommodationsCount = Accommodation::count();
        $accomodationCount = AccommodationOrder::count(); 
        $touristOrderCount = TouristOrder::count(); 
        $ordersCount = $accomodationCount + $touristOrderCount;
        return view('home.index', compact('tourists', 'accommodations', 'touristsCount', 'accommodationsCount', 'ordersCount'));
    }
}
