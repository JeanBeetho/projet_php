-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2025 at 01:08 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` enum('Etudiant','Professeur','grille','Personnel Admin','Invite') NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `type`, `phone`) VALUES
(6, 'jean pierre', 'Etudiant', '43 24 6983'),
(7, 'Beraldens Cassy', 'Etudiant', '43 24 6983'),
(8, 'Esterny', 'Etudiant', '35061048'),
(9, 'Guenslay', 'Etudiant', '35061048'),
(10, 'Jacques Louis', 'Professeur', '89365625');

-- --------------------------------------------------------

--
-- Table structure for table `plats`
--

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `cuisson` enum('cru','cuit','grille','') NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `quantite` int NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plats`
--

INSERT INTO `plats` (`id`, `nom`, `cuisson`, `prix`, `quantite`, `date_ajout`) VALUES
(9, 'Riz', 'cru', 50, 504, '2025-01-05 21:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `rapports`
--

DROP TABLE IF EXISTS `rapports`;
CREATE TABLE IF NOT EXISTS `rapports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_debut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` date NOT NULL,
  `fichier_pdf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','user','','') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `role`) VALUES
(4, 'cayoo', 'dor', 'cayo', '$2y$10$Mbf5a0PaTYhTNrUArLLbtO1jwBNRby2WXYqBaAOCM6K3bTzGyWaNG', 'user'),
(2, 'Cassy', 'Beraldens', 'admin2', '$2y$10$JVFBTq52xTN/lW6xIhDXyeUHQ8wj.eLn13lq0t1mF8oPgSKHbHMV2', 'user'),
(9, 'Cassy', 'Beraldens', 'cayoo2', '$2y$10$bOZckfubDEbF/csAFCqMneQQe7cb/G5b1HIWkKRyzfhx7UcZTaBKK', 'user'),
(11, 'Cassy', 'Beraldens', 'admin3', '$2y$10$9VUz6x6sQ4vpaK5lH62WK.UuX740iaU8OApOS6w4.bvIKL7DfPHE6', 'user'),
(12, 'Cassy', 'Beraldens', 'admin6', '$2y$10$pRobqiJxtOWF4Ml0hGGz6eHMdWGiz9lbqKzgehXgd9JWHKzqURQke', 'user'),
(14, 'Esterny', 'Mikendy', 'Mi', '$2y$10$yWgHVk3sMEZyFdAfj02fTefDj57YIVj7m3p/n771ghCvjNDjSiJte', 'admin'),
(15, 'Esterny', 'Mikendy', 'Hito', '$2y$10$REFpXKZYqjyG5RLNE1/.YeRV5JjU3eBKoj2iioDepphX5JlUJjIy.', 'user'),
(16, 'Decimus', 'Beetho', 'Beetho', '$2y$10$MQZ8eNWpz1HkOOgDeTJehOI0EIZevMsS3SaF0Uz0jzDd5HFBVVePa', 'admin'),
(17, 'admin', 'admin', 'admin', '$2y$10$17To4tDb1hqKNpaxMeo6fefbWc0eud963FMWnY9KFVINTwBzrciKO', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `plat_id` int NOT NULL,
  `date_vente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_plats` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `plat_id` (`plat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ventes`
--

INSERT INTO `ventes` (`id`, `client_id`, `plat_id`, `date_vente`, `nombre_plats`) VALUES
(8, 4, 1, '2024-12-27 23:24:58', 2),
(9, 7, 1, '2024-12-29 18:13:21', 5),
(7, 5, 2, '2024-12-27 16:37:54', 6),
(10, 6, 1, '2024-12-29 18:13:41', 3),
(11, 6, 1, '2024-12-29 18:22:43', 9),
(12, 6, 1, '2024-12-29 18:22:58', 14),
(13, 6, 2, '2024-12-29 18:23:17', 6),
(14, 6, 1, '2024-12-30 00:00:00', 1),
(15, 6, 3, '2024-12-30 00:00:00', 1),
(16, 6, 1, '2024-12-31 00:00:00', 3),
(17, 6, 1, '2025-01-03 00:00:00', 3),
(18, 6, 1, '2025-01-05 00:00:00', 2),
(19, 6, 5, '2025-01-05 00:00:00', 1),
(20, 7, 9, '2025-01-05 00:00:00', 3),
(21, 8, 6, '2025-01-05 00:00:00', 1),
(22, 9, 6, '2025-01-05 00:00:00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
