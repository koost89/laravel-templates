<?php

namespace Koost89\LaravelTemplates;

use Illuminate\Support\ServiceProvider;


class TemplateServiceProvider extends ServiceProvider {

    protected $commands = [
        'Koost89\LaravelTemplates\Commands\GenerateTemplate',
    ];

    public function boot() {
        $this->publishes([
            __DIR__ . '/config/templates.php' => config_path('templates.php'),
        ], 'config');

    }

    public function register() {
        $this->commands($this->commands);

        $file = (__DIR__.'/Helpers/helpers.php');
        if (file_exists($file)) {
            require_once($file);
        }

    }

}
