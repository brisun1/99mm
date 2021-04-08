<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Miss;
use App\Status;
//use Auth;
//use DB;

use App\Price;


class PayController extends Controller
{
    /******
     public function __construct()
    {
        $this->middleware('auth');
    }
******/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listprice($amt,$period)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $utype=$user->utype;
        $ucountry=$user->ucountry;
        //$user=User::find($user_id);
        //get user status
        $status=DB::table('statuses')->where('user_id',$user_id) 
        ->first();
        //dd($status);
        $price=DB::table('price')->where('country',$ucountry) 
        ->where('name',$utype)->first();
        //for stripe
        
        
        return view('pay.payment')->with('user',$user)->with('status',$status)
               ->with('price',$price)->with('amt',$amt)->with('period',$period);
    }
    
    /*
    public function charge(Request $request){ 
         
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");
        $intent = \Stripe\PaymentIntent::retrieve("pi_Aabcxyz01aDfoo");
        //$intent = \Stripe\PaymentIntent::retrieve("pi_Aabcxyz01aDfoo");
        $charges = $intent->charges->data;
    }
    
    public function charge(Request $request){ 
        \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $request->amount,
            'currency' => 'eur',
            'description' => 'no pci Example charge',
            'source' => $token,
        ]);

    }
    
    ***/
    public function webhook(){ 
        // You can find your endpoint's secret in your webhook settings
        //$endpoint_secret = 'whsec_6jwreG1jAPctcRq3oAEr2uaCWMmKlWLE';
        $endpoint_secret=config('services.stripe.webhook.secret');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400); // PHP 5.4 or greater
        exit();
        } catch(\Stripe\Error\SignatureVerification $e) {
        // Invalid signature
        http_response_code(400); // PHP 5.4 or greater
        exit();
        }

        if ($event->type == "payment_intent.succeeded") {
        $intent = $event->data->object;
        //fulfilling
        $user_id=$intent->metadata->user_id;
        $amt=$intent->amount;
        $period=$intent->metadata->period;
        $status=Status::where('user_id',$user_id) 
        ->first();
        
        //dd($status);
        $expire=$status->expire_at;
        if($expire<date('Y-m-d')){
            $expire=date('Y-m-d');
        }else{
            
         }
         $expire=date('Y-m-d', strtotime($expire. ' + '.$period));
            
         $status->expire_at=$expire;
         $status->status='paid';
         $status->paidamt=$amt/100;
         //$status->update(['expire_at'=>$expire]);
         $status->save();
         //echo $status->status;
         //echo $expire_at;

        /*
        $user = Auth::user();
        $user_id=$user->id;
        $utype=$user->utype;
        $ucountry=$user->ucountry;
        $status=DB::table('statuses')->where('user_id',$user_id) 
        ->first();
        $status->status="paidn";
   */
        printf("intent ID: %s\n", $intent->id);
        printf("User ID: %s\n", $user_id);
        printf("Paid amount: %s\n", $amt);
        printf("Period: %s\n",$period);
        printf("user extend to: %s\n", $expire);
      
        
        // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys



//printf("Succeeded: %s", $charges->id);
        //return redirect('/dashboard')->with('success','pay done');
        
        http_response_code(200);
        exit();
        } elseif ($event->type == "payment_intent.payment_failed") {
        $intent = $event->data->object;
        $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";
        printf("Failed: %s, %s", $intent->id, $error_message);
        http_response_code(200);
        exit();
        }
       
        
    }

    public function customerPay($user_id,$cus_type)
    {
        
        setcookie('contract_email', 'myemail', time() + 60000, "/");
        return view('pay.customerPay')->with('cus_type',$cus_type)->with('user_id',$user_id);
    }

    public function onceoff_hook(){ 
        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = 'whsec_Xr2eC20GYb6nYJM3GSyGnxCA2yESyRBQ';
        //$endpoint_secret=config('services.stripe.webhook.secret2');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400); // PHP 5.4 or greater
        exit();
        } catch(\Stripe\Error\SignatureVerification $e) {
        // Invalid signature
        http_response_code(400); // PHP 5.4 or greater
        exit();
        }

        if ($event->type == "payment_intent.succeeded") {
        $intent = $event->data->object;
        //fulfilling
        $user_id=$intent->metadata->user_id;
        $amt=$intent->amount;
        //if($amt==1080){
        
        session([$user_id=>'paid']);
        
        
        //}
        //setcookie($intent->id, 'paid', time() + (86400 * 30)); 
        /*
        $user = Auth::user();
        $user_id=$user->id;
        $utype=$user->utype;
        $ucountry=$user->ucountry;
        $status=DB::table('statuses')->where('user_id',$user_id) 
        ->first();
        $status->status="paidn";
   */
        printf("intent ID: %s\n", $intent->id);
        printf("User ID: %s\n", $user_id);
        printf("Paid amount: %s\n", $amt);
        printf("Session userid: %s\n", session($user_id));
        //printf("Period: %s\n",$period);
        //printf("user extend to: %s\n", $expire);
      
        
        // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys



//printf("Succeeded: %s", $charges->id);
        //return redirect('/dashboard')->with('success','pay done');
        
        http_response_code(200);
        exit();
        } elseif ($event->type == "payment_intent.payment_failed") {
        $intent = $event->data->object;
        $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";
        printf("Failed: %s, %s", $intent->id, $error_message);
        http_response_code(200);
        exit();
        }
       
        
    }
    public function checkout_server(){
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

        $session = \Stripe\Checkout\Session::create([
        'client_reference_id'=>'contractpay',
        'payment_method_types' => ['card'],
        'line_items' => [[
            'name' => 'T-shirt',
            'description' => 'Comfortable cotton t-shirt',
            
            'amount' => 500,
            'currency' => 'usd',
            'quantity' => 1,
        ]],
        
        'success_url' => 'http://127.0.0.3/card',
        'cancel_url' => 'http://127.0.0.3/card',
        ]);
        //dd($session);

        
    }

    
}
