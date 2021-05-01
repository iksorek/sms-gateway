<?php

namespace App\Jobs;

use App\Models\Sms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class RefreshSmsStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $client = new Client($account_sid, $auth_token);
        $messages = $client->messages
            ->read([
                'status' != 'delivered'
                //todo if project grows, would put some more limitations here
            ],
                20
            );
        foreach ($messages as $record) {
            $string_to_be_compared = '0' . substr($record->to, -10); //i know, this is poor solution, but work for now :)
            Sms::where('recipient', '=', $string_to_be_compared)->where('message', '=', $record->body)->update(['status' => $record->status]);
        }
    }
}
