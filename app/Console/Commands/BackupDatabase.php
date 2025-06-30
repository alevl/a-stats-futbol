<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Respaldar la base de datos y guardar el archivo en storage/app/backups';

    public function handle()
    {
        return $this->generateBackup();
    }

    public static function generateBackup()
    {
        date_default_timezone_set('America/Caracas');
        $fecha_hoy = date('d-m-Y');

        $filename = 'respaldoBD.sql';

        $path = storage_path("app/backups/{$filename}");

        $db = config('database.connections.mysql');

        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            escapeshellarg($db['username']),
            escapeshellarg($db['password']),
            escapeshellarg($db['host']),
            escapeshellarg($db['database']),
            escapeshellarg($path)
        );

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            return $filename;
        }

        return null;
    }
}
