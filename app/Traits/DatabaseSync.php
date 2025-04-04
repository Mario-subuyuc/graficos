<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait DatabaseSync
{
    public static function bootDatabaseSync()
    {
        static::created(function (Model $model) {
            self::syncDatabases($model, 'insert');
        });

        static::updated(function (Model $model) {
            self::syncDatabases($model, 'update');
        });

        static::deleted(function (Model $model) {
            self::syncDatabases($model, 'delete');
        });
    }

    protected static function syncDatabases(Model $model, $action)
    {
        $connections = ['mysql', 'pgsql', 'sqlsrv'];

        foreach ($connections as $connection) {
            if ($connection !== config('database.default')) {
                $db = DB::connection($connection);

                if ($action === 'insert') {
                    $db->table($model->getTable())->insert($model->getAttributes());
                } elseif ($action === 'update') {
                    $db->table($model->getTable())
                        ->where('id', $model->id)
                        ->update($model->getAttributes());
                } elseif ($action === 'delete') {
                    $db->table($model->getTable())->where('id', $model->id)->delete();
                }
            }
        }
    }
}
