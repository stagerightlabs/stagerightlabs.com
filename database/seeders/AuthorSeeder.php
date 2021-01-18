<?php

namespace Database\Seeders;

use App\Actions\Users\UserAccountCreatingAction;
use Exception;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Create a simulated backstage user.
     *
     * @return void
     */
    public function run()
    {
        $action = UserAccountCreatingAction::execute([
            'email' => 'ryan@stagerightlabs.com',
            'name' => 'Ryan Durham',
            'password' => 'secret',
        ]);

        if ($action->failed()) {
            throw new Exception($action->getMessage());
        }

        $action->user->allowed_backstage = true;
        $action->user->save();
    }
}
