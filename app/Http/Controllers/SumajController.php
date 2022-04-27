<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumajController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:reports.reportes')->only(['index']);
    }
    public function index()
    {
        
        return view('sumajst.plantilla');
    }
}
