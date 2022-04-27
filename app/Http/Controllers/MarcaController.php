<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;

class MarcaController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
        $this->middleware('can:marcas.create', ['only'=>['create','store']]);
        $this->middleware('can:marcas.index',['only'=>['index']]);
        $this->middleware('can:marcas.edit',['only'=>['edit','update']]);
        $this->middleware('can:marcas.destroy',['only'=>['destroy']]);
    }
    public function index()
    {
        $marcas= Marca::get();
        return view('admin.marca.index', compact('marcas'));
    }
    public function create()
    {
        return view('admin.marca.create');
    }
    public function store(StoreMarcaRequest $request)
    {
        Marca::create($request->all());
        return redirect()->route('admin.marcas.index')->with('success', 'Se registró correctamente');
    }
    
    public function edit(Marca $marca)
    {
        return view('admin.marca.edit', compact('marca'));
    }
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        $marca->update($request->all());
        return redirect()->route('admin.marcas.index')->with('update', 'Se editó correctamente');
    }
    public function destroy(Marca $marca)
    {
        $item = $marca->articulos()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, hay artículos que corresponden a esta marca.');
        }
        $marca->delete();
        return redirect()->route('admin.marcas.index')->with('delete', 'ok');
    }
}
