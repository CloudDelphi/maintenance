<?php

namespace MBonaldo\Maintenance\Commands;

use Exception;
use Illuminate\Console\Command;

class MaintenanceOff extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'maintenance:off';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bring the application out of maintenance mode';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            if (! file_exists(storage_path('framework/maintenance'))) {
                $this->comment('Application is already up.');

                return true;
            }

            unlink(storage_path('framework/maintenance'));

            $this->info('Application is now live.');
        } catch (Exception $e) {
            $this->error('Failed to disable maintenance mode.');

            $this->error($e->getMessage());

            return 1;
        }
    }
}
