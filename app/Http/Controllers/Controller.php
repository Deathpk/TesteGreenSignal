<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\userModel;
use App\Models\taskStatusModel;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function flashSuccess($message) {
        $this->setupFlash("Sucesso!", $message, 'success');
    }
   
    public function flashError($message) {
        $this->setupFlash("Oops... Algo deu errado!", $message, 'error');
    }
   
    private function setupFlash($title, $message, $type) {
        request()->session()->flash('swal_msg', [
           'title' => $title,
           'message' => $message,
           'type' => $type,
        ]);
    }

    /**
     * Replace the current cpf and status fields , with It's name
     * @param Array
     * @return Array $userTasks
     */
    public function getUserNameAndStatusName($userTasks)
    {
        foreach($userTasks as $userTask){
            $userTask->task_owner = userModel::getUserNameFromCpf($userTask->task_owner)->name;
            $userTask->status = taskStatusModel::getStatusName($userTask->status)->status_name;
        }
        return $userTasks;
    }

}
