<?php

namespace App\Http\Controllers;

use App\Resolvers\PaymentPlatformResolver;
use App\Services\PaypalService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');

        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    /**
     * Obtain a payment details.
     *
     */
    public function pay(Request $request)
    {
        $request->validate([
            'value' => ['required','numeric','min:5'],
            'currency' => ['required', 'exists:currencies,iso'],
            'payment_platform' => ['required', 'exists:payment_platforms,id'],
        ]);

        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);

        if($request->user()->hasActiveSubscription())
        {
            $request->value = round($request->value * 0.9, 2);
        }

        return $paymentPlatform->handlePayment($request);
    }
     
    public function approval()
    {
        if(session()->has('paymentPlatformId'))
        {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('paymentPlatformId'));
            return $paymentPlatform->handleApproval();
        }

       return redirect()->route('home')->withErrors('We cannot retrieve you payment platforn. Try again, pleace.');
    }
     
    public function cancelled()
    {
        return redirect()->route('home')->withErrors('You cancelled the payment.');
    }
}
