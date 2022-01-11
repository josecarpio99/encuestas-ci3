-Agregar campo respuesta_pregunta_resumen(TINYINT DAFAULT NULL) a la tabla encuestas_clientes
-Agregar campo pausar(TINYINT DAFAULT 0) a la tabla encuestas_clientes

Controllers
  Encuestas.php
    métodos
      -reporteDetalle . linea #84

  EncuestaCliente.php   
    métodos
      -saveMensaje . linea #54
      -getClientesDeEncuesta . linea #201  
      -pausar . linea #256

  EncuestaClientePendiente.php   
    métodos
      -getClientesDeEncuesta . lnea #83

  Survey.php
    métodos
      -guardar . linea #94 

Models
  Encuesta_model.php
    métodos
      -getById . linea #20
      -getByIdWithEncuestasClienteCount . linea #32
          
        
Views
 Encuestas
    mostrar.php 
      -Columna pausar añadida en tabla encuestas pendientes  
      -Columna respuesta valor añadida en tabla encuestas enviadas  
    
    encuesta_cliente_form.php  
    
    encuestas_preguntas.php . linea #23, #37

    reporte_detallado.php . linea #30
      

routes.php
  RUTAS AÑADIDAS
    -$route['encuestas/(:num)/encuestaCliente/(:num)/guardar'] = 'encuestaCliente/saveMensaje/$1/$2';
    -$route['encuestas/(:num)/cliente/(:num)/pausar'] = 'encuestaCliente/pausar/$1/$2';      