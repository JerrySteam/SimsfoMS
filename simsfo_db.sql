-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 05:11 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Junior Peter', '3049351560', 2, '009988', '2019-10-08 02:32:02', 1, NULL, NULL),
(2, 'Simsfo Marketing Limited', '0009956432', 1, '9977896', '2019-11-05 04:57:08', 1, NULL, NULL),
(3, 'Simsfo Marketing Limited Nig', '0024569811', 4, '8855211', '2019-11-06 10:48:58', 2, '2019-11-06 10:49:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontainer`
--

CREATE TABLE `tblcontainer` (
  `containerid` int(11) NOT NULL,
  `supplyorderid` int(11) NOT NULL,
  `description` text NOT NULL,
  `hasdeficit` enum('Yes','No') NOT NULL DEFAULT 'No',
  `deficitdesc` text,
  `hasoutstanding` enum('Yes','No') NOT NULL DEFAULT 'No',
  `outstandingdesc` text,
  `containerref` varchar(20) NOT NULL,
  `shippingdate` date DEFAULT NULL,
  `seaportarrivaldate` date DEFAULT NULL,
  `clearancedate` date DEFAULT NULL,
  `datemovedtowarehouse` date DEFAULT NULL,
  `buyingprice` float DEFAULT NULL,
  `expenses` float NOT NULL,
  `datecreated` datetime NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontainer`
--

INSERT INTO `tblcontainer` (`containerid`, `supplyorderid`, `description`, `hasdeficit`, `deficitdesc`, `hasoutstanding`, `outstandingdesc`, `containerref`, `shippingdate`, `seaportarrivaldate`, `clearancedate`, `datemovedtowarehouse`, `buyingprice`, `expenses`, `datecreated`, `createdby`, `status`) VALUES
(1, 6, 'Some description added', 'No', 'none', 'No', 'none', 'CO009978', '2019-10-01', '2019-10-08', '2019-10-11', '2019-10-11', 500000, 8300, '2019-10-11 12:23:56', 1, '1'),
(3, 7, 'The container has 40 different stock items', 'No', 'No deficit', 'No', 'No outstanding', 'CONT1234', '2019-10-08', '2019-10-16', '2019-10-17', '2019-10-17', 120000, 7850, '2019-10-23 03:21:02', 2, '0'),
(4, 8, 'Container from Germany', 'No', 'No deficit', 'No', 'No outstanding', 'SPL 123', '2019-10-22', '2019-10-23', '2019-10-23', '2019-10-23', 1500000, 36580, '2019-10-23 04:17:43', 2, '1'),
(5, 7, 'The container contains several products', 'No', 'No deficit', 'No', 'No outstanding', 'XYZ/GRM/345', '2019-10-23', '2019-10-24', '2019-10-25', '2019-10-25', 56000, 1500, '2019-10-25 08:25:21', 2, '0'),
(6, 9, 'This container has about 40 different items', 'No', 'No deficit', 'No', 'No outstanding', 'TMEU005', '2019-10-23', '2019-10-25', '2019-10-26', '2019-10-26', 1000000, 490000, '2019-10-26 11:18:08', 2, '0'),
(8, 6, 'The container has 35 stocks', 'No', 'No deficit', 'No', 'No outstanding', 'ABC123', '2019-11-06', '2019-11-01', '2019-11-02', '2019-11-05', 62000, 1350, '2019-11-06 01:28:05', 2, '1');

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
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225),
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
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856),
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
-- Table structure for table `tblcurrency`
--

CREATE TABLE `tblcurrency` (
  `currencyid` int(11) NOT NULL,
  `currencyname` varchar(128) NOT NULL,
  `accronym` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`currencyid`, `currencyname`, `accronym`) VALUES
(1, 'U.S. Dollar', 'USD'),
(2, 'European Euro', 'EUR'),
(3, 'Nigerian Naira', 'NGN');

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
(1, 'Junor Peter', '07068875714', 'jp@gmail.com', 'no 32A somewhere someplace on earth', 156, 1, '2019-10-07 03:16:35'),
(2, 'Jerry Emmanuel', '07036061879', 'firstclasslala@gmail.com', 'Some where in shika, zaria, kaduna, nigeria', 156, 1, '2019-11-05 05:03:23'),
(4, 'Shuaibu Abubakar', '07045343423', 'sabub@gmail.com', 'Samaru Zaria', 156, 2, '2019-11-06 12:19:28');

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
  `photourl` text,
  `dateemployed` date DEFAULT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`employeeid`, `staffid`, `fullname`, `phonenumber`, `emailaddress`, `contactaddress`, `password`, `photourl`, `dateemployed`, `datecreated`) VALUES
(1, 'SSF/S/1001', 'Junior Peter', '07068875714', 'jp@gmail.com', 'No. 00 Somewhere, Someplace on earth', '12345', NULL, '2019-10-01', '2019-10-06 23:57:12'),
(2, 'SSF/S/1002', 'Jerry Emmanuel', '07036061879', 'jerry@gmail.com', 'Index 0 Somewhere, Planet Earth Avenue', '12345', NULL, '2019-10-01', '2019-10-06 23:58:19'),
(3, 'SSF/S/1003', 'Stanley Alu', '08099990912', '', 'Somewhere in APO, abuja, Nigeria', '12345', NULL, '2019-11-01', '2019-11-05 05:04:30'),
(6, 'SSF/S/1004', 'Foki Eric', '07034567890', 'fokieric@simsfo.com', 'Aba Market, Abia State Nigeria', '12345', NULL, '0000-00-00', '2019-11-06 02:42:06');

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

--
-- Dumping data for table `tblinternalexpense`
--

INSERT INTO `tblinternalexpense` (`expenseid`, `description`, `amount`, `approvedby`, `datecreated`, `capturedby`) VALUES
(1, 'Transportation fare to the bank for deposit', 230, 1, '2019-11-03 11:20:39', 2),
(2, 'Money given to Emeka', 5200, 1, '2019-11-03 11:20:39', 2),
(3, 'Printer repair', 3500, 1, '2019-11-03 11:22:47', 2),
(6, 'Something here', 1850, 2, '2019-11-06 11:22:20', 2),
(7, 'Emeka transport to bank', 450, 2, '2019-11-06 11:22:20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblmonth`
--

CREATE TABLE `tblmonth` (
  `id` int(11) NOT NULL,
  `month` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmonth`
--

INSERT INTO `tblmonth` (`id`, `month`) VALUES
(4, 'April'),
(8, 'August'),
(12, 'December'),
(2, 'February'),
(1, 'January'),
(7, 'July'),
(6, 'June'),
(3, 'March'),
(5, 'May'),
(11, 'November'),
(10, 'October'),
(9, 'September');

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
(4, 'Point of Sales (POS)'),
(5, 'Bank Transfer');

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
(3, 'Direct Sales'),
(4, 'Full Payment');

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
(12, 'View Role', 14, 'view-roles'),
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
(30, 'View Supplier', 17, 'view-supplier'),
(33, 'Daily Sales', 18, 'daily-sales'),
(34, 'Add New Sales Payment', 19, 'add-new-sales-payment'),
(35, 'View Sales Payment', 19, 'view-sales-payment'),
(36, 'Add Supplier Stock List', 17, 'add-supplier-stock-list'),
(37, 'View Supplier Stock List', 17, 'view-supplier-stock-list');

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
(17, 'Manage Supplier', 'supplier'),
(18, 'Report', 'report'),
(19, 'Manage Sales Payment', 'sales-payment');

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `roleid` int(11) NOT NULL,
  `role` varchar(150) NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addedby` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Keeps record of all system roles';

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`roleid`, `role`, `dateadded`, `addedby`) VALUES
(1, 'Admin', '2019-11-04 12:11:19', 1),
(2, 'Super Admin', '2019-11-04 12:11:19', 1),
(3, 'Cashier', '2019-11-04 12:51:57', 1),
(4, 'WAREHOUSE ADMIN', '2019-11-06 11:36:33', 2);

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
(74, 2, 22),
(73, 2, 20),
(72, 2, 37),
(71, 2, 32),
(70, 2, 30),
(69, 2, 18),
(68, 2, 35),
(67, 2, 16),
(66, 2, 14),
(65, 2, 10),
(64, 2, 12),
(63, 2, 8),
(62, 2, 2),
(61, 2, 28),
(60, 2, 6),
(59, 2, 4),
(58, 2, 13),
(57, 2, 33),
(56, 2, 36),
(55, 2, 25),
(54, 2, 23),
(53, 2, 21),
(52, 2, 19),
(51, 2, 31),
(50, 2, 29),
(49, 2, 17),
(48, 2, 34),
(47, 2, 15),
(46, 2, 9),
(45, 2, 11),
(44, 2, 7),
(43, 2, 1),
(42, 2, 27),
(41, 2, 5),
(40, 2, 3),
(38, 3, 15),
(39, 3, 16),
(75, 2, 24),
(76, 2, 26),
(78, 4, 3),
(79, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblsalary`
--

CREATE TABLE `tblsalary` (
  `salaryid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `yearid` int(11) NOT NULL,
  `monthid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `salarytype` enum('Monthly','Advance') NOT NULL,
  `datepaid` datetime NOT NULL,
  `approvedby` int(11) NOT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsalary`
--

INSERT INTO `tblsalary` (`salaryid`, `employeeid`, `yearid`, `monthid`, `amount`, `salarytype`, `datepaid`, `approvedby`, `modifiedby`, `datemodified`) VALUES
(1, 1, 20, 9, 50000, 'Monthly', '2019-11-05 03:46:06', 1, 1, '2019-11-05 03:49:26'),
(2, 2, 20, 11, 10000, 'Advance', '2019-11-05 03:46:28', 1, NULL, NULL),
(3, 1, 20, 10, 50000, 'Monthly', '2019-11-05 03:49:26', 1, 1, '2019-11-05 03:49:41'),
(4, 2, 20, 10, 50000, 'Monthly', '2019-11-05 03:49:41', 1, NULL, NULL),
(5, 1, 20, 10, 70000, 'Monthly', '2019-11-06 12:06:12', 2, 2, '2019-11-06 12:10:31'),
(6, 1, 20, 10, 70500, 'Monthly', '2019-11-06 12:10:31', 2, NULL, NULL);

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
  `receivedby` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsales`
--

INSERT INTO `tblsales` (`salesid`, `salesref`, `customerid`, `stockid`, `quantity`, `salesdate`, `receivedby`, `datecreated`) VALUES
(2, 'SAL_15726989587612', 1, 1, 20, '2019-11-02', 1, '2019-11-02 01:49:55'),
(3, 'SAL_15726989587612', 1, 2, 50, '2019-11-02', 1, '2019-11-02 01:49:55'),
(4, 'SAL_15726989587612', 1, 3, 5, '2019-11-02', 1, '2019-11-02 01:49:55'),
(5, 'SAL_15727118177301', 1, 1, 5, '2019-11-02', 1, '2019-11-02 05:23:55'),
(6, 'SAL_15727118177301', 1, 2, 10, '2019-11-02', 1, '2019-11-02 05:23:55'),
(7, 'SAL_15727118559774', 1, 4, 5, '2019-11-01', 1, '2019-11-02 05:24:35'),
(8, 'SAL_15727118559774', 1, 5, 10, '2019-11-01', 1, '2019-11-02 05:24:35'),
(9, 'SAL_15727118842811', 1, 5, 30, '2019-10-28', 1, '2019-11-02 05:27:06'),
(10, 'SAL_15727124737935', 1, 4, 10, '2019-10-31', 1, '2019-11-02 05:35:05'),
(11, 'SAL_15727293476376', 1, 1, 2, '2019-10-28', 1, '2019-11-02 10:17:18'),
(12, 'SAL_15728442302543', 1, 7, 100, '2019-11-04', 1, '2019-11-04 06:10:47'),
(13, 'SAL_15728446697845', 1, 5, 30, '2019-11-04', 1, '2019-11-04 06:18:03'),
(14, 'SAL_1572863382985', 1, 2, 9, '2019-11-04', 1, '2019-11-04 11:30:15'),
(15, 'SAL_1572863382985', 1, 6, 10, '2019-11-04', 1, '2019-11-04 11:30:15'),
(16, 'SAL_15730393174275', 4, 3, 12, '2019-11-02', 2, '2019-11-06 12:22:51'),
(17, 'SAL_15730393174275', 4, 4, 20, '2019-11-02', 2, '2019-11-06 12:22:51'),
(18, 'SAL_15730393174275', 4, 5, 5, '2019-11-02', 2, '2019-11-06 12:22:51'),
(19, 'SAL_15730420356588', 4, 7, 8, '2019-11-05', 2, '2019-11-06 01:07:50');

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
  `outstanding` float NOT NULL DEFAULT '0',
  `duedate` date DEFAULT NULL,
  `datepaid` datetime NOT NULL,
  `typeofpayment` int(11) NOT NULL,
  `modeofpayment` int(11) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsalespayment`
--

INSERT INTO `tblsalespayment` (`paymentid`, `paymentref`, `bankaccountid`, `salesid`, `amountpaid`, `outstanding`, `duedate`, `datepaid`, `typeofpayment`, `modeofpayment`, `comment`) VALUES
(1, 'SPR_15727997547366', 1, 5, 12000, 380, '2019-11-05', '2019-11-03 10:35:00', 3, 1, NULL),
(2, 'SPR_15728187518770', 1, 5, 380, 0, '0000-00-00', '2019-11-03 11:17:33', 3, 1, NULL),
(5, 'SPR_15728471119376', 1, 7, 20000, 2500, '2019-11-08', '2019-11-04 07:28:35', 3, 3, NULL),
(6, 'SPR_15728494212404', 1, 7, 2500, 0, '0000-00-00', '2019-11-04 07:37:53', 3, 3, NULL),
(7, 'SPR_1572849521550', 1, 9, 60000, 0, '0000-00-00', '2019-11-04 07:39:36', 3, 2, NULL),
(8, 'SPR_15728634218378', 1, 14, 50000, 2142, '2019-11-08', '2019-11-04 11:31:01', 3, 1, NULL),
(9, 'SPR_15729260657140', 1, 14, 2142, 0, '0000-00-00', '2019-11-05 04:56:05', 3, 1, 'cleared'),
(10, 'SPR_15730420742291', 2, 19, 15200, 0, '2019-11-06', '2019-11-06 01:09:33', 4, 3, ''),
(11, 'SPR_15730422847708', 2, 16, 20000, 3000, '2019-11-07', '2019-11-06 01:12:53', 3, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE `tblstock` (
  `stockid` int(11) NOT NULL,
  `stockref` varchar(50) NOT NULL,
  `containerid` int(11) NOT NULL,
  `stockname` varchar(300) NOT NULL,
  `weight` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingprice` float(16,2) NOT NULL,
  `costprice` float(16,2) NOT NULL,
  `unitsellingprice` float(16,2) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedby` int(11) NOT NULL,
  `lastmodified` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isdamaged` enum('Yes','No') DEFAULT 'No',
  `damagedesc` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstock`
--

INSERT INTO `tblstock` (`stockid`, `stockref`, `containerid`, `stockname`, `weight`, `quantity`, `buyingprice`, `costprice`, `unitsellingprice`, `dateadded`, `addedby`, `lastmodified`, `modifiedby`, `isdamaged`, `damagedesc`, `description`) VALUES
(1, '136', 1, 'BOY T-SHIRT - A', 55, 23, 45000.00, 45747.00, 2000.00, '2019-10-31 01:26:01', 2, NULL, NULL, 'No', NULL, NULL),
(2, '142', 1, 'LADIES COTTON DRESS - A', 55, 67, 12000.00, 12199.20, 238.00, '2019-10-31 03:19:14', 2, NULL, NULL, 'No', NULL, NULL),
(3, '72', 4, 'LADY T-SHIRTS SHORT SLEEVE', 90, 67, 13200.00, 13521.20, 250.00, '2019-10-31 03:22:05', 2, NULL, NULL, 'No', NULL, NULL),
(4, '68', 4, 'LADY UNDERWEARS', 90, 90, 30000.00, 30730.00, 500.00, '2019-10-31 03:22:05', 2, NULL, NULL, 'No', NULL, NULL),
(5, '71', 4, 'LADY SILK SHIRTS', 90, 12, 23400.00, 23969.40, 2000.00, '2019-11-01 05:05:09', 2, NULL, NULL, 'No', NULL, NULL),
(6, '69', 4, 'LADY SILK DRESS', 90, 17, 76500.00, 78361.50, 5000.00, '2019-11-01 05:05:09', 2, NULL, NULL, 'No', NULL, NULL),
(7, '116', 4, 'ALD', 90, 25, 45900.00, 47016.90, 1900.00, '2019-11-01 05:05:09', 2, NULL, NULL, 'No', NULL, NULL),
(8, '140', 8, 'LADIES COTTON BLOUSES - A', 55, 55, 543700.00, 555538.62, 10500.00, '2019-11-06 01:29:12', 2, '2019-11-06 01:30:43', 2, 'No', NULL, NULL),
(11, '133', 8, 'CHILDREN SUMMER  MIX  - A', 55, 8, 12500.00, 12772.18, 1600.00, '2019-11-06 04:01:59', 2, '2019-11-06 04:03:52', 2, 'No', NULL, NULL),
(13, '130', 8, 'CHILDREN ANORAK - A', 55, 9, 34500.00, 35251.21, 4000.00, '2019-11-06 04:05:42', 2, NULL, NULL, 'No', NULL, NULL),
(14, '187', 8, 'COTTON UNDERWEAR - A', 55, 18, 46700.00, 47716.85, 2700.00, '2019-11-06 04:56:58', 2, NULL, NULL, 'No', NULL, NULL),
(15, '198', 8, 'LIGHT BLANKET - A', 55, 15, 42000.00, 42914.52, 2900.00, '2019-11-06 04:56:58', 2, NULL, NULL, 'No', NULL, NULL),
(16, '208', 8, 'BELTS', 25, 28, 89000.00, 90937.90, 3300.00, '2019-11-06 04:56:58', 2, NULL, NULL, 'No', NULL, NULL);

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
(1, 'ReSale GmbH', '07033445566', 'resale@gmail.com', 'NO 1, Yoruba street, Germany', 80, 2, '2019-10-31 01:14:08'),
(2, 'Peace and Love', '07011223344', 'peaceandlove@gmail.com', 'Opp USCT China', 44, 2, '2019-10-31 01:15:45'),
(3, 'Texval', '09088776655', 'textval@gmail.com', 'No 3, China university of Science and Technology, China.', 44, 2, '2019-10-31 01:17:41'),
(4, 'Expoquimica S. L.', '08193454034', 'expoquimica@gmail.com', 'Opp standford University', 226, 2, '2019-10-31 01:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplieraccount`
--

CREATE TABLE `tblsupplieraccount` (
  `supplieraccountid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `transactiontype` int(11) NOT NULL,
  `invoiceref` varchar(128) DEFAULT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `capturedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplieraccount`
--

INSERT INTO `tblsupplieraccount` (`supplieraccountid`, `supplierid`, `currency`, `amount`, `transactiontype`, `invoiceref`, `comment`, `datecreated`, `capturedby`) VALUES
(1, 1, '2', 250.00, 1, 'YTX0032', 'The money was paid by emeka', '2019-11-05 05:03:30', 2),
(2, 1, '2', 2450.00, 1, '', '', '2019-11-05 06:08:12', 2),
(3, 1, '2', 650.00, 1, 'GHYT0021', '', '2019-11-05 06:08:46', 2),
(4, 1, '2', 1500.00, 2, '', '', '2019-11-05 06:09:20', 2),
(5, 1, '2', 630.00, 2, '', '', '2019-11-05 06:10:23', 2),
(6, 1, '2', 230.00, 1, 'UIJGX563H', '', '2019-11-05 06:11:17', 2),
(7, 1, '2', 325.00, 2, 'JHKIY87', '', '2019-11-05 06:12:13', 2),
(8, 1, '2', 340.00, 2, 'uuygyg989', '', '2019-11-05 08:34:05', 2),
(9, 1, '2', 65.00, 1, '', '', '2019-11-05 08:35:28', 2),
(10, 3, '1', 3400.00, 1, '', '', '2019-11-06 08:43:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplierstocklist`
--

CREATE TABLE `tblsupplierstocklist` (
  `stockid` int(11) NOT NULL,
  `stockref` varchar(30) NOT NULL,
  `stockname` varchar(128) NOT NULL,
  `stockweight` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplierstocklist`
--

INSERT INTO `tblsupplierstocklist` (`stockid`, `stockref`, `stockname`, `stockweight`, `supplierid`) VALUES
(1, '2100543', 'COTTON CAPS (sack)', 25, 1),
(2, '2100631', 'BELTS  50Kg', 55, 1),
(3, '2101131', 'HATES/ SCAVES/GLOVES', 55, 1),
(4, '2101531', 'RAIN COAT', 55, 1),
(5, '2101731', 'SHORTS', 55, 1),
(6, '2101931', 'SOCKS', 55, 1),
(7, '2102131', 'POLO SYNTHETIC SHIRT', 55, 1),
(8, '2102231', 'T-SHIRT SH0RT SLEEVES (SS)', 55, 1),
(9, '2102343', 'HANDKERCHIEF  (sack)', 25, 1),
(10, '2102731', 'SPORT TRAINING', 55, 1),
(11, '2102831', 'COTON UNDERWEAR', 55, 1),
(12, '2103141', 'CAPS (sack)', 55, 1),
(13, '2103142', 'MIXED HATE (sack)', 50, 1),
(14, '2103631', 'T-SHIRT SLEEVELESS ', 55, 1),
(15, '2103931', 'T-SHIRT SLEEVELESS ', 55, 1),
(16, '2104431', 'WORKER UNIFORM', 55, 1),
(17, '2200131', 'BRA', 55, 1),
(18, '2200531', 'LADIES COTTON BLOUSE', 55, 1),
(19, '2200631', 'LADIES SILK SKIRTS', 55, 1),
(20, '2200731', 'LADIES COTTON SKIRTS', 55, 1),
(21, '2201034', 'LADIES JEANS', 55, 1),
(22, '2201133', 'LADIES SUMMER PANTS', 55, 1),
(23, '2201631', 'LADIES JEANS SKIRTS', 55, 1),
(24, '2201831', 'SUMMER COTTON DRESS', 55, 1),
(25, '2201931', 'LADIES SILK DRESS', 55, 1),
(26, '2203431', 'NYLON UNDERWEAR', 55, 1),
(27, '2203642', 'HAND BAGS (sack)', 50, 1),
(28, '2204542', 'SCHOOL BAGS', 50, 1),
(29, '2300136', 'MEN SUITS', 55, 1),
(30, '2300233', 'MEN SHIRTS LONG SLEEVES (L/S) 200P', 55, 1),
(31, '2300333', 'MEN SHIRTS SHORT SLEEVES (S/S) 200P', 55, 1),
(32, '2300735', 'MEN PANTS LIGHT 100P', 55, 1),
(33, '2300835', 'MEN JEAN PANTS 100P', 55, 1),
(34, '2300935', 'MEN VELVET PANTS', 55, 1),
(35, '2302131', 'MEN PYJAMA', 55, 1),
(36, '2400131', 'CHILDREN COTTON RUMMAGE', 55, 1),
(37, '2401231', 'CHILDREN MIX PANTS', 55, 1),
(38, '2401834', 'YOUTH PANTS', 55, 1),
(39, '2401931', 'BABY MIX', 55, 1),
(40, '2500231', 'DOILY (TABLE CLOTHS)', 55, 1),
(41, '2500331', 'TOWELS', 55, 1),
(42, '2500431', 'HOUSEHOLD LIGHT HHL', 55, 1),
(43, '2500731', 'COUPON FABRICS', 55, 1),
(44, '2500831', 'CURTAINS LIGHT', 55, 1),
(45, '2501231', 'BED COVER', 55, 1),
(46, '2502631', 'BEDSHEETS WHITE', 55, 1),
(47, '2600146', 'PLASTICS SLEPERS (20KG sack)', 20, 1),
(48, '2600346', 'FOOTBALL BOOTS (25KG sack)', 25, 1),
(49, '2601346', 'SUMMER SHOES (25KG sack)', 25, 1),
(50, '2602146', 'WORKER SHOES (25KG sack)', 25, 1),
(51, '2602246', 'SUMMER SHOES (25KG sack) II', 25, 1),
(52, '2731131', 'CHILDREN COTTON RUMMAGE II', 55, 1),
(53, '2731231', 'SPORT TRAINING II', 55, 1),
(54, '2751031', 'T-SHIRT  II', 55, 1),
(55, '2752031', 'SHORT  II', 55, 1),
(56, '2753031', 'CHILDREN MIX PANTS II', 55, 1),
(57, '2755031', 'MEN SHIRT LONG/SHORT II', 55, 1),
(58, '2756031', 'HHRL II', 55, 1),
(59, '2840042', 'NR SPECIAL (UNDERWEAR)', 55, 1),
(60, '2840057', 'CCR SPECIAL (CREAM)', 55, 1),
(61, '8611570', 'KH KINDER S (CCR Special)', 55, 1),
(62, 'A01/LP 3/4', 'LADY PANTS 3/4', 90, 2),
(63, 'A02/LJP-SK', 'LADY JEANS PANT', 90, 2),
(64, 'B02/LJP-SK', 'LADY JEANS PANT B', 90, 2),
(65, 'A04/LCP', 'LADY CASUAL PANTS', 90, 2),
(66, 'A05/LCD', 'LADY COTTON DRESS', 90, 2),
(67, 'A06/LCS', 'LADY COTTON SKIRTS (NON MINI)', 90, 2),
(68, 'A07/LUW', 'LADY UNDERWEARS', 90, 2),
(69, 'A08/LSD', 'LADY SILK DRESS', 90, 2),
(70, 'A09/LST', 'LADY SILK TOPS', 90, 2),
(71, 'A10/LSS', 'LADY SILK SHIRTS', 90, 2),
(72, 'A11/LTS-S', 'LADY T-SHIRTS SHORT SLEEVE', 90, 2),
(73, 'B11/LTS-SB', 'LADY T-SHIRTS SHORT SLEEVE B', 90, 2),
(74, 'A12/LTS-L', 'LADY T-SHIRTS LONG SLEEVE', 90, 2),
(75, 'A13/LCB', 'LADY COTTON TOPS', 90, 2),
(76, 'A14/LEB', 'LADY ELASTIC BLOUSE', 90, 2),
(77, 'A15/LTS', 'LADY TROPICAL SKIRTS', 90, 2),
(78, 'A17/MFCP', 'MEN COTTON PANTS', 90, 2),
(79, 'B17/MFCP B', 'MEN COTTON PANTS B', 90, 2),
(80, 'A18/MFJP', 'MEN JEANS PANTS', 90, 2),
(81, 'B18/MFJP B', 'MEN JEANS PANTS B', 90, 2),
(82, 'A19/MFTP', 'MEN TROUSERS', 90, 2),
(83, 'A20-1/AFCP-L', 'MEN LONG CARGO PANTS', 90, 2),
(84, 'A20-2/AFCP-S', 'MEN COTTON CARGO SHORTS', 90, 2),
(85, 'A21/MOW', 'MEN UNDERWEARS AND BOXERS', 90, 2),
(86, 'A22/FOSP', 'FASHION ORIGINAL SHORTS', 90, 2),
(87, 'A23/MJ 3/4', 'MEN JEANS 3/4', 90, 2),
(88, 'A24-1/MTS-C', 'MEN T-SHIRTS (Colar and Round)', 90, 2),
(89, 'A24-1/MTS-R', 'MEN T-SHIRTS ROUND', 90, 2),
(90, 'B24/MTS B', 'MEN T-SHIRTS B', 90, 2),
(91, 'A25/MTL', 'MEN T-SHIRTS LONG', 90, 2),
(92, 'A26/MT-S-L', 'MEN SHIRTS (SHORT)', 90, 2),
(93, 'B26/MS-S-LB', 'MEN SHIRTS (SHORT) B', 90, 2),
(94, 'A27/MS-L', 'MEN SHIRTS (LONG)', 90, 2),
(95, 'B27/MS-LB', 'MEN SHIRTS (LONG) B', 90, 2),
(96, 'A28/CSW', 'CHILDREN SUMMER WEAR', 90, 2),
(97, 'B28/CSWB', 'CHILDREN SUMMER WEAR B', 90, 2),
(98, 'A29/KP', 'KIDS PANTS', 90, 2),
(99, 'A30/ANSP', 'ADULT NYLON SPORT', 90, 2),
(100, 'A32/AJP ?', 'ADULT JOGGING WEAR', 90, 2),
(101, 'A33/AJP(N)', 'ADULT JOGGING WEAR (NYLON)', 90, 2),
(102, 'A34/ANTW', 'ADULT NYLON TRAINING WEAR', 90, 2),
(103, 'A35/JERSEY', 'JERSEY', 90, 2),
(104, 'A36/SNW', 'SILK NIGHT WEAR (MIXED)', 90, 2),
(105, 'A37/CNW', 'COTTON NIGHT WEAR (MIXED)', 90, 2),
(106, 'A38/SW', 'SWIMMING WEAR', 90, 2),
(107, 'A39/PD', 'PARTY DRESS', 90, 2),
(108, 'A40/BRA', 'BRA', 90, 2),
(109, 'A41/LEGGING', 'LAGGINGS', 90, 2),
(110, 'A42/SCF-L', 'SCARF (LIGHT ONLY)', 90, 2),
(111, 'A43/CAP', 'CAP', 90, 2),
(112, 'A46/LJMS', 'LADY JEANS MINI SHORTS', 90, 2),
(113, 'A47/LCMS', 'LADY COTTON MINI SHORTS', 90, 2),
(114, 'A49/GIRDLE', 'GIRDLE', 90, 2),
(115, 'A50/LSP', 'LSP', 90, 2),
(116, 'A51/ALD', 'ALD', 90, 2),
(117, 'A53/LFP', 'LFP', 90, 2),
(118, 'A54/PS', 'PS', 90, 2),
(119, 'A55/GS', 'GIRL SHIRTS', 90, 2),
(120, 'A56/SS', 'SS', 90, 2),
(121, 'A61/GD', 'GIRLS DRESS', 90, 2),
(122, 'A62/LS', 'LADY SUITS', 90, 2),
(123, 'A63/LJ', 'BEAUTIFULL JACKETS', 90, 2),
(124, 'A65/NW', 'NET WEAR', 90, 2),
(125, 'A67/ACW ', 'AUTUMN CHILDREN WEAR', 90, 2),
(126, 'A73/LJS', 'LADY JEAN SKIRTS', 90, 2),
(127, 'M-BAGS', 'MIXED BAGS', 80, 2),
(128, 'S-BAGS', 'SCHOOL BAGS', 80, 2),
(129, 'T/ANORAK', 'ANORAK - A', 55, 3),
(130, 'T/CH ANORAK', 'CHILDREN ANORAK - A', 55, 3),
(131, 'T/CH P', 'CHILDREN TROUSERS - A', 55, 3),
(132, 'T/CH TR', 'CHILDREN TRAINING - A', 55, 3),
(133, 'T/CH S  MIX ', 'CHILDREN SUMMER  MIX  - A', 55, 3),
(134, 'T/CMR', 'CHILDREN MEDIUM SEASON -A', 55, 3),
(135, 'T/CH W  MIX', 'CHILDREN WINTER MIX - A', 55, 3),
(136, 'T/B TS', 'BOY T-SHIRT - A', 55, 3),
(137, 'T/BO P', 'BOY TROUSERS - A', 55, 3),
(138, 'T/GI DRESS', 'GIRL DRESS - A', 55, 3),
(139, 'T/GI SKIRT', 'GIRL SKIRT - A', 55, 3),
(140, 'T/LA CT  BL', 'LADIES COTTON BLOUSES - A', 55, 3),
(141, 'T/LA S  BL', 'LADIES SILK BLOUSES - A', 55, 3),
(142, 'T/LA CT  DR', 'LADIES COTTON DRESS - A', 55, 3),
(143, 'T/LA P  DR', 'LADIES POLY DRESS - A', 55, 3),
(144, 'T/LA S  DR', 'LADIES SILK DRESS - A', 55, 3),
(145, 'T/LA CT  SK', 'LADIES COTTON SKIRT - A', 55, 3),
(146, 'T/LA P  SK', 'LADIES POLY SKIRT - A', 55, 3),
(147, 'T/LA S  SK', 'LADIES SILK SKIRT - A', 55, 3),
(148, 'T/TPANT', 'LADIES TERGAL SKIRT -A', 55, 3),
(149, 'T/LJEANS SK', 'LADIES JEANS SKIRT -A', 55, 3),
(150, 'T/LA T  CLA', 'LADIES TROUSERS CLASSIC - A', 55, 3),
(151, 'T/LA F P', 'LADIES FASHION TROUSERS-A', 55, 3),
(152, 'T/LA C P', 'LADIES CORDUROY TROUSERS- A', 55, 3),
(153, 'T/LA TR  3/4', 'LADIES TROUSERS  3/4 -A', 55, 3),
(154, 'T/LA S', 'LADIES SUIT COMPLETE -A', 55, 3),
(155, 'T/LA S  FASH', 'LADIES SUIT JACKET FASHION -A', 55, 3),
(156, 'T/LA T-SH SS', 'LADIES  T-SHIRT S/S - A', 55, 3),
(157, 'T/LA T-SH P/LS  ', 'LADIES T-SHIRT + POLO L/S - A', 55, 3),
(158, 'T/LA SL', 'LADIES SWEATRES  LIGHT -A', 55, 3),
(159, 'T/LA RAINC', 'LADIES RAINCOAT -A', 55, 3),
(160, 'T/MSH SS-LS', 'MEN''S SHIRT S/S & L/S - A', 55, 3),
(161, 'T/M CT P', 'MEN''S COTTON TROUSERS - A', 55, 3),
(162, 'T/M J P', 'MEN''S JEANS TROUSERS - A', 55, 3),
(163, 'T/M T  P', 'MEN''S TERGAL TROUSERS - A', 55, 3),
(164, 'T/M C P', 'MEN''S CORDUROY  TROUSERS - A', 55, 3),
(165, 'T/M P 3/4', 'MEN''S TROUSERS  3/4', 55, 3),
(166, 'T/MS', 'MEN''S SUIT - A', 55, 3),
(167, 'T/MS J', 'LIGHT MEN SUIT JACKET', 55, 3),
(168, 'T/M T-S SS& P', 'MEN''S T-SHIRT S/S + POLO - A', 55, 3),
(169, 'T/M T-S&P LS', 'MEN''S T-SHIRT + POLO L/S - A', 55, 3),
(170, 'T/MSL', 'MEN''S SWEATERS LIGHT -A', 55, 3),
(171, 'T/M RAINC', 'MEN''S RAINCOAT-A', 55, 3),
(172, 'T/TIE', 'TIE- A', 55, 3),
(173, 'T/MO S  MIX', 'MODERN SUMMER MIX - A', 55, 3),
(174, 'T/FA S SH', 'FASHION SWEATSHIRT - A', 55, 3),
(175, 'T/S SH', 'SWEATSHIRT - A', 55, 3),
(176, 'T/TRAINING', 'TRAINING - A', 55, 3),
(177, 'T/FOODB T-H', 'FOOTBALL T-SHIRT - A', 55, 3),
(178, 'T/SHORTS', 'SHORTS - A', 55, 3),
(179, 'T/SWIM', 'SWIMMER', 55, 3),
(180, 'T/LIGHT', 'LIGHT SWEATERS S/S-A', 55, 3),
(181, 'T/L  JACKETS', 'LEATHER JACKETS -A', 55, 3),
(182, 'T/W U', 'WORK UNIFORM', 55, 3),
(183, 'T/BATHROBE', 'BATHROBE - A', 55, 3),
(184, 'T/L PYJAMAS', 'LIGHT PYJAMAS - A', 55, 3),
(185, 'T/L N GOWN', 'LIGHT NIGHT GOWN - A', 55, 3),
(186, 'T/BRA', 'BRASSIERS - A', 55, 3),
(187, 'T/CT UNDER', 'COTTON UNDERWEAR - A', 55, 3),
(188, 'T/NY UNDER', 'NYLON UNDERWEAR - A', 55, 3),
(189, 'T/NY COLLANT', 'NYLON COLLANT - A', 55, 3),
(190, 'T/SOCK ', 'SOCKS -SUMMER - A', 55, 3),
(191, 'T/LEGING', 'LEGINGS -A', 55, 3),
(192, 'T/FA CAP', 'FACE CAP - A', 55, 3),
(193, 'T/L SCARF', 'LIGHT SCARF - A', 55, 3),
(194, 'T/W HATS', 'WINTER HATS - A', 55, 3),
(195, 'T/CARPET', 'CARPET -A', 55, 3),
(196, 'T/HHR', 'HHR LIGHT - A', 55, 3),
(197, 'T/HHR H', 'HHR HEAVY - A', 55, 3),
(198, 'T/L BLANKET', 'LIGHT BLANKET - A', 55, 3),
(199, 'T/HEBLANKET', 'HEAVY BLANKET - A', 55, 3),
(200, 'T/LACE CUR', 'LACE CURTAIN - A', 55, 3),
(201, 'T/H CUR', 'HEAVY CURTAIN -A', 55, 3),
(202, 'T/CCR II', 'SUMMER CHILDREN B', 55, 3),
(203, 'T/MHS  II', 'MEN''S SHIRT S/S & L/S - B', 55, 3),
(204, 'T/M P II', 'MEN''S MIX TROUSERS -B', 55, 3),
(205, 'T/ME +  S II', 'MEN + LADIES T-SHIRT + POLO S/S B', 55, 3),
(206, 'T/SHORTS II', 'SHORTS B', 55, 3),
(207, 'T/HBAGS ', 'HANDBAGS', 25, 3),
(208, 'T/BELT', 'BELTS', 25, 3),
(209, 'T/TOYS', 'TOYS MIX', 25, 3),
(210, 'REVIMCA', 'ACRILIC RUBBER WATERPROOFING', 5, 4),
(211, 'REVIMCA', 'ACRILIC RUBBER WATERPROOFING', 10, 4),
(212, 'REVIMCA', 'ACRILIC RUBBER WATERPROOFING', 20, 4),
(213, 'REVIMCA', 'ACRILIC RUBBER WATERPROOFING', 25, 4),
(214, 'REVIMCA FA', 'FA?ADE WATERPROOFING SURFACE  TREAMENT', 5, 4),
(215, 'REVIMCA FA', 'FA?ADE WATERPROOFING SURFACE  TREAMENT', 10, 4),
(216, 'REVIMCA FA', 'FA?ADE WATERPROOFING SURFACE  TREAMENT', 20, 4),
(217, 'REVIMCA FA', 'FA?ADE WATERPROOFING SURFACE  TREAMENT', 25, 4),
(218, 'FV-M 101', 'CLOTH-MESH-GLASS FIBER', 0, 4),
(219, 'IMPERLAN', 'WATERPROOFING FOR MORTER', 1, 4),
(220, 'IMPERLAN PLUS', 'WATERPROOFING FOR CONCRET', 1, 4),
(221, 'REVICEM', 'WATERPROOFING FOR MORTER FOR DAMP&WET WALLS', 5, 4),
(222, 'REVICEM', 'WATERPROOFING FOR MORTER FOR DAMP&WET WALLS', 10, 4),
(223, 'REVICEM', 'WATERPROOFING FOR MORTER FOR DAMP&WET WALLS', 20, 4),
(224, 'REVICEM', 'WATERPROOFING FOR MORTER FOR DAMP&WET WALLS', 25, 4),
(225, 'RETROC-H', 'WATER REPELLENT FOR DAMP SURFACE', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplyorder`
--

CREATE TABLE `tblsupplyorder` (
  `orderid` int(11) NOT NULL,
  `orderno` varchar(50) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `dateordered` date NOT NULL,
  `capturedby` int(11) NOT NULL,
  `totalcost` float(16,2) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplyorder`
--

INSERT INTO `tblsupplyorder` (`orderid`, `orderno`, `supplierid`, `dateordered`, `capturedby`, `totalcost`, `datecreated`) VALUES
(6, 'SLM15719138965628', 3, '2019-10-23', 2, 345000.00, '2019-10-24 11:45:15'),
(7, 'SLM15719166008839', 2, '2019-10-23', 2, 565000.00, '2019-10-24 12:30:11'),
(8, 'SLM15719178119237', 2, '2019-10-23', 2, 4500000.00, '2019-10-24 12:50:40'),
(9, 'SOR_15720827096661', 2, '2019-10-26', 2, 550000.00, '2019-10-26 10:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplyorderexpenses`
--

CREATE TABLE `tblsupplyorderexpenses` (
  `expenseid` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` float(16,2) NOT NULL,
  `orderid` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `capturedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplyorderexpenses`
--

INSERT INTO `tblsupplyorderexpenses` (`expenseid`, `description`, `amount`, `orderid`, `datecreated`, `capturedby`) VALUES
(1, 'Transport from Germany', 25000.00, 6, '2019-10-25 02:42:46', 2),
(2, 'Custome Duty', 40000.00, 6, '2019-10-25 02:42:46', 2),
(3, 'Freight forwarder', 50000.00, 6, '2019-10-25 02:42:46', 2),
(4, 'Shipping charges', 35000.00, 6, '2019-10-25 02:44:22', 2),
(5, 'Freight forwarder', 13500.00, 7, '2019-10-25 02:45:59', 2),
(6, 'Transport charges', 34500.00, 7, '2019-10-25 02:45:59', 2),
(7, 'Shipping charges', 5500.00, 7, '2019-10-25 02:45:59', 2),
(10, 'Transport charges', 45000.00, 7, '2019-10-26 10:54:08', 2),
(11, 'Sea Freight', 120000.00, 9, '2019-10-26 11:11:55', 2),
(12, 'Custome Duty and clearing charges', 300000.00, 9, '2019-10-26 11:11:55', 2),
(13, 'Truck transport to warehouse', 50000.00, 9, '2019-10-26 11:11:55', 2),
(14, 'Offloading of the container and other charges', 20000.00, 9, '2019-10-26 11:11:55', 2),
(15, 'Freight forwarder', 2500.00, 7, '2019-10-29 04:45:17', 2),
(20, 'Truck transport to warehouse', 45230.00, 6, '2019-10-29 05:01:41', 2),
(21, 'Transport charges to seaport', 17890.00, 7, '2019-10-29 10:15:44', 2),
(22, 'exp1', 10000.00, 6, '2019-10-29 10:43:34', 2),
(23, 'exp2', 11500.00, 6, '2019-10-29 10:43:34', 2),
(24, 'exp3', 34600.00, 6, '2019-10-29 10:43:34', 2),
(25, 'some expenses here', 3200.00, 8, '2019-10-29 11:03:46', 2),
(26, 'exp5', 2000.00, 8, '2019-10-29 11:03:46', 2),
(27, 'The first expenses', 2300.00, 8, '2019-11-06 02:35:26', 2),
(28, 'Second expenses', 1200.00, 8, '2019-11-06 02:35:26', 2),
(29, 'Third expenses', 34500.00, 8, '2019-11-06 02:35:26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplyorderpayment`
--

CREATE TABLE `tblsupplyorderpayment` (
  `paymentid` int(11) NOT NULL,
  `paymentref` varchar(50) NOT NULL,
  `orderid` int(11) NOT NULL,
  `amountpaid` float(16,2) NOT NULL,
  `outstanding` float(16,2) NOT NULL DEFAULT '0.00',
  `duedate` date DEFAULT NULL,
  `datepaid` datetime NOT NULL,
  `paymentmode` int(11) NOT NULL,
  `paymenttype` int(11) NOT NULL,
  `capturedby` int(11) NOT NULL,
  `currencyid` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplyorderpayment`
--

INSERT INTO `tblsupplyorderpayment` (`paymentid`, `paymentref`, `orderid`, `amountpaid`, `outstanding`, `duedate`, `datepaid`, `paymentmode`, `paymenttype`, `capturedby`, `currencyid`, `comment`) VALUES
(1, 'SPR_15719418494868', 6, 4500.00, 340500.00, '2019-10-26', '2019-10-24 07:31:14', 3, 3, 0, 0, NULL),
(2, 'SPR_15719456971767', 7, 550000.00, 10000.00, '2019-10-25', '2019-10-24 08:36:59', 4, 3, 0, 0, NULL),
(3, 'spr_15719518774506', 7, 3000.00, 7000.00, '2019-10-25', '2019-10-24 10:25:21', 2, 2, 0, 0, NULL),
(5, 'SPR_15719553354453', 8, 4500.00, 4505278.00, '2019-10-26', '2019-10-24 11:17:48', 1, 2, 0, 0, NULL),
(8, 'SPR_15719593115578', 6, 150000.00, 190500.00, '2019-10-26', '2019-10-25 12:22:27', 1, 2, 0, 0, NULL),
(9, 'SPR_15719688179389', 8, 6000.00, 4499278.00, '2019-10-25', '2019-10-25 03:00:43', 1, 2, 0, 0, NULL),
(10, 'SPR_15720838635620', 9, 200000.00, 300000.00, '2019-10-31', '2019-10-26 10:58:39', 3, 3, 2, 0, NULL),
(11, 'SPR_15720839495319', 9, 180200.00, 119800.00, '2019-10-31', '2019-10-26 10:59:33', 3, 3, 2, 0, NULL),
(12, 'SPR_15720844402669', 9, 30000.00, 89800.00, '2019-10-26', '2019-10-26 11:08:31', 3, 2, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactiontype`
--

CREATE TABLE `tbltransactiontype` (
  `transactiontypeid` int(11) NOT NULL,
  `transactionname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransactiontype`
--

INSERT INTO `tbltransactiontype` (`transactiontypeid`, `transactionname`) VALUES
(1, 'Credit'),
(2, 'Debit');

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
(1, 1, 2, 'Active', 1, '2019-10-07 00:03:12', 1, '2019-11-04 05:21:39'),
(2, 2, 2, 'Active', 1, '2019-10-07 00:03:12', 1, '2019-11-04 05:15:45'),
(3, 2, 2, 'Disabled', 1, '2019-11-04 05:15:45', 1, '2019-11-04 05:21:30'),
(4, 2, 2, 'Active', 1, '2019-11-04 05:21:30', NULL, NULL),
(5, 1, 2, 'Disabled', 1, '2019-11-04 05:21:39', 1, '2019-11-04 05:21:47'),
(6, 1, 2, 'Active', 1, '2019-11-04 05:21:47', NULL, NULL),
(8, 3, 3, 'Active', 1, '2019-11-05 05:05:12', NULL, NULL),
(9, 6, 1, 'Disabled', 2, '2019-11-06 02:42:27', 2, '2019-11-06 02:42:41'),
(10, 6, 1, 'Active', 2, '2019-11-06 02:42:41', 2, '2019-11-06 02:42:57'),
(11, 6, 1, 'Disabled', 2, '2019-11-06 02:42:57', 2, '2019-11-06 02:43:04'),
(12, 6, 1, 'Active', 2, '2019-11-06 02:43:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblyear`
--

CREATE TABLE `tblyear` (
  `id` int(11) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblyear`
--

INSERT INTO `tblyear` (`id`, `year`) VALUES
(1, '2000'),
(2, '2001'),
(3, '2002'),
(4, '2003'),
(5, '2004'),
(6, '2005'),
(7, '2006'),
(8, '2007'),
(9, '2008'),
(10, '2009'),
(11, '2010'),
(12, '2011'),
(13, '2012'),
(14, '2013'),
(15, '2014'),
(16, '2015'),
(17, '2016'),
(18, '2017'),
(19, '2018'),
(20, '2019');

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
-- Indexes for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
  ADD PRIMARY KEY (`currencyid`);

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
-- Indexes for table `tblmonth`
--
ALTER TABLE `tblmonth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `month` (`month`);

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
-- Indexes for table `tblsalary`
--
ALTER TABLE `tblsalary`
  ADD PRIMARY KEY (`salaryid`);

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
-- Indexes for table `tblsupplieraccount`
--
ALTER TABLE `tblsupplieraccount`
  ADD PRIMARY KEY (`supplieraccountid`);

--
-- Indexes for table `tblsupplierstocklist`
--
ALTER TABLE `tblsupplierstocklist`
  ADD PRIMARY KEY (`stockid`);

--
-- Indexes for table `tblsupplyorder`
--
ALTER TABLE `tblsupplyorder`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tblsupplyorderexpenses`
--
ALTER TABLE `tblsupplyorderexpenses`
  ADD PRIMARY KEY (`expenseid`);

--
-- Indexes for table `tblsupplyorderpayment`
--
ALTER TABLE `tblsupplyorderpayment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `tbltransactiontype`
--
ALTER TABLE `tbltransactiontype`
  ADD PRIMARY KEY (`transactiontypeid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tblyear`
--
ALTER TABLE `tblyear`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `month` (`year`);

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
  MODIFY `bankaccountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblcontainer`
--
ALTER TABLE `tblcontainer`
  MODIFY `containerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblcountries`
--
ALTER TABLE `tblcountries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
  MODIFY `currencyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `employeeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblinternalexpense`
--
ALTER TABLE `tblinternalexpense`
  MODIFY `expenseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblmonth`
--
ALTER TABLE `tblmonth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblpaymentmode`
--
ALTER TABLE `tblpaymentmode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblpaymenttype`
--
ALTER TABLE `tblpaymenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblprivilege`
--
ALTER TABLE `tblprivilege`
  MODIFY `privilegeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tblprivilegecategory`
--
ALTER TABLE `tblprivilegecategory`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblroleprivilege`
--
ALTER TABLE `tblroleprivilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `tblsalary`
--
ALTER TABLE `tblsalary`
  MODIFY `salaryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblsales`
--
ALTER TABLE `tblsales`
  MODIFY `salesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblsalespayment`
--
ALTER TABLE `tblsalespayment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblstock`
--
ALTER TABLE `tblstock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblsupplieraccount`
--
ALTER TABLE `tblsupplieraccount`
  MODIFY `supplieraccountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblsupplierstocklist`
--
ALTER TABLE `tblsupplierstocklist`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT for table `tblsupplyorder`
--
ALTER TABLE `tblsupplyorder`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblsupplyorderexpenses`
--
ALTER TABLE `tblsupplyorderexpenses`
  MODIFY `expenseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tblsupplyorderpayment`
--
ALTER TABLE `tblsupplyorderpayment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbltransactiontype`
--
ALTER TABLE `tbltransactiontype`
  MODIFY `transactiontypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblyear`
--
ALTER TABLE `tblyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
