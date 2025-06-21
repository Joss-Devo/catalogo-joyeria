@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <h1 class="display-5 fw-bold text-center mb-4">Política de Privacidad</h1>

            <p class="text-muted fs-6 mb-5 text-center">
                En <strong>Joyería Mariza</strong>, valoramos y respetamos tu privacidad. Esta política describe cómo recopilamos, usamos y protegemos tu información personal.
            </p>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">1. Recopilación de datos</h2>
                <p class="text-body">
                    Solo recopilamos la información necesaria para procesar tus pedidos y brindarte un mejor servicio, como nombre, dirección, correo electrónico y número de contacto.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">2. Uso de la información</h2>
                <p class="text-body">
                    Utilizamos tus datos exclusivamente para fines relacionados con tus compras, envíos, atención al cliente y notificaciones promocionales (si lo autorizas).
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">3. Seguridad de los datos</h2>
                <p class="text-body">
                    Mantenemos tus datos seguros utilizando protocolos de cifrado y medidas de protección para evitar accesos no autorizados.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">4. Derechos del usuario</h2>
                <p class="text-body">
                    Puedes solicitar en cualquier momento la actualización o eliminación de tu información personal enviándonos un correo a 
                    <a href="mailto:contacto@joyeriamariza.com" class="text-decoration-underline text-primary">contacto@joyeriamariza.com</a>.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">5. Cambios en la política</h2>
                <p class="text-body">
                    Nos reservamos el derecho de modificar esta política en cualquier momento. Las actualizaciones serán notificadas en nuestro sitio web.
                </p>
            </section>

            <p class="text-muted text-end fst-italic small">
                Última actualización: {{ now()->format('d/m/Y') }}
            </p>

        </div>
    </div>
</div>
@endsection
