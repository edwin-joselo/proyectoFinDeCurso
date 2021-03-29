DROP DATABASE IF EXISTS pruebaproyecto;  

CREATE DATABASE pruebaproyecto;

USE pruebaproyecto;

DROP USER IF EXISTS 'admin'; 

CREATE USER 'admin' IDENTIFIED BY 'admin';

GRANT ALL PRIVILEGES ON pruebaproyecto.* TO 'admin';

-- crear las tablas
CREATE TABLE policias(
    num_placa varchar(7) PRIMARY KEY,
    contrasenia varchar(100)
);

-- usuarios
CREATE TABLE usuarios(
    dni varchar(9) PRIMARY KEY,
    nombre varchar(100),
    apellidos varchar(100),
    fecha_nacimiento varchar(100),
    comunidad_autonoma varchar(100),
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
    delito int(100),
    descripcion_policia text,
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



-- agregar policia (contrasenia: admin)
INSERT INTO policias(num_placa, contrasenia) VALUES ('123456A', '$2y$10$gvudwMuxL0LcmyXgfl/5.uVYj3EPXFEKY.cq4LUHiMbLgOQZnThnW');

-- agregar delitos
INSERT INTO delitos(nombre) VALUES ('robo');
INSERT INTO delitos(nombre) VALUES ('hurto');
INSERT INTO delitos(nombre) VALUES ('agresión');

-- agegar usuarios (contrasenia: Hola123)
INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia, comunidad_autonoma) 
VALUES ('24345678X', 'Juan','Martinez', '1993-12-12', 675321594, 'juan@prueba.com', '$2y$10$9pTDOnWUsnWEzNSsIl5/NOc3R18zIB0Fr5gXXURAHEW9icIdKPpd2', 'Cantabria');
INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia, comunidad_autonoma) 
VALUES ('35345612X', 'Francisco','Ole', '1987-05-24', 678454561, 'francisco@prueba.com', '$2y$10$9pTDOnWUsnWEzNSsIl5/NOc3R18zIB0Fr5gXXURAHEW9icIdKPpd2', 'Cataluña');
INSERT INTO usuarios(dni, nombre, apellidos, fecha_nacimiento, telefono, email, contrasenia, comunidad_autonoma) 
VALUES ('25345647X', 'Pedro','Garcia', '1999-01-01', 612345678, 'pedro@prueba.com', '$2y$10$9pTDOnWUsnWEzNSsIl5/NOc3R18zIB0Fr5gXXURAHEW9icIdKPpd2', 'Andalucía');