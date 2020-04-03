Flow:
=====

- set the stripe key for the correct account
- [x] Timezone, set script to use: UTC matching the spreadsheet timezone.
- [ ] Update the prod (id is unique) and plan (can be arbitrary) in Stripe
  - ``$subscriptionPlan = 'subscription_plan_211898';``
- [ ] Migrate DB fresh and seed users based on existing data, with assigned stripe cust ID.
- Support will copy existing Stripe customers table, with expected default pay source.
- Get the user pay method:
  - ``$paymentMethod = User::find(1)->defaultPaymentMethod();``
- Get the existing Next billing date of subscription and use it as end of trial date
	- ``$nextBillDate = '04/06/20';``
	- ``$endTrialDate = Carbon\Carbon::parse($nextBillDate)->subDays(1);``
	- ``App\User::find(1)->newSubscription('default', $subscriptionPlan)->trialUntil($endTrialDate)->create($paymentMethod->id);``

## Tinker sample

```php
$subscriptionPlan = 'subscription_plan_211898';
$paymentMethod = User::find(1)->defaultPaymentMethod();
$nextBillDate = '04/06/20';
$endTrialDate = Carbon\Carbon::parse($nextBillDate)->subDays(1);
App\User::find(1)->newSubscription('default', $subscriptionPlan)->trialUntil($endTrialDate)->create($paymentMethod->id);
```

```php
$user = User::find(1);
$subscriptionPlan = 'subscription_plan_211898';
$user->newSubscription('default', $subscriptionPlan)->trialUntil(Carbon\Carbon::parse($user->trial_ends_at))->create($user->defaultPaymentMethod()->id);
```
