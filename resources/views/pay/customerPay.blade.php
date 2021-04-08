@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    
<div class="col-md-8">
  <div class="card">
      <div class="card-header">付款页</div>
      
      <div class="card-body">
        
          
        <?php if($cus_type=='contract'){
          $amt=12;
          echo '<p>查看该电话号码，须付'.$amt.'欧元。</p>';
        } 
        ?>
        
        @if($cus_type=='baoyang')
          @php
              $amt=5;
          @endphp
            <p>查看该电话号码，须付{{$amt}}欧元。</p>
        @endif
        
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
        'metadata' => ['utype'=>$cus_type,'user_id'=>$user_id],
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
          document.cookie = {{$user_id}}+"=pending;180000;path=/contract";
          //+{{$user_id}};
          //console.log(result);
          setTimeout(function () {
          var cusType="{{$cus_type}}";
          if (cusType=="baoyang"|"escort"|"escortb"){
            cusType="more";
          }
          window.location="/"+cusType;
          //var cusType={{$cus_type}};
          //window.location="/baoyang";
          }, 2000);
        }
      });
    });
      
  </script>

@endsection

