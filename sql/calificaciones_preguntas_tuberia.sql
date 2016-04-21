INSERT INTO tipo_preguntas (id,nombre) values (3, 'acoso_escolar'); -- 3
INSERT INTO tipo_preguntas (id,nombre) values (4, 'falta_profesores'); -- 4

--acoso
INSERT INTO preguntas (id,pregunta,tipo_pregunta) values 
(17,'¿La atención que te brindó el director escolar fue útil para solucionar tu problema?', 3),
(18,'¿Qué tan útil para solucionar tu problema fue la atención que te brindó la línea de atención telefónica?', 3),
(19,'¿Qué tan útil para solucionar tu problema fueron las medidas que se aplicaron en tu escuela?', 3),
(20,'¿Qué tan útil para solucionar tu problema fue la información de TuberiaDeDenuncias?',  3);

-- falta_profesores
INSERT INTO preguntas (id,pregunta,tipo_pregunta) values 
(21,'¿La atención que te brindó el director escolar fue útil para solucionar tu problema?', 4),
(22,'¿Qué tan útil para solucionar tu problema fue la atención que te brindó la línea de atención telefónica?', 4),
(23,'¿Qué tan útil para solucionar tu problema fue la atención de tu supervisor escolar?', 4),
(24,'¿Qué tan útil para solucionar tu problema fue la información de TuberiaDeDenuncias?',  4);
