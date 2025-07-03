@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Pago & Envío</h2>
      <div class="checkout-steps">
        <a href="{{route('cart.index')}}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Bolsa de compras</span>
            <em>Gestiona tu lista de artículos</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Pago & Envío</span>
            <em>Finaliza tu lista de artículos</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmación</span>
            <em>Revisa y envía tu pedido</em>
          </span>
        </a>
      </div>
      <form name="checkout-form" action="{{route('cart.place.an.order')}}" method="POST">
        @csrf
        <div class="checkout-form"> 

        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

          <div class="billing-info__wrapper">
            <div class="row">
              <div class="col-6">
                <h4>Detalles de envío</h4>
              </div>

            </div>

          @if ($addresses->isNotEmpty())
    @foreach ($addresses as $address)
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="selected_address" id="address_{{ $address->id }}" value="{{ $address->id }}" required>
            <label class="form-check-label" for="address_{{ $address->id }}">
                <strong>{{ $address->name }}</strong><br>
                {{ $address->address }}, {{ $address->locality }}<br>
                {{ $address->city }}, {{ $address->state }}<br>
                {{ $address->country }} - CP {{ $address->zip }}<br>
                Tel: {{ $address->phone }}
            </label>
        </div>
    @endforeach



             
            @else
            <div class="row mt-5">
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="name" required="" value="{{old('name')}}">
                  <label for="name">Nombre Completo *</label>
                  @error('name')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="phone" required="" value="{{old('phone')}}">
                  <label for="phone">Numero de Telefono *</label>
                  @error('phone')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="zip" required="" value="{{old('zip')}}">
                  <label for="zip">Código postal *</label>
                  @error('zip')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" name="state" required="" value="{{old('state')}}">
                  <label for="state">Estado *</label>
                  @error('state')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="city" required="" value="{{old('city')}}">
                  <label for="city">Ciudad *</label>
                  @error('city')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="address" required="" value="{{old('address')}}">
                  <label for="address">Número de casa, nombre del edificio *</label>
                  @error('address')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="locality" required="" value="{{old('locality')}}">
                  <label for="locality">Dirección *</label>
                  @error('locality')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="landmark" required="" value="{{old('landmark')}}">
                  <label for="landmark">punto de referencia *</label>
                  @error('landmark')<span class="text-danger"> {{$message}}</span> @enderror
                </div>
              </div>
            </div>
            @endif
          </div>
          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Tu Pedido</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUCTO</th>
                      <th align="right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach (Cart::instance('cart')->content() as $item)
                    <tr>
                      <td>
                      {{$item->name}} x {{$item->qty}}
                      </td>
                      <td align="right">
                      ${{$item->subtotal()}}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if(Session::has('discounts'))
                <table class="checkout-totals">
                <tbody>
                       <tr>
                            <th>Subtotal</th>
                            <td class="text-right">${{Cart::instance('cart')->subtotal()}}</td>
                        </tr> 
                        <tr>
                            <th>Descuento {{Session::get('coupon')['code']}}</th>
                            <td class="text-right">-${{Session::get('discounts')['discount']}}</td>
                        </tr> 
                        <tr>
                            <th>Subtotal después del descuento</th>
                            <td class="text-right">${{Session::get('discounts')['subtotal']}}</td>
                        </tr>    
                        <tr>
                            <th>Envío</th>
                            <td class="text-right">Gratis</td>
                        </tr>                            
                        <tr>
                            <th>IVA</th>
                            <td class="text-right">${{Session::get('discounts')['tax']}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td class="text-right">${{Session::get('discounts')['total']}}</td>
                        </tr>
                </tbody>
                </table>
                @else
                <table class="checkout-totals">
                  <tbody>
                    <tr>
                      <th>SUBTOTAL</th>
                      <td class="text-right">${{Cart::instance('cart')->subtotal()}}</td>
                    </tr>
                    <tr>
                      <th>Envío</th>
                      <td class="text-right">Envío gratis</td>
                    </tr>
                    <tr>
                      <th>IVA</th>
                      <td class="text-right">${{Cart::instance('cart')->tax()}}</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td class="text-right">${{Cart::instance('cart')->total()}}</td>
                    </tr>
                  </tbody>
                </table>
                @endif
              </div>
              <div class="checkout__payment-methods">
                
                
                 <input type="hidden" name="mode" value="cod">
                <p><strong>Método de pago:</strong> Pago contra entrega</p>

               

                <div class="policy-text">
                 Tus datos personales se utilizarán para procesar tu pedido, respaldar tu experiencia en este sitio web y para otros fines descritos en nuestra <a href="terms.html" target="_blank">politicas de privacidad</a>.
                </div>
              </div>
              

              <button type="submit" class="btn btn-primary btn-checkout" id="submit-order" >REALIZAR PEDIDO</button>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[name="checkout-form"]');
    const submitBtn = document.getElementById('submit-order');

    let direccionSeleccionada = false;

    submitBtn.addEventListener('click', function (e) {
      const radios = document.querySelectorAll('input[name="selected_address"]');
      const anyChecked = Array.from(radios).some(r => r.checked);

      if (radios.length > 0 && !anyChecked) {
        e.preventDefault(); // Detiene el envío
        direccionSeleccionada = false;
        alert('Por favor selecciona una dirección de envío.');
      } else {
        direccionSeleccionada = true;
      }

      // Si ya seleccionó y vuelve a hacer clic, se permite el envío
      if (!direccionSeleccionada) {
        e.preventDefault();
      }
    });

    // Escuchar cambio en las opciones para resetear el flag
    document.querySelectorAll('input[name="selected_address"]').forEach(radio => {
      radio.addEventListener('change', function () {
        direccionSeleccionada = true;
      });
    });
  });
</script>
            </div>
          </div>
        </div>
      </form>
    </section>
    
  </main>


@endsection





