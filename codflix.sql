-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 06, 2020 at 08:35 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE;


--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_fk_media_id` (`user_id`),
  ADD KEY `history_media_id_fk_media_id` (`media_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- --------------------------------------------------------

-- SQL ADDED BY APELERIN

--
-- Dumping testing data for table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 1, 'Pacific Rim', 'Film', 'Publié', '1993-05-13', 'Lors de l''exode des populations civiles françaises en juin 1940, la petite Paulette et ses parents fuient Paris. Leur voiture tombe en panne et ils doivent continuer à pied. Au moment où des avions allemands mitraillent la colonne de réfugiés, le chien de Paulette prend peur et dans le chaos, Paulette voit mourir ses parents. Elle est recueillie par un couple âgé qui, constatant que le chien que porte l''enfant est mort, le jette à la rivière. Paulette court retrouver son chien. Cette recherche l''amène à rencontrer un jeune paysan, Michel, qui l''invite chez lui.', 'https://www.youtube.com/embed/5guMumPFBag'),
(2, 2, 'Halloween', 'Film', 'Publié', '1998-08-17', 'Jack Crawford envoie Clarice auprès du docteur Hannibal Lecter alias « Hannibal le Cannibale », éminent psychiatre emprisonné depuis huit ans dans une cellule de très haute sécurité de l''hôpital psychiatrique de Baltimore dirigé par le docteur Chilton. Jack Crawford espère que Clarice pourra en retirer des informations capitales sur Buffalo Bill.', 'https://www.youtube.com/embed/5guMumPFBag'),
(3, 3, 'Star trek', 'Film', 'Publié', '2013-01-01', 'Randal, triste du départ de son meilleur ami, organise une fête en son honneur et veut réhabiliter une expression, qui selon lui, n''est pas raciste. Becky, après un cours de danse pour Dante, apprend que ce dernier est amoureux d''elle. De plus, elle lui annonce qu''elle est enceinte de lui. Dante est alors balancé entre partir avec Emma et démarrer une nouvelle vie ou rester avec Becky, qu''il aime depuis un moment.', 'https://www.youtube.com/embed/5guMumPFBag'),
(4, 2, 'Little Misfortune', 'Série', 'Publié', '2019-12-05', 'Misfortune Ramirez Hernandez, an imaginative 8-year-old, seeks the prize of Eternal Happiness, as a gift to her Mommy. Led by her new friend, Mr. Voice, they venture into the woods, where mysteries are unraveled and a little bit of bad luck unfolds.', 'https://www.youtube.com/embed/ScO3SsbcFSU');

--
-- Table structure for table `show_episode`
--

DROP TABLE IF EXISTS `show_episode`;
CREATE TABLE `show_episode` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `summary` longtext NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `stream_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Add primary key to show_episode
--

ALTER TABLE `show_episode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `show_episode`
--

ALTER TABLE `show_episode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraint for table `show_episode`
--

ALTER TABLE `show_episode`
  ADD CONSTRAINT `show_episode_fk_genre_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Dumping testing data for table `show_episode`
--

INSERT INTO `show_episode` (`id`, `media_id`, `duration`, `summary`, `season`, `episode`, `release_date`, `stream_url`) VALUES
(1, 4, 120, 'A brave Scottish general named Macbeth receives a prophecy from a trio of witches that one day he will become King of Scotland.', 1, 1, '2019-12-05', 'https://www.youtube.com/embed/EdS2kCUGvfo'),
(2, 4, 1600, 'A brave Scottish general named Macbeth receives a prophecy from a trio of witches that one day he will become King of Scotland.', 1, 2, '2019-12-25', 'https://www.youtube.com/embed/KzW727RY-ig'),
(3, 4, 650, 'A brave Scottish general named Macbeth receives a prophecy from a trio of witches that one day he will become King of Scotland.', 2, 1, '2020-02-15', 'https://www.youtube.com/embed/HBNGoDZURBE'),
(4, 4, 450, 'A brave Scottish general named Macbeth receives a prophecy from a trio of witches that one day he will become King of Scotland.', 2, 2, '2019-03-05', 'https://www.youtube.com/embed/4MYpGMx6zUY');

--
-- Add columns to `user` table for the confirmation by email
--

ALTER TABLE `user`
    ADD COLUMN `key` VARCHAR(32) NOT NULL;

ALTER TABLE `user`
    ADD COLUMN `activated` INT(1) NOT NULL;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
