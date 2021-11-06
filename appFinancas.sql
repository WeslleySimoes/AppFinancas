-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 06-Nov-2021 às 15:08
-- Versão do servidor: 10.3.20-MariaDB-0ubuntu0.19.04.1
-- versão do PHP: 8.1.0RC2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `appFinancas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `tipo` varchar(7) NOT NULL,
  `statusCat` BOOL DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `tipo`, `statusCat`, `idUsuario`) VALUES
(1, 'Ações', 'Receita', 1, 1),
(2, 'Ações2', 'Receita', 1, 1),
(3, 'Mercado', 'Receita', 1, 1),
(4, 'Mercado2', 'Despesa', 1, 3),
(5, 'Shooping', 'Receita', 1, 3),
(6, 'Crocodilo2', 'Receita', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'teste2@teste.com', '123'),
(2, 'Homer', 'homer@teste.com', '123'),
(3, 'weslley', 'weslley@teste.com', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
