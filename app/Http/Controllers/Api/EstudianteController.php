<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    public function index()
    {
        return response()->json(Estudiante::all(), 200);
    }

    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        return response()->json($estudiante, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiante,email',
            'telefono' => 'nullable|string|max:20',
            'lenguaje' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $estudiante = Estudiante::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'lenguaje' => $request->input('lenguaje'),
        ]);

        if (!$estudiante) {
            $data = [
                'message' => 'Error al crear el estudiante',
            ];
            return response()->json($data, 500);
        }

        return response()->json($estudiante, 201);
    }
    
    public function destroy(string $id) {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();

        return response()->json(['message' => 'Estudiante eliminado'], 200);
    }

    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:estudiante,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'lenguaje' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $estudiante->update($request->only(['nombre', 'email', 'telefono', 'lenguaje']));

        return response()->json($estudiante, 200);
    }
}
