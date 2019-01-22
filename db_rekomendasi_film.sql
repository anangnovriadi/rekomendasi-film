-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 05:09 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekomendasi_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin@admin@.com', 'admin', '$2y$10$Y1e8YdxHiE8XqH8wmVG50uq3EK.0qQnCrTP4Y21Ze04o16xU7mON6', 'c49n32JHtH7CGKLi5K4UIcv3l6GKXVNjfCjZPIXwWqphkHrNqSwr0wiXTnTL', '2018-12-01 11:40:57', '2018-12-01 11:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `c_products`
--

CREATE TABLE `c_products` (
  `id` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `tf_idf` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_products`
--

CREATE TABLE `d_products` (
  `id` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `tf_idf` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(10) NOT NULL,
  `nama_film` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktor_aktris` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `negara` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_film` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_film` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` float NOT NULL,
  `type_movie` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `nama_film`, `nama_slug`, `genre`, `aktor_aktris`, `tahun`, `produksi`, `negara`, `deskripsi_film`, `image_film`, `rating`, `type_movie`, `kelas`, `created_at`, `updated_at`) VALUES
(8, 'ben', 'ben', 'drama', 'julia robert', '2018', 'black bear pictur', 'USA', 'drug addict teenag boi show unexpectedli famili s home christma ev', 'images/ben.jpg', 6.9, 'realesed', 'y', '2018-12-07 00:31:45', '2018-12-07 00:31:45'),
(9, 'titan', 'titan', 'drama', 'leonardo dicaprio', '1997', 'twentieth centuri fox', 'USA', 'aristocrat fall love kind poor artist aboard luxuri', 'images/titanic.jpg', 7.8, 'realesed', 'y', '2018-12-07 00:32:49', '2018-12-07 00:32:49'),
(10, 'robin hood', 'robin-hood', 'action', 'taron egerton', '2018', 'summit entertain', 'USA', 'war harden crusad moorish command mount audaci revolt corrupt english', 'images/robinhood.jpg', 5.4, 'realesed', 'y', '2018-12-07 00:33:15', '2018-12-07 00:33:15'),
(11, 'avatar', 'avatar', 'action', 'sam worthington', '2009', 'twentieth centuri fox', 'UK', 'parapleg marin dispatch moon pandora uniqu mission torn follow order', 'images/avatar.jpg', 7.8, 'realesed', 'y', '2018-12-07 00:33:41', '2018-12-07 00:33:41'),
(12, 'martian', 'matian', 'drama', 'matt damon', '2015', 'twentieth centuri fox', 'USA', 'astronaut strand mar team assum dead action', 'images/martian.jpg', 8, 'realesed', 'y', '2018-12-07 00:34:07', '2018-12-07 00:34:07'),
(13, 'deadpool', 'deadpool', 'action', 'ryan', '2018', 'twentieth centuri fox', 'USA', 'foul mouth mutant mercenari wade wilson', 'images/deadpool.jpg', 7.8, 'realesed', 'y', '2018-12-12 05:03:41', '2018-12-12 05:03:41'),
(14, 'godzilla', 'godzilla', 'action', 'milli bobbi brown', '2014', 'summit entertain', 'UK', 'crypto zoolog agenc monarch face batteri god size monster includ mighti godzilla', 'images/godzila.jpg', 6.4, 'realesed', 'y', '2018-12-12 05:04:27', '2018-12-12 05:04:27'),
(15, 'jurass world fallen kingdom', 'jurass-world-fallen-kingdom', 'adventur', 'chri pratt', '2018', 'marvel', 'USA', 'island s dormant volcano begin roar life owen clair mount campaign rescu remain dinosaur extinct level event', 'images/jurasicjpg.jpg', 6.2, 'realesed', 'y', '2018-12-28 08:06:33', '2018-12-28 08:06:33'),
(17, 'gladiat', 'gladiat', 'action', 'russel crow', '2000', 'marvel', '2000', 'roman gener set exact vengeanc corrupt emperor murder famili sent slaveri', 'images/gladiatorjpg.jpg', 8.5, 'realesed', 'y', '2019-01-05 06:55:16', '2019-01-05 06:55:16'),
(18, 'arctic justic', 'arctic-justic', 'action', 'jame franco', '2019', 'ambi group', '2019', 'swifti arctic fox work mail room arctic blast deliveri servic dream dai dog arctic s star huski courier', 'images/articjpg.jpg', 6.2, 'coming soon', 'y', '2019-01-07 17:18:00', '2019-01-07 17:18:00'),
(19, 'seren', 'seren', 'drama', 'dian lane', '2019', 'global road entertain', '2019', 'mysteri past fish boat captain come haunt ex wife track desper plea help ensnar life new realiti', 'images/serentyjpg.jpg', 6.7, 'realesed', 'y', '2019-01-07 17:19:55', '2019-01-07 17:19:55'),
(20, 'disast', 'disast', 'action', 'matt lanter', '2008', 'lionsgat', '2008', 'cours even unsuspect group someth bombard seri natur disast catastroph event', 'images/disasterjpg.jpg', 2.4, 'realesed', 't', '2019-01-11 00:20:04', '2019-01-11 00:20:04'),
(21, 'hous dead', 'hous-dead', 'action', 'jonathan cherri', '2003', 'marvel', '2003', 'group colleg student travel mysteri island attend rave soon taken bloodthirsti zombi', 'images/housejpg.jpg', 3.5, 'realesed', 't', '2019-01-11 00:25:29', '2019-01-11 00:25:29'),
(22, 'save christma', 'save-christma', 'action', 'kirk cameron', '2014', 'camfam studio', '2014', 'annual christma parti falter thank cynic brother law grow pain star kirk cameron attempt save dai show jesu christ remain crucial compon commerci holidai', 'images/savingjpg.jpg', 4.2, 'realesed', 't', '2019-01-11 00:26:54', '2019-01-11 00:26:54'),
(23, 'battlefield earth', 'battlefield-earth', 'action', 'john travolta', '2000', 'warner bro', '2000', 's year 3000 d earth lost alien race psychlo human enslav gold thirsti tyrant unawar man anim ignit rebellion lifetim', 'images/battlejpg.jpg', 2.3, 'realesed', 't', '2019-01-11 00:28:18', '2019-01-11 00:28:18'),
(24, 'gundai', 'gundai', 'action', 'ranveer singh', '2014', 'marvel', '2014', 'live calcutta s power gundai bikram bala chang nandita enter counter forc take charg thriller unfold', 'images/gundayjpg.jpg', 4.6, 'realesed', 't', '2019-01-11 00:31:40', '2019-01-11 00:31:40'),
(25, 'angri men', 'angri-men', 'drama', 'martin balsam', '1957', 'mgm studio', '1957', 'juri holdout attempt prevent miscarriag justic forc colleagu reconsid evid', 'images/handjpg.jpg', 8.9, 'realesed', 'y', '2019-01-11 00:33:15', '2019-01-11 00:33:15'),
(26, 'interstellar', 'interstellar', 'fantasy', 'ellen burstyn', '2010', 'marvel', '2010', 'team explor travel wormhol space attempt ensur human s surviv', 'images/intestellarjpg.jpg', 7.8, 'realesed', 'y', '2019-01-11 00:35:40', '2019-01-11 00:35:40'),
(27, 'halloween', 'halloween', 'drama', 'rhian ree', '2018', 'blumhous product', '2018', 'lauri strode confront long time foe michael myer mask figur haunt narrowli escap kill spree halloween night decad ago', 'images/hallowenjpg.jpg', 6.5, 'realesed', 'y', '2019-01-11 00:37:38', '2019-01-11 00:37:38'),
(28, 'smallfoot', 'smallfoot', 'action', 'chan tatum', '2018', 'warner anim group', '2018', 'yeti convinc elus creatur known human realli exist', 'images/smalljpg.jpg', 5.6, 'realesed', 'y', '2019-01-11 00:39:18', '2019-01-11 00:39:18'),
(31, 'heiress', 'heiress', 'drama', 'rossana bellassai', '2018', 'la babosa cine', '2018', 'chela chiquita descend wealthi famili asunci n 30 year', 'images/heirsjpg.jpg', 7, 'realesed', 'y', '2019-01-12 07:41:03', '2019-01-12 07:41:03'),
(32, 'fast furiou', 'fast-furiou', 'action', 'paul walker', '2001', 'univers pictur', '2001', 'lo angel polic offic brian o connor decid loyalti', 'images/ffjpg.jpg', 6.8, 'realesed', 'y', '2019-01-13 08:41:13', '2019-01-13 08:41:13'),
(33, 'mr bean', 'mr-bean', 'comedi', 'rowan atkinson', '2009', 'tiger aspect product', '2009', 'life difficult challeng mr bean despit grown adult', 'images/beanjpg.jpg', 7.8, 'realesed', 'y', '2019-01-13 08:44:59', '2019-01-13 08:44:59'),
(34, 'captain america aveng', 'captain-america-aveng', 'action', 'chri evan', '2011', 'marvel', '2011', 'steve roger reject militari soldier transform captain america take', 'images/avengerjpg.jpg', 6.9, 'realesed', 'y', '2019-01-13 08:46:31', '2019-01-13 08:46:31'),
(35, 'miss bala', 'miss-bala', 'fantasy', 'gina rodriguez', '2019', 'soni pictur', '2019', 'gloria find power knew drawn danger world cross border crime', 'images/belajpg.jpg', 4.5, 'coming soon', 't', '2019-01-13 08:49:16', '2019-01-13 08:49:16'),
(36, 'dark knight', 'dark-knight', 'crime', 'christian bale', '2008', 'warner bro', '2008', 'menac known joker emerg mysteri past wreak havoc chao peopl gotham', 'images/darkjpg.jpg', 9, 'realesed', 'y', '2019-01-13 09:15:59', '2019-01-13 09:15:59'),
(37, 'harri potter sorcer s stone', 'harri-potter-sorcer-s-stone', 'adventur', 'daniel radcliff', '2001', 'warner bro', '2001', 'orphan boi enrol school wizardri learn truth', 'images/harryjpg.jpg', 7.6, 'realesed', 'y', '2019-01-13 09:22:52', '2019-01-13 09:22:52'),
(38, 'babi geniu', 'babi-geniu', 'comedi', 'christoph lloyd', '1999', 'crystal sky worldwid', '1999', 'scientist hold talk super intellig babi captiv', 'images/babyjpg.jpg', 2.6, 'realesed', 't', '2019-01-13 09:24:05', '2019-01-13 09:24:05'),
(39, 'kazaam', 'kazaam', 'comedi', 'hardwel', '1996', 'brooklyn', '1996', 'troubl kid inadvert releas geni grant wish request', 'images/kazamjpg.jpg', 2.9, 'realesed', 't', '2019-01-13 09:25:31', '2019-01-13 09:25:31'),
(40, 'aladdin', 'aladdin', 'adventur', 'naomi scott', '2019', 'walt disnei', '2019', 'live action retel 1992 disnei film', 'images/aladinjpg.jpg', 7.5, 'coming soon', 'y', '2019-01-13 09:27:35', '2019-01-13 09:27:35'),
(41, 'meg', 'meg', 'action', 'jason statham', '2018', 'apel entertain', '2018', 'escap attack claim 70 foot shark jona taylor confront fear save trap sunken submers', 'images/megjpg.jpg', 5.7, 'realesed', 'y', '2019-01-13 09:29:08', '2019-01-13 09:29:08'),
(42, 'train dragon hidden world', 'train-dragon-hidden-world', 'anim', 'cate blanchett', '2019', 'dreamwork anim', '2019', 'hiccup fulfil dream creat peac dragon utopia', 'images/trainjpg.jpg', 8, 'coming soon', 'y', '2019-01-13 09:31:15', '2019-01-13 09:31:15'),
(43, 'find nemo', 'find-nemo', 'anim', 'albert brook', '2003', 'pixar anim studio', '2003', 'son captur great barrier reef taken sydnei', 'images/nemojpg.jpg', 8.1, 'realesed', 'y', '2019-01-13 09:33:00', '2019-01-13 09:33:00'),
(44, 'gold rush', 'gold-rush', 'adventur', 'charl chaplin', '1925', 'charl chaplin product', '1925', 'prospector goe klondik search gold find', 'images/chaplinjpg.jpg', 8.2, 'realesed', 'y', '2019-01-13 09:34:31', '2019-01-13 09:34:31'),
(45, 'game throne', 'game-throne', 'action', 'emilia clark', '2011', 'peter dinklag', '2011', 'nobl famili fight control mythic land westero ancient enemi return dormant thousand year', 'images/thronjpg.jpg', 9.5, 'realesed', 'y', '2019-01-13 09:46:16', '2019-01-13 09:46:16'),
(46, 'black mirror', 'black-mirror', 'drama', 'daniel lapain', '2011', 'zeppotron', '2011', 'antholog seri explor twist high tech world human s greatest innov darkest instinct collid', 'images/blackjpg.jpg', 8.9, 'realesed', 'y', '2019-01-13 09:48:15', '2019-01-13 09:48:15'),
(47, 'catwoman', 'catwoman', 'action', 'hall berri', '2004', 'marvel', '2004', 'shy woman endow speed reflex sens cat', 'images/catwomanjpg.jpg', 3.3, 'realesed', 't', '2019-01-13 09:51:21', '2019-01-13 09:51:21'),
(48, 'crossroad', 'crossroad', 'comedi', 'britnei spear', '2002', 'fuzzi bunni film', '2002', 'childhood best friend gui just met road trip countri find friendship process', 'images/crossjpg.jpg', 3.4, 'realesed', 't', '2019-01-13 09:53:37', '2019-01-13 09:53:37'),
(49, 'master disguis', 'master-disguis', 'adventur', 'dana carvei', '2002', 'revolut studio', '2002', 'italian waiter fight crimin mastermind inherit power disguis', 'images/disjpg.jpg', 3.3, 'realesed', 't', '2019-01-13 09:55:43', '2019-01-13 09:55:43'),
(50, 'batman robin', 'batman-robin', 'action', 'arnold schwarzenegg', '1997', 'warner bro', '1997', 'batman robin try relationship stop mr freez poison ivi freez gotham citi', 'images/batjpg.jpg', 3.7, 'realesed', 't', '2019-01-13 09:57:23', '2019-01-13 09:57:23'),
(51, 'grindhous', 'grindhous', 'horror', 'kurt russel', '2007', 'dimens film', '2007', 'quentin tarantino robert rodriguez s homag exploit doubl', 'images/grinjpg.jpg', 7.6, 'realesed', 'y', '2019-01-13 09:59:49', '2019-01-13 09:59:49'),
(52, 'exorcist', 'exorcist', 'horror', 'ellen burstyn', '1973', 'warner bro', '1973', 'teenag girl possess mysteri entiti mother seek help priest save daughter', 'images/exorjpg.jpg', 8, 'realesed', 'y', '2019-01-13 10:01:40', '2019-01-13 10:01:40'),
(53, 'wolf wall street', 'wolf-wall-street', 'crime', 'leonardo dicaprio', '2013', 'red granit pictur', '2013', 'base true stori jordan belfort rise wealthi stock broker live high life fall involv crime corrupt feder govern', 'images/wolfjpg.jpg', 8, 'realesed', 'y', '2019-01-13 10:03:13', '2019-01-13 10:03:13'),
(54, 'upsid', 'upsid', 'comedi', 'kevin hart', '2017', 'lantern entertain', '2017', 'comed look relationship wealthi man quadriplegia unemploi man crimin record s hire help', 'images/upsidejpg.jpg', 4.9, 'realesed', 't', '2019-01-13 10:05:42', '2019-01-13 10:05:42'),
(55, 'toi stori', 'toi-stori', 'anim', 'tom hank', '2010', 'walt disnei pictur', '2010', 'toi mistakenli deliv dai care center instead attic right andi leav colleg', 'images/toyjpg.jpg', 8.3, 'realesed', 'y', '2019-01-13 10:08:52', '2019-01-13 10:08:52'),
(56, 'insid', 'insid', 'anim', 'ami poehler', '2015', 'walt disnei pictur', '2015', 'young rilei uproot midwest life move san francisco', 'images/insidejpg.jpg', 8.2, 'realesed', 'y', '2019-01-13 10:10:06', '2019-01-13 10:10:06'),
(57, 'guardian galaxi', 'guardian-galaxi', 'action', 'chri pratt', '2014', 'marvel', '2014', 'group intergalact crimin forc work stop fanat warrior take control univers', 'images/guardjpg.jpg', 8, 'realesed', 'y', '2019-01-13 10:12:18', '2019-01-13 10:12:18'),
(58, 'lord ring return king', 'lord-ring-return-king', 'adventur', 'elijah wood', '2003', 'new line cinema', '2003', 'gandalf aragorn lead world men sauron s armi draw gaze frodo sam approach mount doom ring', 'images/lordjpg.jpg', 8.9, 'realesed', 'y', '2019-01-13 10:13:51', '2019-01-13 10:13:51'),
(59, 'stranger thing', 'stranger-thing', 'drama', 'milli bobbi brown', '2006', 'monkei entertain', '2006', 'young boi disappear mother polic chief friend confront terrifi forc order', 'images/strangerjpg.jpg', 8.9, 'realesed', 'y', '2019-01-13 10:15:54', '2019-01-13 10:15:54'),
(60, 'save christma', 'save-christma', 'comedi', 'kirk cameron', '2014', 'camfam studio', '2014', 'annual christma parti falter thank cynic brother law', 'images/kirikjpg.jpg', 1.5, 'realesed', 't', '2019-01-13 10:18:11', '2019-01-13 10:18:11'),
(61, 'dragonbal evolut', 'dragonbal-evolut', 'action', 'justin chatwin', '2009', 'twentieth centuri fox', '2009', 'young warrior son goku set quest race time veng king piccolo', 'images/dragjpg.jpg', 2.6, 'realesed', 't', '2019-01-13 10:20:04', '2019-01-13 10:20:04'),
(62, 'troll', 'troll', 'comedi', 'michael paul stephenson', '1990', 'filmirag', '1990', 'famili vacat small town discov entir town inhabit goblin disguis human plan eat', 'images/troljpg.jpg', 2.8, 'realesed', 't', '2019-01-13 10:24:22', '2019-01-13 10:24:22'),
(63, 'extrem movi', 'extrem-movi', 'comedi', 'franki muniz', '2008', 'blue balli', '2008', 'sketch comedi movi joi embarrass teen sex embarrass', 'images/extremejpg.jpg', 3.7, 'realesed', 't', '2019-01-13 10:26:16', '2019-01-13 10:26:16'),
(64, 'aquaman', 'aquaman', 'action', 'jason momoa', '2018', 'dc comic', '2018', 'arthur curri learn heir underwat kingdom atlanti step forward lead peopl hero world', 'images/aquajpg.jpg', 7.5, 'realesed', 'y', '2019-01-13 10:27:41', '2019-01-13 10:27:41'),
(65, 'venom', 'venom', 'action', 'tom hardi', '2018', 'avi arad product', '2018', 'eddi brock acquir power symbiot releas alter ego venom save life', 'images/venomjpg.jpg', 6.8, 'realesed', 'y', '2019-01-14 00:14:12', '2019-01-14 00:14:12'),
(66, 'intouch', 'intouch', 'biographi', 'fran oi cluzet', '2011', 'quad product', '2011', 'quadripleg paraglid accid aristocrat hire young man project caregiv', 'images/intoujpg.jpg', 8.5, 'realesed', 'y', '2019-01-19 02:27:52', '2019-01-19 02:27:52'),
(67, 'reven', 'reven', 'action', 'tom hardi', '2015', 'regenc enterpris', '2015', 'frontiersman fur trade expedit 1820 fight surviv maul', 'images/reventjpg.jpg', 8, 'realesed', 'y', '2019-01-19 02:30:45', '2019-01-19 02:30:45'),
(68, 'vampir suck', 'vampir-suck', 'comedi', 'jenn prosk', '2010', 'regenc enterpris', '2010', 'spoof vampir theme movi teenag becca find torn boi', 'images/vampirejpg.jpg', 3.4, 'realesed', 't', '2019-01-19 02:33:13', '2019-01-19 02:33:13'),
(69, 'earth', 'earth', 'adventur', 'smith', '2013', 'columbia pictur corpor', '2013', 'crash land leav kitai raig father cypher strand earth', 'images/afterjpg.jpg', 4.3, 'realesed', 't', '2019-01-19 04:55:40', '2019-01-19 04:55:40'),
(70, 'flash', 'flash', 'adventur', 'grant gustin', '2014', 'berlanti product', '2014', 'struck lightn barri allen wake coma discov s given power super speed', 'images/flashjpg.jpg', 7.9, 'realesed', 'y', '2019-01-19 04:57:45', '2019-01-19 04:57:45'),
(71, 'homecom', 'homecom', 'drama', 'micah bloomberg', '2010', 'amazon studio', '2010', 'good intent errat boss mount paranoia', 'images/homejpg.jpg', 7.6, 'realesed', 'y', '2019-01-19 04:59:32', '2019-01-19 04:59:32'),
(72, 'walk dead', 'walk-dead', 'horror', 'andrew lincoln', '2010', 'american movi classic', '2010', 'sheriff deputi rick grime wake coma learn world ruin', 'images/walkingjpg.jpg', 8.4, 'realesed', 'y', '2019-01-19 05:01:12', '2019-01-19 05:01:12'),
(73, 'roman empir', 'roman-empir', 'biographi', 'sean bean', '2018', 'stephen david entertain', '2018', 'chronicl reign commodu emperor rule mark begin rome s fall', 'images/romanjpg.jpg', 6.8, 'realesed', 'y', '2019-01-19 05:03:01', '2019-01-19 05:03:01'),
(74, 'mari poppin return', 'mari-poppin-return', 'biographi', 'emili blunt', '2018', 'lucamar product', '2018', 'decad origin visit magic nanni return help bank sibl', 'images/maryjpg.jpg', 7.2, 'realesed', 'y', '2019-01-19 05:04:57', '2019-01-19 05:04:57'),
(75, 'justic leagu', 'justic-leagu', 'fantasi', 'gal gadot', '2017', 'atla entertain', '2017', 'fuel restor faith human inspir superman s selfless act', 'images/justicejpg.jpg', 6.5, 'realesed', 'y', '2019-01-19 05:07:02', '2019-01-19 05:07:02'),
(76, 'welcom marwen', 'welcom-marwen', 'fantasi', 'steve carel', '2018', 'dreamwork', '2018', 'victim brutal attack find uniqu beauti therapeut outlet help recoveri process', 'images/marwenjpg.jpg', 5.9, 'realesed', 'y', '2019-01-19 05:08:30', '2019-01-19 05:08:30'),
(77, 'thor ragnarok', 'thor-ragnarok', 'action', 'chri hemsworth', '2017', 'marvel', '2017', 'thor imprison planet sakaar race time return asgard stop ragnar k', 'images/thorjpg.jpg', 7.9, 'realesed', 'y', '2019-01-19 05:09:55', '2019-01-19 05:09:55'),
(78, 'mummi', 'mummi', 'fantasi', 'brendan fraser', '1999', 'univers pictur', '1999', 'archaeolog dig ancient citi hamunaptra', 'images/mummyjpg.jpg', 7, 'realesed', 'y', '2019-01-19 05:11:26', '2019-01-19 05:11:26'),
(79, 'jumanji welcom jungl', 'jumanji-welcom-jungl', 'adventur', 'dwayn johnson', '2017', 'columbia pictur', '2017', 'teenag suck magic video game wai escap work finish game', 'images/jumanjijpg.jpg', 7, 'realesed', 'y', '2019-01-19 05:13:12', '2019-01-19 05:13:12'),
(80, 'star war', 'star-war', 'fantasi', 'daisi ridlei', '2017', 'walt disnei pictur', '2017', 'rei develop newli discov abil guidanc luke skywalk', 'images/starsjpg.jpg', 7.2, 'realesed', 'y', '2019-01-19 05:14:50', '2019-01-19 05:14:50'),
(81, 'hotti', 'hotti', 'comedi', 'pari hilton', '2008', 'purpl pictur', '2008', 'woman agre date man find suitor unattract best friend', 'images/hottiejpg.jpg', 2.2, 'realesed', 't', '2019-01-19 05:16:22', '2019-01-19 05:16:22'),
(82, 'justin kelli', 'justin-kelli', 'comedi', 'kelli clarkson', '2003', '19 entertain', '2003', 'waitress texa colleg student pennsylvania meet spring break fort lauderdal', 'images/justinjpg.jpg', 2.1, 'realesed', 't', '2019-01-19 05:17:58', '2019-01-19 05:17:58'),
(83, 'glitter', 'glitter', 'drama', 'mariah carei', '2001', 'twentieth centuri fox', '2001', 'young singer date disc jockei help music busi', 'images/glitterjpg.jpg', 2.2, 'realesed', 't', '2019-01-19 05:19:29', '2019-01-19 05:19:29'),
(84, 'slender man', 'slender-man', 'horror', 'joei king', '2018', 'mytholog entertain', '2018', 'small town massachusett group friend', 'images/slenderjpg.jpg', 3.2, 'realesed', 't', '2019-01-19 05:22:40', '2019-01-19 05:22:40'),
(85, 'love guru', 'love-guru', 'comedi', 'mike myer', '2008', 'paramount pictur', '2008', 'pitka american rais outsid countri guru', 'images/gurujpg.jpg', 3.8, 'realesed', 't', '2019-01-19 05:29:22', '2019-01-19 05:29:22'),
(86, 'swept awai', 'swept-awai', 'comedi', 'madonna', '2002', 'screen gem', '2002', 'snooti socialit strand mediterranean island communist sailor', 'images/sweptjpg.jpg', 2.2, 'realesed', 't', '2019-01-19 05:31:27', '2019-01-19 05:31:27'),
(87, 'robocop', 'robocop', 'action', 'robert john burk', '1993', 'orion pictur', '1993', 'robocop save dai', 'images/robocopjpg.jpg', 4, 'realesed', 't', '2019-01-19 05:33:16', '2019-01-19 05:33:16'),
(88, 'spirit awai', 'spirit-awai', 'anim', 'daveigh chase', '2001', 'tokuma shoten', '2001', 'famili s suburb sullen 10 year old girl wander world rule god witch', 'images/spritedjpg.jpg', 8.6, 'realesed', 'y', '2019-01-19 05:34:54', '2019-01-19 05:34:54'),
(89, 'coco', 'coco', 'anim', 'anthoni gonzalez', '2017', 'walt disnei pictur', '2017', 'aspir musician miguel confront famili s ancestr ban music', 'images/cocojpg.jpg', 8.4, 'realesed', 'y', '2019-01-19 05:36:13', '2019-01-19 05:36:13'),
(90, 'casablanca', 'casablanca', 'thriller', 'humphrei bogart', '1942', 'warner bro', '1942', 'cynic nightclub owner protect old flame husband nazi morocco', 'images/cassajpg.jpg', 8.5, 'realesed', 'y', '2019-01-19 05:38:09', '2019-01-19 05:38:09'),
(91, 'shaun dead', 'shaun-dead', 'horror', 'simon pegg', '2004', 'studiocan', '2004', 'man s unev life disrupt zombi apocalyps', 'images/shaunjpg.jpg', 7.9, 'realesed', 'y', '2019-01-19 05:40:42', '2019-01-19 05:40:42'),
(92, 'turk space', 'turk-space', 'action', 'c neyt arkin', '2006', 'tiglon', '2006', 'famili turk try adapt life new solar', 'images/turkjpg.jpg', 1.9, 'realesed', 't', '2019-01-19 05:43:03', '2019-01-19 05:43:03'),
(93, 'rollerbal', 'rollerbal', 'action', 'chri klein', '2002', 'atla entertain', '2002', 'big thing 2005 violent sport pretti consequ like dy', 'images/rollerjpg.jpg', 3, 'realesed', 't', '2019-01-19 05:44:43', '2019-01-19 05:44:43'),
(94, 'feardotcom', 'feardotcom', 'crime', 'stephen dorff', '2002', 'mdp worldwid', '2002', 'new york citi detect investig mysteri death occur', 'images/fearjpg.jpg', 3.3, 'realesed', 't', '2019-01-19 05:46:19', '2019-01-19 05:46:19'),
(95, 'furri vengeanc', 'furri-vengeanc', 'comedi', 'brendan fraser', '2010', 'summit entertain', '2010', 'oregon wilder real estat develop s new hous subdivis face uniqu group protestor', 'images/furyjpg.jpg', 3.8, 'realesed', 't', '2019-01-19 05:48:09', '2019-01-19 05:48:09'),
(96, 'nun', 'nun', 'horror', 'demi n bichir', '2018', 'atom monster', '2018', 'priest haunt past novic threshold final vow sent', 'images/nunjpg.jpg', 5.4, 'realesed', 'y', '2019-01-19 05:51:12', '2019-01-19 05:51:12'),
(97, 'overlord', 'overlord', 'horror', 'jovan adepo', '2018', 'bad robot', '2018', 'small group american soldier horror enemi line ev d dai', 'images/outjpg.jpg', 7.1, 'realesed', 'y', '2019-01-19 05:53:40', '2019-01-19 05:53:40'),
(98, 'zombieland', 'zombieland', 'adventur', 'jess eisenberg', '2009', 'columbia pictur', '2009', 'shy student try reach famili ohio gun tote tough gui try twinki', 'images/zombijpg.jpg', 7.7, 'realesed', 'y', '2019-01-19 05:55:18', '2019-01-19 05:55:18'),
(100, 'skylin', 'skylin', 'adventur', 'frank grillo', '2018', 'mothership', '2018', 'tough nail detect embark relentless pursuit free son nightmarish alien warship', 'images/beyonjpg.jpg', 5.3, 'realesed', 'y', '2019-01-19 05:57:32', '2019-01-19 05:57:32'),
(101, 'anaconda', 'anaconda', 'adventur', 'jon voight', '1997', 'cinema line film corpor', '1997', 'nation geograph film crew taken hostag insan hunter', 'images/anacondajpg.jpg', 4.7, 'realesed', 't', '2019-01-19 05:59:11', '2019-01-19 05:59:11'),
(102, 'attack titan', 'attack-titan', 'anim', 'marina inou', '2013', 'wit studio', '2013', 'hometown destroi mother kill', 'images/titanjpg.jpg', 8.8, 'realesed', 'y', '2019-01-19 06:00:45', '2019-01-19 06:00:45'),
(103, 'witch', 'witch', 'comedi', 'anjelica huston', '1990', 'lorimar film entertain', '1990', 'young boi stumbl witch convent stop turn mous', 'images/witchesjpg.jpg', 6.8, 'realesed', 'y', '2019-01-19 06:02:54', '2019-01-19 06:02:54'),
(104, 'turbo kid', 'turbo-kid', 'comedi', 'munro chamber', '2015', 'ema film', '2015', 'post apocalypt wasteland 1997 comic book fan adopt persona', 'images/turbojpg.jpg', 4.7, 'realesed', 't', '2019-01-19 06:04:15', '2019-01-19 06:04:15'),
(105, 'aviat', 'aviat', 'biographi', 'leonardo dicaprio', '2004', 'forward pass', '2004', 'biopic depict earli year legendari director aviat howard hugh career late 1920 mid 1940', 'images/aviatorjpg.jpg', 7.5, 'realesed', 'y', '2019-01-19 06:06:01', '2019-01-19 06:06:01'),
(106, 'final wish', 'final-wish', 'horror', 'lin shay', '2019', 'bondit', '2019', 'death father aaron return home help grief stricken mother confront past', 'images/finaljpg.jpg', 7.1, 'coming soon', 'y', '2019-01-19 06:07:44', '2019-01-19 06:07:44'),
(107, 'hellboi', 'hellboi', 'action', 'milla jovovich', '2019', 'nu boyana fx', '2019', 'base graphic novel mike mignola hellboi caught world supernatur human', 'images/hellboyjpg.jpg', 4.6, 'coming soon', 't', '2019-01-19 06:11:05', '2019-01-19 06:11:05'),
(108, 'swade', 'swade', 'drama', 'shah rukh khan', '2004', 'ashutosh gowarik product', '2004', 'success indian scientist return indian villag nanni america process rediscov root', 'images/swadesjpg.jpg', 8.3, 'realesed', 'y', '2019-01-19 06:13:08', '2019-01-19 06:13:08'),
(109, 'bandit', 'bandit', 'crime', 'sener sen', '1996', 'artcam intern', '1996', 'baran bandit releas prison 35 year search vengeanc lover', 'images/banditjpg.jpg', 8.3, 'realesed', 'y', '2019-01-19 06:14:33', '2019-01-19 06:14:33'),
(110, 'monster', 'monster', 'anim', 'billi crystal', '2001', 'pixar anim studio', '2001', 'order power citi monster scare children scream children toxic monster', 'images/incjpg.jpg', 8.1, 'realesed', 'y', '2019-01-19 06:16:18', '2019-01-19 06:16:18'),
(111, 'song sea', 'song-sea', 'anim', 'ami poehler', '2014', 'walt disnei pictur', '2014', 'ben young irish boi littl sister saoirs', 'images/songseajpg.jpg', 4.6, 'realesed', 't', '2019-01-19 06:18:54', '2019-01-19 06:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `film_craws`
--

CREATE TABLE `film_craws` (
  `id` int(11) NOT NULL,
  `nama_film` varchar(50) NOT NULL,
  `genre_film` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `aktor_aktris` varchar(100) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `nama_genre` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nama_genre`, `created_at`, `updated_at`) VALUES
(1, 'action', '2018-12-23 08:08:38', '0000-00-00 00:00:00'),
(2, 'drama', '2018-12-23 08:08:38', '0000-00-00 00:00:00'),
(3, 'adventure', '2019-01-19 08:45:55', '0000-00-00 00:00:00'),
(4, 'comedy', '2019-01-19 08:46:00', '0000-00-00 00:00:00'),
(5, 'horror', '2018-12-23 08:08:38', '0000-00-00 00:00:00'),
(6, 'thriller', '2019-01-19 08:44:25', '2018-12-23 01:09:02'),
(7, 'crime', '2019-01-13 08:50:00', '2019-01-13 08:50:00'),
(8, 'fantasy', '2019-01-19 01:45:28', '2019-01-19 01:45:28'),
(9, 'animation', '2019-01-19 01:46:25', '2019-01-19 01:46:25'),
(10, 'biography', '2019-01-19 01:51:12', '2019-01-19 01:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_selected`
--

CREATE TABLE `kelas_selected` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `k_optimals`
--

CREATE TABLE `k_optimals` (
  `id` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `accuracy_k` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(46, '2018_11_10_092918_create_films_table', 1),
(47, '2018_11_25_084514_create_admin_table', 1),
(48, '2018_11_30_230305_create_users_table', 1),
(49, '2018_12_01_172149_terms', 1),
(50, '2018_12_01_172314_tf_idfs', 1),
(51, '2018_12_01_172335_cosines', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `df` int(11) NOT NULL,
  `idf` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tf_idfs`
--

CREATE TABLE `tf_idfs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_term` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tf` int(11) NOT NULL,
  `tf_idf` double NOT NULL,
  `tf_idf_kuadrat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_film_liked` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_film_liked` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktor_aktris_liked` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `password`, `lastname`, `nama_film_liked`, `genre_film_liked`, `aktor_aktris_liked`, `remember_token`, `created_at`, `updated_at`) VALUES
(20, 'anangnov99@gmail.com', 'anang', '$2y$10$4Dct6LrTxcV7Aopi4QqCSOKs/F7FLmvOsiJm2d.KdD6wsPfpQqJIy', 'novriadi', 'robin hood avatar', 'drama action', 'julia robert', NULL, '2019-01-11 00:48:24', '2019-01-11 00:48:24'),
(30, 'M.khoiron08@gmail.com', 'Moehammad', '$2y$10$DP2tLZrZmAzVjLtc4c99Qe80klhM60BUuNGMuZRH16q9gRAPoOKnu', 'khoyron', 'venom', 'fantasy', 'tom hardi', NULL, '2019-01-13 17:15:38', '2019-01-13 17:15:38'),
(31, 'siskanggraeni@gmail.com', 'Siska', '$2y$10$U2CaWKmxxVCW7pJ0deRfael8DGfNZ11oOuqK4vgVU6K1FYF397V/y', 'Anggraeni', 'war world', 'action adventur comedi', 'tom cruis', NULL, '2019-01-13 17:21:45', '2019-01-13 17:21:45'),
(32, 'mhfawwazr@gmail.com', 'Fawwaz', '$2y$10$3yCwJUVwmL7ZIU8wi34JDeM3P6k4a6Tzx3TeJ3apN.RhItyIxCdv2', 'Hilmy', 'fast furiou franchis', 'action comedi horror', 'jacki chan', NULL, '2019-01-13 17:31:09', '2019-01-13 17:31:09'),
(33, 'Kanzulaufa3@gmail.com', 'Kanzul', '$2y$10$fR7qj2D/dq0lgORdYTtnB.c.ZoIXDpmsY747ExgyJEtwPEwp14esy', 'Aufa', 'jurass world imit game', 'adventur comedi', 'benedict cumberb', NULL, '2019-01-13 17:37:03', '2019-01-13 17:37:03'),
(34, 'Andreyuldian7@gmail.com', 'Andre', '$2y$10$QHlBqnWpGxoVxvqTj5jpPOnWQYvwAzDWaE/GV6SN88JW/g9ETOqAK', 'yuldian afandi', 'tranform', 'action adventur comedi horror fantasi', 'leonardo de caprio', NULL, '2019-01-13 17:42:08', '2019-01-13 17:42:08'),
(35, 'Distaadi4@gmail.com', 'Dista', '$2y$10$Oct3hhYqBuV.s./RH57mwOwOhvjC4scRHHqC2NLXePaqJL5pg7c7e', 'Adi Taruna Wijanarko Putra', 'aveng', 'action adventur comedi fantasi', 'scarlett johanson', NULL, '2019-01-13 17:47:24', '2019-01-13 17:47:24'),
(36, 'mochammad.hafidu@gmail.com', 'Mochammad', '$2y$10$xepvVUUZZ0.wpysaRxYEGunazf4SA0Akm5IZxXhGRNlmxU4cPlEkm', 'Hafidu', 'deadpool', 'action adventur', 'leonardo di caprio', NULL, '2019-01-13 17:52:53', '2019-01-13 17:52:53'),
(37, 'bimantaramanlukman@gmail.com', 'Lukman', '$2y$10$lR4ZaIduw/Y9ekfNSARgV./ySCEIUe3tbzJ7vdVbvXwMliHBGoXqe', 'Bimantara', 'wolf wolf street', 'action adventur comedi', 'johni deep', NULL, '2019-01-13 17:57:51', '2019-01-13 17:57:51'),
(38, 'abdullah.smeer15@gmail.com', 'abdullah', '$2y$10$GUDbGanSGzPuYYUe73p6SeWUY0QSPByNgTYVFFQrHbTcAuu7e/RcS', 'smeer', 'fast furiou', 'horror', 'hardwel', NULL, '2019-01-13 18:03:50', '2019-01-13 18:03:50'),
(39, 'dyahratnak30@gmail.com', 'Dyah', '$2y$10$KquVikt.8DsF4QD1zUhGH.y7pbwTJQTe.CUj//NmaF0L3dDLH0EoG', 'Ratna', 'twilight', 'action drama', 'pier brosnan julia robert will smith jason statem', NULL, '2019-01-13 18:08:37', '2019-01-13 18:08:37'),
(40, 'Fatma_wati31@ymail.com', 'Fatma', '$2y$10$BnkQ.NYLQFRsBV/z1Oh1kuqW.5HTrSIDGQrVHX4GvP6m7G5kix1hC', 'wati', 'gost mask zorro fast furiou ada apa dengan cinta', 'drama', 'dian sastrowardoyo mathia muchu nichola saputra', NULL, '2019-01-13 18:13:54', '2019-01-13 18:13:54'),
(41, 'Ghanapamela99@gmail.com', 'Ukke', '$2y$10$8NG3tcg0d55F0dJsoX8EleAnrKpyM8/PuUD.HkvRp6hv7ajLbrsAO', 'Theresia', 'london love stori 1 2 3 critic', 'drama', 'dima anggara', NULL, '2019-01-13 18:19:13', '2019-01-13 18:19:13'),
(42, 'ariesaprilia415@gmail.com', 'Aries', '$2y$10$Btg/NDLzsxRhKO83.J8iOuF31b0WIZ3hIobDkb6yA/XTIAkYxhWvG', 'Aprilia', 'harri potter train dragon', 'action drama adventur comedi fantasi anim', 'daniel radcliff emma watson', NULL, '2019-01-13 18:23:42', '2019-01-13 18:23:42'),
(43, 'cindynur@gmail.com', 'Cindy', '$2y$10$dQ4aSTOrbjXq/DKYzj8taOVGu64eSPoiQIrCqsmuCo/KovF2t2mTq', 'Nurlita', 'aveng toi stori', 'comedi anim', 'paul walker', NULL, '2019-01-13 18:30:04', '2019-01-13 18:30:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `c_products`
--
ALTER TABLE `c_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_products`
--
ALTER TABLE `d_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film_craws`
--
ALTER TABLE `film_craws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_selected`
--
ALTER TABLE `kelas_selected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_optimals`
--
ALTER TABLE `k_optimals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tf_idfs`
--
ALTER TABLE `tf_idfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `c_products`
--
ALTER TABLE `c_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_products`
--
ALTER TABLE `d_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `film_craws`
--
ALTER TABLE `film_craws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas_selected`
--
ALTER TABLE `kelas_selected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_optimals`
--
ALTER TABLE `k_optimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tf_idfs`
--
ALTER TABLE `tf_idfs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
