<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class PublicVehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::query()
            ->where('status', 'available')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q');

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->when($request->filled('location'), fn ($query) => $query->where('location', 'like', "%{$request->location}%"))
            ->latest('is_featured')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Vehicle::query()->distinct()->orderBy('category')->pluck('category');

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function show(Vehicle $vehicle)
    {
        abort_unless($vehicle->status === 'available', 404);

        $relatedVehicles = Vehicle::query()
            ->where('status', 'available')
            ->whereKeyNot($vehicle->id)
            ->where('category', $vehicle->category)
            ->limit(3)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}
