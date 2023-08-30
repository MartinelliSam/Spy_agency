-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.10.2-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour spy_agency
CREATE DATABASE IF NOT EXISTS `spy_agency` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `spy_agency`;

-- Listage de la structure de la table spy_agency. agent
CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `identificationCode` int(3) unsigned zerofill NOT NULL,
  `idNationality` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idNationality` (`idNationality`) USING BTREE,
  CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`idNationality`) REFERENCES `nationality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.agent : ~15 rows (environ)
/*!40000 ALTER TABLE `agent` DISABLE KEYS */;
INSERT INTO `agent` (`id`, `lastName`, `firstName`, `birthdate`, `identificationCode`, `idNationality`) VALUES
	(1, 'Doe', 'John', '1985-08-12', 741, 3),
	(2, 'Dupond', 'Jean', '1989-03-15', 123, 1),
	(3, 'Dimitrov', 'Alexeï', '1987-07-07', 774, 2),
	(4, 'Rana', 'Gianna', '1993-11-22', 009, 4),
	(5, 'Kahani', 'Milad', '1995-08-26', 224, 6),
	(6, 'Castillo', 'Carmen', '1983-02-11', 016, 8),
	(7, 'Coste', 'Victor', '1980-04-16', 945, 1),
	(8, 'Craighead', 'Nikki', '1984-08-09', 994, 3),
	(9, 'Grisley', 'Whitby', '1981-10-14', 443, 13),
	(10, 'Collum', 'Nikolaus', '1994-11-04', 349, 9),
	(11, 'Rollingson', 'Matti', '1989-09-26', 646, 11),
	(12, 'Beau', 'Conan', '1991-07-01', 373, 13),
	(13, 'Aleksahkin', 'Marco', '2003-03-22', 946, 5),
	(14, 'Juschke', 'Garv', '1982-03-25', 308, 2),
	(15, 'Vail', 'Kahaleel', '1992-07-11', 049, 10);
/*!40000 ALTER TABLE `agent` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. agentspeciality
CREATE TABLE IF NOT EXISTS `agentspeciality` (
  `idAgent` int(11) NOT NULL,
  `idSpeciality` int(11) NOT NULL,
  KEY `idAgent` (`idAgent`) USING BTREE,
  KEY `idSpeciality` (`idSpeciality`) USING BTREE,
  CONSTRAINT `agentspeciality_ibfk_1` FOREIGN KEY (`idAgent`) REFERENCES `agent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agentspeciality_ibfk_2` FOREIGN KEY (`idSpeciality`) REFERENCES `speciality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.agentspeciality : ~21 rows (environ)
/*!40000 ALTER TABLE `agentspeciality` DISABLE KEYS */;
INSERT INTO `agentspeciality` (`idAgent`, `idSpeciality`) VALUES
	(1, 1),
	(2, 3),
	(2, 5),
	(3, 4),
	(4, 2),
	(4, 5),
	(5, 2),
	(5, 6),
	(6, 3),
	(7, 2),
	(7, 4),
	(8, 4),
	(9, 4),
	(9, 5),
	(10, 1),
	(11, 3),
	(12, 6),
	(13, 2),
	(13, 3),
	(14, 1),
	(15, 6);
/*!40000 ALTER TABLE `agentspeciality` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `codeName` varchar(50) NOT NULL,
  `idNationality` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idNationality` (`idNationality`) USING BTREE,
  CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`idNationality`) REFERENCES `nationality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.contact : ~15 rows (environ)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`, `lastName`, `firstName`, `birthdate`, `codeName`, `idNationality`) VALUES
	(1, 'Després', 'Roger', '1987-01-25', 'La Fouine', 1),
	(2, 'Meyer', 'Kevin', '1997-05-10', 'Snitch', 3),
	(3, 'Plomo', 'Mario', '1984-12-26', 'Narcos', 8),
	(4, 'Dimitriska', 'Petrova', '1996-07-09', 'La Veuve Noire', 2),
	(5, 'Kamali', 'Faraz', '1968-02-15', 'Le Patron', 6),
	(6, 'Gustavsson', 'Carl', '1988-06-03', 'Le Viking', 11),
	(7, 'Consort', 'Kevin', '1977-11-23', 'La sangsue', 1),
	(8, 'Kenan', 'Turan', '1989-12-01', 'Bachibouzouk', 10),
	(9, 'Decleir', 'Jan', '1979-01-26', 'Waterloo', 9),
	(10, 'Sepulveda', 'Luis', '1973-07-28', 'Le Conteur', 8),
	(11, 'Carapelli', 'Angelo', '1985-08-12', 'Pavarotti', 4),
	(12, 'Zoppini', 'Angela', '1976-11-28', 'Mama', 5),
	(13, 'Koppek', 'Dan', '1965-02-09', 'Tulipe', 7),
	(14, 'Felipe', 'Juan', '1988-05-15', 'El Diablo', 12),
	(15, 'Gagnon', 'Justin', '1984-03-20', 'Le bûcheron', 13);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.country : ~11 rows (environ)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `name`) VALUES
	(1, 'France'),
	(2, 'Russie'),
	(3, 'USA'),
	(4, 'Italie'),
	(5, 'Espagne'),
	(6, 'Iran'),
	(7, 'Pays-Bas'),
	(8, 'Chili'),
	(9, 'Israël'),
	(10, 'Allemagne'),
	(11, 'Chine'),
	(12, 'Colombie'),
	(13, 'Belgique');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. hideout
CREATE TABLE IF NOT EXISTS `hideout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `idCountry` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE,
  KEY `idCountry` (`idCountry`) USING BTREE,
  CONSTRAINT `hideout_ibfk_1` FOREIGN KEY (`idCountry`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.hideout : ~15 rows (environ)
/*!40000 ALTER TABLE `hideout` DISABLE KEYS */;
INSERT INTO `hideout` (`id`, `code`, `address`, `type`, `idCountry`) VALUES
	(1, 1234, '23 rue du Paradis, 75012 Paris', 'appartement', 1),
	(2, 3675, '1570 Oak Street, 94016 San Francisco', 'maison', 3),
	(3, 4768, 'Masterskaya Bdg 3, Moscou', 'chambre d\'hôtel', 2),
	(4, 9964, '56 Via Roma, Naples', 'cave', 4),
	(5, 4978, '61B Glienicker Strasse, Berlin', 'appartement', 10),
	(6, 3364, 'Qing Nian Lu 450, Pékin', 'immeuble désaffecté', 11),
	(7, 7123, 'Inglaterra 25, Madrid', 'cave', 5),
	(8, 3496, '37 Hayam Road, Tel-Aviv', 'appartement', 9),
	(9, 7701, '185 Viale Cortina d\'Ampezzo, Rome', 'maison', 4),
	(10, 6910, 'Strepestraat 404, Liège', 'hôpital désaffecté', 13),
	(11, 2246, 'Sad Gheysari Alley, Téhéran', 'ambassade', 6),
	(12, 4321, 'Grotestraat 80, Amsterdam', 'maison', 7),
	(13, 5579, 'Seeduker 60, Rotterdam', 'entrepôt désaffecté', 7),
	(14, 8888, 'Santa Elena Norte, Santiago', 'appartement', 8),
	(15, 3461, 'Rio de Oro 555, Cali', 'école', 12);
/*!40000 ALTER TABLE `hideout` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. mission
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `codeName` varchar(50) NOT NULL,
  `beginsAt` date NOT NULL,
  `endsAt` date NOT NULL,
  `idMissionType` int(11) NOT NULL,
  `idMissionStatus` int(11) NOT NULL,
  `idCountry` int(11) NOT NULL,
  `idSpeciality` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idMissionType` (`idMissionType`),
  KEY `idMissionStatus` (`idMissionStatus`),
  KEY `idCountry` (`idCountry`),
  KEY `idSpeciality` (`idSpeciality`),
  CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`idMissionType`) REFERENCES `missiontype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`idMissionStatus`) REFERENCES `missionstatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mission_ibfk_3` FOREIGN KEY (`idCountry`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mission_ibfk_4` FOREIGN KEY (`idSpeciality`) REFERENCES `speciality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.mission : ~10 rows (environ)
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
INSERT INTO `mission` (`id`, `title`, `description`, `codeName`, `beginsAt`, `endsAt`, `idMissionType`, `idMissionStatus`, `idCountry`, `idSpeciality`) VALUES
	(1, 'La chasse au fantôme est ouverte', 'Dorothy Jones est une figure importante aux USA, et elle ne laisse que peu de traces de ses transactions illégales. Trouvez un moyen de la faire parler.', 'Ghostbusters', '2023-08-09', '2023-08-10', 3, 4, 3, 5),
	(2, 'Voler les plans du réacteur nucléaire', 'S\'introduire dans le réacteur, et voler les plans cachés dans le service scientifique. Meurtre si nécessaire', 'Nuclear', '2023-08-18', '2023-08-21', 2, 2, 1, 6),
	(3, 'Demande de rançon', 'Après avoir kidnappé la fille chérie du ministre de l\'intérieur belge, procéder à la demande de rançon de 500 000€.            ', 'Paytime', '2023-08-30', '2023-09-09', 4, 1, 13, 4),
	(4, 'Non è la Dolce Vita', 'Gianni Rotondo, directeur du service de renseignement italien, est responsable de la perte de l\'un des nôtres. Cette année, il passe ses vacances au Chili, avec ses proches. Il est temps de lui rendre la monnaie de sa pièce.', 'Vengeance', '2023-08-26', '2023-08-26', 1, 1, 8, 1),
	(5, 'Annihilation totale', 'Assassinat de la cible et de tout témoin potentiel', 'Wipeout', '2023-08-18', '2023-08-21', 1, 1, 2, 1),
	(6, 'Tour, un petit tour', 'Odde Bessie, célèbre hackeur suédois, se planque à Rome. Il faut se débarasser de lui, il en sait trop.', 'Manège', '2023-08-01', '2023-08-02', 1, 2, 4, 2),
	(7, 'Nouvelle identité sous couverture', 'Faites-vous passer pour un riche homme d\'affaires afin de rentrer en contact avec la cible. Une fois le contact établi, disparaissez rapidement afin de ne pas éveiller les soupçons.', 'Upgrade', '2023-08-10', '2023-08-14', 6, 2, 5, 3),
	(8, 'Retour sur les bancs de la fac', 'La cible est un professeur controversé qui enseigne à l\'université de Téhéran, et qui distille certaines idées bien arrêtées sur le gouvernement iranien. Rapprochez-vous de ses élèves, et engrenez-les afin qu\'ils manifestes contre ces idées.', 'Liberté', '2023-08-15', '2023-08-17', 8, 2, 6, 5),
	(9, 'Trouver, casser, se sauver', 'La cible gère son trafic depuis un entrepôt situé sur le port d\'Amsterdam. Faites en sorte que cet entrepôt soit inutilisable, afin que la cible ne puisse plus continuer. Ne vous faites pas prendre !! ', 'Warehouse', '2023-07-27', '2023-07-30', 7, 4, 7, 6),
	(10, 'D\'une pierre deux coups', 'Le couple Jérôme - Maria, dirigeants de la société MPC, sont soupçonnés de détournement de fonds. Infiltrez leur société et trouvez un maximum de renseignements.', 'Stone', '2023-10-09', '2023-10-15', 5, 3, 1, 2);
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missionagent
CREATE TABLE IF NOT EXISTS `missionagent` (
  `idMission` int(11) NOT NULL,
  `idAgent` int(11) NOT NULL,
  KEY `idMission` (`idMission`),
  KEY `idAgent` (`idAgent`),
  CONSTRAINT `missionagent_ibfk_1` FOREIGN KEY (`idMission`) REFERENCES `mission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `missionagent_ibfk_2` FOREIGN KEY (`idAgent`) REFERENCES `agent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missionagent : ~16 rows (environ)
/*!40000 ALTER TABLE `missionagent` DISABLE KEYS */;
INSERT INTO `missionagent` (`idMission`, `idAgent`) VALUES
	(5, 3),
	(5, 2),
	(2, 6),
	(2, 7),
	(3, 9),
	(3, 12),
	(4, 3),
	(4, 14),
	(1, 2),
	(1, 4),
	(6, 5),
	(7, 11),
	(8, 9),
	(9, 15),
	(10, 4),
	(10, 7);
/*!40000 ALTER TABLE `missionagent` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missioncontact
CREATE TABLE IF NOT EXISTS `missioncontact` (
  `idMission` int(11) NOT NULL,
  `idContact` int(11) NOT NULL,
  KEY `idMission` (`idMission`),
  KEY `idContact` (`idContact`),
  CONSTRAINT `missioncontact_ibfk_1` FOREIGN KEY (`idMission`) REFERENCES `mission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `missioncontact_ibfk_2` FOREIGN KEY (`idContact`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missioncontact : ~13 rows (environ)
/*!40000 ALTER TABLE `missioncontact` DISABLE KEYS */;
INSERT INTO `missioncontact` (`idMission`, `idContact`) VALUES
	(5, 4),
	(2, 1),
	(2, 7),
	(3, 9),
	(4, 3),
	(4, 10),
	(1, 2),
	(6, 11),
	(7, 12),
	(8, 5),
	(9, 13),
	(10, 1),
	(10, 7);
/*!40000 ALTER TABLE `missioncontact` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missionhideout
CREATE TABLE IF NOT EXISTS `missionhideout` (
  `idMission` int(11) NOT NULL,
  `idHideout` int(11) NOT NULL,
  KEY `idMission` (`idMission`),
  KEY `idHideout` (`idHideout`),
  CONSTRAINT `missionhideout_ibfk_1` FOREIGN KEY (`idMission`) REFERENCES `mission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `missionhideout_ibfk_2` FOREIGN KEY (`idHideout`) REFERENCES `hideout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missionhideout : ~9 rows (environ)
/*!40000 ALTER TABLE `missionhideout` DISABLE KEYS */;
INSERT INTO `missionhideout` (`idMission`, `idHideout`) VALUES
	(2, 1),
	(3, 10),
	(1, 2),
	(6, 9),
	(7, 7),
	(8, 11),
	(9, 12),
	(9, 13),
	(10, 1);
/*!40000 ALTER TABLE `missionhideout` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missionstatus
CREATE TABLE IF NOT EXISTS `missionstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missionstatus : ~4 rows (environ)
/*!40000 ALTER TABLE `missionstatus` DISABLE KEYS */;
INSERT INTO `missionstatus` (`id`, `name`) VALUES
	(1, 'en cours'),
	(2, 'terminée'),
	(3, 'en attente'),
	(4, 'échec');
/*!40000 ALTER TABLE `missionstatus` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missiontarget
CREATE TABLE IF NOT EXISTS `missiontarget` (
  `idMission` int(11) NOT NULL,
  `idTarget` int(11) NOT NULL,
  KEY `idMission` (`idMission`),
  KEY `idTarget` (`idTarget`),
  CONSTRAINT `missiontarget_ibfk_1` FOREIGN KEY (`idMission`) REFERENCES `mission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `missiontarget_ibfk_2` FOREIGN KEY (`idTarget`) REFERENCES `target` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missiontarget : ~11 rows (environ)
/*!40000 ALTER TABLE `missiontarget` DISABLE KEYS */;
INSERT INTO `missiontarget` (`idMission`, `idTarget`) VALUES
	(5, 1),
	(2, 2),
	(3, 8),
	(4, 6),
	(1, 1),
	(6, 13),
	(7, 14),
	(8, 12),
	(9, 7),
	(10, 9),
	(10, 10);
/*!40000 ALTER TABLE `missiontarget` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. missiontype
CREATE TABLE IF NOT EXISTS `missiontype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.missiontype : ~8 rows (environ)
/*!40000 ALTER TABLE `missiontype` DISABLE KEYS */;
INSERT INTO `missiontype` (`id`, `name`) VALUES
	(1, 'Assassinat'),
	(2, 'Vol de données sensibles'),
	(3, 'Extorsion'),
	(4, 'Kidnapping'),
	(5, 'Infiltration'),
	(6, 'Sous couverture'),
	(7, 'Dégradation'),
	(8, 'Propagande');
/*!40000 ALTER TABLE `missiontype` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. nationality
CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.nationality : ~13 rows (environ)
/*!40000 ALTER TABLE `nationality` DISABLE KEYS */;
INSERT INTO `nationality` (`id`, `name`) VALUES
	(1, 'France'),
	(2, 'Russie'),
	(3, 'USA'),
	(4, 'Italie'),
	(5, 'Espagne'),
	(6, 'Iran'),
	(7, 'Pays-Bas'),
	(8, 'Chili'),
	(9, 'Belgique'),
	(10, 'Turquie'),
	(11, 'Suède'),
	(12, 'Mexique'),
	(13, 'Canada');
/*!40000 ALTER TABLE `nationality` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. speciality
CREATE TABLE IF NOT EXISTS `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.speciality : ~6 rows (environ)
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` (`id`, `name`, `description`) VALUES
	(1, 'Assassinat discret', 'Permet d\'assassiner la cible sans se faire repérer'),
	(2, 'Art du déguisement', 'Maîtrise des déguisements, divers accessoires et du camouflage'),
	(3, 'Fuite rapide', 'Permet de s\'échapper très rapidement lors d\'une mission en terrain hostile'),
	(4, 'Persuasion', 'Permet de convaincre la cible de livrer des informations, avant son issue fatale, car elle est toujours fatale...'),
	(5, 'Super charisme', 'Besoin d\'une info, de charmer, de convaincre ? Tout est possible grâce au super charisme'),
	(6, 'Doigts d\'argent', 'Maîtrise des couteaux et divers objets tranchants');
/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. target
CREATE TABLE IF NOT EXISTS `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `codeName` varchar(50) NOT NULL,
  `idNationality` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idNationality` (`idNationality`) USING BTREE,
  CONSTRAINT `target_ibfk_1` FOREIGN KEY (`idNationality`) REFERENCES `nationality` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.target : ~15 rows (environ)
/*!40000 ALTER TABLE `target` DISABLE KEYS */;
INSERT INTO `target` (`id`, `lastName`, `firstName`, `birthdate`, `codeName`, `idNationality`) VALUES
	(1, 'Jones', 'Dorothy', '1986-02-16', 'Fantôme', 3),
	(2, 'Tchaïkovski', 'Romuald', '1983-08-12', 'Maître d\'orchestre', 2),
	(3, 'Desmontour', 'Roger', '1967-10-20', 'Monocle', 1),
	(4, 'Backus', 'Robert', '1970-04-16', 'Le Poète', 3),
	(5, 'Mesrine', 'Jacques', '1979-11-02', 'Ennemi public', 1),
	(6, 'Rotondo', 'Gianni', '1980-12-14', 'La Vespa', 4),
	(7, 'Vanderdendur', 'Dan', '1992-12-12', 'Le Négociant', 7),
	(8, 'De Vries', 'Marieke', '2005-06-06', 'Dutchess', 9),
	(9, 'Capricia', 'Maria', '1986-01-28', 'Précieuse', 5),
	(10, 'Williams', 'Jérôme', '1987-04-24', 'Feuille d\'érable', 13),
	(11, 'Tomes', 'Donetta', '1991-05-26', 'Done', 8),
	(12, 'Bilfoot', 'Elberta', '1999-10-25', 'La Bile', 6),
	(13, 'Odde', 'Bessie', '1990-01-10', 'Scand', 11),
	(14, 'Giacobillo', 'Rosalinde', '1982-11-13', 'Precious Rose', 12),
	(15, 'Skyrm', 'Ogdan', '1989-12-13', 'L\'Ogre', 10);
/*!40000 ALTER TABLE `target` ENABLE KEYS */;

-- Listage de la structure de la table spy_agency. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(60) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table spy_agency.user : ~0 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `lastName`, `firstName`, `email`, `password`, `role`) VALUES
	(1, 'Name', 'User', 'email', 'passwordhashé', '["ROLE_ADMIN"]');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
spy_agencye