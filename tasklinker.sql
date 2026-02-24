-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 24 fév. 2026 à 10:34
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tasklinker`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260216141827', NULL, NULL),
('DoctrineMigrations\\Version20260219123954', '2026-02-19 12:40:38', 47);

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`id`, `lastname`, `firstname`, `email`, `start`, `status`) VALUES
(1, 'Thierry', 'Renée', 'dominique07@becker.net', '2022-05-20', 'CDD'),
(2, 'Berthelot', 'Patrick', 'claude17@brun.org', '2012-04-26', 'CDI'),
(3, 'Allain', 'Jacqueline', 'martine25@lecoq.fr', '1982-08-02', 'Freelance');

-- --------------------------------------------------------

--
-- Structure de la table `employee_project`
--

CREATE TABLE `employee_project` (
  `employee_id` int NOT NULL,
  `project_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employee_project`
--

INSERT INTO `employee_project` (`employee_id`, `project_id`) VALUES
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `archive` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `title`, `archive`) VALUES
(1, 'Eligendi esse omnis vel.', 1),
(2, 'Enim quia porro est excepturi doloremque eaque.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` tinytext,
  `deadline` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `employee_id` int DEFAULT NULL,
  `project_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `deadline`, `status`, `employee_id`, `project_id`) VALUES
(1, 'Enim recusandae non suscipit consectetur architecto soluta.', 'Aut ut ratione et reiciendis. Ipsam qui qui officia. Unde enim qui numquam et.', '2020-05-28', 'to_do', 1, 1),
(2, 'Et eum rerum blanditiis perferendis nostrum voluptas maxime.', 'Quas incidunt quia aut vero ut quam voluptatum maxime. Minima nobis ea quo aut ipsum.', '1978-05-30', 'done', 3, 2),
(3, 'Dolor dicta explicabo tempore.', 'Laudantium porro impedit eum. Odit quis at tempore.', '1972-07-19', 'to_do', 3, 2),
(4, 'Id perferendis adipisci provident corporis voluptatem eos.', 'Voluptatem sit autem itaque rerum. Sequi rerum quod dolor quae harum aspernatur quasi.', '2007-07-12', 'done', 3, 2),
(5, 'Suscipit eum labore eum rerum laborum similique earum.', 'Consequatur nihil eius est hic nihil voluptatibus. Fuga aperiam cum voluptas hic harum et.', '2002-02-06', 'done', 2, 1),
(6, 'Porro explicabo cupiditate consectetur dignissimos sint.', 'Voluptatum dolores sint nam incidunt et. Soluta velit distinctio eos enim.', '1993-08-10', 'done', 3, 1),
(7, 'Sunt et nam dolor autem nulla.', 'Dolorem tempora repudiandae veniam dicta animi aut. Ullam sint tenetur et magni.', '1997-05-14', 'to_do', 2, 1),
(8, 'Molestias laborum incidunt nesciunt dolore est.', 'Beatae a distinctio est minima amet. Est facilis nostrum minus labore aspernatur incidunt adipisci.', '2010-05-30', 'done', 2, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5D9F75A1E7927C74` (`email`);

--
-- Index pour la table `employee_project`
--
ALTER TABLE `employee_project`
  ADD PRIMARY KEY (`employee_id`,`project_id`),
  ADD KEY `IDX_AFFF86E18C03F15C` (`employee_id`),
  ADD KEY `IDX_AFFF86E1166D1F9C` (`project_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB258C03F15C` (`employee_id`),
  ADD KEY `IDX_527EDB25166D1F9C` (`project_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employee_project`
--
ALTER TABLE `employee_project`
  ADD CONSTRAINT `FK_AFFF86E1166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_AFFF86E18C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_527EDB258C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
