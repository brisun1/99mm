<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class SubscriptionController extends Controller
{
    public function create(Request $request, Plan $plan)
    {    // dd(1);
        $plan = Plan::findOrFail($request->get('plan'));
        
        $request->user()
            ->newSubscription('main', $plan->stripe_plan)
            ->create('prod_EuFU4871NNcxMV');
            //->create($request->stripeToken);
        return redirect()->route('/help')->with('success', 'Your plan subscribed successfully');
    }
}
