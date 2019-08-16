-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 16 août 2019 à 12:48
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
  `author_edit` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `author`, `author_edit`, `title`, `content`, `date_publication`, `date_edit`) VALUES
(1, 'julien', NULL, 'Premier title', 'Voici un premier article', '2019-08-01 15:05:16', NULL),
(4, 'julien', NULL, 'Deuxieme title', 'Voici un deuxieme article', '2019-08-02 00:45:32', NULL),
(5, 'julien', NULL, 'troisieme title', 'Voici un troisieme article', '2019-08-02 00:46:29', NULL),
(33, 'Jean-Forteroche', NULL, 'dgf', '<p><img src=\"../../public/images/mceclip0.jpg\" /></p>', '2019-08-16 13:18:14', NULL),
(7, 'julien', 'Jean-Forteroche', '5eme article', '<p>voici un article un peu longqui l<strong>ogiquement de</strong>vrait faire plus de 30 carac. enfin bon, au cas ou je rajoute du blabla et bon bah la ca va quoi sans dec\' ont est forcement a plus de 30 carac !!..</p>', '2019-08-08 14:20:00', '2019-08-16 13:40:08'),
(34, 'Jean-Forteroche', NULL, 'fh', '<p><img src=\"http://localhost/blog_Jean-Forteroche/public/images/mceclip0.jpg\" /></p>', '2019-08-16 13:32:28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `date_publication` datetime NOT NULL,
  `author_edit` varchar(255) DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `nb_report` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_article`, `content`, `author`, `author_is_admin`, `date_publication`, `author_edit`, `date_edit`, `nb_report`) VALUES
(1, 7, 'premier test pour poster un commentaire.', 'juju', 0, '2019-08-08 21:20:19', NULL, NULL, 6),
(2, 7, 'deuxieme test', 'juju', 0, '2019-08-08 21:39:19', NULL, NULL, 1),
(3, 5, 'faut croire que ca fonctionne', 'juju', 0, '2019-08-08 21:56:47', NULL, NULL, 0),
(4, 1, 'un p\'ti test', 'lolita', 0, '2019-08-09 11:40:08', NULL, NULL, 0),
(5, 5, 'ku', 'jul ', 0, '2019-08-09 13:29:21', NULL, NULL, 0),
(6, 5, 'lu\r\n<p>edit : le pseudo ne doit pas contenir de balise html.</p>', 'jul', 0, '2019-08-09 13:29:33', 'Jean-Forteroche', '2019-08-16 11:43:42', 0),
(7, 5, '&lt;strong&gt; jul &lt;/strong&gt;', '&lt;strong&gt; jul &lt;/strong&gt;', 0, '2019-08-09 13:29:44', NULL, NULL, 0),
(8, 7, 'i', 'jul ', 0, '2019-08-11 18:52:19', NULL, NULL, 1),
(9, 7, 'k', '&lt;strong&gt; jul &lt;/strong&gt;', 0, '2019-08-12 18:19:51', NULL, NULL, 0),
(10, 7, 'test', 'c ladmin', 0, '2019-08-13 16:30:46', NULL, NULL, 0),
(11, 7, 're-test', 're ladmin', 1, '2019-08-13 16:32:29', NULL, NULL, 0),
(12, 7, 'ki', 'jul ', 0, '2019-08-13 17:06:47', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reported_comment` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_report` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `report`
--

INSERT INTO `report` (`id`, `id_reported_comment`, `author`, `content`, `date_report`) VALUES
(1, 6, 'jul', 'c\'est mon commentaire, j\'ai fail sur la balise strong.', '2019-08-09 21:16:00'),
(2, 6, 'julien', 'message &lt;strong&gt;chelou&lt;/strong&gt;.', '2019-08-09 21:18:13'),
(3, 6, 'julien', 'message &lt;strong&gt;chelou&lt;/strong&gt;.', '2019-08-09 21:18:57'),
(4, 6, 'julien', 'message &lt;strong&gt;chelou&lt;/strong&gt;.', '2019-08-09 21:21:10'),
(5, 1, 'jul', 'proute', '2019-08-09 21:28:34'),
(6, 1, 'jul', 'proute', '2019-08-09 21:29:44'),
(7, 1, 'jul', 'proute', '2019-08-09 21:29:46'),
(8, 1, 'jul', 'proute', '2019-08-09 21:29:47'),
(9, 1, 'jul', 'proute', '2019-08-09 21:29:51'),
(10, 1, 'jul', 'proute', '2019-08-09 21:29:53'),
(11, 2, 'jul', 'nul', '2019-08-10 13:24:11'),
(12, 8, 'jul', 'nul', '2019-08-11 18:56:43'),
(13, 12, 'jul', 'c nul', '2019-08-16 14:11:50');

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
