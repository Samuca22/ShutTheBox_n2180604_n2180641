-- DROP DATABASE shutthebox; 
CREATE DATABASE IF NOT EXISTS shutthebox;

USE shutthebox;

CREATE TABLE IF NOT EXISTS `user`(
`id` INT NOT NULL AUTO_INCREMENT,
`primeiroNome` VARCHAR(100) NOT NULL,
`apelido` VARCHAR(100) NOT NULL,
`username` VARCHAR(100) UNIQUE NOT NULL,
`password` VARCHAR(100) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`dataNascimento` DATE NOT NULL,
`estado` BOOLEAN NOT NULL,
`admin` BOOLEAN NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB;

/*
CREATE TABLE IF NOT EXISTS `pontuacao`(
`userID` INT NOT NULL,
`vitorias` INT NOT NULL,
`derrotas` INT NOT NULL,
`nJogos` INT NOT NULL,
FOREIGN KEY (`userID`) REFERENCES `user(id)`
)ENGINE=InnoDB;
*/

-- DROP TABLE user;
-- DROP TABLE pontuacao;
