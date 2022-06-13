-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13-Jun-2022 às 11:15
-- Versão do servidor: 5.7.33
-- versão do PHP: 7.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_desafio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_favoritos`
--

DROP TABLE IF EXISTS `tb_favoritos`;
CREATE TABLE IF NOT EXISTS `tb_favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `criado_em` timestamp NULL DEFAULT NULL,
  `alterado_em` timestamp NULL DEFAULT NULL,
  `apagado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_filmes`
--

DROP TABLE IF EXISTS `tb_filmes`;
CREATE TABLE IF NOT EXISTS `tb_filmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmdb_id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `imagem` text NOT NULL,
  `descricao` longtext NOT NULL,
  `classificacao` varchar(4) NOT NULL,
  `status` char(1) NOT NULL,
  `criado_em` timestamp NULL DEFAULT NULL,
  `alterado_em` timestamp NULL DEFAULT NULL,
  `apagado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tmdb_id` (`tmdb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(191) NOT NULL,
  `funcao` char(3) NOT NULL,
  `status` char(1) NOT NULL,
  `criado_em` timestamp NULL DEFAULT NULL,
  `alterado_em` timestamp NULL DEFAULT NULL,
  `apagado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `email`, `senha`, `funcao`, `status`, `criado_em`, `alterado_em`, `apagado_em`) VALUES
(1, 'Desafio JSL', 'desafio@jsl.com.br', '$2y$10$X9AJ6niJNcDpGucCDUTRVeUkuzIkB48ljoIinQa6Tmu37BoK43xmy', 'ADM', 'A', '2022-06-10 18:44:30', NULL, NULL);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
