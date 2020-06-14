-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Jun-2020 às 22:53
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shutthebox`
--
CREATE DATABASE IF NOT EXISTS shutthebox;
USE shutthebox;
-- --------------------------------------------------------

--
-- Estrutura da tabela `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `resultado` tinyint(1) NOT NULL,
  `dataJogo` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primeiroNome` varchar(100) NOT NULL,
  `apelido` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dataNascimento` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `primeiroNome`, `apelido`, `username`, `password`, `email`, `dataNascimento`, `estado`, `administrador`) VALUES
(1, 'Admin', 'Admin', 'admin', '$2y$10$7F7zok6.LUULwMp0ixIMpeqfSwzGK.eupJ3cj/fhdy5WoESEG02dG', 'admin@admin.com', '1999-01-01', 1, 1),
(2, 'User', 'User', 'user', '$2y$10$Goss0EToU.gD/AQhJt//a.F/gJWZjkm8ws0hbDxynsW0g7f/hGDJe', 'user@user.com', '1999-01-01', 1, 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
