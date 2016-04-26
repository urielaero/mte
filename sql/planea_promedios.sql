CREATE TABLE planea_promedios (
  id SERIAL,
  entidad INTEGER NOT NULL, -- para filtrar
  clave_nivel INTEGER NOT NULL, -- coincide con clave_nivel de planea_escuelas
  materia VARCHAR(20) NOT NULL,
  nivel1 REAL NULL, -- niv_1
  nivel2 REAL NULL, -- niv_2
  nivel3 REAL NULL, -- niv_3
  nivel4 REAL NULL, -- niv_4
  anio INTEGER NOT NULL,
  PRIMARY KEY (id));
