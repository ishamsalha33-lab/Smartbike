-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 juin 2026 à 13:07
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smartbike_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adresse` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `categorie`, `image`) VALUES
(1, 'Smart Urban X', 'Le vélo électrique idéal pour la ville avec GPS et verrouillage connecté.', 1499.00, 'Urbain', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082),
(2, 'Smart Trail VTT', 'Un VTT connecté tout-terrain avec batterie haute autonomie et capteurs.', 2299.00, 'VTT', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082),
(3, 'Smart Roadster', 'Taillé pour la vitesse sur route, ultra léger avec tracking d\'activité.', 1899.00, 'Sport', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082),
(4, 'Smart Cargo e-Bike', 'Idéal pour transporter vos courses ou vos enfants avec assistance maximale.', 2599.00, 'Urbain', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082),
(5, 'Smart Enduro Pro', 'Pour les descentes extrêmes, équipé de suspensions intelligentes actives.', 3499.00, 'VTT', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082),
(6, 'Smart Aero Race', 'Aérodynamisme poussé au maximum pour les cyclistes compétiteurs.', 2999.00, 'Sport', 0x89504e470d0a1a0a0000000d494844520000000a0000000a08060000008d32cfbd0000001a49444154189563606060f80f050c204c0c646064185540800f0000bc00ff05fd83d70000000049454e44ae426082);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
