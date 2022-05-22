-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 22, 2022 alle 16:27
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_jmripetlzioni`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `lezioni`
--

CREATE TABLE `lezioni` (
  `id_ripetizione` int(11) NOT NULL,
  `id_alunno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `lezioni`
--

INSERT INTO `lezioni` (`id_ripetizione`, `id_alunno`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `materiatutor`
--

CREATE TABLE `materiatutor` (
  `id_ripetizione` int(4) NOT NULL,
  `idtutor` int(11) NOT NULL,
  `idmaterie` int(11) NOT NULL,
  `descrizione` varchar(250) DEFAULT NULL,
  `prezzi_ora` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materiatutor`
--

INSERT INTO `materiatutor` (`id_ripetizione`, `idtutor`, `idmaterie`, `descrizione`, `prezzi_ora`) VALUES
(1, 2, 1, 'Equazione e Teorema di Pitagora', 10),
(2, 2, 2, 'Divina Commedia, promessi sposi', 20),
(3, 2, 3, 'impero romano', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `id` int(11) NOT NULL,
  `materia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`id`, `materia`) VALUES
(1, 'matematica'),
(2, 'italiano'),
(3, 'storia'),
(4, 'informatica'),
(5, 'inglese');

-- --------------------------------------------------------

--
-- Struttura della tabella `tutor`
--

CREATE TABLE `tutor` (
  `id_utente` int(11) NOT NULL,
  `valutazione` int(11) DEFAULT NULL,
  `numero_recensioni` int(11) DEFAULT NULL,
  `link_meet` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tutor`
--

INSERT INTO `tutor` (`id_utente`, `valutazione`, `numero_recensioni`, `link_meet`) VALUES
(1, NULL, NULL, ''),
(2, NULL, NULL, 'https://meet.google.com/thd-athe-obj');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome_utente` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `immagine_profilo` varchar(1000) NOT NULL DEFAULT 'https://png.pngtree.com/png-vector/20190223/ourlarge/pngtree-profile-line-black-icon-png-image_691065.jpg',
  `anno` int(11) NOT NULL,
  `sezione` char(1) NOT NULL,
  `indirizzo` varchar(3) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `numTelefono` varchar(15) DEFAULT NULL,
  `sesso` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome_utente`, `email`, `password`, `immagine_profilo`, `anno`, `sezione`, `indirizzo`, `nome`, `cognome`, `numTelefono`, `sesso`) VALUES
(1, 'rossi_mario', 'rossi_mario@ismonnet.onmicrosoft.com', '81dc9bdb52d04dc20036dbd8313ed055', '../Immagini_profilo/rossi_mario_profile.jpg', 5, 'B', 'inf', 'mario', 'rossi', '333451', 'M'),
(2, 'conti_pippo', 'conti_pippo@ismonnet.onmicrosoft.com', '81dc9bdb52d04dc20036dbd8313ed055', '../Immagini_profilo/conti_pippo_profile.jpg', 1, 'B', 'inf', 'conti', 'pippo', '333452', 'M');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `lezioni`
--
ALTER TABLE `lezioni`
  ADD PRIMARY KEY (`id_ripetizione`,`id_alunno`),
  ADD KEY `lezioni_ibfk_1` (`id_alunno`);

--
-- Indici per le tabelle `materiatutor`
--
ALTER TABLE `materiatutor`
  ADD PRIMARY KEY (`id_ripetizione`),
  ADD KEY `idtutor` (`idtutor`),
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
-- AUTO_INCREMENT per la tabella `materiatutor`
--
ALTER TABLE `materiatutor`
  MODIFY `id_ripetizione` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `lezioni`
--
ALTER TABLE `lezioni`
  ADD CONSTRAINT `lezioni_ibfk_1` FOREIGN KEY (`id_alunno`) REFERENCES `utente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lezioni_ibfk_2` FOREIGN KEY (`id_ripetizione`) REFERENCES `materiatutor` (`id_ripetizione`) ON DELETE CASCADE;

--
-- Limiti per la tabella `materiatutor`
--
ALTER TABLE `materiatutor`
  ADD CONSTRAINT `materiatutor_ibfk_1` FOREIGN KEY (`idtutor`) REFERENCES `tutor` (`id_utente`),
  ADD CONSTRAINT `materiatutor_ibfk_2` FOREIGN KEY (`idmaterie`) REFERENCES `materie` (`id`);

--
-- Limiti per la tabella `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
