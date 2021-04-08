@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    
<div class="col-md-8">
  <div class="card">
      <div class="card-header">付款页</div>
      
      <div class="card-body">
        <?php
        if(isset($period)){
        switch ($period) {
          case '7days':
            $trans="一周";
            break;
          case '14days':
            $trans="两周";
            break;
          case 'month':
            $trans="一个月";
            break;
        }
        
          
        }
          
        ?>
        <p>你选择预付{{$trans}}，共{{$amt}}欧元。</p>
        
        <hr>
        <div id="stripe_card" >
          <!--only .form-row class is important when it is in the card form
            I don't use here for intent-->
        <style type="text/css">
          * {
          font-family: "Helvetica Neue", Helvetica;
          font-size: 15px;
          font-variant: normal;
          padding: 0;
          margin: 0;
          }
        
            .form-row {
            display: inherit;

          }
          #card-button{
            background-color:#3498DB;
            width:75px;
            
          }
          html {
          height: 100%;
        }

        form {
          width: 480px;
          margin: 20px 0;
        }

        .group {
          background: white;
          box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
          border-radius: 4px;
          margin-bottom: 20px;
        }

        label {
          position: relative;
          color: #8898AA;
          font-weight: 300;
          height: 40px;
          line-height: 40px;
          margin-left: 20px;
          display: flex;
          flex-direction: row;
        }

        .group label:not(:last-child) {
          border-bottom: 1px solid #F0F5FA;
        }

        label > span {
          width: 120px;
          text-align: right;
          margin-right: 30px;
        }

        .field {
          background: transparent;
          font-weight: 300;
          border: 0;
          color: #31325F;
          outline: none;
          flex: 1;
          padding-right: 10px;
          padding-left: 10px;
          cursor: text;
        }

        .field::-webkit-input-placeholder {
          color: #CFD7E0;
        }

        .field::-moz-placeholder {
          color: #CFD7E0;
        }



        .success,
        .error {
          display: none;
          font-size: 13px;
        }

        .success.visible,
        .error.visible {
          display: inline;
        }

        .error {
          color: #E4584C;
        }

        .success {
          color: #666EE8;
        }

        .success .token {
          font-weight: 500;
          font-size: 13px;
        }

        </style>
        <?php

        //\Stripe\Stripe::setApiKey("sk_test_5xDBwRpg2DYfLZbpv0xbGhkY00MNKN83Us");
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $intent = \Stripe\PaymentIntent::create([
        'amount' => $amt*100,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'metadata' => ['user_id' => $user->id,'utype'=>$user->utype,'period'=>$period],
        ]);
        //echo $intent->id;
        
        ?>

        <input id="cardholder-name" type="text" placeholder="持卡人姓名">
        <!-- placeholder for Elements -->
        <div id="card-element"></div>
        <button id="card-button" data-secret="<?= $intent->client_secret ?>">
          付  款
        </button>

      </div>
    </div>
  </div>
</div>
</div>
</div>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    //var stripe = Stripe('pk_test_dReZle5Ycxqotzj7qpVrORes00aZSBFzjC');
    //notice!!
   var stripe = Stripe("{!!config('services.stripe.key')!!}");

    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var cardholderName = document.getElementById('cardholder-name');
    var cardButton = document.getElementById('card-button');
    var clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', function(ev) {
      stripe.handleCardPayment(
        clientSecret, cardElement, {
          payment_method_data: {
            billing_details: {name: cardholderName.value}
          }
        }
      ).then(function(result) {
        if (result.error) {
          //Display error.message in your UI.
        } else {
          //The payment has succeeded. Display a success message.
          
          window.location="/dashboard";
        }
      });
    });
      
  </script>





  
  <script>
    /* not use any more
  $(document).ready(function() {
    $(".show-card").click(function(e) {
      e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var card = document.getElementById("card");
        $.ajax({
            type: 'POST',
            url: '/ajtest',
            data: {
                amt:$(this).val()
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                card.style.display = "block";
            },
            error: function(data) {
                alert(data);
            }
        });
    });
    
});
*/
  
</script>
@endsection

