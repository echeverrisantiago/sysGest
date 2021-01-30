@extends('layouts.app')

@section('content')

<div class="container flex-column" id="contentTasks">
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estás seguro de que deseas borrar esta tarea?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-footer d-flex justify-content-end">
        <button type="button" class="btn btn-primary">Descartar</button>
        <button type="button" data-dismiss="modal" id="confirmDelete" data-confirmdelete="" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>
    @if($tasks->isEmpty())
    <h2 class="text-center strong">Vaya, parece que no tienes tareas creadas todavía</h2>
    <button class="btn btn-lg btn-success d-flex mx-auto" id="addNewTask">Agregar nueva tarea</button>
    <div class="row justify-content-center" style="margin-top:2rem">
    @else
    <button class="btn btn-lg btn-success d-flex mx-auto" id="addNewTask">Agregar nueva tarea</button>
    <div class="row justify-content-center" style="margin-top:2rem">
        @foreach($tasks as $task)
<div class="card col-lg-8 pb-3" id="task-{{$task->id}}" style="margin-bottom: 2rem;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{ asset('/img/avatar.png') }}" class="card-img" alt="...">
    </div>
    <div class="col-md-8 pb-3">
      <div class="card-body">
        <h5 class="card-title valoresFijos">
            {{$task->name}}
        </h5><input type="text" class="valoresEditar d-none taskNameEdit" value="{{$task->name}}">
        <p class="card-text valoresFijos">
            {{$task->description}}
        </p><input type="text" class="valoresEditar d-none taskDescriptionEdit" value="{{$task->description}}">
        <p class="card-text">
            <small class="text-muted valoresFijos taskStateFijo">{{$task->state}}</small>
        </p>
        @if($task->state != 'COMPLETADA')
        <div  class="valoresEditar d-none">
            <label>Estado: </label>
        <select type="text" class="taskStateEdit" value="{{$task->state}}">
            <option value="INICADA">INICIADA</option>
            <option value="EN PROCESO">EN PROCESO</option>
            <option value="CANCELADA">CANCELADA</option>
            <option value="COMPLETADA">COMPLETADA</option>
</select>
</div>
@endif
<div>
          <p class="card-text valoresFijos">Fecha de inicio: {{$task->dateSTART}}</p>
          <p class="valoresEditar d-none" >
          <label>Fecha de inicio: </label>
              <input type="date" class="taskDateSTARTEdit" value="{{$task->dateSTART}}"></p>
      </div>
      <div>
      <p class="card-text valoresFijos">Fecha de fin: {{$task->dateEND}}</p>
      <p class="valoresEditar d-none" >
          <label>Fecha de fin: </label>
          <input type="date" class="taskDateENDEdit" value="{{$task->dateEND}}"></p>
      </div>
      <input type="hidden" class="taskIDEdit" value="{{$task->id}}">
      </div>
      <div class="d-flex justify-content-around valoresFijos valoresFijosButtons">
          <button class="btn btn-dark btn-lg text-white editTask" style="width: 40%;" data-id="task-{{$task->id}}">Editar tarea</button>
          <button class="btn btn-danger btn-lg text-white eliminarTarea" style="width: 40%;" data-id="{{$task->id}}">Eliminar tarea</button>
      </div>
      <div class="justify-content-around valoresEditar d-none valoresEditarButtons">
          <button class="btn btn-dark btn-lg text-white descartarTask" style="width: 40%;" data-id="task-{{$task->id}}">Descartar cambios</button>
          <button class="btn btn-success btn-lg text-white actualizarTarea" style="width: 40%;" data-id="task-{{$task->id}}">Actualizar tarea</button>
      </div>
    </div>
  </div>
</div>
        @endforeach
        @endif
    </div>
</div>
<!-- New task -->
<div id="newTask" class="d-none flex-column col-lg-10 mx-auto">
    <h2 class="text-center">¡Registra tu tarea!</h2>
  <div class="form-group">
    <label for="exampleFormControlInput1">Nombre</label>
    <input type="text" class="form-control" id="taskName" placeholder="Mi primer tarea...">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Estado</label>
    <select class="form-control" id="taskState">
      <option>INICIADO</option>
      <option>EN PROCESO</option>
      <option>CANCELADA</option>
      <option>COMPLETADA</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Descripción</label>
    <textarea class="form-control" id="taskDescription" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Fecha de inicio</label>
    <input type="date" id="dateSTART">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Fecha de fin</label>
    <input type="date" id="dateEND">
  </div>
  <div><small class="text-gray">Por favor diligencia todos los campos del formulario.</small>
  <div class="mx-auto col-lg-4 d-flex justify-content-around">
      <button class="btn btn-info btn-lg text-white backTasks">Volver tareas</button>
      <button class="btn btn-success btn-lg text-white addTask">Crear tarea</button>
</div>
  </div>

</div>

<!-- Edit task -->
<div id="editTaskCont" class="d-none flex-column col-lg-10 mx-auto">
    <h2 class="text-center">Edita tu tarea</h2>

  <div class="form-group">
    <label for="exampleFormControlInput1">Nombre</label>
    <input type="text" class="form-control" id="taskName">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Estado</label>
    <select class="form-control" id="taskState">
      <option>INICIADO</option>
      <option>EN PROCESO</option>
      <option>CANCELADA</option>
      <option>COMPLETADA</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Descripción</label>
    <textarea class="form-control" id="taskDescription" rows="3"></textarea>
  </div>
  <div>
  <div class="mx-auto col-lg-4 d-flex justify-content-around">
      <button class="btn btn-info btn-lg text-white backTasks">Volver tareas</button>
      <button class="btn btn-success btn-lg text-white addTask">Actualizar tarea</button>
</div>
  </div>

</div>
@endsection
