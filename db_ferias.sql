-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.24-log
-- Versão do PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `db_ferias`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cidade`
--

CREATE TABLE IF NOT EXISTS `tab_cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cidade` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_colaborador`
--

CREATE TABLE IF NOT EXISTS `tab_colaborador` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `num_drt` int(11) NOT NULL,
  `nome_colaborador` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num_id_cidade` int(11) NOT NULL,
  `num_id_posto` int(11) NOT NULL,
  `dt_admissao` date NOT NULL,
  `dt_ultferias_inicio` date DEFAULT NULL,
  `dt_ultferias_fim` date DEFAULT NULL,
  `funcao` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_colaborador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=513 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_ferias`
--

CREATE TABLE IF NOT EXISTS `tab_ferias` (
  `id_ferias` int(11) NOT NULL AUTO_INCREMENT,
  `num_id_colaborador` int(11) NOT NULL,
  `num_dias` int(11) NOT NULL,
  `dt_inicio_ferias` date NOT NULL,
  `dt_fim_ferias` date NOT NULL,
  PRIMARY KEY (`id_ferias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=214 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_posto`
--

CREATE TABLE IF NOT EXISTS `tab_posto` (
  `id_posto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_posto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_posto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
