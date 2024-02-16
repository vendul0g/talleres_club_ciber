create user 'test'@'localhost' identified by 'contracontratest';
grant all privileges on shop.* to 'test'@'localhost';

CREATE DATABASE IF NOT EXISTS shop;

-- Cambiar a la base de datos 'shop'
USE shop;

-- Crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255),
    contrasena VARCHAR(255)
);


INSERT INTO usuarios (nombre, email, contrasena) VALUES
    ('pedro', 'pedro@email.com', 'c378985d629e99a4e86213db0cd5e70d'),
    ('maria', 'maria@email.com', 'aae039d6aa239cfc121357a825210fa3'),
    ('raquel01', 'usuario8@email.com', 'ee2c9ea30c3886d4b5a1aa07ca02fa79'),
    ('SrMario', 'usuario9@email.com', '84d961568a65073a3bcf0eb216b2a576'),
    ('admin', 'admin@email.com', 'f74a10e1d6b2f32a47b8bcb53dac5345');

QUIT
