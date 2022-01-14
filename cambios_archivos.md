13/01/2022

Controllers
  Encuestas.php
    métodos
      -reporte_promedios  
      -agregar . linea #245
      -encuesta_type_is_allowed . linea #329



































##### BASE DE DATOS #####

-Agregar campo respuesta_pregunta_resumen(TINYINT DAFAULT NULL) a la tabla encuestas_clientes
-Agregar campo pausar(TINYINT DAFAULT 0) a la tabla encuestas_clientes

##### RUTAS #####

routes.php
  RUTAS AÑADIDAS
    -$route['encuestas/(:num)/encuestaCliente/(:num)/guardar'] = 'encuestaCliente/saveMensaje/$1/$2';
    -$route['encuestas/(:num)/cliente/(:num)/pausar'] = 'encuestaCliente/pausar/$1/$2';

########################

Controllers
  Encuestas.php
    métodos
      -reporteDetalle . linea #84
      -agregar . linea #260

  EncuestaCliente.php 
    linea #33 (column_order, column_search)  
    métodos
      -saveMensaje . linea #54
      -getClientesDeEncuesta . linea #201, #214
      -pausar . linea #256

  EncuestaClientePendiente.php 
    linea #29 (column_order, column_search)  
    métodos
      -getClientesDeEncuesta . linea #68, #81, #87, #94

  Survey.php
    métodos
      -guardar . linea #94 

Models
  Encuesta_model.php
    métodos
      -getById . linea #20
      -getByIdWithEncuestasClienteCount . linea #32
      -getByTipo . linea #45
          
        
Views
 Encuestas
    mostrar.php 
      -Columna fechaEnvio añadida en tabla encuestas pendientes  
      -Columna pausar añadida en tabla encuestas pendientes  
      -Columna respuesta valor añadida en tabla encuestas enviadas  
      
    
    encuesta_cliente_form.php  
    
    encuestas_preguntas.php . linea #23, #37

    reporte_detallado.php . linea #30

    mostrar_encuestas_clientes.php . columnas añadidas

  _footerTablasEncuestasClientes.php . linea #53

  _footerTablasEncuestasCliente.php . linea #50, #89



  
      

      