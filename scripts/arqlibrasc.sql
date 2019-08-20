-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Ago-2019 às 06:01
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
  `acessos` int(11) NOT NULL DEFAULT 0,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(100) NOT NULL,
  `ativo` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavras_cadastradas`
--

INSERT INTO `palavras_cadastradas` (`id`, `yt_id`, `palavra`, `descricao`, `exemplo`, `acessos`, `data_criacao`, `img`, `ativo`) VALUES
(1, 'https://www.youtube.com/embed/VgDgWzBL7s4', 'arranha-céu', 'É um prédio alto, continuamente habitável por muitos andares, geralmente projetado para escritórios e uso comercial.', 'Este arranha-céu é muito bonito', 46, '2019-08-20 01:25:43', 'arranha_ceu.png', 'T'),
(2, 'https://www.youtube.com/embed/aAwpeJ9ZDao', 'cúpula', 'Parte interior e côncava de uma abóbada hemisférica ou esferoide.', 'Os romanos usavam cúpulas em suas construções.', 12, '2019-08-20 01:25:43', 'cupula.png', 'T'),
(3, 'https://www.youtube.com/embed/o95fomzhCZo', 'madeira', 'A madeira é um material produzido a partir do tecido formado pelas plantas lenhosas com funções de sustentação mecânica.', 'A madeira é resistente.', 2, '2019-08-20 01:25:43', 'madeira.png', 'T'),
(4, 'https://www.youtube.com/embed/jA9NbU_R-y4', 'zorro', 'Herói nacional teste.', 'A lenda do zorro, grande filme.', 2, '2019-08-09 00:00:00', 'zorro.png', 'F'),
(5, 'https://www.youtube.com/embed/jA9NbU_R-y4', 'Teste', 'teste', 'teste', 0, '2019-08-20 01:25:43', 'zorro.png', 'F'),
(6, 'https://www.youtube.com/embed/111', 'Zzz', '1111', '111', 0, '2019-08-20 01:25:43', '111', 'F'),
(7, 'https://www.youtube.com/embed/R2HrwSQ6EPM', 'Xampp', 'programa utilizado para servidor local', 'usei o xamp', 2, '2019-08-20 01:25:43', 'zorro.png', 'F'),
(8, 'https://www.youtube.com/embed/VgDgWzBL7s4', 'TESTE', 'É um prédio alto, continuamente habitável por muitos andares, geralmente projetado para escritórios e uso comercial.', 'Este arranha-céu é muito bonito', 0, '2019-08-21 01:25:43', 'arranha_ceu.png', 'F');

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavra_favorita_usuario`
--

CREATE TABLE `palavra_favorita_usuario` (
  `id` int(11) NOT NULL,
  `palavra_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavra_favorita_usuario`
--

INSERT INTO `palavra_favorita_usuario` (`id`, `palavra_id`, `usuario_id`) VALUES
(3, 1, 1),
(4, 2, 1);

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
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `admin`, `data_cadastro`, `cpf`, `telefone`, `sexo`, `data_nascimento`, `email`, `login`, `senha`) VALUES
(1, 'T', '2019-08-20 02:06:37', '07538050493', '987474813', 'M', '2000-03-23', 'renatoracunha@gmail.com', 'renatoracunha', 'teste123');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `palavra_favorita_usuario`
--
ALTER TABLE `palavra_favorita_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
