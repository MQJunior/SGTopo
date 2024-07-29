-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sgpadrao
DROP DATABASE IF EXISTS `sgpadrao`;
CREATE DATABASE IF NOT EXISTS `sgpadrao` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sgpadrao`;

-- Copiando estrutura para tabela sgpadrao.tbl_arquivos
DROP TABLE IF EXISTS `tbl_arquivos`;
CREATE TABLE IF NOT EXISTS `tbl_arquivos` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TIPO` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LOCAL` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TAMANHO` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NOME_HASH` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATACRIACAO` datetime NOT NULL,
  `SESSAO` int NOT NULL,
  `USUARIO` int NOT NULL,
  `REG_ATIVO` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODIGO`),
  KEY `ARQUIVO_SESSAO` (`SESSAO`),
  KEY `ARQUIVO_USUARIO` (`USUARIO`),
  CONSTRAINT `TBL_ARQUIVOS_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_ARQUIVOS_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_arquivos: ~0 rows (aproximadamente)
DELETE FROM `tbl_arquivos`;

-- Copiando estrutura para tabela sgpadrao.tbl_padrao
DROP TABLE IF EXISTS `tbl_padrao`;
CREATE TABLE IF NOT EXISTS `tbl_padrao` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRICAO` mediumtext COLLATE utf8mb4_unicode_ci,
  `TIPO` int DEFAULT NULL,
  `VALOR` double DEFAULT NULL,
  `DATA` datetime DEFAULT NULL,
  `ESCOLHA` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SESSAO` int NOT NULL,
  `USUARIO` int NOT NULL,
  `DATACRIACAO` datetime NOT NULL,
  `REG_ATIVO` int NOT NULL,
  PRIMARY KEY (`CODIGO`),
  KEY `TBL_PADRAO_SESSAO` (`SESSAO`),
  KEY `TBL_PADRAO_USUARIO` (`USUARIO`),
  CONSTRAINT `TBL_PADRAO_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_PADRAO_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_padrao: ~0 rows (aproximadamente)
DELETE FROM `tbl_padrao`;
INSERT INTO `tbl_padrao` (`CODIGO`, `NOME`, `DESCRICAO`, `TIPO`, `VALOR`, `DATA`, `ESCOLHA`, `SESSAO`, `USUARIO`, `DATACRIACAO`, `REG_ATIVO`) VALUES
	(1, 'TESTE1', 'TESTE DE CADASTRO', 2, 25, '2024-03-06 00:00:00', 'A', 17, 1, '2024-03-06 18:23:14', 1);

-- Copiando estrutura para tabela sgpadrao.tbl_sistema
DROP TABLE IF EXISTS `tbl_sistema`;
CREATE TABLE IF NOT EXISTS `tbl_sistema` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOME_CURTO` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DESCRICAO` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `DATACRIACAO` datetime NOT NULL,
  `SESSAO` int NOT NULL,
  `USUARIO` int NOT NULL,
  PRIMARY KEY (`CODIGO`),
  UNIQUE KEY `SISTEMA_NOME` (`NOME`),
  KEY `SISTEMA_USUARIO` (`USUARIO`),
  KEY `SISTEMA_SESSAO` (`SESSAO`),
  CONSTRAINT `TBL_SISTEMA_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_SISTEMA_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sistema: ~0 rows (aproximadamente)
DELETE FROM `tbl_sistema`;
INSERT INTO `tbl_sistema` (`CODIGO`, `NOME`, `NOME_CURTO`, `DESCRICAO`, `DATACRIACAO`, `SESSAO`, `USUARIO`) VALUES
	(1, 'SGPADRAO', 'SGP', 'SISTEMA PADRAO', '2020-12-07 21:07:28', 1, 1);

-- Copiando estrutura para tabela sgpadrao.tbl_sys_acoes
DROP TABLE IF EXISTS `tbl_sys_acoes`;
CREATE TABLE IF NOT EXISTS `tbl_sys_acoes` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ENTIDADE` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RESTRITO` int NOT NULL,
  `NIVEL` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODIGO`),
  KEY `ACOES_ENTIDADE` (`ENTIDADE`) USING BTREE,
  CONSTRAINT `TBL_SYS_ACOES_ibfk_1` FOREIGN KEY (`ENTIDADE`) REFERENCES `tbl_sys_entidades` (`NOME`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela sgpadrao.tbl_sys_acoes: ~47 rows (aproximadamente)
DELETE FROM `tbl_sys_acoes`;
INSERT INTO `tbl_sys_acoes` (`CODIGO`, `NOME`, `ENTIDADE`, `RESTRITO`, `NIVEL`) VALUES
	(1, 'LOGAR', 'SISTEMA', 0, 0),
	(2, 'LOGIN', 'USUARIO', 0, 0),
	(3, 'PRINCIPAL', 'SISTEMA', 1, 0),
	(4, 'DEBUG', 'SISTEMA', 0, 0),
	(5, 'MONTAR', 'MENU', 0, 0),
	(6, 'RELOAD', 'MENU', 0, 0),
	(7, 'EDITAR', 'MENU', 1, 0),
	(8, 'CONSULTAR', 'MENU', 1, 0),
	(9, 'ORDEM_MUDAR', 'MENU', 1, 0),
	(10, 'EXIBIR', 'MENU', 1, 0),
	(11, 'ALTERAR', 'MENU', 1, 0),
	(12, 'INCLUIR', 'MENU', 1, 0),
	(13, 'PESQUISAR', 'USUARIO', 1, 0),
	(14, 'ALTERAR', 'USUARIO', 1, 0),
	(15, 'ATIVAR', 'USUARIO', 1, 0),
	(16, 'BLOQUEAR', 'USUARIO', 1, 0),
	(17, 'INCLUIR', 'USUARIO', 1, 0),
	(18, 'CONSULTAR', 'USUARIO', 1, 0),
	(19, 'REDEFINIR_SENHA', 'USUARIO', 1, 0),
	(20, 'ALTERAR_SENHA', 'USUARIO', 1, 0),
	(21, 'ALTERAR_PERFIL', 'USUARIO', 1, 0),
	(22, 'PERFIL', 'USUARIO', 1, 0),
	(23, 'ALTERAR_IMAGEM', 'USUARIO', 1, 0),
	(24, 'PESQUISAR', 'PERMISSAO', 1, 0),
	(25, 'INCLUIR', 'PERMISSAO', 1, 0),
	(26, 'PESQUISAR', 'ENTIDADEACAO', 1, 0),
	(27, 'CONSULTAR_ENTIDADE', 'ENTIDADEACAO', 1, 0),
	(28, 'LISTAR_ACAO', 'ENTIDADEACAO', 1, 0),
	(29, 'INCLUIR_ENTIDADE', 'ENTIDADEACAO', 1, 0),
	(30, 'INCLUIR_ACAO', 'ENTIDADEACAO', 1, 0),
	(31, 'CONSULTAR_ACAO', 'ENTIDADEACAO', 1, 0),
	(32, 'ALTERAR_ACAO', 'ENTIDADEACAO', 1, 0),
	(33, 'VISUALIZAR_ARQUIVO', 'ENTIDADEACAO', 1, 2),
	(34, 'EDITAR_ARQUIVO', 'ENTIDADEACAO', 1, 2),
	(35, 'CRIAR_ARQUIVO', 'ENTIDADEACAO', 1, 2),
	(36, 'SALVAR_ARQUIVO', 'ENTIDADEACAO', 1, 2),
	(37, 'CRIAR_DIRETORIO', 'ENTIDADEACAO', 1, 2),
	(38, 'IMPORTAR_MODELO', 'ENTIDADEACAO', 1, 2),
	(39, 'TABELAS', 'SISTEMA', 1, 3),
	(40, 'CRIAR_TABELA', 'SISTEMA', 1, 3),
	(41, 'TABELA_CARREGAR_CSV', 'SISTEMA', 1, 0),
	(42, 'PESQUISAR', 'PADRAO', 1, 0),
	(43, 'PESQUISA', 'PADRAO', 1, 0),
	(44, 'CONSULTAR', 'PADRAO', 1, 0),
	(45, 'INCLUIR', 'PADRAO', 1, 0),
	(46, 'ALTERAR', 'PADRAO', 1, 0),
	(47, 'ATIVAR', 'PADRAO', 1, 0),
	(48, 'DESATIVAR', 'PADRAO', 1, 0),
	(49, 'EXCLUIR', 'PADRAO', 1, 0);

-- Copiando estrutura para tabela sgpadrao.tbl_sys_autenticacoes
DROP TABLE IF EXISTS `tbl_sys_autenticacoes`;
CREATE TABLE IF NOT EXISTS `tbl_sys_autenticacoes` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `TIPO` int NOT NULL,
  `CLIENTENOME` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IPCLIENTE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SESSAO` int NOT NULL,
  `USUARIO` int NOT NULL,
  `DATACRIACAO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `REG_ATIVO` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODIGO`),
  KEY `SESSAO` (`SESSAO`),
  KEY `USUARIO` (`USUARIO`),
  KEY `TIPO` (`TIPO`),
  CONSTRAINT `TBL_SYS_AUTENTICACOES_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sys_autenticacoes: ~0 rows (aproximadamente)
DELETE FROM `tbl_sys_autenticacoes`;

-- Copiando estrutura para tabela sgpadrao.tbl_sys_entidades
DROP TABLE IF EXISTS `tbl_sys_entidades`;
CREATE TABLE IF NOT EXISTS `tbl_sys_entidades` (
  `NOME` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `TABELA` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`NOME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela sgpadrao.tbl_sys_entidades: ~9 rows (aproximadamente)
DELETE FROM `tbl_sys_entidades`;
INSERT INTO `tbl_sys_entidades` (`NOME`, `TABELA`) VALUES
	('ENTIDADEACAO', 'TBL_SYS_ACOES'),
	('FORNECEDORES', 'TBL_FORNECEDORES'),
	('MENU', 'TBL_SYS_MENUS'),
	('PADRAO', 'TBL_PADRAO'),
	('PERMISSAO', 'TBL_SYS_PERMISSOES'),
	('SISTEMA', 'TBL_SISTEMA'),
	('SYSLOG', 'TBL_SYS_LOGS'),
	('SYSSESSAO', 'TBL_SYS_SESSOES'),
	('USUARIO', 'TBL_USUARIOS');

-- Copiando estrutura para tabela sgpadrao.tbl_sys_logs
DROP TABLE IF EXISTS `tbl_sys_logs`;
CREATE TABLE IF NOT EXISTS `tbl_sys_logs` (
  `DATACRIACAO` datetime NOT NULL,
  `IPCLIENTE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `USUARIO` int NOT NULL,
  `SESSAO` int NOT NULL,
  `ENTIDADE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ACAO` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CHAVE_REGISTRO` int DEFAULT NULL,
  KEY `LOG_USUARIO` (`USUARIO`),
  KEY `LOG_SESSAO` (`SESSAO`),
  KEY `ENTIDADE` (`ENTIDADE`),
  KEY `ACAO` (`ACAO`),
  CONSTRAINT `TBL_SYS_LOGS_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_SYS_LOGS_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sys_logs: ~832 rows (aproximadamente)
DELETE FROM `tbl_sys_logs`;


-- Copiando estrutura para tabela sgpadrao.tbl_sys_menus
DROP TABLE IF EXISTS `tbl_sys_menus`;
CREATE TABLE IF NOT EXISTS `tbl_sys_menus` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ENTIDADE_ACAO` int DEFAULT NULL,
  `ORDEM` int NOT NULL DEFAULT '0',
  `NIVEL` int NOT NULL,
  `TIPO` int NOT NULL,
  `ICONE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MENU_PAI` int DEFAULT NULL,
  `SESSAO` int NOT NULL,
  `USUARIO` int NOT NULL,
  `DATACRIACAO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `REG_ATIVO` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODIGO`),
  KEY `MENU_ENTIDADEACAO` (`ENTIDADE_ACAO`),
  KEY `MENU_MENU_PAI` (`MENU_PAI`),
  KEY `MENU_SESSAO` (`SESSAO`),
  KEY `MENU_USUARIO` (`USUARIO`),
  CONSTRAINT `TBL_SYS_MENUS_ibfk_1` FOREIGN KEY (`ENTIDADE_ACAO`) REFERENCES `tbl_sys_acoes` (`CODIGO`),
  CONSTRAINT `TBL_SYS_MENUS_ibfk_3` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_SYS_MENUS_ibfk_4` FOREIGN KEY (`MENU_PAI`) REFERENCES `tbl_sys_menus` (`CODIGO`),
  CONSTRAINT `TBL_SYS_MENUS_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sys_menus: ~15 rows (aproximadamente)
DELETE FROM `tbl_sys_menus`;
INSERT INTO `tbl_sys_menus` (`CODIGO`, `NOME`, `ENTIDADE_ACAO`, `ORDEM`, `NIVEL`, `TIPO`, `ICONE`, `MENU_PAI`, `SESSAO`, `USUARIO`, `DATACRIACAO`, `REG_ATIVO`) VALUES
	(1, 'MENU PRINCIPAL', NULL, 0, 0, 0, NULL, NULL, 1, 1, '2020-12-07 17:07:43', 1),
	(2, 'Sistema', NULL, 0, 1, 1, 'fa-cube', 1, 1, 1, '2020-12-07 22:33:15', 1),
	(3, 'Seguranca', NULL, 1, 2, 1, 'fa-unlock-alt', 2, 1, 1, '2020-12-07 22:36:25', 1),
	(4, 'Debug', 4, 1, 3, 1, 'fa-stack-overflow', 7, 1, 1, '2020-12-07 22:36:25', 1),
	(5, 'Menu Geral', 7, 0, 2, 1, 'fa-list', 2, 1, 1, '2020-12-07 22:40:08', 1),
	(6, 'Permissões', 24, 0, 3, 1, 'fa-lock', 3, 1, 1, '2020-12-08 12:25:30', 1),
	(7, 'Desenvolvimento', NULL, 2, 2, 1, 'fa-gears', 2, 1, 1, '2020-12-08 13:57:26', 1),
	(8, 'Entidade Ação', 26, 0, 3, 1, 'fa-cubes', 7, 1, 1, '2020-12-08 14:06:29', 1),
	(9, 'Tabelas', 39, 2, 3, 1, 'fa-anchor', 7, 1, 1, '2021-01-15 14:28:12', 1),
	(10, 'Cadastros', NULL, 1, 1, 1, '', 1, 1, 1, '2021-05-13 18:01:48', 1),
	(11, 'USUARIOS', NULL, 1, 3, 0, 'fa-user', 3, 1, 1, '2023-01-05 21:13:44', 1),
	(12, 'PESQUISAR', 13, 0, 4, 1, 'fa-search', 11, 1, 1, '2023-01-05 21:15:31', 1),
	(13, 'INCLUIR', 17, 1, 4, 1, 'fa-user-plus', 11, 1, 1, '2023-01-05 21:18:26', 1),
	(16, 'Padrao', 42, 0, 2, 0, 'fa-search', 10, 17, 1, '2024-03-06 17:48:16', 1),
	(17, 'Padrao', NULL, 1, 2, 0, NULL, 10, 17, 1, '2024-03-06 17:53:20', 0);

-- Copiando estrutura para tabela sgpadrao.tbl_sys_permissoes
DROP TABLE IF EXISTS `tbl_sys_permissoes`;
CREATE TABLE IF NOT EXISTS `tbl_sys_permissoes` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `USUARIO` int NOT NULL,
  `ACAO` int NOT NULL,
  `ENTIDADE_CODIGO` int DEFAULT NULL,
  `TIPO_ACESSO` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATACRIACAO` datetime NOT NULL,
  `USUARIO_CRIOU` int NOT NULL,
  `SESSAO` int NOT NULL,
  PRIMARY KEY (`CODIGO`),
  KEY `PERMISSAO_USUARIO` (`USUARIO`),
  KEY `PERMISSAO_ACAO` (`ACAO`),
  KEY `PERMISSAO_USUARIO_CRIOU` (`USUARIO_CRIOU`),
  KEY `PERMISSAO_SESSAO` (`SESSAO`),
  CONSTRAINT `TBL_SYS_PERMISSOES_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`),
  CONSTRAINT `TBL_SYS_PERMISSOES_ibfk_3` FOREIGN KEY (`ACAO`) REFERENCES `tbl_sys_acoes` (`CODIGO`),
  CONSTRAINT `TBL_SYS_PERMISSOES_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sys_permissoes: ~90 rows (aproximadamente)
DELETE FROM `tbl_sys_permissoes`;
INSERT INTO `tbl_sys_permissoes` (`CODIGO`, `USUARIO`, `ACAO`, `ENTIDADE_CODIGO`, `TIPO_ACESSO`, `DATACRIACAO`, `USUARIO_CRIOU`, `SESSAO`) VALUES
	(1, 1, 1, 0, '-', '2020-12-05 00:00:00', 1, 17),
	(2, 1, 2, 0, '-', '2020-12-05 00:00:00', 1, 17),
	(3, 1, 3, 0, '+', '2020-12-07 17:11:03', 1, 1),
	(4, 1, 4, 0, '-', '2020-12-07 17:11:03', 1, 17),
	(5, 1, 5, 0, '-', '2020-12-07 17:11:03', 1, 17),
	(6, 1, 6, 0, '-', '2020-12-07 17:11:03', 1, 17),
	(7, 1, 7, 0, '+', '2020-12-07 22:52:53', 1, 1),
	(8, 1, 8, 0, '+', '2020-12-07 22:52:53', 1, 1),
	(9, 1, 9, 0, '+', '2020-12-07 23:00:54', 1, 1),
	(10, 1, 10, 0, '+', '2020-12-07 23:00:54', 1, 1),
	(11, 1, 11, 0, '+', '2020-12-07 23:02:08', 1, 1),
	(12, 1, 12, 0, '+', '2020-12-07 23:02:08', 1, 1),
	(13, 1, 13, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(14, 1, 14, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(15, 1, 15, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(16, 1, 16, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(17, 1, 17, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(18, 1, 18, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(19, 1, 19, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(20, 1, 20, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(21, 1, 21, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(22, 1, 22, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(23, 1, 23, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(24, 1, 24, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(25, 1, 25, 0, '+', '2020-12-07 23:03:05', 1, 1),
	(26, 1, 32, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(27, 1, 31, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(28, 1, 27, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(29, 1, 30, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(30, 1, 29, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(31, 1, 28, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(32, 1, 26, 0, '+', '2020-12-08 14:05:38', 1, 1),
	(33, 1, 33, 0, '+', '2020-12-08 14:42:12', 1, 1),
	(34, 1, 34, 0, '+', '2020-12-08 14:43:03', 1, 1),
	(35, 1, 35, 0, '+', '2020-12-08 14:43:33', 1, 1),
	(36, 1, 36, 0, '+', '2020-12-08 14:43:46', 1, 1),
	(37, 1, 37, 0, '+', '2020-12-08 14:44:10', 1, 1),
	(38, 1, 38, 0, '+', '2020-12-08 14:44:30', 1, 1),
	(39, 1, 39, 0, '+', '2021-01-15 14:26:56', 1, 1),
	(40, 1, 40, 0, '+', '2021-01-15 14:30:41', 1, 1),
	(41, 1, 41, 0, '+', '2021-01-15 14:31:50', 1, 1),
	(42, 2, 32, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(43, 2, 31, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(44, 2, 27, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(45, 2, 35, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(46, 2, 37, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(47, 2, 34, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(49, 2, 30, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(50, 2, 29, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(51, 2, 28, 0, '+', '2023-01-05 21:20:36', 1, 1),
	(52, 2, 26, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(53, 2, 36, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(54, 2, 33, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(55, 2, 11, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(56, 2, 8, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(57, 2, 7, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(58, 2, 10, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(59, 2, 12, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(60, 2, 9, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(61, 2, 25, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(62, 2, 24, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(64, 2, 3, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(66, 2, 41, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(67, 2, 14, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(68, 2, 23, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(69, 2, 21, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(70, 2, 20, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(71, 2, 15, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(72, 2, 16, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(73, 2, 18, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(74, 2, 17, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(75, 2, 22, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(76, 2, 13, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(77, 2, 19, 0, '+', '2023-01-05 21:20:37', 1, 1),
	(78, 2, 5, 0, '-', '2023-01-05 21:20:37', 1, 1),
	(79, 2, 6, 0, '-', '2023-01-05 21:20:37', 1, 1),
	(80, 2, 1, 0, '-', '2023-01-05 21:20:37', 1, 1),
	(81, 2, 4, 0, '-', '2023-01-05 21:20:37', 1, 1),
	(82, 2, 2, 0, '-', '2023-01-05 21:20:37', 1, 1),
	(84, 1, 43, 0, '+', '2024-03-06 18:02:54', 1, 17),
	(85, 1, 42, 0, '+', '2024-03-06 18:11:46', 1, 17),
	(86, 1, 44, 0, '+', '2024-03-06 18:21:38', 1, 17),
	(87, 1, 45, 0, '+', '2024-03-06 18:22:03', 1, 17),
	(88, 1, 46, 0, '+', '2024-03-06 18:22:14', 1, 17),
	(89, 1, 47, 0, '+', '2024-03-06 19:05:15', 1, 17),
	(90, 1, 48, 0, '+', '2024-03-06 19:05:34', 1, 17),
	(91, 1, 49, 0, '+', '2024-03-06 19:05:59', 1, 17);

-- Copiando estrutura para tabela sgpadrao.tbl_sys_sessoes
DROP TABLE IF EXISTS `tbl_sys_sessoes`;
CREATE TABLE IF NOT EXISTS `tbl_sys_sessoes` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `USUARIO` int NOT NULL,
  `SESSAO_UID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `CLIENTENOME` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IPCLIENTE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATAINICIO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATAMODIFICACAO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATAFIM` datetime DEFAULT NULL,
  `MULTI_ACESSO` int NOT NULL DEFAULT '0',
  `EXP_INFINITA` int NOT NULL DEFAULT '0',
  `REG_ATIVO` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODIGO`),
  KEY `SESSAO_USUARIO` (`USUARIO`),
  KEY `SESSAO_UID` (`SESSAO_UID`),
  CONSTRAINT `FK_SESSAO_USUARIO` FOREIGN KEY (`USUARIO`) REFERENCES `tbl_usuarios` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_sys_sessoes: ~22 rows (aproximadamente)
DELETE FROM `tbl_sys_sessoes`;
INSERT INTO `tbl_sys_sessoes` (`CODIGO`, `USUARIO`, `SESSAO_UID`, `CLIENTENOME`, `IPCLIENTE`, `DATAINICIO`, `DATAMODIFICACAO`, `DATAFIM`, `MULTI_ACESSO`, `EXP_INFINITA`, `REG_ATIVO`) VALUES
	(1, 1, '313730393637343336359ce1488bebd3', 'SUPERVISOR@', '::1', '2024-03-05 18:32:45', '2024-03-05 18:32:45', '2024-03-05 19:22:54', 0, 0, 1),
	(2, 1, 'SGPadrao31373039363734353037b804', 'SUPERVISOR@', '::1', '2024-03-05 18:35:07', '2024-03-05 18:35:07', '2024-03-05 19:22:54', 0, 0, 1),
	(3, 1, 'SGPadrao31373039363734353533d2e5', 'SUPERVISOR@::1', '::1', '2024-03-05 18:35:53', '2024-03-05 18:35:53', '2024-03-05 19:22:54', 0, 0, 1),
	(4, 1, 'SGPadrao313730393637343538314ba8', 'SUPERVISOR@::1', '::1', '2024-03-05 18:36:21', '2024-03-05 18:36:21', '2024-03-05 19:22:54', 0, 0, 1),
	(5, 1, '534750616472616f3137303936373439', 'SUPERVISOR@::1', '::1', '2024-03-05 18:42:35', '2024-03-05 18:42:35', '2024-03-05 19:22:54', 0, 0, 1),
	(6, 1, '534750616472616f3137303936373530', 'SUPERVISOR@::1', '::1', '2024-03-05 18:44:51', '2024-03-05 18:44:51', '2024-03-05 19:22:54', 0, 0, 1),
	(7, 1, '35616563633939363365393635386538', 'SUPERVISOR@::1', '::1', '2024-03-05 18:48:15', '2024-03-05 18:48:15', '2024-03-05 19:22:54', 0, 0, 1),
	(8, 1, 'd8015bc04743e295b14a472f57456115', 'SUPERVISOR@::1', '::1', '2024-03-05 18:49:05', '2024-03-05 18:49:05', '2024-03-05 19:22:54', 0, 0, 1),
	(9, 1, 'fd1011c6ada80d66d4c6144b68114435', 'SUPERVISOR@::1', '::1', '2024-03-05 18:53:02', '2024-03-05 18:53:02', '2024-03-05 19:22:54', 0, 0, 1),
	(10, 1, 'e081b182270dc798694c324c680a1a50', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-05 18:53:31', '2024-03-05 18:53:31', '2024-03-05 19:39:17', 0, 0, 1),
	(11, 1, 'a052e097e97478a3a13d9f4fb94ea8b2', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-05 19:39:27', '2024-03-05 20:05:27', '2024-03-05 20:55:07', 0, 0, 1),
	(12, 1, '7d2e8facad63721aa574827fd2493421', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-05 20:45:59', '2024-03-05 20:45:59', '2024-03-05 20:55:51', 0, 0, 1),
	(13, 1, 'b82e385ee885822c45dc543fbcbb8aa2', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-05 20:55:51', '2024-03-05 20:58:30', '2024-03-06 12:27:42', 0, 0, 1),
	(14, 1, '9de08c3e4840404bb0cd00b1718a34eb', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-06 12:27:42', '2024-03-06 12:48:25', '2024-03-06 15:28:05', 0, 0, 1),
	(15, 1, '082a90ced2b42a6eb81bba6f9d017639', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-06 15:39:53', '2024-03-06 15:39:53', '2024-03-06 15:43:07', 0, 0, 1),
	(16, 1, '74a9b04f75d564e4472d105b1c3a11dd', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-06 15:44:34', '2024-03-06 15:44:42', '2024-03-06 18:03:08', 0, 0, 1),
	(17, 1, '84e3feaffebaa15df04e8ce2644695d6', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-06 17:28:47', '2024-03-06 22:13:34', '2024-03-07 13:30:28', 0, 0, 1),
	(18, 1, '280d55cbac1fb1363461ab06cf9012d7', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-07 15:30:55', '2024-03-07 22:35:03', '2024-03-08 17:10:17', 0, 0, 1),
	(19, 1, 'cbab58d00de899684ad4dd7045ac7743', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-08 13:59:28', '2024-03-08 14:00:47', '2024-03-08 19:59:03', 0, 0, 1),
	(20, 1, '67d5ab98fe1ca7e3f8a1979c4ad9b3d4', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-08 19:59:05', '2024-03-08 19:59:14', '2024-03-10 17:01:10', 0, 0, 1),
	(21, 1, '58249eea2a4ba48dc236e199d0a07b82', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-10 17:01:10', '2024-03-10 18:09:50', '2024-03-24 18:51:49', 0, 0, 1),
	(22, 1, 'cab96a0871f17ab134284991ead5d020', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-24 18:51:49', '2024-03-25 09:46:27', '2024-03-27 17:29:19', 0, 1, 1),
	(23, 1, '86bc10c5c93be73d9fd3d339da534841', 'SUPERVISOR@127.0.0.1', '127.0.0.1', '2024-03-27 17:29:19', '2024-03-27 17:29:19', NULL, 0, 0, 1);

-- Copiando estrutura para tabela sgpadrao.tbl_usuarios
DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `CODIGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NOME_EXIBIR` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FUNCAO` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TITULO` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SENHA` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PESSOA` int DEFAULT NULL,
  `TIPO` int NOT NULL DEFAULT '5',
  `GRUPO` int DEFAULT NULL,
  `DESCRICAO` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `IMAGEM` int DEFAULT NULL,
  `NIVEL` int NOT NULL DEFAULT '0',
  `USUARIO_CRIOU` int NOT NULL,
  `SESSAO` int NOT NULL,
  `DATACRIACAO` datetime NOT NULL,
  `REG_ATIVO` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`CODIGO`),
  UNIQUE KEY `USUARIO_EMAIL` (`EMAIL`),
  KEY `TBL_USUARIOS_SESSAO` (`SESSAO`),
  CONSTRAINT `TBL_USUARIOS_SESSAO` FOREIGN KEY (`SESSAO`) REFERENCES `tbl_sys_sessoes` (`CODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sgpadrao.tbl_usuarios: ~2 rows (aproximadamente)
DELETE FROM `tbl_usuarios`;
INSERT INTO `tbl_usuarios` (`CODIGO`, `NOME`, `NOME_EXIBIR`, `EMAIL`, `FUNCAO`, `TITULO`, `SENHA`, `PESSOA`, `TIPO`, `GRUPO`, `DESCRICAO`, `IMAGEM`, `NIVEL`, `USUARIO_CRIOU`, `SESSAO`, `DATACRIACAO`, `REG_ATIVO`) VALUES
	(1, 'SUPERVISOR', 'SUPERVISOR', 'SUPERVISOR@SUPERVISOR', 'SUPERVISOR', 'SUPERVISOR', 'SUPERVISOR', NULL, 1, NULL, NULL, NULL, 0, 1, 1, '2020-12-05 00:00:00', 1),
	(2, 'MARCIO', 'MARCIO', 'MARCIO@SISTEMA', NULL, NULL, 'wsx852357', NULL, 1, 1, NULL, NULL, 0, 1, 1, '2023-01-05 21:19:51', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
