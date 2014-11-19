CREATE TABLE `imco_cte_optimizada`.`tipo_preguntas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
  );

INSERT INTO `imco_cte_optimizada`.`tipo_preguntas` (`nombre`) values ('escuelas');
INSERT INTO `imco_cte_optimizada`.`tipo_preguntas` (`nombre`) values ('bibliotecas');

  ALTER TABLE `imco_cte_optimizada`.`preguntas` 
  ADD tipo_pregunta INT NOT NULL DEFAULT 1,
ADD FOREIGN KEY (tipo_pregunta) REFERENCES `imco_cte_optimizada`.`tipo_preguntas`(id);

INSERT INTO `imco_cte_optimizada`.`preguntas` (`titulo`,`pregunta`,`descripcion_valor_minimo`,`descripcion_valor_maximo`,`tipo_pregunta`) values 
('Atención','¿El personal que atiende la biblioteca responde de forma adecuada a los usuarios?','1 = Responde de forma inadecuada','10= Muy adecuada',2),
('Horario','¿Los horarios que tiene la biblioteca son adecuados?','1 = No son adecuados','10 = Muy adecuados',2),

('Actividades','¿La biblioteca lleva a cabo actividades de interés para la comunidad en general?','1 = No lleva a cabo actividades','10 = Lleva a cabo actividades diversas',2),
('Colección','¿La biblioteca cuenta con una colección de libros suficiente y acorde a mis intereses y necesidades?','1 = Insuficiente','10 = Suficiente',2),

('Formato de préstamos','¿Existe flexibilidad para el préstamo de los libros?','1 = No hay servicio de préstamo de libros','10 = Flexibilidad en el préstamo',2),
('Fomento a la lectura','¿La biblioteca lleva a cabo acciones que fomentan la lectura entre los miembros de la comunidad?','1 = No lleva a cabo acciones de fomento a la lectura','10=Lleva a cabo diversas acciones de fomento a la lectura',2)
