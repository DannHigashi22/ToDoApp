CREATE DATABASE Dbtodo;
use Ddtodo;
CREATE TABLE usuarios(
id        int(255) AUTO_INCREMENT NOT NULL,
nombre    VARCHAR(255) not NULL,
apellidos VARCHAR(255) NOT NULL,
email     VARCHAR(255) NOT NULL,
pass      VARCHAR(255) NOT NULL,
image     VARCHAR(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;
CREATE TABLE notas(
id int(255) AUTO_INCREMENT NOT NULL,
usuario_id INT(255) NOT NULL,
titulo VARCHAR(100) NOT NULL,
descripcion VARCHAR(255) ,
estado VARCHAR(10) NOT NULL,
fecha DATE NOT NULL,
hora DATETIME NOT NULL,
CONSTRAINT pk_notas PRIMARY KEY(id),
CONSTRAINT fk_notas_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;