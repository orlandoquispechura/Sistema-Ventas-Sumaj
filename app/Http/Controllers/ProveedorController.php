<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;

class ProveedorController extends Controller
{public function index()
    {
        $proveedors = Proveedor::get();
        return view('admin.proveedor.index', compact('proveedors'));
    }
    public function create()
    {
        return view('admin.proveedor.create');
    }
    public function store(StoreProveedorRequest $request)
    {
        Proveedor::create($request->all());
        return redirect()->route('admin.proveedors.index')->with('success', 'Se registró correctamente');
    }
    public function show(Proveedor $proveedor)
    {
        return view('admin.proveedor.show', compact('proveedor'));
    }
    public function edit(Proveedor $proveedor)
    {
        return view('admin.proveedor.edit', compact('proveedor'));
    }
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->update($request->all());
        return redirect()->route('admin.proveedors.index')->with('update', 'Se editó correctamente');
    }
    public function destroy(Proveedor $proveedor)
    {
        $item = $proveedor->compras()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','El proveedor no puede eliminarse, tiene compras registradas.');
        }
        $proveedor->delete();
        return redirect()->route('admin.proveedors.index')->with('delete', 'ok');
    }
}
