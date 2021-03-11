<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use App\Models\taskStatusModel;
use App\Models\taskModel;
use App\Http\Requests\createNewTaskRequest;
use Auth;
use Exception;

class taskController extends Controller
{
    public function showNewTaskForm()
    {
        $allStatus = taskStatusModel::getAllTaskStatus();
        $currentUser = userModel::where('cpf', Auth::user()->cpf)->get(['name','email']);
        $otherUsers = userModel::getAllUsers();
        return view('newTaskForm', [
            'currentUser'=>$currentUser ,
            'otherUsers'=>$otherUsers ,
            'status'=>$allStatus
        ]);
    }

    public function createNewTask(createNewTaskRequest $request)
    {
        $taskOwner = userModel::where( 'email', $request->taskOwner )->first('cpf');
        try{
            $task = taskModel::createNewTask([
                'task_owner' => $taskOwner->cpf,
                'title'=> $request->title,
                'expected_conclusion_date'=> date('Y-m-d',strtotime($request->expectedDate) ),
                'description'=> $request->taskDescription,
                'status'=> $request->taskStatus
            ]);
        } catch (Exception $e){
            $this->flashError('Oops.. houve uma falha inesperada! , '.$e->getMessage() );
            return redirect('dashboard/new/task');
        }

        $this->flashSuccess('Tarefa adicionada com sucesso!');
        return redirect('dashboard/main');
    }

    public function showEditTaskForm($id)
    {
        $taskData = taskModel::getTaskById($id);

        $currentTaskStatus = taskStatusModel::where('status',$taskData->status)->get();
        $otherStatus = taskStatusModel::where('status','!=',$taskData->status)->get();

        $currentTaskOwner = userModel::where('cpf', $taskData->task_owner)->get(['name','email']);
        $otherUsers = userModel::where('cpf','!=',$taskData->task_owner)->get(['name','email']);
        
        return view('updateTaskForm',[
            'taskData' => $taskData,
            'currentTaskStatus' => $currentTaskStatus,
            'otherStatus' => $otherStatus,
            'currentTaskOwner' => $currentTaskOwner,
            'otherUsers' => $otherUsers
        ]);
    }

    public function updateTask($id , Request $request){
        
        try{
            $taskOwner = userModel::where('email',$request->taskOwner)->first('cpf');

            $updateTask = taskModel::updateTask($id,[
                'title' => $request->title,
                'expectedDate' => date('Y-m-d',strtotime($request->expectedDate) ),
                'taskOwner' => $taskOwner->cpf,
                'taskDescription' => $request->taskDescription,
                'taskStatus'=> $request->taskStatus
            ]);
        } catch(Exception $e){
            $this->flashError('Oops.. houve uma falha inesperada! , '.$e->getMessage() );
            return redirect('dashboard/main');
        }

        $this->flashSuccess('Tarefa adicionada com sucesso!');
        return redirect('dashboard/main');
    }

    public function deleteTask(Request $request)
    {
        try{
            $deleteTask = taskModel::deleteTask($request->taskId);
        } catch(Esception $e){
            $this->flashError('Oops.. houve uma falha inesperada! , '.$e->getMessage() );
        }
        $this->flashSuccess('Tarefa excluida com sucesso!');
        return redirect('dashboard/main');
    }

    
}
