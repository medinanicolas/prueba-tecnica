/**
*  Se crea un usuario para administrar la base de datos
*/
DROP USER IF EXISTS 'admin'@'localhost';
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'p4ssw0rd';

/**
* Se crea la base de datos para el usuario
*/
DROP DATABASE IF EXISTS gestion_bodegas;
CREATE DATABASE gestion_bodegas;

/**
* Se le asigan todos los permisos al usuario 'admin' en la base de datos 'gestion_bodegas'
*/

GRANT ALL PRIVILEGES ON gestion_bodegas.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
