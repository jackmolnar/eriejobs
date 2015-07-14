<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 7/2/15
 * Time: 9:45 AM
 */

namespace EriePaJobs\Subscriptions;

use EriePaJobs\BaseCommand;
use EriePaJobs\Payments\PaymentRepository;
use EriePaJobs\Users\UserRepository;

class CreateNewSubscriptionCommand extends BaseCommand{

    function __construct($input)
    {
        $this->input = $input;
        $this->paymentRepo = new PaymentRepository;
        $this->userRepo = new UserRepository;
        $this->user = $this->userRepo->authedUser();
    }

    public function execute()
    {
        $this->user->subscription(strtolower($this->input['plan']).'plan')->create($this->input['stripeToken'], [
            'email' => $this->user->email, 'description' => 'Our First Customer'
        ]);

        $result['status'] = true;
        $result['message'] = "You're now subscribed to the ".$this->input['plan']." Plan.";

        return $result;
    }
}