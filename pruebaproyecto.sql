CREATE DATABASE pruebaproyecto;

USE pruebaproyecto;

-- crear las tablas
CREATE TABLE policias(
    usuario varchar(100) PRIMARY KEY,
    contrasenia varchar(32)
);


-- usuarios
CREATE TABLE personas(
    dni varchar(9) PRIMARY KEY,
    nombre varchar(100),
    apellidos varchar(100),
    fecha_nacimiento varchar(100),
    telefono int(9),
    email varchar(100),
    contrasenia varchar(100),
    foto varchar(100)
);

CREATE TABLE denuncias(
    cod int(100) PRIMARY KEY AUTO_INCREMENT,
    fecha date,
    aprobado varchar(2),
    dni_denunciante varchar(9),
    dni_denunciado varchar(9),
    delito varchar(6)
);

CREATE TABLE delitos(
    cod varchar(6) PRIMARY KEY,
    nombre varchar(200)
);


-- agregar claves foráneas
ALTER TABLE denuncias
ADD CONSTRAINT FOREIGN KEY (dni_denunciante) REFERENCES personas(dni),
ADD CONSTRAINT FOREIGN KEY (dni_denunciado) REFERENCES personas(dni),
ADD CONSTRAINT FOREIGN KEY (delito) REFERENCES delitos(cod);

