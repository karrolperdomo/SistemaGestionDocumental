CREATE DATABASE IF NOT EXISTS doc_management DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE doc_management;


DROP TABLE IF EXISTS persona;
CREATE TABLE persona (
  ID int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(50) DEFAULT NULL,
  apellido varchar(50) DEFAULT NULL,
  usuario varchar(50) NOT NULL,
  correo varchar(120) NOT NULL,
  puesto ENUM('Administrador', 'Gestionador', 'Radicador') NOT NULL,
  password varchar(255) NOT NULL,
  celular bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
