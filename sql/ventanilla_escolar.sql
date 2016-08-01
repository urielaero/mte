CREATE TABLE ventanilla_pendientes(
  id SERIAL PRIMARY KEY,
  entidad INTEGER REFERENCES entidades (id),
  email VARCHAR(20) NOT NULL,
  cct VARCHAR(20) NOT NULL,
  timestamp timestamp default current_timestamp);

CREATE TABLE dif_municipios(
  id SERIAL PRIMARY KEY,
  entidad INTEGER REFERENCES entidades (id),
  clave_municipio INTEGER NOT NULL,
  municipio_nombre VARCHAR(50),
  domicilio VARCHAR(100),
  telefono VARCHAR(100),
  horario VARCHAR(50),
  email VARCHAR(50),
  encargado VARCHAR(100)
);

-- COPY dif_municipios(entidad,clave_municipio,municipio_nombre,domicilio,telefono,horario,email,encargado) from '/home/uriel/Desktop/dif_municipiosx.csv' DELIMITER ',' CSV;

--entidad,secretaria,nombre,domicilio,telefono,responsable,cargo,email

CREATE TABLE contraloria_sep(
  id SERIAL PRIMARY KEY,
  entidad INTEGER REFERENCES entidades (id),
  secretaria VARCHAR(100),
  nombre VARCHAR(100),
  domicilio VARCHAR(200),
  telefono VARCHAR(100),
  responsable VARCHAR(100),
  cargo VARCHAR(100),
  email VARCHAR(100)
);

-- COPY contraloria_sep(entidad,secretaria,nombre,domicilio,telefono,responsable,cargo,email) from '/home/uriel/Desktop/contraloria.csv' DELIMITER ',' CSV;

/*

CREATE TABLE ventanilla_calificaciones(
  id SERIAL PRIMARY KEY,
  pregunta VARCHAR(150),
  calificacion INTEGER,
  tipo_denuncia VARCHAR(50),
  email VARCHAR(50),
  cct VARCHAR(50),
  denuncia INTEGER
);
*/

CREATE TABLE ventanilla_denuncias(
  id SERIAL PRIMARY KEY,
  startDate timestamp default current_timestamp,
  tipo VARCHAR(50),
  cct VARCHAR(50) NOT NULL,
  entidad INTEGER REFERENCES entidades (id),
  nivelNombre VARCHAR(50),
  email VARCHAR(50) NOT NULL,
  nombre VARCHAR(50), --userName
  ocupacion VARCHAR(50) -- userOccupation
);

CREATE TABLE ventanilla_respuestas(
   id SERIAL PRIMARY KEY, 
   denuncia INTEGER REFERENCES ventanilla_denuncias (id),
   numero INTEGER,
   timestamp timestamp default current_timestamp,
   respuesta VARCHAR(50)
);

CREATE TABLE ventanilla_calificaciones(
   id SERIAL PRIMARY KEY, 
   denuncia INTEGER REFERENCES ventanilla_denuncias (id),
   timestamp timestamp default current_timestamp,
   pregunta VARCHAR(200),
   uuid VARCHAR(50),
   calificacion INTEGER
);

CREATE TABLE ventanilla_comentarios(
   id SERIAL PRIMARY KEY, 
   denuncia INTEGER REFERENCES ventanilla_denuncias (id),
   timestamp timestamp default current_timestamp,
   comentario VARCHAR(400)
);

CREATE TABLE ventanilla_actualizaciones(
   id SERIAL PRIMARY KEY, 
   timestamp timestamp default current_timestamp,
   tipo VARCHAR(200) NOT NULL,
   entidad INTEGER REFERENCES entidades (id),
   email VARCHAR(200) NOT NULL,
   informacion_para_actualizar VARCHAR(300) NOT NULL,
   information_nueva VARCHAR(300),
   comentario VARCHAR(400)
);
