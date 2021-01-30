## Prueba técnica 

La aplicación se llama Sysgest, se encuentra desarrollada en Laravel 7.30.4 y Bootstrap 4.6.0. El objetivo es administrar tareas, tiene un sistema de CRUD básico, autentificación y reporte de la cantidad de tareas que aplican para cada estado (INICIADO, EN PROCESO, CANCELADA, COMPLETADA) Cuando una tarea se define como "COMPLETADA" ya no puede cambiarse su estado.  

La aplicación se ejecuta utilizando el comando php artisan serve y todas las tablas se encuentran en las migraciones, por lo tanto es necesario utilizar php artisan migrate para migrar las tablas.
