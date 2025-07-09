@extends('layouts.app')

@section('content')
<div class="container pt-90">
    <h2 class="page-title">Mis Direcciones</h2>

    <div class="row">
        <div class="col-lg-2">
            @include('user.account-nav')
        </div>

        <div class="col-lg-10">
            <div class="wg-box">
                <h5 class="mb-3">Direcciones guardadas</h5>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('user.account.addresses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar nueva dirección
                    </a>
                </div>

                @if($addresses->isEmpty())
                    <p>No tienes direcciones guardadas.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Localidad</th>
                                    <th>Ciudad</th>
                                    <th>País</th>
                                    <th>Fachada</th>
                                    <th>Código Postal</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>{{ $address->name }}</td>
                                        <td>{{ $address->address }}</td>
                                        <td>{{ $address->locality }}</td>
                                        <td>{{ $address->city }}</td>
                                        <td>{{ $address->country }}</td>
                                        <td>{{ $address->landmark }}</td>
                                        <td>{{ $address->zip }}</td>
                                        <td>{{ $address->phone }}</td>
                                        <td class="text-center d-flex gap-1 justify-content-center">
                                            <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form method="POST" action="{{ route('user.account.addresses.destroy', $address->id) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta dirección?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
