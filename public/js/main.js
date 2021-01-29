$(document).ready(function(){
    $(document).on('click', function deleteThis(){
        id = $(this).attr('task-id');
        fetch(baseUrl+'/deleteThis/'+id);


    });

});