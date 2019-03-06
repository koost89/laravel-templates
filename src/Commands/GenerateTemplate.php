<?php

namespace Koost89\LaravelTemplates\Commands;

use Illuminate\Console\Command;
use File;

class GenerateTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:template
                            {model}
                            {viewMode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new template/view for a model';

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
        $model = $this->argument('model');
        $viewMode = $this->argument('viewMode');

        $availableViewModes = config('templates.availableViewModes');

        $modelPath = config('templates.modelPath');
        $namespace = $modelPath.'\\';
        $classToFind = $namespace . $model;

        if (class_exists($classToFind)) {
            if ($viewMode) {
                $this->generateTemplates($viewMode, $model, $availableViewModes);
            } else {
                $choices = array_merge(['all'], $availableViewModes);
                $mode = $this->choice('Which view modes would you like to generate?', $choices, 0);
                $this->generateTemplates($mode, $model, $availableViewModes);
            }

        } else {
            $this->error('Could not find class: ' . $classToFind);
        }
    }

    private function generateTemplates($mode, $model, $availableModes)
    {

        // If all is selected we first check each available mode in the path (if they exist). If a file exists we cancel the command.
        if ($mode === 'all') {
            foreach ($availableModes as $mode) {
                $view = strtolower($model) . '.' . strtolower($mode);
                $path = $this->viewPath($view);

                if (File::exists($path)) {
                    $this->error("File {$path} already exists!");
                    exit(-1);
                }
            }

            // If no files exist, we can add them all! Create a directory aswell.
            foreach ($availableModes as $mode) {

                $view = strtolower($model) . '.' . strtolower($mode);
                $path = $this->viewPath($view);

                $this->createDir($path);

                File::put($path, "<h1> Hi {$mode} </h1>");
                $this->info("File {$path} created.");
            }
        } else {
            $view = strtolower($model) . '.' . strtolower($mode);
            $path = $this->viewPath($view);

            if (File::exists($path)) {
                $this->error("File {$path} already exists!");
                exit(-1);
            }

            $this->createDir($path);

            File::put($path, "<h1> Hi {$mode} </h1>");
            $this->info("File {$path} created.");

        }


    }

    public function viewPath($view)
    {
        $templatePath = config('templates.templatesPath');
        $view = str_replace('.', '/', $view) . '.blade.php';

        $path = "resources/views/{$templatePath}/{$view}";

        return $path;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}
