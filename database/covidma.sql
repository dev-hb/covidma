-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2020 at 07:19 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covidma`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'zakaria.hba.97@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Tanger-Tetouan-Al Hoceima'),
(2, 'Oriental'),
(3, 'Fès-Meknès'),
(4, 'Rabat-Salé-Kénitra'),
(5, 'Béni Mellal-Khénifra'),
(6, 'Casablanca-Settat'),
(7, 'Marrakesh-Safi'),
(8, 'Drâa-Tafilalet'),
(9, 'Souss-Massa'),
(10, 'Guelmim-Oued Noun'),
(11, 'Laâyoune-Sakia El Hamra'),
(12, 'Dakhla-Oued Ed-Dahab'),
(99, 'Tous');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `picture`, `title`, `content`, `start_date`, `end_date`, `region_id`, `created_at`) VALUES
(7, 'https://www.eetimes.eu/wp-content/uploads/2020/05/Covid19_Data-Analysis_EE-Times-Europe-min.jpg?fit=1000%2C600', 'Analyse Covid-19 au Maroc mois mars', '<div class=\"chapo-options col-md-12 row\">\r\n\r\n\r\n<p>Environ 4.000 personnes, médecins, étudiants, internes, résidents dans leur majorité, ont suivi jeudi soir à distance la E-conférence donnée par plusieurs experts et responsables marocains au sujet de la maladie Covid-19 et du nouveau Coronavirus. Conduite à tenir, situation dans le monde, état des connaissances, stratégie marocaine, chiffres relatifs à la situation au Maroc..., la conférence comportait des exposés et une séance de questions-réponses.</p>\r\n<p>Cette conférence inédite jamais organisée auparavant dans un autre pays, est le fruit dun partenariat entre la Société Marocaine des Sciences Médicales, présidée par le Dr My Saïd Afif et le ministère de la Santé. Physiquement parlant, les orateurs, 8 au total, se trouvaient dans une salle de la direction générale du CHU de Casablanca.</p>\r\n<p style=text-align: center;></p>\r\n<p style=text-align: center;><em>Moulay Said Afif, président de la Société Marocaine des Sciences Médicales</em></p>\r\n<p>Ce fut donc loccasion den apprendre davantage grâce à la présence de M. Lyoubi, directeur de lépidémiologie et de la lutte contre les maladies au ministère de la Santé.</p>\r\n<p>Les chiffres ci-dessous ainsi que les slides, proviennent des exposés de M. Lyoubi. Ils concernent la situation à la date du jeudi 19 mars 2020 en fin de journée, lorsque le bilan était de 61 cas (<a href=/coronavirus-1-nouveau-cas-au-maroc-62-au-total-8570.html target=_blank rel=noopener noreferrer>nous étions à 63 cas jeudi soir</a>).</p>\r\n<p>61 cas, ce nest pas beaucoup, mais cest la seule série marocaine et les données comme on va le voir, apportent un intéressant éclairage.</p>\r\n<p>En gros, sur les 61 cas confirmés à jeudi fin de journée:</p>\r\n<p>*60,7% étaient bénins, sans signes de pneumonie.</p>\r\n<p>*27,9% étaient modérés, avec signes de pneumonie mais sans difficultés respiratoires.</p>\r\n<p>*6,6% étaient en grave détresse.</p>\r\n<p>*4,9% étaient critiques et ont nécessité une assistance respiratoire.</p>\r\n<p>Au total, près de 90% des cas sont bénins à modérés.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/classification-clinique-a-l-admission.jpg alt=></p>\r\n<p style=text-align: left;>Sur les 61 premiers cas confirmés au Maroc, la toux sèche et la fièvre prédominent. Suivies du trio céphalées (maux de tête), mal de gorge et myalgie (douleurs musculaires, courbatures).</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/frequence-des-signes-cliniques-a-l-admission.jpg alt=></p>\r\n<p>Sur les 61 cas, 49 sont des cas importés, cest-à-dire que les malades les ont contractés à létranger. 12 sont des cas locaux, provenant dune contamination de résidents du Maroc avec des personnes malades ayant contracté le virus à létranger. Par nationalité, on trouve 49 Marocains sur le total de 61. Par pays dexposition et donc dorigine de linfection, citons lEspagne, la France et lItalie.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/les-cas-par-nationalite.jpg alt=></p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/les-cas-par-zone-d-exposition.jpg alt=></p>\r\n<p>Lâge moyen est de 47 ans, mais sur une série aussi limitée, ce chiffre na pas énormément de signification. Les deux extrêmes sont le bébé de 9 mois et la dame décédée, âgée de 89 ans.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/age-et-sex-ratio.jpg alt=></p>\r\n<p style=text-align: left;>Le plus grand nombre de cas se trouve à Casablanca (13 sur 61) suivie de Rabat, Fès, Marrakech, Agadir.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/distribution-par-ville-tableau.jpg alt=></p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/reparition-par-regions-66-cas.jpg alt=></p>\r\n<p style=text-align: center;><em>MISE A JOUR. Le tableau ci-dessus est celui de la répartition régionale le vendredi 20 mars 2020 à 09H, par région. </em></p>\r\n<p style=text-align: center;><em>Les régions Casablanca et Settat sont en tête, suivies de Fès-Meknès.</em></p>\r\n<p style=text-align: left;>Ci-dessous, un chiffre très intéressant: le taux danalyses positives par date dinvestigation clinique.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/evolution-du-taux-de-positivite-par-investigation-clinique.jpg alt=></p>\r\n<p style=text-align: left;>Au 19 mars, 1.662 contacts étaient suivis. Dr Lyoubi a rendu hommage à limplication totale des autorités locales qui ont effectué des recherches et contacté les personnes qui avaient été en contact avec des malades confirmés, parfois au milieu de la nuit.</p>\r\n<p style=text-align: left;>Sur les 1.662 contacts suivis, 300 étaient sortis du suivi, considérés comme indemnes.</p>\r\n<p style=text-align: center;><img src=https://www.medias24.com//images/redaction/03-2020/cumul-cas-contact.jpg alt=></p>\r\n<p style=text-align: left;>Selon M. Lyoubi, il y a toutes les chances pour que les cas détectés représentent la grande majorité des cas présents sur le territoire national. (...) le système marocain de détection avait des mailles très fines, et sil y avait une circulation plus grande du virus, on sen serait rendu compte.</p>\r\n<p style=text-align: left;>Pour ce qui concerne les lignes téléphoniques, il a annoncé quil y aura un changement de plateforme pour doubler les capacités et passer à 8 appels simultanés. Cette ligne Yakada sera probablement externalisée et elle devra par la suite transférer vers les services compétents les cas qui nécessitent dêtre médicalement orientés.</p>\r\n</div>', '2020-03-02', '2020-03-20', 99, '2020-10-09 18:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e99a18c428cb38d5f260853678922e03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
