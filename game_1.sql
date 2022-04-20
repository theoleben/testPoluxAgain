-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 avr. 2022 à 23:15
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wf3poluxdatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--


--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `title`, `rental_price`, `selling_price`, `age`, `nb_players`, `play_time`, `material`, `description`, `stock`, `grade`) VALUES
(1, 'Jeu d\'échecs', 0, 110, 'A partir de 5 ans', '2', 'Aléatoire', 'Bois', 'Cet ensemble comprend des pièces d’échecs sculptées à partir de bois de bois de rose. Elles ont bénéficié d’un polissage avec des cires naturelles, pondérées et feutrées à la main.  Il y a été associé un échiquier de 48 cm de côté, réalisé à partir de bois d’acajou  et d’érable.  En outre, nous proposons dans cet ensemble un coffret de rangement en bois de bouleau polie pour conserver et ranger les pièces.  Les bois utilisés et la qualité de fabrication en font un ensemble de qualité qui durera pendant des années.', 4, NULL),
(2, 'Jeu de Dames', 0, 90, 'A partir de 5 ans', '2', 'Aléatoire', 'Bois', 'Jeu de dames en bois, présenté dans son coffret en marqueterie. Dimensions du plateau : 39 x 39 cm.', 60, NULL),
(3, 'Jeu de l\'oie', 0, 23, '7/77 ans', '2', 'Aléatoire', 'En bois de merisiers', 'La règle du jeu de l\'oie est très simple (lancer les dés et avancer sur le parcours) et le rôle du hasard rendent ce jeu accessible à tous, sans risque de mise en échec.  Du départ à la case 63, le parcours fait défiler toute une année : de la galette des rois à Noël en passant par le Tour de France et la cueillette des champignons.  Une version colorée et en grand format de ce jeu de l\'oie traditionnel qui réunira les joueurs de tous âges.', 55, NULL),
(4, 'Les acrobates de la forêt', 0, 26, 'A partir de 2 ans', '1', 'Aléatoire', 'Bois', 'On recherche des futurs acrobates ! Car il faut empiler les hiboux, les ours et les sapins le plus précisément possible et avec beaucoup d\'adresse. En suivant les cartes-modèles ou selon sa propre imagination, les ours acrobates feront de la haute voltige. C\'est parti !', 35, NULL),
(5, 'Billard Hollandais', 0, 130, 'A partir de 10 ans', 'A partie de deux joueurs', 'Aléatoire', 'Bois', 'Un très beau modèle de billard hollandais, en acacia et bouleau, avec une très belle glisse des palets.', 3, NULL),
(6, 'Jeu de petits chevaux et jeu de l\'oie', 0, 40, 'A partir de 5 ans', 'A partie de deux joueurs', 'Aléatoire', 'Bois et résines', 'Très beau coffret en bois de 2 jeux, avec plumiers pour le rangement des pions.', 26, NULL),
(7, 'Petit renard vétérinaire', 0, 14, 'A partir de 5 ans', 'Pour 2 à 4 joueurs', 'Aléatoire', 'Carton recyclé', 'Aidez le petit renard vétérinaire à bien s\'occuper de ses patients. Avec de la chance aux dés, qui sera le premier à avoir soigné 5 animaux différents ?', 3, NULL),
(8, 'Surprises dans le potager', 0, 22, 'A partir de 4 ans', 'Pour 2 à 4 joueurs', 'Aléatoire', 'Carton recyclé', 'Des lapins coquins s’aventurent dans le potager pour y faire leurs provisions de légumes. Mais pour pouvoir en récolter quatre différents, encore devront-ils mémoriser où ils se trouvent !', 16, NULL),
(9, 'Trivial Pursuit Famille', 0, 33, 'A partir de 8 ans', 'De 2 à plus de 10 joueurs', 'Aléatoire', 'Carton recyclé, plastique', 'Un jeu de connaissances pour toute la famille Dans cette nouvelle édition familiale de Trivial Pursuit, le célèbre jeu de connaissances, les enfants vont pouvoir défier les parents sur une multitude de nouvelles questions ! Le principe du jeu reste inchangé : les joueurs ont pour objectif de répondre aux questions pour avancer sur le plateau de jeu. En cas de bonne réponse dans une zone \"triangle\" le joueur gagne le marqueur de la couleur correspondante. Le premier joueur à remplir son \"camembert\" de six marqueurs différents remporte la partie.  Grâce à ses 1 200 questions spécialement adaptées aux enfants et ses 1 200 questions conçues pour les parents, cette version est idéale pour les parties en famille. Chaque joueur pourra alors prendre plaisir en répondant à des questions correspondant à son niveau de difficulté.', 4, NULL),
(10, 'Jeu de Go', 0, 40, 'A partir de 5 ans', '2', 'Aléatoire', 'Bois de merisier et pierres', 'Ensemble plateau et pierres pour ce jeu de go d\'initiation. Plateau en hêtre de 36 cm de côté.', 11, NULL),
(11, 'Toppling Tower', 0, 17, 'A partir de 6 ans', 'A partie de 2 joueurs', 'Aléatoire', 'Bois', 'Ou la tour de Jenga. Une tour de 51 blocs de bois, à faire monter le plus haut possible, sans la faire tomber !', 18, NULL),
(12, 'Monopoly', 0, 27, 'A partir de 8 ans', 'De 2 à 6 joueurs', 'Aléatoire', 'Carton recyclé, plastique, métal', 'Le jeu de société le plus célèbre du monde ! On ne présente plus le Monopoly. Édité pour la première fois en 1935, ce jeu de société incontournable, ayant pour thème central les transactions immobilières, s\'est imposé au fil des décennies comme étant le plus gros succès du monde ludique.   Le but du jeu est simple : les joueurs doivent acheter, vendre, construire et spéculer pour s\'enrichir un maximum tout en forçant les autres à faire faillite.  Pour être déclaré gagnant, les joueurs devront acheter des propriétés afin de s\'enrichir le plus possible. Plus ils posséderont de propriétés, plus ils auront d\'argent.  Le Monopoly est un jeu familial qui demande une bonne stratégie et une bonne gestion tout en intégrant une dimension de chance et de hasard. Cette version classique est adaptée à toute la famille et conviendra aussi bien aux adultes qu\'aux enfants.  Chaque année, le Monopoly fait partie des jeux de société les plus vendus en France et dans le monde. Le jeu n\'a cessé de se réinventer et se décline aujourd\'hui en plusieurs versions et éditions (France, villes françaises, Nintendo, Fortnite, édition Tricheurs, etc.).', 70, NULL),
(13, 'Milles bornes (Prestige)', 0, 29, 'A partir de 6 ans', 'Pour 2 à 8 joueurs', 'Aléatoire', 'Carton recyclé', 'Etre le premier à franchir 1000 bornes ! Dévorez les kilomètres en attaquant vos adversaires.  Mais prenez garde car tout comme vous, ils feront tout pour vous stopper en vous posant des attaques : feu rouge, accident, roue crevée, panne d’essence !  Un jeu culte qui séduira toute la famille !', 57, NULL),
(14, 'Milles bornes (édition classique)', 0, 15, 'A partir de 6 ans', 'Jusqu\'à 8 joueurs', '30 minutes à 1 heure', 'Carton recyclé', 'Mille Bornes est un jeu familial et culte dans lequel les joueurs doivent être les premiers à franchir 1000 bornes. Attention à vos adversaires qui seront prêts à tout pour stopper votre progression.', 7, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
