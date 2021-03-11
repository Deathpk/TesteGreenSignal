<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class taskModel extends Model
{
    protected $table = 'user_tasks';
    public $timestamps = true;
    
    public static function createNewTask(Array $task)
    {  
        taskModel::insert([
            'task_creator' => Auth::user()->cpf,
            'task_owner' => $task['task_owner'],
            'title' => $task['title'],
            'expected_conclusion_date' => $task['expected_conclusion_date'],
            'description' => $task['description'],
            'status' => $task['status']
        ]);
    }

    public static function updateTask($id,Array $task)
    {
        taskModel::where('id',$id)->update([
            'task_owner' => $task['taskOwner'],
            'title' => $task['title'],
            'expected_conclusion_date' => $task['expectedDate'],
            'description' => $task['taskDescription'],
            'status'=> $task['taskStatus']
        ]);
    }

    public static function deleteTask($id)
    {
        // dd($id);
        taskModel::where('id',$id)->delete();
        // taskModel::save();
    }

    public static function getUserTasks()
    {
        return taskModel::where('task_owner' , Auth::user()->cpf)->get([
            'id',
            'task_owner',
            'title',
            'expected_conclusion_date',
            'description',
            'status'
        ]);
    }

    public static function getTasksDesignatedByUser()
    {
        return taskModel::where('task_creator', Auth::user()->cpf)
        ->where('task_owner','!=',Auth::user()->cpf)
        ->get([
            'id',
            'task_owner',
            'title',
            'expected_conclusion_date',
            'description',
            'status'
        ]);
    }

    public static function getTaskById($id)
    {
        return taskModel::where('id',$id)->first();
    }
}
