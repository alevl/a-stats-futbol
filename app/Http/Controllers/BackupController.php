<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\DatabaseBackupService;

class BackupController extends Controller
{
    public function descargar()
    {
        $filename = DatabaseBackupService::backup();
        $path = storage_path("app/backups/{$filename}");

        if (!file_exists($path)) {
            return back()->with('error', 'No se pudo generar el respaldo.');
        }

        chmod($path, 0644); // Asegura permisos de lectura

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
