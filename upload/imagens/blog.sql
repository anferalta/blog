-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Set-2024 às 13:42
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `cadastrado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria_id`, `titulo`, `texto`, `status`, `cadastrado_em`, `actualizado_em`) VALUES
(20, NULL, 'Oracle  ', 'banco de dados  ', 1, '2024-09-20 13:09:36', NULL),
(21, NULL, 'Dbase Iv', 'banco de dados ', 0, '2024-09-20 13:09:36', NULL),
(22, NULL, 'Python', 'linguagem de programação ', 1, '2024-09-20 13:09:36', NULL),
(23, NULL, 'PHP Moderno', 'PHP', 1, '2024-09-20 13:09:36', NULL),
(24, NULL, 'Java Script', 'Java', 1, '2024-09-20 13:09:36', NULL),
(25, NULL, 'SQL Server Database', 'banco de dados ', 1, '2024-09-20 13:09:36', NULL),
(26, NULL, 'Clipper', 'linguagem de programação ', 1, '2024-09-20 13:09:36', NULL),
(27, NULL, 'Unix', 'comunicações ', 1, '2024-09-20 13:09:36', NULL),
(28, NULL, 'Pascal', 'Linguagem de programação ', 1, '2024-09-20 13:09:36', NULL),
(29, NULL, 'Dbase III', 'Banco de dados ', 1, '2024-09-20 13:09:36', NULL),
(30, NULL, 'teste', 'teste', 0, '2024-09-20 13:09:36', NULL),
(31, NULL, 'teste01', 'teste01', 0, '2024-09-20 13:09:36', NULL),
(32, NULL, 'teste000', 'teste000', 1, '2024-09-20 13:09:36', NULL),
(33, NULL, 'teste leao', 'leao', 0, '2024-09-20 13:09:36', NULL),
(34, NULL, 'teste001', '001', 1, '2024-09-20 13:09:36', NULL),
(35, NULL, 'carnaval de verao', 'carnaval', 0, '2024-09-20 13:09:36', NULL),
(36, NULL, 'teste', 'teste', 1, '2024-09-20 13:09:36', NULL),
(37, NULL, 'teste 00', 'teste 00', 1, '2024-09-20 13:09:36', NULL),
(38, NULL, 'xxx', 'xxx', 0, '2024-09-20 13:09:36', NULL),
(39, NULL, 'bom dos bons', 'bom', 1, '2024-09-20 13:09:36', '2024-09-20 19:20:59'),
(40, NULL, 'fifa 2024', 'videogame', 1, '2024-09-20 13:09:36', NULL),
(41, NULL, 'txtx agora', 'txtxt agora', 0, '2024-09-20 13:09:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `categoria_id`, `titulo`, `texto`, `status`) VALUES
(18, 20, 'titulo do post 2', 'post 2', 1),
(19, 22, 'titulo do post 3', 'post 3', 1),
(20, 24, 'titulo do post 4', 'post 4', 1),
(21, NULL, 'titulo do post 5', 'post 5', 0),
(33, NULL, 'titulo do post 1', 'post 1', 0),
(44, NULL, 'título do post 6', 'titulo 6', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `ultimo_login` datetime DEFAULT NULL,
  `cadastrado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `level`, `nome`, `email`, `senha`, `status`, `ultimo_login`, `cadastrado_em`, `atualizado_em`) VALUES
(6, 3, 'almeida', 'ta@ta.com', '$2y$10$ehCYIswD3S4aVXbYUgwaGefDMoccJqyIwLuaKKmbGISRyhbZ1EbjC', 1, '2024-09-19 17:24:53', '2024-09-15 19:03:13', '2024-09-18 19:03:45'),
(7, 1, 'António ta', 'an@anfer.com', '$2y$10$/Iz7M6P9kI2cQbIvRdC7GuJwpbtPHiiSUaThLtjS/g4b0dE3O6anu', 0, NULL, '2024-09-15 19:05:30', '2024-09-18 19:04:58'),
(10, 3, 'tony P', 'tony@anferalta.com', '$2y$10$kXzOvqdusQ1qA.8tqBFOpuvHtYeWfhklmWrlQeZ3iSE0766qQM7JO', 1, NULL, '2024-09-18 18:14:27', '2024-09-19 17:27:20'),
(11, 3, 'Fernandes ', 'a@a.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, NULL, '2024-09-18 18:25:49', NULL),
(12, 3, 'tia leila', 'teste@teste.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, NULL, '2024-09-18 18:49:13', NULL),
(13, 3, 'TA', 'ta@anferalta.com', '$2y$10$uyNwwG7SMi39apO4xifsAOqn8MonQW3tKbZs6Qe1B9vxW7NmihuMK', 1, NULL, '2024-09-19 17:19:37', '2024-09-19 17:28:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
