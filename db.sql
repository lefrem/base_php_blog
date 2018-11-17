-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `content` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `author` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `article_ibfk_2` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `article` (`id`, `title`, `content`, `image`, `author`) VALUES
(18,	'test change',	'mon article is change',	'image/5bf061b110589.jpg',	11),
(19,	'mon article 2',	'salut ',	'image/5bf061c4da1f9.jpg',	11),
(22,	'&lt;script&gt;alert(\'toto\')&lt;/script&gt;\r\n&lt;script&gt;alert(\'toto\')&lt;/script&gt;\r\n&lt;script&gt;alert(\'toto\')&lt;/script&gt;\r\n&lt;script&gt;alert(\'toto\')&lt;/script&gt;',	'&lt;script&gt;alert(\'toto\')&lt;/script&gt;',	'image/5bf0875aaf381.jpg',	11);

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE `commentaire` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `content` tinytext CHARACTER SET latin1 NOT NULL,
  `article` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article` (`article`),
  CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commentaire` (`id`, `username`, `content`, `article`) VALUES
(2,	'test',	'test 1',	18),
(4,	'&lt;script&gt;alert(\'toto\')&lt;/script&gt;',	'&lt;script&gt;alert(\'toto\')&lt;/script&gt;',	22);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(11,	'aze',	'$1$XA.tXhuP$ZS2y1m6W.JRMMbY9.f.xn1'),
(12,	'hassan',	'$1$L/L0sv2L$T1TIeoHRRrskOq97a8BzE/'),
(13,	'&lt;script&gt;alert(\'toto\')&lt;/script&gt;',	'$1$W8B9nWzi$.LVozd4dkyzRb60SdTno90');

-- 2018-11-17 22:32:10
