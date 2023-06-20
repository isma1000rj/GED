--
-- Banco de dados: `ged`
--
CREATE DATABASE IF NOT EXISTS `ged` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `ged`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id_conf` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome_empresa` varchar(40) COLLATE utf8_bin NOT NULL,
  `nome_logo` varchar(10) COLLATE utf8_bin NOT NULL,
  `titulo_navegador` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_conf`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `configuracao`
--

INSERT INTO `configuracao` (`id_conf`, `id_usuario`, `nome_empresa`, `nome_logo`, `titulo_navegador`) VALUES
(5, 73, 'ME SALVA T.I', 'lgt2.png', 'GestÃ£o EletrÃ´nica de Documentos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(80) COLLATE utf8_bin NOT NULL,
  `autor` varchar(80) COLLATE utf8_bin NOT NULL,
  `data` varchar(20) COLLATE utf8_bin NOT NULL,
  `extensao` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `tamanho` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `apelido` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `documento`
--

INSERT INTO `documento` (`id_doc`, `id_tipo`, `id_nivel`, `id_usuario`, `nome`, `autor`, `data`, `extensao`, `tamanho`, `apelido`) VALUES
(1, 2, 1, 1, 'DocTeste', 'admin', '04-03-2017', 'pdf', NULL, 'Documento De Teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_acesso_documento`
--

CREATE TABLE IF NOT EXISTS `log_acesso_documento` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `nome_documento` varchar(80) COLLATE utf8_bin NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` varchar(20) COLLATE utf8_bin NOT NULL,
  `hora` time NOT NULL,
  `operacao` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_doc` (`nome_documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `log_acesso_documento`
--

INSERT INTO `log_acesso_documento` (`id_log`, `nome_documento`, `id_usuario`, `data`, `hora`, `operacao`) VALUES
(1, 'Administrador', 1, '2017-03-04', '11:05:04', 'Acessou o Sistema'),
(2, 'DocTeste.pdf', 1, '04-03-2017', '11:06:05', 'Gravou Documento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_acesso`
--

CREATE TABLE IF NOT EXISTS `nivel_acesso` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`id_nivel`, `descricao`) VALUES
(1, 'PÃºblico'),
(2, 'Privado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_usuario`
--

CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(3) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_perfil`, `descricao`) VALUES
(1, 'ADM'),
(2, 'USR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao_acesso_modulo`
--

CREATE TABLE IF NOT EXISTS `permissao_acesso_modulo` (
  `id_permissao_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `cdr_usuario` char(1) COLLATE utf8_bin NOT NULL,
  `cdr_documento` char(1) COLLATE utf8_bin NOT NULL,
  `cdr_tpdocumento` char(1) COLLATE utf8_bin NOT NULL,
  `lst_tpdocumento` char(1) COLLATE utf8_bin NOT NULL,
  `lst_documento` char(1) COLLATE utf8_bin NOT NULL,
  `lst_log` char(1) COLLATE utf8_bin NOT NULL,
  `lst_usuario` char(1) COLLATE utf8_bin NOT NULL,
  `cdr_permissaoacesso` char(1) COLLATE utf8_bin NOT NULL,
  `cdr_config` char(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_permissao_modulo`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `permissao_acesso_modulo`
--

INSERT INTO `permissao_acesso_modulo` (`id_permissao_modulo`, `id_usuario`, `cdr_usuario`, `cdr_documento`, `cdr_tpdocumento`, `lst_tpdocumento`, `lst_documento`, `lst_log`, `lst_usuario`, `cdr_permissaoacesso`, `cdr_config`) VALUES
(1, 1, 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_doc`
--

CREATE TABLE IF NOT EXISTS `tipo_doc` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `tipo_doc`
--

INSERT INTO `tipo_doc` (`id_tipo`, `descricao`) VALUES
(1, 'FormulÃ¡rio de cadastro'),
(2, 'Ficha TÃ©cnica'),
(3, 'FomulÃ¡rio de InscriÃ§Ã£o'),
(4, 'Ordem de ServiÃ§o');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `senha` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_perfil`, `nome`, `login`, `senha`) VALUES
(1, 1, 'Administrador', 'admin', 'de4acb0882e27cd9630207bad7fecf687e382d99');

