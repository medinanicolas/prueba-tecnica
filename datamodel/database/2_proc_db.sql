/**
* Se crean las tablas y datos necesarios para el sistema base
*
* Creadas en ubuntu con usuario admin@localhost de mysql
*
* mysql -u admin -D gestion_bodegas -p < 2_crea_tablas.sql
*
* Password: p4ssw0rd
*
* Codificación utf8 y un inicio de las ID en 100
* Nombres únicos en cada tabla donde sea necesario
*/
CREATE TABLE IF NOT EXISTS bodega(
	id_bodega INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_bodega VARCHAR(60) NOT NULL,
	direccion_bodega VARCHAR(100) NOT NULL,
	PRIMARY KEY(id_bodega),
	UNIQUE(nombre_bodega)
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS marca(
	id_marca INT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
	nombre_marca VARCHAR(60) NOT NULL,
	PRIMARY KEY(id_marca),
	UNIQUE(nombre_marca)
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS categoria(
	id_categoria INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_categoria VARCHAR(60) NOT NULL,
	PRIMARY KEY(id_categoria),
	UNIQUE(nombre_categoria)
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS producto(
	id_producto INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_producto VARCHAR(60) NOT NULL,
	precio_producto INT(9) UNSIGNED NOT NULL,
	descripcion_producto VARCHAR(200) NOT NULL,
	stock_producto INT(9) UNSIGNED NOT NULL,
	id_marca INT(5) UNSIGNED NOT NULL,
	id_categoria INT(5) UNSIGNED NOT NULL,
	id_bodega INT(5) UNSIGNED NOT NULL,
	PRIMARY KEY(id_producto),
	FOREIGN KEY(id_marca) REFERENCES marca(id_marca),
	FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria),
	FOREIGN KEY(id_bodega) REFERENCES bodega(id_bodega) ON DELETE CASCADE
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS tipo_usuario(
	id_tipo_usuario INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_tipo_usuario VARCHAR(15) NOT NULL,
	PRIMARY KEY(id_tipo_usuario),
	UNIQUE(nombre_tipo_usuario)
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS usuarios(
	rut_usuario VARCHAR(8) NOT NULL,
	dv_usuario CHAR NOT NULL,
	alias_usuario VARCHAR(25) NOT NULL,
	password_usuario VARCHAR(32) NOT NULL,
	nombre_usuario VARCHAR(25) NOT NULL,
	p_apellido_usuario VARCHAR(25) NOT NULL,
	s_apellido_usuario VARCHAR(25),
	id_tipo_usuario INT(5) UNSIGNED NOT NULL,
	PRIMARY KEY(rut_usuario),
	UNIQUE(alias_usuario),
	FOREIGN KEY(id_tipo_usuario) REFERENCES tipo_usuario(id_tipo_usuario)
)CHARSET=utf8, AUTO_INCREMENT=100;
CREATE TABLE IF NOT EXISTS registro_stock(
	id_registro INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	id_producto INT(5) UNSIGNED NOT NULL,
	stock_antes INT(9) UNSIGNED NOT NULL,
	stock_entrante INT(9) UNSIGNED NOT NULL,
	stock_despues INT(9) UNSIGNED NOT NULL,
	fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_registro),
	FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
)CHARSET=utf8, AUTO_INCREMENT = 100;
CREATE TABLE IF NOT EXISTS registro_entrega(
	id_registro INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	id_producto INT(5) UNSIGNED NOT NULL,
	stock_antes INT(9) UNSIGNED NOT NULL,
	stock_saliente INT(9) UNSIGNED NOT NULL,
	stock_despues INT(9) UNSIGNED NOT NULL,
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_registro),
	FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
)CHARSET=utf8, AUTO_INCREMENT = 100;

/**
* Estas lineas de código rellenan las tablas para poder loguearse
* Si se ejecutan más de una vez puede dar error
*/
DELETE IGNORE FROM tipo_usuario;
DELETE IGNORE FROM usuarios;
INSERT INTO tipo_usuario VALUES(null, 'Administrador');
INSERT INTO usuarios VALUES('11111111', '1', 'admin', md5('password'), 'Admin', 'Admin', null, (SELECT id_tipo_usuario FROM tipo_usuario WHERE nombre_tipo_usuario LIKE 'Administrador'));

