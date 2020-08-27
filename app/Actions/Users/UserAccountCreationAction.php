<?php

namespace App\Actions\Users;

use App\Actions\Action;
use App\Actions\Complete;
use App\Actions\Failure;
use App\User;
use App\Utilities\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Create a new user.
 *
 * Expected input:
 *  - 'name' (string)
 *  - 'email' (string)
 *  - 'password' (string)
 */
class UserAccountCreationAction implements Action
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['email', 'name', 'password'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        if (User::where('email', strtolower($data['email']))->exists()) {
            return new Failure('There is already a user account with that email address.');
        }

        $user = User::create([
            'email' => strtolower(Arr::get($data, 'email')),
            'name' => Arr::get($data, 'name'),
            'password' => Hash::make(Arr::get($data, 'password')),
        ]);

        if ($user) {
            return new Complete('User Account Created', ['user' => $user]);
        }

        return new Failure('There was a problem creating the user.');
    }
}
