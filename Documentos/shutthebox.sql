-- DROP DATABASE shutthebox; 
CREATE DATABASE IF NOT EXISTS shutthebox;

USE shutthebox;

CREATE TABLE IF NOT EXISTS users(
id INT NOT NULL AUTO_INCREMENT,
primeiroNome VARCHAR(100) NOT NULL,
apelido VARCHAR(100) NOT NULL,
username VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
dataNascimento DATE NOT NULL,
estado BOOLEAN NOT NULL,
administrador BOOLEAN NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pontuacaos(
id INT NOT NULL AUTO_INCREMENT,
userID INT NOT NULL,
vitorias INT NOT NULL DEFAULT 0,
derrotas INT NOT NULL DEFAULT 0,
nJogos INT NOT NULL DEFAULT 0,
PRIMARY KEY (id),
FOREIGN KEY (userID) REFERENCES users(id)
)ENGINE=InnoDB;

-- USER: ADMINISTRADOR
/*
INSERT INTO users (primeiroNome, apelido, username, password, email, dataNascimento, estado, administrador)
VALUES ('Admin', 'Admin', 'admin', 'admin', 'admin@shutthebox.com', '1999-01-01', TRUE, TRUE);

INSERT INTO pontuacaos (userID, vitorias, derrotas, nJogos)
VALUES (1, 0, 0, 0);
*/

-- QUERY
/* 
SELECT * 
FROM users
JOIN pontuacaos ON users.id=pontuacaos.userID;
*/

-- DROP TABLE user;
-- DROP TABLE pontuacao;

/************************************************************************************************************************************
-- Código formatado para  meter em: weblogicmvc-shutthebox/database/ --

-- DROP DATABASE shutthebox; 
-- CREATE DATABASE IF NOT EXISTS `shutthebox`;

USE shutthebox;

CREATE TABLE IF NOT EXISTS `users`(
`id` INT NOT NULL AUTO_INCREMENT,
`primeiroNome` VARCHAR(100) NOT NULL,
`apelido` VARCHAR(100) NOT NULL,
`username` VARCHAR(100) UNIQUE NOT NULL,
`password` VARCHAR(100) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`dataNascimento` DATE NOT NULL,
`estado` BOOLEAN NOT NULL,
`administrador` BOOLEAN NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `pontuacaos`(
`userID` INT NOT NULL,
`vitorias` INT NOT NULL DEFAULT '0',
`derrotas` INT NOT NULL DEFAULT '0',
`nJogos` INT NOT NULL DEFAULT '0',
FOREIGN KEY (`userID`) REFERENCES `users`(`id`)
)ENGINE=InnoDB;

-- USER: ADMINISTRADOR
INSERT INTO `users` (`primeiroNome`, `apelido`, `username`, `password`, `email`, `dataNascimento`, `estado`, `administrador`)
VALUES ('Administrador', 'Administrador', 'admin', 'admin', 'admin@shutthebox.com', '1999-01-01', TRUE, TRUE);

INSERT INTO `pontuacaos` (`userID`, `vitorias`, `derrotas`, `nJogos`)
VALUES (1, 0, 0, 0);

-- QUERY
/* 
SELECT * 
FROM users
JOIN pontuacaos ON users.id=pontuacaos.userID;
*/

-- DROP TABLE user;
-- DROP TABLE pontuacao;


