@extends('layouts.admin')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <h3 class="mb-4">Editar Usuario</h3>

        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-2">Nombre</label>
                <input type="text" name="name" class="form-input w-full" value="{{ $user->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Email</label>
                <input type="email" name="email" class="form-input w-full" value="{{ $user->email }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Móvil</label>
                <input type="text" name="mobile" class="form-input w-full" value="{{ $user->mobile }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Rol</label>
                <select name="utype" class="form-select w-full">
                    <option value="USR" {{ $user->utype == 'USR' ? 'selected' : '' }}>USR</option>
                    <option value="ADM" {{ $user->utype == 'ADM' ? 'selected' : '' }}>ADM</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="form-input w-full">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary ml-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
