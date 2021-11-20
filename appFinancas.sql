-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Nov-2021 às 22:00
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

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
(6, 'Churrascaria', 'Despesa', 1, 2);

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
(11, 500.00, 'banco do brasil', 'sdsd', 'corrente', 3);

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
(1, 40.30, 'Pão de queijo Novo', 2, '2021-11-23', 3),
(2, 2500.30, 'dsdsd', 1, '2021-11-20', 3),
(3, 1500.00, 'sdsd', 1, '2021-11-20', 3),
(4, 500.00, 'Churrascaria Dom Pedro', 6, '2021-11-20', 2);

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
(4, 1500.00, 'Dividendo Petrobrás', 4, '2021-11-20', 3),
(5, 2000.00, 'Dividendo de IRB3', 4, '2021-11-20', 3),
(6, 3600.00, 'Empresa Teste', 3, '2021-11-11', 3),
(7, 1500.00, 'Empresa  Buslatir', 5, '2021-11-20', 2);

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
