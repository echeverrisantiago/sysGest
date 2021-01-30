

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
        if($('#'+mainCont).find('.taskStateEdit').val() != 'COMPLETADA'){
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

    $(document).on('click', '.eliminarTarea', function addTask(){
        id = $(this).attr('data-id');
        data = {};
        data['id'] = id;
        alert(data['id']);
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
               alert(res.responseText );
            }
        });

    });

    $('.showAddTask').click(function(){
        $('#addTaskCont').removeClass('d-none');
        $('#addTaskCont').addClass('d-flex');
    });

    $('#addNewTask').click(function(){
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

});