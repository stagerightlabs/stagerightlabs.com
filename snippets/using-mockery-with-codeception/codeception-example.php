$I = new FunctionalTester($scenario);

$I->wantTo('upgrade a subscription plan');

$I->amActingAs('testuser@example.com'); // This is a custom helper method which sets the active user

// Establish the necessary mocks
$mockBillingManager = Mockery::mock('Acme\Billing\StripeBillingManager');

// Make sure to set the expectations of the mock object before binding it to the IoC
$I->getApplication()->bind('Acme\Billing\StripeBillingManager', $mockBillingManager);

$I->amOnRoute('billing.upgrade.form');

$I->submitForm('subscription-form', [
    'plan' => 'premium',
    'token' => csrf_token()
]);

$I->seeInDatabase('users', ['email' => 'testuser@example.com', 'plan' => 'premium');
