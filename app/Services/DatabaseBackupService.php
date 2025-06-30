<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupService
{
    public static function backup(): string
    {
        $db = config('database.connections.mysql');
        $pdo = DB::connection()->getPdo();
        $database = $db['database'];

        $sql = "-- Respaldo generado el " . now() . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        $tables = $pdo->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            // Estructura de la tabla
            $createStmt = $pdo->query("SHOW CREATE TABLE `$table`")->fetch();
            $sql .= "-- Estructura de la tabla `$table`\n";
            $sql .= $createStmt['Create Table'] . ";\n\n";

            // Datos
            $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(\PDO::FETCH_ASSOC);
            if (count($rows) > 0) {
                $sql .= "-- Datos de la tabla `$table`\n";
                foreach ($rows as $row) {
                    $values = array_map(function ($value) use ($pdo) {
                        return $pdo->quote($value);
                    }, $row);

                    $columns = implode('`, `', array_keys($row));
                    $valuesStr = implode(', ', $values);

                    $sql .= "INSERT INTO `$table` (`$columns`) VALUES ($valuesStr);\n";
                }
                $sql .= "\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        // Guardar el archivo
        date_default_timezone_set('America/Caracas');
        $fecha_hoy = date('d-m-Y');

        $filename = 'respaldoBD-' . $fecha_hoy . '.sql';
        Storage::put("backups/{$filename}", $sql);

        return $filename;
    }
}
