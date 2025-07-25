@extends('layouts.app')
@section('content')
<style>
    .table> :not(caption)>tr>th {
        padding: 0.625rem 1.5rem .625rem !important;
        background-color:rgb(218, 63, 63) !important;
    }

    .table>tr>td {
        padding: 0.625rem 1.5rem .625rem !important;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
        border-width: 1px 1px;
        border-color: #6a6e51;
    }

    .table> :not(caption)>tr>td {
        padding: .8rem 1rem !important;
    }

    .bg-success {
        background-color: #40c710 !important;
    }

    .bg-danger {
        background-color: #f44032 !important;
    }

    .bg-warning {
        background-color: #f5d700 !important;
        color: #000;
    }
</style>
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Pedidos</h2>
        <div class="row">
            <div class="col-lg-2">
               @include('user.account-nav')
            </div>

            <div class="col-lg-10">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">Numero de Orden</th>
                                    <th>Nombre</th>
                                    <th class="text-center">Movil</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">IVA</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Articulos</th>
                                    <th class="text-center">Entrega</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                   <td class="text-center">{{($order->id)}}</td>  
                                    <td class="text-center">{{$order->name}}</td>
                                    <td class="text-center">{{$order->phone}}</td>
                                    <td class="text-center">${{$order->subtotal}}</td>
                                    <td class="text-center">${{$order->tax}}</td>
                                    <td class="text-center">${{$order->total}}</td> 
                                    <td class="text-center">
                                        @if($order->status =='delivered')
                                            <span class="badge bg-success">Entregado</span>
                                        @elseif($order->status =='canceled')
                                            <span class="badge bg-danger">Cancelado</span>
                                        @else
                                            <span class="badge bg-warning">Pedido realizado</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$order->created_at}}</td> 
                                    <td class="text-center">{{$order->orderItems->count()}}</td> 
                                    <td class="text-center">{{$order->delivered_date}}</td> 

                                    <td class="text-center">
                                        <a href="{{route('user.order.details',['order_id'=>$order->id])}}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    

                </div>
            </div>

        </div>
    </section>
</main>
@endsection