<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\taskModel;
use App\Models\userModel;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $userTasks = $this->getUserNameAndStatusName( taskModel::getUserTasks() );
        $tasksDesignatedByUser = $this->getUserNameAndStatusName( taskModel::getTasksDesignatedByUser() ) ;
        return view('home',[
            'userTasks'=>$userTasks,
            'tasksDesignatedByUser'=>$tasksDesignatedByUser,
        ]);
    }
}
