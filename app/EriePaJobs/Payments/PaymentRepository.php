<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 12/8/14
 * Time: 10:31 PM
 */

namespace EriePaJobs\Payments;
use Stripe;
use Stripe_Charge;
use Stripe_CardError;


class PaymentRepository {

    /**
     * Attempt to bill the user for a job listing
     * @param $input
     * @return array
     */
    public function bill($input)
    {

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here https://dashboard.stripe.com/account
        Stripe::setApiKey("sk_test_sHX7ljvlFj1nozB8TIiisE7h");

        // Get the credit card details submitted by the form
        $token = $input['stripeToken'];

        // Create the charge on Stripe's servers - this will charge the user's card
        try
        {

            $charge = Stripe_Charge::create(array(
                    "amount" => $input['cost'], // amount in cents, again
                    "currency" => "usd",
                    "card" => $token,
                    "description" => "payinguser@example.com")
            );

            $data = [
                'status' => true,
                'message' => $charge
            ];

        } catch(Stripe_CardError $error) {

            $data = [
                'status' => false,
                'message' => $error
            ];
        }

        return $data;
    }
} 