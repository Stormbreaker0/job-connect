<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isEmployer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Illuminate\Support\Facades\URL;


class SubscriptionController extends Controller
{   
    const WEEKLY_AMOUNT = 9.99;
    const MONTHLY_AMOUNT = 29.99;
    const YEARLY_AMOUNT = 149.99;
    const CURRENCY = 'EUR';

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
    }

    public function subscribe()
    {
        return view('subscription.index');
    }

    public function initiatePayment(Request $request)
    {
       // Get the payment method
       $plans = [
           'weekly' => [
               'name' => 'weekly',
               'description' => 'weekly payment',
               'amount' => self::WEEKLY_AMOUNT,
               'currency' => self::CURRENCY,
               'quantity' => 1,
               'interval' => 'week',
           ],
           'monthly' => [
               'name' => 'monthly',
               'description' => 'monthly payment',
               'amount' => self::MONTHLY_AMOUNT,
               'currency' => self::CURRENCY,
               'quantity' => 1,
               'interval' => 'month',
           ],
           'yearly' => [
               'name' => 'yearly',
               'description' => 'yearly payment',
               'amount' => self::YEARLY_AMOUNT,
               'currency' => self::CURRENCY,
               'quantity' => 1,
               'interval' => 'year',
           ]
       ];

       // initiate payment

       Stripe::setApiKey(config('services.stripe.secret'));

       try{
            $selectedPlan = null;
            if($request->is('pay/weekly')) {
                $selectedPlan = $plans['weekly'];
                $billingEnds = now()->addWeek() -> startOfDay() -> toDateString();
            }
            elseif($request->is('pay/monthly')) {
                $selectedPlan = $plans['monthly'];
                $billingEnds = now()->addMonth() -> startOfDay() -> toDateString();
            }
            elseif($request->is('pay/yearly')) {
                $selectedPlan = $plans['yearly'];
                $billingEnds = now()->addYear() -> startOfDay() -> toDateString();
            }

            // Create payment session with stripe
            if($selectedPlan){
                $successUrl = URL::signedRoute('payment.success', [
                    'plan' => $selectedPlan['name'], 
                    'billing_ends' => $billingEnds
                ]);
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                           'price_data' => [
                               'currency' => $selectedPlan['currency'],
                               'product_data' => [
                                   'name' => $selectedPlan['name'],
                                   'description' => $selectedPlan['description'],
                               ],
                               'unit_amount' => $selectedPlan['amount']*100,
                               'recurring' => [
                                   'interval' => $selectedPlan['interval'],
                               ],
                           ],
                            'quantity' => $selectedPlan['quantity'],
                        ],
                    ],
                    'mode' => 'subscription',
                    'success_url' => $successUrl,
                    'cancel_url' => route('payment.cancel'),
                ]);

                // Redirect to checkout page
                return redirect($session->url);
            }
       } catch(\Exception $e) {
           // return back()->with('error', 'Payment could not be processed');
           return $e->getMessage();
       }
    }

    public function paymentSuccess(Request $request)
    {
        // update db
    }

    public function cancel(Request $request)
    {
        // redirect back
        return redirect()->route('dashboard')->with('error','Payment was unsuccessful!');
    }
}
