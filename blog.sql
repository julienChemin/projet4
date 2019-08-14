-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 14 août 2019 à 12:41
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `author`, `author_edit`, `title`, `content`, `date_publication`, `date_edit`) VALUES
(1, 'julien', NULL, 'Premier title', 'Voici un premier article', '2019-08-01 15:05:16', NULL),
(4, 'julien', NULL, 'Deuxieme title', 'Voici un deuxieme article', '2019-08-02 00:45:32', NULL),
(5, 'julien', NULL, 'troisieme title', 'Voici un troisieme article', '2019-08-02 00:46:29', NULL),
(6, 'julien', NULL, 'un quatrieme article', '123456789 123456789', '2019-08-08 13:00:00', NULL),
(7, 'julien', NULL, '5eme article long', 'voici un article un peu longqui logiquement devrait faire plus de 30 carac. enfin bon, au cas ou je rajoute du blabla et bon bah la ca va quoi sans dec\' ont est forcement a plus de 30 carac !!\r\n\r\na+', '2019-08-08 14:20:00', NULL),
(8, 'Jean-Forteroche', NULL, '6eme article, test tinyMCE', '&lt;p&gt;6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE6eme article, test tinyMCE&lt;/p&gt;', '2019-08-14 09:59:17', NULL),
(9, 'Jean-Forteroche', NULL, '7eme', '&lt;p&gt;sdfsf s&lt;strong&gt;sdfsf&amp;nbsp;&lt;em&gt;sdfsdf&lt;/em&gt;&lt;/strong&gt;&lt;em&gt; sdfsdff&lt;/em&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;padding-left: 40px;&quot;&gt;zqdqdq&lt;/p&gt;\r\n&lt;p style=&quot;padding-left: 40px; text-align: center;&quot;&gt;feefefef&lt;/p&gt;\r\n&lt;h1 style=&quot;padding-left: 40px; text-align: center;&quot;&gt;blabal&lt;/h1&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2019-08-14 10:17:20', NULL),
(10, 'Jean-Forteroche', NULL, '8eme', '&lt;p&gt;j\'re test on sais jamais&lt;/p&gt;', '2019-08-14 10:17:33', NULL),
(11, 'Jean-Forteroche', NULL, '9e', '<p>plus de pbm htmlspecialchars</p>\r\n<p><strong>eqdqedq</strong></p>\r\n<p style=\"text-align: center;\"><strong>fe</strong><em>srfsfsfs</em></p>', '2019-08-14 10:22:58', NULL),
(12, 'Jean-Forteroche', NULL, '10', '<p><img src=\"C:\\wamp64\\www\\blog_Jean-Forteroche\\public\\images\\alaska.png\" alt=\"h\" /></p>\r\n<p>lu</p>', '2019-08-14 11:37:47', NULL),
(13, 'Jean-Forteroche', NULL, '11', '<p>l</p>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"public/images/alaska.png\" alt=\"lu\" width=\"1035\" height=\"380\" /></p>\r\n<p>okok</p>', '2019-08-14 11:39:05', NULL);

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
(6, 5, 'lu', '&lt;strong&gt; jul &lt;/strong&gt;', 0, '2019-08-09 13:29:33', NULL, NULL, 4),
(7, 5, '&lt;strong&gt; jul &lt;/strong&gt;', '&lt;strong&gt; jul &lt;/strong&gt;', 0, '2019-08-09 13:29:44', NULL, NULL, 0),
(8, 7, 'i', 'jul ', 0, '2019-08-11 18:52:19', NULL, NULL, 1),
(9, 7, 'k', '&lt;strong&gt; jul &lt;/strong&gt;', 0, '2019-08-12 18:19:51', NULL, NULL, 0),
(10, 7, 'test', 'c ladmin', 0, '2019-08-13 16:30:46', NULL, NULL, 0),
(11, 7, 're-test', 're ladmin', 1, '2019-08-13 16:32:29', NULL, NULL, 0),
(12, 7, 'ki', 'jul ', 0, '2019-08-13 17:06:47', NULL, NULL, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
(12, 8, 'jul', 'nul', '2019-08-11 18:56:43');

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
