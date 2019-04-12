$I = new FunctionalTester($scenario);

$I->wantTo('upgrade a subscription plan');

$I->amActingAs('testuser@example.com'); // This is a custom helper method which sets the active user

// Establish the necessary mocks
$I->bindService('Acme\Billing\BillingInterface', function(){
    return Mockery::mock('Acme\Billing\StripeBillingManager');
});

$I->amOnRoute('billing.upgrade.form');

$I->submitForm('subscription-form', [
    'plan' => 'premium',
    'token' => csrf_token()
]);

$I->seeInDatabase('users', ['email' => 'testuser@example.com', 'plan' => 'premium');
