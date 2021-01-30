

$(document).ready(function(){
    baseUrl = window.location.origin;
    $(document).on('click', '.addTask', function addTask(){

        data = {};
        data['name'] = $('#taskName').val();
        data['description'] = $('#taskDescription').val();
        data['state'] = $('#taskState').val();
        data['dateSTART'] = $('#dateSTART').val();
        data['dateEND'] = $('#dateEND').val();
        data = JSON.stringify(data);
        console.log(data);
        $.ajax({
            type: 'POST',
            url: baseUrl+'/taskAdd/'+data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'data':JSON.stringify(data)},
            dataType: 'json',
            success:function(res){
                console.log(res);
                window.location.replace(baseUrl+'/home')
            },
            error: function(res){
                console.log(res.responseText );
            }
        })

    });


    $(document).on('click', '.actualizarTarea', function addTask(){

        data = {};
        mainCont = $(this).attr('data-id');
        data['name'] = $('#'+mainCont).find('.taskNameEdit').val();
        data['description'] = $('#'+mainCont).find('.taskDescriptionEdit').val();
        if($('#'+mainCont).find('.valoresFijos.taskStateFijo').val() != 'COMPLETADA'){
        data['state'] = $('#'+mainCont).find('.taskStateEdit').val();
        }
        data['id'] = $('#'+mainCont).find('.taskIDEdit').val();
        data['dateSTART'] = $('#'+mainCont).find('.taskDateSTARTEdit').val();
        data['dateEND'] = $('#'+mainCont).find('.taskDateENDEdit').val();
        data = JSON.stringify(data);

        $.ajax({
            type: 'POST',
            url: baseUrl+'/taskEdit/'+data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'data':JSON.stringify(data)},
            dataType: 'json',
            success:function(res){

                window.location.replace(baseUrl+'/home')
            },
            error: function(res){
               console.log(res.responseText );
            }
        })

    });

    $('.eliminarTarea').click(function(){
        id = $(this).attr('data-id');

        $('.modal').addClass('d-flex');
        $('#confirmDelete').attr('data-confirmdelete',id);
    });

    $(document).on('click', '#confirmDelete', function addTask(){
        id = $(this).attr('data-confirmdelete');
        data = {};
        data['id'] = id;
        $.ajax({
            type: 'DELETE',
            url: baseUrl+'/taskDelete/'+id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'data':JSON.stringify(data)},
            dataType: 'json',
            success:function(res){

                window.location.replace(baseUrl+'/home')
            },
            error: function(res){
            }
        });

    });

    $('.showAddTask').click(function(){
        $('#addTaskCont').removeClass('d-none');
        $('#addTaskCont').addClass('d-flex');
    });

    $('#addNewTask').click(function(){
        $('#contentTasks').removeClass('d-flex');
        $('#contentTasks').addClass('d-none');
        $('#newTask').removeClass('d-none');
        $('#newTask').addClass('d-flex');
    });

    $('.backTasks').click(backTasks);

    function backTasks(){
        $('#contentTasks').removeClass('d-none');
        $('#contentTasks').addClass('d-flex');
        $('#newTask').removeClass('d-flex');
        $('#newTask').addClass('d-none');

    }

    $('.editTask').click(function(){
        mainContTask = $(this).attr('data-id');
        $('#'+mainContTask).find('.valoresEditar').removeClass('d-none');
        $('#'+mainContTask).find('.valoresFijosButtons').removeClass('d-flex');
        $('#'+mainContTask).find('.valoresFijos').addClass('d-none');
        $('#'+mainContTask).find('.valoresEditarButtons').addClass('d-flex');
    });

    $('.descartarTask').click(function(){
        mainContTask = $(this).attr('data-id');
        $('#'+mainContTask).find('.valoresEditar').addClass('d-none');
        $('#'+mainContTask).find('.valoresFijosButtons').addClass('d-flex');
        $('#'+mainContTask).find('.valoresFijos').removeClass('d-none');
        $('#'+mainContTask).find('.valoresEditarButtons').removeClass('d-flex');
    });
    if (window.location.href.indexOf("reporteTareas") > -1) {
    var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Iniciado', 'En proceso', 'Cancelada', 'Completada'],
        datasets: [{
            label: '# de Tareas por estado',
            data: [Iniciado, Enproceso, Cancelada, Completada],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    }
});