@extends('layouts.app')

@section('content')
<script>
        var Iniciado = {!! json_encode($tasksIni) !!};
        var Cancelada = {!! json_encode($tasksCanc) !!};
        var Enproceso = {!! json_encode($tasksProc) !!};
        var Completada = {!! json_encode($tasksCom) !!};
    </script>
<div class="container d-flex flex-column">
    <div class="row">
        <div class="reportes d-flex justify-content-center mx-auto">
<canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection