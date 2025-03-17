<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Assistance;

class AssistanceController extends Controller
{
    public function index()
    {
        $assistances = Assistance::all();
        return Inertia::render('Assistance', [
            'assistances' => $assistances,
            'successMessage' => session('success'),
            'errorMessage' => session('error')
        ]);
    }

    public function checkIn()
    {
        // Lógica para el check-in
        return redirect()->route('assistances.index')->with('success', 'Check-in realizado con éxito.');
    }

    public function checkOut()
    {
        // Lógica para el check-out
        return redirect()->route('assistances.index')->with('success', 'Check-out realizado con éxito.');
    }
}
