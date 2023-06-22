-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.21-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para xmlreader
CREATE DATABASE IF NOT EXISTS `xmlreader` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `xmlreader`;

-- Copiando estrutura para tabela xmlreader.xr_menu
CREATE TABLE IF NOT EXISTS `xr_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `posicao` int(11) DEFAULT NULL,
  `mod` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `ativo` (`ativo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela xmlreader.xr_menu: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `xr_menu` DISABLE KEYS */;
INSERT INTO `xr_menu` (`id`, `ativo`, `posicao`, `mod`, `icon`, `link`) VALUES
	(1, 1, 1, 'Xml', 'icon-screen-tablet', '../xml/pesquisar.php');
/*!40000 ALTER TABLE `xr_menu` ENABLE KEYS */;

-- Copiando estrutura para tabela xmlreader.xr_menu_sub
CREATE TABLE IF NOT EXISTS `xr_menu_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL DEFAULT 0,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `posicao` int(11) DEFAULT NULL,
  `submenu` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `fk_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `xr_menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela xmlreader.xr_menu_sub: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `xr_menu_sub` DISABLE KEYS */;
INSERT INTO `xr_menu_sub` (`id`, `id_menu`, `ativo`, `posicao`, `submenu`, `link`) VALUES
	(1, 1, 1, 1, 'Pesquisar', '../xml/pesquisar.php'),
	(2, 1, 1, 2, 'Registrar', '../xml/registrar.php');
/*!40000 ALTER TABLE `xr_menu_sub` ENABLE KEYS */;

-- Copiando estrutura para tabela xmlreader.xr_mod_xml
CREATE TABLE IF NOT EXISTS `xr_mod_xml` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `status` varchar(150) DEFAULT 'Registrado',
  `protocolo_autorizacao_nf` varchar(250) DEFAULT NULL,
  `numero_nf` varchar(250) DEFAULT NULL,
  `data_nf` datetime DEFAULT NULL,
  `valor_nf` decimal(10,2) DEFAULT NULL,
  `emitente_cnpj` varchar(50) DEFAULT NULL,
  `destinatario_cpf_cnpj` varchar(50) DEFAULT NULL,
  `destinatario_nome` varchar(250) DEFAULT NULL,
  `destinatario_end_logradouro` varchar(250) DEFAULT NULL,
  `destinatario_end_numero` varchar(250) DEFAULT NULL,
  `destinatario_end_bairro` varchar(250) DEFAULT NULL,
  `destinatario_end_cod_municipio` varchar(250) DEFAULT NULL,
  `destinatario_end_municipio` varchar(250) DEFAULT NULL,
  `destinatario_end_estado` varchar(250) DEFAULT NULL,
  `destinatario_end_cep` varchar(250) DEFAULT NULL,
  `destinatario_end_cod_pais` varchar(250) DEFAULT NULL,
  `nf_xml_arquivo` varchar(250) DEFAULT NULL,
  `data_registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `numero_nf` (`numero_nf`),
  KEY `status` (`status`),
  KEY `fk_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `xr_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xmlreader.xr_mod_xml: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `xr_mod_xml` DISABLE KEYS */;
/*!40000 ALTER TABLE `xr_mod_xml` ENABLE KEYS */;

-- Copiando estrutura para tabela xmlreader.xr_perfil
CREATE TABLE IF NOT EXISTS `xr_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(250) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `permissao` longtext DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `ativo` int(11) DEFAULT 1,
  `createdBy` int(11) DEFAULT 1,
  `canceledBy` int(11) DEFAULT NULL,
  `data_registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `perfil` (`perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xmlreader.xr_perfil: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `xr_perfil` DISABLE KEYS */;
INSERT INTO `xr_perfil` (`id`, `perfil`, `descricao`, `permissao`, `admin`, `ativo`, `createdBy`, `canceledBy`, `data_registro`) VALUES
	(1, 'Admin', 'Admin', '{"1":["1","2"]}', 1, 1, 1, NULL, '2022-06-20 16:00:05');
/*!40000 ALTER TABLE `xr_perfil` ENABLE KEYS */;

-- Copiando estrutura para tabela xmlreader.xr_usuario
CREATE TABLE IF NOT EXISTS `xr_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL DEFAULT 2,
  `nome` varchar(60) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`login`) USING BTREE,
  KEY `id_perfil` (`id_perfil`),
  KEY `ativo` (`ativo`),
  CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `xr_perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela xmlreader.xr_usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `xr_usuario` DISABLE KEYS */;
INSERT INTO `xr_usuario` (`id`, `id_perfil`, `nome`, `login`, `senha`, `ativo`, `data_registro`) VALUES
	(1, 1, 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', 1, '2022-06-20 16:00:05');
/*!40000 ALTER TABLE `xr_usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
