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
                @if($orders->isEmpty())
                    <p>No tienes direcciones guardadas.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>País</th>
                                    <th>Código Postal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td>{{ $order->country }}</td>
                                        <td>{{ $order->zip }}</td>
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
