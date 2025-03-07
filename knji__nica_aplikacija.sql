-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 06:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knjižnica_aplikacija`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(100) NOT NULL,
  `ime_korisnika` varchar(100) NOT NULL,
  `prezime_korisnika` varchar(100) NOT NULL,
  `email_korisnika` varchar(100) NOT NULL,
  `zaporka_korisnika` varchar(100) NOT NULL,
  `potvrda_zaporke` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime_korisnika`, `prezime_korisnika`, `email_korisnika`, `zaporka_korisnika`, `potvrda_zaporke`) VALUES
(1, 'Josipa', 'Radat', 'radatjosipa001@gmail.com', 'd3b85cb884ac234080092786c2c3e13e', ''),
(2, 'Petar', 'Perić', 'petarperic@gmail.com', '5bc6e3a3eceed5eb15bad65f94e8b177', ''),
(3, 'Ana', 'Anic', 'ana@gmail.com', '5390489da3971cbbcd22c159d54d24da', ''),
(4, 'Marko', 'Marković', 'markovicmarko@ff.sum.ba', '26c7c9089e23c14396410bbc6675dbdf', ''),
(6, 'Ivan', 'Ivić', 'ivan.ivic@gmail.com', 'b7727d252be76bc6d142e19315cfc8fd', ''),
(7, 'Franka', 'Franković', 'franka.frankovic@gmail.com', '2672f3d417cf26c5ec9b0ac6fd4463c6', '2672f3d417cf26c5ec9b0ac6fd4463c6'),
(8, 'Mira', 'Mirić', 'miramiric@gmail.com', '83469ed2521f07cb27804061cf244132', '83469ed2521f07cb27804061cf244132'),
(9, 'Jure', 'Jurić', 'jurejuric@gmail.com', 'eb49bbd3a09e2aaa54563dbb99802c3f', 'eb49bbd3a09e2aaa54563dbb99802c3f'),
(10, 'Marta', 'Martić', 'martamartic@gmail.com', 'a4eaf4e4814d8270c136ba9222bb2bb7', 'a4eaf4e4814d8270c136ba9222bb2bb7');

-- --------------------------------------------------------

--
-- Table structure for table `kosara`
--

CREATE TABLE `kosara` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ime_proizvoda` varchar(100) NOT NULL,
  `cijena` int(100) NOT NULL,
  `kolicina` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `kosara`
--

INSERT INTO `kosara` (`id`, `user_id`, `ime_proizvoda`, `cijena`, `kolicina`, `image`) VALUES
(70, 2, 'Ponos i predrasude', 45, 1, 'pip.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `najpopularnije_knjige`
--

CREATE TABLE `najpopularnije_knjige` (
  `id` int(100) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `cijena` int(100) NOT NULL,
  `slika` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `najpopularnije_knjige`
--

INSERT INTO `najpopularnije_knjige` (`id`, `ime`, `cijena`, `slika`) VALUES
(1, 'The Women', 30, 'thewomen.jpg'),
(2, 'Fourth Wing', 40, 'fourthwing.jpg'),
(3, 'It Ends With Us', 29, 'It Ends With Us.jpg'),
(4, 'Red Sky Mouring', 50, 'Red-Sky-Mouring.jpg'),
(5, 'The Black Bird Oracle', 42, '819GT6sZUOL.jpg'),
(6, 'A Death in Cornwall', 55, 'cornwall.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbe`
--

CREATE TABLE `narudzbe` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `broj` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `metoda_placanja` varchar(50) NOT NULL,
  `adresa` varchar(500) NOT NULL,
  `ukupni_proizvodi` varchar(1000) NOT NULL,
  `ukupna_cijena` int(100) NOT NULL,
  `postavljeno_na` varchar(50) NOT NULL,
  `status_placanja` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `narudzbe`
--

INSERT INTO `narudzbe` (`id`, `user_id`, `ime`, `broj`, `email`, `metoda_placanja`, `adresa`, `ukupni_proizvodi`, `ukupna_cijena`, `postavljeno_na`, `status_placanja`) VALUES
(11, 1, 'Josipa', '4', 'radatjosipa001@gmail.com', 'PayPal', 'Kralja Zvonimira 20, Mostar, Bosna i Hercegovina', ', Derviš i smrt (1) , Na Drini ćuprija (1) ', 130, '23-Feb-2025', '');

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

CREATE TABLE `poruka` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `broj` varchar(12) NOT NULL,
  `poruka` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `poruka`
--

INSERT INTO `poruka` (`id`, `user_id`, `ime`, `email`, `broj`, `poruka`) VALUES
(10, 1, 'Josipa Radat', 'radatjosipa001@gmail.com', '4', 'Odličan bookshop!');

-- --------------------------------------------------------

--
-- Table structure for table `shop_knjige`
--

CREATE TABLE `shop_knjige` (
  `id` int(100) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `cijena` int(100) NOT NULL,
  `slika` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `shop_knjige`
--

INSERT INTO `shop_knjige` (`id`, `ime`, `cijena`, `slika`) VALUES
(1, '1984', 55, '1984.jpg'),
(2, 'Zločin i kazna', 60, 'zlocinikazna.jpg'),
(3, 'Ponos i predrasude', 45, 'pip.jpg'),
(4, 'Deca zla', 39, 'decazla.jpg'),
(5, 'Derviš i smrt', 50, 'dervis.jpg'),
(6, 'Na Drini ćuprija', 80, 'cuprija.jpg'),
(7, 'Diši, praštaj, voli', 30, 'disi.jpg'),
(8, 'Postavite granice, pronađite mir', 52, 'granice.jpg'),
(9, 'Don Kihot', 29, 'donkihot.jpg'),
(10, 'Heidi', 20, 'hajdi.jpg'),
(11, 'Lovac u žitu', 40, 'lovac.jpg'),
(12, 'Mali princ', 28, 'maliprinc.jpg'),
(13, 'Rat i mir', 59, 'ratimir.jpg'),
(14, 'Ana Karenjina', 49, 'anak.jpg'),
(15, 'Romeo i Julija', 60, 'romeo.jpg'),
(16, 'Gospodar prstenova', 40, 'gospodar.jpg'),
(17, 'Harry Potter i Kamen mudraca', 50, 'harry.jpg'),
(18, 'Da Vinčijev kod', 58, 'kod.jpg'),
(19, 'Kućna pomoćnica', 49, 'housemaid.jpg'),
(20, 'Alkemičar', 49, 'alkemicar.jpg'),
(21, 'Tihi pacijent', 30, 'tihipacijent.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kosara`
--
ALTER TABLE `kosara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `najpopularnije_knjige`
--
ALTER TABLE `najpopularnije_knjige`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poruka`
--
ALTER TABLE `poruka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_knjige`
--
ALTER TABLE `shop_knjige`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kosara`
--
ALTER TABLE `kosara`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `najpopularnije_knjige`
--
ALTER TABLE `najpopularnije_knjige`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `narudzbe`
--
ALTER TABLE `narudzbe`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `poruka`
--
ALTER TABLE `poruka`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_knjige`
--
ALTER TABLE `shop_knjige`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
