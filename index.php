<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stripe Pay</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS
	============================================ -->
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery JS -->
  <script src="assets/js/vendor/jquery.min.js"></script>

     <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="pay/client.js" defer></script>
    <link rel="stylesheet" href="pay/global.css" />
    <!-- Stripe -->

</head>

<body>
  <header>
  </header>
        <div style="margin-bottom:22px;"><h3 class="cart-title">Carrito de compra</h3></div>

        <div class="cart-product-wrapper">
          <div class="cart-product-container  ps-scroll">
          <!--======= LOOP JAVASCRIPT  =======-->
                              <div id="carritoCompra"></div>
          <p class="cart-subtotal" id="total">
          </p>

          <!--=======  End of subtotal calculation  =======-->

          <!--=======  Stripe form  =======-->
          <form action="php/submit.php" id="toSubmit" method="post">
          </form>
          <form class="formStripe" id="payment-form">
      <div id="card-element"><!--Stripe.js injects the Card Element--></div>
      <button class="buttonStripe" id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pagar</span>
      </button>
      <p id="card-error" role="alert"></p>
      <p class="result-message hidden">
        Payment succeeded, see the result in your
        <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
      </p>

    </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
