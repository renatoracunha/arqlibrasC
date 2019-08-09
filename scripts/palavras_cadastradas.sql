-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 09-Ago-2019 às 19:33
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arqlibras_test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavras_cadastradas`
--

DROP TABLE IF EXISTS `palavras_cadastradas`;
CREATE TABLE IF NOT EXISTS `palavras_cadastradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yt_id` varchar(100) NOT NULL,
  `palavra` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `exemplo` text NOT NULL,
  `favorita` varchar(1) NOT NULL DEFAULT 'F',
  `acessos` int(11) NOT NULL DEFAULT '0',
  `data_acesso` date DEFAULT NULL,
  `img` varchar(100) NOT NULL,
  `ativo` varchar(1) NOT NULL DEFAULT 'T',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavras_cadastradas`
--

INSERT INTO `palavras_cadastradas` (`id`, `yt_id`, `palavra`, `descricao`, `exemplo`, `favorita`, `acessos`, `data_acesso`, `img`, `ativo`) VALUES
(1, 'https://www.youtube.com/embed/VgDgWzBL7s4', 'arranha-céu', 'É um prédio alto, continuamente habitável por muitos andares, geralmente projetado para escritórios e uso comercial.', 'Este arranha-céu é muito alto.', 'F', 0, NULL, 'arranha_ceu.png', 'T'),
(2, 'https://www.youtube.com/embed/aAwpeJ9ZDao', 'cúpula', 'Parte interior e côncava de uma abóbada hemisférica ou esferoide.', 'Os romanos usavam cúpulas em suas construções.', 'F', 0, NULL, 'cupula.png', 'T'),
(3, 'https://www.youtube.com/embed/o95fomzhCZo', 'madeira', 'A madeira é um material produzido a partir do tecido formado pelas plantas lenhosas com funções de sustentação mecânica.', 'A madeira é resistente.', 'F', 0, NULL, 'madeira.png', 'T'),
(4, 'https://www.youtube.com/embed/jA9NbU_R-y4', 'zorro', 'Heróis nacional mexicano.', 'A lenda do zorro, grande filme.', 'T', 1, '2019-08-09', 'zorro.png', 'T');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
