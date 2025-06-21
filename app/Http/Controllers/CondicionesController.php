<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CondicionesController extends Controller
{
    public function terminos()
    {
        return view('condiciones');
    }
}

