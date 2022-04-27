<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Http\Requests\StoreArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\TipoEquipo;
use Illuminate\Http\Client\Request;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:articulos.index')->only(['index']);
        $this->middleware('can:articulos.create', ['only' => ['create', 'store']]);
        $this->middleware('can:articulos.edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:articulos.show', ['only' => ['show']]);
        $this->middleware('can:articulos.destroy', ['only' => ['destroy']]);

        $this->middleware('can:cambiar.estado.articulos')->only(['cambio_de_estado']);
    }
    public function index()
    {
        $articulos = Articulo::get();
        $marcas = new Marca();
        $tipos = new TipoEquipo();
        $proveedors = new Proveedor();

        return view('admin.articulo.index', compact('articulos'));
    }
    public function create()
    {
        $marcas = Marca::get();
        $tipos = TipoEquipo::get();
        $proveedors = Proveedor::get();
        return view('admin.articulo.create', compact('marcas', 'tipos', 'proveedors'));
    }
    public function store(StoreArticuloRequest $request)
    {
        $datosArticulo = request()->except('_token');
        $articulo = Articulo::create($datosArticulo);

        if ($request->codigo == "") {
            $numero = $articulo->id;
            $numeroConCeros = str_pad($numero, 12, "0", STR_PAD_LEFT);
            $articulo->update(['codigo' => $numeroConCeros]);
        }
        return redirect()->route('admin.articulos.index')->with('success', 'Se registró correctamente');
    }
    public function show(Articulo $articulo)
    {
        $codigo = Articulo::get('codigo');
        return view('admin.articulo.show', compact('articulo', 'codigo'));
    }
    public function edit(Articulo $articulo)
    {
        $marcas = Marca::get();
        $tipos = TipoEquipo::get();
        $proveedors = Proveedor::get();
        return view('admin.articulo.edit', compact('articulo', 'marcas', 'tipos', 'proveedors'));
    }
    public function update(UpdateArticuloRequest $request, $id)
    {
        $datosArticulo = request()->except(['_token', '_method']);

        Articulo::where('id', '=', $id)->update($datosArticulo);
        $articulo = Articulo::findOrFail($id);
        if ($request->codigo == "") {
            $numero = $articulo->id;
            $numeroConCeros = str_pad($numero, 12, "0", STR_PAD_LEFT);
            $articulo->update(['codigo' => $numeroConCeros]);
        }

        return redirect()->route('admin.articulos.index')->with('update', 'Se editó correctamente');
    }
    // public function cambio_de_estado(Articulo $articulo)
    // {
    //     if ($articulo->estado == 'ACTIVO') {
    //         $articulo->update(['estado' => 'INACTIVO']);
    //         return redirect()->back();
    //     } else {
    //         $articulo->update(['estado' => 'ACTIVO']);
    //         return redirect()->back();
    //     }
    // }

    // public function get_products_by_barcode(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $articulos = Articulo::where('codigo', $request->codigo)->firstOrFail();
    //         return response()->json($articulos);
    //     }
    // }
    // public function get_products_by_id(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $articulos = Articulo::findOrFail($request->articulo_id);
    //         return response()->json($articulos);
    //     }
    // }


    // public function print_barcode()
    // {
    //     $articulos = Articulo::get();
    //     $pdf = PDF::loadView('admin.articulo.barcode', compact('articulos'));
    //     return $pdf->stream('codigos_de_barras.pdf');
    // }
}
