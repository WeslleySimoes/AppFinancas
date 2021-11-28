-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 21-Nov-2021 às 01:42
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
-- Banco de dados: `appfinancas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `tipo` varchar(7) NOT NULL,
  `statusCat` tinyint(1) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `tipo`, `statusCat`, `idUsuario`) VALUES
(1, 'Mercado', 'Despesa', 1, 3),
(2, 'Feira', 'Despesa', 1, 3),
(3, 'Salário', 'Receita', 1, 3),
(4, 'Ações', 'Receita', 1, 3),
(5, 'Salário', 'Receita', 1, 2),
(6, 'Churrascaria', 'Despesa', 1, 2),
(7, 'Energia', 'Despesa', 1, 3),
(8, 'Agua', 'Despesa', 1, 3),
(9, 'Internet', 'Despesa', 1, 3),
(10, 'Telefone', 'Despesa', 1, 3),
(11, 'Aluguel', 'Despesa', 1, 3),
(12, 'Transporte', 'Despesa', 1, 3),
(13, 'Lazer', 'Despesa', 1, 3),
(14, 'Salário', 'Receita', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `id` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `instFinanca` varchar(60) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `tipo_conta` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `valor`, `instFinanca`, `descricao`, `tipo_conta`, `id_usuario`) VALUES
(6, 10000.00, 'qwdqwd', 'asdwqd', 'corrente', 2),
(7, 1000.00, 'banco do brasil', 'sdsd', 'corrente', 3),
(10, 30000.00, 'WDW', 'DWDW', 'corrente', 2),
(11, 500.00, 'banco do brasil', 'sdsd', 'corrente', 3),
(12, 12000.00, 'asdasd', 'asd', 'corrente', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa`
--

CREATE TABLE `despesa` (
  `id` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `desp_data` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesa`
--

INSERT INTO `despesa` (`id`, `valor`, `descricao`, `id_categoria`, `desp_data`, `id_usuario`) VALUES
(4, 500.00, 'Churrascaria Dom Pedro', 6, '2021-11-20', 2),
(5, 150.00, 'sdsd', 1, '2021-11-20', 3),
(6, 300.00, 'dsd', 2, '2021-11-20', 3),
(7, 300.00, 'sdsd', 7, '2021-11-20', 3),
(8, 80.00, 'dssd', 8, '2021-11-20', 3),
(9, 80.00, 'dssd', 8, '2021-11-20', 3),
(10, 150.00, 'sdsd', 9, '2021-11-20', 3),
(11, 600.00, 'dfdfdf', 2, '2021-11-20', 3),
(12, 362.00, 'sdsd', 12, '2021-11-20', 3),
(13, 1500.00, 'sdsd', 11, '2021-11-20', 3),
(14, 785.00, 'dsdsd', 13, '2021-11-20', 3),
(15, 656.00, 'dsdsd', 2, '2021-10-20', 3),
(16, 21.00, 'wdwd', 6, '2021-07-05', 3),
(17, 2541.00, 'dsdwd', 1, '2021-01-20', 3),
(18, 6000.00, 'sdsd', 1, '2021-02-20', 3),
(19, 7520.00, 'sadad', 1, '2021-03-20', 3),
(20, 3753.00, 'dwdwd', 1, '2021-04-20', 3),
(21, 9000.00, 'dwdwd', 1, '2021-05-20', 3),
(22, 2566.00, 'dwdwd', 1, '2021-06-20', 3),
(23, 1213.00, 'dwdwd', 1, '2021-07-20', 3),
(24, 3587.00, 'dwdwd', 1, '2021-08-20', 3),
(25, 4785.00, 'dwdwd', 1, '2021-09-20', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `desp_data` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `valor`, `descricao`, `id_categoria`, `desp_data`, `id_usuario`) VALUES
(1, 5600.00, 'dwdwd', 3, '2021-01-22', 3),
(2, 3000.00, 'dwdwd', 4, '2021-02-23', 3),
(3, 2325.00, 'wdwdwd', 3, '2021-02-10', 3),
(4, 8022.00, 'wwdwd', 4, '2021-04-20', 3),
(5, 6587.00, 'dwdwd', 3, '2021-03-20', 3),
(7, 5236.00, 'dsdwd', 3, '2021-05-20', 3),
(8, 3254.00, 'dwdwd', 3, '2021-06-20', 3),
(9, 2789.00, 'sdwd', 3, '2021-07-20', 3),
(10, 8741.00, 'qdwd', 3, '2021-08-20', 3),
(11, 7412.00, 'dwdwd', 3, '2021-09-20', 3),
(12, 4785.00, 'dawdw', 3, '2021-10-20', 3),
(13, 5000.00, 'dwdwd', 3, '2021-11-20', 3),
(14, 652.00, 'Dividendo', 4, '2021-11-20', 3),
(15, 1500.00, 'Empresa Simas Turbo', 14, '2021-11-21', 1);

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
(3, 'weslley', 'weslley@teste.com', '123'),
(4, 'f', 'ffgf@rer.com', 'fg');

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
-- Índices para tabela `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `despesa`
--
ALTER TABLE `despesa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `conta`
--
ALTER TABLE `conta`
  ADD CONSTRAINT `conta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `despesa`
--
ALTER TABLE `despesa`
  ADD CONSTRAINT `despesa_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `despesa_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
