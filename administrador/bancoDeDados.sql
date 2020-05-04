CREATE DATABASE `MRT`;

USE `MRT`;

CREATE TABLE `Album` (
    `codigo` INT PRIMARY KEY AUTO_INCREMENT,
    `titulo` VARCHAR(255) NOT NULL,
    `capa` TEXT NOT NULL
);

CREATE TABLE `Fotos` (
	`codigo_foto` INT PRIMARY KEY AUTO_INCREMENT,
    `link` TEXT NOT NULL,
    `album` INT NOT NULL,
    FOREIGN KEY (`album`) 
                REFERENCES `Album`(`codigo`)
                ON DELETE CASCADE
);

CREATE TABLE `Clipes` (
	`codigo` INT PRIMARY KEY AUTO_INCREMENT,
    `titulo` VARCHAR(255) NOT NULL,
    `link` TEXT NOT NULL
);w

CREATE TABLE `Parceiros` (
    `codigo` INT PRIMARY KEY AUTO_INCREMENT,
    `foto` TEXT NOT NULL,
    `nome` VARCHAR(255),
    `profissao` VARCHAR(255),
    `titulo_link` VARCHAR(255),
    `link` VARCHAR(255)
);

CREATE TABLE `Administrador`(
    `usuario` VARCHAR(255) PRIMARY KEY,
    `senha` VARCHAR(128) NOT NULL
);


INSERT INTO `Administrador`
VALUES ('martina',
        'a4be93d5b2c8de29e9f96edfe9e3c28aa838e2d4b257dee9465794312dec803098d42e1c046301552a57eab5fc72351999ec26004948ecd95d402be8570920b8');