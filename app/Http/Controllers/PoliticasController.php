<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliticasController extends Controller
{
    public function poli()
    {
        return view('politicas');
    }
}

