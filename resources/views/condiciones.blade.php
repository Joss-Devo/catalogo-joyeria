@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <h1 class="display-5 fw-bold text-center mb-4">Términos y Condiciones</h1>

            <p class="text-muted fs-6 mb-5 text-center">
                Bienvenido a <strong>Joyería Mariza</strong>. Al acceder a nuestro sitio web o realizar una compra, aceptas los siguientes términos y condiciones. Te recomendamos leerlos cuidadosamente.
            </p>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">1. Uso del sitio web</h2>
                <p class="text-body">
                    Este sitio web está destinado exclusivamente para uso personal y no comercial. Está prohibido reproducir, distribuir o modificar cualquier contenido sin autorización previa.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">2. Productos y disponibilidad</h2>
                <p class="text-body">
                    Nos esforzamos por mantener la información de nuestros productos actualizada. Sin embargo, no garantizamos la disponibilidad continua de todos los artículos.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">3. Precios y pagos</h2>
                <p class="text-body">
                    Todos los precios están expresados en moneda local e incluyen impuestos aplicables. Nos reservamos el derecho de modificar precios sin previo aviso.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">4. Envíos y entregas</h2>
                <p class="text-body">
                    Los tiempos de entrega son estimados. No nos responsabilizamos por retrasos ocasionados por causas externas como logística o clima.
                </p>
            </section>

            
            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">5. Protección de datos</h2>
                <p class="text-body">
                    Toda la información personal que recolectamos es tratada conforme a nuestra Política de Privacidad.
                </p>
            </section>

            <section class="mb-5">
                <h2 class="h5 fw-semibold mb-3">6. Modificaciones</h2>
                <p class="text-body">
                    Joyería Mariza se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones entrarán en vigencia al ser publicadas.
                </p>
            </section>

            <p class="text-muted text-end fst-italic small">
                Última actualización: {{ now()->format('d/m/Y') }}
            </p>

        </div>
    </div>
</div>
@endsection
