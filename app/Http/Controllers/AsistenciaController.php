<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller {
    public function index() {
        return Asistencia::with('user')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'nullable|date_format:H:i:s',
            'hora_salida' => 'nullable|date_format:H:i:s',
            'estado' => 'required|in:Presente,Ausente,Tarde',
        ]);

        return Asistencia::create($request->all());
    }

    public function update(Request $request, Asistencia $asistencia) {
        $request->validate([
            'hora_salida' => 'nullable|date_format:H:i:s',
            'estado' => 'required|in:Presente,Ausente,Tarde',
        ]);

        $asistencia->update($request->all());
        return response()->json($asistencia);
    }

    public function destroy(Asistencia $asistencia) {
        $asistencia->delete();
        return response()->json(['message' => 'Asistencia eliminada']);
    }
}
