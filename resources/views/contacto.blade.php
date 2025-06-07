@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Contacto</h2>
    <div class="row">
        <div class="col-md-8">
            <p>Para cualquier consulta de clientes o de ventas, contacta con:</p>

            <p><strong>Atención al cliente</strong><br>
            <a href="mailto:correoelectronico@ejemplo.com">correoelectronico@ejemplo.com</a></p>

            <p><strong>Consultas por ventas mayoristas</strong><br>
            <a href="mailto:correoelectronico@ejemplo.com">correoelectronico@ejemplo.com</a></p>


            <p class="mt-4"><strong>Síguenos</strong></p>
            <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_instagram" />
                </svg>
             <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_facebook" />
                </svg>
        </div>
    </div>
</div>
@endsection
