<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = estudiante::paginate(5);
        return view('estudiantes.index', compact('estudiantes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiantes.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 'apellido' => 'required', 'dni' => 'required', 'telefono' => 'required', 'nacimiento' => 'required', 'ingreso' => 'required','colegio' => 'required', 'grado' => 'required', 'imagen' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024'
        ]);
        $estudiante = $request->all();

        if($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenEstudiante = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenEstudiante);
            $estudiante['imagen'] = "$imagenEstudiante";
        }
        estudiante::create($estudiante);
        return redirect()->route('estudiantes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.editar', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombre' => 'required', 'apellido' => 'required', 'dni' => 'required', 'telefono' => 'required', 'nacimiento' => 'required', 'ingreso' => 'required','colegio' => 'required', 'grado' => 'required'
        ]);
        $estud = $request->all();
        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenEstudiante = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenEstudiante);
            $estud['imagen'] = "$imagenEstudiante";
        }
        else{
            unset($estud['imagen']);
        }
        $estudiante->update($estud);
        return redirect()->route('estudiantes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index');
    }
}
