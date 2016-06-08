-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 08 Juin 2016 à 15:54
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `avelo`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(63) NOT NULL,
  `numero` varchar(7) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `cp` varchar(15) NOT NULL,
  `ville` varchar(127) NOT NULL,
  `pays` varchar(127) NOT NULL,
  `telephone` varchar(63) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `id_user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id`, `nom`, `numero`, `rue`, `cp`, `ville`, `pays`, `telephone`, `type`, `id_user`) VALUES
(1, 'Maison', '2', 'rue philippe kieffer', '68300', 'saint louis', 'France', '0101010101', 1, 3),
(5, 'test', '45', 'rue hhhh', '555555', 'mulhouse', 'france', '0101010101', 1, 1),
(6, 'maison', '52', 'bd du midi', '93340', 'le raincy', 'france', '0121211445', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contenu` varchar(511) NOT NULL,
  `note` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) unsigned NOT NULL,
  `id_produit` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(63) NOT NULL,
  `description` varchar(127) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `actif`) VALUES
(1, 'femme', 'Tous les velos pour femme', 1),
(2, 'homme', 'Tous les velos pour homme', 1),
(3, 'enfant', 'Tous les velos pour enfant', 1),
(4, 'test', 'ceci est un test de categorie', 0);

-- --------------------------------------------------------

--
-- Structure de la table `link_panier_produit`
--

CREATE TABLE IF NOT EXISTS `link_panier_produit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_panier` int(11) unsigned NOT NULL,
  `id_produit` int(11) unsigned NOT NULL,
  `quantite` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_panier` (`id_panier`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=391 ;

--
-- Contenu de la table `link_panier_produit`
--

INSERT INTO `link_panier_produit` (`id`, `id_panier`, `id_produit`, `quantite`) VALUES
(390, 42, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nbr_produits` int(2) NOT NULL DEFAULT '0',
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `prix` float NOT NULL DEFAULT '0',
  `poids` float NOT NULL DEFAULT '0',
  `id_user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id`, `date`, `nbr_produits`, `statut`, `prix`, `poids`, `id_user`) VALUES
(42, '2016-06-08 13:18:33', 1, 2, 621, 12, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(63) NOT NULL,
  `nom` varchar(63) NOT NULL,
  `description` varchar(511) NOT NULL,
  `prix` float NOT NULL,
  `tva` float NOT NULL,
  `photo` varchar(127) NOT NULL DEFAULT 'http://localhost/avelo/public/images/velo.jpg',
  `poids` float NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `stock` int(3) NOT NULL,
  `id_sous_categorie` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`,`nom`),
  KEY `id_sous_categorie` (`id_sous_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `reference`, `nom`, `description`, `prix`, `tva`, `photo`, `poids`, `actif`, `stock`, `id_sous_categorie`) VALUES
(1, 'velo-001', 'Velo champetre', 'le parfait velo pour partir en picnic', 500, 5.5, 'public/images/velo_ville_homme3.jpg', 10, 1, 12, 3),
(2, 'velo-002', 'Speed 2000', '0 a 30 en 5 secondes', 621, 5.5, 'public/images/vtt_homme2.jpg', 12, 1, 7, 5),
(3, 'velo-003', 'Super maxi velo', 'Un bon velo pour les gros', 432, 5.5, 'public/images/velo_ville_homme1.jpg', 23, 1, 10, 6),
(6, 'velo-enfant-01', 'VÃ©lo enfant toutmoche', 'le vÃ©lo parfait pour les enfants moches', 99, 5.5, 'http://i2.cdscdn.com/pdt2/2/6/3/1/300x300/mon25263/rw/les-minions-velo-12-pouces.jpg', 5, 1, 10, 7),
(7, '00001', 'VÃ©lo Reine des neiges', 'Un vÃ©lo bleue pour fille', 120, 20, 'http://i2.cdscdn.com/pdt2/6/0/1/1/300x300/vevefr1601/rw/reine-des-neiges-velo-5-8-ans-16-fille.jpg', 6, 1, 3, 9),
(8, '00002', 'VÃ©lo petit biker', 'VÃ©lo noir et rouge pour garÃ§on', 110, 20, 'http://i2.cdscdn.com/pdt2/0/1/s/1/300x300/veveng1601s/rw/velo-enfant-16-5-8-ans-garcon.jpg', 7, 1, 5, 9),
(9, '00003', 'VÃ©lo Minnie', 'VÃ©lo pour petite fan de Mickey', 125, 20, 'http://i2.cdscdn.com/pdt2/4/0/1/1/300x300/auc3663645002401/rw/velo-disney-minnie-20-pouces.jpg', 7, 1, 4, 9),
(10, '00004', 'XR VTT Femme', 'Rigide tout terrain', 140, 20, 'http://i2.cdscdn.com/pdt2/2/5/8/1/300x300/cf12258/rw/xr-vtt-rigide-xr-femme.jpg', 11, 1, 5, 1),
(16, '01215145', 'Velo pour les tout petits', 'Mon tout premier vÃ©lo pour faire comme papa', 250, 5.5, 'public/images/velo_garcon3.jpg', 8, 1, 10, 8),
(17, '00006', 'VÃ©lo fitness homme', 'VÃ©lo de course fitnessbike pour les gros qui veulent maigrir vite', 300, 20, 'http://i2.cdscdn.com/pdt2/8/6/8/1/300x300/ksc4250547520868/rw/velo-fitness-fixie-28-pegado-jaune-tc-53-cm.jpg', 20, 1, 3, 5),
(18, '00007', 'VÃ©lo cross', 'VÃ©lo tout suspendu pour plonger dans l''aventure', 260, 20, 'http://i2.cdscdn.com/pdt2/5/8/9/1/300x300/ksc4250547522589/rw/vtt-tout-suspendu-26-bliss-noir-orange-tc-47-cm.jpg', 21, 1, 5, 4),
(19, '00007', 'VÃ©lo VTT acier', 'vÃ©lo cross tout simple. Meilleur prix du marchÃ© !', 180, 20, 'http://i2.cdscdn.com/pdt2/0/k/0/1/300x300/y5a0k0/rw/micmo-vtt-26-acier-sword-i-homme.jpg', 19, 1, 10, 4),
(20, '00008', 'VÃ©lo citadin', 'Le vÃ©lo pour les masculinistes. Le panier c''est pas que pour les femmes !', 189, 20, 'http://i2.cdscdn.com/pdt2/3/6/9/1/300x300/cf11369/rw/route-66-vtc-calipso-mixte-noir.jpg', 17, 1, 3, 6),
(21, '00009', 'VÃ©lo ville-plage', 'Le vÃ©lo tout terrain pour femme trendy', 290, 20, 'http://i2.cdscdn.com/pdt2/m/b/m/1/300x300/216mbm/rw/mbm-velo-de-ville-trendy-femme.jpg', 16, 1, 6, 3),
(22, '00010', 'VÃ©lo Trax', 'VÃ©lo tout suspendu pour fan de sensations', 159, 20, 'http://i2.cdscdn.com/pdt2/2/6/0/1/300x300/cf12260/rw/trax-vtt-tout-suspendu-trax-femme.jpg', 17, 1, 7, 1),
(23, '00011', 'VÃ©lo roooose', 'Pour toutes celles qui ont du goÃ»t', 249, 20, 'http://i2.cdscdn.com/pdt2/7/8/4/1/300x300/ksc4250547523784/rw/velo-pour-dame-28-casino-6-vitesses-rose-tc-48-cm.jpg', 18, 1, 9, 3),
(24, '00012', 'VÃ©lo Violetta', 'T''es fan de Violetta ? Il te faut ce vÃ©lo !', 199, 20, 'http://i2.cdscdn.com/pdt2/8/7/0/1/300x300/dis8422084005870/rw/violetta-velo-enfant-fille-16-pouces-5-8-ans.jpg', 6, 1, 4, 9),
(25, '00014', 'VTT pour fille', 'VÃ©lo mignon tout suspendu', 149, 20, 'http://i2.cdscdn.com/pdt2/3/0/7/1/300x300/bac3700585509307/rw/vtt-20-tout-suspendu-fille-6-vitesses-avec-frein.jpg', 12, 1, 3, 7),
(26, '00015', 'Beach cruiser', 'VÃ©lo de course-route pour femme qui bouge', 349, 20, 'http://i2.cdscdn.com/pdt2/2/0/0/1/300x300/ele0601479225200/rw/beach-cruiser-electra-cruiser-7d-vert-femme.jpg', 18, 1, 7, 2),
(27, '00016', 'VÃ©lo Bombtrack', 'VÃ©lo de course-route pour femme qui a de l''argent', 689, 20, 'http://i2.cdscdn.com/pdt2/0/5/1/1/300x300/mp01694051/rw/bombtrack-oxbridge-velo-femme-women-vert.jpg', 17, 1, 4, 2),
(28, '00017', 'VÃ©lo hollandais', 'VÃ©lo bleu clair joli mignon', 259, 20, 'http://i2.cdscdn.com/pdt2/4/2/2/1/300x300/auc4052406142422/rw/ortler-detroit-velo-hollandais-bleu-clair.jpg', 15, 1, 6, 3),
(29, '00018', 'VÃ©lo style', 'VÃ©lo de ville pour homme', 234, 20, 'http://i2.cdscdn.com/pdt2/8/m/c/1/300x300/1328mc/rw/mgr-vtc-28-paris-homme.jpg', 19, 1, 6, 6),
(30, '00019', 'VÃ©lo abordable', 'VTT de base pour petit budget', 199, 20, 'http://i2.cdscdn.com/pdt2/6/8/0/1/300x300/spr3700585509680/rw/velo-vtt-tout-suspendu-axis-26-pouces-mixte.jpg', 19, 1, 8, 4),
(31, '00020', 'VÃ©lo Pat patrouille', 'Pour les gamins qu''ont pas la trouille', 109, 20, 'http://i2.cdscdn.com/pdt2/0/1/s/1/300x300/vevepp1401s/rw/pat-patrouille-velo-14-4-7-ans-garcon.jpg', 9, 1, 6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(63) NOT NULL,
  `description` varchar(127) NOT NULL,
  `id_categorie` int(11) unsigned NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `nom`, `description`, `id_categorie`, `actif`) VALUES
(1, 'vtt', 'tous les vtt femmes', 1, 1),
(2, 'course', 'velos de course femmes', 1, 1),
(3, 'ville', 'velos de ville femme', 1, 1),
(4, 'vtt', 'vtt hommes', 2, 1),
(5, 'course', 'velos de course hommes', 2, 1),
(6, 'ville', 'velos de ville hommes', 2, 1),
(7, 'vtt', 'vtt enfants', 3, 1),
(8, 'course', 'velos de course enfants', 3, 1),
(9, 'ville', 'velos de ville enfants', 3, 1),
(11, 'toto', 'je suis toto la sous cat', 4, 0),
(12, 'aaa', 'nsdf sd ojsdo fds sd', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(63) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prenom` varchar(63) NOT NULL,
  `nom` varchar(63) NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `login`, `password`, `prenom`, `nom`, `sexe`, `date_naissance`, `date_inscription`, `actif`, `admin`) VALUES
(1, 'admin@admin.com', 'admin', '$2y$08$lx4mx4gGVlp9ByfKHOy79e3v9Mv2GaZ03rcX4uqr.dvGiKz0.9wrC', 'philippe', 'dos santos', 1, '2000-10-01', '2016-05-27 13:47:02', 0, 0),
(2, 'germany@country.com', 'john', '$2y$08$psgkji7RojAaNabEjlpMT.eF5RCtawj6MlAizqKAW6.ygse74w.tm', 'John', 'Thegerman', 1, '1998-01-01', '2016-05-27 13:48:21', 1, 0),
(3, 'toto@toto.com', 'toto', '$2y$08$WFweU6bqC.ExSqAso80vw.CidTWm7pAtdzOM.JOHsHPSR20mQMkRi', 'toto', 'monsieurtoto', 1, '2000-01-01', '2016-05-27 14:10:40', 1, 1),
(4, 'client@yahoo.fr', 'client', '$2y$08$s2C9hh2n.6TBizrgppjC8eSRAAnp7IZdW8EKeychuxjeQT49.1Fxi', 'newclient', 'nomclient', 1, '2000-01-10', '2016-06-02 11:23:19', 1, 0),
(5, 'fil@yahoo.fr', 'filipe', '$2y$08$A1KC2WgNJviwHyn06I0KjuN0bIUyQ//AkXWWZmYQeJuloxJ1bMeC2', 'filipe', 'dossanros', 1, '1978-10-24', '2016-06-07 14:26:47', 1, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_panier_produit`
--
ALTER TABLE `link_panier_produit`
  ADD CONSTRAINT `link_panier_produit_ibfk_1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_panier_produit_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `sous_categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;