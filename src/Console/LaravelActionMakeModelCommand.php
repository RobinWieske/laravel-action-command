<?php

namespace RobinWieske\LaravelActionCommand\Console;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class LaravelActionMakeModelCommand extends Command
{
    protected $name = 'make:model';

    protected function getOptions()
    {
        $options = parent::getOptions();

        $options[] = ['actions', 'd', InputOption::VALUE_NONE, 'Generate default actions for the model'];

        return $options;
    }

    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return false;
        }

        if ($this->option('actions')) {
            $this->createActions();
        }

        return true;
    }

    protected function createActions()
    {
        $name = Str::studly(class_basename($this->argument('name')));

        $actions = [
            'Create',
            'Update',
            'Delete',
        ];

        foreach ($actions as $action) {
            $this->createAction($name, $action);
        }
    }

    protected function createAction($modelName, $actionName)
    {
        $actionClass = "{$this->argument('name')}/{$actionName}{$modelName}";

        $this->call('make:action', [
            'name' => "{$actionClass}Action",
            'type' => $actionName,
            'model' => $modelName,
            '--force' => $this->option('force'),
        ]);
    }
}
