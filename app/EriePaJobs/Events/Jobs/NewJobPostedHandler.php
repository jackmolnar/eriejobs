<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/28/14
 * Time: 10:26 PM
 */

namespace EriePaJobs\Events\Jobs;
use Illuminate\Database\Eloquent\Model;

class NewJobPostedHandler {


    /**
     * @param Model $job
     * @param \User $user
     */
    public function handle($package, \User $user)
    {
        // set up confirmation info
        $job_title = $package['epj']->title;
        $subject = 'Job Listing Confirmation';
        $user_email = $user->email;
        $user_name = $user->first_name.' '.$user->last_name;

        // send confirmation email
        \Mail::queue('emails.Jobs.NewJobPosted', ['job_title' => $job_title], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });

        // set up reader notification to admin
        $data = [
            'job_title' => $package['reader']->title,
            'job_description' => $package['reader']->description,
            'publish_date' => $package['reader']->pubDate->pub_date->toFormattedDateString()
        ];

        $subject = 'New Erie Reader Ad';
        $user_email = \Config::get('mail.administrator.email');

        // send reader ad to admin
        \Mail::queue('emails.notifications.ErieReaderAd', $data, function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });

        // send sms notifications
        \Queue::push('EriePaJobs\QueueHandlers\SendNewSMSJobNotifications', ['job_id' => $package['epj']->id]);
    }
}