<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pago con PayPal</title>
  <script src="https://www.paypal.com/sdk/js?client-id=AW4QKPlvL3FKWdt6FKOiy0Nk3Ig2Qam0HxL6yAQuM0-QwTb1VccRBbla4cNI3hvuPnZtk1YeuFpP5cOL" ></script>
</head>
<body>
  <main style="padding: 2rem; text-align: center;">
    <h1>Pago con PayPal</h1>
    <div id="paypal-button-container"></div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (typeof paypal !== 'undefined') {
        paypal.Buttons({
          createOrder: function (data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '10.00' // Monto de prueba
                }
              }]
            });
          },
          onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
              alert('Transacción completada por ' + details.payer.name.given_name);
            });
          }
        }).render('#paypal-button-container');
      }
    });
  </script>
</body>

</html>
