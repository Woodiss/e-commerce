-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 mars 2024 à 20:46
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `billing_adresse`
--

CREATE TABLE `billing_adresse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `billing_adresse`
--

INSERT INTO `billing_adresse` (`id`, `user_id`, `city`, `postal_code`, `full_name`, `phone_number`, `adresse`) VALUES
(9, 1, '12 Allée Romy Scneider', 78260, '0777777777', 777777777, ''),
(10, 1, '12 Allée Romy Scneiderbbbbbbbbbbbbbbbbbb', 78260, '0777777777', 777777777, ''),
(15, 1, '12 Allée Romy Scneider', 78260, '0777777777', 777777777, ''),
(17, 1, 'Acheres', 78260, '12 Allée Romy Scneider', 7575, '7575'),
(18, 2, 'Acheres', 78260, 'Stéphane DESCARPENTRIES', 778350419, '12 Allée Romy Scneider');

-- --------------------------------------------------------

--
-- Structure de la table `delivery_adresse`
--

CREATE TABLE `delivery_adresse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `delivery_adresse`
--

INSERT INTO `delivery_adresse` (`id`, `user_id`, `city`, `postal_code`, `full_name`, `phone_number`, `adresse`) VALUES
(9, 1, '12 Allée Romy Scneider', 78260, '0777777777', 777777777, ''),
(10, 1, '12 Allée Romy Scneideraaaaaaaaaaaaaaaaaaaa', 78260, '0777777777', 777777777, ''),
(11, 1, 'Acheres', 78260, '12 Allée Romy Scneider', 12, '12'),
(15, 1, 'Acheres', 78260, '12 Allée Romy Scneider', 7575, '7575'),
(16, 2, 'Acheres', 78260, 'Stéphane DESCARPENTRIES', 778350419, '12 Allée Romy Scneider');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240119094331', '2024-02-02 16:18:49', 75),
('DoctrineMigrations\\Version20240119104240', '2024-02-02 16:18:49', 4),
('DoctrineMigrations\\Version20240202152220', '2024-02-02 16:22:44', 198),
('DoctrineMigrations\\Version20240202173555', '2024-02-02 18:36:15', 44),
('DoctrineMigrations\\Version20240220200143', '2024-02-20 21:01:55', 189),
('DoctrineMigrations\\Version20240226083354', '2024-02-26 09:33:59', 21),
('DoctrineMigrations\\Version20240229085258', '2024-02-29 09:53:08', 38),
('DoctrineMigrations\\Version20240229085453', '2024-02-29 09:55:06', 20),
('DoctrineMigrations\\Version20240229085744', '2024-02-29 09:58:04', 34),
('DoctrineMigrations\\Version20240229114046', '2024-02-29 12:40:51', 62),
('DoctrineMigrations\\Version20240229115446', '2024-02-29 12:54:54', 8),
('DoctrineMigrations\\Version20240229120031', '2024-02-29 13:00:35', 51),
('DoctrineMigrations\\Version20240304130332', '2024-03-04 14:03:41', 58),
('DoctrineMigrations\\Version20240306161947', '2024-03-06 17:19:58', 59),
('DoctrineMigrations\\Version20240311204213', '2024-03-11 21:42:21', 41),
('DoctrineMigrations\\Version20240312125749', '2024-03-12 13:58:01', 121);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reference` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `billing_adresse_id` int(11) DEFAULT NULL,
  `delivery_adresse_id` int(11) DEFAULT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `reference`, `created_at`, `billing_adresse_id`, `delivery_adresse_id`, `total`) VALUES
(23, 1, '914DS110324', '2024-03-07 21:43:38', 9, 9, 3050),
(24, 1, '862DS120324', '2024-03-12 09:42:06', 9, 9, 4270),
(25, 1, '220DS140324', '2024-03-14 12:43:20', 9, 9, 1830),
(26, 2, '560WS150324', '2024-03-15 13:16:25', 18, 16, 610);

-- --------------------------------------------------------

--
-- Structure de la table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) DEFAULT NULL,
  `voyages_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders_details`
--

INSERT INTO `orders_details` (`id`, `orders_id`, `voyages_id`, `quantity`, `price`) VALUES
(16, 23, 16, 5, 610),
(17, 24, 16, 7, 610),
(18, 25, 16, 3, 610),
(19, 26, 16, 1, 610);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(5, 1, 'J44fkenZ0wDPA1I41KZR', 'lPZGZKpVz0Is4jN52lj1wXLJqKpqN62jPpwn14tyRUI=', '2024-03-14 10:37:18', '2024-03-14 11:37:18');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `phone_number`) VALUES
(1, 'stephane.descarpentries@hotmail.fr', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$oWEB0LJ/zgvlUv1F1CvgEOFqQrRE8emb1Dy2Sq87Z067LdQELugVS', 'Stéphane', 'Descarpentries', '0778350419'),
(2, 'stephane78.descarpentries@gmail.com', '[]', '$2y$13$LA7WJ9ahOrydTpZ37UMtPei2icaUF5j3a/hi/kUdeGkHUnbsu2m3m', 'Stéphanegmail', 'WeshWeshgmail', 'aaaaaaaaaa'),
(3, 'cowoy79721@darkse.com', '[]', '$2y$13$ww2MyIzuqLwzYKXlJYCnCuNWq6lshVGp6cxQG49oULoUchSibdoYe', 'Stéphane', 'WeshWesh', '0778350419');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `free_wifi` tinyint(1) NOT NULL,
  `pool` tinyint(1) NOT NULL,
  `pets_accept` tinyint(1) NOT NULL,
  `little_desc` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `title`, `description`, `price`, `adresse`, `longitude`, `latitude`, `parking`, `free_wifi`, `pool`, `pets_accept`, `little_desc`, `city`, `country`) VALUES
(16, 'Hôtel Éclat', '<div>un havre de luxe et de raffinement situé à quelques pas scintillants de la majestueuse Tour Eiffel à Paris. Niché au cœur du quartier chic du 7ème arrondissement, notre établissement offre une expérience incomparable où le charme parisien renco</div>', 2100, '18 Av. de la Bourdonnais', 48.859, 2.297, 1, 1, 0, 1, 'Luxe parisien avec vue sur la Tour Eiffel à l\'Hôtel Éclat.', 'Paris', 'France'),
(17, 'Le Havre Arboré', '<div>Nichée au cœur d\'une forêt luxuriante, cette grandiose cabane dans les arbres offre une échappée unique vers la tranquillité et le retour aux origines de la nature. Conçue pour fusionner harmonieusement avec son environnement, elle vous invite à vivre une expérience inoubliable, suspendu entre ciel et terre. Chaque chambre, baignée de lumière naturelle et décorée avec une simplicité élégante, évoque le confort rustique tout en offrant des vues panoramiques sur la canopée environnante. L\'accès par un escalier en spirale autour du tronc d\'arbre ajoute une touche d\'aventure à votre arrivée. Ici, le temps semble s\'arrêter, offrant un refuge paisible loin du tumulte du quotidien, une véritable ode à la beauté et à la sérénité de la nature. Préparez-vous à vous reconnecter avec l\'essentiel et à redécouvrir le plaisir simple d\'un moment au cœur de la forêt.&nbsp;</div>', 1400, '18A r. M. farradagys, 18000 Bourges', 48.876, 2.272, 0, 1, 0, 1, 'Découvrez le charme rustique et la paix d\'une cabane luxueuse dans les arbres, une invitation à la tranquillité et au retour à la nature, nichée dans une forêt luxuriante.', 'Paris', 'France'),
(18, 'Le Repos Élégant', '<div>L\'Hôtel Le Repos Élégant est une échappée urbaine qui allie simplicité et confort. Chaque chambre, accessible par un chemin extérieur charmant et bien éclairé, offre un sanctuaire de tranquillité pour les voyageurs attentifs à leur budget. Les intérieurs, d\'une propreté impeccable, sont agrémentés d\'un mini-bar soigneusement agencé et d\'une salle de bain moderne. Le hall d\'accueil, accueillant et modeste, reflète la promesse d\'un service personnalisé et chaleureux.&nbsp;</div>', 150, '30 R. des Martyrs', 48.878516, 2.33986, 0, 1, 0, 0, 'Un havre de paix simple et élégant pour le voyageur moderne et économe.', 'Paris', 'France'),
(19, 'Ryokan à Komorebi', '<div>Une échappée élégante dans la tranquillité japonaise, où la tradition rencontre la modernité pour offrir une expérience de détente profonde et mémorable. Niché dans un cadre naturel paisible, ce ryokan (auberge traditionnelle japonaise) tire son nom de \"komorebi\", un terme japonais qui désigne la lumière du soleil filtrant à travers les feuilles des arbres, symbolisant la beauté naturelle et l\'éphémère qui caractérisent l\'esthétique japonaise.<br><br>&nbsp;</div>', 345, '12 Av. d\'Ivry', 48.825385, 2.361913, 0, 1, 1, 1, 'Une évasion élégante dans la tranquillité japonaise, où tradition et modernité se rencontrent pour une expérience de détente inoubliable.', 'Paris', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `voyage_image`
--

CREATE TABLE `voyage_image` (
  `id` int(11) NOT NULL,
  `voyage_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voyage_image`
--

INSERT INTO `voyage_image` (`id`, `voyage_id`, `name`, `size`) VALUES
(63, 16, 'paris1-chambre1-65f8263cbe7c6695325827.png', 353848),
(64, 16, 'paris1-chambre2-65f8263ccb3ea314075174.png', 346184),
(65, 16, 'paris1-sdb-65f8263ccbe9b053029669.png', 426888),
(66, 16, 'paris1-hall-65f8263ccc72e341507493.png', 507170),
(67, 16, 'paris1-toilette-65f8263ccd0d3847705088.png', 358808),
(68, 17, 'paris2-cabane-chambre-65f82cff3e892030155301.png', 402824),
(69, 17, 'paris2-cabane-sdb-65f82cff3f529927432775.png', 356316),
(70, 17, 'paris2-cabane-exter-65f82cff3fcd0117270188.png', 472856),
(71, 17, 'paris2-cabane-wc-65f82cff40465959422813.png', 357422),
(72, 17, 'paris2-cabane-chambre2-65f82cff40c94813390249.png', 361648),
(73, 18, 'paris3-chambre-65f8503c523fe942430574.png', 264576),
(74, 18, 'paris3-sdb-65f8503c53200466987478.png', 300904),
(75, 18, 'paris3-hall-65f8503c53b51937104950.png', 292728),
(76, 18, 'paris3-barre-65f8503c544f7809715589.png', 352524),
(77, 18, 'paris3-couloirs-65f8503c54f81777260059.png', 286832),
(78, 19, 'paris4-chambre-65f85be447c6a669316529.png', 295800),
(79, 19, 'paris4-sdb-65f85be4489d3644424545.png', 303484),
(80, 19, 'paris4-coin-65f85be449306587015271.png', 269588),
(81, 19, 'paris4-chambre2-65f85be449d66440271084.png', 279946),
(82, 19, 'paris4-entre-65f85be44a65f928339821.png', 413790);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billing_adresse`
--
ALTER TABLE `billing_adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A87183C1A76ED395` (`user_id`);

--
-- Index pour la table `delivery_adresse`
--
ALTER TABLE `delivery_adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C941B7C8A76ED395` (`user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEEA76ED395` (`user_id`),
  ADD KEY `IDX_E52FFDEEC180B3CD` (`billing_adresse_id`),
  ADD KEY `IDX_E52FFDEE53A24B78` (`delivery_adresse_id`);

--
-- Index pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_835379F1CFFE9AD6` (`orders_id`),
  ADD KEY `IDX_835379F1A170CAB9` (`voyages_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voyage_image`
--
ALTER TABLE `voyage_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFAD38B068C9E5AF` (`voyage_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billing_adresse`
--
ALTER TABLE `billing_adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `delivery_adresse`
--
ALTER TABLE `delivery_adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `voyage_image`
--
ALTER TABLE `voyage_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billing_adresse`
--
ALTER TABLE `billing_adresse`
  ADD CONSTRAINT `FK_A87183C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `delivery_adresse`
--
ALTER TABLE `delivery_adresse`
  ADD CONSTRAINT `FK_C941B7C8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE53A24B78` FOREIGN KEY (`delivery_adresse_id`) REFERENCES `delivery_adresse` (`id`),
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E52FFDEEC180B3CD` FOREIGN KEY (`billing_adresse_id`) REFERENCES `billing_adresse` (`id`);

--
-- Contraintes pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `FK_835379F1A170CAB9` FOREIGN KEY (`voyages_id`) REFERENCES `voyage` (`id`),
  ADD CONSTRAINT `FK_835379F1CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `voyage_image`
--
ALTER TABLE `voyage_image`
  ADD CONSTRAINT `FK_CFAD38B068C9E5AF` FOREIGN KEY (`voyage_id`) REFERENCES `voyage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
