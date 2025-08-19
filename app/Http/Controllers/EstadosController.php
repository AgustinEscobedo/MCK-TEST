<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadosController extends Controller
{
    function getData()
    {
        $estados = Estado::all();
        return response()->json([
            'data' => $estados
        ]);
    }
}
