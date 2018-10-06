<?php

namespace App\Console\Commands;

use File;
use Schema;
use Illuminate\Console\Command;

class CreatePdfDirectoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pdf:storage {resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new PDF storage directory based on the resource name';

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
        $resource = $this->argument('resource');

        if (Schema::hasTable($resource)) {
            $path = storage_path('app/public/') . $resource;
            
            if (!File::exists($path)) {
                if (File::makeDirectory($path, 0777, true, true))
                    $this->info('Directory created [' . $path . ']');

                if (File::put($path . '/.gitignore', "*\n*/\n!.gitignore"))
                    $this->info('Default .gitignore file added to new directory.');
                
                return null;
            }
            return $this->error('PDF directory "' . $resource . '" already exists');
        }
        return $this->error('Table name "' . $resource . '" does not exist.');
    }
}
