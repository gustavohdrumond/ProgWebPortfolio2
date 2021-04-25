-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Nov-2020 às 00:55
-- Versão do servidor: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swlivraria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo`
--

DROP TABLE IF EXISTS `acervo`;
CREATE TABLE IF NOT EXISTS `acervo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_editora` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `ano` int(11) NOT NULL,
  `preco` double(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acervo`
--

INSERT INTO `acervo` (`id`, `id_editora`, `titulo`, `autor`, `ano`, `preco`, `quantidade`, `tipo`) VALUES
(1, 1, 'Teste Teste', 'Gustavo', 2020, 20.50, 1, 1),
(3, 1, 'Julio One Piece', 'Julio C Cleto', 2008, 12.50, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

DROP TABLE IF EXISTS `editora`;
CREATE TABLE IF NOT EXISTS `editora` (
  `id_editora` int(11) NOT NULL AUTO_INCREMENT,
  `nome_editora` varchar(60) NOT NULL,
  PRIMARY KEY (`id_editora`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`id_editora`, `nome_editora`) VALUES
(1, 'teste 1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
