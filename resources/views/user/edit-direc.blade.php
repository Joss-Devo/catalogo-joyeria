@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Editar Dirección</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Revisa los campos obligatorios.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('direccion.update', $direccion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre Completo</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $direccion->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $direccion->phone) }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $direccion->address) }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $direccion->city) }}" required>
        </div>

        <div class="mb-3">
            <label for="zip" class="form-label">Código Postal</label>
            <input type="text" name="zip" class="form-control" value="{{ old('zip', $direccion->zip) }}" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" name="country" class="form-control" value="{{ old('country', $direccion->country) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Dirección</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
