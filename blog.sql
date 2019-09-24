-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 sep. 2019 à 20:29
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `authorEdit` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `datePublication` datetime NOT NULL,
  `dateEdit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `author`, `authorEdit`, `title`, `content`, `datePublication`, `dateEdit`) VALUES
(36, 'Jean-Forteroche', 'Jean-Forteroche', 'Eternelle jeunesse', '<p>&nbsp;</p>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/blog_Jean-Forteroche/public/images/1.jpg\" width=\"937\" height=\"626\" /></p>\r\n<p>&nbsp;</p>\r\n<p>Les mousses &eacute;taient au-del&agrave; de toute description : si belles, si fra&icirc;ches, d\'un vert si gai, et toutes tellement basses, calmes et silencieuses alors que le vent soufflait violemment sur elles, tandis que s\'abattait la pluie lourde, Jamais, probablement, aucune particule de poussi&egrave;re n\'avait touch&eacute; les feuilles ou les extr&eacute;mit&eacute;s de toutes ces plantes b&eacute;nies.</p>\r\n<p>Et comme les bords rouges des corolles de de cladonias paraissaient brillantes &agrave; c&ocirc;t&eacute; d\'elles, ou les fruits du cornouiller nain ! Les baies mouill&eacute;es &eacute;tincelaient comme des pierres pr&eacute;cieuses - les gouttes de cristal des myrtilles sur les buissons aux fleurs p&acirc;les, m&ecirc;l&eacute;es aux grappes de perles des m&ucirc;res rouges et jaunes, et les gouttes de pluie elles-m&ecirc;mes ressemblaient &agrave; des baies, qui d&eacute;coraient les arches d\'herbes et de laiches entrelac&eacute;es sur le bord des mares, chacune comme un miroir qui aurait refl&eacute;t&eacute; le paysage tout entier.</p>\r\n<p>Les mousses &eacute;taient au-del&agrave; de toute description : si belles, si fra&icirc;ches, d\'un vert si gai, et toutes tellement basses, calmes et silencieuses alors que le vent soufflait violemment sur elles, tandis que s\'abattait la pluie lourde, Jamais, probablement, aucune particule de poussi&egrave;re n\'avait touch&eacute; les feuilles ou les extr&eacute;mit&eacute;s de toutes ces plantes b&eacute;nies.</p>\r\n<p>Et comme les bords rouges des corolles de de cladonias paraissaient brillantes &agrave; c&ocirc;t&eacute; d\'elles, ou les fruits du cornouiller nain ! Les baies mouill&eacute;es &eacute;tincelaient comme des pierres pr&eacute;cieuses - les gouttes de cristal des myrtilles sur les buissons aux fleurs p&acirc;les, m&ecirc;l&eacute;es aux grappes de perles des m&ucirc;res rouges et jaunes, et les gouttes de pluie elles-m&ecirc;mes ressemblaient &agrave; des baies, qui d&eacute;coraient les arches d\'herbes et de laiches entrelac&eacute;es sur le bord des mares, chacune comme un miroir qui aurait refl&eacute;t&eacute; le paysage tout entier.</p>\r\n<p>Les mousses &eacute;taient au-del&agrave; de toute description : si belles, si fra&icirc;ches, d\'un vert si gai, et toutes tellement basses, calmes et silencieuses alors que le vent soufflait violemment sur elles, tandis que s\'abattait la pluie lourde, Jamais, probablement, aucune particule de poussi&egrave;re n\'avait touch&eacute; les feuilles ou les extr&eacute;mit&eacute;s de toutes ces plantes b&eacute;nies.</p>\r\n<p>Et comme les bords rouges des corolles de de cladonias paraissaient brillantes &agrave; c&ocirc;t&eacute; d\'elles, ou les fruits du cornouiller nain ! Les baies mouill&eacute;es &eacute;tincelaient comme des pierres pr&eacute;cieuses - les gouttes de cristal des myrtilles sur les buissons aux fleurs p&acirc;les, m&ecirc;l&eacute;es aux grappes de perles des m&ucirc;res rouges et jaunes, et les gouttes de pluie elles-m&ecirc;mes ressemblaient &agrave; des baies, qui d&eacute;coraient les arches d\'herbes et de laiches entrelac&eacute;es sur le bord des mares, chacune comme un miroir qui aurait refl&eacute;t&eacute; le paysage tout entier.</p>', '2019-08-21 23:52:59', '2019-08-22 17:45:00'),
(37, 'Jean-Forteroche', 'Jean-Forteroche', 'Une nuit fleurie', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/blog_Jean-Forteroche/public/images/2.jpg\" width=\"991\" height=\"708\" /></p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: left;\">Comme la nuit approchait, je redescendis en courant le long des pentes fleuries, revigor&eacute;. Le soleil couchant embrasait les nuages. On aurait dit que le monde entier venait de na&icirc;tre une seconde fois.</p>\r\n<p style=\"text-align: left;\">Chaque chose, m&ecirc;me la plus banale, paraissait &eacute;clair&eacute;e d\'un lumi&egrave;re nouvelle. Chaque plante, de la plus petite fleur aux plus grands arbres, semblait m&ecirc;ler sa joie &agrave; la mienne, tandis que chaque d&eacute;tail de la montagne, chacun de ses rochers, &eacute;pousaient mon all&eacute;gresse, comme s\'ils avaient su lire sur mon visage.</p>\r\n<p style=\"text-align: left;\">Comme la nuit approchait, je redescendis en courant le long des pentes fleuries, revigor&eacute;. Le soleil couchant embrasait les nuages. On aurait dit que le monde entier venait de na&icirc;tre une seconde fois.</p>\r\n<p style=\"text-align: left;\">Chaque chose, m&ecirc;me la plus banale, paraissait &eacute;clair&eacute;e d\'un lumi&egrave;re nouvelle. Chaque plante, de la plus petite fleur aux plus grands arbres, semblait m&ecirc;ler sa joie &agrave; la mienne, tandis que chaque d&eacute;tail de la montagne, chacun de ses rochers, &eacute;pousaient mon all&eacute;gresse, comme s\'ils avaient su lire sur mon visage.</p>\r\n<p style=\"text-align: left;\">Comme la nuit approchait, je redescendis en courant le long des pentes fleuries, revigor&eacute;. Le soleil couchant embrasait les nuages. On aurait dit que le monde entier venait de na&icirc;tre une seconde fois.</p>\r\n<p style=\"text-align: left;\">Chaque chose, m&ecirc;me la plus banale, paraissait &eacute;clair&eacute;e d\'un lumi&egrave;re nouvelle. Chaque plante, de la plus petite fleur aux plus grands arbres, semblait m&ecirc;ler sa joie &agrave; la mienne, tandis que chaque d&eacute;tail de la montagne, chacun de ses rochers, &eacute;pousaient mon all&eacute;gresse, comme s\'ils avaient su lire sur mon visage.</p>', '2019-08-22 00:44:24', '2019-08-22 17:44:53'),
(38, 'Jean-Forteroche', 'Jean-Forteroche', 'Des aigles, des lions de mer et des baleines', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/blog_Jean-Forteroche/public/images/3.jpg\" /></p>\r\n<p>&nbsp;</p>\r\n<p>La baie du Prince-William, dans le Golfe d&rsquo;Alaska, est le th&eacute;&acirc;tre d&rsquo;innombrables spectacles naturels. Les glaciers se parent de leur plus beau bleu et les bateaux vont et viennent, louvoyant entre des masses de glace aux versants abrupts.</p>\r\n<p>&Ccedil;&agrave; et l&agrave; nous saluent des aigles, des lions de mer et avec un peu de chance, des baleines &agrave; bosse. Les excursions en bateau dans le parc national de Kenai Fjords depuis Seward valent aussi le d&eacute;tour. Au menu : observation des baleines, randonn&eacute;es glaciaires et excursions sur Fox Island.&nbsp;</p>\r\n<p>La baie du Prince-William, dans le Golfe d&rsquo;Alaska, est le th&eacute;&acirc;tre d&rsquo;innombrables spectacles naturels. Les glaciers se parent de leur plus beau bleu et les bateaux vont et viennent, louvoyant entre des masses de glace aux versants abrupts.</p>\r\n<p>&Ccedil;&agrave; et l&agrave; nous saluent des aigles, des lions de mer et avec un peu de chance, des baleines &agrave; bosse. Les excursions en bateau dans le parc national de Kenai Fjords depuis Seward valent aussi le d&eacute;tour. Au menu : observation des baleines, randonn&eacute;es glaciaires et excursions sur Fox Island.&nbsp;</p>\r\n<p>La baie du Prince-William, dans le Golfe d&rsquo;Alaska, est le th&eacute;&acirc;tre d&rsquo;innombrables spectacles naturels. Les glaciers se parent de leur plus beau bleu et les bateaux vont et viennent, louvoyant entre des masses de glace aux versants abrupts.</p>\r\n<p>&Ccedil;&agrave; et l&agrave; nous saluent des aigles, des lions de mer et avec un peu de chance, des baleines &agrave; bosse. Les excursions en bateau dans le parc national de Kenai Fjords depuis Seward valent aussi le d&eacute;tour. Au menu : observation des baleines, randonn&eacute;es glaciaires et excursions sur Fox Island.&nbsp;</p>', '2019-08-22 00:51:27', '2019-09-04 10:54:25');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `authorIsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `datePublication` datetime NOT NULL,
  `authorEdit` varchar(255) DEFAULT NULL,
  `dateEdit` datetime DEFAULT NULL,
  `nbReport` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `idArticle`, `content`, `author`, `authorIsAdmin`, `datePublication`, `authorEdit`, `dateEdit`, `nbReport`) VALUES
(21, 36, 'Magnifique !', 'Léa', 0, '2019-08-22 18:02:43', NULL, NULL, 0),
(22, 36, 'A quand la suite !', 'jules', 0, '2019-08-22 18:03:38', NULL, NULL, 0),
(23, 38, 'J\'ai été en Alaska aussi, c\'est cool !', 'Robin', 0, '2019-08-22 18:06:32', NULL, NULL, 0),
(24, 38, 'blblblbBLBLBLlbLBlB', 'Mika', 0, '2019-08-22 18:09:45', NULL, NULL, 2),
(25, 38, '<p>Super, quand sort le prochain chapitre ?</p>', 'Léa', 0, '2019-08-22 18:15:45', 'Jean-Forteroche', '2019-09-04 11:52:36', 0),
(26, 38, 'Je publie un chapitre chaque semaines, le prochain sort bientot !', 'Jean Forteroche', 1, '2019-08-22 18:20:07', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idReportedComment` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateReport` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `report`
--

INSERT INTO `report` (`id`, `idReportedComment`, `author`, `content`, `dateReport`) VALUES
(32, 24, 'Léa', 'message inutile, c\'est juste du spam.', '2019-08-22 18:10:23'),
(33, 24, 'julien', 'spam.', '2019-08-22 18:12:58');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`) VALUES
(1, 'admin', '$2y$10$7pqPzJa0UFKpFTNYGePoeOJmX4QxO2wmZhw6c9oaJM01E0glRsOAa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
