<?php

namespace App\Console\Commands;

use App\Utilities\Str;
use Illuminate\Console\Command;
use App\Actions\Users\UserAccountCreationAction;

class CreateBackstageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backstage:user {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backstage admin user account.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');

        $password = app()->environment('local')
            ? 'secret'
            : Str::random(16);

        $action = (new UserAccountCreationAction)->execute([
            'email' => $email,
            'name' => 'Backstage User',
            'password' => $password,
        ]);

        if ($action->failed()) {
            $this->error($action->getMessage());

            return 1;
        }

        $action->user->allowed_backstage = true;
        $action->user->save();

        $this->info('Backstage User Account Created:');
        $this->info("{$email} - {$password}");

        return 0;
    }
}
