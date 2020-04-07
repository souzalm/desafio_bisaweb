-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Abr-2020 às 21:32
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio_bisaweb2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta_bancaria`
--

CREATE TABLE `conta_bancaria` (
  `id_conta` int(11) UNSIGNED NOT NULL,
  `descricao_conta` varchar(45) NOT NULL,
  `saldo_inicial` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao_financeira`
--

CREATE TABLE `movimentacao_financeira` (
  `id_movimentacao` int(8) UNSIGNED NOT NULL,
  `descricao_movimentacao` varchar(45) NOT NULL,
  `tipo_movimentacao` enum('Receita','Despesa') NOT NULL,
  `data_movimentacao` date NOT NULL,
  `valor` decimal(10,2) UNSIGNED NOT NULL,
  `conta_bancaria` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `conta_bancaria`
--
ALTER TABLE `conta_bancaria`
  ADD PRIMARY KEY (`id_conta`);

--
-- Índices para tabela `movimentacao_financeira`
--
ALTER TABLE `movimentacao_financeira`
  ADD PRIMARY KEY (`id_movimentacao`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conta_bancaria`
--
ALTER TABLE `conta_bancaria`
  MODIFY `id_conta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `movimentacao_financeira`
--
ALTER TABLE `movimentacao_financeira`
  MODIFY `id_movimentacao` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
