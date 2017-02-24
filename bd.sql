CREATE DATABASE gigena
    DEFAULT CHARACTER SET utf8;

USE gigena;

CREATE TABLE equipo(
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  nombre VARCHAR(100),
  titulo VARCHAR(100),
  contenido VARCHAR(1000),
  img_perfil VARCHAR(300)
);
CREATE TABLE usuarios (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombre VARCHAR(25) NOT NULL ,
  apellido VARCHAR(25) NOT NULL ,
	email VARCHAR(255) NOT NULL UNIQUE,
	passw VARCHAR(255) NOT NULL,
  prefijo VARCHAR(25),
  especialidad VARCHAR(120),
  titulos VARCHAR(2000),
  img_perfil VARCHAR(300),
  privilegio INT NOT NULL ,
	fecha_creacion DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id),
    FOREIGN KEY(privilegio)
            REFERENCES privilegios(id_priv)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);
CREATE TABLE privilegios(

    id_priv INT NOT NULL UNIQUE AUTO_INCREMENT,
    privilegio VARCHAR(20)
);
INSERT INTO `privilegios` (`id_priv`, `privilegio`) VALUES
(5, 'Cliente'),
(13, 'Administrador'),
(11, 'Editor');


CREATE TABLE articulos (
        id_articulo INT NOT NULL UNIQUE AUTO_INCREMENT,
        autor_id INT NOT NULL,
        id_categoria INT NOT NULL,
        url VARCHAR(255) NOT NULL UNIQUE,
        titulo VARCHAR(255) NOT NULL UNIQUE,
        texto TEXT CHARACTER SET utf8 NOT NULL,
        fecha_creacion DATETIME NOT NULL,
        fecha_modificacion DATETIME NOT NULL,
        url_img_principal VARCHAR(255) NOT NULL ,
        galeria VARCHAR(255),
        visitas INT(10) NOT NULL,
        activa TINYINT NOT NULL,
        especial TINYINT NOT NULL,
        PRIMARY KEY(id_articulo),
        FOREIGN KEY(autor_id) REFERENCES usuarios(id)
         ON UPDATE CASCADE ON DELETE RESTRICT,
         FOREIGN KEY(id_categoria) REFERENCES categorias(id_categoria)
         ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE categorias (
        id_categoria INT NOT NULL UNIQUE AUTO_INCREMENT,
        categoria VARCHAR(100) NOT NULL,
        PRIMARY KEY(id_categoria)

);
INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(0, 'Noticias'),
(1, 'Nosotros'),
(2, 'Programa');
