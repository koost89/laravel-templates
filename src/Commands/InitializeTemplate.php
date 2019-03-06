<?php

namespace Koost89\LaravelTemplates\Commands;

use Illuminate\Console\Command;
use File;

class InitializeTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the template files needed for the package';

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
        $this->generateContentFile();
    }

    private function generateContentFile()
    {
        $path = "resources/views/{$templatePath}";
        $contentFile = "content.blade.php";

        if (File::exists("resources/views/{$templatePath}/{$contentFile}") && !$this->option('force')){
            $this->error("Content file already exists at: {$path}/{$contentFile}. Use the --force option to overwrite this file");
        }
        else {
            //Copy Stubs/view/content.blade.php.stub to resources/views/{templatePath}/content.blade.php
            File::copy(__DIR__."Stubs/view/{$contentFile}.stub", "{$path}/{$contentFile}");
        }
    }

    public function viewPath($view)
    {
        $templatePath = config('templates.templatesPath');
        $path = "resources/views/{$templatePath}";

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
