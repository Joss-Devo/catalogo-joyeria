@extends('layouts.admin')
@section('content')
<style>
                            .table-transaction>tbody>tr:nth-of-type(odd) {
                                --bs-table-accent-bg: #fff !important;
                            }
                        </style>
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Detalles de Orden</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="{{route('admin.index')}}">
                                                <div class="text-tiny">Dashboard</div>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Detalles de Orden</div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="wg-box"> 
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <h5>Detalles del pedido</h5>
                                        </div>
                                        <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Regresar</a>
                                    </div>
                                    <div class="table-responsive">
                                        @if(Session::has('status'))
                                        <p class ="alert alert-success">{{Session::get('status')}}</p>
                                        @endif
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>Numero de pedido.</th>
                                                    <td>{{$order->id}}</td>
                                                    <th>Mobil</th>
                                                    <td>{{$order->phone}}</td>
                                                    <th>Codigo Postal</th>
                                                    <td>{{$order->zip}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Datos de Orden</th>
                                                    <td>{{$order->created_at}}</td>
                                                    <th>Fecha de entrega</th>
                                                    <td>{{$order->delivered_date}}</td>
                                                    <th>Fecha de cancelación</th>
                                                    <td>{{$order->canceled_date}}</td>
                                                </tr>
                                                <tr>
                                                <th>Estado del pedido</th>
                                                <td colspan="5">
                                                    @if($order->status=='delivered')
                                                        <span class="badge bg-success">Entrgado</span>
                                                    @elseif($order->status=='canceled')
                                                        <span class="badge bg-danger">Cancelado</span>
                                                    @else
                                                        <span class="badge bg-warning">Pedido Realizado</span>
                                                    @endif
                                                </td>
                                             </tr>
                                       </table>
                                    </div>
                                </div>

                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <h5>Productos pedidos</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">SKU</th>
                                                    <th class="text-center">Categoría</th>
                                                    <th class="text-center">Marca</th>
                                                    <th class="text-center">Opcion</th>
                                                    <th class="text-center">Estado de devolución</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($orderItems as $item)
                                                <tr>
                                                     <td class="pname">
                                                        <div class="image">
                                                            <img src="{{asset('uploads/products/thumbnails')}}/{{$item->product->image}}" alt="{{$item->product->name}}" class="image">
                                                        </div>
                                                        <div class="name">
                                                            <a href="{{route('shop.product.details',['product_slug'=>$item->product->slug])}}" target="_blank"
                                                                class="body-title-2">{{$item->product->name}}</a>
                                                        </div>
                                                    </td>
                                                        <td class="text-center">${{$item->price}}</td>
                                                        <td class="text-center">{{$item->quantity}}</td>
                                                        <td class="text-center">{{$item->product->SKU}}</td>
                                                        <td class="text-center">{{$item->product->category->name}}</td>
                                                        <td class="text-center">{{$item->product->brand->name}}</td>
                                                        <td class="text-center">{{$item->options}}</td>
                                                        <td class="text-center">{{$item->rstatus == 0 ? "No":"Yes"}}</td>                                                                                
                                                        <td class="text-center">
                                                        <div class="list-icon-function view-icon">
                                                            <div class="item eye">
                                                                <i class="icon-eye"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                                    {{$orderItems->links('pagination::bootstrap-5')}}
                                    </div>
                                </div>

                                <div class="wg-box mt-5">
                                    <h5>Dirección de envío</h5>
                                    <div class="my-account__address-item col-md-6">
                                        <div class="my-account__address-item__detail">
                                        <p>{{$order->name}}</p>
                                        <p>{{$order->address}}</p>
                                        <p>{{$order->locality}}</p>
                                        <p>{{$order->city}}, {{$order->country}}</p>
                                        <p>{{$order->landmark}}</p>
                                        <p>{{$order->zip}}</p>
                                        <br />                                
                                        <p>Mobil : {{$order->phone}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="wg-box mt-5">
                                    <h5>Transacciones</h5>
                                    <table class="table table-striped table-bordered table-transaction">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>${{$order->subtotal}}</td>
                                                <th>IVA</th>
                                                <td>${{$order->tax}}</td>
                                                <th>Descuento</th>
                                                <td>${{$order->discount}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>${{$order->total}}</td>
                                                <th>Pago</th>
                                                <td>{{$transaction->mode}}</td>
                                                <th>Estado</th>
                                            <td>
                                                @if($transaction->status =='approved')
                                                    <span class="badge bg-success">Aprovado</span>
                                                @elseif($transaction->status =='declined')
                                                    <span class="badge bg-danger">Rechazado</span>
                                                @elseif($transaction->status =='refunded')
                                                    <span class="badge bg-secondary">Reembolsado</span>
                                                @else
                                                    <span class="badge bg-warning">Pendiente</span>
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>

                                  <div class="wg-box mt-5">
                                    <h5>Actualizar estado de orden</h5>
                                     <form action="{{route('admin.order.status.update')}}" method="POST">
                                     @csrf
                                     @method('PUT')
                                            <input type="hidden" name="order_id" value="{{ $order->id }}" />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="select">
                                                        <select id="order_status" name="order_status">                            
                                                            <option value="ordered" {{$order->status == 'ordered' ? "selected":""}}>Pendiente</option>
                                                            <option value="delivered" {{$order->status == 'delivered' ? "selected":""}}>Entregado</option>
                                                            <option value="canceled" {{$order->status == 'canceled' ? "selected":""}}>Cancelado</option>
                                                        </select>
                                                         </div>
                                                    </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary tf-button w208">Actualizar</button>
                                                </div>                    
                                            </div>
                                          </form>
                                        
                                </div>
                            </div>
                        </div>
@endsection