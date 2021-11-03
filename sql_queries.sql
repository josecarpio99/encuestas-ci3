-- Obtener las respuesta de cliente ordenadas por el orden de la pregunta usando group_concat

SELECT c.razonSocial, GROUP_CONCAT(valor ORDER BY orden SEPARATOR '|') as respuestas
FROM `encuestas_clientes_respuestas` ecr
JOIN encuestas_clientes ec
ON ec.idEncuestaCliente = ecr.idEncuestaCliente
JOIN clientes c
ON c.idcliente = ec.idCliente
JOIN encuestas_preguntas ep
ON ep.idEncuestaPregunta = ecr.idEncuestaPregunta
WHERE ec.idEncuesta = 16
GROUP BY c.razonSocial
ORDER BY c.razonSocial, ep.orden;

-- Obtener las respuesta de cliente ordenadas por el orden de la pregunta

SELECT c.razonSocial, valor FROM `encuestas_clientes_respuestas` ecr
JOIN encuestas_clientes ec
ON ec.idEncuestaCliente = ecr.idEncuestaCliente
JOIN clientes c
ON c.idcliente = ec.idCliente
JOIN encuestas_preguntas ep
ON ep.idEncuestaPregunta = ecr.idEncuestaPregunta
WHERE ec.idEncuesta = 16
ORDER BY c.razonSocial, ep.orden;