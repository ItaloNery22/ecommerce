-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Jun-2019 às 23:09
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

DROP TABLE IF EXISTS `tbcliente`;
CREATE TABLE IF NOT EXISTS `tbcliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbitemvenda`
--

DROP TABLE IF EXISTS `tbitemvenda`;
CREATE TABLE IF NOT EXISTS `tbitemvenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvenda` int(11) DEFAULT NULL,
  `idproduto` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

DROP TABLE IF EXISTS `tbproduto`;
CREATE TABLE IF NOT EXISTS `tbproduto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `qtd` double DEFAULT NULL,
  `preco` double DEFAULT NULL,
  `detalhes` varchar(500) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`id`, `nome`, `qtd`, `preco`, `detalhes`, `imagem`) VALUES
(1, 'OCULOS 01', 100, 1, 'DESCRICAO DO OCULOS 01', '14061514011605.jpg'),
(2, 'OCULOS 02', 100, 2, 'DESCRICAO DO OCULOS 02', '14064814012602.png'),
(3, 'OCULOS 03', 100, 3, 'DESCRICAO DO OCULOS 03', '14060814013111.png'),
(4, 'OCULOS 04', 100, 4, 'DESCRICAO DO OCULOS 04', '14063214013706.jpg'),
(5, 'OCULOS 05', 100, 5, 'DESCRICAO DO OCULOS 05', '14064614014103.png'),
(6, 'OCULOS 06', 99, 6, 'DESCRICAO DO OCULOS 06', '14065914014601.png'),
(7, 'OCULOS 07', 100, 7, 'DESCRICAO DO OCULOS 07', '14061214014713.png'),
(8, 'OCULOS 08', 98, 8, 'DESCRICAO DO OCULOS 08', '15065414015804.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo` char(1) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`id`, `nome`, `email`, `senha`, `tipo`, `imagem`) VALUES
(1, 'FABIO MOURA', 'fmsystem@gmail.com', '202cb962ac59075b964b07152d234b70', '1', '201109avatar.jpg'),
(2, 'USUARIO TESTE', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', '2', '140136avatar.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

DROP TABLE IF EXISTS `tbvenda`;
CREATE TABLE IF NOT EXISTS `tbvenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
