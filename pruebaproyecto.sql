DROP DATABASE IF EXISTS pruebaproyecto;  

CREATE DATABASE pruebaproyecto;

USE pruebaproyecto;

DROP USER IF EXISTS 'admin'; 

CREATE USER 'admin' IDENTIFIED BY 'admin';

GRANT ALL PRIVILEGES ON pruebaproyecto.* TO 'admin';

-- crear las tablas
CREATE TABLE policias(
    num_placa varchar(7) PRIMARY KEY,
    contrasenia varchar(32)
);

-- usuarios

CREATE TABLE usuarios(
    dni varchar(9) PRIMARY KEY,
    nombre varchar(100),
    apellidos varchar(100),
    fecha_nacimiento varchar(100),
    telefono int(9),
    email varchar(100),
    contrasenia varchar(100)
);

CREATE TABLE denuncias_previas(
    cod int(100) PRIMARY KEY AUTO_INCREMENT,
    dni varchar(9),
    descripcion text,
    foto longblob,
    fecha_delito date,
    aprobado varchar(2)
);

CREATE TABLE denuncias(
    cod int(100) PRIMARY KEY,
    fecha date,
    dni_denunciante varchar(9),
    dni_denunciado varchar(9),
    delito int(100),
    num_placa_policia varchar(7)
);

CREATE TABLE delitos(
    cod int(100) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(200)
);


-- agregar claves foráneas
ALTER TABLE denuncias_previas
ADD CONSTRAINT FOREIGN KEY (dni) REFERENCES usuarios(dni);

ALTER TABLE denuncias
ADD CONSTRAINT FOREIGN KEY (dni_denunciante) REFERENCES denuncias_previas(dni),
ADD CONSTRAINT FOREIGN KEY (delito) REFERENCES delitos(cod),
ADD CONSTRAINT FOREIGN KEY (num_placa_policia) REFERENCES policias(num_placa),
ADD CONSTRAINT FOREIGN KEY (cod) REFERENCES denuncias_previas(cod);



-- agregar policia
INSERT INTO policias(num_placa, contrasenia) VALUES ('123456A', 'admin');

INSERT INTO delitos(nombre) VALUES ('robo');
INSERT INTO delitos(nombre) VALUES ('hurto');
INSERT INTO delitos(nombre) VALUES ('agresión');