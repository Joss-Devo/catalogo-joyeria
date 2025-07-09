@extends('layouts.app')

@section('content')
<div class="container pt-90">
    <h2 class="page-title">Editar Dirección</h2>

    <div class="row">
        <div class="col-lg-2">
            @include('user.account-nav')
        </div>

        <div class="col-lg-10">
            <div class="wg-box">
                <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="name" required="" value="{{ old('name', $address->name) }}">
                        <label for="name">Nombre Completo *</label>
                        @error('name')<span class="text-danger"> {{$message}}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="phone" required="" value="{{ old('phone', $address->phone) }}">
                            <label for="phone">Número de Teléfono *</label>
                            @error('phone')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="zip" required="" value="{{ old('zip', $address->zip) }}">
                            <label for="zip">Código Postal *</label>
                            @error('zip')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" name="state" required="" value="{{ old('state', $address->state) }}">
                            <label for="state">Estado *</label>
                            @error('state')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="city" required="" value="{{ old('city', $address->city) }}">
                            <label for="city">Ciudad *</label>
                            @error('city')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="address" required="" value="{{ old('address', $address->address) }}">
                            <label for="address">Número de casa, nombre del edificio *</label>
                            @error('address')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="locality" required="" value="{{ old('locality', $address->locality) }}">
                            <label for="locality">Dirección *</label>
                            @error('locality')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="landmark" required="" value="{{ old('landmark', $address->landmark) }}">
                            <label for="landmark">Punto de referencia *</label>
                            @error('landmark')<span class="text-danger"> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Actualizar Dirección</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
