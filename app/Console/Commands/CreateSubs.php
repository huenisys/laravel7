<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

class CreateSubs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:csubs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Stripe subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $subscriptionPlan = 'subscription_plan_211898';
        $users = User::all();
        //dump($users);
        foreach($users as $user):
            $user
                ->newSubscription('default', $subscriptionPlan)
                ->trialUntil(Carbon::parse($user->trial_ends_at))
                ->create($user->defaultPaymentMethod()->id);
            sleep(1);
            dump('Creating subscription for: '. $user->email);
        endforeach;

    }
}
