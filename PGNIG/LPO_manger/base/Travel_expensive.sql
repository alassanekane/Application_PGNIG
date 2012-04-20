-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 01 Avril 2012 à 14:27
-- Version du serveur: 5.1.61
-- Version de PHP: 5.3.3-7+squeeze8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `Travel_expensive`
--

-- --------------------------------------------------------

--
-- Structure de la table `ComptesUtilisateur`
--

CREATE TABLE IF NOT EXISTS `ComptesUtilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_utilisateur` tinyint(1) NOT NULL,
  `pays` varchar(10) NOT NULL,
  `datenaissance` date NOT NULL,
  `numero` int(20) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `ComptesUtilisateur`
--

INSERT INTO `ComptesUtilisateur` (`id_utilisateur`, `login`, `pass`, `prenom`, `nom`, `email`, `type_utilisateur`, `pays`, `datenaissance`, `numero`) VALUES
(1, 'admin', 'admin', 'Raphael', 'Bouvet', 'raphael.bouvet@gmail.com', 0, 'France', '0000-00-00', 0),
(2, 'manager', 'manager', 'Raphael', 'Bouvet', 'raphael.bouvet@gmail.com', 1, 'France', '1989-02-01', 456546),
(3, 'akane', 'kane', 'Alassane', 'KANE', 'alassane.kane@gamail.com', 2, 'Mali', '1901-01-23', 2147483647),
(4, 'bouba', 'kane', 'Boubacar', 'KANE', 'bouba.kane@gmail.com', 2, 'Mali', '2012-03-08', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `Currency`
--

CREATE TABLE IF NOT EXISTS `Currency` (
  `id_currency` int(4) NOT NULL DEFAULT '0',
  `ISO_Code` varchar(4) DEFAULT NULL,
  `currency` varchar(29) DEFAULT NULL,
  `EUR` double(21,16) DEFAULT NULL,
  `USD` double(40,19) DEFAULT NULL,
  PRIMARY KEY (`id_currency`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Currency`
--

INSERT INTO `Currency` (`id_currency`, `ISO_Code`, `currency`, `EUR`, `USD`) VALUES
(1, 'AED', 'UAE Dirham', 4.8388999999999998, 0.0001763256673749233),
(2, 'AFN', 'Afghan Afghani', 64.9800000000000040, 0.0023678195180769431),
(3, 'ALL', 'Albanian Lek', 138.9300000000000068, 0.0050624987018533345),
(4, 'AMD', 'Armenian Dram', 507.9100000000000250, 0.0185078364331557402),
(5, 'ANG', 'Netherlands Antillian Guilder', 2.3584999999999998, 0.0000859418641641193),
(6, 'AOA', 'Angolan Kwanza', 125.5541000000000054, 0.0045750915443918787),
(7, 'ARS', 'Argentine Peso', 5.7134000000000000, 0.0002081917518402709),
(8, 'AUD', 'Australian Dollar', 1.2365999999999999, 0.0000450607204686665),
(9, 'AWG', 'Aruban Guilder', 2.3584999999999998, 0.0000859418641641193),
(10, 'AZN', 'Azerbaijanian Manat', 1.0371999999999999, 0.0000377947430617021),
(11, 'BAM', 'Bosnia and Herzegovina Mark', 1.9558300000000000, 0.0000712688896281999),
(12, 'BBD', 'Barbados Dollar', 2.6352000000000002, 0.0000960245920904334),
(13, 'BDT', 'Bangladeshi Taka', 111.2319999999999993, 0.0040532056114917590),
(14, 'BGN', 'Bulgarian Lev', 1.9558000000000000, 0.0000712677964520604),
(15, 'BHD', 'Bahraini Dinar', 0.4954000000000000, 0.0000180519819829997),
(16, 'BIF', 'Burundi Franc', 1713.5399999999999636, 0.0624400347338498682),
(17, 'BMD', 'Bermudian Dollar', 1.3176000000000001, 0.0000480122960452167),
(18, 'BND', 'Brunei Dollar', 1.6487000000000001, 0.0000600773167044238),
(19, 'BOB', 'Bolivian Boliviano', 9.1045999999999996, 0.0003317643826451728),
(20, 'BRL', 'Brazilian Real', 2.2892999999999999, 0.0000834202712024245),
(21, 'BSD', 'Bahamian Dollar', 1.3176000000000001, 0.0000480122960452167),
(22, 'BTN', 'Bhutanese Ngultrum', 65.1359999999999957, 0.0023735040340021499),
(23, 'BWP', 'Botswana Pula', 9.6432000000000002, 0.0003513905382689993),
(24, 'BYR', 'Belarussian Ruble', 11010.0000000000000000, 0.4011956431829354353),
(25, 'BZD', 'Belize Dollar', 2.6352000000000002, 0.0000960245920904334),
(26, 'CAD', 'Canadian Dollar', 1.3133999999999999, 0.0000478592513856919),
(27, 'CDF', 'Congolese Franc', 1198.3900000000001000, 0.0436683784590370522),
(28, 'CHF', 'Swiss Franc', 1.2048000000000001, 0.0000439019537608357),
(29, 'CLP', 'Chilean Peso', 641.5500000000000682, 0.0233775717424170859),
(30, 'CNY', 'Chinese Yuan', 8.3120999999999992, 0.0003028863129610242),
(31, 'COP', 'Colombian Peso', 2391.5499999999997272, 0.0871461798777610486),
(32, 'CRC', 'Costa Rican Colon', 671.0499999999999545, 0.0244525282795557374),
(33, 'CUP', 'Cuban Peso', 1.3128000000000000, 0.0000478373878629026),
(34, 'CVE', 'Cape Verde Escudo', 110.2650000000000006, 0.0040179689005964015),
(35, 'CZK', 'Czech Koruna', 25.1879999999999988, 0.0009178306866931676),
(36, 'DJF', 'Djibouti Franc', 234.1649999999999920, 0.0085327863565787514),
(37, 'DKK', 'Danish Krone', 7.4345999999999997, 0.0002709109108817304),
(38, 'DOP', 'Dominican Peso', 51.2939999999999969, 0.0018691125632539041),
(39, 'DZD', 'Algerian Dinar', 104.5622999999999934, 0.0038101670482458706),
(40, 'EEK', 'Estonian Kroon', NULL, NULL),
(41, 'EGP', 'Egyptian Pound', 7.9504000000000001, 0.0002897062526395649),
(42, 'ERN', 'Eritrean Nakfa', 20.2580999999999989, 0.0007381890516952065),
(43, 'ETB', 'Ethiopian Birr', 22.7657999999999987, 0.0008295676451929218),
(44, 'EUR', 'Euro', 1.0000000000000000, 0.0000364392046487680),
(45, 'FJD', 'Fiji Dollar', 2.3212000000000002, 0.0000845826818307202),
(46, 'FKP', 'Falkland Islands Pound', 0.8351000000000000, 0.0000304303798021861),
(47, 'GBP', 'Pound Sterling', 0.8351000000000000, 0.0000304303798021861),
(48, 'GEL', 'Georgian Lari', 2.2027000000000001, 0.0000802646360798412),
(49, 'GHS', 'Ghanaian Cedi', 2.1608999999999998, 0.0000787414773255227),
(50, 'GIP', 'Gibraltar Pound', 0.8351000000000000, 0.0000304303798021861),
(51, 'GMD', 'Gambian Dalasi', 39.3962000000000003, 0.0014355661941837928),
(52, 'GNF', 'Guinea Franc', 9080.1200000000008004, 0.3308723509153709830),
(53, 'GTQ', 'Guatemalan Quetzal', 10.2546999999999997, 0.0003736731119117208),
(54, 'GYD', 'Guyana Dollar', 268.7200000000000273, 0.0097919430732169299),
(55, 'HKD', 'Hong Kong Dollar', 10.2194000000000003, 0.0003723868079876194),
(56, 'HNL', 'Honduran Lempira', 25.1970999999999989, 0.0009181622834554714),
(57, 'HRK', 'Croatian Kuna', 7.5780000000000003, 0.0002761362928283637),
(58, 'HTG', 'Haitian Gourde', 54.7122999999999990, 0.0019936726965047880),
(59, 'HUF', 'Hungarian Forint', 293.9100000000000250, 0.0107098466383194011),
(60, 'IDR', 'Indonesian Rupiah', 11835.5599999999994907, 0.4312783929727722620),
(61, 'ILS', 'Israeli Shekel', 4.9161000000000001, 0.0001791387739738082),
(62, 'INR', 'Indian Rupee', 65.1359999999999957, 0.0023735040340021499),
(63, 'IQD', 'Iraqi Dinar', 1535.0000000000000000, 0.0559341791358588317),
(64, 'IRR', 'Iranian Rial', 16174.0000000000000000, 0.5893676959891732681),
(65, 'ISK', 'Iceland Krona', 290.0000000000000000, 0.0105673693481427109),
(66, 'JMD', 'Jamaican Dollar', 114.1264000000000038, 0.0041586752454271531),
(67, 'JOD', 'Jordanian Dinar', 0.9338000000000000, 0.0000340269293010195),
(68, 'JPY', 'Japanese Yen', 100.6299999999999955, 0.0036668771638055206),
(69, 'KES', 'Kenyan Shilling', 111.6123000000000047, 0.0040670634410196853),
(70, 'KGS', 'Kyrgyzstani Som', 61.6317000000000021, 0.0022458101291514729),
(71, 'KHR', 'Cambodian Riel', 5354.7299999999995634, 0.1951221023088972883),
(72, 'KMF', 'Comoro Franc', 491.9677499999999668, 0.0179269135228439201),
(73, 'KPW', 'North Korean Won', 1185.8399999999999181, 0.0432110664406950076),
(74, 'KRW', 'South Korean Won', 1477.9900000000000091, 0.0538567800788325654),
(75, 'KWD', 'Kuwaiti Dinar', 0.3652000000000000, 0.0000133075975377301),
(76, 'KYD', 'Cayman Islands Dollar', 1.0911999999999999, 0.0000397624601127356),
(77, 'KZT', 'Kazakhstani Tenge', 195.9799999999999898, 0.0071413553270655468),
(78, 'LAK', 'Laos Lao Kip', 10539.4799999999995634, 0.3840502686115969677),
(79, 'LBP', 'Lebanese Pound', 1986.5799999999999272, 0.0723893951711494787),
(80, 'LKR', 'Sri Lanka Rupee', 150.1049999999999898, 0.0054697068138033159),
(81, 'LRD', 'Liberian Dollar', 96.8435999999999950, 0.0035289037593234261),
(82, 'LSL', 'Lesotho Loti', 10.2530000000000001, 0.0003736111652638180),
(83, 'LTL', 'Lithuanian Litas', 3.4527999999999999, 0.0001258172858112661),
(84, 'LVL', 'Latvian Lats', 0.6991000000000002, 0.0000254746479699537),
(85, 'LYD', 'Libyan Dinar', 1.6413000000000000, 0.0000598076665900229),
(86, 'MAD', 'Moroccan Dirham', 11.1334999999999997, 0.0004056958849570582),
(87, 'MDL', 'Moldovan Leu', 15.4673999999999996, 0.0005636197539843537),
(88, 'MGA', 'Malagasy Ariary', 2868.1799999999998363, 0.1045141979895033019),
(89, 'MKD', 'Macedonia Denar', 61.5071000000000012, 0.0022412698042522370),
(90, 'MMK', 'Myanmar Kyat', 8.0770999999999997, 0.0002943230998685638),
(91, 'MNT', 'Mongolian Tugrik', 1799.6499999999998636, 0.0655778146461552802),
(92, 'MOP', 'Macau Pataca', 10.5151000000000003, 0.0003831618808022600),
(93, 'MRO', 'Mauritania Ouguiya', 381.4399999999999977, 0.0138993702212260491),
(94, 'MUR', 'Mauritius Rupee', 38.5399999999999991, 0.0014043669471635180),
(95, 'MVR', 'Maldives Rufiyaa', 16.8700000000000010, 0.0006147293824247155),
(96, 'MWK', 'Malawian Kwacha', 220.0649999999999977, 0.0080189935710311237),
(97, 'MXN', 'Mexican Peso', 17.0233999999999988, 0.0006203191564178365),
(98, 'MYR', 'Malaysian Ringgit', 4.0128000000000004, 0.0001462232404145761),
(99, 'MZN', 'Mozambican Metical', 35.7070000000000007, 0.0013011346803935581),
(100, 'NAD', 'Namibia Dollar', 10.2530000000000001, 0.0003736111652638180),
(101, 'NGN', 'Nigerian Naira', 207.0200000000000102, 0.0075436441463879473),
(102, 'NIO', 'Nicaraguan Cordoba Oro', 30.3994000000000000, 0.0011077299577997568),
(103, 'NOK', 'Norwegian Krone', 7.6559999999999997, 0.0002789785507909676),
(104, 'NPR', 'Nepalese Rupee', 104.7390000000000043, 0.0038166058557073087),
(105, 'NZD', 'New Zealand Dollar', 1.5918000000000001, 0.0000580039259599089),
(106, 'OMR', 'Omani Rial', 0.5066000000000002, 0.0000184601010750659),
(107, 'PAB', 'Panamanian Balboa', 1.3176000000000001, 0.0000480122960452167),
(108, 'PEN', 'Peruvian Sol', 3.5442999999999998, 0.0001291514730366283),
(109, 'PGK', 'Papua New Guinea Kina', 2.7797000000000001, 0.0001012900571621803),
(110, 'PHP', 'Philippine Peso', 56.5060000000000002, 0.0020590336978832829),
(111, 'PKR', 'Pakistan Rupee', 119.2209000000000003, 0.0043443147735103011),
(112, 'PLN', 'Polish Zloty', 4.2243000000000004, 0.0001539301321977905),
(113, 'PYG', 'Paraguay Guarani', 6190.0699999999997090, 0.2255612275201991090),
(114, 'QAR', 'Qatari Rial', 4.7961000000000000, 0.0001747660694159561),
(115, 'RON', 'Romanian Leu', 4.3418000000000001, 0.0001582117387440208),
(116, 'RSD', 'Serbian Dinar', 105.7162000000000006, 0.0038522142464900841),
(117, 'RUB', 'Russian Ruble', 39.6899999999999977, 0.0014462720325096011),
(118, 'RWF', 'Rwanda Franc', 793.7809999999999491, 0.0289247483053036852),
(119, 'SAR', 'Saudi Riyal', 4.9413999999999998, 0.0001800606858514220),
(120, 'SBD', 'Solomon Islands Dollar', 9.2789000000000001, 0.0003381157360154530),
(121, 'SCR', 'Seychelles Rupee', 18.5999000000000017, 0.0006777655625466194),
(122, 'SDG', 'Sudanese Pound', 3.5270999999999999, 0.0001285247187166695),
(123, 'SEK', 'Swedish Krona', 8.8966999999999992, 0.0003241886719986940),
(124, 'SGD', 'Singapore Dollar', 1.6487000000000001, 0.0000600773167044238),
(125, 'SLL', 'Sierra Leonean Leone', 5751.4299999999993815, 0.2095775347930635968),
(126, 'SOS', 'Somali Shilling', 42031.4400000000023283, 1.5315922438424121044),
(127, 'SRD', 'Surinam Dollar', 4.3250000000000002, 0.0001575995601059215),
(128, 'STD', 'Sao Tome Dobra', 24500.0000000000000000, 0.8927605138948153662),
(129, 'SVC', 'El Salvador Colon', 11.5289999999999999, 0.0004201075903956459),
(130, 'SYP', 'Syrian Pound', 76.2759999999999962, 0.0027794367737894246),
(131, 'SZL', 'Swazi Lilangeni', 10.2530000000000001, 0.0003736111652638180),
(132, 'THB', 'Thai Baht', 40.7530000000000001, 0.0014850069070512408),
(133, 'TJS', 'Tajikistan Somoni', 6.2690000000000001, 0.0002284373739431264),
(134, 'TMT', 'Turkmenistan Manat', 3.7599999999999998, 0.0001370114094793676),
(135, 'TND', 'Tunisian Dinar', 1.9605000000000001, 0.0000714390607139096),
(136, 'TOP', 'Tongan Pa''Anga', 2.1608999999999998, 0.0000787414773255227),
(137, 'TRY', 'Turkish Lira', 2.3330000000000002, 0.0000850126644455757),
(138, 'TTD', 'Trinidad and Tobago Dollar', 8.3427000000000007, 0.0003040013526232766),
(139, 'TWD', 'Taiwan Dollar', 39.0270000000000010, 0.0014221128398274679),
(140, 'TZS', 'Tanzanian Shilling', 2078.2599999999997635, 0.0757301414533485262),
(141, 'UAH', 'Ukrainian Hryvnia', 10.5272299999999994, 0.0003836038883546496),
(142, 'UGX', 'Uganda Shilling', 3067.4300000000002910, 0.1117747095157703152),
(143, 'USD', 'US Dollar', 1.3176000000000001, 0.0000480122960452167),
(144, 'UYU', 'Uruguayan Peso', 25.8395000000000010, 0.0009415708285218400),
(145, 'UZS', 'Uzbekistan Sum', 2387.3099999999999454, 0.0869916776500502670),
(146, 'VEF', 'Venezuelan Bolivar Fuerte', 5.6193000000000000, 0.0002047628226828219),
(147, 'VND', 'Viet Nam Dong', 27442.9700000000011642, 1.0000000000000000000),
(148, 'VUV', 'Vanuatu Vatu', 119.4399999999999977, 0.0043522986032488459),
(149, 'WST', 'Samoa Tala', 2.9426999999999999, 0.0001072296475199295),
(150, 'XAF', 'CFA Franc BEAC', 655.9569999999999936, 0.0239025513637918900),
(151, 'XCD', 'East Caribbean Dollar', 3.5575000000000001, 0.0001296324705379921),
(152, 'XDR', 'Special Drawing Rights SDR', 0.8494699999999998, 0.0000309540111729889),
(153, 'XOF', 'CFA Franc BCEAO', 655.9569999999999936, 0.0239025513637918900),
(154, 'XPF', 'CFP Franc', 119.3316999999999979, 0.0043483522373853846),
(155, 'YER', 'Yemeni Rial', 282.6600000000000250, 0.0102999055860207613),
(156, 'ZAR', 'South African Rand', 10.2530000000000001, 0.0003736111652638180),
(157, 'ZMK', 'Zambian Kwacha', 6763.4400000000005093, 0.2464543742896632417),
(158, 'ZWL', 'Zimbabwe Dollar', 548.5199999999999818, 0.0199876325339422047);

-- --------------------------------------------------------

--
-- Structure de la table `Espreport`
--

CREATE TABLE IF NOT EXISTS `Espreport` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `datereport` date DEFAULT NULL,
  `commentaires` text,
  `Datedevalidation` date DEFAULT NULL,
  `Dateremboursement` date DEFAULT NULL,
  `typerambourssement` int(11) DEFAULT NULL,
  `num_mission` varchar(10) NOT NULL,
  `statue_report` tinyint(4) DEFAULT NULL,
  `justificatif` varchar(200) NOT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `Espreport`
--

INSERT INTO `Espreport` (`id_report`, `id_utilisateur`, `nom`, `datereport`, `commentaires`, `Datedevalidation`, `Dateremboursement`, `typerambourssement`, `num_mission`, `statue_report`, `justificatif`) VALUES
(76, 3, 'Test-2', '2012-03-30', 'hguoihoyug', '2012-03-30', '2012-03-30', NULL, 'Mission-Ca', 3, './reporte/justif/76'),
(77, 4, 'Test1', '2012-03-30', 'fhkghljm', '2012-03-30', '2012-04-01', NULL, 'Mission-Vo', 3, './reporte/justif/77'),
(78, 3, 'dskj', '2012-03-30', NULL, NULL, NULL, NULL, 'jkhqsjlcfm', 0, ''),
(79, 3, 'Mali', '2012-03-30', 'jcfxklvjsdopcklwx', '2012-03-30', '2012-03-30', NULL, 'CDFD-545', 3, './reporte/justif/79'),
(80, 3, 'TEST3', '2012-03-30', 'yudgsihjopvcxwuvicjocvx', '2012-03-30', '2012-03-30', NULL, 'TESt-455', 3, './reporte/justif/80'),
(81, 3, 'Notification', '2012-03-31', 'dcvxx', '2012-03-31', '2012-04-01', NULL, 'jqkhjlds', 3, './reporte/justif/81'),
(82, 3, 'test5', '2012-03-31', '', '2012-03-31', '2012-04-01', NULL, 'jkhdslcxw', 3, ''),
(83, 3, 'test6', '2012-03-31', '', '2012-03-31', '2012-04-01', NULL, 'Notificati', 3, ''),
(84, 3, 'Notijkdqs', '2012-04-01', 'fgljjkj', '2012-04-01', '2012-04-01', NULL, 'dssjd909', 3, './reporte/justif/84'),
(85, 3, 'dfgfgd', '2012-04-01', NULL, NULL, NULL, NULL, 'fdgsdff', 1, './reporte/justif/85');

-- --------------------------------------------------------

--
-- Structure de la table `Expenses`
--

CREATE TABLE IF NOT EXISTS `Expenses` (
  `id_expenses` int(11) NOT NULL AUTO_INCREMENT,
  `id_report` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `dateexpense` date NOT NULL,
  `typeexpense` int(11) NOT NULL,
  `amount` double NOT NULL,
  `statue_item` tinyint(4) NOT NULL,
  `typemonnaie` int(11) NOT NULL,
  `justificatif` varchar(100) NOT NULL,
  PRIMARY KEY (`id_expenses`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `Expenses`
--

INSERT INTO `Expenses` (`id_expenses`, `id_report`, `id_utilisateur`, `dateexpense`, `typeexpense`, `amount`, `statue_item`, `typemonnaie`, `justificatif`) VALUES
(44, 85, 3, '1970-02-09', 1, 134, 1, 1, ''),
(43, 85, 3, '1970-02-01', 3, 212, 1, 1, ''),
(41, 84, 3, '1970-02-17', 1, 788, 3, 1, ''),
(42, 84, 3, '1970-02-12', 4, 980, 2, 1, ''),
(40, 83, 3, '1970-02-05', 1, 124, 1, 1, ''),
(39, 82, 3, '1970-02-10', 1, 4, 1, 1, ''),
(38, 81, 3, '1970-02-05', 1, 4, 1, 1, ''),
(37, 80, 3, '1970-02-25', 6, 121, 3, 1, ''),
(36, 80, 3, '1970-02-11', 4, 131, 2, 13, ''),
(35, 80, 3, '1970-02-11', 4, 151, 1, 6, ''),
(34, 79, 3, '1970-02-05', 4, 1524, 3, 65, ''),
(33, 76, 3, '1970-02-12', 5, 12, 3, 11, ''),
(32, 76, 3, '1970-02-20', 5, 232, 2, 1, ''),
(30, 77, 4, '2012-03-25', 5, 124, 3, 1, ''),
(31, 76, 3, '2012-01-25', 2, 121, 1, 143, ''),
(29, 77, 4, '2009-09-23', 6, 124, 2, 121, '');

-- --------------------------------------------------------

--
-- Structure de la table `Exptype`
--

CREATE TABLE IF NOT EXISTS `Exptype` (
  `id_exptype` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_exptype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `Exptype`
--

INSERT INTO `Exptype` (`id_exptype`, `code`, `nom`) VALUES
(1, 'UTL', 'Achats presse - Press'),
(2, 'UB', 'Frais PTT - Post mail '),
(3, 'DD', 'Frais de Voyage - travel expenses'),
(4, 'DB', 'Frais de popote - Food and beverage'),
(5, 'LS', 'Equipement  Securite - safety equipments'),
(6, 'LS', 'Permis'),
(7, 'UA', 'Taxe Visa aéroport sur passeport - Visa'),
(8, 'UM', 'Vaccin and medicine');

-- --------------------------------------------------------

--
-- Structure de la table `Notification`
--

CREATE TABLE IF NOT EXISTS `Notification` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `statu` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_report` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `Notification`
--

INSERT INTO `Notification` (`id_notification`, `statu`, `message`, `id_report`, `id_utilisateur`) VALUES
(4, 1, '<p id="4">\r\n<strong>Le Report Expense: </strong> <span class="label label-info">test5</span></br>\r\n<strong>Etat: </strong> <span class="label label">Au caire</span> \r\n</p>', 82, 3),
(9, 1, '<p id="9"><strong>Le Report Expense: </strong> <span class="label label-info">Notijkdqs</span></br><strong>Etat: </strong> <span class="label label">Au caire</span></p></br>', 84, 3),
(8, 1, '<p id="8"><strong>Le Report Expense: </strong> <span class="label label-info">Notijkdqs</span></br><strong>Etat: </strong> <span class="label label">Non Traité</span></p></br>', 84, 2),
(7, 1, '<p id="7"><strong>Le Report Expense: </strong> <span class="label label-info">test6</span></br><strong>Etat: </strong> <span class="label label">Au caire</span></p></br>', 83, 3),
(10, 1, '<p id="10"><strong>Le Report Expense: </strong> <span class="label label-info">Notijkdqs</span></br><strong>Etat: </strong> <span class="label label">Livrer</span></p></br>', 84, 3),
(11, 0, '<p id="11"><strong>Le Report Expense: </strong> <span class="label label-info">Test1</span></br><strong>Etat: </strong> <span class="label label">Livrer</span></p></br>', 77, 4),
(12, 1, '<p id="12"><strong>Le Report Expense: </strong> <span class="label label-info">Notification</span></br><strong>Etat: </strong> <span class="label label">Livrer</span></p></br>', 81, 3),
(13, 1, '<p id="13"><strong>Le Report Expense: </strong> <span class="label label-info">test6</span></br><strong>Etat: </strong> <span class="label label">Livrer</span></p></br>', 83, 3),
(14, 1, '<p id="14"><strong>Le Report Expense: </strong> <span class="label label-info">test5</span></br><strong>Etat: </strong> <span class="label label">Livrer</span></p></br>', 82, 3),
(15, 0, '<p id="15"><strong>Le Report Expense: </strong> <span class="label label-info">dfgfgd</span></br><strong>Etat: </strong> <span class="label label">Non Traité</span></p></br>', 85, 2);

-- --------------------------------------------------------

--
-- Structure de la table `rembourssement`
--

CREATE TABLE IF NOT EXISTS `rembourssement` (
  `id_remb` int(11) NOT NULL AUTO_INCREMENT,
  `rembourssement` varchar(30) NOT NULL,
  PRIMARY KEY (`id_remb`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rembourssement`
--

INSERT INTO `rembourssement` (`id_remb`, `rembourssement`) VALUES
(1, 'Espece'),
(2, 'carte bleu');
