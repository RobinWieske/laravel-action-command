<?php

namespace RobinWieske\LaravelActionCommand\Console;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;

class LaravelActionCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    public $signature = 'action:make {name} {model?} {--force}';

    public $description = 'Create an invokable action class';

    protected $type = 'Action';

    protected $operation = null;

    public function handle()
    {
        if ($this->argument('model') != null) {
            $this->operation = $this->choice(
                'Do you intend a specific operation?',
                [
                    'No', 'Create', 'Update', 'Delete',
                ],
                0
            );

            if ($this->operation == 'No') {
                $this->operation = null;
            }
        }

        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        if ($this->operation != null) {
            return match ($this->operation) {
                'Create' => $this->resolveStubPath('/stubs/action.create-model.stub'),
                'Update' => $this->resolveStubPath('/stubs/action.update-model.stub'),
                'Delete' => $this->resolveStubPath('/stubs/action.delete-model.stub'),
            };
        }

        return $this->resolveStubPath('/stubs/action.stub');
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $model = str($this->argument('model'))->classBasename();

        if ($model != null) {
            return $this->replaceNamespace($stub, $name)
                ->replaceModel($stub, $model)
                ->replaceClass($stub, $name);
        }

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the class model for the given stub.
     *
     * @param  string  $stub
     * @param  string  $model
     * @return string
     */
    protected function replaceModel(&$stub, $model)
    {
        $stub = str_replace(['DummyModel', '{{ model }}', '{{model}}'], $model, $stub);

        return $this;
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
            ['model', InputArgument::OPTIONAL, 'The name of the model'],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => [
                'What should the '.strtolower($this->type).' be named?',
                match ($this->type) {
                    'Action' => 'E.g. Action',
                    default => '',
                },
            ],
        ];
    }
}
