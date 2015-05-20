-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mag 20, 2015 alle 14:23
-- Versione del server: 5.5.41-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysite`
--
CREATE DATABASE IF NOT EXISTS `mysite` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mysite`;

-- --------------------------------------------------------

--
-- Struttura della tabella `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` tinytext NOT NULL,
  `descrizione` text NOT NULL,
  `immagine` text NOT NULL,
  `inserzionista` tinytext NOT NULL,
  `emailinserzionista` tinytext NOT NULL,
  `inserzionista_id` bigint(20) NOT NULL,
  `prezzo` int(11) NOT NULL,
  `disponibili` int(11) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `items`
--

INSERT INTO `items` (`id`, `nome`, `descrizione`, `immagine`, `inserzionista`, `emailinserzionista`, `inserzionista_id`, `prezzo`, `disponibili`, `data`) VALUES
(1, 'Bicicletta', 'Bicicletta nuovissima mai usata', 'http://vocearancio.ingdirect.it/wp-content/uploads/2014/03/bici-12.jpeg', 'Nicola Prozzi', 'nico@ssa.it', 14, 100, 5, '0000-00-00 00:00:00'),
(2, 'Barca a motore', 'Barca a motore di 16.6 metri', 'http://www.nautica.patentati.it/notizie/foto/azimut-atlantis-50-coupe-sfondo-bianco.jpg', 'Nicola Prozzi', 'nico@ssa.it', 14, 500000, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

DROP TABLE IF EXISTS `messaggi`;
CREATE TABLE IF NOT EXISTS `messaggi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_mittente` bigint(20) NOT NULL,
  `id_destinatario` bigint(20) NOT NULL,
  `id_prodotto` bigint(20) NOT NULL,
  `testo` text NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `data` datetime NOT NULL,
  `cancellato` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `mittente_fk` (`id_mittente`),
  KEY `destinatario_fk` (`id_destinatario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`id`, `id_mittente`, `id_destinatario`, `id_prodotto`, `testo`, `letto`, `data`, `cancellato`) VALUES
(1, 13, 14, 2, 'Salve sarei interessato ad acquistare il suo articolo', 0, '2015-05-20 14:20:39', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo` tinyint(4) NOT NULL,
  `nome` tinytext NOT NULL,
  `cognome` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `via` text NOT NULL,
  `citta` text NOT NULL,
  `sesso` tinytext NOT NULL,
  `ultimo_accesso` datetime NOT NULL,
  `remember` mediumtext NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `tipo`, `nome`, `cognome`, `email`, `password`, `via`, `citta`, `sesso`, `ultimo_accesso`, `remember`, `data`) VALUES
(13, 0, 'Andrea', 'Corda', 'cordand@gmail.com', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'Toscanini 15', 'Santa Giust', '0', '2015-05-20 14:20:21', '', '0000-00-00 00:00:00'),
(14, 1, 'Nicola', 'Prozzi', 'nico@ssa.it', '*CC67043C7BCFF5EEA5566BD9B1F3C74FD9A5CF5D', 'Di Prova', 'Quella', '0', '2015-05-20 13:54:22', '', '0000-00-00 00:00:00');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  ADD CONSTRAINT `destinatario_fk` FOREIGN KEY (`id_destinatario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mittente_fk` FOREIGN KEY (`id_mittente`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
