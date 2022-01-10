-Agregar campo respuesta_pregunta_resumen a la tabla encuestas_clientes

Controllers
  EncuestaCliente.php
    propiedades
      -group_by
    métodos
      -saveMensaje . linea #55  
      -getClientesDeEncuesta . linea #202

  EncuestaClientePendiente.php
    propiedades
      -group_by 
    métodos
      -saveMensaje . linea #55 
      -getClientesDeEncuesta . linea #99 

  EncuestaResponsable.php
    propiedades
      -group_by

  Encuestas.php
    propiedades
      -group_by
    métodos
      -getEncuestas . linea #199, #205

  Survey.php
    métodos
      -guardar . linea #94 

Models
  Encuesta_model.php . linea #25
          
        
Views
 Encuestas
    mostrar.php 
      -Columna añadida en tabla encuestas enviadas  
    index.php
      -Columnas añadidas 
    encuesta_cliente_form.php  
    encuestas_preguntas.php . linea #23, #37
      

routes.php
 linea #77        