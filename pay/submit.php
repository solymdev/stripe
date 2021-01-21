<?php
require_once('stripe/init.php');
//upload form
\Stripe\Stripe::setApiKey('sk_test_'); //<-- here goes your secret api key sk_test...
header('Content-Type: text/plain');
  $all = utf8_encode($_POST['all']); 
  $data = json_decode($all);
  $token = $data -> token;
try {
    $charge = \Stripe\Charge::create([
        'amount' => 10000,
        'currency' => 'mxn',
        'description' => 'Mi primera compra',
        'source' => $token,
]);

$success=$charge->status;
if($success == "succeeded"){  
    session_start();
    $_SESSION["token"] = "4kmklmd190";
    // Se guarda la compra en la BD
    //return redirect('/Pago-Exitoso');
    echo "ok";
exit();
}else{
    echo "error";
}
} catch (\Stripe\Exception\CardException $e) {
  echo "error";

}catch (\Stripe\Exception\RateLimitException $e) {
    echo "error";

}catch (\Stripe\Exception\InvalidRequestException $e) {
    echo "error";

  }catch (\Stripe\Exception\AuthenticationException $e) {
    echo "error";

  }catch (\Stripe\Exception\ApiConnectionException $e) {
    echo "error";

  }catch (\Stripe\Exception\ApiErrorException $e) {
    echo "error";

  }catch (Exception $e) {
    echo "error";
  }
 ?>
