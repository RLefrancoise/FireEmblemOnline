-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Juin 2017 à 23:37
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `feo`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '0.0.0.0',
  `mail` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `ip`, `mail`) VALUES
(1, 'Luka', '83f2cf5cd9ba76526296bea274f081dc', '127.0.0.1', 'supervlad@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `accounts_data`
--

DROP TABLE IF EXISTS `accounts_data`;
CREATE TABLE IF NOT EXISTS `accounts_data` (
  `account_id` mediumint(8) UNSIGNED NOT NULL,
  `gold` int(9) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_data`
--

INSERT INTO `accounts_data` (`account_id`, `gold`) VALUES
(1, 999952179);

-- --------------------------------------------------------

--
-- Structure de la table `accounts_units`
--

DROP TABLE IF EXISTS `accounts_units`;
CREATE TABLE IF NOT EXISTS `accounts_units` (
  `account_id` mediumint(8) UNSIGNED NOT NULL,
  `unit_id` mediumint(8) UNSIGNED NOT NULL,
  `class_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL,
  `exp` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `current_hp` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `hp` tinyint(3) UNSIGNED NOT NULL,
  `strength` tinyint(3) UNSIGNED NOT NULL,
  `magic` tinyint(3) UNSIGNED NOT NULL,
  `skill` tinyint(3) UNSIGNED NOT NULL,
  `speed` tinyint(3) UNSIGNED NOT NULL,
  `luck` tinyint(3) UNSIGNED NOT NULL,
  `defence` tinyint(3) UNSIGNED NOT NULL,
  `resistance` tinyint(3) UNSIGNED NOT NULL,
  `constitution` tinyint(3) UNSIGNED NOT NULL,
  `weight` tinyint(3) UNSIGNED NOT NULL,
  `movement` tinyint(3) UNSIGNED NOT NULL,
  `sword_rank` varchar(2) DEFAULT NULL,
  `spear_rank` varchar(2) DEFAULT NULL,
  `axe_rank` varchar(2) DEFAULT NULL,
  `bow_rank` varchar(2) DEFAULT NULL,
  `knife_rank` varchar(2) DEFAULT NULL,
  `strike_rank` varchar(2) DEFAULT NULL,
  `fire_rank` varchar(2) DEFAULT NULL,
  `thunder_rank` varchar(2) DEFAULT NULL,
  `wind_rank` varchar(2) DEFAULT NULL,
  `light_rank` varchar(2) DEFAULT NULL,
  `dark_rank` varchar(2) DEFAULT NULL,
  `staff_rank` varchar(2) DEFAULT NULL,
  `equipped_weapon_place` tinyint(3) UNSIGNED DEFAULT NULL,
  `biorhythm_turn` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`,`unit_id`),
  KEY `unit_id` (`unit_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_units`
--

INSERT INTO `accounts_units` (`account_id`, `unit_id`, `class_id`, `level`, `exp`, `current_hp`, `hp`, `strength`, `magic`, `skill`, `speed`, `luck`, `defence`, `resistance`, `constitution`, `weight`, `movement`, `sword_rank`, `spear_rank`, `axe_rank`, `bow_rank`, `knife_rank`, `strike_rank`, `fire_rank`, `thunder_rank`, `wind_rank`, `light_rank`, `dark_rank`, `staff_rank`, `equipped_weapon_place`, `biorhythm_turn`) VALUES
(1, 1, 1, 1, 0, 32, 32, 17, 3, 20, 19, 13, 13, 9, 6, 7, 7, NULL, NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 2, 4, 20, 0, 55, 55, 32, 8, 40, 40, 30, 26, 16, 7, 7, 6, 'S+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(1, 3, 5, 1, 0, 15, 15, 2, 7, 8, 7, 10, 2, 4, 5, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'D', NULL, NULL, NULL, 0),
(1, 4, 9, 1, 0, 35, 35, 18, 4, 20, 20, 15, 14, 9, 8, 8, 7, NULL, NULL, NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `accounts_units_items`
--

DROP TABLE IF EXISTS `accounts_units_items`;
CREATE TABLE IF NOT EXISTS `accounts_units_items` (
  `account_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_id` mediumint(8) UNSIGNED NOT NULL,
  `item_instance_id` mediumint(8) UNSIGNED NOT NULL,
  `place` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`account_id`,`unit_id`,`place`),
  KEY `unit_id` (`unit_id`),
  KEY `accounts_units_items_item_instance_id_fk_idx` (`item_instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_units_items`
--

INSERT INTO `accounts_units_items` (`account_id`, `unit_id`, `item_instance_id`, `place`) VALUES
(1, 2, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `accounts_units_skills`
--

DROP TABLE IF EXISTS `accounts_units_skills`;
CREATE TABLE IF NOT EXISTS `accounts_units_skills` (
  `account_id` mediumint(8) UNSIGNED NOT NULL,
  `unit_id` mediumint(8) UNSIGNED NOT NULL,
  `skill_id` mediumint(8) UNSIGNED NOT NULL,
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `ignore_capacity` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`,`unit_id`,`skill_id`),
  KEY `accounts_units_skills_unit_id_fk_idx` (`unit_id`),
  KEY `accounts_units_skills_skill_id_fk_idx` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_units_skills`
--

INSERT INTO `accounts_units_skills` (`account_id`, `unit_id`, `skill_id`, `locked`, `ignore_capacity`) VALUES
(1, 2, 11, 0, 1),
(1, 3, 10, 1, 1),
(1, 4, 14, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `accounts_units_supports`
--

DROP TABLE IF EXISTS `accounts_units_supports`;
CREATE TABLE IF NOT EXISTS `accounts_units_supports` (
  `unit1_id` mediumint(8) UNSIGNED NOT NULL,
  `unit2_id` mediumint(8) UNSIGNED NOT NULL,
  `support_level` varchar(1) NOT NULL DEFAULT 'C',
  `account_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`unit1_id`,`unit2_id`,`account_id`),
  KEY `accounts_units_supports_unit2_id_idx` (`unit2_id`),
  KEY `accounts_units_supports_unit1_id_idx` (`unit1_id`),
  KEY `accounts_units_supports_account_id_fk_idx` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_units_supports`
--

INSERT INTO `accounts_units_supports` (`unit1_id`, `unit2_id`, `support_level`, `account_id`) VALUES
(1, 2, 'B', 1),
(3, 4, 'A', 1);

-- --------------------------------------------------------

--
-- Structure de la table `accounts_warehouses`
--

DROP TABLE IF EXISTS `accounts_warehouses`;
CREATE TABLE IF NOT EXISTS `accounts_warehouses` (
  `account_id` mediumint(8) UNSIGNED NOT NULL,
  `item_instance_id` mediumint(8) UNSIGNED NOT NULL,
  KEY `accounts_warehouses_account_id_fk_idx` (`account_id`),
  KEY `accounts_warehouses_item_instance_id_fk_idx` (`item_instance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts_warehouses`
--

INSERT INTO `accounts_warehouses` (`account_id`, `item_instance_id`) VALUES
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38);

-- --------------------------------------------------------

--
-- Structure de la table `affinities`
--

DROP TABLE IF EXISTS `affinities`;
CREATE TABLE IF NOT EXISTS `affinities` (
  `affinity_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `atk_support` float UNSIGNED DEFAULT NULL,
  `def_support` float UNSIGNED DEFAULT NULL,
  `hit_support` float UNSIGNED DEFAULT NULL,
  `avd_support` float UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`affinity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `affinities`
--

INSERT INTO `affinities` (`affinity_id`, `name`, `icon`, `atk_support`, `def_support`, `hit_support`, `avd_support`) VALUES
(1, 'Fire', '5_0', 0.5, NULL, 2.5, NULL),
(2, 'Water', '2_0', 0.5, 0.5, NULL, NULL),
(3, 'Wind', '6_0', NULL, NULL, 2.5, 2.5),
(4, 'Thunder', '7_0', NULL, 0.5, NULL, 2.5),
(5, 'Heaven', '0_0', NULL, NULL, 9, NULL),
(6, 'Earth', '1_0', NULL, NULL, NULL, 7.5),
(7, 'Light', '3_0', NULL, 0.5, 2.5, NULL),
(8, 'Dark', '4_0', 0.5, NULL, NULL, 2.5);

-- --------------------------------------------------------

--
-- Structure de la table `biorhythm`
--

DROP TABLE IF EXISTS `biorhythm`;
CREATE TABLE IF NOT EXISTS `biorhythm` (
  `biorhythm_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`biorhythm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `biorhythm`
--

INSERT INTO `biorhythm` (`biorhythm_id`, `name`) VALUES
(1, 'Type 0'),
(2, 'Type 1'),
(3, 'Type 2'),
(4, 'Type 3'),
(5, 'Type 4'),
(6, 'Type 5'),
(7, 'Type 6'),
(8, 'Type 7'),
(9, 'Type 8'),
(10, 'Type 9');

-- --------------------------------------------------------

--
-- Structure de la table `biorhythm_waves`
--

DROP TABLE IF EXISTS `biorhythm_waves`;
CREATE TABLE IF NOT EXISTS `biorhythm_waves` (
  `biorhythm_id` mediumint(8) UNSIGNED NOT NULL,
  `turn` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`biorhythm_id`,`turn`),
  KEY `biorhythm_id` (`biorhythm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `biorhythm_waves`
--

INSERT INTO `biorhythm_waves` (`biorhythm_id`, `turn`, `status`) VALUES
(1, 1, 'normal'),
(1, 2, 'good'),
(1, 3, 'best'),
(1, 4, 'best'),
(1, 5, 'best'),
(1, 6, 'good'),
(1, 7, 'normal'),
(1, 8, 'normal'),
(1, 9, 'bad'),
(1, 10, 'worst'),
(1, 11, 'worst'),
(1, 12, 'bad'),
(1, 13, 'normal'),
(1, 14, 'normal'),
(1, 15, 'good'),
(1, 16, 'best'),
(1, 17, 'best'),
(1, 18, 'good'),
(1, 19, 'normal'),
(1, 20, 'normal'),
(1, 21, 'bad'),
(1, 22, 'worst'),
(1, 23, 'worst'),
(1, 24, 'worst'),
(1, 25, 'bad'),
(2, 1, 'normal'),
(2, 2, 'normal'),
(2, 3, 'good'),
(2, 4, 'best'),
(2, 5, 'best'),
(2, 6, 'best'),
(2, 7, 'best'),
(2, 8, 'best'),
(2, 9, 'best'),
(2, 10, 'best'),
(2, 11, 'best'),
(2, 12, 'good'),
(2, 13, 'normal'),
(2, 14, 'normal'),
(2, 15, 'bad'),
(2, 16, 'worst'),
(2, 17, 'worst'),
(2, 18, 'worst'),
(2, 19, 'worst'),
(2, 20, 'worst'),
(2, 21, 'worst'),
(2, 22, 'worst'),
(2, 23, 'worst'),
(2, 24, 'bad'),
(2, 25, 'normal'),
(3, 1, 'normal'),
(3, 2, 'normal'),
(3, 3, 'good'),
(3, 4, 'normal'),
(3, 5, 'normal'),
(3, 6, 'normal'),
(3, 7, 'bad'),
(3, 8, 'bad'),
(3, 9, 'normal'),
(3, 10, 'normal'),
(3, 11, 'good'),
(3, 12, 'good'),
(3, 13, 'normal'),
(3, 14, 'normal'),
(3, 15, 'bad'),
(3, 16, 'bad'),
(3, 17, 'normal'),
(3, 18, 'normal'),
(3, 19, 'good'),
(3, 20, 'good'),
(3, 21, 'normal'),
(3, 22, 'normal'),
(3, 23, 'normal'),
(3, 24, 'bad'),
(3, 25, 'normal'),
(4, 1, 'normal'),
(4, 2, 'best'),
(4, 3, 'best'),
(4, 4, 'normal'),
(4, 5, 'worst'),
(4, 6, 'worst'),
(4, 7, 'bad'),
(4, 8, 'best'),
(4, 9, 'best'),
(4, 10, 'good'),
(4, 11, 'worst'),
(4, 12, 'worst'),
(4, 13, 'worst'),
(4, 14, 'best'),
(4, 15, 'best'),
(4, 16, 'best'),
(4, 17, 'bad'),
(4, 18, 'worst'),
(4, 19, 'worst'),
(4, 20, 'good'),
(4, 21, 'best'),
(4, 22, 'best'),
(4, 23, 'normal'),
(4, 24, 'worst'),
(4, 25, 'worst'),
(5, 1, 'normal'),
(5, 2, 'best'),
(5, 3, 'best'),
(5, 4, 'normal'),
(5, 5, 'bad'),
(5, 6, 'worst'),
(5, 7, 'normal'),
(5, 8, 'good'),
(5, 9, 'best'),
(5, 10, 'normal'),
(5, 11, 'bad'),
(5, 12, 'worst'),
(5, 13, 'bad'),
(5, 14, 'good'),
(5, 15, 'best'),
(5, 16, 'good'),
(5, 17, 'normal'),
(5, 18, 'worst'),
(5, 19, 'bad'),
(5, 20, 'normal'),
(5, 21, 'best'),
(5, 22, 'good'),
(5, 23, 'normal'),
(5, 24, 'worst'),
(5, 25, 'worst'),
(6, 1, 'normal'),
(6, 2, 'best'),
(6, 3, 'best'),
(6, 4, 'best'),
(6, 5, 'normal'),
(6, 6, 'worst'),
(6, 7, 'worst'),
(6, 8, 'worst'),
(6, 9, 'normal'),
(6, 10, 'good'),
(6, 11, 'best'),
(6, 12, 'best'),
(6, 13, 'good'),
(6, 14, 'bad'),
(6, 15, 'worst'),
(6, 16, 'worst'),
(6, 17, 'bad'),
(6, 18, 'normal'),
(6, 19, 'best'),
(6, 20, 'best'),
(6, 21, 'best'),
(6, 22, 'normal'),
(6, 23, 'worst'),
(6, 24, 'worst'),
(6, 25, 'worst'),
(7, 1, 'normal'),
(7, 2, 'normal'),
(7, 3, 'normal'),
(7, 4, 'normal'),
(7, 5, 'good'),
(7, 6, 'good'),
(7, 7, 'good'),
(7, 8, 'good'),
(7, 9, 'good'),
(7, 10, 'normal'),
(7, 11, 'normal'),
(7, 12, 'normal'),
(7, 13, 'normal'),
(7, 14, 'normal'),
(7, 15, 'normal'),
(7, 16, 'normal'),
(7, 17, 'normal'),
(7, 18, 'bad'),
(7, 19, 'bad'),
(7, 20, 'bad'),
(7, 21, 'bad'),
(7, 22, 'bad'),
(7, 23, 'normal'),
(7, 24, 'normal'),
(7, 25, 'normal'),
(8, 1, 'normal'),
(8, 2, 'best'),
(8, 3, 'best'),
(8, 4, 'best'),
(8, 5, 'best'),
(8, 6, 'best'),
(8, 7, 'normal'),
(8, 8, 'bad'),
(8, 9, 'worst'),
(8, 10, 'worst'),
(8, 11, 'worst'),
(8, 12, 'worst'),
(8, 13, 'bad'),
(8, 14, 'good'),
(8, 15, 'best'),
(8, 16, 'best'),
(8, 17, 'best'),
(8, 18, 'best'),
(8, 19, 'good'),
(8, 20, 'normal'),
(8, 21, 'worst'),
(8, 22, 'worst'),
(8, 23, 'worst'),
(8, 24, 'worst'),
(8, 25, 'worst');

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `factions`
--

DROP TABLE IF EXISTS `factions`;
CREATE TABLE IF NOT EXISTS `factions` (
  `faction_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`faction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `factions`
--

INSERT INTO `factions` (`faction_id`, `name`) VALUES
(1, 'Dawn Brigade'),
(2, 'Greil Mercenaries');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `icon` varchar(5) DEFAULT NULL,
  `worth` mediumint(9) UNSIGNED DEFAULT NULL,
  `uses` smallint(2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `name`, `descr`, `icon`, `worth`, `uses`) VALUES
(1, 'Herb', 'Recovers 10 HP', '15_9', 600, 10),
(2, 'Vulnerary', 'Recovers 20 HP', '16_9', 800, 8),
(3, 'Concoction', 'Recovers 40 HP', '17_9', 1200, 6),
(4, 'Elixir', 'Recovers all HP', '18_9', 3000, 3),
(5, 'Antitoxin', 'Removes Poison condition', '20_9', 450, 3),
(6, 'Panacea', 'Removes all conditions', '21_9', 1500, 3),
(7, 'Pure Water', 'Temporarily raises Resistance by 7 points', '19_9', 900, 3),
(8, 'Olivi Grass', 'Increases Transform gauge by 15 points', '29_11', 1600, 8),
(9, 'Laguz Stone', 'Increases Transform gauge to maximum', '2_10', 3000, 3),
(12, 'Laguz Gem', 'Transforms Laguz user for whole chapter', '5_10', 75000, 5),
(13, 'Shine Barrier', 'Places a tile that obstructs both ally and foe', '1_10', 800, 1),
(14, 'Torch', 'Increases sight in Fog of War', '22_9', 500, 5),
(15, 'Spectre Card', 'Attack with 5 Might, 100 Hit, Rng 1~2 magic', '29_9', 3000, 15),
(16, 'Reaper Card', 'Attack with 8 Might, 100 Hit, Rng 1~2 magic', '30_9', 5000, 10),
(17, 'Daemon Card', 'Attack with 12 Might, 100 Hit, Rng 1~2 magic', '31_9', 5000, 5);

-- --------------------------------------------------------

--
-- Structure de la table `items_instances`
--

DROP TABLE IF EXISTS `items_instances`;
CREATE TABLE IF NOT EXISTS `items_instances` (
  `item_instance_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` mediumint(8) UNSIGNED NOT NULL,
  `item_type` varchar(45) NOT NULL,
  `current_uses` smallint(4) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`item_instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items_instances`
--

INSERT INTO `items_instances` (`item_instance_id`, `item_id`, `item_type`, `current_uses`) VALUES
(1, 1, 'weapon', 5),
(2, 1, 'generic_item', 2),
(3, 17, 'weapon', 10),
(4, 30, 'weapon', 5),
(12, 1, 'generic_item', 10),
(14, 1, 'generic_item', 10),
(15, 1, 'generic_item', 10),
(16, 54, 'weapon', 15),
(17, 7, 'weapon', 40),
(18, 3, 'generic_item', 6),
(19, 33, 'weapon', 30),
(20, 11, 'weapon', 20),
(21, 16, 'weapon', 20),
(22, 2, 'generic_item', 8),
(23, 39, 'weapon', 50),
(24, 1, 'weapon', 35),
(25, 1, 'weapon', 35),
(26, 2, 'weapon', 50),
(27, 2, 'weapon', 50),
(28, 2, 'weapon', 50),
(29, 3, 'weapon', 50),
(30, 1, 'weapon', 35),
(31, 2, 'weapon', 50),
(32, 5, 'weapon', 20),
(33, 55, 'weapon', 50),
(34, 17, 'weapon', 50),
(35, 4, 'generic_item', 3),
(36, 4, 'generic_item', 3),
(37, 6, 'generic_item', 3),
(38, 8, 'generic_item', 8);

-- --------------------------------------------------------

--
-- Structure de la table `races`
--

DROP TABLE IF EXISTS `races`;
CREATE TABLE IF NOT EXISTS `races` (
  `race_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`race_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `races`
--

INSERT INTO `races` (`race_id`, `name`) VALUES
(1, 'Beorc'),
(2, 'Laguz');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `skill_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `capacity` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `skills`
--

INSERT INTO `skills` (`skill_id`, `name`, `description`, `capacity`, `icon`) VALUES
(1, 'Shove', 'Push a unit 1 square if user’s (Con +2) > unit’s Weight', 5, '1_0'),
(2, 'Canto', 'User can use their leftover movement after attacking or performing other actions', 10, '0_0'),
(3, 'Critical +5', 'Critical +5', NULL, '4_0'),
(4, 'Critical +10', 'Critical +10', NULL, '5_0'),
(5, 'Critical +15', 'Critical +15', NULL, '6_0'),
(6, 'Critical +20', 'Critical +20', NULL, '7_0'),
(7, 'Critical +25', 'Critical +25', NULL, '8_0'),
(8, 'Steal', 'Steal an enemy’s unequipped weapon or item (cannot steal if Locked)', NULL, '2_0'),
(9, 'Smite', 'Push a unit 2 squares if user’s (Con +2) > unit’s Weight', 15, '15_2'),
(10, 'Sacrifice', 'Reduces own HP to recover ally’s HP and restore their status condition', NULL, '4_3'),
(11, 'Wrath', 'When under 30% HP, Critical rate +50', 15, '19_1'),
(12, 'Cancel', 'Negates the enemy’s following attack', 10, '20_1'),
(13, 'Nihil', 'Negates enemy’s combat-related skills', 20, '9_3'),
(14, 'Guard', 'User takes damage for an adjacent Buddy', 20, '8_2');

-- --------------------------------------------------------

--
-- Structure de la table `traits`
--

DROP TABLE IF EXISTS `traits`;
CREATE TABLE IF NOT EXISTS `traits` (
  `trait_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `icon` varchar(5) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`trait_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `traits`
--

INSERT INTO `traits` (`trait_id`, `icon`, `name`, `description`) VALUES
(1, '26_1', 'Red Dragon', 'Dragon'),
(2, '27_1', 'Green Dragon', 'Dragon'),
(3, '22_1', 'Armor', 'Armor'),
(4, '21_1', 'Mounted Unit', 'Mounted Unit'),
(5, '23_1', 'Flying Unit', 'Flying Unit'),
(6, '24_1', 'Beast', 'Beast Laguz'),
(7, '25_1', 'Bird', 'Bird Laguz');

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `level` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `strength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `magic` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `skill` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `speed` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `luck` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `defence` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `resistance` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `constitution` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `weight` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `movement` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hp` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `strength_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `magic_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `skill_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `speed_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `luck_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `defence_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `resistance_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hp_growth` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `class_id` mediumint(8) UNSIGNED NOT NULL,
  `affinity_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `face` varchar(8) DEFAULT NULL,
  `resources_folder` varchar(200) DEFAULT NULL,
  `biorhythm_id` mediumint(8) UNSIGNED NOT NULL,
  `faction_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `authority` int(10) UNSIGNED DEFAULT NULL,
  `leader_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `race_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `class_id` (`class_id`),
  KEY `affinity` (`affinity_id`),
  KEY `biorhythm_id` (`biorhythm_id`),
  KEY `faction_id` (`faction_id`),
  KEY `leader_id` (`leader_id`),
  KEY `units_race_id_fk_idx` (`race_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units`
--

INSERT INTO `units` (`unit_id`, `name`, `level`, `strength`, `magic`, `skill`, `speed`, `luck`, `defence`, `resistance`, `constitution`, `weight`, `movement`, `hp`, `strength_growth`, `magic_growth`, `skill_growth`, `speed_growth`, `luck_growth`, `defence_growth`, `resistance_growth`, `hp_growth`, `class_id`, `affinity_id`, `face`, `resources_folder`, `biorhythm_id`, `faction_id`, `authority`, `leader_id`, `race_id`) VALUES
(1, 'Rolf', 1, 17, 3, 20, 19, 13, 13, 9, 6, 7, 7, 32, 75, 10, 45, 45, 35, 35, 20, 85, 1, 3, '10_6', 'rolf', 8, 2, NULL, NULL, 1),
(2, 'Edward', 4, 7, 0, 11, 12, 8, 5, 0, 7, 7, 6, 19, 60, 5, 65, 60, 50, 35, 25, 85, 2, 7, '5_0', 'edward', 6, 1, 0, 3, 1),
(3, 'Micaiah', 1, 2, 7, 8, 7, 10, 2, 4, 5, 5, 5, 15, 15, 80, 40, 35, 80, 20, 90, 40, 5, 8, '', '', 2, 1, NULL, NULL, 1),
(4, 'Sothe', 1, 18, 4, 20, 20, 15, 14, 9, 8, 8, 7, 35, 60, 20, 80, 45, 65, 20, 30, 30, 9, 3, NULL, NULL, 7, 1, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `units_bonds`
--

DROP TABLE IF EXISTS `units_bonds`;
CREATE TABLE IF NOT EXISTS `units_bonds` (
  `unit1_id` mediumint(8) UNSIGNED NOT NULL,
  `unit2_id` mediumint(8) UNSIGNED NOT NULL,
  `bonus` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit1_id`,`unit2_id`),
  KEY `unit1_id_idx` (`unit1_id`),
  KEY `unit2_id_idx` (`unit2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units_bonds`
--

INSERT INTO `units_bonds` (`unit1_id`, `unit2_id`, `bonus`) VALUES
(3, 4, 10);

-- --------------------------------------------------------

--
-- Structure de la table `units_classes`
--

DROP TABLE IF EXISTS `units_classes`;
CREATE TABLE IF NOT EXISTS `units_classes` (
  `class_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tier` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `max_hp` tinyint(3) UNSIGNED NOT NULL,
  `max_strength` tinyint(3) UNSIGNED NOT NULL,
  `max_magic` tinyint(3) UNSIGNED NOT NULL,
  `max_skill` tinyint(3) UNSIGNED NOT NULL,
  `max_speed` tinyint(3) UNSIGNED NOT NULL,
  `max_luck` tinyint(3) UNSIGNED NOT NULL,
  `max_defence` tinyint(3) UNSIGNED NOT NULL,
  `max_resistance` tinyint(3) UNSIGNED NOT NULL,
  `hp_growth` tinyint(3) UNSIGNED NOT NULL,
  `strength_growth` tinyint(3) UNSIGNED NOT NULL,
  `magic_growth` tinyint(3) UNSIGNED NOT NULL,
  `skill_growth` tinyint(3) UNSIGNED NOT NULL,
  `speed_growth` tinyint(3) UNSIGNED NOT NULL,
  `luck_growth` tinyint(3) UNSIGNED NOT NULL,
  `defence_growth` tinyint(3) UNSIGNED NOT NULL,
  `resistance_growth` tinyint(3) UNSIGNED NOT NULL,
  `base_hp` tinyint(3) UNSIGNED NOT NULL,
  `base_strength` tinyint(3) UNSIGNED NOT NULL,
  `base_magic` tinyint(3) UNSIGNED NOT NULL,
  `base_skill` tinyint(3) UNSIGNED NOT NULL,
  `base_speed` tinyint(3) UNSIGNED NOT NULL,
  `base_luck` tinyint(3) UNSIGNED NOT NULL,
  `base_defence` tinyint(3) UNSIGNED NOT NULL,
  `base_resistance` tinyint(3) UNSIGNED NOT NULL,
  `base_constitution` tinyint(3) UNSIGNED NOT NULL,
  `base_weight` tinyint(3) UNSIGNED NOT NULL,
  `base_movement` tinyint(3) UNSIGNED NOT NULL,
  `base_vision` tinyint(3) UNSIGNED NOT NULL,
  `sword_rank` varchar(2) DEFAULT NULL,
  `spear_rank` varchar(2) DEFAULT NULL,
  `axe_rank` varchar(2) DEFAULT NULL,
  `bow_rank` varchar(2) DEFAULT NULL,
  `knife_rank` varchar(2) DEFAULT NULL,
  `strike_rank` varchar(2) DEFAULT NULL,
  `fire_rank` varchar(2) DEFAULT NULL,
  `thunder_rank` varchar(2) DEFAULT NULL,
  `wind_rank` varchar(2) DEFAULT NULL,
  `light_rank` varchar(2) DEFAULT NULL,
  `dark_rank` varchar(2) DEFAULT NULL,
  `staff_rank` varchar(2) DEFAULT NULL,
  `skill_capacity` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units_classes`
--

INSERT INTO `units_classes` (`class_id`, `name`, `tier`, `max_hp`, `max_strength`, `max_magic`, `max_skill`, `max_speed`, `max_luck`, `max_defence`, `max_resistance`, `hp_growth`, `strength_growth`, `magic_growth`, `skill_growth`, `speed_growth`, `luck_growth`, `defence_growth`, `resistance_growth`, `base_hp`, `base_strength`, `base_magic`, `base_skill`, `base_speed`, `base_luck`, `base_defence`, `base_resistance`, `base_constitution`, `base_weight`, `base_movement`, `base_vision`, `sword_rank`, `spear_rank`, `axe_rank`, `bow_rank`, `knife_rank`, `strike_rank`, `fire_rank`, `thunder_rank`, `wind_rank`, `light_rank`, `dark_rank`, `staff_rank`, `skill_capacity`) VALUES
(1, 'Sniper', 2, 45, 27, 10, 30, 26, 30, 24, 16, 60, 35, 20, 45, 25, 50, 45, 25, 33, 18, 4, 19, 18, 0, 14, 10, 11, 12, 7, 3, NULL, NULL, NULL, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(2, 'Myrmidon', 1, 30, 20, 10, 20, 20, 30, 20, 10, 65, 40, 20, 45, 50, 30, 40, 40, 18, 6, 0, 10, 11, 0, 4, 0, 10, 10, 6, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15),
(3, 'Swordmaster (M)', 2, 40, 24, 15, 30, 30, 30, 23, 15, 50, 35, 35, 40, 35, 50, 40, 15, 30, 15, 6, 20, 21, 0, 13, 10, 11, 11, 7, 3, 'S+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(4, 'Trueblade (M)', 3, 55, 32, 20, 40, 40, 30, 26, 24, 0, 0, 0, 0, 0, 0, 0, 0, 49, 19, 3, 23, 21, 0, 16, 6, 11, 11, 7, 4, 'S+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(5, 'Light Mage', 1, 30, 10, 20, 20, 20, 40, 10, 20, 0, 0, 0, 0, 0, 0, 0, 0, 16, 0, 4, 5, 5, 0, 1, 7, 5, 5, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, 15),
(6, 'Light Sage', 2, 40, 15, 30, 23, 25, 40, 15, 30, 0, 0, 0, 0, 0, 0, 0, 0, 29, 1, 9, 9, 10, 0, 4, 12, 6, 6, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S', NULL, 'A', 30),
(7, 'Light Priestess', 3, 50, 22, 40, 35, 33, 40, 23, 40, 0, 0, 0, 0, 0, 0, 0, 0, 42, 3, 19, 19, 20, 0, 8, 20, 6, 6, 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'S+', NULL, 'S+', 60),
(8, 'Thief', 1, 30, 15, 10, 20, 20, 40, 15, 10, 55, 40, 10, 55, 45, 70, 40, 30, 16, 5, 0, 6, 10, 0, 3, 0, 9, 9, 7, 4, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15),
(9, 'Rogue (M)', 2, 40, 22, 15, 26, 30, 40, 20, 15, 65, 40, 55, 50, 50, 115, 40, 35, 28, 14, 5, 17, 20, 0, 12, 8, 10, 10, 7, 4, NULL, NULL, NULL, NULL, 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30);

-- --------------------------------------------------------

--
-- Structure de la table `units_classes_skills`
--

DROP TABLE IF EXISTS `units_classes_skills`;
CREATE TABLE IF NOT EXISTS `units_classes_skills` (
  `class_id` mediumint(8) UNSIGNED NOT NULL,
  `skill_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`class_id`,`skill_id`),
  KEY `units_classes_skills_class_skill_id_idx` (`skill_id`),
  KEY `units_classes_skills_class_id_idx` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units_classes_skills`
--

INSERT INTO `units_classes_skills` (`class_id`, `skill_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(2, 3),
(1, 4),
(3, 4),
(4, 6),
(8, 8),
(9, 8);

-- --------------------------------------------------------

--
-- Structure de la table `units_classes_traits`
--

DROP TABLE IF EXISTS `units_classes_traits`;
CREATE TABLE IF NOT EXISTS `units_classes_traits` (
  `class_id` mediumint(8) UNSIGNED NOT NULL,
  `trait_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`class_id`,`trait_id`),
  KEY `units_classes_traits_trait_id_fk_idx` (`trait_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `units_graphics`
--

DROP TABLE IF EXISTS `units_graphics`;
CREATE TABLE IF NOT EXISTS `units_graphics` (
  `unit_id` mediumint(8) UNSIGNED NOT NULL,
  `class_id` mediumint(8) UNSIGNED NOT NULL,
  `face` varchar(50) NOT NULL,
  `resources_folder` varchar(200) NOT NULL,
  PRIMARY KEY (`unit_id`,`class_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units_graphics`
--

INSERT INTO `units_graphics` (`unit_id`, `class_id`, `face`, `resources_folder`) VALUES
(3, 5, '15_1', 'micaiah_lightmage'),
(3, 6, '12_5', 'micaiah_lightsage'),
(3, 7, '15_5', 'micaiah_lightpriestess'),
(4, 9, '3_0', 'sothe_rogue');

-- --------------------------------------------------------

--
-- Structure de la table `units_skills`
--

DROP TABLE IF EXISTS `units_skills`;
CREATE TABLE IF NOT EXISTS `units_skills` (
  `unit_id` mediumint(8) UNSIGNED NOT NULL,
  `skill_id` mediumint(8) UNSIGNED NOT NULL,
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `ignore_capacity` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_id`,`skill_id`),
  KEY `units_skills_skill_id_fk_idx` (`skill_id`),
  KEY `units_skills_unit_id_fk_idx` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units_skills`
--

INSERT INTO `units_skills` (`unit_id`, `skill_id`, `locked`, `ignore_capacity`) VALUES
(2, 11, 0, 0),
(3, 10, 1, 1),
(4, 14, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `weapons`
--

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE IF NOT EXISTS `weapons` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `rank` varchar(2) DEFAULT NULL,
  `might` tinyint(3) NOT NULL DEFAULT '0',
  `hit` tinyint(3) NOT NULL DEFAULT '0',
  `crit` tinyint(3) DEFAULT '0',
  `weight` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `range_min` tinyint(2) UNSIGNED NOT NULL DEFAULT '1',
  `range_max` tinyint(2) UNSIGNED NOT NULL DEFAULT '1',
  `uses` tinyint(3) UNSIGNED DEFAULT NULL,
  `worth` mediumint(8) UNSIGNED DEFAULT NULL,
  `wexp` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `is_magic` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `weapons`
--

INSERT INTO `weapons` (`id`, `name`, `descr`, `icon`, `type`, `rank`, `might`, `hit`, `crit`, `weight`, `range_min`, `range_max`, `uses`, `worth`, `wexp`, `is_magic`) VALUES
(1, 'Slim Sword', NULL, '0_4', 'sword', 'E', 2, 100, 5, 3, 1, 1, 35, 560, 1, 0),
(2, 'Bronze Sword', 'Cannot critical', '21_4', 'sword', 'E', 3, 95, NULL, 5, 1, 1, 50, 350, 1, 0),
(3, 'Iron Sword', NULL, '1_4', 'sword', 'D', 6, 90, 0, 7, 1, 1, 50, 500, 2, 0),
(4, 'Venin Edge', 'Poisons on contact', '7_4', 'sword', 'D', 6, 90, 0, 7, 1, 1, 50, 300, 1, 0),
(5, 'Wind Edge', NULL, '12_4', 'sword', 'D', 6, 60, 0, 10, 1, 2, 20, 700, 2, 0),
(6, 'Steel Sword', NULL, '2_4', 'sword', 'C', 9, 85, 0, 11, 1, 1, 40, 800, 3, 0),
(7, 'Brave Sword', '2x attack', '8_4', 'sword', 'C', 9, 90, 0, 9, 1, 1, 40, 2800, 2, 0),
(8, 'Iron Blade', NULL, '4_4', 'sword', 'C', 10, 70, 0, 13, 1, 1, 40, 800, 3, 0),
(9, 'Wo Dao', NULL, '11_4', 'sword', 'B', 7, 90, 20, 7, 1, 1, 30, 3000, 3, 0),
(10, 'Killing Edge', NULL, '9_4', 'sword', 'B', 8, 85, 30, 8, 1, 1, 30, 3600, 2, 0),
(11, 'Wyrmslayer', 'Effective against dragons', '10_4', 'sword', 'B', 11, 70, 0, 14, 1, 1, 20, 3600, 3, 0),
(12, 'Steel Blade', NULL, '5_4', 'sword', 'B', 13, 65, 0, 17, 1, 1, 35, 1400, 4, 0),
(13, 'Storm Sword', NULL, '13_4', 'sword', 'B', 12, 50, 0, 11, 1, 2, 20, 4000, 3, 0),
(14, 'Silver Sword', NULL, '3_4', 'sword', 'A', 12, 80, 0, 10, 1, 1, 30, 1800, 5, 0),
(15, 'Silver Blade', NULL, '6_4', 'sword', 'A', 16, 60, 0, 16, 1, 1, 30, 3600, 5, 0),
(16, 'Tempest Blade', NULL, '14_4', 'sword', 'S', 18, 55, 5, 15, 1, 2, 20, 10000, 5, 0),
(17, 'Vague Katti', 'Def +3', '15_4', 'sword', 'S+', 20, 95, 5, 10, 1, 1, 50, 20000, 6, 0),
(18, 'Alondite', 'Def +5', '19_4', 'sword', 'S+', 18, 80, 5, 20, 1, 2, NULL, NULL, 8, 0),
(19, 'Ettard', 'Ike only', '17_4', 'sword', NULL, 12, 75, 10, 17, 1, 1, 50, NULL, 5, 0),
(20, 'Florete', 'Mist only', '16_4', 'sword', NULL, 14, 95, 15, 5, 1, 2, 45, 9000, 4, 0),
(21, 'Caladbolg', 'Edward only. Luck +8', '27_4', 'sword', NULL, 15, 85, 5, 8, 1, 1, 40, NULL, 2, 0),
(22, 'Amiti', '2x Attack. Elincia only. Def +3 and Res +3', '20_4', 'sword', NULL, 15, 90, 0, 10, 1, 1, NULL, NULL, 2, 0),
(23, 'Ragnell', 'Ike only. Def +5', '18_4', 'sword', NULL, 18, 80, 5, 20, 1, 2, NULL, NULL, 2, 0),
(24, 'Slim Lance', NULL, '1_5', 'spear', 'E', 3, 95, 5, 4, 1, 1, 35, 490, 1, 0),
(25, 'Bronze Lance', 'Cannot critical', '15_5', 'spear', 'E', 4, 90, 0, 6, 1, 1, 50, 450, 1, 0),
(26, 'Iron Lance', NULL, '0_5', 'spear', 'D', 7, 85, 0, 9, 1, 1, 50, 600, 2, 0),
(27, 'Venin Lance', 'Poisons on contact', '7_5', 'spear', 'D', 7, 85, 0, 9, 1, 1, 50, 350, 1, 0),
(28, 'Javelin', NULL, '11_5', 'spear', 'D', 7, 65, 0, 11, 1, 2, 20, 600, 2, 0),
(29, 'Horseslayer', 'Effective against horses', '10_5', 'spear', 'D', 15, 65, 0, 15, 1, 1, 20, 1300, 2, 0),
(30, 'Steel Lance', '', '2_5', 'spear', 'C', 10, 80, 0, 13, 1, 1, 40, 960, 3, 0),
(31, 'Brave Lance', '2x attack', '8_5', 'spear', 'C', 10, 85, 0, 11, 1, 1, 40, 2960, 2, 0),
(32, 'Iron Greatlance', NULL, '4_5', 'spear', 'C', 11, 75, 0, 14, 1, 1, 40, 640, 3, 0),
(33, 'Killer Lance', NULL, '9_5', 'spear', 'B', 9, 80, 30, 10, 1, 1, 30, 4320, 2, 0),
(34, 'Short Spear', NULL, '12_5', 'spear', 'B', 10, 55, 0, 12, 1, 2, 20, 3000, 3, 0),
(35, 'Steel Greatlance', NULL, '5_5', 'spear', 'B', 14, 70, 0, 18, 1, 1, 35, 1120, 4, 0),
(36, 'Silver Lance', NULL, '3_5', 'spear', 'A', 13, 80, 0, 12, 1, 1, 30, 2160, 5, 0),
(37, 'Silver Greatlance', NULL, '6_5', 'spear', 'A', 17, 50, 0, 17, 1, 1, 30, 2880, 5, 0),
(38, 'Spear', NULL, '13_5', 'spear', 'S', 13, 60, 5, 16, 1, 2, 20, 9000, 5, 0),
(39, 'Wishblade', 'Luck +3', '14_5', 'spear', 'S+', 22, 100, 5, 15, 1, 2, 50, 15500, 6, 0),
(41, 'Bronze Axe', 'Cannot critical', '16_5', 'axe', 'E', 5, 85, 0, 7, 1, 1, 50, 250, 2, 0),
(42, 'Iron Axe', NULL, '17_5', 'axe', 'D', 8, 80, 0, 11, 1, 1, 50, 400, 2, 0),
(43, 'Venin Axe', 'Poisons on contact', '23_5', 'axe', 'D', 8, 80, 0, 11, 1, 1, 50, 250, 1, 0),
(44, 'Hand Axe', NULL, '28_5', 'axe', 'D', 9, 70, 0, 12, 1, 2, 25, 625, 2, 0),
(45, 'Hammer', 'Effective against armours', '26_5', 'axe', 'D', 13, 60, 0, 17, 1, 1, 20, 800, 2, 0),
(46, 'Steel Axe', NULL, '18_5', 'axe', 'C', 11, 75, 0, 15, 1, 1, 40, 640, 3, 0),
(47, 'Brave Axe', '2x attack', '24_5', 'axe', 'C', 11, 80, 0, 13, 1, 1, 40, 2640, 2, 0),
(48, 'Iron Poleax', NULL, '20_5', 'axe', 'C', 12, 65, 0, 16, 1, 1, 40, 400, 3, 0),
(49, 'Killer Axe', NULL, '25_5', 'axe', 'B', 10, 75, 30, 12, 1, 1, 30, 2880, 2, 0),
(50, 'Short Axe', NULL, '29_5', 'axe', 'B', 12, 60, 0, 13, 1, 2, 15, 1500, 3, 0),
(51, 'Steel Poleax', NULL, '21_5', 'axe', 'B', 15, 60, 0, 20, 1, 1, 35, 700, 4, 0),
(52, 'Silver Axe', NULL, '19_5', 'axe', 'A', 14, 70, 0, 14, 1, 1, 30, 1440, 5, 0),
(53, 'Silver Poleax', NULL, '22_5', 'axe', 'A', 18, 60, 0, 19, 1, 1, 30, 1800, 5, 0),
(54, 'Tomahawk', NULL, '30_5', 'axe', 'S', 15, 65, 5, 17, 1, 2, 15, 6000, 5, 0),
(55, 'Urvan', 'Res +3', '31_5', 'axe', 'S+', 22, 110, 5, 17, 1, 1, 50, 15000, 6, 0),
(56, 'Tarvos', 'Nolan only. Def +4', '31_8', 'axe', NULL, 18, 100, 5, 12, 1, 1, 40, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `weapons_traits_bonus`
--

DROP TABLE IF EXISTS `weapons_traits_bonus`;
CREATE TABLE IF NOT EXISTS `weapons_traits_bonus` (
  `weapon_id` mediumint(8) UNSIGNED NOT NULL,
  `trait_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`weapon_id`,`trait_id`),
  KEY `weapons_traits_bonus_trait_id_fk_idx` (`trait_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `weapons_traits_bonus`
--

INSERT INTO `weapons_traits_bonus` (`weapon_id`, `trait_id`) VALUES
(11, 1),
(11, 2),
(45, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `accounts_data`
--
ALTER TABLE `accounts_data`
  ADD CONSTRAINT `accounts_data_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `accounts_units`
--
ALTER TABLE `accounts_units`
  ADD CONSTRAINT `accounts_units_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `units_classes` (`class_id`);

--
-- Contraintes pour la table `accounts_units_items`
--
ALTER TABLE `accounts_units_items`
  ADD CONSTRAINT `accounts_units_items_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_items_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_items_item_instance_id_fk` FOREIGN KEY (`item_instance_id`) REFERENCES `items_instances` (`item_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `accounts_units_supports`
--
ALTER TABLE `accounts_units_supports`
  ADD CONSTRAINT `accounts_units_supports_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_supports_unit1_id` FOREIGN KEY (`unit1_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_units_supports_unit2_id` FOREIGN KEY (`unit2_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `accounts_warehouses`
--
ALTER TABLE `accounts_warehouses`
  ADD CONSTRAINT `accounts_warehouses_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_warehouses_item_instance_id_fk` FOREIGN KEY (`item_instance_id`) REFERENCES `items_instances` (`item_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `biorhythm_waves`
--
ALTER TABLE `biorhythm_waves`
  ADD CONSTRAINT `biorhythm_waves_ibfk_1` FOREIGN KEY (`biorhythm_id`) REFERENCES `biorhythm` (`biorhythm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `units_classes` (`class_id`),
  ADD CONSTRAINT `units_ibfk_2` FOREIGN KEY (`affinity_id`) REFERENCES `affinities` (`affinity_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `units_ibfk_3` FOREIGN KEY (`faction_id`) REFERENCES `factions` (`faction_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `units_ibfk_4` FOREIGN KEY (`leader_id`) REFERENCES `units` (`unit_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `units_race_id_fk` FOREIGN KEY (`race_id`) REFERENCES `races` (`race_id`);

--
-- Contraintes pour la table `units_bonds`
--
ALTER TABLE `units_bonds`
  ADD CONSTRAINT `units_bonds_ibfk_1` FOREIGN KEY (`unit1_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `units_bonds_ibfk_2` FOREIGN KEY (`unit2_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `units_classes_skills`
--
ALTER TABLE `units_classes_skills`
  ADD CONSTRAINT `class_id` FOREIGN KEY (`class_id`) REFERENCES `units_classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `units_classes_traits`
--
ALTER TABLE `units_classes_traits`
  ADD CONSTRAINT `units_classes_traits_class_id_fk` FOREIGN KEY (`class_id`) REFERENCES `units_classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `units_classes_traits_trait_id_fk` FOREIGN KEY (`trait_id`) REFERENCES `traits` (`trait_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `units_graphics`
--
ALTER TABLE `units_graphics`
  ADD CONSTRAINT `units_graphics_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `units_graphics_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `units_classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `units_skills`
--
ALTER TABLE `units_skills`
  ADD CONSTRAINT `units_skills_unit_id_fk` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `weapons_traits_bonus`
--
ALTER TABLE `weapons_traits_bonus`
  ADD CONSTRAINT `weapons_traits_bonus_trait_id_fk` FOREIGN KEY (`trait_id`) REFERENCES `traits` (`trait_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weapons_traits_bonus_weapon_id_fk` FOREIGN KEY (`weapon_id`) REFERENCES `weapons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
