-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 25-Nov-2024 às 11:21
-- Versão do servidor: 5.7.25
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controlegastos`
--
CREATE DATABASE IF NOT EXISTS `controlegastos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `controlegastos`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_usuario`
--

CREATE TABLE `cadastro_usuario` (
  `cpf_usuario` char(14) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `telefone_usuario` varchar(15) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro_usuario`
--

INSERT INTO `cadastro_usuario` (`cpf_usuario`, `nome_usuario`, `telefone_usuario`, `email_usuario`, `senha_usuario`, `foto_perfil`) VALUES
('00000', 'Rafa', '99777', 'rafafafa', '1234', NULL),
('000000', 'Ana', '99999999', 'ana@gmail.com', '123456', NULL),
('01961176661', 'Ana Clara', '99999', 'anaclara@gmail.com', '12345', NULL),
('01961176662', 'Clara', '9090', 'ana@gmail.com', '123', NULL),
('01961176673', 'Lauany fidelis', '99999', 'ana@gmail.com', '157', NULL),
('01961176674', 'Lauany fidelis', '99999', 'ana@gmail.com', '157', NULL),
('01961176675', 'Lauany fidelis', '99999', 'ana@gmail.com', '157', NULL),
('111111', 'lav', '9987', 'lavinia', '0305', NULL),
('12345', 'lllll', '8888', 'llll', '0405', NULL),
('123456', 'Clara', '9999999', 'clara@gmail.com', '123', NULL),
('1234567', 'Lavinia andrade', '1234567', 'laviniaaaa', '1234', NULL),
('12345678910', 'Berenice', '999999999', 'bere@gmail.com', '123456789', NULL),
('22222', 'lav', '9987', 'lavinia', '0304', NULL),
('454545', 'lalla', '9999', 'sssss', '123', 'perfil.png'),
('555555', 'Rafa', '99777', 'rafafafa', '1234', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_usuario`
--

CREATE TABLE `entrada_usuario` (
  `id_entrada` int(11) NOT NULL,
  `valor_entrada` float(6,2) NOT NULL,
  `data_entrada` varchar(12) NOT NULL,
  `descricao_entrada` varchar(255) NOT NULL,
  `tipo_entrada` enum('PIX','CRÉDITO','DÉBITO','BOLETO','TRANSFERÊNCIA','DINHEIRO') NOT NULL,
  `cpf_usuario` char(14) DEFAULT NULL,
  `setor_entrada` enum('TRABALHO FIXO','FREELANCER','EXTRA','PRESENTE','AUXILIO','OUTRO:') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastos_usuario`
--

CREATE TABLE `gastos_usuario` (
  `id_gasto` int(11) NOT NULL,
  `valor_gasto` float(6,2) NOT NULL,
  `data_gasto` varchar(12) NOT NULL,
  `descricao_gasto` varchar(255) NOT NULL,
  `tipo_gasto` enum('PIX','CRÉDITO','DÉBITO','BOLETO','TRANSFERÊNCIA','DINHEIRO') NOT NULL,
  `cpf_usuario` char(14) DEFAULT NULL,
  `setor_gasto` enum('ALIMENTAÇÃO','VESTIMENTAS','CONTAS RESIDENCIAIS','MANUNTENÇÃO','SAÚDE','EDUCAÇÃO','OUTRO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro_usuario`
--
ALTER TABLE `cadastro_usuario`
  ADD PRIMARY KEY (`cpf_usuario`);

--
-- Indexes for table `entrada_usuario`
--
ALTER TABLE `entrada_usuario`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `cpf_usuario` (`cpf_usuario`);

--
-- Indexes for table `gastos_usuario`
--
ALTER TABLE `gastos_usuario`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `cpf_usuario` (`cpf_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entrada_usuario`
--
ALTER TABLE `entrada_usuario`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gastos_usuario`
--
ALTER TABLE `gastos_usuario`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entrada_usuario`
--
ALTER TABLE `entrada_usuario`
  ADD CONSTRAINT `entrada_usuario_ibfk_1` FOREIGN KEY (`cpf_usuario`) REFERENCES `cadastro_usuario` (`cpf_usuario`);

--
-- Limitadores para a tabela `gastos_usuario`
--
ALTER TABLE `gastos_usuario`
  ADD CONSTRAINT `gastos_usuario_ibfk_1` FOREIGN KEY (`cpf_usuario`) REFERENCES `cadastro_usuario` (`cpf_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
