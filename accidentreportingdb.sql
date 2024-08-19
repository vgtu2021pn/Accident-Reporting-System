-- Adminer 4.7.9 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `accidentreportingdb`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `accident`;
CREATE TABLE `accident` (
  `accident_id` bigint(20) unsigned NOT NULL,
  `topic` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`accident_id`),
  UNIQUE KEY `accident_id` (`accident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `accident` (`accident_id`, `topic`, `category`, `description`, `location`, `lat`, `lng`, `date`, `time`) VALUES
(1,	'Car was sideswiped at high speed on the highway.',	'Sideswipe Accidents',	'Car rolled over and flew into the sideline. At high speed somebody\'s car from the front made the swipe-impact through the side of automobile.',	'Heiyanthuduwa South',	'6.799448618620941',	'79.98344992658522',	'2024-02-12',	'00:10'),
(2,	'Automobile crashed to the wall.',	'Head-On Collisions',	'Automobile crashed to the shop. Front of the car is damaged.',	'Dehiwala Zoological Gardens 120 Galvihara Rd Dehiwala-Mount Lavinia Sri Lanka',	'',	'',	'2024-03-02',	'08:04'),
(3,	'Collided Head-On with other Car.',	'Head-On Collisions',	'Machine collided with other machine on main road. Speed of the machine during the crash were around 80 km/h.',	'Heiyanthuduwa South',	'6.792398922044305',	'79.98197691079373',	'2024-03-09',	'13:03'),
(4,	'Car crashed into rear of my automobile',	'Rear-End Collisions',	'I was lunching in my automobile with engine off when Car made an impact to my Auto.',	'Battaramulla Jumma Masjid WW39+WPM Battaramulla',	'',	'',	'2024-03-22',	'11:01'),
(5,	'Sofa fall to the car\'s front.',	'Single-Vehicle Accidents',	'Unknown old sofa has fallen from above to the car. All front of the machine were damaged.',	'Waters Edge 316 Ethul Kotte Road',	'',	'',	'2024-03-25',	'15:16'),
(6,	'Impact with the Automobile.',	'Head-On Collisions',	'During the ride car head on crashed with other car.',	'316 Ethul Kotte Road, Battarmulla',	'',	'',	'2024-03-25',	'16:00'),
(7,	'Unknown person responsible for this',	'Side-Impact Collisions',	'I have left car and went walking around the Forest. When I got and came back, then I have found this. Images attached.',	'Eratha, Adavikanda.',	'6.832662016658816',	'80.40796527956314',	'2024-04-02',	'00:33'),
(8,	'Brakes not worked and crasht',	'Single-Vehicle Accidents',	'During the ride brakes were not functioning. I got scared and unwillingly crashed to the tree.',	'Sri Padaya-Kuruwita Erathna Sripada foot path',	'6.833051081138314',	'80.42595760461087',	'2024-05-05',	'14:00'),
(9,	'Engine under fire.',	'Single-Vehicle Accidents',	'During daytime engine was engulfed into the flames.',	'Narampola. AL MUHSIN Science College.',	'',	'',	'2024-06-06',	'16:15'),
(10,	'My car\'s rear got impacted by car without license plate number.',	'Rear-End Collisions',	'Stranger trampled my car\'s rear.',	'YATIHENA. Near Halford Care.',	'',	'',	'2024-08-01',	'08:30');

DROP TABLE IF EXISTS `accident_photo`;
CREATE TABLE `accident_photo` (
  `accident_id` bigint(20) unsigned NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `accident_id` (`accident_id`),
  CONSTRAINT `accident_photo_ibfk_1` FOREIGN KEY (`accident_id`) REFERENCES `accident` (`accident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `accident_photo` (`accident_id`, `photo`) VALUES
(1,	'images/1/1.jpg'),
(1,	'images/1/2.jpg'),
(1,	'images/1/3.jpg'),
(1,	'images/1/4.jpg'),
(2,	'images/2/1.jpg'),
(2,	'images/2/2.jpg'),
(2,	'images/2/3.jpg'),
(2,	'images/2/4.jpg'),
(3,	'images/3/1.jpg'),
(3,	'images/3/2.jpg'),
(3,	'images/3/3.jpg'),
(3,	'images/3/4.jpg'),
(4,	'images/4/1.jpg'),
(4,	'images/4/2.jpg'),
(4,	'images/4/3.jpg'),
(4,	'images/4/4.jpg'),
(5,	'images/5/1.jpg'),
(5,	'images/5/2.jpg'),
(5,	'images/5/3.jpg'),
(5,	'images/5/4.jpg'),
(6,	'images/6/1.jpg'),
(6,	'images/6/2.jpg'),
(6,	'images/6/3.jpg'),
(6,	'images/6/4.jpg'),
(7,	'images/7/1.jpg'),
(7,	'images/7/2.jpg'),
(7,	'images/7/3.jpg'),
(7,	'images/7/4.jpg'),
(8,	'images/8/1.jpg'),
(8,	'images/8/2.jpg'),
(8,	'images/8/3.jpg'),
(8,	'images/8/4.jpg'),
(9,	'images/9/1.jpg'),
(9,	'images/9/2.jpg'),
(9,	'images/9/3.jpg'),
(9,	'images/9/4.jpg'),
(10,	'images/10/1.jpg'),
(10,	'images/10/2.jpg'),
(10,	'images/10/3.jpg'),
(10,	'images/10/4.jpg');

DROP TABLE IF EXISTS `insurance_company`;
CREATE TABLE `insurance_company` (
  `company_id` int(11) unsigned NOT NULL,
  `company_name` char(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `insurance_company` (`company_id`, `company_name`, `location`, `password`) VALUES
(24455,	'Colorado Insurance',	'Colorado, Sri Lanka',	'$2y$10$SepS7YCQi8s1wLXsayQAXuMhtQ7X1piQfXH530.cjO682.vpVEotC'),
(24555,	'Sri Lankian Ensures',	'Colorado, Sri Lanka',	'$2y$10$orW5OahH2hDHha5QqOm/0.6soZVTulVejvfXMYpcy3eqqVryFFoVW');

DROP TABLE IF EXISTS `police_staff`;
CREATE TABLE `police_staff` (
  `police_staff_id` bigint(20) unsigned NOT NULL,
  `police_fname` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `police_lname` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `police_nic` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `police_staff_id` (`police_staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `police_staff` (`police_staff_id`, `police_fname`, `police_lname`, `police_nic`, `division`, `password`) VALUES
(31424,	'Harry',	'Hasan',	'13303107432',	'Colombo Municipality Police',	'$2y$10$v5FjFW1ktHH/svoLh/8mb.SxabfNJN62vzKdBD8jo3.cdhByspHX6'),
(31425,	'Ban',	'Desilva',	'11205281201',	'Colombo Municipality Police',	'$2y$10$FtoMRdLnaaaTORI25VO2C.Q/wOHxbmF97DaszgqtStmAyKHmNcRGa'),
(31426,	'Siw',	'Silva',	'11204010368',	'Colombo Municipality Police',	'$2y$10$l4Gd/qqcPJFQO9qyged1KO4bH4UE9.qp8i.UoIkAxXZqATueX.wuq'),
(31524,	'Pap',	'de Mel',	'13206225555',	'Colombo Municipality Police',	'$2y$10$FhiC/3JHos8bY3i2hAL3XuSP8gML1stw6EQhyXvJtrPe1ivn7iukC'),
(31544,	'Emili',	'Roshan',	'12205160210',	'Colombo Municipality Police',	'$2y$10$eog8zga3k7ZZxBv190e52ugTqNRelyyK7aPdfyZa6u05YknOZqazy'),
(32245,	'Kol',	'Senarath',	'12409010505',	'Colombo Municipality Police',	'$2y$10$Hl.3X6s3VMOAb2ITggg7f.FCbMipNRYilvKvFitRm3HoUMgquQcrm'),
(40101,	'Kiwa',	'Chaminda',	'14512018420',	'West Sri Lanka Police',	'$2y$10$FMM1EokU1IgPhwERkgbIauRp6IcE/lATMCv4OUNsm5/BuRDn6EzNC'),
(40110,	'Zio',	'de Zoysa',	'12402110101',	'West Sri Lanka Police',	'$2y$10$wTlczIoe3x6PfRQMswjbkOlKXI6c3CEhX721eQatCGl.qpLCLxj6S');

DROP TABLE IF EXISTS `rda_staff`;
CREATE TABLE `rda_staff` (
  `staff_id` bigint(20) unsigned NOT NULL,
  `s_fname` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_lname` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_nic` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `rda_staff` (`staff_id`, `s_fname`, `s_lname`, `s_nic`, `password`) VALUES
(40101,	'Indi',	'Indika',	'11208060022',	'$2y$10$GtWDw2x8UcZLOEjU7qA/KeiHQkHp5TKf7Y5xKOqVXgN.U578u/48K'),
(40102,	'Fara',	'Farooka',	'10202040033',	'$2y$10$wezuRqK1wFvZClTMFT3oW.9Iqn9xAtgf2V/1PtzHgA8tLOB9NVCfq'),
(40103,	'Sawa',	'Yapa',	'12106081599',	'$2y$10$kTeEafQjgGsG.jhyUIuQ7eRYyOPYCAc7nGBR5ws5T4xCQMx.zRFIa'),
(40104,	'Prada',	'Modeep',	'12609082469',	'$2y$10$GmA6SwryhLLMCjk0UvXZPextbVvIfSwjct8IQ4LGPRXZ3GBpcjJCq');

DROP TABLE IF EXISTS `temp_validate`;
CREATE TABLE `temp_validate` (
  `accident_id` bigint(20) unsigned NOT NULL,
  `staff_id` bigint(20) unsigned NOT NULL,
  KEY `accident_id` (`accident_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `validated_by`;
CREATE TABLE `validated_by` (
  `rda_id` bigint(20) unsigned NOT NULL,
  `accident_id` bigint(20) unsigned NOT NULL,
  `police_id` bigint(20) unsigned NOT NULL,
  `insurance_id` int(11) unsigned NOT NULL,
  `validation` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `accident_id` (`accident_id`),
  KEY `rda_id` (`rda_id`),
  KEY `police_id` (`police_id`),
  KEY `insurance_id` (`insurance_id`),
  CONSTRAINT `validated_by_ibfk_1` FOREIGN KEY (`accident_id`) REFERENCES `accident` (`accident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle` (
  `reg_no` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `driver_nic` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_no` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) unsigned DEFAULT NULL,
  UNIQUE KEY `reg_no` (`reg_no`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `insurance_company` (`company_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `vehicle` (`reg_no`, `password`, `first_name`, `last_name`, `address`, `telephone`, `dob`, `driver_nic`, `license_no`, `email`, `vehicle_type`, `company_id`) VALUES
('H119897',	'$2y$10$K1QKNjg/xWgcSBMG1c971eQD6w0vcuKtZzRHF05TtSemkxu7ITzNe',	'Cicil',	'Mendis',	'Smart Auto Tech Gonawala',	'009410102121',	'1811-02-22',	'11102224220',	'CHL2544',	'cicil_mendis@mail.lk',	'Car',	NULL),
('H120000',	'$2y$10$iz1Sye/e2kbijGWeJs0SWeVhK5IXw0faYi8PxVdAWH/IHxPJLKNrm',	'Fort',	'Gamage',	'888/E Sri Sudarshanarama',	'009400102021',	'1816-01-18',	'11601182500',	'CHI1585',	'fort_gamage@mail.lk',	'Car',	NULL),
('H125111',	'$2y$10$jbNuprxiPTb2ovEgNQkfvOCreXAec0MfBdjjcZEPrgUQjJxItIyh2',	'Quick',	'Herath',	'559/2 Siyambalape Road, Heiyanthuduwa 11618',	'009401012121',	'1820-01-29',	'12001290102',	'CHL1533',	'quick_herath@mail.lk',	'Car',	NULL),
('H125222',	'$2y$10$SVzHuNsFFrWKiqCDaf1SAuCF9.COEL7nnE5myuzswpfgCxgJpw7lC',	'Billy',	'Perera',	'704/A 1 Siriketha Road Heiyanthuduwa 11618',	'009410100111',	'1812-01-06',	'11201060012',	'COL1233',	'billy_perera@mail.lk',	'Car',	NULL),
('H125455',	'$2y$10$VmJHk14ONvxqcSZhmQqM2O87cLTWWxy7Kt4tH9zrpIqIsrKPFE5C2',	'Tota',	'Nanayakkara',	'533/11sri pangiasiri mawatha - Udupila Rd 11850',	'009400012111',	'1810-02-16',	'11002161510',	'COL2544',	'tota_nanayakkara_iii@mail.lk',	'Car',	NULL),
('H129596',	'$2y$10$Z51g/x3WwpOCse525Lob6uVjjhvdfISjNpFpTFalWe2q0bBJrer3G',	'Thanky',	'Bandara',	'XXGM+68H',	'009410000212',	'1816-01-19',	'11601191599',	'COL2566',	'thanky_bandara@mail.lk',	'Car',	NULL),
('H406825',	'$2y$10$vYzjVJnoLS2Tsr1knGEqLuzpmAD4yOO4gPOsxawUorehqeWwNVmLW',	'Raja',	'Pathirana',	'80/7A/2 Batalanda Road Gonowala 11640',	'009400011010',	'1815-03-03',	'11503038719',	'CHI4400',	'raja_pathirana@mail.lk',	'Car',	NULL),
('P225423',	'$2y$10$50kDGzw2RMg9.ukdvT5spOg5dAqqu6xpcc.1WHw3F1G..bjR9d4HC',	'Baddy',	'Fernando',	'Dr. Kerner Residence XXFJ+HVW',	'009412211222',	'1815-01-12',	'11501120102',	'COL1344',	'baddy_fernando@mail.lk',	'Car',	NULL),
('P356255',	'$2y$10$FS/dg34K29bOMBt2yMdJn.iKxh/yjdNXkBTAIl/FUEzvYInT6buom',	'Agy',	'Kumara',	'299/28 Dikwela Rd Mawaramandiya 11607',	'009401211121',	'1819-01-22',	'11901220505',	'COL2784',	'agy_kumara@mail.lk',	'Car',	NULL),
('P445222',	'$2y$10$CY5vYerJdH46Y8mAEax6Q.P8Cyi4n4hU5HjUfSPoVAKEob5zDRyu2',	'Did',	'Dissanayake',	'412 Dewala Rd',	'009411112211',	'1817-01-29',	'11701295222',	'CHI2455',	'did_dissanayake@mail.lk',	'Car',	NULL);

DROP TABLE IF EXISTS `vehicle_accident`;
CREATE TABLE `vehicle_accident` (
  `accident_id` bigint(20) unsigned NOT NULL,
  `registration_no` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `accident_id` (`accident_id`),
  KEY `registration_no` (`registration_no`),
  CONSTRAINT `vehicle_accident_ibfk_1` FOREIGN KEY (`accident_id`) REFERENCES `accident` (`accident_id`),
  CONSTRAINT `vehicle_accident_ibfk_2` FOREIGN KEY (`registration_no`) REFERENCES `vehicle` (`reg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `vehicle_accident` (`accident_id`, `registration_no`) VALUES
(8,	'H119897'),
(6,	'H120000'),
(5,	'H125111'),
(1,	'H125222'),
(9,	'H125455'),
(3,	'H129596'),
(10,	'H406825'),
(2,	'P225423'),
(4,	'P356255'),
(7,	'P445222');

-- 2024-08-02 16:57:41
