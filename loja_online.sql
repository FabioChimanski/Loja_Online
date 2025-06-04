-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Mar-2025 às 15:02
-- Versão do servidor: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja_online`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pendente',
  `data_pedido` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `total`, `status`, `data_pedido`) VALUES
(1, 1, '17.00', 'Finalizado', '2025-03-17 16:07:05'),
(2, 1, '2.00', 'Finalizado', '2025-03-17 16:07:05'),
(3, 1, '2.00', 'Finalizado', '2025-03-17 16:07:05'),
(4, 1, '10.00', 'Finalizado', '2025-03-17 16:14:41'),
(5, 1, '7.50', 'Pendente', '2025-03-18 19:56:21'),
(6, 1, '2.00', 'Pendente', '2025-03-19 08:19:37'),
(7, 1, '22.00', 'Pendente', '2025-03-20 09:13:38'),
(8, 1, '2.00', 'Pendente', '2025-03-20 10:44:50'),
(9, 1, '2.00', 'Pendente', '2025-03-20 10:49:16'),
(10, 1, '2.00', 'Pendente', '2025-03-20 10:50:56'),
(11, 1, '2.00', 'Pendente', '2025-03-20 10:51:24'),
(12, 1, '2.00', 'Pendente', '2025-03-20 10:52:38'),
(13, 1, '10.00', 'Pendente', '2025-03-20 10:53:23'),
(14, 1, '5.00', 'Pendente', '2025-03-20 10:54:42'),
(15, 1, '5.00', 'Pendente', '2025-03-20 10:55:29'),
(16, 1, '5.00', 'Pendente', '2025-03-20 10:55:48'),
(17, 1, '5.00', 'Pendente', '2025-03-20 10:57:08'),
(18, 1, '5.00', 'Pendente', '2025-03-20 10:58:06'),
(19, 1, '5.00', 'Pendente', '2025-03-20 10:59:16'),
(20, 1, '59.99', 'Pendente', '2025-03-21 10:49:32'),
(21, 1, '59.99', 'Pendente', '2025-03-21 10:57:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto_id`, `quantidade`) VALUES
(1, 5, 9, 1),
(2, 5, 2, 3),
(3, 6, 2, 1),
(4, 7, 2, 6),
(5, 7, 8, 1),
(6, 8, 2, 1),
(7, 9, 2, 1),
(8, 10, 2, 1),
(9, 11, 2, 1),
(10, 12, 2, 1),
(11, 13, 8, 1),
(12, 14, 7, 1),
(13, 15, 7, 1),
(14, 16, 7, 1),
(15, 17, 7, 1),
(16, 18, 7, 1),
(17, 19, 7, 1),
(18, 20, 14, 1),
(19, 21, 13, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(14, 'Camisa Hang Loose', 'cinza', '59.99', '3.webp'),
(15, 'Camisa Hang Loose', 'azul', '59.99', '6.webp'),
(13, 'Camisa Hang Loose', 'Branca', '59.99', '2.webp'),
(12, 'Camisa Hang Loose', 'Preta ', '59.99', '1.webp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('cliente','admin') NOT NULL DEFAULT 'cliente'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'Fabio', 'fabio@chime.com', '$2y$10$IVlQhPTj74dt3Oc6otKSVuhClmT36FqEWJcMZzFAzuwzS3pCtrLFy', 'cliente'),
(3, 'Adminstrador', 'admin@chime.com', '$2y$10$7.icfewxyZMwC9Tt3trSbuDunDjPrNayI82g6gsTimTXCV0HkvpeC', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`cliente_id`);

--
-- Indexes for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
