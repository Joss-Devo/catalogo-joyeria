<!-- resources/views/errors/404.blade.php -->

@extends('layouts.app')

@section('title', '404 - Página no encontrada')

@section('content')
<div style="text-align: center; padding: 100px 20px;">
    <h4 style="color:rgb(5, 7, 8); margin-bottom: 20px;">LO SIENTO, PERO NO SE ENCONTRÓ LA PÁGINA.</h4>
    <h1 style="font-size: 80px;">404</h1>
    <p style="font-size: 18px;">Es posible que haya escrito mal la dirección o que la página se haya movido</p>
    <a href="{{ url('/') }}" style="margin-top: 20px; display: inline-block; background-color:rgb(255, 9, 38); color: white; padding: 10px 30px; border-radius: 5px; text-decoration: none;">
        Ir a la página de inicio
    </a>
</div>
@endsection
