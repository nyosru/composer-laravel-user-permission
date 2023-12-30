<?php

namespace Phpcatcom\Permission\Commands;

use Phpcatcom\Permission\Controllers\PermissionController;
use Phpcatcom\Permission\Models\Permission;
use Phpcatcom\Permission\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class PermissionsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate {--fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates permissions based on your routes';

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
        $options = $this->options();

        if ($options['fresh']) {
            PermissionController::fresh();
        }

        PermissionController::generate();

    }
}
