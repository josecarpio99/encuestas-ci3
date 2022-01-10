-Agregar campo respuesta_pregunta_resumen a la tabla encuestas_clientes

Controllers
  EncuestaCliente.php
    propiedades
      -group_by
  EncuestaClientePendiente.php
    propiedades
      -group_by 
  EncuestaResponsable.php
    propiedades
      -group_by
  Encuestas.php
    propiedades
      -group_by
    métodos
      -getEncuestas  
  Survey.php
    métodos
      -guardar
  
  EncuestaCliente
    métodos
      -getClientesDeEncuesta  
Views
 Encuestas
    mostrar.php 
      -Columna añadida en tabla encuestas enviadas   