-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/08/2026 às 01:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbgrime2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nm_categoria` varchar(50) NOT NULL,
  `ds_badge` varchar(50) NOT NULL,
  `st_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nm_categoria`, `ds_badge`, `st_categoria`) VALUES
(1, 'Calças', 'new-drop', 'ativo'),
(2, 'Calçados', 'destaque', 'ativo'),
(3, 'Camisas', 'essentials', 'ativo'),
(4, 'Acessórios', 'hot', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `id_cidade` bigint(20) UNSIGNED NOT NULL,
  `nm_cidadebigint` varchar(60) NOT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `nm_cidadebigint`, `id_estado`) VALUES
(1, 'Campo Mourão', 1),
(2, 'Curitiba', 1),
(3, 'São Paulo', 2),
(4, 'Florianópolis', 3),
(5, 'Porto Alegre', 4),
(6, 'Londrina', 1),
(7, 'Maringá', 1),
(8, 'Campinas', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `documento`
--

CREATE TABLE `documento` (
  `id_documento` bigint(20) UNSIGNED NOT NULL,
  `id_pessoa` int(10) UNSIGNED NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `nr_documento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `documento`
--

INSERT INTO `documento` (`id_documento`, `id_pessoa`, `id_tipo`, `nr_documento`) VALUES
(1, 1, 1, '12345678901'),
(2, 2, 1, '98765432100'),
(3, 3, 1, '45678912345'),
(4, 4, 1, '11122233344'),
(5, 5, 1, '55566677788'),
(6, 6, 1, '99988877766'),
(7, 7, 1, '33344455566'),
(8, 8, 1, '77788899900'),
(9, 9, 1, '11223344556'),
(10, 10, 1, '66554433221');

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` bigint(20) UNSIGNED NOT NULL,
  `ds_endereco` varchar(200) NOT NULL,
  `nr_endereco` bigint(20) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `id_cidade` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `ds_endereco`, `nr_endereco`, `cep`, `id_cidade`) VALUES
(1, 'Rua das Sombras', 666, '87300001', 1),
(2, 'Avenida Underground', 1313, '87300002', 2),
(3, 'Rua Darkside', 777, '01001000', 3),
(4, 'Rua Eclipse', 404, '88010001', 4),
(5, 'Rua Raven', 999, '90010001', 5),
(6, 'Rua Neon Void', 221, '86010001', 6),
(7, 'Rua Concrete Dreams', 808, '87010001', 7),
(8, 'Avenida Black Moon', 515, '13010001', 8),
(9, 'Travessa Skull', 13, '87300003', 1),
(10, 'Rua Industrial Chaos', 911, '87300004', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(10) UNSIGNED NOT NULL,
  `nm_estado` varchar(100) NOT NULL,
  `id_pais` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `nm_estado`, `id_pais`) VALUES
(1, 'Paraná', 1),
(2, 'São Paulo', 1),
(3, 'Santa Catarina', 1),
(4, 'Rio Grande do Sul', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(10) UNSIGNED NOT NULL,
  `ds_genero` varchar(20) NOT NULL,
  `in_cancelado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `ds_genero`, `in_cancelado`) VALUES
(1, 'Masculino', 0),
(2, 'Feminino', 0),
(3, 'Não Binário', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itempedido`
--

CREATE TABLE `itempedido` (
  `id_item` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_produto` int(10) UNSIGNED NOT NULL,
  `qt_produto` int(11) NOT NULL,
  `vl_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itempedido`
--

INSERT INTO `itempedido` (`id_item`, `id_pedido`, `id_produto`, `qt_produto`, `vl_unitario`) VALUES
(1, 1, 2, 1, 0.00),
(2, 1, 4, 1, 0.00),
(3, 1, 1, 1, 189.90),
(4, 1, 5, 1, 89.90),
(5, 1, 3, 1, 249.90),
(6, 1, 8, 1, 79.90),
(7, 1, 6, 1, 199.90),
(8, 1, 7, 1, 49.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(10) UNSIGNED NOT NULL,
  `nm_pais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nm_pais`) VALUES
(1, 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_pessoa` int(10) UNSIGNED NOT NULL,
  `dt_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `vl_total` decimal(10,2) NOT NULL,
  `st_pedido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_pessoa`, `dt_pedido`, `vl_total`, `st_pedido`) VALUES
(1, 1, '2026-06-11 23:58:41', 329.80, 'Pago'),
(2, 2, '2026-06-11 23:58:41', 249.90, 'Enviado'),
(3, 3, '2026-06-11 23:58:41', 329.70, 'Processando'),
(4, 4, '2026-06-11 23:58:41', 439.80, 'Pago'),
(5, 5, '2026-06-11 23:58:41', 369.80, 'Entregue'),
(6, 6, '2026-06-11 23:58:41', 259.80, 'Pago'),
(7, 7, '2026-06-11 23:58:41', 279.80, 'Enviado'),
(8, 8, '2026-06-11 23:58:41', 539.80, 'Entregue'),
(9, 9, '2026-06-11 23:58:41', 169.80, 'Pago'),
(10, 10, '2026-06-11 23:58:41', 489.80, 'Processando');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(10) UNSIGNED NOT NULL,
  `nm_pessoabigint` varchar(100) NOT NULL,
  `dt_nasc` date NOT NULL,
  `id_endereco` bigint(20) UNSIGNED NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nm_pessoabigint`, `dt_nasc`, `id_endereco`, `id_genero`) VALUES
(1, 'Guilherme Liam', '2004-08-15', 1, 1),
(2, 'Luna Raven', '2000-03-22', 2, 2),
(3, 'Kai Shadow', '1998-11-09', 3, 3),
(4, 'Vinicius Black', '1997-04-17', 4, 1),
(5, 'Alice Noir', '2002-01-08', 5, 2),
(6, 'Pedro Hollow', '1999-06-25', 6, 1),
(7, 'Maya Night', '2001-10-13', 7, 2),
(8, 'Arthur Graves', '1995-12-05', 8, 1),
(9, 'Sarah Doom', '2003-07-18', 9, 2),
(10, 'Ethan Void', '1996-02-20', 10, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoaendereco`
--

CREATE TABLE `pessoaendereco` (
  `id_pessoa` int(10) UNSIGNED NOT NULL,
  `id_endereco` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoaendereco`
--

INSERT INTO `pessoaendereco` (`id_pessoa`, `id_endereco`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nm_produto` varchar(100) NOT NULL,
  `ds_produto` text NOT NULL,
  `vl_produto` decimal(10,2) NOT NULL,
  `im_produto` varchar(250) NOT NULL,
  `qt_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_categoria`, `nm_produto`, `ds_produto`, `vl_produto`, `im_produto`, `qt_estoque`) VALUES
(1, 1, 'Calça Wide Leg Cargo Black', 'Calça jeans larga com modelagem baggy, bolsos cargo laterais e costura reforçada. Estilo streetwear urbano.', 189.90, 'calcabaggy.jpeg', 15),
(2, 1, 'Calça Sarja Baggy', 'Calça de sarja oversized com caimento relaxado, cintura ajustável e detalhes em patches. Confortável e estilosa.', 179.90, 'calcasarjainicial.jpeg', 12),
(3, 2, 'Coturno Plataforma Dark', 'Couro legítimo, solado tratorado industrial de alta resistência.', 249.90, 'coturnoinicial.jpeg', 8),
(4, 2, 'Tênis Cano Alto', 'Tênis de cano alto com detalhes de couro e solado robusto. Conforto total para o rolê.', 289.90, 'canoalto.jpeg', 10),
(5, 3, 'Camisa Oversized', 'Malha pesada 100% algodão premium com modelagem de rua.', 89.90, 'oversizedinicial.jpeg', 25),
(6, 3, 'Blusa Moletom', 'Moletom com capuz, estampa em silk screen vermelho e bolso canguru. Tecido pesado ideal para dias frios.', 199.90, 'moletominicial.jpeg', 14),
(7, 4, 'Corrente Industrial Cursed', 'Corrente pesada com pingente de aranha, aço inox e estética underground urbana.', 49.90, 'correntedois.jpeg', 15),
(8, 4, 'Cinto Ilhós Duplo Star', 'Cinto de couro sintético preto com ilhoses duplos prateados e fivela robusta com estrela de quatro pontas.', 79.90, 'cintoinicial.jpeg', 10);

--
-- Acionadores `produto`
--
DELIMITER $$
CREATE TRIGGER `trg_valida_preco_positivo` BEFORE UPDATE ON `produto` FOR EACH ROW BEGIN
    IF NEW.vl_produto <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'O valor do produto deve ser estritamente positivo.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `id_telefone` bigint(20) UNSIGNED NOT NULL,
  `ddd` int(11) NOT NULL,
  `id_pessoa` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `telefone`
--

INSERT INTO `telefone` (`id_telefone`, `ddd`, `id_pessoa`) VALUES
(1, 44, 1),
(2, 41, 2),
(3, 11, 3),
(4, 48, 4),
(5, 51, 5),
(6, 43, 6),
(7, 44, 7),
(8, 19, 8),
(9, 44, 9),
(10, 44, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `ds_tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo`, `ds_tipo`) VALUES
(1, 'CPF'),
(2, 'RG');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_resumo_carrinho`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_resumo_carrinho` (
`id_produto` int(10) unsigned
,`nm_produto` varchar(100)
,`ds_produto` text
,`vl_produto` decimal(10,2)
,`categoria_preco` varchar(15)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_resumo_carrinho`
--
DROP TABLE IF EXISTS `vw_resumo_carrinho`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_resumo_carrinho`  AS SELECT `produto`.`id_produto` AS `id_produto`, `produto`.`nm_produto` AS `nm_produto`, `produto`.`ds_produto` AS `ds_produto`, `produto`.`vl_produto` AS `vl_produto`, CASE WHEN `produto`.`vl_produto` > 150.00 THEN 'GRIFE / PREMIUM' ELSE 'PADRÃO' END AS `categoria_preco` FROM `produto` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `cidade_id_estado_foreign` (`id_estado`);

--
-- Índices de tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `documento_id_pessoa_foreign` (`id_pessoa`),
  ADD KEY `documento_id_tipo_foreign` (`id_tipo`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD UNIQUE KEY `endereco_cep_unique` (`cep`),
  ADD KEY `endereco_id_cidade_foreign` (`id_cidade`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`),
  ADD KEY `estado_id_pais_foreign` (`id_pais`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Índices de tabela `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `itempedido_id_pedido_foreign` (`id_pedido`),
  ADD KEY `itempedido_id_produto_foreign` (`id_produto`);

--
-- Índices de tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedido_id_pessoa_foreign` (`id_pessoa`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD KEY `pessoa_id_genero_foreign` (`id_genero`),
  ADD KEY `pessoa_id_endereco_foreign` (`id_endereco`);

--
-- Índices de tabela `pessoaendereco`
--
ALTER TABLE `pessoaendereco`
  ADD PRIMARY KEY (`id_pessoa`,`id_endereco`),
  ADD KEY `pessoaendereco_id_endereco_foreign` (`id_endereco`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `produto_id_categoria_foreign` (`id_categoria`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id_telefone`),
  ADD KEY `telefone_id_pessoa_foreign` (`id_pessoa`);

--
-- Índices de tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id_cidade` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `id_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id_telefone` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Restrições para tabelas `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `documento_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_documento` (`id_tipo`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_id_cidade_foreign` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id_cidade`);

--
-- Restrições para tabelas `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_id_pais_foreign` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Restrições para tabelas `itempedido`
--
ALTER TABLE `itempedido`
  ADD CONSTRAINT `itempedido_id_pedido_foreign` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `itempedido_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);

--
-- Restrições para tabelas `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_id_endereco_foreign` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`),
  ADD CONSTRAINT `pessoa_id_genero_foreign` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);

--
-- Restrições para tabelas `pessoaendereco`
--
ALTER TABLE `pessoaendereco`
  ADD CONSTRAINT `pessoaendereco_id_endereco_foreign` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`),
  ADD CONSTRAINT `pessoaendereco_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Restrições para tabelas `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `telefone_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
