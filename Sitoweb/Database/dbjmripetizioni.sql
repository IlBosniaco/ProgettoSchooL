-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 21, 2022 alle 11:57
-- Versione del server: 10.4.6-MariaDB
-- Versione PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbjmripetizioni`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `giorni`
--

CREATE TABLE `giorni` (
  `id` int(11) NOT NULL,
  `giorno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `giornitutor`
--

CREATE TABLE `giornitutor` (
  `idtutor` int(11) NOT NULL,
  `idgiorno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezioni`
--

CREATE TABLE `lezioni` (
  `id` int(11) NOT NULL,
  `id_tutor` int(11) NOT NULL,
  `id_alunno` int(11) NOT NULL,
  `orainizio` time NOT NULL,
  `orafine` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `materiatutor`
--

CREATE TABLE `materiatutor` (
  `idtutor` int(11) NOT NULL,
  `idmaterie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `id` int(11) NOT NULL,
  `materia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tutor`
--

CREATE TABLE `tutor` (
  `id_utente` int(11) NOT NULL,
  `id_materie` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `valutazione` int(11) NOT NULL,
  `numero_recensioni` int(11) NOT NULL,
  `id_giorni` int(11) NOT NULL,
  `prezzi_ora` float NOT NULL,
  `link_meet` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome_utente` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `immagine_profilo` varchar(1000) NOT NULL,
  `anno` int(11) NOT NULL,
  `sezione` char(1) NOT NULL,
  `indirizzo` varchar(3) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `sesso` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `giorni`
--
ALTER TABLE `giorni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `giornitutor`
--
ALTER TABLE `giornitutor`
  ADD PRIMARY KEY (`idtutor`,`idgiorno`),
  ADD KEY `idgiorno` (`idgiorno`);

--
-- Indici per le tabelle `lezioni`
--
ALTER TABLE `lezioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alunno` (`id_alunno`),
  ADD KEY `id_tutor` (`id_tutor`);

--
-- Indici per le tabelle `materiatutor`
--
ALTER TABLE `materiatutor`
  ADD PRIMARY KEY (`idtutor`,`idmaterie`),
  ADD KEY `idmaterie` (`idmaterie`);

--
-- Indici per le tabelle `materie`
--
ALTER TABLE `materie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_utente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `giorni`
--
ALTER TABLE `giorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `lezioni`
--
ALTER TABLE `lezioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `giornitutor`
--
ALTER TABLE `giornitutor`
  ADD CONSTRAINT `giornitutor_ibfk_1` FOREIGN KEY (`idgiorno`) REFERENCES `giorni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `giornitutor_ibfk_2` FOREIGN KEY (`idtutor`) REFERENCES `tutor` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `lezioni`
--
ALTER TABLE `lezioni`
  ADD CONSTRAINT `lezioni_ibfk_1` FOREIGN KEY (`id_alunno`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lezioni_ibfk_2` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `materiatutor`
--
ALTER TABLE `materiatutor`
  ADD CONSTRAINT `materiatutor_ibfk_1` FOREIGN KEY (`idmaterie`) REFERENCES `materie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiatutor_ibfk_2` FOREIGN KEY (`idtutor`) REFERENCES `tutor` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
