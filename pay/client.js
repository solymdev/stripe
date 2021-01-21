//carrito de compra
var data = localStorage.getItem("cart");//Retrieve the stored data
var dataObj = JSON.parse(data); //Converts string to object
if(dataObj == null){ //If there is no data, initialize an empty array
  var id = Math.floor(Math.random() * 99999) + 10000;
  var data = JSON.stringify({
    ID    : id,
    precio : 100,
    token : "",
    });
  localStorage.setItem("cart", data);
  data = localStorage.getItem("cart");
  dataObj = JSON.parse(data);
  console.log(dataObj);
}else{
  console.log(dataObj);
      $("#total").append("<span class='subtotal-title'>Total: $"+dataObj.precio+"<br></span>");
      $("#count").html("1");
}

var stripe = Stripe('pk_test_'); //<-- here goes your public api key pk_test...
var elements = stripe.elements();

var style = {
   base: {
       color: '#32325d',
       fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
       fontSmoothing: 'antialiased',
       fontSize: '16px',
       '::placeholder': {
           color: '#aab7c4'
       }
   },
   invalid: {
       color: '#fa755a',
       iconColor: '#fa755a'
   }
};
 
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
 
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
 
// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
   if (event.error) {
       showError(event.error.message);
   }
});
 
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
   event.preventDefault();
   $(".buttonStripe").prop("disabled", true)
   stripe.createToken(card).then(function(result) {
       if (result.error) {
           alert(result.error);
           showError(result.error.message);
       } else {
           loading(true);
           stripeTokenHandler(result.token);
       }
   });
});

function stripeTokenHandler(token) {
   // Insert the token ID into the form so it gets submitted to the server
   var data = localStorage.getItem("cart");//Retrieve the stored data
   var dataObj = JSON.parse(data); //Converts string to object
    dataObj.token = token.id;
   var options = {
    url: "pay/submit.php",
    dataType: "text",
    type: "POST",
    data: { all: JSON.stringify(dataObj) }, 
    success: function(data) {
        if(data == "ok"){
            alert("success!");
            window.location.reload();
    }else{
        alert("Something is wrong");
    }
    },
    error: function(xhr) {
        alert(xhr.responseText);
    }
  };
  $.ajax( options );
}

// Show a spinner on payment submission
var loading = function(isLoading) {
   if (isLoading) {
     // Disable the button and show a spinner
     document.querySelector(".buttonStripe").disabled = true;
     document.querySelector("#spinner").classList.remove("hidden");
     document.querySelector("#button-text").classList.add("hidden");
   } else {
     document.querySelector(".buttonStripe").disabled = false;
     document.querySelector("#spinner").classList.add("hidden");
     document.querySelector("#button-text").classList.remove("hidden");
   }
 };

 var showError = function(errorMsgText) {
    loading(false);
    var errorMsg = document.querySelector("#card-error");
    errorMsg.textContent = errorMsgText;
    setTimeout(function() {
    errorMsg.textContent = "";
    }, 4000);
    };