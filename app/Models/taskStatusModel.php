<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class taskStatusModel extends Model
{
    protected $table = 'task_status';
    public $timestamps = false;

    public static function getAllTaskStatus()
    {
        return taskStatusModel::all();
    }

    public static function getStatusName($statusId)
    {
        return taskStatusModel::where('status', $statusId)->first('status_name');
    }

}
