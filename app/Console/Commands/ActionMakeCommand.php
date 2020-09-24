<?php

namespace App\Console\Commands;

use App\Utilities\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ActionMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Action class';

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
        $stub = base_path('stubs/action.stub');

        if (! File::exists($stub)) {
            $this->error('The action stub is not available.');

            return 1;
        }

        if (File::exists($this->path())) {
            $this->error("Action exists: {$this->path()}");

            return 1;
        }

        $this->makeAction($stub);

        $this->makeUnitTestFile();

        return 0;
    }

    /**
     * Generate the class name.
     *
     * @return string
     */
    protected function className()
    {
        $name = Str::studly(class_basename($this->argument('name')));

        if (Str::endsWith($name, 'Action')) {
            return $name;
        }

        return $name.'Action';
    }

    /**
     * Generate the namespace.
     *
     * @return string
     */
    protected function namespace()
    {
        $directories = preg_split('/[.\/]+/', $this->argument('name'));
        array_pop($directories);

        if (empty($directories)) {
            return 'App\Actions';
        }

        return 'App\Actions\\'.collect($directories)
            ->map([Str::class, 'studly'])
            ->implode('\\');
    }

    /**
     * Generate the file path.
     *
     * @return string
     */
    protected function path()
    {
        $path = app_path('Actions/')
            .collect(preg_split('/[.\/]+/', $this->argument('name')))
            ->map([Str::class, 'studly'])
            ->implode('/');

        if (! Str::endsWith($path, 'Action')) {
            $path .= 'Action';
        }

        $path .= '.php';

        File::makeDirectory(
            dirname($path),
            $mode = 0777,
            $recursive = true,
            $force = true
        );

        return $path;
    }

    /**
     * Write a new action class to disk.
     *
     * @param string $stub
     * @return void
     */
    public function makeAction($stub)
    {
        $template = file_get_contents($stub);

        $action = preg_replace_array(
            ['/\[class\]/', '/\[namespace\]/'],
            [$this->className(), $this->namespace()],
            $template
        );

        File::put($this->path(), $action);

        $this->info("Created {$this->path()}");
    }

    /**
     * Call the artisan make:test --unit command.
     *
     * @return void
     */
    public function makeUnitTestFile()
    {
        $name = 'Actions/'.$this->argument('name');

        if (! Str::endsWith($name, 'Action')) {
            $name .= 'Action';
        }

        $this->call('make:test', [
            'name' => $name.'Test',
            '--unit' => true,
        ]);
    }
}
