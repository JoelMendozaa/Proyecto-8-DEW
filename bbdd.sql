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

INSERT INTO usuarios (nombre, apellido, dni, fecha, cp, correo, telefono, movil, tarjeta, iban, contrasena) 
VALUES ('Pepe', 'López Pérez', '12345678X', '2000-09-22', '35500', 'pepe@gmail.com', '928666666', '666999666', '4539955085883327', 'ES7921000813610123456789', 'Pepe1234567890');