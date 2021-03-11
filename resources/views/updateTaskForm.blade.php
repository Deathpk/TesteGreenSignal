@extends('layouts.app')
@section('content')
    <section class="container-fluid newTaskForm">
        <div class="container-fluid form-title">
            <h1>Editar Tarefa</h1>
        </div>

        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <li>{{$error}}</li>
                </div>
             @endforeach
        </ul>
        @endif
        
        <div class="container">
            <form action="{{route('updateTask',$taskData->id)}}" method="post">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Titulo da tarefa</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$taskData->title}}" placeholder="Insira o titulo da tarefa.">
                </div>

                <div class="form-group">
                    <label for="expectedDate">Data prevista para conclusão</label>
                    <input type="text" class="form-control date" data-provide="datepicker" id="expectedDate" name="expectedDate" value="{{$taskData->expected_conclusion_date}}"  placeholder="Insira a data prevista de conclusão da tarefa.">
                </div>

                <div class="form-group">
                    <label for="taskOwner">Dono da tarefa</label>
                    <select class="form-control" id="taskOwner" name="taskOwner">
                        @foreach($currentTaskOwner as $obj)
                            <option value="{{$obj->email}}">{{$obj->name}}</option>
                        @endforeach

                        @foreach($otherUsers as $obj)
                            <option value="{{$obj->email}}">{{$obj->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="taskDescription">Descrição da tarefa</label>
                    <textarea type="text-area" class="form-control" id="taskDescription" name="taskDescription" placeholder="Insira a descrição da tarefa.">{{$taskData->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="taskStatus">Status da tarefa</label>
                    <select class="form-control" id="taskStatus" name="taskStatus">
                        @foreach($currentTaskStatus as $obj)
                            <option value="{{$obj->status}}">{{$obj->status_name}}</option>
                        @endforeach

                        @foreach($otherStatus as $obj)
                            <option value="{{$obj->status}}">{{$obj->status_name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Confirmar</button>
            </form>
        </div>

    </section>

@endsection