<?php

namespace Database\Seeders;

use App\Actions\Tags\TagCreatingAction;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Codeception',
            'E-Mail',
            'Eloquent',
            'Laravel',
            'Lumen',
            'PHP',
            'Tailwind',
            'Testing',
            'Three.js',
            'Vagrant',
            'Vue',
            'Vuex',
            'Webpack',
        ])
            ->each(function ($name) {
                (new TagCreatingAction)->execute([
                    'name' => $name,
                ]);
            });
    }
}
