<?php

namespace Database\Seeders;

use App\Models\PaymentPlatform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentPlatform::create(
            [
                'name' => 'PayPal',
                'image' => 'img/payment-platforms/paypal.jpg',
                'subscriptions_enabled' => true,
            ]
        );
        PaymentPlatform::create(
            [
                'name' => 'Stripe',
                'image' => 'img/payment-platforms/stripe.jpg',
                'subscriptions_enabled' => true,
            ]
        );
    }
}
