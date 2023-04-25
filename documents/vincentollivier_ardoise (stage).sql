-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mar. 25 avr. 2023 à 07:38
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vincentollivier_ardoise`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortName` varchar(20) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `categories_id` int(11) NOT NULL,
  `tva_spl` int(11) NOT NULL,
  `tva_emp` int(11) NOT NULL,
  `codebarre` varchar(15) NOT NULL COMMENT '13 chiffres',
  `activate` tinyint(1) NOT NULL DEFAULT '1',
  `screen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `shortName`, `picture`, `price`, `categories_id`, `tva_spl`, `tva_emp`, `codebarre`, `activate`, `screen_id`) VALUES
(1, 'HAMBURGER', 'HAMBURGER', 'hamberger.png', 4.5, 3, 2, 4, '1254254698244', 1, 1),
(2, 'COCA COLA', 'COCA COLA', 'cocacola.png', 1.7, 2, 2, 3, '9545458754985', 1, 2),
(3, 'HOT DOG', 'HOT-DOG', 'hotdog.png', 2.5, 3, 2, 4, '7545754641445', 0, 1),
(4, '3 FROMAGES', 'PIZZA 3 FRO', 'troisformages.png', 8.5, 5, 2, 4, '5243615456835', 1, 1),
(5, 'MAGNUM CHOCOLAT - VANILLE', 'MAGNUM C/V', 'magnumCV.png', 3.5, 6, 2, 4, '5336216849518', 1, 1),
(6, 'FONDANT CHOCOLAT', 'FONDANT. CH.', 'fondant.png', 3.4, 4, 2, 4, '1684955336242', 1, 1),
(7, 'RICARD', 'RICARD', 'ricard.png', 1.7, 1, 4, 4, '1955368436269', 1, 2),
(8, 'GALOPIN', 'GALOPIN', 'galopin.png', 1.5, 1, 4, 4, '5278956412362', 1, 2),
(9, 'HEINEKEN', 'HEINEKEN', 'heineken.png', 2, 1, 4, 4, '5213649872256', 1, 2),
(10, 'MONACO', 'MONACO', 'monaco.png', 2.6, 1, 4, 4, '8566932177455', 1, 2),
(11, 'WHISKY COCA', 'WHISKY COCA', 'whiskycoca.png', 4, 1, 4, 4, '6335214412978', 1, 2),
(12, 'COCA COLA LIGHT', 'COCA COLA LIGHT', 'cococolalight.png', 1.7, 2, 2, 3, '7514966933228', 1, 2),
(13, 'COCA COLA CHERRY', 'COCA COLA CH.', 'cocacolacherry.png', 1.7, 2, 2, 3, '9664872216325', 1, 2),
(14, 'ICE TEA', 'ICE TEA', 'icetea.png', 1.7, 2, 2, 3, '3633225846994', 1, 2),
(15, 'OASIS POMME CASSIS FRAMBOISE', 'OASIS P.C.F.', 'oasispcf.png', 1.7, 2, 2, 3, '7584221030120', 1, 2),
(16, 'CAFE', 'CAFE', 'cafe.png', 1.2, 8, 2, 3, '9556328845771', 1, 2),
(17, 'CAFE ALLONGE', 'CAFE ALLONGE', 'cafeallonge.png', 1.2, 8, 2, 3, '2366355482216', 1, 2),
(18, 'GRAND CAFE CREME', 'G. CAFE CREME', 'grandcafecreme.png', 2.5, 8, 2, 3, '2335514426897', 1, 2),
(19, 'CHOCOLAT CHAUD', 'CHOCOLAT CH.', 'chocolatchaud.png', 2.2, 8, 2, 3, '3663247291385', 1, 2),
(20, 'DECA', 'DECA', 'deca.png', 1.4, 8, 2, 3, '2201023054869', 1, 2),
(21, 'PANINI JAMBOON BLANC', 'PANINI J. BLANC', 'paninijambonblanc.png', 4, 3, 2, 4, '3266347997428', 1, 1),
(22, 'PANINI JAMBON CRU / MOZZARELLA', 'PANINI J. CRU / MZ', 'paninijamboncru.png', 4, 3, 2, 4, '3200310054968', 1, 1),
(23, 'ASSIETTE CORDON BLEU', 'ASSIETTE C. BLEU', 'assiettecordonbleu.png', 9, 3, 2, 4, '9871593574562', 1, 1),
(24, 'ASSIETTE AMERICAIN2', 'ASS. AMERICAIN2', 'noPicture.png', 9.2, 3, 2, 4, '1542367252296', 1, 1),
(25, 'VIANDE / FRITES', 'VIANDE / FRITES', 'viandefrites.png', 5, 10, 2, 4, '3525569698694', 1, 1),
(26, 'NUGGETS / FRITES', 'NUGGETS / FRITES', 'nuggetsfrites.png', 5, 10, 2, 4, '1542544204600', 1, 1),
(27, 'POULET / FRITES', 'POULET / FRITES', 'pouletfrites.png', 5, 10, 2, 4, '4562558759621', 1, 1),
(28, 'TEST ESSAI', 'TEST', 'noPicture.png', 28.99, 1, 4, 3, '7584213690285', 1, 2),
(29, 'TEST ESSAI 2', 'TEST 2', 'noPicture.png', 0.2, 1, 1, 2, '7125050463289', 1, 2),
(30, 'DFGSHDF', 'DFHRT', 'noPicture.png', 0.34, 1, 1, 2, '7451152469385', 1, 1),
(31, 'ERTH', 'ERTY', 'noPicture.png', 0.07, 1, 1, 3, '7894565415645', 1, 2),
(32, 'FRITES', 'FRIT.', 'noPicture.png', 0.04, 10, 1, 1, '2222222222222', 1, 1),
(33, 'COCA COLA ZéRO', 'COCA ZéRO', '642ea20567b13-Quebec_citadelles_200x200.png', 1, 1, 1, 1, '1111111111111', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `articlesOptions`
--

CREATE TABLE `articlesOptions` (
  `id` int(11) NOT NULL,
  `articlesOptionsListing_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articlesOptions`
--

INSERT INTO `articlesOptions` (`id`, `articlesOptionsListing_id`, `articles_id`) VALUES
(3, 3, 1),
(5, 6, 1),
(15, 7, 26),
(16, 6, 26),
(17, 6, 26),
(23, 9, 16),
(24, 2, 24),
(29, 7, 24),
(30, 7, 3),
(31, 10, 24),
(32, 7, 16),
(33, 8, 16),
(37, 10, 23),
(44, 2, 23),
(48, 9, 1),
(49, 10, 4),
(50, 10, 1),
(51, 7, 1),
(52, 1, 1),
(53, 2, 1),
(54, 9, 23),
(55, 4, 23),
(56, 12, 23);

-- --------------------------------------------------------

--
-- Structure de la table `articlesOptionsListing`
--

CREATE TABLE `articlesOptionsListing` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortName` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `picture` varchar(150) NOT NULL,
  `categoriesCondiments_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articlesOptionsListing`
--

INSERT INTO `articlesOptionsListing` (`id`, `name`, `shortName`, `price`, `picture`, `categoriesCondiments_id`) VALUES
(1, 'SALADE', 'S', 0, 'salade.png', 2),
(2, 'TOMATES', 'T', 0, 'tomates.png', 2),
(3, 'OIGNONS', 'O', 0, 'oignons.png', 2),
(4, 'SUPPLEMENT FROMAGE', '++F', 1.5, 'supfromage.png', 3),
(5, 'SUPPLEMENT FRITES', '++F', 1.5, 'supplfrites.png', 3),
(6, 'MAYONNAISE', 'M', 0, 'mayonnaise.png', 1),
(7, 'KETCHUP', 'K', 0, 'ketchup.png', 1),
(8, 'MOUTARDE', 'mout', 0, 'mayonnaise.png', 1),
(9, 'ALGERIENNE', 'MAYO', 2, 'mayonnaise.png', 1),
(10, 'BARBECUE', 'MAYO', 2, 'ketchup.png', 1),
(11, 'COCKTAIL', 'MAYO', 2, 'mayonnaise.png', 1),
(12, 'PATATOS', 'MAYONAISE', 2, 'mayonnaise.png', 1),
(13, 'CORNICHON', 'COR', 0.04, 'noPicture.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `catCondiments`
--

CREATE TABLE `catCondiments` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `catCondiments`
--

INSERT INTO `catCondiments` (`id`, `name`) VALUES
(1, 'SAUCES'),
(2, 'CONDIMENTS'),
(3, 'AUTRES');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`, `activate`) VALUES
(1, 'ALCOOL', 'alcool.png', 0),
(2, 'SANS ALCOOL', 'no_alcool.png', 1),
(3, 'SANDWICHS', 'sandwichs.png', 1),
(4, 'DESSERTS', 'desserts.png', 1),
(5, 'PIZZAS', 'pizzas.png', 1),
(6, 'GLACES', 'glaces.png', 0),
(7, 'SALADES', 'salades.png', 1),
(8, 'BOISSONS CHAUDES', 'boissonschaudes.png', 1),
(9, 'CREPES', 'crepes.png', 0),
(10, 'MENUS ENFANTS', 'menusenfants.png', 1),
(11, 'EVENEMENTS', 'evenements.png', 0),
(12, 'ALIMENTATION DIVERS', 'alim.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Afrique du Sud'),
(3, 'Albanie'),
(4, 'Algérie'),
(5, 'Allemagne'),
(6, 'Andorre'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antigua-et-Barbuda'),
(10, 'Antilles Néerlandaises'),
(11, 'Arabie Saoudite'),
(12, 'Argentine'),
(13, 'Arménie'),
(14, 'Aruba'),
(15, 'Australie'),
(16, 'Autriche'),
(17, 'Azerbaïdjan'),
(18, 'Bahamas'),
(19, 'Bahreïn'),
(20, 'Bangladesh'),
(21, 'Barbade'),
(22, 'Belgique'),
(23, 'Belize'),
(24, 'Bénin'),
(25, 'Bermudes'),
(26, 'Bhoutan'),
(27, 'Biélorussie'),
(28, 'Birmanie (Myanmar)'),
(29, 'Bolivie'),
(30, 'Bosnie-Herzégovine'),
(31, 'Botswana'),
(32, 'Brésil'),
(33, 'Brunei'),
(34, 'Bulgarie'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Cambodge'),
(38, 'Cameroun'),
(39, 'Canada'),
(40, 'Cap-vert'),
(41, 'Chili'),
(42, 'Chine'),
(43, 'Chypre'),
(44, 'Colombie'),
(45, 'Comores'),
(46, 'Corée du Nord'),
(47, 'Corée du Sud'),
(48, 'Costa Rica'),
(49, 'Côte d\'Ivoire'),
(50, 'Croatie'),
(51, 'Cuba'),
(52, 'Danemark'),
(53, 'Djibouti'),
(54, 'Dominique'),
(55, 'Égypte'),
(56, 'Émirats Arabes Unis'),
(57, 'Équateur'),
(58, 'Érythrée'),
(59, 'Espagne'),
(60, 'Estonie'),
(61, 'États Fédérés de Micronésie'),
(62, 'États-Unis'),
(63, 'Éthiopie'),
(64, 'Fidji'),
(65, 'Finlande'),
(66, 'France'),
(67, 'Gabon'),
(68, 'Gambie'),
(69, 'Géorgie'),
(70, 'Géorgie du Sud et les Îles Sandwich du Sud'),
(71, 'Ghana'),
(72, 'Gibraltar'),
(73, 'Grèce'),
(74, 'Grenade'),
(75, 'Groenland'),
(76, 'Guadeloupe'),
(77, 'Guam'),
(78, 'Guatemala'),
(79, 'Guinée'),
(80, 'Guinée Équatoriale'),
(81, 'Guinée-Bissau'),
(82, 'Guyana'),
(83, 'Guyane Française'),
(84, 'Haïti'),
(85, 'Honduras'),
(86, 'Hong-Kong'),
(87, 'Hongrie'),
(88, 'Île Christmas'),
(89, 'Île de Man'),
(90, 'Île Norfolk'),
(91, 'Îles Åland'),
(92, 'Îles Caïmanes'),
(93, 'Îles Cocos (Keeling)'),
(94, 'Îles Cook'),
(95, 'Îles Féroé'),
(96, 'Îles Malouines'),
(97, 'Îles Mariannes du Nord'),
(98, 'Îles Marshall'),
(99, 'Îles Pitcairn'),
(100, 'Îles Salomon'),
(101, 'Îles Turks et Caïques'),
(102, 'Îles Vierges Britanniques'),
(103, 'Îles Vierges des États-Unis'),
(104, 'Inde'),
(105, 'Indonésie'),
(106, 'Iran'),
(107, 'Iraq'),
(108, 'Irlande'),
(109, 'Islande'),
(110, 'Israël'),
(111, 'Italie'),
(112, 'Jamaïque'),
(113, 'Japon'),
(114, 'Jordanie'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kirghizistan'),
(118, 'Kiribati'),
(119, 'Koweït'),
(120, 'Laos'),
(121, 'Le Vatican'),
(122, 'Lesotho'),
(123, 'Lettonie'),
(124, 'Liban'),
(125, 'Libéria'),
(126, 'Libye'),
(127, 'Liechtenstein'),
(128, 'Lituanie'),
(129, 'Luxembourg'),
(130, 'Macao'),
(131, 'Madagascar'),
(132, 'Malaisie'),
(133, 'Malawi'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malte'),
(137, 'Maroc'),
(138, 'Martinique'),
(139, 'Maurice'),
(140, 'Mauritanie'),
(141, 'Mayotte'),
(142, 'Mexique'),
(143, 'Moldavie'),
(144, 'Monaco'),
(145, 'Mongolie'),
(146, 'Monténégro'),
(147, 'Montserrat'),
(148, 'Mozambique'),
(149, 'Namibie'),
(150, 'Nauru'),
(151, 'Népal'),
(152, 'Nicaragua'),
(153, 'Niger'),
(154, 'Nigéria'),
(155, 'Niué'),
(156, 'Norvège'),
(157, 'Nouvelle-Calédonie'),
(158, 'Nouvelle-Zélande'),
(159, 'Oman'),
(160, 'Ouganda'),
(161, 'Ouzbékistan'),
(162, 'Pakistan'),
(163, 'Palaos'),
(164, 'Panama'),
(165, 'Papouasie-Nouvelle-Guinée'),
(166, 'Paraguay'),
(167, 'Pays-Bas'),
(168, 'Pérou'),
(169, 'Philippines'),
(170, 'Pologne'),
(171, 'Polynésie Française'),
(172, 'Porto Rico'),
(173, 'Portugal'),
(174, 'Qatar'),
(175, 'République Centrafricaine'),
(176, 'République de Macédoine'),
(177, 'République Démocratique du Congo'),
(178, 'République Dominicaine'),
(179, 'République du Congo'),
(180, 'République Tchèque'),
(181, 'Réunion'),
(182, 'Roumanie'),
(183, 'Royaume-Uni'),
(184, 'Russie'),
(185, 'Rwanda'),
(186, 'Saint-Kitts-et-Nevis'),
(187, 'Saint-Marin'),
(188, 'Saint-Pierre-et-Miquelon'),
(189, 'Saint-Vincent-et-les Grenadines'),
(190, 'Sainte-Hélène'),
(191, 'Sainte-Lucie'),
(192, 'Salvador'),
(193, 'Samoa'),
(194, 'Samoa Américaines'),
(195, 'Sao Tomé-et-Principe'),
(196, 'Sénégal'),
(197, 'Serbie'),
(198, 'Seychelles'),
(199, 'Sierra Leone'),
(200, 'Singapour'),
(201, 'Slovaquie'),
(202, 'Slovénie'),
(203, 'Somalie'),
(204, 'Soudan'),
(205, 'Sri Lanka'),
(206, 'Suède'),
(207, 'Suisse'),
(208, 'Suriname'),
(209, 'Svalbard et Jan Mayen'),
(210, 'Swaziland'),
(211, 'Syrie'),
(212, 'Tadjikistan'),
(213, 'Taïwan'),
(214, 'Tanzanie'),
(215, 'Tchad'),
(216, 'Terres Australes Françaises'),
(217, 'Thaïlande'),
(218, 'Timor Oriental'),
(219, 'Togo'),
(220, 'Tonga'),
(221, 'Trinité-et-Tobago'),
(222, 'Tunisie'),
(223, 'Turkménistan'),
(224, 'Turquie'),
(225, 'Tuvalu'),
(226, 'Ukraine'),
(227, 'Uruguay'),
(228, 'Vanuatu'),
(229, 'Venezuela'),
(230, 'Viet Nam'),
(231, 'Wallis et Futuna'),
(232, 'Yémen'),
(233, 'Zambie'),
(234, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `valids_id` int(11) NOT NULL DEFAULT '2',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastConnection` datetime DEFAULT NULL,
  `roles_id` int(11) NOT NULL DEFAULT '1',
  `rfid` varchar(10) DEFAULT NULL COMMENT '10 chiffres'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `lastname`, `firstname`, `birthday`, `email`, `password`, `valids_id`, `createdAt`, `lastConnection`, `roles_id`, `rfid`) VALUES
(1, 'Inconnu', 'Inconnu', '2000-01-08', 'Inconnu@hotmail.fr', '$2y$10$MNqeDs4suXmdiLpGcHDHDO5yPf82fRw.quJR65ucTDTtQWURE7rju', 2, '2022-08-02 17:13:28', NULL, 1, NULL),
(2, 'DUPOND', 'Jean-Pierre', '2000-08-01', 'dupond.jean.pierre@hotmail.fr', '$2y$10$AxrzLuSGrh.oinIgeUy9duZGvs4e1NzNjinxg9UxDvBvFxOGPazJy', 2, '2022-08-03 09:42:18', NULL, 1, '0725103125'),
(3, 'VERT', 'Paul', '1978-05-18', 'vert.paul@gmail.com', '$2y$10$SqDR7HmtUm9UHpybsDHWQufN9Gtgnq2E2gj3OMSyZ6etmEvJ93Doi', 2, '2022-08-04 14:17:53', NULL, 1, '1255042549'),
(4, 'ROUGE', 'Marie', '1974-02-21', 'rouge.marie@gmail.fr', '$2y$10$epo8uEZh.tvvPxLxvxk1d.Emxi/Olr96.2sR/aEUWJnmeaqEtr/nm', 2, '2022-08-04 14:21:54', NULL, 1, '7588243699'),
(5, 'BLEU', 'Marc', '1990-09-29', 'bleu.marc@hotmail.fr', '$2y$10$8LK5SO9OAWRCM2WXG52Hz.z8iogNZnQcGSGczLjr.JD5FOBJ90Vei', 3, '2022-08-04 14:23:03', NULL, 1, '9335211754'),
(6, 'ORANGE', 'Sophie', '1997-12-15', 'orange.sophie@gmail.com', '$2y$10$JahAJwA4z2n8zz0fOfwVce18PLZsr34tel0yxnTJqsks3kEVhLNCK', 2, '2022-08-04 14:24:29', NULL, 1, NULL),
(7, 'JAUNE', 'Sebastien', '2001-03-08', 'jaune.sebastien@yahoo.fr', '$2y$10$mN07f944r8q1vEUcOG/2Eef8TF3998SeqyG8WnxWhUwW0w1OVaeI.', 3, '2022-08-04 14:26:34', NULL, 1, NULL),
(8, 'VIOLET', 'Emilie', '2002-05-07', 'violet.emilie@hotmail.fr', '$2y$10$m49Ivlr6pxC1cTtb/K7X.uOml.sUWTLDNsEhdBmnH9qMmtoZrnPQ2', 1, '2022-08-04 14:28:35', NULL, 1, NULL),
(9, 'BLANC', 'Stéphane', '1982-11-03', 'blanc.stephane@hotmail.fr', '$2y$10$gigxap/zlRRGKvGVWTjyiOFB9UN9F7gIKrXGKAYucPzT.dnUAgvY6', 2, '2022-08-04 14:30:08', NULL, 1, NULL),
(17, 'ROGER', 'Pamela', '1978-08-19', 'pamela@qdfsg.qdfgs', '$2y$10$bq3Gr7RALfxuiRxKlSQGCu/fVxuhsQ92aIa.LqJlNJWiYD1YKn5CO', 2, '2022-08-30 15:08:07', NULL, 1, ''),
(25, 'DFGHDF', 'Dfghdfh', '1978-12-13', 'dsfsdfsf@dfgs.fr', '$2y$10$DswzSss6fK4vitWBwU0C2OIYy0nIzfTMI7CQZodhJHm7ZDSp8mOe2', 2, '2022-12-14 12:00:42', NULL, 1, ''),
(26, 'ERTHYERZT', 'Ztryzert', '1978-08-19', 'erszthy@dfsg.fr', '$2y$10$WMjkqAAWf7u3a9HAxVeh1.Nznl82dkapw13DZ6sm9Si8PeRo/Ct/q', 1, '2022-12-14 12:04:41', NULL, 1, '1234567890');

-- --------------------------------------------------------

--
-- Structure de la table `customersDetails`
--

CREATE TABLE `customersDetails` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `customers_id` int(11) NOT NULL,
  `adress` varchar(250) DEFAULT NULL,
  `zipcode` varchar(6) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customersDetails`
--

INSERT INTO `customersDetails` (`id`, `country_id`, `customers_id`, `adress`, `zipcode`, `city`) VALUES
(8, 66, 26, '32 Route de la gloire', '35000', 'Nantes'),
(9, 66, 25, '28 Impasse Pablo Picasso', '35500', 'Nantes'),
(10, 66, 4, '32 Route de la gloire', '35000', 'Montreuil-le-Gast'),
(11, 66, 17, '32 Route de la gloire', '07850', 'Nantes');

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `priceOffers` float NOT NULL,
  `orders_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offers`
--

INSERT INTO `offers` (`id`, `priceOffers`, `orders_id`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operators`
--

CREATE TABLE `operators` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL COMMENT 'Mot de passe d''accès au logiciel.',
  `avatar` varchar(150) NOT NULL COMMENT 'Image d''avatar présente dans un dossier d''images "uploads/operateurs"',
  `roles_id` int(11) NOT NULL COMMENT 'ADMIN, USER, SUPER ADMIN',
  `valids_id` int(11) NOT NULL DEFAULT '2',
  `code` varchar(150) NOT NULL COMMENT 'Code à 6 chiffres hashé lorsque le logiciel est en pause.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `operators`
--

INSERT INTO `operators` (`id`, `lastname`, `firstname`, `email`, `password`, `avatar`, `roles_id`, `valids_id`, `code`) VALUES
(1, 'ROGER', 'Micke', 'argon71@hotmail.fr', '$2y$10$/1ZyAI1oWxj0ABQiQ9Q2ResFYKOn1oeEIzn4JMCzveNTrZU0DXnqe', 'avatar.png', 4, 2, '$2y$10$/1ZyAI1oWxj0ABQiQ9Q2ResFYKOn1oeEIzn4JMCzveNTrZU0DXnqe');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `paymentMethod_id` int(11) NOT NULL COMMENT 'La méthode de paiement utilisée par le client ( CB, ESPECES, ... )',
  `receiveMode_id` int(11) NOT NULL COMMENT 'Moyenne utilisé par le client pour nous faire parvenir sa commande ( sur place, à emporter, à livrer, ... )',
  `receiptMode_id` int(11) NOT NULL COMMENT 'Mode de réception de la commande par le client ( A emporter, A livrer, Sur place )',
  `tables_id` int(11) DEFAULT NULL COMMENT 'Le numéro de la table si consommation sur place',
  `dateTaken` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de la prise de la commande',
  `dateStart` datetime DEFAULT NULL COMMENT 'Date de commencement de la commande pour permettre les calculs de temps d''attente',
  `dateEnd` datetime DEFAULT NULL COMMENT 'Date de fin de préparation de la commande.',
  `total` float NOT NULL COMMENT 'Total en € de la commande',
  `given` float DEFAULT NULL COMMENT 'Somme donnée par le client pour payer la commande',
  `rendu` float DEFAULT NULL COMMENT 'Somme rendu par le restaurateur',
  `paymentStatus` tinyint(1) NOT NULL COMMENT 'Etat du règlement de la commande ( true = réglée, false = En attente de règlement )',
  `finalStatut` tinyint(1) NOT NULL COMMENT 'Etat final de la commande ( true = Commande terminée, false = Commande en cours )',
  `operators_id` int(11) NOT NULL,
  `withLater` tinyint(1) DEFAULT NULL,
  `art_screen_1` tinyint(1) DEFAULT NULL,
  `art_screen_2` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `customers_id`, `paymentMethod_id`, `receiveMode_id`, `receiptMode_id`, `tables_id`, `dateTaken`, `dateStart`, `dateEnd`, `total`, `given`, `rendu`, `paymentStatus`, `finalStatut`, `operators_id`, `withLater`, `art_screen_1`, `art_screen_2`) VALUES
(1, 2, 1, 1, 3, 1, '2022-09-07 21:44:02', '2022-10-02 20:54:56', '2022-10-02 20:56:38', 15.5, 15.5, NULL, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 2, '2023-04-21 21:56:02', '2022-12-20 09:54:17', '2022-12-20 09:55:05', 9.7, 10, 0.3, 1, 1, 1, 1, 1, 1),
(3, 2, 1, 1, 2, 1, '2022-09-07 22:08:01', '2023-02-15 14:59:21', '2023-02-15 14:59:45', 14.1, 14.1, NULL, 1, 1, 1, 0, 1, 1),
(4, 9, 1, 1, 1, 3, '2023-04-20 22:13:46', '2023-02-15 15:57:05', '2023-02-15 15:57:33', 23.9, 23.9, NULL, 1, 1, 1, 1, 1, 1),
(5, 17, 2, 1, 1, 4, '2022-09-08 09:24:46', '2023-02-16 14:48:36', '2023-02-16 14:51:22', 8.9, 20, 11.1, 1, 1, 1, 0, 1, 1),
(6, 7, 3, 2, 2, 1, '2022-09-09 08:54:07', '2023-03-07 10:42:28', '2023-03-07 10:43:08', 13.5, 13.5, NULL, 1, 1, 1, 0, 1, 1),
(7, 7, 3, 2, 2, 3, '2022-10-02 19:28:07', NULL, NULL, 1.7, 1.7, NULL, 1, 0, 1, 0, 0, 1),
(8, 7, 2, 2, 2, 2, '2023-04-24 11:37:09', NULL, NULL, 9, 10, 1, 0, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ordersDetails`
--

CREATE TABLE `ordersDetails` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitary_price` float NOT NULL,
  `tva` float NOT NULL,
  `postponed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Article remis plus tard ( notamment les glaces, ... )',
  `details` varchar(250) DEFAULT NULL,
  `finalize` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ordersDetails`
--

INSERT INTO `ordersDetails` (`id`, `orders_id`, `article_id`, `quantity`, `unitary_price`, `tva`, `postponed`, `details`, `finalize`) VALUES
(1, 1, 1, 1, 4.5, 20, 0, '[-T-0] M K', 0),
(2, 1, 2, 2, 1.7, 20, 0, NULL, 0),
(3, 1, 6, 1, 3.4, 20, 1, NULL, 0),
(4, 3, 4, 1, 9, 20, 0, NULL, 0),
(5, 2, 24, 1, 6.5, 20, 0, '[Nature] SB', 0),
(6, 4, 23, 2, 9, 20, 0, 'K M', 0),
(7, 4, 14, 2, 1.7, 20, 0, NULL, 0),
(8, 4, 18, 1, 2.5, 20, 1, NULL, 0),
(9, 3, 13, 3, 1.7, 20, 0, NULL, 0),
(10, 1, 9, 2, 1, 20, 0, NULL, 0),
(11, 1, 5, 1, 2.2, 20, 0, NULL, 0),
(12, 2, 9, 1, 1, 20, 0, NULL, 0),
(13, 2, 5, 1, 2.2, 20, 1, NULL, 0),
(14, 5, 22, 1, 5, 20, 0, NULL, 0),
(15, 5, 12, 1, 1.7, 20, 0, NULL, 0),
(16, 5, 5, 1, 2.2, 20, 0, NULL, 0),
(17, 6, 23, 1, 9, 20, 0, 'SB Mout', 0),
(18, 6, 9, 1, 2, 20, 0, NULL, 0),
(19, 6, 5, 1, 2.5, 20, 0, NULL, 0),
(20, 7, 2, 1, 1.7, 20, 0, NULL, 0),
(21, 8, 24, 1, 9, 20, 0, 'K SB M', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ordersOptions`
--

CREATE TABLE `ordersOptions` (
  `id` int(11) NOT NULL,
  `ordersDetails_id` int(11) NOT NULL,
  `articleOptionsListing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ordersOptions`
--

INSERT INTO `ordersOptions` (`id`, `ordersDetails_id`, `articleOptionsListing_id`) VALUES
(1, 1, 1),
(2, 1, 7),
(3, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `paymentMethod`
--

CREATE TABLE `paymentMethod` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paymentMethod`
--

INSERT INTO `paymentMethod` (`id`, `name`, `activate`, `icon`) VALUES
(1, 'CB', 1, '<i class=\"fa-regular fa-credit-card\"></i>'),
(2, 'ESPECE', 1, '<i class=\"fa-solid fa-money-bill-1-wave\"></i>'),
(3, 'CHEQUE', 0, '<i class=\"fa-solid fa-money-check\"></i>'),
(4, 'PAYPAL', 1, '<i class=\"fa-brands fa-paypal\"></i>'),
(5, 'VIREMENT', 1, '<i class=\"fa-solid fa-money-bill-transfer\"></i>');

-- --------------------------------------------------------

--
-- Structure de la table `receiptOrders`
--

CREATE TABLE `receiptOrders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `receiptOrders`
--

INSERT INTO `receiptOrders` (`id`, `name`, `description`) VALUES
(1, 'SUR PLACE', 'Le client mange sur place.'),
(2, 'A EMPORTER', 'Le client emporte sa commande.'),
(3, 'A LIVRER', 'Il faut livrer la commande.');

-- --------------------------------------------------------

--
-- Structure de la table `receiveMode`
--

CREATE TABLE `receiveMode` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `receiveMode`
--

INSERT INTO `receiveMode` (`id`, `name`, `description`) VALUES
(1, 'SUR PLACE', 'Le client est venu sur place pour prendre sa commande'),
(2, 'PAR TELEPHONE', 'Le client a commandé par téléphone'),
(3, 'PAR INTERNET', 'Le client a commandé par internet');

-- --------------------------------------------------------

--
-- Structure de la table `reductions`
--

CREATE TABLE `reductions` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `reductionPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reductions`
--

INSERT INTO `reductions` (`id`, `orders_id`, `reductionPrice`) VALUES
(1, 2, 5),
(2, 1, 1.7),
(3, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'USER'),
(2, 'ADMIN'),
(3, 'SUPER ADMIN'),
(4, 'GESTIONNAIRE');

-- --------------------------------------------------------

--
-- Structure de la table `saveAcces`
--

CREATE TABLE `saveAcces` (
  `id` int(11) NOT NULL,
  `operators_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `saveAccesActivite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `saveAcces`
--

INSERT INTO `saveAcces` (`id`, `operators_id`, `date`, `saveAccesActivite_id`) VALUES
(6, 1, '2022-07-29 09:14:39', 1),
(7, 1, '2022-07-29 09:19:14', 2),
(8, 1, '2022-07-29 09:28:53', 3);

-- --------------------------------------------------------

--
-- Structure de la table `saveAccesActivity`
--

CREATE TABLE `saveAccesActivity` (
  `id` int(11) NOT NULL,
  `wording` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `saveAccesActivity`
--

INSERT INTO `saveAccesActivity` (`id`, `wording`) VALUES
(1, 'CONNEXION AU LOGICIEL'),
(2, 'ACCES PARAMETRES'),
(3, 'DECONNEXION AU LOGICIEL');

-- --------------------------------------------------------

--
-- Structure de la table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `screens`
--

INSERT INTO `screens` (`id`, `name`) VALUES
(1, 'Cuisine'),
(2, 'Bar');

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tables`
--

INSERT INTO `tables` (`id`, `name`) VALUES
(1, 'PAS DE TABLE'),
(2, 'TABLE 1'),
(3, 'TABLE 2'),
(4, 'TABLE 3');

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

CREATE TABLE `tva` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` float NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`id`, `name`, `value`, `activate`) VALUES
(1, '2.1%', 2.1, 1),
(2, '5.5%', 5.5, 0),
(3, '10%', 10, 1),
(4, '20%', 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `valids`
--

CREATE TABLE `valids` (
  `id` int(11) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `valids`
--

INSERT INTO `valids` (`id`, `statut`, `comment`) VALUES
(1, 'COMPTE À ACTIVER', 'Votre compte n\'a pas encore été validé par un administrateur !'),
(2, 'COMPTE ACTIF', 'Compte validé et activé'),
(3, 'COMPTE SUSPENDU', 'Votre compte a été suspendu par un administrateur !');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `art_category` (`categories_id`),
  ADD KEY `art_tva_spl` (`tva_spl`),
  ADD KEY `art_tva_emp` (`tva_emp`),
  ADD KEY `screem` (`screen_id`);

--
-- Index pour la table `articlesOptions`
--
ALTER TABLE `articlesOptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_ibfk_1` (`articles_id`),
  ADD KEY `opt_list_id` (`articlesOptionsListing_id`);

--
-- Index pour la table `articlesOptionsListing`
--
ALTER TABLE `articlesOptionsListing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_name` (`name`),
  ADD KEY `opt_suppl_ category` (`categoriesCondiments_id`);

--
-- Index pour la table `catCondiments`
--
ALTER TABLE `catCondiments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_valid` (`valids_id`),
  ADD KEY `role` (`roles_id`);

--
-- Index pour la table `customersDetails`
--
ALTER TABLE `customersDetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_details_id_customer` (`customers_id`),
  ADD KEY `cus_details_country` (`country_id`);

--
-- Index pour la table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Index pour la table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`roles_id`),
  ADD KEY `user_valid` (`valids_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ord_payment_method` (`paymentMethod_id`),
  ADD KEY `orders_ibfk_2` (`receiveMode_id`),
  ADD KEY `ord_receipt_mode` (`receiptMode_id`),
  ADD KEY `ord_id_user` (`operators_id`),
  ADD KEY `ord_table` (`tables_id`),
  ADD KEY `ord_rfid` (`customers_id`);

--
-- Index pour la table `ordersDetails`
--
ALTER TABLE `ordersDetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `det_id_order` (`orders_id`),
  ADD KEY `det_id_article` (`article_id`);

--
-- Index pour la table `ordersOptions`
--
ALTER TABLE `ordersOptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_ord_order_id` (`ordersDetails_id`),
  ADD KEY `otp_no_select` (`articleOptionsListing_id`);

--
-- Index pour la table `paymentMethod`
--
ALTER TABLE `paymentMethod`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `receiptOrders`
--
ALTER TABLE `receiptOrders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `receiveMode`
--
ALTER TABLE `receiveMode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reductions`
--
ALTER TABLE `reductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `saveAcces`
--
ALTER TABLE `saveAcces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `save_id_user` (`operators_id`),
  ADD KEY `saveAccesActivite_id` (`saveAccesActivite_id`);

--
-- Index pour la table `saveAccesActivity`
--
ALTER TABLE `saveAccesActivity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tva`
--
ALTER TABLE `tva`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `valids`
--
ALTER TABLE `valids`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `articlesOptions`
--
ALTER TABLE `articlesOptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `articlesOptionsListing`
--
ALTER TABLE `articlesOptionsListing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `catCondiments`
--
ALTER TABLE `catCondiments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `customersDetails`
--
ALTER TABLE `customersDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ordersDetails`
--
ALTER TABLE `ordersDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `ordersOptions`
--
ALTER TABLE `ordersOptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paymentMethod`
--
ALTER TABLE `paymentMethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `receiptOrders`
--
ALTER TABLE `receiptOrders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `receiveMode`
--
ALTER TABLE `receiveMode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reductions`
--
ALTER TABLE `reductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `saveAcces`
--
ALTER TABLE `saveAcces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `saveAccesActivity`
--
ALTER TABLE `saveAccesActivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tva`
--
ALTER TABLE `tva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `valids`
--
ALTER TABLE `valids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`tva_spl`) REFERENCES `tva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`tva_emp`) REFERENCES `tva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_4` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `articlesOptions`
--
ALTER TABLE `articlesOptions`
  ADD CONSTRAINT `articlesOptions_ibfk_1` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articlesOptions_ibfk_2` FOREIGN KEY (`articlesOptionsListing_id`) REFERENCES `articlesOptionsListing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `articlesOptionsListing`
--
ALTER TABLE `articlesOptionsListing`
  ADD CONSTRAINT `articlesOptionsListing_ibfk_1` FOREIGN KEY (`categoriesCondiments_id`) REFERENCES `catCondiments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`valids_id`) REFERENCES `valids` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `customersDetails`
--
ALTER TABLE `customersDetails`
  ADD CONSTRAINT `customersDetails_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customersDetails_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `operators_ibfk_2` FOREIGN KEY (`valids_id`) REFERENCES `valids` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`paymentMethod_id`) REFERENCES `paymentMethod` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`receiveMode_id`) REFERENCES `receiveMode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`receiptMode_id`) REFERENCES `receiptOrders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`operators_id`) REFERENCES `operators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`tables_id`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_6` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ordersDetails`
--
ALTER TABLE `ordersDetails`
  ADD CONSTRAINT `ordersDetails_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ordersDetails_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ordersOptions`
--
ALTER TABLE `ordersOptions`
  ADD CONSTRAINT `ordersOptions_ibfk_1` FOREIGN KEY (`ordersDetails_id`) REFERENCES `ordersDetails` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ordersOptions_ibfk_2` FOREIGN KEY (`articleOptionsListing_id`) REFERENCES `articlesOptionsListing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reductions`
--
ALTER TABLE `reductions`
  ADD CONSTRAINT `reductions_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `saveAcces`
--
ALTER TABLE `saveAcces`
  ADD CONSTRAINT `saveAcces_ibfk_1` FOREIGN KEY (`operators_id`) REFERENCES `operators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `saveAcces_ibfk_2` FOREIGN KEY (`saveAccesActivite_id`) REFERENCES `saveAccesActivity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
