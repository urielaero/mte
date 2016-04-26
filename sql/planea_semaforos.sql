CREATE TABLE planea_semaforos (
  id SERIAL,
  nombre VARCHAR(200) NOT NULL,
  clave INTEGER NOT NULL,
  cct_count BIGINT NULL,
  PRIMARY KEY (id));
