@extends('layouts.app')
{{-- @extends('deleteTaskModal') --}}
@section('content')
  <section class="container-fluid dashboard-session">
        
      <div class=" container-fluid table-title">
        <h1>Suas Tarefas Designadas</h1>
      </div>

      {{-- Bootstrap Modal --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes da tarefa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">
              <div id="task-title"></div>
              <hr>
              <div id="expected-date"></div>
              <div id="task-status"></div>
              <div id="task-owner"></div>
              <h2 style="text-align: center">Descrição</h2>
              <div id="task-description"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>


      <div class="container-fluid owner-tasks">
        <table class="table table-dark table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Tarefa</th>
                <th scope="col">Data Prevista</th>
                <th scope="col">Status</th>
                <th scope="col">Colaborador</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($userTasks as $obj)
                <tr>
                  <th scope="row">{{$obj->title}}</th>
                  <td>{{ date('d/m/Y',strtotime($obj->expected_conclusion_date))}}</td>
                  <td>{{$obj->status}}</td>
                  <td>{{$obj->task_owner}}</td>
                  <td class="btn-group">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="taskDetails({{$obj}})">Ver</button>

                    <form action="{{route('showEditTaskForm',$obj->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-primary">Editar</button>
                    </form>

                    <form id="remove-task" action="{{route('deleteTask')}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger" onclick="deleteContent({{$obj->id}})">Remover</button>
                    </form>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>

      <div class="table-title">
          <h1>Tarefas Designadas a outros Colaboradores</h1>
      </div>
      
      <div class="container-fluid colegues-tasks">
          <table class="table table-dark table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Tarefa</th>
                  <th scope="col">Data Prevista</th>
                  <th scope="col">Status</th>
                  <th scope="col">Colaborador</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tasksDesignatedByUser as $obj)
                <tr>
                  <th scope="row">{{$obj->title}}</th>
                  <td>{{ date('d/m/Y',strtotime($obj->expected_conclusion_date))}}</td>
                  <td>{{$obj->status}}</td>
                  <td>{{$obj->task_owner}}</td>
                  <td class="btn-group">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="taskDetails({{$obj}})">Ver</button>

                    <form action="{{route('showEditTaskForm',$obj->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-primary">Editar</button>
                    </form>

                    <form id="remove-task" action="{{route('deleteTask')}}" method="post">
                      @csrf
                      @method('DELETE')
                      
                      <button type="button" class="btn btn-danger" onclick="deleteContent({{$obj->id}})">Remover</button>
                    </form>

                  </td>
                </tr>
                @endforeach  
              </tbody>
            </table>
      </div>

  </section>

  <script>
    function deleteContent(id){
      Swal.fire({
        title: 'Tem certeza que deseja deletar essa tarefa?',
        text: "Essa ação não poderá ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Deletar!',
        cancelButtonText: 'Não , Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          var form = document.getElementById("remove-task");
          var input = document.createElement('input');

          input.setAttribute('name', 'taskId');
          input.setAttribute('value', id);
          input.setAttribute('type', 'hidden');

          form.appendChild(input);
          form.submit();
        }
      })
    }

    function taskDetails(task){
      $('#task-title').html(task.title);
      $('#expected-date').html('Data Prevista: '+task.expected_conclusion_date);
      $('#task-status').html('Status: '+task.status);
      $('#task-owner').html('Dono da tarefa: '+task.task_owner);
      $('#task-description').html(task.description);
    }

  </script>
@endsection
