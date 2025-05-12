<?php

namespace App\Http\Controllers\Biblioteca;

use App\Http\Controllers\Controller;
use App\Models\Biblioteca\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::latest()->paginate(10);
        return view('biblioteca.libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biblioteca.libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:libros',
            'anio_publicacion' => 'required|integer|min:1000|max:' . date('Y'),
            'cantidad_disponible' => 'required|integer|min:0',
        ]);

        Libro::create($request->all());

        return redirect()->route('biblioteca.libros.index')
            ->with('success', 'Libro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return view('biblioteca.libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        return view('biblioteca.libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:libros,isbn,' . $libro->id,
            'anio_publicacion' => 'required|integer|min:1000|max:' . date('Y'),
            'cantidad_disponible' => 'required|integer|min:0',
        ]);

        $libro->update($request->all());

        return redirect()->route('biblioteca.libros.index')
            ->with('success', 'Libro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('biblioteca.libros.index')
            ->with('success', 'Libro eliminado exitosamente.');
    }
}