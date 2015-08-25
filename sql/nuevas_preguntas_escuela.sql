---size of descripcion_valor_maximo 
ALTER TABLE preguntas ALTER COLUMN descripcion_valor_maximo TYPE varchar(80);

--- Checar si se puede insertar sin incluir el id en produccion.

INSERT INTO preguntas (id,titulo,pregunta,descripcion_valor_minimo,descripcion_valor_maximo,tipo_pregunta) values 
(13,'Promoción de vida saludable','¿La escuela promueve actividades orientadas a fomentar la actividad física y vida saludable de los estudiantes y sus familias?','Nunca las promueve','Hay actividades constantes', 1),
(14,'Participación en la educación','¿Recibo información valiosa sobre el progreso que tiene mi hijo en sus aprendizajes?','Nunca recibo información','Constantemente recibo información valiosa', 1),
(15,'Alimentación escolar','¿Se cumple con los lineamientos de distribución y venta de alimentos en las escuelas?','Nunca se cumplen','Siempre se cumplen', 1),
(16,'Ambiente escolar','¿La escuela promueve acciones para prevenir o erradicar el bullying o acoso escolar?','Nunca se llevan a cabo acciones','Se implementan acciones efectivas para prevenir o erradicar el bullying', 1);

--- UPDATE `imco_cte_optimizada`.`preguntas` SET `pregunta`='¿La escuela cuenta con las instalaciones adecuadas para dar clases?',`descripcion_valor_maximo`='Adecuadas' WHERE id = 4;

UPDATE preguntas SET pregunta='¿La escuela cuenta con las instalaciones adecuadas para dar clases?',descripcion_valor_maximo='Adecuadas' WHERE id = 4;
