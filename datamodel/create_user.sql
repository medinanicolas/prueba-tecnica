/**
*  Se crea un usuario para administrar la base de datos
*
* Creado en ubuntu con usuario root
*
* sudo mysql -u root < create_user.sql
*/
DROP USER IF EXISTS 'admin'@'localhost';
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'p4ssw0rd';

/**
* Se le asigan todos los permisos al usuario 'admin' en la base de datos 'gestion_bodegas'
*/

GRANT ALL PRIVILEGES ON gestion_bodegas.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
