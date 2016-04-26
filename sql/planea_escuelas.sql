CREATE TABLE planea_escuelas (
  id SERIAL,
  cct VARCHAR(20) NOT NULL,
  entidad INTEGER NOT NULL, -- filtrado por la entidad de la escuela
  clave_turno INTEGER NOT NULL,
  clave_nivel INTEGER NOT NULL, --es el que coincide en promedios
  evaluados INTEGER NOT NULL,
  porcentaje_nivel1_espaniol REAL NULL, -- niv1_esp
  porcentaje_nivel2_espaniol REAL NULL, -- niv2_esp
  porcentaje_nivel3_espaniol REAL NULL, -- niv3_esp
  porcentaje_nivel4_espaniol REAL NULL, -- niv4_esp
  porcentaje_nivel1_matematicas REAL NULL, -- niv1_mat
  porcentaje_nivel2_matematicas REAL NULL, -- niv2_mat
  porcentaje_nivel3_matematicas REAL NULL, -- niv3_mat
  porcentaje_nivel4_matematicas REAL NULL, -- niv4_mat
  score_global REAL NULL,
  percentil REAL NULL,
  rank_prep INTEGER NULL,
  rank_entidad INTEGER NULL,
  clave_semaforo INTEGER NOT NULL,--clave_nivel=>semaforo --ultimo
  anio INTEGER NOT NULL,
  PRIMARY KEY (id));
