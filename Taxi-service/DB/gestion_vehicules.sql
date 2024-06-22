-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 juin 2024 à 01:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_vehicules`
--

-- --------------------------------------------------------

--
-- Structure de la table `assignations`
--

CREATE TABLE `assignations` (
  `id` int(11) NOT NULL,
  `id_chauffeur` int(11) DEFAULT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assignations`
--

INSERT INTO `assignations` (`id`, `id_chauffeur`, `id_voiture`, `date_debut`, `date_fin`) VALUES
(1, 1, 1, '2024-06-22', '2024-06-22'),
(2, 2, 2, '2024-06-22', '0000-00-00'),
(3, 3, 3, '2024-06-23', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `chauffeurs`
--

CREATE TABLE `chauffeurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chauffeurs`
--

INSERT INTO `chauffeurs` (`id`, `nom`, `prenom`, `telephone`) VALUES
(1, 'Malonga', 'Ariel', '06778'),
(2, 'Malonga', 'jefferson', '05688546'),
(3, 'Aris', 'Abelenguet', '08688546');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `id_voiture`, `montant`, `date`) VALUES
(1, 1, 1000.00, '2024-06-22'),
(2, 1, 25000.00, '2024-06-22'),
(4, 2, 250000.00, '2024-06-23'),
(5, 1, 25000.00, '2024-06-22'),
(8, 3, 250000.00, '2024-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(11) NOT NULL,
  `id_chauffeur` int(11) DEFAULT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `id_chauffeur`, `id_voiture`, `montant`, `date`) VALUES
(1, 1, 1, 25000.00, '2024-06-22'),
(3, 3, 3, 25000.00, '2024-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `immatriculation` varchar(20) NOT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `modele` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `immatriculation`, `marque`, `modele`) VALUES
(1, '792 SL 4', 'Benoit 16', 'TOYOTA'),
(2, '793 SL 4', 'Benoit 16', 'TOYOTA'),
(3, '791 SL 4', 'Benoit 16', 'TOYOTA');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assignations`
--
ALTER TABLE `assignations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_chauffeur` (`id_chauffeur`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_chauffeur` (`id_chauffeur`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `immatriculation` (`immatriculation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assignations`
--
ALTER TABLE `assignations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assignations`
--
ALTER TABLE `assignations`
  ADD CONSTRAINT `assignations_ibfk_1` FOREIGN KEY (`id_chauffeur`) REFERENCES `chauffeurs` (`id`),
  ADD CONSTRAINT `assignations_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`id_chauffeur`) REFERENCES `chauffeurs` (`id`),
  ADD CONSTRAINT `recettes_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
