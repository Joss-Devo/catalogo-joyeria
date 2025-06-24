@extends('layouts.app')

@section('content')
<div class="container pt-90">
    <h2 class="page-title">Agregar Dirección</h2>

    <div class="row">
        <div class="col-lg-2">
            @include('user.account-nav')
        </div>

        <div class="col-lg-10">
            <div class="wg-box">
                <form action="{{ route('user.account.addresses.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>País</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Código Postal</label>
                        <input type="text" name="zip" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Guardar Dirección</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
