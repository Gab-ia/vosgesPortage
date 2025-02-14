-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 fév. 2025 à 13:00
-- Version du serveur : 5.7.23-23-log
-- Version de PHP : 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `menuPortage`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` mediumint(9) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infos` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_repas` tinyint(4) NOT NULL,
  `id_ville` smallint(6) NOT NULL,
  `date_inscription` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `telephone`, `email`, `infos`, `nb_repas`, `id_ville`, `date_inscription`) VALUES
(18, 'Fresse', 'Gerome', '0611672403', 'gerome.fresse@wanadoo.fr', 'test ville liste', 5, 3, '2024-11-01'),
(19, 'Fresse', 'Gerome', '0545345432', 'fuel@net-gasoline.com', 'test autre ville', 3, 20, '2024-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `contacts_autres_villes`
--

CREATE TABLE `contacts_autres_villes` (
  `id_contact` mediumint(9) NOT NULL,
  `id_ville_vosges` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts_autres_villes`
--

INSERT INTO `contacts_autres_villes` (`id_contact`, `id_ville_vosges`) VALUES
(19, 34801);

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` smallint(6) NOT NULL,
  `entree` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dessert` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `entree`, `plat`, `dessert`, `date`) VALUES
(1, 'Salade de chèvre chaud', 'Coq au vin', 'Tarte aux pommes', '2024-10-18'),
(2, 'Soupe à l\'oignon', 'Boeuf bourguignon', 'Crème brûlée', '2024-10-16'),
(3, 'Escargots de Bourgogne', 'Ratatouille', 'Fondant au chocolat', '2024-10-19'),
(4, 'Gaspacho a dente', 'Filet mignon sauce béarnaise', 'Mousse au chocolat', '2024-10-17'),
(5, 'Salade niçoise', 'Cassoulet du sud', 'Tarte au citron', '2024-10-20'),
(6, 'Quiche lorraine', 'Boeuf Stroganoff', 'Crêpes Suzette', '2024-10-21'),
(7, 'Rillettes de saumon', 'Magret de canard aux cerises', 'Panna cotta', '2024-10-22'),
(8, 'Salade de lentilles', 'Poulet basquaise', 'Clafoutis aux cerises', '2024-10-23'),
(9, 'Tartare de tomates et mozzarella', 'Blanquette de veau', 'Île flottante', '2024-10-24'),
(10, 'Croustillants de chèvre', 'Sauté de porc à la moutarde', 'Tiramisu italien', '2024-10-25'),
(11, 'Velouté de potiron', 'Sole meunière', 'Eclair au chocolat', '2024-08-26'),
(12, 'Pâté en croûte', 'Rôti de veau aux morilles', 'Tarte aux fruits rouges', '2024-08-27'),
(13, 'Carpaccio de bœuf', 'Côtelettes d\'agneau', 'Profiteroles', '2024-10-29'),
(14, 'Assiette de charcuterie', 'Osso bucooo', 'Pêche Melba', '2024-10-27'),
(15, 'Salade de tomates à la provençale aaa', 'Chateaubriand', 'Mille-feuille', '2024-10-28'),
(16, 'Foie gras poêlé', 'Confit de canard', 'Crumble aux pommes', '2024-10-30'),
(17, 'Salade de poulpe', 'Lapin à la moutarde', 'Gâteau au fromage blanc', '2024-10-31'),
(18, 'Caviar d\'aubergine', 'Bouillabaisse', 'Tarte au chocolat', '2024-11-01'),
(19, 'Salade d\'endives et noix', 'Grenadin de veau', 'Macarons 12', '2024-11-02'),
(20, 'Oeufs cocotte', 'Paella mare', 'Flan pâtissier', '2024-11-03'),
(21, 'Salade de Pates au thon et petits pois', 'Blanquette de veau à l\'ancienne, haricots verts et boulgour', 'Flan au caramel', '2024-11-04'),
(22, 'Œuf macédoine traditionnel', 'Rôti de porc sauce tomate porto, endives et fenouil braisés, pommes de terre à la crème', 'Fondant aux agrumes', '2024-11-05'),
(23, 'Céleri rémoulade à la moutarde à l\'ancienne', 'Filet de Colin vapeur sauce citron, petits pois et carottes, riz basmati', 'Tarte aux poires bourdaloue', '2024-11-08'),
(24, 'Terrine aux deux poissons', 'Waterzooï de poulet à la crème, pommes de terre vapeur de la ferme Menzin', 'Riz au lait au pain d\'épice', '2024-11-06'),
(25, 'Cake au chorizo doux', 'Foie de veau grillé sauce madère, choux de Bruxelles et farfalles', 'Salade de fruits de saison', '2024-11-07'),
(26, 'Assortiment de charcuteries', 'Émincé de volaille, tomate provençale et patates rissolées', 'Tiramisu traditionnel au café', '2024-11-09'),
(27, 'Salade de concombres', 'Côtelettes de porc', 'Charlotte aux fruits', '2024-08-17'),
(28, 'Terrine de lapin', 'Risotto aux champignons', 'Tarte tatin', '2024-08-18'),
(29, 'Salade de roquette et parmesan', 'Cabillaud en croûte', 'Mille-feuille à la vanille', '2024-08-19'),
(30, 'Pâté de campagne', 'Filet de boeuf en croûte', 'Pouding au pain', '2024-08-20'),
(31, 'Aumônières de chèvre', 'Poulet aux morilles', 'Baba au rhum', '2024-08-21'),
(32, 'Gaspacho de concombre', 'Gratin de courgettes', 'Clafoutis aux poires', '2024-08-22'),
(33, 'Bruschetta', 'Magret de canard aux figues', 'Tiramisu aux fruits rouges', '2024-08-23'),
(34, 'Salade de pâtes', 'Lamb chops with mint sauce', 'Crêpes au Nutella', '2024-08-24'),
(35, 'Céviche de dorade', 'Rôti de porc aux pommes', 'Gâteau au fromage', '2024-08-25'),
(36, 'Feuilletés au saumon', 'Chili con carne', 'Brownies', '2024-08-26'),
(37, 'Chou farci', 'Poisson grillé', 'Tarte au chocolat blanc', '2024-08-27'),
(38, 'Salade de quinoa', 'Boeuf bourguignon', 'Panna cotta aux fruits', '2024-08-28'),
(39, 'Soupe de carottes', 'Côtelettes d\'agneau aux herbes', 'Gâteau au yaourt', '2024-08-29'),
(40, 'Salade de poulet', 'Rôti de veau', 'Tarte au citron meringuée', '2024-08-30'),
(41, 'Rillettes de canard', 'Blanquette de veau', 'Mousse au chocolat blanc', '2024-08-31'),
(42, 'Salade d\'aubergines', 'Pâtes aux fruits de mer', 'Éclair au café', '2024-09-01'),
(43, 'Velouté de courgettes', 'Côtelettes de porc grillées', 'Soufflé au chocolat', '2024-09-02'),
(44, 'Salade de lentilles vertes', 'Sauté de veau', 'Tarte aux poires', '2024-09-03'),
(45, 'Gravlaks', 'Filet de sole au beurre blanc', 'Clafoutis aux pommes', '2024-09-04'),
(46, 'Salade de tomates et mozzarella', 'Boeuf au curry', 'Crêpes au caramel', '2024-09-05'),
(47, 'Tarte au chèvre et aux herbes', 'Poulet rôti', 'Tartelette au citron', '2024-09-06'),
(48, 'Moules à la crème', 'Côte de boeuf grillée', 'Pêches rôties', '2024-09-07'),
(49, 'Terrine de légumes', 'Côtelettes d\'agneau à la moutarde', 'Crème brûlée', '2024-09-08'),
(50, 'Salade de pommes de terre', 'Choucroute', 'Mousse au café', '2024-09-09'),
(51, 'Saucisson brioché', 'Filet de porc aux pruneaux', 'Tarte aux fraises', '2024-09-10'),
(52, 'Ceviche de crevettes', 'Boeuf bourguignon', 'Gâteau aux noix', '2024-09-11'),
(53, 'Salade de haricots verts', 'Rôti de bœuf', 'Éclair à la vanille', '2024-09-12'),
(54, 'Tarte à l\'oignon', 'Poisson en papillote', 'Mille-feuille aux fruits', '2024-09-13'),
(55, 'Salade de roquette et parmesan', 'Ratatouille', 'Panna cotta aux fruits rouges', '2024-09-14'),
(56, 'Salade de betteraves', 'Gratin dauphinois', 'Gâteau au chocolat', '2024-09-15'),
(57, 'Tartare de saumon', 'Boeuf Wellington', 'Crème caramel', '2024-09-16'),
(58, 'Salade de concombres', 'Côtelettes de porc', 'Charlotte aux fruits', '2024-09-17'),
(59, 'Terrine de lapin', 'Risotto aux champignons', 'Tarte tatin', '2024-09-18'),
(60, 'Salade de roquette et parmesan', 'Cabillaud en croûte', 'Mille-feuille à la vanille', '2024-09-19'),
(61, 'Pâté de campagne', 'Filet de boeuf en croûte', 'Pouding au pain', '2024-09-20'),
(62, 'Aumônières de chèvre', 'Poulet aux morilles', 'Baba au rhum', '2024-09-21'),
(63, 'Gaspacho de concombre', 'Gratin de courgettes', 'Clafoutis aux poires', '2024-09-22'),
(64, 'Bruschetta', 'Magret de canard aux figues', 'Tiramisu aux fruits rouges', '2024-09-23'),
(65, 'Salade de pâtes', 'Lamb chops with mint sauce', 'Crêpes au Nutella', '2024-09-24'),
(66, 'Céviche de dorade', 'Rôti de porc aux pommes', 'Gâteau au fromage', '2024-09-25'),
(67, 'Feuilletés au saumon', 'Chili con carne', 'Brownies', '2024-09-26'),
(68, 'Chou farci', 'Poisson grillé', 'Tarte au chocolat blanc', '2024-09-27'),
(69, 'Salade de quinoa', 'Boeuf bourguignon', 'Panna cotta aux fruits', '2024-09-28'),
(70, 'Soupe de carottes', 'Côtelettes d\'agneau aux herbes', 'Gâteau au yaourt', '2024-09-29'),
(71, 'Salade de poulet', 'Rôti de veau', 'Tarte au citron meringuée', '2024-09-30'),
(72, 'Rillettes de canard', 'Blanquette de veau', 'Mousse au chocolat blanc', '2024-10-01'),
(73, 'Salade d\'aubergines', 'Pâtes aux fruits de mer', 'Éclair au café', '2024-10-02'),
(74, 'Velouté de courgettes', 'Côtelettes de porc grillées', 'Soufflé au chocolat', '2024-10-03'),
(75, 'Salade de lentilles vertes', 'Sauté de veau', 'Tarte aux poires', '2024-10-04'),
(76, 'Gravlaks', 'Filet de sole au beurre blanc', 'Clafoutis aux pommes', '2024-10-05'),
(77, 'Salade de tomates et mozzarella', 'Boeuf au curry', 'Crêpes au caramel', '2024-10-06'),
(78, 'Tarte au chèvre et aux herbes', 'Poulet rôti', 'Tartelette au citron', '2024-10-07'),
(79, 'Moules à la crème', 'Côte de boeuf grillée', 'Pêches rôties', '2024-10-08'),
(80, 'Terrine de légumes', 'Côtelettes d\'agneau à la moutarde', 'Crème brûlée', '2024-10-09'),
(81, 'Salade de pommes de terre', 'Choucroute', 'Mousse au café', '2024-10-10'),
(82, 'Saucisson brioché', 'Filet de porc aux pruneaux', 'Tarte aux fraises', '2024-10-11'),
(83, 'Ceviche de crevettes', 'Boeuf bourguignon', 'Gâteau aux noix', '2024-10-12'),
(84, 'Salade de haricots verts', 'Rôti de bœuf', 'Éclair à la vanille', '2024-10-13'),
(85, 'Tarte à l\'oignon', 'Poisson en papillote', 'Mille-feuille aux fruits', '2024-10-14'),
(86, 'Salade de tomates', 'Pizza au pesto', 'crème brulée', '2024-10-15'),
(87, 'Sardines au beurre', 'Spaghetti bolognaise et fleurets de broccolis vapeur', 'Crème gourmande aromatisée', '2024-11-10'),
(88, 'Salade de harengs façon bonne femme', 'Cuisse de poulet rôtie au jus, chou braisé et gratin dauphinois', 'Banana bread et toffee', '2024-11-11'),
(89, 'Pizza tomate champignons', 'Rôti de boeuf, ratatouille et gnocchis', 'Pomme rôtie façon grand-mère', '2024-11-12'),
(91, 'Roulade de jambon aux asperges', 'Rognons de veau sauce moutarde crème, carottes fondantes et riz basmati', 'Ile flottante et crème anglaise', '2024-11-13'),
(92, 'Involtini thon', 'Palleron braisé au vin rouge, chou rouge et pomme purée', 'Fromage blanc confiture maison', '2024-11-14'),
(93, 'Salade de haricots vinaigrette aux échalotes et ciboulette', 'Lasagne de poisson, salade d\'accompagnement', 'Chausson aux pommes', '2024-11-15'),
(94, 'Croissant jambon fromage et sauce mornay', 'Sauté de porc au cidre et pommes, céleri braisé et coquillettes', 'Brownie et crème anglaise', '2024-11-16'),
(95, 'Salade de chou blanc au cumin et vinaigrette', 'Omelette aux champignons, haricots beurre et pommes rissolées ', 'Profiterolles à la crème pâtissière', '2024-11-17'),
(96, 'Terrine de campagne', 'Émincé de porc au paprika, navets fondants et boulgour', 'Fruit de saison', '2024-11-18'),
(97, 'Quiche du moment', 'Bourguignon de bœuf de fauconcourt, gratin et flan de potiron', 'Brioche perdue', '2024-11-19'),
(98, 'Tarte fine tomate moutarde', 'Choucroute à la poitrine et saucisse fumée, pommes de terre vapeur', 'chouquettes au sucre perlé', '2024-11-20'),
(99, 'Mousse de foie au porto', 'Boudin noir rôti, compote de pomme et purée de pommes de terre', 'Flan caramel', '2024-11-21'),
(100, 'Salade de céleri remoulade', 'Filet de Colin vapeur sauce hollandaise, carottes braisées et riz basmati', 'Bavarois au fruits rouges', '2024-11-22'),
(101, 'Aspic a l\'œuf et aux crevettes', 'Sauté de volaille, poireaux à la crème et fusilli', 'Banana cake', '2024-11-23'),
(102, 'Poireau vinaigrette', 'Tortellini Sauce tomate, épinards', 'Crèpes confiture', '2024-11-24'),
(103, 'Salade Piémontaise au jambon', 'Veau Marengo traditionnel, haricots verts et pâtes', 'Paris Brest', '2024-11-25'),
(104, 'Terrine de campagne', 'Paupiettes de bœuf, sauce au jus de cuisson, carottes et pommes rissolées', 'Bread and Butter puding', '2024-11-26'),
(105, 'Salade de carottes râpées', 'Émincé de porc à la crème, choux de Bruxelles et boulgour', 'Riz au lait au pain d\'épice', '2024-11-27'),
(106, 'Crëpe farcie au jambon et fromage', 'Langue de bœuf sauce câpres, purée de potiron et polenta', 'Crumble pomme fruits rouge', '2024-11-28'),
(107, 'Salade de betterave au noix et crème', 'Filet de colin meunière, haricots beurre et gnocchis à la crème', 'Baba savarin au rhum', '2024-11-29'),
(108, 'Œuf mimosa traditionnel sur salade', 'Potée à la saucisse ménage, chou et pommes de terre de la ferme Menzin d\'Essegney', 'Fromage blanc confiture maison', '2024-11-30'),
(109, 'Croque monsieur au jambon fromage', 'Spaghetti carbonara, broccoli fleuret vapeur, copeaux de parmesan', 'Tarte au flan maison', '2024-12-01'),
(110, 'Rosette de Lyon sur salade', 'Bourguignon de bœuf de la blonde, chou-fleur et spaetzles', 'Chausson aux pommes', '2024-12-02'),
(111, 'Salade de fenouil ', 'Choucroute à la knack et poitrine, pommes de terre vapeur de la ferme Menzin', 'Tartelette au citron', '2024-12-03'),
(112, 'Quiche aux légumes', 'Foie de veau grillé sauce charcutière, carottes braisées et gratin', 'Brioche perdue', '2024-12-04'),
(113, 'Filets de harengs façon bonne femme', 'Pot au feu de palleron, légumes et pommes de terre du bouillon', 'Mousse caramel Beurre salé', '2024-12-05'),
(114, 'Salades variée et charcuteries', 'Tagliatelles au poisson et fruits de mer, épinards crème', 'Flan caramel maison', '2024-12-06'),
(115, 'Salade de haricots verts vinaigrette', 'cuisse de poulet pochée à la crème, poireaux et riz basmati', 'Ananas en cube', '2024-12-07'),
(116, 'Feuilleté forestière ', 'Omelette au jambon, petits pois et pommes de terre rissolées ', 'Paris brest / mille feuille', '2024-12-08'),
(117, 'Traditionnel oeuf macédoine', 'Sauté de volaille aux champignons et lardons, chou rouge braisé et pommes de terre', 'Panna cotta vanille, coulis de famboise', '2024-12-09'),
(118, 'Pizza tomate champignon jambon', 'Boudin noir, compote de pomme et pomme purée', 'Bread and butter puding', '2024-12-10'),
(119, 'Salade de chou blanc au cumin', 'Rôti de porc au jus, navets à la crème et coquillettes', 'Oranges à la turque', '2024-12-11'),
(120, 'Involtini au thon', 'Joues de porc braisées au cidre, carottes braisées et ébli', 'Tarte normande au flan', '2024-12-12'),
(121, 'Salade de lentilles', 'Vivano au curcuma, endives fondantes et pommes de terre vapeur', 'Crème gourmande aromatisée', '2024-12-13'),
(122, 'Croque monsieur jambon fromage', 'Paupiettes de veau, haricots verts et polenta', 'Cookies', '2024-12-14'),
(123, 'Salade de cervela', 'Spaghetti bolognaise et fromage rapé, Fleurets de broccoli vapeur', 'Tiramisu', '2024-12-15'),
(124, 'Terrine de campagne maison aux noisettes', 'potée lorraine à la saucisse fumée et poitrine, légumes et pommes de terre du bouillon', 'Riz au lait à la vanille', '2024-12-16'),
(125, 'Cake aux olives, poivrons et feta', 'Bourguignon de bœuf de la blonde, carottes fondantes et spaetzles', 'Assortiment de viennoiseries américaines', '2024-12-17'),
(126, 'Salade de quinoa à l\'italienne', 'Chilli con carne au bœuf, maïs et haricots rouge, riz basmati', 'Bûche à la crème au beurre', '2024-12-18'),
(127, 'Raclette au fromage sur pomme de terre vapeur', 'Rognons de veau sauce au madère, côtes de blettes et coquillettes', 'Clémentines ', '2024-12-19'),
(128, 'Charcuterie sur lit de salade composée', 'Lasagne de poisson  accompagné de salade', 'Suisse plate au pépites de chocolat ', '2024-12-20'),
(129, 'Tourte épinards et grenouilles', 'Hachis parmentier a la viande, purée et choux de Bruxelles', 'Salade de fruits ', '2024-12-21'),
(130, 'Poireau vinaigrette à l\'œuf et persil', 'Sauté d\'agneau à la tomate et ail, pois gourmands et pommes noisette', 'Gâteau de semoule fine', '2024-12-22'),
(131, 'Céleri remoulade à la moutarde à l\'ancienne', 'Palette traditionnelle à la diable, carottes et pâtes cellantoni', 'Pomme rôtie façon grand\'mère', '2024-12-23'),
(132, 'Salade de museau vinaigrette', 'Toffaille traditionnelle au kassler, légumes du bouillon et pommes de terre', 'Ile flottante au caramel sur crème anglaise', '2024-12-24'),
(133, 'Asperges sauce gribiche', 'Filet mignon sauce crème au bleu, fagots de haricots verts et grenailles à la graisse de canard', 'Bavarois framboise aux éclats de pistache', '2024-12-25'),
(134, 'Quiche lorraine', 'Cuisse de poulet rôtie, jardinière et spaetzles', 'Clémentines  de corse', '2024-12-26'),
(135, 'Tartine chouchouka aux poivrons confits et œuf dur', 'Filet de colin vapeur sauce hollandaise, épinards crème et riz basmati', 'New-york cheese cake et coulis de fruits rouge', '2024-12-27'),
(136, 'Aspic à l\'œuf et au jambon', 'Boulettes de bœuf rôties, chou braisé et pommes de terre', 'Pain perdu à la brioche', '2024-12-28'),
(137, 'Salade de coleslaw', 'Spaghetti à la carbonnara, Fleurets de broccoli vapeur', 'Cake marbré', '2024-12-29'),
(138, 'Salade de betterave au bleu', 'Daube de bœuf au vin blanc et aux herbes, navets confits et gnocchis', 'Crème gourmande aromatisée', '2024-12-30'),
(139, 'Foie gras sur pain bretzel et compotée d\'oignon', 'Suprème de poulet jaune farcis aux champignons, chou romanesco et risotto aux cèpes', 'Bûche chocolat ou pralinée', '2024-12-31'),
(140, 'Roulade de jambon cru et asperges', 'Choucroute poitrine et kassler, pommes de terre vapeur', 'Compote de mirabelles de Gigney', '2025-01-01'),
(141, 'Assortiment de charcuteries', 'Rôti de bœuf, jus au thym, carottes braisées et pomme purée', 'Bread and butter puding', '2025-01-02'),
(142, 'Tourte à la viande', 'Filet de colin pané sauce rémoulade, julienne de légumes et ébli', 'Riz au lait à la canelle', '2025-01-03'),
(143, 'Salade alaska, surimi chou et ananas', 'Gratin de macaroni au jambon et petits pois', 'Salade de fruits', '2025-01-04'),
(144, 'Croque monsieur', 'Navarin d\'agneau traditionnel, jardinière de légumes et pommes rissolées', 'Flan au caramel', '2025-01-05'),
(145, 'Salade de lentilles vinaigrette', 'Pain de viande sauce crème fromage, fenouil braisé et semoule', 'Galette des rois à la frangipane', '2025-01-06'),
(146, 'Quiche Lorraine traditionnelle au lard', 'Pot au feu de palleron de bœuf, légumes du bouillon et pommes de terre', 'Salade de fruits', '2025-01-07'),
(147, 'Aspic à l\'œuf et au jambon', 'Foie de veau grillé sauce charcutière, broccoli vapeur et pomme purée', 'Fromage blanc et confiture maison', '2025-01-08'),
(148, 'Salade de carottes rapées au persil et échalotte', 'Bourguignon de bœuf de la ferme de la Blonde, haricots beurre et farfalle', 'Pomme grand-mère rôtie à la canelle', '2025-01-09'),
(149, 'Feuilleté forestière', 'Filet de colin vapeur sauce hollandaise, navets braisés et riz basmati', 'Panna cotta au pain d\'épice', '2025-01-10'),
(150, 'Pizza tomate champignon lardons fromage', 'Cuisse de poulet rôtie aux épices, poireaux crème et coquillettes', 'Tiramisu traditionnel au café', '2025-01-11'),
(151, 'Poireau vinaigrette à l\'œuf', 'Omelette au jambon, salsifis au beurre et pommes de terre rissolées', 'Tarte du moment', '2025-01-12'),
(152, 'Salade de museau vinaigrette', 'Potée au choux à la poitrine et saucisse fumée, pommes de terre du bouillon', 'Crumble pomme, fruit rouge (+1/2 cuivre évèn.)', '2025-01-13'),
(153, 'Salade de fenouil au miel et à la ciboulette (+16SV)', 'Boudin noir grillé au jus, compote de pomme et pomme purée', 'Ile flottante à la crème anglaise ', '2025-01-14'),
(154, 'Filets de hareng façon bonne-femme', 'Bœuf de la blonde braisé, chou rouge aux pommes et mini penne', 'Crème gourmande aromatisée', '2025-01-15'),
(155, 'Cake aux olives, poivrons confits et feta', 'Paupiettes de veau sauce à la moutarde, carottes braisées et bougour', 'Riz au lait à la pistache', '2025-01-16'),
(156, 'Roulade de jambon madédoine', 'Filet de poisson sauce aurore, petits pois et pommes de terre vapeur', 'Crèpe confiture', '2025-01-17'),
(157, 'Salade de coleslaw, chou blanc, carotte et fromage blanc', 'Poulet waterzooï à la crème, julienne de légumes et riz basmati', 'Crème brulée à la fève tonka', '2025-01-18'),
(158, 'Salade de haricots, vinaigrette à l\'échalotte et persil', 'Sauté de porc aux lardons et champignons, endives braisées et pâtes', 'Clémentines', '2025-01-19'),
(159, 'Pâté en croute tradition', 'Rôti de porc braisé au thym, navets à la crème et ébli', 'Bread and butter puding', '2025-01-20'),
(160, 'Salade de carottes rapées au persil et échalotte', 'Rognons de veau grillé à la moutarde à l\'ancienne, côtes de blettes et farfalle', 'Orange à la turque', '2025-01-21'),
(161, 'Tartine Chouchouka aux poivrons et thon', 'Bouchées de volaille à la crème, haricots verts et riz basmati', 'Brioche façon pain perdu', '2025-01-22'),
(162, 'Traditionnel œuf macédoine', 'Échine de porc boulangère, broccoli vapeur et pommes boulangère', 'Flan caramel maison', '2025-01-23'),
(163, 'Croissant jambon fromage', 'Lasagne de poisson aux épinards', 'New-York cheese-cake aux cerises griottes', '2025-01-24'),
(164, 'Salade de céleri remoulade', 'Cuisse de poulet rôtie aux épices, poireaux et patates à la crème', 'Suisse plate aux pépites de chocolat', '2025-01-25'),
(165, 'Quiche végétarienne aux œufs et à la crème', 'Omelette au fromage, tomate provençale et coquillettes', 'Crème gourmande aromatisée', '2025-01-26'),
(166, 'Assiette de chorizo doux espagnol', 'Émincé de porc braisé au lard à la payanne, chou frisé et pomme purée', 'Ananas cubes', '2025-01-27'),
(167, 'Salade alsacienne au fromage et knack', 'Sauté de volaille à a crème, chou-fleur en fleuret et penne rigate', 'Brownie au chocolat et noix', '2025-01-28'),
(168, 'Salade de betterave au bleu', 'Rôti de bœuf au jus, carottes braisées et pommes de terre rissolées', 'Pomme grand-mère rôtie à la canelle', '2025-01-29'),
(169, 'Œuf mimosa sur lit de salade ', 'Choucroute poitrine et knack, pommes de terre vapeur', 'Paris Brest', '2025-01-30'),
(170, 'Pâté lorrain de la Francinette', 'Filet de poisson vapeur sauce aurore, céleri rôti au curcuma et gnocchis', 'Chausson aux pommes', '2025-01-31'),
(171, 'Salade de chou blanc à l\'asiatique', 'Spaghetti bolognaise, fromage rapé et chou frisé braisé ', 'Gateau de semoule aux abricots', '2025-02-01'),
(172, 'Quiche Lorraine traditionnelle au lard', 'Blanquette de veau à l\'ancienne, jardinière de légumes et riz basmati', 'Mousse au chocolat', '2025-02-02'),
(173, 'Cake aux olives, feta et chorizo', 'Sauté de porc à la bière, chou-fleur et rosti', 'Crêpe confiture', '2025-02-03'),
(174, 'Salade de museau de porc aux cornichons et persil', 'Tortellini farcis à la viande sauce tomate accompagnés de carottes braisées', 'Galette à la frangipane', '2025-02-04'),
(175, 'Terrine de poisson aux herbes, sauce aigrelette', 'Boudin grillé au jus, compote de pomme et pomme purée', 'Ile flottante et sa crème anglaise', '2025-02-05'),
(176, 'Aspic à l\'œuf de la ferme Bourquin ', 'Bourguignon de Bœuf en sauce, choux de Bruxelles et spaetzles', 'Tiramisu à la framboise et fruits rouge', '2025-02-06'),
(177, 'Salade piémontaise, jambon œuf tomate et pomme de terre', 'Tagliatelles aux poisson et fruits de mer à la crème, épinards en branche', 'Crème catalane et chantilly', '2025-02-07'),
(178, 'Tarte fine à  la moutarde et tomate fraiche', 'Sauté de poulet tandoori (non piquant), haricots verts et riz basmati', 'Cookie fondant aux noisettes et airelles', '2025-02-08'),
(179, 'Rosette de Lyon tranchée', 'Paupiettes de veau braisées, broccoli fleuret et pommes rissolées', 'Crème gourmande aromatisée', '2025-02-09'),
(180, 'Salade de coleslaw au chou et à la carotte', 'langue de bœuf sauce aux câpres, navets confits et pomme purée', 'Riz au lait au caramel beurre salé', '2025-02-10'),
(181, 'Croissant, jambon fromage', 'émincé de volaille à la crème de champignons, choux fleur et coquillettes', 'Pêche au sirop et coulis de fruits rouge', '2025-02-11'),
(182, 'Salade de céleri remoulade à l\'ancienne', 'Potée lorraine à la poitrine et saucisse fumée, légumes et pommes de terre du bouillon ', 'Bread and butter puding', '2025-02-12'),
(183, 'Pâté en croute Richelieu', 'Chipolatas grillées, endives braisées casserolle et farfalle', 'Orange à la turque', '2025-02-13'),
(184, 'Œuf à la russe traditionnel', 'Pépites de colin panées sauce bearnaise, carottes rôties et semoule', 'Brownie au chocolat et noix', '2025-02-14'),
(185, 'Feuilleté forestier au jambon', 'Cuisse de poulet rôtie au jus, haricots beurre et gratin dauphinois', 'Mousse aromatisée', '2025-02-15'),
(186, 'Assortiment de charcuteries', 'Omelette au jambon, petits pois et pommes rissolées à la Marcus', 'Tarte du jour', '2025-02-16'),
(187, 'Salade de pâtes au thon à l a Monique', 'Daube de bœuf de la blonde aux herbes, lentilles et fusilli', 'Clémentines', '2025-02-17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `User_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `First_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'notSet',
  `Last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Doe',
  `Password` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Verification_email` tinyint(1) NOT NULL,
  `Registration_date` datetime NOT NULL,
  `Is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `User_name`, `First_name`, `Last_name`, `Password`, `Phone`, `Email`, `Verification_email`, `Registration_date`, `Is_admin`) VALUES
(1, 'Julie', 'Julie', 'Boyer', 'JB-mdp-1', '(+0033)000000000', 'julie@croustillance.fr', 1, '2023-02-16 13:40:16', 1),
(2, 'Dylan', 'Dylan', 'Durand', 'DD-mdp-1', '(+0033)000000000', 'dylan@croustillance.fr', 1, '2023-02-01 13:42:16', 1),
(3, 'Frederic', 'Frederic', 'Parmentier', 'FP-mdp-1', '(+0033)000000000', 'frederic@croustillance.fr', 1, '2023-03-28 13:42:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `nom_ville` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` smallint(6) NOT NULL,
  `priority` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`nom_ville`, `id`, `priority`) VALUES
('Chamagne', 1, 10),
('Charmes', 2, 20),
('Chatel-sur-Moselle', 3, 30),
('Chavelot', 4, 40),
('Domèvre-sur-Durbion', 5, 50),
('Essegney', 6, 60),
('Frizon', 7, 70),
('Girmont', 8, 80),
('Hadigny-les-Verrières', 9, 90),
('Igney', 10, 100),
('Langley', 11, 110),
('Moriville', 12, 120),
('Nomexy', 13, 130),
('Pallegney', 14, 140),
('Portieux', 15, 150),
('la Verrerie de Portieux', 16, 160),
('Chamagne', 17, 170),
('Vaxoncourt', 18, 180),
('Vincey', 19, 190),
('Autre', 20, 200);

-- --------------------------------------------------------

--
-- Structure de la table `villes_vosges`
--

CREATE TABLE `villes_vosges` (
  `ville_id` mediumint(8) UNSIGNED NOT NULL,
  `nom_ville_vosges` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `villes_vosges`
--

INSERT INTO `villes_vosges` (`ville_id`, `nom_ville_vosges`) VALUES
(34925, 'Ableuvenettes'),
(34891, 'Ahéville'),
(34943, 'Aingeville'),
(34817, 'Ainvelle'),
(34680, 'Allarmont'),
(34799, 'Ambacourt'),
(34791, 'Ameuvelle'),
(35123, 'Anglemont'),
(34855, 'Anould'),
(35076, 'Aouze'),
(34879, 'Arches'),
(34775, 'Archettes'),
(34819, 'Aroffe'),
(34805, 'Arrentès-de-Corcieux'),
(34884, 'Attignéville'),
(35053, 'Attigny'),
(34938, 'Aulnois'),
(34685, 'Aumontzey'),
(34744, 'Autigny-la-Tour'),
(34731, 'Autreville'),
(34695, 'Autrey'),
(35039, 'Auzainvilliers'),
(34900, 'Avillers'),
(34899, 'Avrainville'),
(34896, 'Avranville'),
(35144, 'Aydoilles'),
(35075, 'Badménil-aux-Bois'),
(35134, 'Bains-les-Bains'),
(34765, 'Bainville-aux-Saules'),
(34908, 'Balléville'),
(35067, 'Ban-de-Laveline'),
(35098, 'Ban-de-Sapt'),
(35004, 'Ban-sur-Meurthe-Clefcy'),
(35013, 'Barbey-Seroux'),
(35120, 'Barville'),
(34946, 'Basse-sur-le-Rupt'),
(34878, 'Battexey'),
(34907, 'Baudricourt'),
(34821, 'Bayecourt'),
(34851, 'Bazegney'),
(34906, 'Bazien'),
(35032, 'Bazoilles-et-Ménil'),
(34911, 'Bazoilles-sur-Meuse'),
(34766, 'Beaufremont'),
(34919, 'Beauménil'),
(34701, 'Begnécourt'),
(34727, 'Bellefontaine'),
(35045, 'Belmont-lès-Darney'),
(35029, 'Belmont-sur-Buttant'),
(35034, 'Belmont-sur-Vair'),
(34922, 'Belrupt'),
(34982, 'Belval'),
(34737, 'Bertrimoutier'),
(35115, 'Bettegney-Saint-Brice'),
(35084, 'Bettoncourt'),
(34968, 'Biécourt'),
(35055, 'Biffontaine'),
(35058, 'Blémerey'),
(34699, 'Bleurville'),
(34881, 'Blevaincourt'),
(34700, 'Bocquegney'),
(34783, 'Bois-de-Champ'),
(34927, 'Bonvillet'),
(34846, 'Boulaincourt'),
(34861, 'Bouxières-aux-Bois'),
(35083, 'Bouxurulles'),
(34693, 'Bouzemont'),
(34650, 'Brantigny'),
(35030, 'Brechainville'),
(35036, 'Brouvelieures'),
(34713, 'Brû'),
(34659, 'Bruyères'),
(34703, 'Bulgnéville'),
(35028, 'Bult'),
(34940, 'Bussang'),
(34752, 'Celles-sur-Plaine'),
(34868, 'Certilleux'),
(35116, 'Chamagne'),
(35060, 'Champ-le-Duc'),
(34804, 'Champdray'),
(35041, 'Chantraine'),
(34905, 'Charmes'),
(35128, 'Charmois-devant-Bruyères'),
(34997, 'Charmois-l\'Orgueilleux'),
(35005, 'Châtas'),
(34842, 'Châtel-sur-Moselle'),
(34691, 'Châtenois'),
(34792, 'Châtillon-sur-Saône'),
(34894, 'Chauffecourt'),
(34951, 'Chaumousey'),
(34984, 'Chavelot'),
(35125, 'Chef-Haut'),
(34761, 'Cheniménil'),
(34746, 'Chermisey'),
(35026, 'Circourt'),
(35102, 'Circourt-sur-Mouzon'),
(35135, 'Claudon'),
(35027, 'Clérey-la-Côte'),
(35019, 'Cleurie'),
(34862, 'Clézentaine'),
(34754, 'Coinches'),
(34687, 'Colroy-la-Grande'),
(35023, 'Combrimont'),
(35021, 'Contrexéville'),
(35056, 'Corcieux'),
(34895, 'Cornimont'),
(35137, 'Courcelles-sous-Châtenois'),
(34809, 'Coussey'),
(34654, 'Crainvilliers'),
(34750, 'Damas-aux-Bois'),
(34976, 'Damas-et-Bettegney'),
(35133, 'Damblain'),
(34705, 'Darney'),
(34880, 'Darney-aux-Chênes'),
(35080, 'Darnieulles'),
(34675, 'Deinvillers'),
(34901, 'Denipaire'),
(35110, 'Derbamont'),
(35072, 'Destord'),
(34921, 'Deycimont'),
(35103, 'Deyvillers'),
(35104, 'Dignonville'),
(34639, 'Dinozé'),
(34707, 'Docelles'),
(34839, 'Dogneville'),
(34885, 'Dolaincourt'),
(34779, 'Dombasle-devant-Darney'),
(35061, 'Dombasle-en-Xaintois'),
(34753, 'Dombrot-le-Sec'),
(34729, 'Dombrot-sur-Vair'),
(35105, 'Domèvre-sous-Montfort'),
(34992, 'Domèvre-sur-Avière'),
(34971, 'Domèvre-sur-Durbion'),
(34853, 'Domfaing'),
(34662, 'Domjulien'),
(34772, 'Dommartin-aux-Bois'),
(35035, 'Dommartin-lès-Remiremont'),
(34995, 'Dommartin-lès-Vallois'),
(34782, 'Dommartin-sur-Vraine'),
(34860, 'Dompaire'),
(35018, 'Dompierre'),
(34969, 'Domptail'),
(34684, 'Domrémy-la-Pucelle'),
(34844, 'Domvallier'),
(34747, 'Doncières'),
(35043, 'Dounoux'),
(34645, 'Éloyes'),
(34658, 'Entre-deux-Eaux'),
(34755, 'Épinal'),
(35096, 'Escles'),
(34830, 'Esley'),
(35082, 'Essegney'),
(34843, 'Estrennes'),
(35042, 'Étival-Clairefontaine'),
(34730, 'Évaux-et-Ménil'),
(35143, 'Faucompierre'),
(35062, 'Fauconcourt'),
(34869, 'Fays'),
(34763, 'Ferdrupt'),
(34815, 'Fignévelle'),
(34678, 'Fiménil'),
(34854, 'Florémont'),
(34926, 'Fomerey'),
(35017, 'Fontenay'),
(34947, 'Fontenoy-le-Château'),
(34647, 'Forges'),
(34958, 'Fouchécourt'),
(35147, 'Frain'),
(34966, 'Fraize'),
(34876, 'Frapelle'),
(34964, 'Frebécourt'),
(34796, 'Fremifontaine'),
(34932, 'Frenelle-la-Grande'),
(34790, 'Frenelle-la-Petite'),
(34644, 'Frénois'),
(34786, 'Fresse-sur-Moselle'),
(35025, 'Fréville'),
(34870, 'Frizon'),
(34890, 'Gelvécourt-et-Adompt'),
(35007, 'Gemaingoutte'),
(34769, 'Gemmelaincourt'),
(34653, 'Gendreville'),
(34942, 'Gérardmer'),
(34801, 'Gerbamont'),
(34773, 'Gerbépal'),
(35051, 'Gignéville'),
(34874, 'Gigney'),
(35122, 'Girancourt'),
(34952, 'Gircourt-lès-Viéville'),
(34957, 'Girecourt-sur-Durbion'),
(34941, 'Girmont'),
(34955, 'Girmont-Val-d\'Ajol'),
(34841, 'Gironcourt-sur-Vraine'),
(34725, 'Godoncourt'),
(34759, 'Golbey'),
(34768, 'Gorhey'),
(35063, 'Grand'),
(34988, 'Grandrupt'),
(34661, 'Grandrupt-de-Bains'),
(34915, 'Grandvillers'),
(34669, 'Granges-sur-Vologne'),
(35129, 'Greux'),
(35127, 'Grignoncourt'),
(35044, 'Gruey-lès-Surance'),
(34864, 'Gugnécourt'),
(34781, 'Gugney-aux-Aulx'),
(35066, 'Hadigny-les-Verrières'),
(34998, 'Hadol'),
(34954, 'Hagécourt'),
(34682, 'Hagnéville-et-Roncourt'),
(34912, 'Haillainville'),
(34777, 'Harchéchamp'),
(34985, 'Hardancourt'),
(34640, 'Haréville'),
(34635, 'Harmonville'),
(34751, 'Harol'),
(35052, 'Harsault'),
(35049, 'Hautmougey'),
(34948, 'Hennecourt'),
(34636, 'Hennezel'),
(34975, 'Hergugney'),
(34845, 'Herpelmont'),
(34979, 'Houécourt'),
(34785, 'Houéville'),
(34928, 'Housseras'),
(34827, 'Hurbache'),
(34708, 'Hymont'),
(35033, 'Igney'),
(34811, 'Isches'),
(34961, 'Jainvillotte'),
(34824, 'Jarménil'),
(35020, 'Jeanménil'),
(35086, 'Jésonville'),
(34656, 'Jeuxey'),
(34893, 'Jorxey'),
(34671, 'Jubainville'),
(34793, 'Jussarupt'),
(34956, 'Juvaincourt'),
(34676, 'La Baffe'),
(34882, 'La Bourgonce'),
(34715, 'La Bresse'),
(34663, 'La Chapelle-aux-Bois'),
(35011, 'La Chapelle-devant-Bruyères'),
(34633, 'La Croix-aux-Mines'),
(34999, 'La Forge'),
(34858, 'La Grande-Fosse'),
(34649, 'La Haye'),
(34897, 'La Houssière'),
(34694, 'La Neuveville-devant-Lépanges'),
(34931, 'La Neuveville-sous-Châtenois'),
(35038, 'La Neuveville-sous-Montfort'),
(34813, 'La Petite-Fosse'),
(34913, 'La Petite-Raon'),
(34898, 'La Salle'),
(34643, 'La Vacheresse-et-la-Rouillie'),
(35136, 'La Voivre'),
(34872, 'Landaville'),
(34871, 'Langley'),
(35073, 'Laval-sur-Vologne'),
(34812, 'Laveline-devant-Bruyères'),
(34994, 'Laveline-du-Houx'),
(34723, 'Le Beulay'),
(34873, 'Le Clerjus'),
(34852, 'Le Magny'),
(34980, 'Le Ménil'),
(34673, 'Le Mont'),
(35059, 'Le Puid'),
(35095, 'Le Roulier'),
(34903, 'Le Saulcy'),
(34634, 'Le Syndicat'),
(35014, 'Le Thillot'),
(35118, 'Le Tholy'),
(34732, 'Le Val-d\'Ajol'),
(34652, 'Le Valtin'),
(35071, 'Le Vermont'),
(34674, 'Légéville-et-Bonfays'),
(35003, 'Lemmecourt'),
(34923, 'Lépanges-sur-Vologne'),
(35140, 'Lerrain'),
(34837, 'Lesseux'),
(34787, 'Liézey'),
(34962, 'Liffol-le-Grand'),
(34904, 'Lignéville'),
(34789, 'Lironcourt'),
(35054, 'Longchamp'),
(34859, 'Longchamp-sous-Châtenois'),
(35074, 'Lubine'),
(34933, 'Lusse'),
(35015, 'Luvigny'),
(34832, 'Maconcourt'),
(34944, 'Madecourt'),
(34745, 'Madegney'),
(34655, 'Madonne-et-Lamerey'),
(34638, 'Malaincourt'),
(34950, 'Mandray'),
(34679, 'Mandres-sur-Vair'),
(34748, 'Marainville-sur-Madon'),
(35145, 'Marche'),
(34820, 'Marey'),
(34810, 'Maroncourt'),
(35130, 'Martigny-les-Bains'),
(34814, 'Martigny-les-Gerbonvaux'),
(34929, 'Martinvelle'),
(34733, 'Mattaincourt'),
(35142, 'Maxey-sur-Meuse'),
(34822, 'Mazeley'),
(34934, 'Mazirot'),
(35050, 'Médonville'),
(34816, 'Méménil'),
(34840, 'Ménarmont'),
(34742, 'Ménil-de-Senones'),
(34909, 'Ménil-en-Xaintois'),
(34726, 'Ménil-sur-Belvitte'),
(35119, 'Midrevaux'),
(34978, 'Mirecourt'),
(35139, 'Moncel-sur-Vair'),
(34767, 'Mont-lès-Lamarche'),
(34648, 'Mont-lès-Neufchâteau'),
(34865, 'Monthureux-le-Sec'),
(35112, 'Monthureux-sur-Saône'),
(34970, 'Montmotier'),
(34641, 'Morelmaison'),
(34721, 'Moriville'),
(34965, 'Morizécourt'),
(34849, 'Mortagne'),
(34651, 'Morville'),
(35146, 'Moussey'),
(35114, 'Moyemont'),
(34798, 'Moyenmoutier'),
(34818, 'Nayemont-les-Fosses'),
(35107, 'Neufchâteau'),
(34806, 'Neuvillers-sur-Fave'),
(34875, 'Nomexy'),
(35068, 'Nompatelize'),
(35094, 'Nonville'),
(35064, 'Nonzeville'),
(34709, 'Norroy'),
(35022, 'Nossoncourt'),
(34686, 'Oëlleville'),
(35001, 'Offroicourt'),
(34774, 'Ollainville'),
(34917, 'Oncourt'),
(34808, 'Ortoncourt'),
(34770, 'Padoux'),
(34646, 'Pair-et-Grandrupt'),
(35093, 'Pallegney'),
(34902, 'Parey-sous-Montfort'),
(34949, 'Pargny-sous-Mureau'),
(34886, 'Pierrefitte'),
(34683, 'Pierrepont-sur-l\'Arentèle'),
(34797, 'Plainfaing'),
(34959, 'Pleuvezain'),
(35009, 'Plombières-les-Bains'),
(34877, 'Pompierre'),
(34706, 'Pont-lès-Bonfays'),
(34690, 'Pont-sur-Madon'),
(34776, 'Portieux'),
(34847, 'Poulières'),
(34850, 'Poussay'),
(34677, 'Pouxeux'),
(35138, 'Prey'),
(35132, 'Provenchères-lès-Darney'),
(34831, 'Provenchères-sur-Fave'),
(34935, 'Punerot'),
(34848, 'Puzieux'),
(34743, 'Racécourt'),
(34807, 'Rainville'),
(35081, 'Rambervillers'),
(35048, 'Ramecourt'),
(34803, 'Ramonchamp'),
(35037, 'Rancourt'),
(34716, 'Raon-aux-Bois'),
(34889, 'Raon-l\'Étape'),
(34788, 'Raon-sur-Plaine'),
(35024, 'Rapey'),
(34758, 'Raves'),
(34838, 'Rebeuville'),
(35010, 'Regnévelle'),
(34856, 'Regney'),
(34738, 'Rehaincourt'),
(34666, 'Rehaupal'),
(34883, 'Relanges'),
(35126, 'Remicourt'),
(35002, 'Remiremont'),
(34757, 'Remomeix'),
(34778, 'Remoncourt'),
(34836, 'Removille'),
(34664, 'Renauvoid'),
(34910, 'Repel'),
(34734, 'Robécourt'),
(34657, 'Rochesson'),
(34724, 'Rocourt'),
(34688, 'Rollainville'),
(35047, 'Romain-aux-Bois'),
(34937, 'Romont'),
(34681, 'Rouges-Eaux'),
(35099, 'Rouvres-en-Xaintois'),
(35124, 'Rouvres-la-Chétive'),
(34749, 'Roville-aux-Chênes'),
(34670, 'Rozerotte'),
(34996, 'Rozières-sur-Mouzon'),
(34987, 'Rugney'),
(34672, 'Ruppes'),
(35141, 'Rupt-sur-Moselle'),
(34702, 'Saint-Amé'),
(34720, 'Saint-Baslemont'),
(34973, 'Saint-Benoît-la-Chipotte'),
(34990, 'Saint-Dié-des-Vosges'),
(34924, 'Saint-Étienne-lès-Remiremont'),
(34993, 'Saint-Genest'),
(35092, 'Saint-Gorgon'),
(34829, 'Saint-Jean-d\'Ormont'),
(34712, 'Saint-Julien'),
(34991, 'Saint-Léonard'),
(34888, 'Saint-Maurice-sur-Mortagne'),
(34892, 'Saint-Maurice-sur-Moselle'),
(35079, 'Saint-Menge'),
(34711, 'Saint-Michel-sur-Meurthe'),
(34696, 'Saint-Nabord'),
(34826, 'Saint-Ouen-lès-Parey'),
(34735, 'Saint-Paul'),
(34833, 'Saint-Pierremont'),
(35111, 'Saint-Prancher'),
(34739, 'Saint-Remimont'),
(35016, 'Saint-Rémy'),
(34866, 'Saint-Stail'),
(34977, 'Saint-Vallier'),
(34887, 'Sainte-Barbe'),
(35090, 'Sainte-Hélène'),
(34771, 'Sainte-Marguerite'),
(34867, 'Sanchey'),
(35106, 'Sandaucourt'),
(35089, 'Sans-Vallois'),
(34936, 'Sapois'),
(34953, 'Sartes'),
(34974, 'Saulcy-sur-Meurthe'),
(34967, 'Saulxures-lès-Bulgnéville'),
(34764, 'Saulxures-sur-Moselotte'),
(35131, 'Sauville'),
(34914, 'Savigny'),
(34916, 'Senaide'),
(34960, 'Senones'),
(34637, 'Senonges'),
(34736, 'Seraumont'),
(34930, 'Sercœur'),
(35109, 'Serécourt'),
(35113, 'Serocourt'),
(34986, 'Sionne'),
(34728, 'Socourt'),
(34989, 'Soncourt'),
(34835, 'Soulosse-sous-Saint-Élophe'),
(35065, 'Suriauville'),
(35091, 'Taintrux'),
(34692, 'Tendon'),
(34762, 'Thaon-les-Vosges'),
(34920, 'They-sous-Montfort'),
(34704, 'Thiéfosse'),
(35040, 'Thiraucourt'),
(34667, 'Thons'),
(35097, 'Thuillières'),
(34710, 'Tignécourt'),
(35101, 'Tilleux'),
(35077, 'Tollaincourt'),
(35069, 'Totainville'),
(34717, 'Trampot'),
(34828, 'Tranqueville-Graux'),
(34714, 'Trémonzey'),
(34918, 'Ubexy'),
(34665, 'Uriménil'),
(34863, 'Urville'),
(34963, 'Uxegney'),
(34660, 'Uzemain'),
(34718, 'Vagney'),
(34981, 'Valfroicourt'),
(35031, 'Valleroy-aux-Saules'),
(34945, 'Valleroy-le-Sec'),
(34823, 'Vallois'),
(34983, 'Varmonzey'),
(34760, 'Vaubexy'),
(34668, 'Vaudeville'),
(34802, 'Vaudoncourt'),
(35121, 'Vaxoncourt'),
(35000, 'Vecoux'),
(34780, 'Velotte-et-Tatignécourt'),
(35008, 'Ventron'),
(34972, 'Vervezelle'),
(35012, 'Vexaincourt'),
(34857, 'Vicherey'),
(34795, 'Vienville'),
(34800, 'Vieux-Moulin'),
(35117, 'Ville-sur-Illon'),
(34756, 'Villers'),
(34642, 'Villoncourt'),
(35046, 'Villotte'),
(35078, 'Villouxel'),
(34834, 'Viménil'),
(34719, 'Vincey'),
(35100, 'Viocourt'),
(35085, 'Vioménil'),
(34740, 'Vittel'),
(35087, 'Viviers-le-Gras'),
(35057, 'Viviers-lès-Offroicourt'),
(34722, 'Voivres'),
(35006, 'Vomécourt'),
(34689, 'Vomécourt-sur-Madon'),
(34784, 'Vouxey'),
(34794, 'Vrécourt'),
(34698, 'Vroville'),
(35088, 'Wisembach'),
(35070, 'Xaffévillers'),
(34697, 'Xamontarupt'),
(34741, 'Xaronval'),
(35108, 'Xertigny'),
(34825, 'Xonrupt-Longemer'),
(34939, 'Zincourt');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_ville` (`id_ville`);

--
-- Index pour la table `contacts_autres_villes`
--
ALTER TABLE `contacts_autres_villes`
  ADD PRIMARY KEY (`id_contact`,`id_ville_vosges`),
  ADD KEY `id_ville_vosges` (`id_ville_vosges`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villes_vosges`
--
ALTER TABLE `villes_vosges`
  ADD PRIMARY KEY (`ville_id`),
  ADD KEY `ville_nom_reel` (`nom_ville_vosges`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `villes_vosges`
--
ALTER TABLE `villes_vosges`
  MODIFY `ville_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36831;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_id_ville` FOREIGN KEY (`id_ville`) REFERENCES `villes` (`id`);

--
-- Contraintes pour la table `contacts_autres_villes`
--
ALTER TABLE `contacts_autres_villes`
  ADD CONSTRAINT `contacts_autres_villes_ibfk_1` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_autres_villes_ibfk_2` FOREIGN KEY (`id_ville_vosges`) REFERENCES `villes_vosges` (`ville_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
