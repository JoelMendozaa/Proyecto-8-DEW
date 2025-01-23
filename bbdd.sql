CREATE DATABASE formulario;
USE formulario;

CREATE TABLE usuarios (
    dni CHAR(9) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(100),
    fecha DATE,
    cp CHAR(5),
    correo VARCHAR(100),
    telefono CHAR(9),
    movil CHAR(9),
    tarjeta CHAR(16),
    iban CHAR(34),
    contrasena VARCHAR(50)
);
