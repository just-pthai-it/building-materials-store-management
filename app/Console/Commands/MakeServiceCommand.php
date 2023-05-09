<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;

class MakeServiceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new service class';

    protected $type = 'class';

    protected function getStub () : string
    {
        if ($this->option('model') != null)
        {
            return base_path('/stubs/service.model.stub');
        }

        return base_path('/stubs/service.stub');
    }

    protected function getDefaultNamespace ($rootNamespace) : string
    {
        return "{$rootNamespace}\Services";
    }

    protected function replaceClass ($stub, $name) : array|string
    {
        $stub = parent::replaceClass($stub, $name);
        if ($this->option('model') != null)
        {
            $stub = str_replace('{{ model }}', $this->option('model'), $stub);
            $stub = str_replace('{{ lc_model }}', lcfirst($this->option('model')), $stub);
        }

        return $stub;
    }
}
