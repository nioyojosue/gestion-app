-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 04 fév. 2026 à 13:13
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock_dclic`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('nioyoj@gmail.com', '0000'),
('nioyoj@gmail.com', '0000'),
('samuel@gmail.com', '1111'),
('admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `date_fabrication` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom_article`, `id_categorie`, `quantite`, `prix_unitaire`, `date_fabrication`, `date_expiration`, `images`) VALUES
(1, 'HP', 1, 70, 200000, '2022-09-15 22:32:00', '2022-09-18 19:36:00', NULL),
(2, 'Imprimante scanner', 2, 1, 50000, '2022-09-09 20:41:00', '2022-10-02 19:47:00', NULL),
(3, 'Cable VGA', 3, 2, 1500, '2022-09-18 18:55:00', '2022-09-16 18:57:00', NULL),
(4, 'souris', 3, 102, 6000, '2022-09-16 19:58:00', '2022-09-16 19:02:00', NULL),
(5, 'Ecouteur', 3, 1, 1000, '2022-09-23 00:26:00', '2022-09-23 20:33:00', NULL),
(6, 'Chargeur', 3, 0, 500, '2022-09-23 22:27:00', '2022-09-23 01:27:00', NULL),
(7, 'HP 15', 1, 0, 7888, '2023-03-04 18:13:00', '2023-03-04 18:13:00', NULL),
(8, 'Télécommande', 3, 0, 1000, '2023-03-03 18:35:00', '2023-04-09 18:35:00', '../public/images/WhatsApp Image 2023-01-23 at 12.57.19.jpeg'),
(9, 'hdmi', 3, 3, 2000, '2025-03-08 09:21:00', '2025-03-30 09:21:00', '../public/images/WhatsApp Image 2024-08-05 at 17.31.48.jpeg'),
(10, 'Disque dur', 1, 0, 2000, '2025-03-08 11:17:00', '2025-07-03 11:17:00', '../public/images/WhatsApp Image 2024-08-05 at 17.31.47.jpeg'),
(11, 'Feu de gabarit', 3, 0, 3000, '2025-03-09 20:06:00', '2025-03-08 20:06:00', '../public/images/OIC.jpg'),
(12, 'raccord', 1, 4, 1000, '2025-03-11 17:18:00', '2025-05-11 17:18:00', '../public/images/Capture.PNG'),
(13, 'BISCUIT', 3, 6, 50, '2025-03-12 12:58:00', '2025-04-12 12:58:00', '../public/images/fond groupe ahanda.png'),
(14, 'laptop dell', 3, 56, 120000, '2025-01-16 23:02:00', '2028-04-16 23:04:00', '../public/images/WhatsApp Image 2024-08-05 at 17.31.47.jpeg'),
(15, 'cables SATA', 3, 2, 1000, '2025-12-16 13:07:00', '2025-12-21 15:07:00', '../public/images/favicon.ico'),
(16, 'Server ', 3, 5, 50000, '2023-10-22 14:43:00', '2027-12-23 14:43:00', '../public/images/IMG-20251209-WA0025.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_article`
--

CREATE TABLE `categorie_article` (
  `id` int(11) NOT NULL,
  `libelle_categorie` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie_article`
--

INSERT INTO `categorie_article` (`id`, `libelle_categorie`) VALUES
(1, 'remoque'),
(2, 'Imprimante'),
(3, 'Accessoire'),
(4, 'cables de connection');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'Adamou', 'Abdoul Razak', '+22798960382', 'Tahoua Niger'),
(2, 'Maiga', 'Abdoul rachid Amadou', '+22758907514', '45 rue saint pallais'),
(3, 'nioyo', 'josue', '690625876', 'mpangou'),
(4, 'sam', 'bb', '690584522', 'mokolo'),
(5, 'jury', 'df', '4554', 'kribi'),
(6, 'cartele', 'boss', '69061465', 'fhbdfjk'),
(7, 'Abikaba', 'Ongo', '699675409', 'mpangou'),
(8, 'Mmak', 'junior', '692584556', 'kribi plage'),
(9, 'Nukagne', 'Eunice', '6978512044', 'sud'),
(10, 'Abikaba', 'Suzi', '699675409', 'mpangou');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_article`, `id_fournisseur`, `quantite`, `prix`, `date_commande`) VALUES
(5, 9, 3, 10, 20000, '2025-03-08 08:25:21'),
(6, 1, 1, 10, 2000000, '2025-03-08 10:31:04'),
(7, 1, 1, 5, 1000000, '2025-03-08 15:34:42'),
(8, 6, 3, 20, 10000, '2025-03-10 08:34:15'),
(9, 2, 1, 2, 100000, '2025-03-11 16:13:08'),
(10, 14, 3, 52, 6240000, '2025-12-16 22:13:02');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(2) NOT NULL,
  `prenom` varchar(3) NOT NULL,
  `email` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`, `adresse`) VALUES
(2, 'tabe', 'samuel', 'samuel@yopmail.com', '0000', '69568717', 'mpangou'),
(4, 'Yehinegnie', 'jephté', 'jephte@yopmail.com', '12345', '69785120', 'afan-mabe');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `num_facture` varchar(50) NOT NULL,
  `date_facture` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `montant_total` int(11) NOT NULL,
  `etat` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `id_client`, `num_facture`, `date_facture`, `montant_total`, `etat`) VALUES
(1, 1, 'FAC-20251216130825-962', '2025-12-16 13:08:25', 618000, '1'),
(2, 9, 'FAC-20251216132516-903', '2025-12-16 13:25:16', 218500, '1'),
(3, 2, 'FAC-20251216135731-577', '2025-12-16 13:57:31', 203000, '1'),
(4, 1, 'FAC-20251216135932-991', '2025-12-16 13:59:32', 204000, '1'),
(5, 3, 'FAC-20251216140022-489', '2025-12-16 14:00:22', 552000, '1'),
(6, 1, 'FAC-20251216141409-823', '2025-12-16 14:14:09', 450000, '1'),
(7, 1, 'FAC-20251216221456-983', '2025-12-16 22:14:56', 121500, '1'),
(8, 3, 'FAC-20251220124841-778', '2025-12-20 12:48:41', 417200, '1'),
(9, 1, 'FAC-20251221094757-403', '2025-12-21 09:47:57', 20000000, '1'),
(10, 8, 'FAC-20260126165417-338', '2026-01-26 16:54:17', 642000, '1'),
(14, 1, 'FAC-20260202170850-374', '2026-02-02 17:08:50', 400000, '1'),
(17, 9, 'FAC-20260203111457-436', '2026-02-03 11:14:57', 4000000, '1');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'Komche', 'Issa', '+23792470763', 'Yantala, Niamey'),
(2, 'MAMAN SANI', 'HASSAN', '+23798655425', 'Zinder, Jeune cadre'),
(3, 'ndongo', 'topo', '655784512', 'yaounde');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_client`, `id_article`, `quantite`, `prix_unitaire`, `session_id`, `date_ajout`) VALUES
(1, 1, 4, 2, 6000, 'e6d1640766c7c9d70a335f1910a7c78a', '2025-12-16 11:00:17');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL,
  `num_facture` int(11) DEFAULT NULL,
  `id_article` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_facture` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_vente` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `num_facture`, `id_article`, `id_client`, `id_facture`, `quantite`, `prix`, `date_vente`, `etat`) VALUES
(3, NULL, 1, 2, NULL, 1, 200000, '2022-09-21 06:31:25', '0'),
(4, NULL, 2, 1, NULL, 5, 230000, '2022-09-21 06:35:14', '0'),
(5, NULL, 4, 1, NULL, 2, 12000, '2022-09-21 18:24:18', '0'),
(6, NULL, 3, 2, NULL, 6, 9000, '2022-09-23 19:24:12', '0'),
(7, NULL, 1, 2, NULL, 10, 2000000, '2022-09-23 19:25:08', '0'),
(8, NULL, 4, 1, NULL, 20, 120000, '2022-09-23 19:25:17', '0'),
(9, NULL, 5, 1, NULL, 5, 5000, '2022-09-23 19:31:02', '0'),
(10, NULL, 1, 1, NULL, 5, 1000000, '2022-09-23 19:48:16', '0'),
(11, NULL, 2, 2, NULL, 3, 150000, '2022-09-23 19:48:23', '0'),
(12, NULL, 5, 1, NULL, 2, 2000, '2022-09-23 19:48:29', '0'),
(13, NULL, 6, 1, NULL, 40, 20000, '2022-09-23 19:48:37', '0'),
(14, NULL, 4, 1, NULL, 15, 90000, '2022-09-23 19:48:46', '0'),
(15, NULL, 6, 2, NULL, 5, 2500, '2022-09-23 19:49:01', '0'),
(16, NULL, 3, 1, NULL, 13, 19500, '2022-09-23 19:49:07', '0'),
(17, NULL, 1, 2, NULL, 1, 200000, '2022-09-23 19:49:12', '0'),
(18, NULL, 4, 2, NULL, 3, 18000, '2022-09-23 19:49:20', '0'),
(19, NULL, 4, 2, NULL, 8, 48000, '2022-09-24 09:07:14', '0'),
(20, NULL, 2, 1, NULL, 3, 150000, '2022-09-24 10:23:57', '0'),
(21, NULL, 5, 3, NULL, 3, 3000, '2025-03-08 08:10:35', '0'),
(22, NULL, 4, 1, NULL, 2, 10000, '2025-03-08 08:18:24', '0'),
(23, NULL, 4, 3, NULL, 100, 500000, '2025-03-08 09:04:32', '0'),
(24, NULL, 4, 4, NULL, 100, 600000, '2025-03-08 09:05:47', '0'),
(25, NULL, 1, 4, NULL, 3, 600000, '2025-03-08 10:26:38', '0'),
(26, NULL, 10, 1, NULL, 8, 16000, '2025-03-08 10:29:19', '0'),
(27, NULL, 7, 1, NULL, 7, 55216, '2025-03-08 10:32:20', '0'),
(28, NULL, 1, 3, NULL, 9, 1800000, '2025-03-08 15:34:06', '0'),
(29, NULL, 11, 3, NULL, 17, 51000, '2025-03-09 19:10:16', '0'),
(30, NULL, 6, 3, NULL, 35, 17500, '2025-03-10 08:33:05', '0'),
(31, NULL, 6, 3, NULL, 3, 1500, '2025-03-11 16:14:32', '0'),
(32, NULL, 1, 3, NULL, 2, 400000, '2025-03-20 07:59:52', '0'),
(33, NULL, 1, 3, NULL, 3, 600000, '2025-03-26 12:33:34', '0'),
(34, NULL, 1, 1, NULL, 10, 2000000, '2025-04-21 13:49:40', '0'),
(35, NULL, 1, 6, NULL, 4, 800000, '2025-04-21 19:55:36', '0'),
(36, NULL, 1, 7, NULL, 6, 1200000, '2025-04-27 18:34:05', '0'),
(37, NULL, 3, 7, NULL, 20, 30000, '2025-07-16 20:35:00', '0'),
(38, NULL, 14, 8, NULL, 10, 1200000, '2025-07-16 21:04:57', '0'),
(39, NULL, 3, 3, NULL, 5, 7500, '2025-12-16 10:32:48', '0'),
(40, NULL, 3, 3, NULL, 30, 45000, '2025-12-16 12:55:07', '0'),
(41, NULL, 3, 3, NULL, 12, 18000, '2025-12-16 12:58:12', '0'),
(42, NULL, 2, 3, NULL, 1, 50000, '2025-12-16 12:59:52', '0'),
(43, NULL, 1, 1, 1, 3, 600000, '2025-12-16 13:08:25', '0'),
(44, NULL, 4, 1, 1, 3, 18000, '2025-12-16 13:08:25', '1'),
(45, NULL, 15, 9, NULL, 3, 3000, '2025-12-16 13:22:03', '0'),
(46, NULL, 1, 9, 2, 1, 200000, '2025-12-16 13:25:17', '1'),
(47, NULL, 8, 9, 2, 10, 10000, '2025-12-16 13:25:17', '1'),
(48, NULL, 6, 9, 2, 17, 8500, '2025-12-16 13:25:17', '0'),
(49, NULL, 1, 2, 3, 1, 200000, '2025-12-16 13:57:31', '1'),
(50, NULL, 3, 2, 3, 2, 3000, '2025-12-16 13:57:31', '1'),
(51, NULL, 2, 1, 4, 4, 200000, '2025-12-16 13:59:32', '1'),
(52, NULL, 15, 1, 4, 4, 4000, '2025-12-16 13:59:32', '1'),
(53, NULL, 4, 3, 5, 12, 72000, '2025-12-16 14:00:22', '1'),
(54, NULL, 14, 3, 5, 4, 480000, '2025-12-16 14:00:22', '1'),
(55, NULL, 2, 3, NULL, 1, 48000, '2025-12-16 14:13:43', '0'),
(56, NULL, 1, 1, 6, 2, 400000, '2025-12-16 14:14:09', '1'),
(57, NULL, 2, 1, 6, 1, 50000, '2025-12-16 14:14:09', '1'),
(58, NULL, 9, 1, 7, 52, 104000, '2025-12-16 22:14:56', '1'),
(59, NULL, 6, 1, 7, 17, 8500, '2025-12-16 22:14:56', '1'),
(60, NULL, 11, 1, 7, 3, 9000, '2025-12-16 22:14:56', '1'),
(61, NULL, 1, 3, 8, 2, 400000, '2025-12-20 12:48:41', '1'),
(62, NULL, 4, 3, 8, 1, 6000, '2025-12-20 12:48:42', '1'),
(63, NULL, 15, 3, 8, 1, 1000, '2025-12-20 12:48:42', '1'),
(64, NULL, 12, 3, 8, 6, 6000, '2025-12-20 12:48:42', '1'),
(65, NULL, 9, 3, 8, 2, 4000, '2025-12-20 12:48:42', '1'),
(66, NULL, 13, 3, 8, 4, 200, '2025-12-20 12:48:42', '1'),
(67, NULL, 1, 1, NULL, 1, 200000, '2025-12-20 13:18:36', '0'),
(68, NULL, 1, 1, NULL, 2, 400000, '2025-12-20 13:34:59', '0'),
(69, NULL, 1, 4, NULL, -66, -13200000, '2025-12-21 09:46:14', '0'),
(70, NULL, 1, 1, NULL, -72, -14400000, '2025-12-21 09:47:28', '0'),
(71, NULL, 1, 1, 9, 100, 20000000, '2025-12-21 09:47:57', '1'),
(72, NULL, 1, 1, NULL, -58, -11600000, '2025-12-21 10:02:33', '0'),
(73, NULL, 16, 3, NULL, 5, 250000, '2025-12-23 13:46:30', '0'),
(74, NULL, 9, 4, NULL, 3, 4000, '2026-01-26 16:53:16', '0'),
(75, NULL, 1, 8, 10, 2, 400000, '2026-01-26 16:54:17', '1'),
(76, NULL, 5, 8, 10, 2, 2000, '2026-01-26 16:54:17', '1'),
(77, NULL, 14, 8, 10, 2, 240000, '2026-01-26 16:54:17', '1'),
(78, NULL, 1, 1, NULL, 1, 200000, '2026-02-02 16:15:08', '0'),
(79, NULL, 1, 3, NULL, 2, 400000, '2026-02-02 16:31:36', '0'),
(80, NULL, 4, 3, NULL, 5, 30000, '2026-02-02 16:31:36', '0'),
(81, NULL, 12, 3, NULL, 2, 2000, '2026-02-02 16:31:36', '0'),
(82, NULL, 1, 3, NULL, 3, 600000, '2026-02-02 16:33:57', '0'),
(83, NULL, 4, 3, NULL, 3, 18000, '2026-02-02 16:33:57', '0'),
(84, NULL, 1, 1, NULL, 2, 400000, '2026-02-02 17:05:31', '0'),
(85, NULL, 3, 1, NULL, 1, 1500, '2026-02-02 17:05:31', '0'),
(86, NULL, 1, 1, NULL, 5, 1000000, '2026-02-02 17:08:08', '0'),
(87, NULL, 1, 1, 14, 2, 400000, '2026-02-02 17:08:50', '1'),
(88, NULL, 1, 3, NULL, 1, 200000, '2026-02-02 18:37:28', '0'),
(89, NULL, 1, 1, NULL, 1, 200000, '2026-02-02 18:47:17', '0'),
(90, NULL, 1, 10, NULL, 10, 2000000, '2026-02-02 18:49:56', '0'),
(91, NULL, 4, 10, NULL, 30, 180000, '2026-02-02 18:49:56', '0'),
(92, NULL, 1, 10, NULL, 10, 2000000, '2026-02-02 19:09:56', '0'),
(93, NULL, 1, 9, 17, 20, 4000000, '2026-02-03 11:14:58', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_fournisseur` (`id_fournisseur`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_facture` (`num_facture`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `fk_vente_facture` (`id_facture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `fk_vente_facture` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `vente_ibfk_3` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
