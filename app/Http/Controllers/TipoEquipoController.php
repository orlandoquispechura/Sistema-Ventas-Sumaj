<?php

namespace App\Http\Controllers;

use App\Models\TipoEquipo;
use App\Http\Requests\StoreTipoEquipoRequest;
use App\Http\Requests\UpdateTipoEquipoRequest;

class TipoEquipoController extends Controller
{
    public function index()
    {
        $tipo_equipos= TipoEquipo::get();
        return view('admin.tipo.index', compact('tipo_equipos'));
    }
    public function create()
    {
        return view('admin.tipo.create');
    }
    public function store(StoreTipoEquipoRequest $request)
    {
        TipoEquipo::create($request->all());
        return redirect()->route('admin.tipos.index')->with('success', 'Se registró correctamente');
    }
    
    public function edit(TipoEquipo $tipo)
    {
        return view('admin.tipo.edit', compact('tipo'));
    }
    public function update(UpdateTipoEquipoRequest $request, TipoEquipo $tipo)
    {
        $tipo->update($request->all());
        return redirect()->route('admin.tipos.index')->with('update', 'Se editó correctamente');
    }
    public function destroy(TipoEquipo $tipo)
    {
        $item = $tipo->articulos()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, hay artículos que corresponden a este tipo de equipo.');
        }
        $tipo->delete();
        return redirect()->route('admin.marcas.index')->with('delete', 'ok');
    }
}
