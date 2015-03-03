-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2015 at 12:45 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `work_ksc`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `username` varchar(150) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=217 ;

--
-- Dumping data for table `jos_users`
--

INSERT INTO `jos_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`) VALUES
(62, 'Administrator', 'admin', 'admin@clinic.com', '39ed830f49c86f5d7a505d2a13351973:za7QB2qxS0pn2yXA6CHtznW1C6gCh3mf', 'Super Administrator', 0, 1, 25, '2010-08-29 00:11:22', '2015-01-30 08:59:07', '', 'page_title=Edit Your Details\nshow_page_title=1\nadmin_language=en-GB\nlanguage=en-GB\neditor=xstandard\nhelpsite=http://help.joomla.org\ntimezone=7\n\n'),
(63, 'Sejahtera', 'testing', 'test@klinik.com', 'b4c447c8eb0f323fb752de26e15dc21d:i4MW1kEQLsUxACu5Yeyo5QaBIfSd9Zta', 'Registered', 1, 0, 18, '2010-08-29 04:47:45', '2010-10-30 06:04:02', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(64, 'Sejahtera Kasir', 'kasir', 'kasir@sejahtera.com', 'd6e9dcb4bba8dd7a249a9c6e93ecf1b3:cITFfNwi0ito6AUTae08vLrgB0ytnhDg', 'Registered', 1, 0, 18, '2010-10-13 03:56:28', '2011-07-25 02:29:06', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(65, 'Sejahtera Mod', 'moderator', 'mod@sejahtera.com', 'c9f88f091ccd8566f4694b82166ab4b0:jAaPq1eG9eyWy9p5OfGLDCh1P5AETzmD', 'Registered', 1, 0, 18, '2010-10-13 03:57:03', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(66, 'Sejahtera Mod Tarif', 'modtarif', 'modtarif@sejahtera.com', '69cec2fa4a91178aca8f27a24a5cb39a:pHJJuvUQGljd9nhtkL7svevRUp77K3fx', 'Registered', 1, 0, 18, '2010-10-13 03:57:37', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(67, 'Harkami', 'Harkami', 'fm001@ciracas.sj', '883a4ead360b30edf7f9e5d0c8fd930e:MPreJCLp4r3GkDkb8cy0K6B2PNaj29ek', 'Registered', 0, 0, 18, '2010-12-03 03:06:04', '2015-02-03 00:15:51', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(68, 'Muslih', 'muslih', 'muslih@ciracas.sj', 'a45f5a1a2e6c1ef73052551b938289bb:hHbId3BBUlq9io7sObLdi7ONyU8H1XAR', 'Registered', 1, 0, 18, '2010-12-03 03:06:37', '2011-11-17 10:17:13', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(69, 'Lin Noviastri', 'lin', 'lin@ciracas.sj', '9ba44977dfe624818af7db1ce9447230:4WdJBBptL9aheJQXyrHrvyD9ULOEccvl', 'Registered', 1, 0, 18, '2010-12-03 03:07:09', '2012-10-26 01:03:59', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(70, 'Maria Risca Furry', 'risca', 'rischa.furry@sejahtera.com', 'd4578211fd6529bf7d393bf453e4b0e8:rzMHqFg4rD8KZSM01QdYucQsm95Z8tKY', 'Registered', 0, 0, 18, '2011-05-20 02:27:45', '2015-01-31 06:56:55', '60e70bf77aced0ede6dacc56cb66f300', 'language=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(71, 'NOVIA HERLIN', 'novia', 'kuper_jeyek@sejahtera.com', 'aaa0cf0d3b5bf8a41f826cd7730f49d2:NGJpwzfMZwgqERAuCgriD8H0H4G9o1X9', 'Registered', 0, 0, 18, '2011-05-20 02:27:56', '2015-02-03 02:33:47', '61f27bf6c457166ce4444e55e0d43ebc', 'page_title=Edit Your Details\nshow_page_title=1\nlanguage=\ntimezone=7\n\n'),
(72, 'NINIS WINDIARTI', 'ninis', 'princes_ciput@sejahtera.com', '230922c21fcfdeb6ad4475a1333a1701:2prmHtNn954fmcN07pwk8dsgdzncFAVK', 'Registered', 0, 0, 18, '2011-05-20 02:29:05', '2015-02-03 04:58:12', 'e93761c63ac1c1f102218102e879e99f', 'page_title=Edit Your Details\nshow_page_title=1\nlanguage=\ntimezone=7\n\n'),
(178, 'Ummi Rahmatil A', 'ummi', 'ummi@sejahtera.com', '3b469fbd1b0e4199ad2957cb4866b264:6FCMQ0Dcx0VMZ0h8i5h8Vw3M0iqH9eiU', 'Registered', 0, 0, 18, '2011-11-16 09:03:06', '2011-11-16 12:49:39', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(177, 'Mardayanti P', 'tyas', 'tyas@sejahtera.com', '7465cfe58f4950b936cd9dd00392365d:3LYy6cgbFZMzTewMPFas2y36tiA835sR', 'Registered', 0, 0, 18, '2011-11-16 09:01:00', '2011-11-23 03:04:31', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(74, 'WAHYUDI', 'WAHYUDI', 'WAHYUDI@KSC.CO.ID', 'f5a510fcc4c25ffc2739d65fe8d43db4:E1nZwMZLcQKMTM2tJumTWeU0rX9cL5UE', 'Registered', 0, 0, 18, '2011-08-18 08:32:51', '2015-02-03 05:00:14', '1cd5280f5fb866f9eacae6853de82da5', 'page_title=Edit Your Details\nshow_page_title=1\nlanguage=\ntimezone=7\n\n'),
(75, 'ATFIYAH', 'ATFIYAH', 'ATFIYAH@KSC.CO.ID', 'daca6a740d10839033ff332004798191:Ieu8J5DxStsIEt29oDzXY3kF1F4JpPH4', 'Registered', 0, 0, 18, '2011-08-18 09:04:48', '2015-02-03 03:26:55', '52bfcc48a15a31fb19ac775a67b7845f', 'language=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(176, 'Bidan Sejahtera', 'bidan', 'bidan@sejahtera.com', '0916b2ae776d3b02cbc16b6a886d6ecc:fWiVBpvvMQjHrd3vyRktaq67nMTd6bIi', 'Registered', 0, 0, 18, '2011-11-16 08:56:18', '2015-02-03 05:08:01', '388738dc42fc6e90b61f3624cea48a06', 'page_title=Edit Your Details\nshow_page_title=1\nlanguage=\ntimezone=7\n\n'),
(77, 'Dedi Purwonggo', 'dedi', 'dedi@ciracas.com', 'bfd7d9ec41bf3735b6c7d57b44e4e05f:FZiYlvUPKFuTIzh7Xoc0UFmNlSaSHZWF', 'Registered', 0, 0, 18, '2011-09-09 12:57:06', '2015-01-29 15:07:37', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(78, 'Ari N.P.', 'ari', 'ari@ciracas.com', '18dba194f97b975239942d52fb16261a:DwuSgHXcV4AmwVXTiyPSUuyi47gc0Nsx', 'Registered', 0, 0, 18, '2011-09-09 12:59:58', '2011-11-19 13:03:52', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(79, 'Perawat', 'perawat', 'perawat@ciracas.com', 'a88df2044ce0de513bacd9b1a8be2d01:aWbPme8RzhJsIyt157zpvNqDo1zr6ywC', 'Registered', 0, 0, 18, '2011-09-09 13:02:16', '2015-02-02 22:19:22', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(73, 'NANDA PRATIWI', 'nanda', 'NANDA_PRATIWI@SEJAHTERA.COM', '75e05a166396bb6773a2f2802ed9fb81:uPu6VOob2GbMnj5Ze4F8PGgrx7Z45jfv', 'Registered', 0, 0, 18, '2011-08-08 08:52:55', '2015-02-01 03:52:31', '342b411a0f09b96654a0698aa0aa38a3:$1$f7b2791b$', 'page_title=Edit Your Details\nshow_page_title=1\nlanguage=\ntimezone=7\n\n'),
(183, 'Nurdin Susanto', 'nurdin', 'nurdin@sejahtera.com', '71a1c555679c3a22e0a561669f790c0d:Uj9sDEag0HDL6MCKgYv1DS9OCV99PiRl', 'Registered', 0, 0, 18, '2011-11-16 09:13:37', '2015-02-01 00:46:02', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(179, 'Wiwik Ariyana', 'wiwik', 'wiwik@sejahtera.com', '1b29aa170e4b9d1d07b2a81986c382c4:KA2fGp1RQK9h6Q0ymYYeagm9qLZOt7vK', 'Registered', 0, 0, 18, '2011-11-16 09:05:43', '2014-01-03 05:37:40', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(180, 'Swari Nastiti', 'swari', 'ari@sejahtera.com', '9538f224177159e51b3b42ea746694b0:FTST1C3Nt7wWpZnqIawr7oA66jqxidWs', 'Registered', 0, 0, 18, '2011-11-16 09:07:41', '2014-09-24 09:01:17', '', 'language=\ntimezone=7\n\n'),
(181, 'Sri Anindi', 'sri', 'sri@sejahtera.com', 'd07bb811d7445a18c6d12676b99d1d64:hpL4U0NAybV7WvDuVkG23gcwgm1Q0Xm5', 'Registered', 0, 0, 18, '2011-11-16 09:08:11', '2011-11-19 11:55:46', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(182, 'Agus Susanto', 'agus', 'agus@sejahtera.com', 'f4484acb0a8e3c13ee4f58f0bd39c453:YqGOy5tRTxDX2gmfIrzxf7ySobavQkNk', 'Registered', 0, 0, 18, '2011-11-16 09:10:42', '2013-03-12 01:02:44', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(184, 'Farissa', 'farissa', 'farsissa@sejahtera.com', '8f681dc38e59de42f40e7aa26c445384:LNyMICgdjtyNcFncn3awiGsxXmzU8iOn', 'Registered', 1, 0, 18, '2011-11-16 09:14:47', '2011-12-22 19:57:44', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(185, 'Herdiansyah', 'herdi', 'herdi@sejahtera.com', '5a8ad1057655088af508dca588a0c4c6:ESdHxHcuVw0uFPsPCVKRvzPBngObO6iY', 'Registered', 0, 0, 18, '2011-11-16 09:15:32', '2015-01-23 00:23:55', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(186, 'Widiastuti', 'widi', 'widi@sejahtera.com', '87479be26cb5b779286d1b6e8918f503:q4zsoy9xKRPCHYkLVFfdwZjB0Z9SFBzd', 'Registered', 0, 0, 18, '2011-11-16 09:16:07', '2015-01-26 00:18:09', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(187, 'Revi Lianica', 'Revi', 'revi@sejahtera.com', '8cc7a5cfd40b9a5072b53f8c5483268e:Lwp71NmB8MIf3GLHoVE2QWqQaNqIosd7', 'Registered', 0, 0, 18, '2011-11-16 09:16:48', '2011-11-20 09:09:12', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(188, 'Yanti', 'yanti', 'yanti@sejahtera.com', '139ddcb84374fb4f1692d3e8ff9325f4:fl8eM8pDyKOgXZIBB9DFv4LbSUh3K866', 'Registered', 0, 0, 18, '2011-11-16 09:17:14', '2012-10-27 09:45:50', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(189, 'Andi Lala', 'andi', 'andi@sejahtera.com', '739f90b0534a2eded2c5cbdf9dbb081a:KrfFTJZXHBQFHo84rNqnQPtJRNHSbcMv', 'Registered', 0, 0, 18, '2011-11-16 09:19:57', '2015-01-30 00:27:18', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(190, 'Muh. Taufik HIdayat', 'taufik', 'taufik@sejahtera.com', 'c7a158bf0a1d03b27d981abe35b86447:Mt2RgKS835QPprG3tnVuLIw1J9053kQw', 'Registered', 1, 0, 18, '2011-11-16 09:22:27', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(191, 'SWARI NASTITI', 'ARIE', 'FABOLOUZ_ARIE@YAHOO.COM', 'c22af9a906df66e532f9793df8e230bd:adF7hK5xnP2FLj698sFipSkaipgAkIzk', 'Registered', 0, 0, 18, '2011-11-17 07:43:02', '0000-00-00 00:00:00', '3f0a33a543e2348fface1bc7dda9ee57', '\n'),
(192, 'Firdaherdiana', 'firda', 'firda@sejahtera.com', 'c17ac653d18b0de0210f00ebb9cdbf03:P4KLaMuC1a8YX1DEZVW9UsQ2NJr2v5kQ', 'Registered', 0, 0, 18, '2011-12-13 07:21:34', '2015-01-25 00:18:34', 'a258d482ac39f8e72712374b487340cb', 'language=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(193, 'April', 'april', 'april@sejahtera.cm', '799c0734bd73fc9a9f727f271d1b3e6a:1svAzHY4Uj15SqKHyUp1UdFgWyXvWM23', 'Registered', 0, 0, 18, '2012-01-31 08:45:24', '2015-02-02 00:16:27', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(194, 'OKTARIA', 'Oktaria', 'okta@sejahtera.com', '8a92eb80d04318134d951e366c8d15b7:6FTRd3Zvnye8W9HtEyBlh54eRoTMzB1R', 'Registered', 0, 0, 18, '2012-02-08 09:07:31', '2014-10-11 02:03:50', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(195, 'kurniasih', 'kurniasih', 'kurni@sejahtera.com', '4822140a32c4002adf3cf726dfba53ed:GWzCTIlO7IBkNT24C4V3c12Kb9fZRJUx', 'Registered', 0, 0, 18, '2012-02-08 09:08:14', '2015-02-03 05:14:13', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(196, 'nurhalimah', 'nurhalimah', 'nur@sejahtera.com', 'a4dcdd656a0d1e38de10ac12cbcd9485:EXKGXngcX3cKPc6JDFY4ortShB97BAkL', 'Registered', 0, 0, 18, '2012-02-08 09:09:02', '2013-04-03 03:32:24', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(197, 'Widia Mutiara', 'widia', 'widia@sejahtera.com', '4256d6112f4e458e1ddf855124c86cb6:9gHYzApj65D1JKRxcEgU9Eva16quMj97', 'Registered', 0, 0, 18, '2012-10-27 08:56:48', '2013-01-15 15:48:02', '', 'language=\ntimezone=7\n\n'),
(198, 'Roikhul', 'roikhul', 'roikhul@sejahtera.com', '0c72ca2bdb91dece9a88d60d1d9662aa:zpUAohjoe94JRtiy2A8KWUgDMeG7s3Uw', 'Registered', 0, 0, 18, '2012-10-27 08:58:49', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(199, 'Jamal', 'jamal', 'jamal@sejahtera.com', '28bafa24ab8242ca8fda5e1446f69ad4:IF63sesqA7LI1U3rPEs9z1kl6IGdBeUI', 'Registered', 0, 0, 18, '2012-10-27 08:59:07', '2015-02-03 00:43:03', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(200, 'Carla', 'carla', 'carla@sejahtera.com', 'ff77c2c935d1d471346ff0f9151c36d4:XKvxddF6AaSG8nTuxLCj8P8BLjIpaB3S', 'Registered', 0, 0, 18, '2012-10-27 08:59:52', '2014-09-02 00:05:14', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(201, 'Ika Nopiyanti', 'ika', 'ika@sejahtera.com', '2f91822da4b1fd4be642a659f6632689:erbzEx4X9wVD2n6PoCwTgQW9h4wX5tMM', 'Registered', 0, 0, 18, '2013-02-20 14:57:03', '2013-05-04 07:50:58', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(202, 'Adi Purwanto', 'ipur', 'ipur@sejahtera.com', 'f2ece5d0ba07da5c7e2113f798f3b4b1:tUC1Jb1XGxXwVbH3e9M2tnJ2i3ZNsDam', 'Registered', 0, 0, 18, '2013-02-20 14:57:49', '2015-02-03 04:58:04', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(203, 'Sumanto', 'sumanto', 'sumanto@sejahtera.com', '874528843303a1794e80ab933e3283ef:wfaKKkRLVQjxIuAkdEjMxsbUnILZ9U5e', 'Registered', 0, 0, 18, '2013-04-03 14:39:37', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(204, 'Pujiati', 'pujiati', 'puji@sejahtera.com', 'aebf6a0b073ded5c703f8549359b2681:i9sHeqlnUIrJG34wkT9rZ48ljR7XRX64', 'Registered', 0, 0, 18, '2013-04-03 14:40:02', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(205, 'Eko Mei Suwandi', 'wandi', 'wandi@sejahtera.com', 'f56d5f19f87595e4892d890731850499:YnQ23E8tUZTyR8RMLymQaT02Bunkc9cn', 'Registered', 0, 0, 18, '2013-04-03 14:40:38', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(206, 'Prasetyo', 'pras', 'pras@sejahtera.com', 'a4df69abd55ff845dece284da40c8db9:rGhXXFocDlidzDh5XkYnnjgm0FiA2BfX', 'Registered', 0, 0, 18, '2013-04-03 14:41:04', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(207, 'Edi Widodo', 'dodo', 'dodo@dadsda.com', '0db83b82db8c74ecc2c161b3f06be5ff:3QEqDrlN7WzJf9m7YdLMRYaWvE6MFzTx', 'Registered', 0, 0, 18, '2013-04-03 14:41:27', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(208, 'satpam', 'satpam', 'sdasda@dadas.com', '7a902b55a7276c0c1748e6371cfe7cbc:f8eWVAgKwlPAkAJb0JSM6gbWuIDBEvmt', 'Registered', 0, 0, 18, '2013-04-03 14:41:50', '0000-00-00 00:00:00', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(209, 'FATEKUN', 'TEKUN', 'tekun_ksc@yahoo.co.id', '17dd3d4cd240b59eae1981eae30afe87:hnuYojFES5kx8PdeBh0SsalBKi2BWWWb', 'Registered', 0, 0, 18, '2013-04-12 03:56:32', '0000-00-00 00:00:00', 'b84c629b23a750ab81df5ba5bf23b14d', '\n'),
(210, 'perawat1', 'perawat1', 'perawat@sejahtera.com', '8850342ccbdf228d3f64e2a3bfcbcdd6:CTU1tJzDUsJ3REgkIS7KoyRlgIMyncCO', 'Registered', 0, 0, 18, '2013-05-27 13:19:34', '2013-05-27 14:30:54', '', '\n'),
(211, 'Maya', 'maya', 'maya@sejahtera.com', '384c01c3813d2c1e94ba21a9cf01c611:xBy7T0LXXXoTNFdbssoeXWolaHTHdfWw', 'Registered', 0, 0, 18, '2014-01-02 14:07:54', '2015-01-07 00:21:13', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(212, 'randi', 'randi', 'randi@sejahtera.com', '6fb5936b104764cf3c658368e12a0abb:6cjy3d0TSwoWQrq0CWuWRGaOfJMZ1bpH', 'Registered', 0, 0, 18, '2014-01-02 14:08:40', '2014-12-27 00:37:23', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(213, 'Mega', 'mega', 'mega@bayiku.com', '27ee26217bf788d0a649a3d8c2576b5f:gm4EB6AoQDyMnuKalxJzCfjHQyRShFen', 'Registered', 0, 0, 18, '2014-02-05 10:25:15', '2015-02-03 03:28:31', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(214, 'Henni D', 'henni', 'henni@sejahtera.com', '7e793f84b33b5b0a7011b2411d213755:tEzF2l7wa4HLpRIrTkqwCael292jjEkn', 'Registered', 0, 0, 18, '2014-02-27 09:44:43', '2015-02-02 14:06:25', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\npage_title=Edit Your Details\nshow_page_title=1\n\n'),
(215, 'Aullia Putri', 'putri', 'putri@sejahtera.com', '56c8178fde824bc2f1a2c40da2314713:sT9m03A5Er8CA12QLSB1OzCa3GqkxxTU', 'Registered', 0, 0, 18, '2014-09-03 03:07:30', '2014-09-11 07:39:36', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=7\n\n'),
(216, 'FAISAL', 'faisal', 'Faisal@yahoo.com', 'a469e5eeb64d370ac25bf28f037e5017:Drr76h5B735RNMUYN5c73bDmhHNu2P5f', 'Registered', 0, 0, 18, '2014-09-09 15:03:09', '2015-01-27 00:30:44', '', 'language=\ntimezone=7\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application` (
  `application_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `font_id` tinyint(1) NOT NULL default '1',
  `template_id` int(11) NOT NULL,
  `template_name` varchar(128) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `application_desc` varchar(128) default NULL,
  `application_code` int(11) NOT NULL,
  `application_secret_key` text NOT NULL,
  `application_login` tinyint(1) NOT NULL default '1',
  `application_status` tinyint(1) NOT NULL default '1',
  `application_registration` tinyint(1) NOT NULL default '0',
  `application_profile` tinyint(1) NOT NULL default '0',
  `application_content_article` tinyint(1) NOT NULL default '0',
  `application_content_picture` tinyint(1) NOT NULL default '0',
  `application_content_video` tinyint(1) NOT NULL default '0',
  `application_vote` tinyint(1) NOT NULL default '0',
  `application_rating` tinyint(1) NOT NULL default '0',
  `application_push_notif` tinyint(1) NOT NULL default '0',
  `application_payment_gateway` tinyint(1) NOT NULL default '0',
  `application_ads` tinyint(1) NOT NULL default '0',
  `application_catalog` tinyint(1) NOT NULL default '0',
  `application_mixed` tinyint(1) NOT NULL,
  `created` datetime default NULL,
  `modified` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`application_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Triggers `tbl_core_application`
--
DROP TRIGGER IF EXISTS `work_ksc`.`del_application_meta`;
DELIMITER //
CREATE TRIGGER `work_ksc`.`del_application_meta` AFTER DELETE ON `work_ksc`.`tbl_core_application`
 FOR EACH ROW BEGIN
DELETE FROM tbl_core_application_meta where application_id=OLD.application_id;
END
//
DELIMITER ;

--
-- Dumping data for table `tbl_core_application`
--

INSERT INTO `tbl_core_application` (`application_id`, `client_id`, `font_id`, `template_id`, `template_name`, `application_name`, `application_desc`, `application_code`, `application_secret_key`, `application_login`, `application_status`, `application_registration`, `application_profile`, `application_content_article`, `application_content_picture`, `application_content_video`, `application_vote`, `application_rating`, `application_push_notif`, `application_payment_gateway`, `application_ads`, `application_catalog`, `application_mixed`, `created`, `modified`) VALUES
(1, 1, 1, 0, '', 'WEB', NULL, 132132133, '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015-02-06 23:51:55', '2015-02-06 23:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_background`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_background` (
  `id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(128) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_code` varchar(32) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `properties_id` int(11) NOT NULL,
  `template_name` varchar(128) NOT NULL,
  `revision` tinyint(4) NOT NULL default '1',
  `status` tinyint(1) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_background`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_background_image`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_background_image` (
  `id` int(11) NOT NULL auto_increment,
  `app_background_id` int(11) NOT NULL,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_background_image`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_background_properties`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_background_properties` (
  `id` int(11) NOT NULL auto_increment,
  `template_id` int(11) NOT NULL,
  `home_background` int(11) NOT NULL,
  `regular_background` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_background_properties`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_meta`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_meta` (
  `meta_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `meta_param` varchar(128) NOT NULL,
  `meta_value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`meta_id`),
  KEY `client_id` (`client_id`,`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_meta_template`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_meta_template` (
  `meta_template_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `meta_param` varchar(128) NOT NULL,
  `meta_input_type` varchar(128) NOT NULL,
  `meta_default_value` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`meta_template_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_meta_template`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_application_notif_credential`
--

CREATE TABLE IF NOT EXISTS `tbl_core_application_notif_credential` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) NOT NULL,
  `application_code` varchar(32) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` int(8) NOT NULL,
  `reg_id` text NOT NULL,
  `cert` text NOT NULL,
  `passphrase` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_application_notif_credential`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_client`
--

CREATE TABLE IF NOT EXISTS `tbl_core_client` (
  `client_id` int(11) NOT NULL auto_increment,
  `country_id` int(4) NOT NULL,
  `client_name` varchar(128) default NULL,
  `client_desc` text NOT NULL,
  `client_tagline` text,
  `client_logo` text,
  `client_code` int(11) default NULL,
  `client_status` tinyint(1) default '0',
  `created` datetime default NULL,
  `modified` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`client_id`),
  KEY `code_status` (`client_code`,`client_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Triggers `tbl_core_client`
--
DROP TRIGGER IF EXISTS `work_ksc`.`del_client_application_meta_template`;
DELIMITER //
CREATE TRIGGER `work_ksc`.`del_client_application_meta_template` AFTER DELETE ON `work_ksc`.`tbl_core_client`
 FOR EACH ROW BEGIN
DELETE FROM tbl_core_application_meta_template where client_id=OLD.client_id;
END
//
DELIMITER ;

--
-- Dumping data for table `tbl_core_client`
--

INSERT INTO `tbl_core_client` (`client_id`, `country_id`, `client_name`, `client_desc`, `client_tagline`, `client_logo`, `client_code`, `client_status`, `created`, `modified`) VALUES
(1, 0, 'SEJAHTERA', '', NULL, NULL, 132132132, 0, '2015-02-06 23:50:46', '2015-02-06 23:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_configuration`
--

CREATE TABLE IF NOT EXISTS `tbl_core_configuration` (
  `config_id` tinyint(3) NOT NULL auto_increment,
  `config_param` varchar(64) character set latin1 default NULL,
  `config_type` varchar(4) default NULL,
  `config_value` text character set latin1,
  `config_description` varchar(255) character set latin1 default NULL,
  `created` datetime default NULL,
  `modified` timestamp NULL default NULL,
  PRIMARY KEY  (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_configuration`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_content`
--

CREATE TABLE IF NOT EXISTS `tbl_core_content` (
  `content_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `content_title_id` varchar(255) NOT NULL,
  `content_title_en` varchar(255) NOT NULL,
  `content_text_id` text NOT NULL,
  `content_text_en` text NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `comment` int(11) NOT NULL,
  `content_tag` varchar(255) NOT NULL,
  `content_status` tinyint(1) NOT NULL default '1',
  `content_url` text NOT NULL,
  `video_provider` varchar(32) NOT NULL,
  `video_id` varchar(128) NOT NULL,
  `video_url` text NOT NULL,
  `video_type` tinyint(1) NOT NULL,
  `facebook_share` tinyint(1) NOT NULL default '1',
  `twitter_share` tinyint(1) NOT NULL default '1',
  `show_comment` tinyint(1) NOT NULL default '1',
  `isHTML_id` tinyint(1) NOT NULL default '0',
  `isHTML_en` tinyint(1) NOT NULL,
  `auth` tinyint(1) NOT NULL default '0',
  `revision` int(4) NOT NULL default '1',
  `show_rating` tinyint(1) NOT NULL default '1',
  `rating` float NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `tbl_core_content`
--
DROP TRIGGER IF EXISTS `work_ksc`.`del_content`;
DELIMITER //
CREATE TRIGGER `work_ksc`.`del_content` AFTER DELETE ON `work_ksc`.`tbl_core_content`
 FOR EACH ROW BEGIN
DELETE FROM tbl_map_content_menu where content_id=OLD.content_id;
END
//
DELIMITER ;

--
-- Dumping data for table `tbl_core_content`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_country`
--

CREATE TABLE IF NOT EXISTS `tbl_core_country` (
  `country_id` int(11) NOT NULL auto_increment,
  `country_name` varchar(128) NOT NULL,
  `country_language` varchar(2) NOT NULL,
  `country_timezone` varchar(10) NOT NULL,
  `country_status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`country_id`),
  KEY `country_status` (`country_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_core_country`
--

INSERT INTO `tbl_core_country` (`country_id`, `country_name`, `country_language`, `country_timezone`, `country_status`, `created`, `modified`) VALUES
(1, 'Indonesia', 'id', '+7', 1, '2013-08-26 10:29:18', '2013-08-26 10:29:18'),
(2, 'Thailand', 'th', '+3', 1, '0000-00-00 00:00:00', '2014-10-06 13:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_font`
--

CREATE TABLE IF NOT EXISTS `tbl_core_font` (
  `font_id` int(11) NOT NULL auto_increment,
  `font_name` varchar(255) NOT NULL,
  `font_status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`font_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_core_font`
--

INSERT INTO `tbl_core_font` (`font_id`, `font_name`, `font_status`) VALUES
(1, 'Helvetica', 1),
(2, 'Open Sans', 0),
(3, 'Segoe', 0),
(4, 'K-SAN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_icon`
--

CREATE TABLE IF NOT EXISTS `tbl_core_icon` (
  `icon_id` int(11) NOT NULL auto_increment,
  `icon_name` varchar(100) NOT NULL,
  `icon_font` varchar(100) NOT NULL,
  `icon_letter` varchar(10) NOT NULL,
  `icon_code` varchar(100) NOT NULL,
  `icon_image` varchar(10) NOT NULL,
  `icon_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`icon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_core_icon`
--

INSERT INTO `tbl_core_icon` (`icon_id`, `icon_name`, `icon_font`, `icon_letter`, `icon_code`, `icon_image`, `icon_status`) VALUES
(2, 'Cell Phone', 'K-SAN', 'C', '', 'C', 1),
(4, 'Monitor', 'K-SAN', '-', '', '-', 1),
(5, 'Galleries', 'K-SAN', '1', '', '1', 1),
(6, 'Telephone', 'K-SAN', '5', '', '5', 1),
(7, 'Image', 'K-SAN', '/', '', '/', 1),
(8, 'Play', 'K-SAN', 'a', '', 'a', 1),
(9, 'Lock', 'K-SAN', 'H', '', 'H', 1),
(10, 'Globe', 'K-SAN', 'I', '', 'I', 1),
(11, 'Star', 'K-SAN', 'K', '', 'K', 1),
(12, 'Love', 'K-SAN', 'M', '', 'M', 1),
(13, 'Tweeter', 'K-SAN', 'n', '', 'n', 1),
(14, 'Facebook', 'K-SAN', 'r', '', 'r', 1),
(15, 'Envelope', 'K-SAN', 'P', '', 'P', 1),
(16, 'Pencil', 'K-SAN', 'Q', '', 'Q', 1),
(17, 'Power', 'K-SAN', '=', '', '=', 1),
(18, 'Cross', 'K-SAN', '3', '', '3', 1),
(19, 'Key', 'K-SAN', 'U', '', 'U', 1),
(20, 'Person', 'K-SAN', 'A', '', 'A', 1),
(21, 'Thunder', 'K-SAN', 'T', '', 'T', 1),
(24, 'Check List', 'K-SAN', '2', '', '2', 1),
(25, 'Geer', 'K-SAN', '@', '', '@', 1),
(26, 'Arrow Right', 'K-SAN', 'i', '', 'i', 1),
(27, 'Arrow Left', 'K-SAN', 'g', '', 'g', 1),
(28, 'Arrow Down', 'K-SAN', 'j', '', 'j', 1),
(29, 'Arrow Up', 'K-SAN', 'h', '', 'h', 1),
(31, 'Search', 'K-SAN', 'V', '', 'V', 1),
(32, 'Chatt', 'K-SAN', 'N', '', 'N', 1),
(33, 'Tone', 'K-SAN', 'b', '', 'b', 1),
(34, 'Stop', 'K-SAN', '>', '', '>', 1),
(35, 'Lines', 'K-SAN', '\\', '', '\\', 1),
(36, 'Alert', 'K-SAN', '*', '', '*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_image`
--

CREATE TABLE IF NOT EXISTS `tbl_core_image` (
  `id` int(11) NOT NULL auto_increment,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_core_image`
--

INSERT INTO `tbl_core_image` (`id`, `width`, `height`, `filename`) VALUES
(1, '100', '80', 'small.'),
(2, '140', '140', 'square.'),
(3, '200', '150', 'normal.'),
(4, '262', '135', 'non-retina.'),
(5, '400', '300', 'big.'),
(6, '400', '800', '400x800.'),
(7, '524', '270', 'retina.'),
(8, '640', '920', '640x920.'),
(9, '180', '135', '180x135.'),
(10, '180', '150', '180x150.'),
(11, '360', '140', '360x140.'),
(12, '360', '150', '360x150.'),
(13, '360', '480', '360x480.'),
(14, '640', '330', 'lanscape1.'),
(15, '208', '156', 'lanscape2.'),
(16, '316', '316', 'square_big.'),
(17, '400', '485', '400x485.'),
(18, '640', '485', '640x485.'),
(19, '100', '100', '100x100.'),
(20, '314', '314', '314x314.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_map_client_plugin`
--

CREATE TABLE IF NOT EXISTS `tbl_core_map_client_plugin` (
  `map_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  PRIMARY KEY  (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_map_client_plugin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_plugin`
--

CREATE TABLE IF NOT EXISTS `tbl_core_plugin` (
  `plugin_id` int(11) NOT NULL auto_increment,
  `plugin_group` varchar(45) default NULL,
  `plugin_name` varchar(45) default NULL,
  `plugin_desc` varchar(45) default NULL,
  `plugin_status` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `modified` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`plugin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_core_plugin`
--

INSERT INTO `tbl_core_plugin` (`plugin_id`, `plugin_group`, `plugin_name`, `plugin_desc`, `plugin_status`, `created`, `modified`) VALUES
(1, 'BASIC', 'PAS.BASIC.UA.DETECTION', NULL, 1, '2013-02-27 20:59:19', '2013-05-20 11:01:31'),
(2, 'BASIC', 'PAS.BASIC.MENU.GET', NULL, 1, '2013-02-27 16:27:16', '2013-05-20 11:01:37'),
(3, 'BASIC', 'PAS.BASIC.APPLICATION.INFO', NULL, 1, '2013-02-27 16:27:16', '2013-05-20 11:01:42'),
(4, 'BASIC', 'PAS.BASIC.CONTENT.GETBYMENU', NULL, 1, '2013-02-27 16:27:16', '2013-05-20 11:01:46'),
(5, 'BASIC', 'PAS.BASIC.CONTENT.GETBYID', NULL, 1, '2013-04-01 10:08:43', '2013-05-20 11:01:51'),
(6, 'BASIC', 'PAS.BASIC.ACCOUNT.REGISTER', NULL, 1, '2013-05-14 12:24:05', '2013-05-20 11:01:55'),
(7, 'BASIC', 'PAS.BASIC.CONTENT.SUBMITCOMMENT', NULL, 1, '2013-05-14 13:11:50', '2013-05-20 11:01:59'),
(8, 'BASIC', 'PAS.BASIC.ACCOUNT.LOGIN', NULL, 1, '2013-05-21 14:34:04', '2014-09-05 18:31:21'),
(9, 'BASIC', 'PAS.BASIC.CONTENT.COMMENT', NULL, 1, '2013-05-23 10:42:18', '2013-05-23 03:42:18'),
(10, 'BASIC', 'PAS.BASIC.ACCOUNT.LOGOUT', NULL, 1, '2013-05-24 16:36:49', '2013-05-24 09:36:49'),
(11, 'BASIC', 'PAS.BASIC.ACCOUNT.ACTIVATION', NULL, 1, '2013-05-24 16:53:14', '2013-05-24 09:53:14'),
(12, 'BASIC', 'PAS.BASIC.ACCOUNT.FORGOT_PASSWORD', NULL, 1, '2013-07-02 11:04:00', '2013-07-02 04:04:00'),
(13, 'BASIC', 'PAS.BASIC.ACCOUNT.CHANGE_PASSWORD', NULL, 1, '2013-07-02 11:04:00', '2013-07-02 04:04:00'),
(14, 'BASIC', 'PAS.BASIC.CONTENT.SEARCH', NULL, 1, '2013-07-02 21:00:16', '2013-07-02 14:00:16'),
(15, 'BASIC', 'PAS.BASIC.ACCOUNT.PROFILE', NULL, 1, '2013-07-03 02:41:04', '2013-07-02 19:41:04'),
(16, 'BASIC', 'PAS.BASIC.ACCOUNT.UPDATE', NULL, 1, '2013-07-03 02:41:04', '2013-07-02 19:41:04'),
(17, 'BASIC', 'PAS.BASIC.IMAGE.YOUTUBE', NULL, 1, '2013-07-10 13:52:23', '2013-07-10 06:52:23'),
(18, 'BASIC', 'PAS.BASIC.UA.DEMO', 'sdfsd', 0, '2013-07-31 17:13:12', '2013-08-05 12:36:20'),
(19, 'BASIC', 'PAS.BASIC.IMAGE.LOGO', '', 1, '2013-08-30 16:54:28', '2013-08-30 16:54:28'),
(20, 'BASIC', 'PAS.BASIC.CONTENT.COUNTER_COMMENT', '', 1, '2013-09-05 17:25:46', '2013-09-05 17:27:21'),
(21, 'BASIC', 'PAS.BASIC.NOTIFICATION.GET', NULL, 1, '2013-09-23 16:23:41', '2013-09-23 16:23:41'),
(22, 'BASIC', 'PAS.BASIC.NOTIFICATION.READ', NULL, 1, '2013-09-23 18:17:32', '2013-09-23 18:17:32'),
(23, 'ADS', 'PAS.ADS.REQUEST.INDEX', NULL, 1, '2013-09-27 09:04:19', '2013-09-27 09:04:19'),
(24, 'BASIC', 'PAS.BASIC.BACKGROUND.HOME', NULL, 1, '2013-09-30 08:16:02', '2013-09-30 08:16:02'),
(25, 'BASIC', 'PAS.BASIC.BACKGROUND.OTHER', NULL, 1, '2013-09-30 08:16:02', '2013-09-30 08:16:02'),
(26, 'UGC', 'PAS.UGC.VIDEO.CREATE', '', 1, '2014-10-14 16:41:05', '2014-10-14 16:41:05'),
(27, 'UGC', 'PAS.UGC.VIDEO.GETBYTITLE', '', 1, '2014-10-14 16:51:38', '2014-10-14 16:51:38'),
(28, 'UGC', 'PAS.UGC.VIDEO.SUBMITCOMMENT', '', 1, '2014-10-14 17:14:30', '2014-10-14 17:14:30'),
(29, 'UGC', 'PAS.UGC.VIDEO.GETBYID', '', 1, '2014-10-14 17:18:31', '2014-10-14 17:18:31'),
(30, 'UGC', 'PAS.UGC.PICTURE.CREATE', '', 1, '2014-10-14 17:34:23', '2014-10-14 17:34:23'),
(31, 'UGC', 'PAS.UGC.PICTURE.SUBMITCOMMENT', '', 1, '2014-10-14 17:37:22', '2014-10-14 17:37:22'),
(32, 'UGC', 'PAS.UGC.PICTURE.GETBYID', '', 1, '2014-10-14 17:39:27', '2014-10-14 17:39:27'),
(33, 'UGC', 'PAS.UGC.PICTURE.GETBYTITLE', '', 1, '2014-10-14 17:44:05', '2014-10-14 17:44:05'),
(34, 'UGC', 'PAS.UGC.ARTICLE.CREATE', '', 1, '2014-10-14 17:55:30', '2014-10-14 17:55:30'),
(35, 'UGC', 'PAS.UGC.ARTICLE.SUBMITCOMMENT', '', 1, '2014-10-14 18:03:45', '2014-10-14 18:03:45'),
(36, 'UGC', 'PAS.UGC.ARTICLE.GETBYID', '', 1, '2014-10-14 18:07:38', '2014-10-14 18:07:38'),
(37, 'UGC', 'PAS.UGC.ARTICLE.GETBYTITLE', '', 1, '2014-10-14 18:10:17', '2014-10-14 18:10:17'),
(38, 'UGC', 'PAS.UGC.MIX.GETBYTITLE', '', 1, '2014-10-31 16:28:10', '2014-10-31 16:28:10'),
(39, 'UGC', 'PAS.UGC.MIX.GETBYID', '', 1, '2014-10-31 16:29:00', '2014-10-31 16:29:00'),
(40, 'KSC', 'CLINIC.KSC.PASIEN.INDEX', 'clinic/ksc/pasien/index', 1, '2015-02-06 23:43:33', '2015-02-06 23:43:33'),
(41, 'KSC', 'CLINIC.KSC.PASIEN.LISTPASIEN', 'clinic/ksc/pasien/listPasien', 1, '2015-02-07 19:20:24', '2015-02-07 19:20:24'),
(42, 'KSC', 'CLINIC.KSC.PASIEN.GENERATE', 'hapus jika tak diperlukan', 1, '2015-02-07 19:20:24', '2015-02-07 19:25:09'),
(43, 'KSC', 'CLINIC.KSC.USER.GENERATE', '', 1, '2015-02-07 22:26:41', '2015-02-07 22:26:41'),
(44, 'KSC', 'CLINIC.KSC.PASIEN.DETAIL', 'clinic/ksc/pasien/listPasien', 1, '2015-02-07 19:20:24', '2015-02-08 00:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_policy`
--

CREATE TABLE IF NOT EXISTS `tbl_core_policy` (
  `policy_id` bigint(20) unsigned NOT NULL auto_increment,
  `policy_name` varchar(128) NOT NULL,
  `policy_description` text,
  `policy_value` varchar(128) NOT NULL,
  `policy_status` tinyint(1) NOT NULL default '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`policy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_policy`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_0`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_0` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_132132132_0`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_1`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_1` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_132132132_1`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_2`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_2` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_core_session_132132132_2`
--

INSERT INTO `tbl_core_session_132132132_2` (`session_id`, `session_token`, `application_id`, `application_name`, `user_name`, `created`, `expired`) VALUES
(4, 1423328869415219602, 1, 'WEB', 'admin', '2015-02-08 00:07:49', '2015-02-08 01:07:49'),
(5, 1423329302373841902, 1, 'WEB', 'guest', '2015-02-08 00:15:02', '2015-02-08 01:15:02'),
(6, 1423329379886852102, 1, 'WEB', 'guest', '2015-02-08 00:16:19', '2015-02-08 01:16:19'),
(7, 1423329662112332402, 1, 'WEB', 'admin', '2015-02-08 00:21:02', '2015-02-08 01:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_5`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_5` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_132132132_5`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_7`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_7` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_132132132_7`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_132132132_9`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_132132132_9` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_132132132_9`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_session_template`
--

CREATE TABLE IF NOT EXISTS `tbl_core_session_template` (
  `session_id` int(11) NOT NULL auto_increment,
  `session_token` bigint(20) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(128) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `token` (`session_token`,`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_session_template`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_template`
--

CREATE TABLE IF NOT EXISTS `tbl_core_template` (
  `template_id` int(11) NOT NULL auto_increment,
  `template_name` varchar(128) default NULL,
  `template_status` tinyint(1) default '1',
  `created` datetime default NULL,
  `modified` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_core_template`
--

INSERT INTO `tbl_core_template` (`template_id`, `template_name`, `template_status`, `created`, `modified`) VALUES
(1, 'Activation', 1, '2013-03-01 05:35:57', '2013-03-01 05:35:57'),
(2, 'Adult', 1, '2013-03-01 05:35:57', '2013-03-01 05:35:57'),
(3, 'Coorporate', 1, '2013-03-01 05:35:57', '2013-03-01 05:35:57'),
(4, 'Nature', 1, '2013-03-01 05:35:57', '2013-03-01 05:35:57'),
(5, 'Teen', 1, '2013-03-01 05:35:57', '2013-03-01 05:35:57'),
(6, 'General', 1, '2013-03-01 05:37:05', '2013-07-29 13:55:36'),
(7, 'Auction', 1, '2013-03-01 05:37:05', '2013-03-01 05:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_ugc`
--

CREATE TABLE IF NOT EXISTS `tbl_core_ugc` (
  `ugc_id` int(11) NOT NULL auto_increment,
  `client_id` int(11) NOT NULL,
  `client_code` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_code` int(11) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ugc_type` varchar(20) NOT NULL,
  `ugc_author` varchar(255) NOT NULL,
  `ugc_title` varchar(255) NOT NULL,
  `ugc_text` text NOT NULL,
  `comment` int(11) NOT NULL,
  `ugc_tag` varchar(255) NOT NULL,
  `ugc_status` tinyint(1) NOT NULL default '0',
  `ugc_publish_status` tinyint(1) NOT NULL default '0',
  `video_provider` varchar(32) NOT NULL,
  `video_url` text NOT NULL,
  `picture_provider` varchar(32) NOT NULL,
  `picture_url` text NOT NULL,
  `facebook_share` tinyint(1) NOT NULL default '0',
  `twitter_share` tinyint(1) NOT NULL default '0',
  `show_comment` tinyint(1) NOT NULL default '0',
  `auth` tinyint(1) NOT NULL default '0',
  `revision` int(4) NOT NULL default '0',
  `show_rating` tinyint(1) NOT NULL default '0',
  `rating` float NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` timestamp NULL default NULL on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ugc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_ugc`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_user`
--

CREATE TABLE IF NOT EXISTS `tbl_core_user` (
  `user_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_name` varchar(64) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_group_id` int(4) NOT NULL,
  `user_first_name` varchar(128) NOT NULL,
  `user_last_name` varchar(128) default NULL,
  `user_gender` enum('M','F') NOT NULL default 'M',
  `user_email` varchar(128) default NULL,
  `user_email_status` tinyint(1) NOT NULL default '0',
  `user_address` text,
  `user_city` varchar(50) default '',
  `user_language` enum('id','en') NOT NULL default 'id',
  `user_birth` datetime default NULL,
  `user_device_os` enum('IOS','ANDROID','BLACKBERRY','WINDOWSPHONE') default NULL,
  `user_device_token` varchar(128) default NULL,
  `user_notification` varchar(255) default NULL,
  `user_pic` text,
  `user_status` tinyint(1) NOT NULL default '1',
  `signin_fail` tinyint(1) NOT NULL default '0',
  `suspension_expired` datetime default NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_core_user`
--

INSERT INTO `tbl_core_user` (`user_id`, `user_name`, `user_password`, `user_group_id`, `user_first_name`, `user_last_name`, `user_gender`, `user_email`, `user_email_status`, `user_address`, `user_city`, `user_language`, `user_birth`, `user_device_os`, `user_device_token`, `user_notification`, `user_pic`, `user_status`, `signin_fail`, `suspension_expired`, `created`, `modified`) VALUES
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Admin', 'Guy', 'M', 'admin@pas.com', 0, '', 'Jakarta', 'id', NULL, NULL, NULL, NULL, '2050994946.gif', 1, 0, NULL, '2013-07-29 13:54:57', '2013-08-28 12:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_user_activities_template`
--

CREATE TABLE IF NOT EXISTS `tbl_core_user_activities_template` (
  `id` int(200) NOT NULL auto_increment,
  `app_id` int(11) NOT NULL,
  `menu_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `menu_id` (`menu_id`,`user_id`,`created`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_core_user_activities_template`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_core_user_group`
--

CREATE TABLE IF NOT EXISTS `tbl_core_user_group` (
  `user_group_id` int(11) NOT NULL auto_increment,
  `user_group_name` varchar(32) NOT NULL,
  `user_group_desc` varchar(255) NOT NULL,
  `user_group_status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_group_id`),
  KEY `user_group_status` (`user_group_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_core_user_group`
--

INSERT INTO `tbl_core_user_group` (`user_group_id`, `user_group_name`, `user_group_desc`, `user_group_status`) VALUES
(1, 'Administrator', 'for admin side', 1),
(2, 'Client', 'for client side', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_access`
--

CREATE TABLE IF NOT EXISTS `tbl_group_access` (
  `group_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `action` int(10) NOT NULL,
  PRIMARY KEY  (`group_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group_access`
--

INSERT INTO `tbl_group_access` (`group_id`, `menu_id`, `action`) VALUES
(1, 1, 0),
(1, 2, 15),
(1, 3, 15),
(1, 7, 15),
(1, 8, 15),
(1, 9, 15),
(1, 10, 15),
(1, 11, 9),
(1, 12, 0),
(1, 13, 0),
(1, 14, 0),
(1, 15, 0),
(1, 16, 0),
(1, 17, 0),
(1, 18, 0),
(1, 19, 0),
(1, 20, 15),
(1, 21, 15),
(1, 22, 15),
(1, 23, 15),
(1, 24, 0),
(1, 25, 0),
(1, 26, 15),
(1, 27, 15),
(1, 28, 0),
(1, 29, 0),
(1, 30, 15),
(1, 33, 0),
(1, 34, 0),
(1, 35, 15),
(1, 38, 15),
(1, 39, 0),
(2, 1, 0),
(2, 2, 0),
(2, 3, 15),
(2, 7, 15),
(2, 8, 5),
(2, 9, 15),
(2, 10, 1),
(2, 11, 0),
(2, 12, 0),
(2, 13, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(2, 18, 0),
(2, 19, 0),
(2, 20, 0),
(2, 21, 0),
(2, 22, 0),
(2, 23, 0),
(2, 24, 0),
(2, 25, 0),
(2, 26, 0),
(2, 27, 0),
(2, 28, 0),
(2, 29, 0),
(2, 30, 0),
(2, 33, 0),
(2, 34, 0),
(2, 35, 0),
(2, 38, 0),
(2, 39, 0),
(1, 41, 0),
(1, 40, 0),
(1, 42, 0),
(1, 43, 0),
(1, 44, 0),
(2, 40, 0),
(2, 41, 0),
(2, 42, 0),
(2, 44, 0),
(2, 43, 0),
(1, 45, 0),
(2, 45, 0),
(1, 46, 15),
(2, 46, 15),
(1, 47, 15),
(2, 47, 15),
(1, 48, 0),
(2, 48, 0),
(1, 49, 0),
(2, 49, 0),
(1, 50, 15),
(2, 50, 0),
(1, 51, 15),
(2, 51, 0),
(1, 52, 15),
(2, 52, 15),
(1, 53, 15),
(2, 53, 0),
(1, 54, 15),
(2, 54, 0),
(1, 55, 15),
(2, 55, 0),
(1, 56, 15),
(2, 56, 0),
(1, 57, 15),
(2, 57, 0),
(1, 58, 15),
(2, 58, 0),
(1, 59, 15),
(2, 59, 15),
(1, 60, 15),
(2, 60, 9),
(1, 61, 15),
(2, 61, 7),
(1, 62, 15),
(2, 62, 9),
(1, 63, 15),
(2, 63, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_map_content_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_map_content_menu` (
  `content_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY  (`content_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_map_content_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_map_user_client`
--

CREATE TABLE IF NOT EXISTS `tbl_map_user_client` (
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_map_user_client`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access`
--

CREATE TABLE IF NOT EXISTS `tbl_user_access` (
  `user_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `action` int(10) NOT NULL,
  PRIMARY KEY  (`user_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_access`
--

