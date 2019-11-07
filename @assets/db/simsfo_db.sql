-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 04:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simsfo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbank`
--

CREATE TABLE `tblbank` (
  `bankid` int(11) NOT NULL,
  `bankname` varchar(150) NOT NULL,
  `code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbank`
--

INSERT INTO `tblbank` (`bankid`, `bankname`, `code`) VALUES
(1, 'Access Bank', '044'),
(2, 'Citibank', '023'),
(3, 'Diamond Bank', '063'),
(4, 'Dynamic Standard Bank', NULL),
(5, 'Ecobank Nigeria', '050'),
(6, 'Fidelity Bank Nigeria', '070'),
(7, 'First Bank of Nigeria', '011'),
(8, 'First City Monument Bank', '214'),
(9, 'Guaranty Trust Bank', '058'),
(10, 'Heritage Bank Plc', '030'),
(11, 'Jaiz Bank', '301'),
(12, 'Keystone Bank Limited', '082'),
(13, 'Providus Bank Plc', '101'),
(14, 'Polaris Bank', '076'),
(15, 'Stanbic IBTC Bank Nigeria Limited', '221'),
(16, 'Standard Chartered Bank', '068'),
(17, 'Sterling Bank', '232'),
(18, 'Suntrust Bank Nigeria Limited', '100'),
(19, 'Union Bank of Nigeria', '032'),
(20, 'United Bank for Africa', '033'),
(21, 'Unity Bank Plc', '215'),
(22, 'Wema Bank', '035'),
(23, 'Zenith Bank', '057');

-- --------------------------------------------------------

--
-- Table structure for table `tblbankaccount`
--

CREATE TABLE `tblbankaccount` (
  `bankaccountid` int(11) NOT NULL,
  `accountname` varchar(300) NOT NULL,
  `accountno` varchar(20) NOT NULL,
  `bankid` int(11) NOT NULL,
  `sortcode` varchar(20) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedby` int(11) NOT NULL,
  `datemodified` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbankaccount`
--

INSERT INTO `tblbankaccount` (`bankaccountid`, `accountname`, `accountno`, `bankid`, `sortcode`, `dateadded`, `addedby`, `datemodified`, `modifiedby`) VALUES
(1, 'Junior Peter', '3049351560', 2, '009988', '2019-10-08 02:32:02', 1, '2019-10-08 07:01:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontainer`
--

CREATE TABLE `tblcontainer` (
  `containerid` int(11) NOT NULL,
  `supplyorderid` int(11) NOT NULL,
  `description` text NOT NULL,
  `hasdeficit` enum('Yes','No') NOT NULL DEFAULT 'No',
  `deficitdesc` text DEFAULT NULL,
  `hasoutstanding` enum('Yes','No') NOT NULL DEFAULT 'No',
  `outstandingdesc` text DEFAULT NULL,
  `containerref` varchar(20) NOT NULL,
  `shippingdate` date DEFAULT NULL,
  `seaportarrivaldate` date DEFAULT NULL,
  `clearancedate` date DEFAULT NULL,
  `datemovedtowarehouse` date DEFAULT NULL,
  `costprice` float NOT NULL,
  `buyingprice` float DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontainer`
--

INSERT INTO `tblcontainer` (`containerid`, `supplyorderid`, `description`, `hasdeficit`, `deficitdesc`, `hasoutstanding`, `outstandingdesc`, `containerref`, `shippingdate`, `seaportarrivaldate`, `clearancedate`, `datemovedtowarehouse`, `costprice`, `buyingprice`, `datecreated`, `createdby`) VALUES
(1, 1, 'Some description added', 'No', 'none', 'No', 'none', 'CO009978', '2019-10-01', '2019-10-08', '2019-10-11', '2019-10-11', 300000, 500000, '2019-10-11 12:23:56', 1),
(2, 2, 'fyujygiu', 'No', 'none', 'No', 'none', 'CT76543', '2019-10-02', '2019-10-09', '2019-10-11', '2019-10-11', 89000, 5000000, '2019-10-11 12:57:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcountries`
--

CREATE TABLE `tblcountries` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcountries`
--

INSERT INTO `tblcountries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `customerid` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `contactaddress` text NOT NULL,
  `countryid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`customerid`, `fullname`, `phonenumber`, `email`, `contactaddress`, `countryid`, `createdby`, `datecreated`) VALUES
(1, 'Junor Peter', '07068875714', 'jp@gmail.com', 'no 32A somewhere someplace on earth', 156, 1, '2019-10-07 03:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `employeeid` int(11) NOT NULL,
  `staffid` varchar(30) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `emailaddress` varchar(300) DEFAULT NULL,
  `contactaddress` text NOT NULL,
  `password` varchar(300) NOT NULL,
  `photourl` text DEFAULT NULL,
  `dateemployed` date DEFAULT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`employeeid`, `staffid`, `fullname`, `phonenumber`, `emailaddress`, `contactaddress`, `password`, `photourl`, `dateemployed`, `datecreated`) VALUES
(1, 'SSF/S/1001', 'Junior Peter', '07068875714', 'jp@gmail.com', 'No. 00 Somewhere, Someplace on earth', '12345', NULL, '2019-10-01', '2019-10-06 23:57:12'),
(2, 'SSF/S/1002', 'Jerry Emmanuel', '07036061879', 'jerryemmanuel8@gmail.com', 'Index 0 Somewhere, Planet Earth Avenue', '12345', NULL, '2019-10-01', '2019-10-06 23:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblinternalexpense`
--

CREATE TABLE `tblinternalexpense` (
  `expenseid` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `approvedby` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `capturedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentmode`
--

CREATE TABLE `tblpaymentmode` (
  `id` int(11) NOT NULL,
  `paymentmode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaymentmode`
--

INSERT INTO `tblpaymentmode` (`id`, `paymentmode`) VALUES
(1, 'Cash'),
(2, 'Bank Deposit'),
(3, 'Mobile Transfer'),
(4, 'Point of Sales (POS)');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymenttype`
--

CREATE TABLE `tblpaymenttype` (
  `id` int(11) NOT NULL,
  `paymenttype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaymenttype`
--

INSERT INTO `tblpaymenttype` (`id`, `paymenttype`) VALUES
(1, 'Whole on Credit'),
(2, 'Part on Credit'),
(3, 'Direct Sales');

-- --------------------------------------------------------

--
-- Table structure for table `tblprivilege`
--

CREATE TABLE `tblprivilege` (
  `privilegeid` int(11) NOT NULL,
  `privilege` varchar(150) NOT NULL,
  `privcatid` int(11) NOT NULL COMMENT 'privilege category id',
  `path` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Keeps record of all privileges of the system';

--
-- Dumping data for table `tblprivilege`
--

INSERT INTO `tblprivilege` (`privilegeid`, `privilege`, `privcatid`, `path`) VALUES
(1, 'Add New Employee', 2, 'add-new-employee'),
(2, 'View Employee', 2, 'view-employee'),
(3, 'Add New Bank Account', 16, 'add-new-bank-account'),
(4, 'View Bank Account', 16, 'view-bank-account'),
(5, 'Add New Container', 4, 'add-new-container'),
(6, 'View Container', 4, 'view-container'),
(7, 'Add New Internal Expense', 5, 'add-new-internal-expense'),
(8, 'View Internal Expense', 5, 'view-internal-expense'),
(9, 'Add New Role Privilege', 15, 'add-new-role-privilege'),
(10, 'View Role Privilege', 15, 'View-role-privilege'),
(11, 'Add New Role', 14, 'add-new-role'),
(12, 'View Role', 14, 'view-role'),
(13, 'Pay Salary', 6, 'pay-salary'),
(14, 'View Salary', 6, 'view-salary'),
(15, 'Add New Sales', 7, 'add-new-sales'),
(16, 'View Sales', 7, 'view-sales'),
(17, 'Add New Stock', 8, 'add-new-stock'),
(18, 'View Stock', 8, 'view-stock'),
(19, 'Add New Supply Expense', 9, 'add-new-supply-expense'),
(20, 'View Supply Expense', 9, 'view-supply-expense'),
(21, 'Add New Supply Order', 10, 'add-new-supply-order'),
(22, 'View Supply Order', 10, 'view-supply-order'),
(23, 'Add New Supply Order Payment', 11, 'add-new-supply-order-payment'),
(24, 'View Supply Order Payment', 11, 'view-supply-order-payment'),
(25, 'Add New User', 3, 'add-new-user'),
(26, 'View User', 3, 'view-user'),
(27, 'Add New Customer', 1, 'add-new-customer'),
(28, 'View Customer', 1, 'view-customer'),
(29, 'Add New Supplier', 17, 'add-new-supplier'),
(30, 'View Supplier', 17, 'view-supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tblprivilegecategory`
--

CREATE TABLE `tblprivilegecategory` (
  `categoryid` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Keeps record of privileges category';

--
-- Dumping data for table `tblprivilegecategory`
--

INSERT INTO `tblprivilegecategory` (`categoryid`, `category`, `path`) VALUES
(1, 'Manage Customer', 'customer'),
(2, 'Manage Employee', 'employee'),
(3, 'Manage User', 'user'),
(4, 'Manage Container', 'container'),
(5, 'Manage Internal Expense', 'internal-expense'),
(6, 'Manage Salary', 'salary'),
(7, 'Manage Sales', 'sales'),
(8, 'Manage Stock', 'stock'),
(9, 'Manage Supply Expense', 'supply-expense'),
(10, 'Manage Supply Order', 'supply-order'),
(11, 'Manage Supply Order Payment', 'supply-order-payment'),
(12, 'Manage Privilege', 'privilege'),
(13, 'Manage Privilege Category', 'privilege-category'),
(14, 'Manage Role', 'roles'),
(15, 'Manage Role Privilege', 'role-privilege'),
(16, 'Manage Bank Account', 'bank-account'),
(17, 'Manage Supplier', 'supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `roleid` int(11) NOT NULL,
  `role` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Keeps record of all system roles';

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`roleid`, `role`) VALUES
(1, 'Admin'),
(2, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblroleprivilege`
--

CREATE TABLE `tblroleprivilege` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL COMMENT 'role id from tblrole',
  `privilegeid` int(11) NOT NULL COMMENT 'privilege id from tblprivilege'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Keeps track of privileges assigned to a role (Most preferred default privilege to a role)';

--
-- Dumping data for table `tblroleprivilege`
--

INSERT INTO `tblroleprivilege` (`id`, `roleid`, `privilegeid`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 5),
(5, 2, 7),
(6, 2, 11),
(7, 2, 9),
(8, 2, 15),
(9, 2, 17),
(10, 2, 19),
(11, 2, 21),
(12, 2, 23),
(13, 2, 25),
(14, 2, 13),
(15, 2, 4),
(16, 2, 6),
(17, 2, 8),
(18, 2, 12),
(19, 2, 10),
(20, 2, 14),
(21, 2, 16),
(22, 2, 18),
(23, 2, 20),
(24, 2, 22),
(25, 2, 24),
(26, 2, 26),
(27, 2, 27),
(28, 2, 28),
(29, 2, 29),
(30, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tblsales`
--

CREATE TABLE `tblsales` (
  `salesid` int(11) NOT NULL,
  `salesref` varchar(20) NOT NULL,
  `customerid` int(11) NOT NULL,
  `stockid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `salesdate` date NOT NULL,
  `typeofpayment` int(11) NOT NULL,
  `modeofpayment` int(11) NOT NULL,
  `receivedby` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsales`
--

INSERT INTO `tblsales` (`salesid`, `salesref`, `customerid`, `stockid`, `quantity`, `salesdate`, `typeofpayment`, `modeofpayment`, `receivedby`, `datecreated`) VALUES
(1, 'S12345', 1, 2, 120, '2019-10-11', 3, 1, 1, '2019-10-11 12:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblsalespayment`
--

CREATE TABLE `tblsalespayment` (
  `paymentid` int(11) NOT NULL,
  `paymentref` varchar(20) NOT NULL,
  `bankaccountid` int(11) NOT NULL,
  `salesid` int(11) NOT NULL,
  `amountpaid` float NOT NULL,
  `outstanding` float NOT NULL DEFAULT 0,
  `duedate` date DEFAULT NULL,
  `datepaid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE `tblstock` (
  `stockid` int(11) NOT NULL,
  `stockref` varchar(20) NOT NULL,
  `containerid` int(11) NOT NULL,
  `itemname` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `isdamaged` enum('Yes','No') NOT NULL DEFAULT 'No',
  `damagedesc` text DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedby` int(11) NOT NULL,
  `lastmodified` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `costprice` float NOT NULL,
  `sellingprice` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstock`
--

INSERT INTO `tblstock` (`stockid`, `stockref`, `containerid`, `itemname`, `description`, `quantity`, `isdamaged`, `damagedesc`, `dateadded`, `addedby`, `lastmodified`, `modifiedby`, `costprice`, `sellingprice`) VALUES
(1, 'ST00876', 1, 'Agbada', 'Yoruba deamons agbada', 500, 'Yes', 'some materials are worn out', '2019-10-11 12:32:43', 1, '2019-10-11 12:41:24', 1, 1000, 3000),
(2, 'ST00876', 1, 'Agbada', 'Yoruba deamons agbada', 500, 'Yes', 'some materials are worn out beyond repairs', '2019-10-11 12:41:24', 1, NULL, NULL, 1000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplierid` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `contactaddress` text NOT NULL,
  `countryid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplierid`, `fullname`, `phonenumber`, `email`, `contactaddress`, `countryid`, `createdby`, `datecreated`) VALUES
(2, 'Abubakar Shehu', '09076767676', 'as@shehu.com', 'somewhere kenya', 110, 1, '2019-10-11 12:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplierexpense`
--

CREATE TABLE `tblsupplierexpense` (
  `expenseid` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `orderid` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `capturedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplyorder`
--

CREATE TABLE `tblsupplyorder` (
  `orderid` int(11) NOT NULL,
  `orderno` varchar(20) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `dateordered` date NOT NULL,
  `capturedby` int(11) NOT NULL,
  `freightforwarderid` int(11) DEFAULT NULL,
  `typeofpayment` int(11) NOT NULL,
  `modeofpayment` int(11) NOT NULL,
  `totalcost` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplyorder`
--

INSERT INTO `tblsupplyorder` (`orderid`, `orderno`, `supplierid`, `dateordered`, `capturedby`, `freightforwarderid`, `typeofpayment`, `modeofpayment`, `totalcost`, `datecreated`) VALUES
(1, 'SO123EF', 2, '2019-10-11', 1, 1, 3, 1, 120000, '2019-10-11 12:12:01'),
(2, 'SO34576', 2, '2019-10-02', 1, 1, 3, 1, 450000, '2019-10-11 12:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplyorderpayment`
--

CREATE TABLE `tblsupplyorderpayment` (
  `paymentid` int(11) NOT NULL,
  `paymentref` varchar(20) NOT NULL,
  `orderid` int(11) NOT NULL,
  `amountpaid` float NOT NULL,
  `outstanding` float NOT NULL DEFAULT 0,
  `duedate` date DEFAULT NULL,
  `datepaid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `status` enum('Active','Disabled') NOT NULL DEFAULT 'Active',
  `assignedby` int(11) NOT NULL,
  `dateassigned` datetime NOT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `employeeid`, `roleid`, `status`, `assignedby`, `dateassigned`, `modifiedby`, `datemodified`) VALUES
(1, 1, 2, 'Active', 1, '2019-10-07 00:03:12', NULL, NULL),
(2, 2, 2, 'Active', 1, '2019-10-07 00:03:12', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbank`
--
ALTER TABLE `tblbank`
  ADD PRIMARY KEY (`bankid`);

--
-- Indexes for table `tblbankaccount`
--
ALTER TABLE `tblbankaccount`
  ADD PRIMARY KEY (`bankaccountid`);

--
-- Indexes for table `tblcontainer`
--
ALTER TABLE `tblcontainer`
  ADD PRIMARY KEY (`containerid`);

--
-- Indexes for table `tblcountries`
--
ALTER TABLE `tblcountries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`employeeid`);

--
-- Indexes for table `tblinternalexpense`
--
ALTER TABLE `tblinternalexpense`
  ADD PRIMARY KEY (`expenseid`);

--
-- Indexes for table `tblpaymentmode`
--
ALTER TABLE `tblpaymentmode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpaymenttype`
--
ALTER TABLE `tblpaymenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprivilege`
--
ALTER TABLE `tblprivilege`
  ADD PRIMARY KEY (`privilegeid`),
  ADD UNIQUE KEY `privilege` (`privilege`);

--
-- Indexes for table `tblprivilegecategory`
--
ALTER TABLE `tblprivilegecategory`
  ADD PRIMARY KEY (`categoryid`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`roleid`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `tblroleprivilege`
--
ALTER TABLE `tblroleprivilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsales`
--
ALTER TABLE `tblsales`
  ADD PRIMARY KEY (`salesid`);

--
-- Indexes for table `tblsalespayment`
--
ALTER TABLE `tblsalespayment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `tblstock`
--
ALTER TABLE `tblstock`
  ADD PRIMARY KEY (`stockid`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`supplierid`);

--
-- Indexes for table `tblsupplierexpense`
--
ALTER TABLE `tblsupplierexpense`
  ADD PRIMARY KEY (`expenseid`);

--
-- Indexes for table `tblsupplyorder`
--
ALTER TABLE `tblsupplyorder`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tblsupplyorderpayment`
--
ALTER TABLE `tblsupplyorderpayment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbank`
--
ALTER TABLE `tblbank`
  MODIFY `bankid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblbankaccount`
--
ALTER TABLE `tblbankaccount`
  MODIFY `bankaccountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcontainer`
--
ALTER TABLE `tblcontainer`
  MODIFY `containerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcountries`
--
ALTER TABLE `tblcountries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `employeeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblinternalexpense`
--
ALTER TABLE `tblinternalexpense`
  MODIFY `expenseid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpaymentmode`
--
ALTER TABLE `tblpaymentmode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpaymenttype`
--
ALTER TABLE `tblpaymenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblprivilege`
--
ALTER TABLE `tblprivilege`
  MODIFY `privilegeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblprivilegecategory`
--
ALTER TABLE `tblprivilegecategory`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblroleprivilege`
--
ALTER TABLE `tblroleprivilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblsales`
--
ALTER TABLE `tblsales`
  MODIFY `salesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsalespayment`
--
ALTER TABLE `tblsalespayment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstock`
--
ALTER TABLE `tblstock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsupplierexpense`
--
ALTER TABLE `tblsupplierexpense`
  MODIFY `expenseid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsupplyorder`
--
ALTER TABLE `tblsupplyorder`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsupplyorderpayment`
--
ALTER TABLE `tblsupplyorderpayment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
