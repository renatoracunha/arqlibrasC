-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Ago-2019 às 03:33
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `arqlibrasc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavras_cadastradas`
--

CREATE TABLE `palavras_cadastradas` (
  `id` int(11) NOT NULL,
  `yt_id` varchar(100) NOT NULL,
  `palavra` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `exemplo` text NOT NULL,
  `favorita` varchar(1) NOT NULL DEFAULT 'F',
  `acessos` int(11) NOT NULL DEFAULT 0,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(100) NOT NULL,
  `ativo` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavras_cadastradas`
--

INSERT INTO `palavras_cadastradas` (`id`, `yt_id`, `palavra`, `descricao`, `exemplo`, `favorita`, `acessos`, `data_criacao`, `img`, `ativo`) VALUES
(1, 'https://www.youtube.com/embed/VgDgWzBL7s4', 'arranha-céu', 'É um prédio alto, continuamente habitável por muitos andares, geralmente projetado para escritórios e uso comercial.', 'Este arranha-céu é muito bonito', 'T', 28, '2019-08-20 01:25:43', 'arranha_ceu.png', 'T'),
(2, 'https://www.youtube.com/embed/aAwpeJ9ZDao', 'cúpula', 'Parte interior e côncava de uma abóbada hemisférica ou esferoide.', 'Os romanos usavam cúpulas em suas construções.', 'T', 10, '2019-08-20 01:25:43', 'cupula.png', 'T'),
(3, 'https://www.youtube.com/embed/o95fomzhCZo', 'madeira', 'A madeira é um material produzido a partir do tecido formado pelas plantas lenhosas com funções de sustentação mecânica.', 'A madeira é resistente.', 'F', 2, '2019-08-20 01:25:43', 'madeira.png', 'T'),
(4, 'https://www.youtube.com/embed/jA9NbU_R-y4', 'zorro', 'Herói nacional teste.', 'A lenda do zorro, grande filme.', 'T', 2, '2019-08-09 00:00:00', 'zorro.png', 'F'),
(5, 'https://www.youtube.com/embed/jA9NbU_R-y4', 'Teste', 'teste', 'teste', 'F', 0, '2019-08-20 01:25:43', 'zorro.png', 'F'),
(6, 'https://www.youtube.com/embed/111', 'Zzz', '1111', '111', 'F', 0, '2019-08-20 01:25:43', '111', 'F'),
(7, 'https://www.youtube.com/embed/R2HrwSQ6EPM', 'Xampp', 'programa utilizado para servidor local', 'usei o xamp', 'T', 1, '2019-08-20 01:25:43', 'zorro.png', 'F');

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavra_favorita_usuario`
--

CREATE TABLE `palavra_favorita_usuario` (
  `id` int(11) NOT NULL,
  `palavra_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `admin` varchar(1) NOT NULL DEFAULT 'F',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `palavras_cadastradas`
--
ALTER TABLE `palavras_cadastradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `palavra_favorita_usuario`
--
ALTER TABLE `palavra_favorita_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `palavras_cadastradas`
--
ALTER TABLE `palavras_cadastradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `palavra_favorita_usuario`
--
ALTER TABLE `palavra_favorita_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
