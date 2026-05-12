<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'budget' => ['nullable', 'string', 'max:100'],
            'project_location' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        Lead::create([
            ...$validated,
            'vehicle_id' => $vehicle->id,
            'buyer_id' => $request->user()?->id,
            'status' => 'new',
        ]);

        return back()->with('status', 'Inquiry terkirim. Tim Raksamesin akan menghubungi kamu secepatnya.');
    }
}
