<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DbBackupCommand extends Command
{
    protected $signature = 'dbbackup {--restore : Restore from backup file}';

    protected $description = 'Backup or restore the database';

    public function handle()
    {
        $backupDirectory = storage_path('backup');

        // Vérifier si le répertoire de sauvegarde existe, sinon le créer
        if (!file_exists($backupDirectory)) {
            mkdir($backupDirectory, 0755, true);
        }

        if ($this->option('restore')) {
            $this->restoreDatabase();
        } else {
            $this->backupDatabase();
        }
    }

    protected function backupDatabase()
    {
        $backupFileName = 'backup/' . date('Y-m-d_His') . '_backup.sql';

        $this->info('Backing up the database...');

        $command = sprintf(
            'pg_dump -h %s -p %s -U %s -d %s > %s',
            config('database.connections.pgsql.host'),
            config('database.connections.pgsql.port'),
            config('database.connections.pgsql.username'),
            config('database.connections.pgsql.database'),
            storage_path($backupFileName)
        );

        exec($command);

        $this->info('Database backup created: ' . $backupFileName);
    }

    protected function restoreDatabase()
    {
        $backupFileName = $this->ask('Enter the backup file name to restore from (located in the backup folder):');

        $backupFilePath = storage_path("backup/{$backupFileName}");

        if (!file_exists($backupFilePath)) {
            $this->error('Backup file not found: ' . $backupFileName);
            return;
        }

        if ($this->confirm('This will replace the current database. Are you sure you want to continue?')) {
            $this->info('Restoring the database...');

            $command = sprintf(
                'psql -h %s -p %s -U %s -d %s < %s',
                config('database.connections.pgsql.host'),
                config('database.connections.pgsql.port'),
                config('database.connections.pgsql.username'),
                config('database.connections.pgsql.database'),
                $backupFilePath
            );

            exec($command);

            $this->info('Database restored from: ' . $backupFileName);
        } else {
            $this->info('Database restore operation canceled.');
        }
    }
}
