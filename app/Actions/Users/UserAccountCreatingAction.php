<?php

namespace App\Actions\Users;

use App\User;
use App\Utilities\Arr;
use Illuminate\Support\Facades\Hash;
use StageRightLabs\Actions\Action;

class UserAccountCreatingAction extends Action
{
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new user account.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        if (User::where('email', strtolower($input['email']))->exists()) {
            return $this->fail('There is already a user account with that email address.');
        }

        $this->user = User::create([
            'email' => strtolower(Arr::get($input, 'email')),
            'name' => Arr::get($input, 'name'),
            'password' => Hash::make(Arr::get($input, 'password')),
        ]);

        if ($this->user) {
            return $this->complete('User Account Created');
        }

        return $this->fail('There was a problem creating the user.');
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'email', // string
            'name', // string
            'password', // string
        ];
    }
}
