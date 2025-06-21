@extends('layouts.admin')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="container-fluid">

            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h4 class="fw-bold mb-0">Agregar Usuario</h4>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <strong>Ups, hay errores:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.user.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="correo@dominio.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Número de Móvil</label>
                            <input type="text" name="mobile" class="form-control" placeholder="Opcional">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rol</label>
                            <select name="utype" class="form-select">
                                <option value="USR">Usuario</option>
                                <option value="ADM">Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar
                            </button>
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
