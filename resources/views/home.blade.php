@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if($tareas->isEmpty())
    <div class="d-flex flex-column justify-content-center">
        <h3 class="font-weight-bold">Vaya, parece que no tienes tareas registradas. </h3>
        <button class="btn btn-success btn-lg">Registrar tarea</button>
    </div>
    @else
     @foreach ($tareas as $tarea)
    <div class="card col-lg-8 mt-5">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="..." class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ $tarea->name }}</h5>
        <p class="card-text">{{ $tarea->description }}</p>
        <p class="card-text"><small class="text-muted">{{ $tarea->state }}</small></p>
        <button class="btn btn-info text-white">EDITAR</button>
        <button class="btn btn-danger" onclick="deleteThis()" task-id="{{$tarea->id}}">ELIMINAR</button>
      </div>
    </div>
  </div>
</div>
@endforeach
    @endif
    </div>
</div>
@endsection
