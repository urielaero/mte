CREATE TABLE supervisores (
  id SERIAL,
  entidad INTEGER,
  zona INTEGER NULL, 
  cct VARCHAR(50) NOT NULL,
  nombrect VARCHAR(200) NULL,
  domicilio VARCHAR(200) NULL,
  colonia VARCHAR(250) NULL,
  localidad VARCHAR(250) NULL,
  municipio VARCHAR(250) NULL,
  codigo_postal VARCHAR(50) NULL,
  nivel INTEGER NULL,
  telefono VARCHAR(50) NULL,
  nombre VARCHAR(200) NULL,
  PRIMARY KEY (id));