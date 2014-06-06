-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2014 at 02:47 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clem`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `catid` tinyint(3) unsigned NOT NULL,
  `catname` varchar(200) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`catid`, `catname`) VALUES
(1, 'oeuvres'),
(2, 'carnets de voyage'),
(3, 'peinture murale'),
(4, 'graphisme'),
(5, 'photo');

-- --------------------------------------------------------

--
-- Table structure for table `Images`
--

CREATE TABLE IF NOT EXISTS `Images` (
  `id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `large` varchar(200) NOT NULL,
  `medium` varchar(200) NOT NULL,
  `small` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Piece`
--

CREATE TABLE IF NOT EXISTS `Piece` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `catid` tinyint(3) unsigned NOT NULL,
  `imgL` varchar(200) NOT NULL,
  `imgM` varchar(200) NOT NULL,
  `imgS` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Piece`
--

INSERT INTO `Piece` (`id`, `name`, `description`, `catid`, `imgL`, `imgM`, `imgS`) VALUES
(0, 'Lorem Ipsum', '	Lorem Ipsum Ã¨ un testo segnaposto utilizzato nel settore della tipografia e della stampa. Lorem Ipsum Ã¨ considerato il testo segnaposto standard sin dal sedicesimo secolo, quando un anonimo tipografo prese una cassetta di caratteri e li assemblÃ² per preparare un testo campione. Ãˆ sopravvissuto non solo a piÃ¹ di cinque secoli, ma anche al passaggio alla videoimpaginazione, pervenendoci sostanzialmente inalterato. Fu reso popolare, negli anni â€™60, con la diffusione dei fogli di caratteri trasferibili â€œLetrasetâ€, che contenevano passaggi del Lorem Ipsum, e piÃ¹ recentemente da software di impaginazione come Aldus PageMaker, che includeva versioni del Lorem Ipsum.	', 1, 'pieces/IMGP0432.JPG', 'pieces/medium/IMGP0432.JPG', 'pieces/thumb/IMGP0432.JPG'),
(36, 'Lorem Ipsum', '		Lorem Ipsum-Õ¨ Õ¿ÕºÕ¡Õ£Ö€Õ¸Ö‚Õ©ÕµÕ¡Õ¶ Ö‡ Õ¿ÕºÕ¡Õ£Ö€Õ¡Õ¯Õ¡Õ¶ Õ¡Ö€Õ¤ÕµÕ¸Ö‚Õ¶Õ¡Õ¢Õ¥Ö€Õ¸Ö‚Õ©ÕµÕ¡Õ¶ Õ°Õ¡Õ´Õ¡Ö€ Õ¶Õ¡Õ­Õ¡Õ¿Õ¥Õ½Õ¾Õ¡Õ® Õ´Õ¸Õ¤Õ¥Õ¬Õ¡ÕµÕ«Õ¶ Õ¿Õ¥Ö„Õ½Õ¿ Õ§: ÕÕ¯Õ½Õ¡Õ® 1500-Õ¡Õ¯Õ¡Õ¶Õ¶Õ¥Ö€Õ«Ö` Lorem Ipsum-Õ¨ Õ°Õ¡Õ¶Õ¤Õ«Õ½Õ¡ÖÕ¥Õ¬ Õ§ Õ¿ÕºÕ¡Õ£Ö€Õ¡Õ¯Õ¡Õ¶ Õ¡Ö€Õ¤ÕµÕ¸Ö‚Õ¶Õ¡Õ¢Õ¥Ö€Õ¸Ö‚Õ©ÕµÕ¡Õ¶ Õ½Õ¿Õ¡Õ¶Õ¤Õ¡Ö€Õ¿ Õ´Õ¸Õ¤Õ¥Õ¬Õ¡ÕµÕ«Õ¶ Õ¿Õ¥Ö„Õ½Õ¿, Õ«Õ¶Õ¹Õ¨ Õ´Õ« Õ¡Õ¶Õ°Õ¡ÕµÕ¿ Õ¿ÕºÕ¡Õ£Ö€Õ«Õ¹Õ« Õ¯Õ¸Õ²Õ´Õ«Ö Õ¿Õ¡Ö€Õ¢Õ¥Ö€ Õ¿Õ¡Õ¼Õ¡Õ¿Õ¥Õ½Õ¡Õ¯Õ¶Õ¥Ö€Õ« Ö…Ö€Õ«Õ¶Õ¡Õ¯Õ¶Õ¥Ö€Õ« Õ£Õ«Ö€Ö„ Õ½Õ¿Õ¥Õ²Õ®Õ¥Õ¬Õ¸Ö‚ Õ»Õ¡Õ¶Ö„Õ¥Ö€Õ« Õ¡Ö€Õ¤ÕµÕ¸Ö‚Õ¶Ö„ Õ§: Ô±ÕµÕ½ Õ¿Õ¥Ö„Õ½Õ¿Õ¨ Õ¸Õ¹ Õ´Õ«Õ¡ÕµÕ¶ Õ¯Õ¡Ö€Õ¸Õ²Õ¡ÖÕ¥Õ¬ Õ§ Õ£Õ¸ÕµÕ¡Õ¿Ö‡Õ¥Õ¬ Õ°Õ«Õ¶Õ£ Õ¤Õ¡Ö€Õ¡Õ·Ö€Õ»Õ¡Õ¶, Õ¡ÕµÕ¬Ö‡ Õ¶Õ¥Ö€Õ¡Õ¼Õ¾Õ¥Õ¬ Õ§ Õ§Õ¬Õ¥Õ¯Õ¿Ö€Õ¸Õ¶Õ¡ÕµÕ«Õ¶ Õ¿ÕºÕ¡Õ£Ö€Õ¸Ö‚Õ©ÕµÕ¡Õ¶ Õ´Õ¥Õ»` Õ´Õ¶Õ¡Õ¬Õ¸Õ¾ Õ§Õ¡ÕºÕ¥Õ½ Õ¡Õ¶ÖƒÕ¸ÖƒÕ¸Õ­: Ô±ÕµÕ¶ Õ°Õ¡ÕµÕ¿Õ¶Õ« Õ§ Õ¤Õ¡Ö€Õ±Õ¥Õ¬ 1960-Õ¡Õ¯Õ¡Õ¶Õ¶Õ¥Ö€Õ«Õ¶ Lorem Ipsum Õ¢Õ¸Õ¾Õ¡Õ¶Õ¤Õ¡Õ¯Õ¸Õ² Letraset Õ§Õ»Õ¥Ö€Õ« Õ©Õ¸Õ²Õ¡Ö€Õ¯Õ´Õ¡Õ¶ Õ¡Ö€Õ¤ÕµÕ¸	', 1, 'pieces/IMGP0069.JPG', 'pieces/medium/IMGP0069.JPG', 'pieces/thumb/IMGP0069.JPG'),
(37, 'test', '		Lorem Ipsum je demonstrativnÃ­ vÃ½plÅˆovÃ½ text pouÅ¾Ã­vanÃ½ v tiskaÅ™skÃ©m a knihaÅ™skÃ©m prÅ¯myslu. Lorem Ipsum je povaÅ¾ovÃ¡no za standard v tÃ©to oblasti uÅ¾ od zaÄÃ¡tku 16. stoletÃ­, kdy dnes neznÃ¡mÃ½ tiskaÅ™ vzal kusy textu a na jejich zÃ¡kladÄ› vytvoÅ™il speciÃ¡lnÃ­ vzorovou knihu. Jeho odkaz nevydrÅ¾el pouze pÄ›t stoletÃ­, on pÅ™eÅ¾il i nÃ¡stup elektronickÃ© sazby v podstatÄ› beze zmÄ›ny. NejvÃ­ce popularizovÃ¡no bylo Lorem Ipsum v Å¡edesÃ¡tÃ½ch letech 20. stoletÃ­, kdy byly vydÃ¡vÃ¡ny speciÃ¡lnÃ­ vzornÃ­ky s jeho pasÃ¡Å¾emi a pozdÄ›ji pak dÃ­ky poÄÃ­taÄovÃ½m DTP programÅ¯m jako Aldus PageMaker.		', 1, 'pieces/IMGP0072.JPG', 'pieces/medium/IMGP0072.JPG', 'pieces/thumb/IMGP0072.JPG'),
(38, 'Lroem', '	 Ø¹Ù„Ù‰ Ø§Ù„Ø´ÙƒÙ„ Ø§Ù„Ø®Ø§Ø±Ø¬ÙŠ Ù„Ù„Ù†Øµ Ø£Ùˆ Ø´ÙƒÙ„ ØªÙˆØ¶Ø¹ Ø§Ù„ÙÙ‚Ø±Ø§Øª ÙÙŠ Ø§Ù„ØµÙØ­Ø© Ø§Ù„ØªÙŠ ÙŠÙ‚Ø±Ø£Ù‡Ø§. ÙˆÙ„Ø°Ù„Ùƒ ÙŠØªÙ… Ø§Ø³ØªØ®Ø¯Ø§Ù… Ø·Ø±ÙŠÙ‚Ø© Ù„ÙˆØ±ÙŠÙ… Ø¥ÙŠØ¨Ø³ÙˆÙ… Ù„Ø£Ù†Ù‡Ø§ ØªØ¹Ø·ÙŠ ØªÙˆØ²ÙŠØ¹Ø§ÙŽ Ø·Ø¨ÙŠØ¹ÙŠØ§ÙŽ -Ø¥Ù„Ù‰ Ø­Ø¯ Ù…Ø§- Ù„Ù„Ø£Ø­Ø±Ù Ø¹ÙˆØ¶Ø§Ù‹ Ø¹Ù† Ø§Ø³ØªØ®Ø¯Ø§Ù… "Ù‡Ù†Ø§ ÙŠÙˆØ¬Ø¯ Ù…Ø­ØªÙˆÙ‰ Ù†ØµÙŠØŒ Ù‡Ù†Ø§ ÙŠÙˆØ¬Ø¯ Ù…Ø­ØªÙˆÙ‰ Ù†ØµÙŠ" ÙØªØ¬Ø¹Ù„Ù‡Ø§ ØªØ¨Ø¯Ùˆ (Ø£ÙŠ Ø§Ù„Ø£Ø­Ø±Ù) ÙˆÙƒØ£Ù†Ù‡Ø§ Ù†Øµ Ù…Ù‚Ø±ÙˆØ¡. Ø§Ù„Ø¹Ø¯ÙŠØ¯ Ù…Ù† Ø¨Ø±Ø§Ù…Ø­ Ø§Ù„Ù†Ø´Ø± Ø§Ù„Ù…ÙƒØªØ¨ÙŠ ÙˆØ¨Ø±Ø§Ù…Ø­ ØªØ­Ø±ÙŠØ± ØµÙØ­Ø§Øª Ø§Ù„ÙˆÙŠØ¨ ØªØ³ØªØ®Ø¯Ù… Ù„ÙˆØ±ÙŠÙ… Ø¥ÙŠØ¨Ø³ÙˆÙ… Ø¨Ø´ÙƒÙ„ Ø¥ÙØªØ±Ø§Ø¶ÙŠ ÙƒÙ†Ù…ÙˆØ°Ø¬ Ø¹Ù† Ø§Ù„Ù†ØµØŒ ÙˆØ¥Ø°Ø§ Ù‚Ù…Øª Ø¨Ø¥Ø¯Ø®Ø§Ù„ "lorem ipsum" ÙÙŠ Ø£ÙŠ Ù…Ø­Ø±Ùƒ Ø¨Ø­Ø« Ø³ØªØ¸Ù‡Ø± Ø§Ù„Ø¹Ø¯ÙŠØ¯ Ù…Ù† Ø§Ù„Ù…ÙˆØ§Ù‚Ø¹ Ø§Ù„Ø­Ø¯ÙŠØ«Ø© Ø§Ù„Ø¹Ù‡Ø¯ ÙÙŠ Ù†ØªØ§Ø¦Ø¬ Ø§Ù„Ø¨Ø­Ø«. Ø¹Ù„Ù‰ Ù…Ø¯Ù‰ Ø§Ù„Ø³Ù†ÙŠÙ† Ø¸Ù‡Ø±Øª Ù†Ø³Ø® Ø¬Ø¯ÙŠØ¯Ø© ÙˆÙ…Ø®ØªÙ„ÙØ© Ù…Ù† Ù†Øµ Ù„ÙˆØ±ÙŠÙ… Ø¥ÙŠØ¨Ø³ÙˆÙ…ØŒ Ø£	', 1, 'pieces/IMGP0073.JPG', 'pieces/medium/IMGP0073.JPG', 'pieces/thumb/IMGP0073.JPG'),
(39, 'Loremmmm', 'Lorem Ipsum este pur ÅŸi simplu o machetÄƒ pentru text a industriei tipografice. Lorem Ipsum a fost macheta standard a industriei Ã®ncÄƒ din secolul al XVI-lea, cÃ¢nd un tipograf anonim a luat o planÅŸetÄƒ de litere ÅŸi le-a amestecat pentru a crea o carte demonstrativÄƒ pentru literele respective. Nu doar cÄƒ a supravieÅ£uit timp de cinci secole, dar ÅŸi a facut saltul Ã®n tipografia electronicÄƒ practic neschimbatÄƒ. A fost popularizatÄƒ Ã®n anii ''60 odatÄƒ cu ieÅŸirea colilor Letraset care conÅ£ineau pasaje Lorem Ipsum, iar mai recent, prin programele de publicare pentru calculator, ca Aldus PageMaker care includeau versiuni de Lorem Ipsum.', 1, 'pieces/IMGP0110.JPG', 'pieces/medium/IMGP0110.JPG', 'pieces/thumb/IMGP0110.JPG'),
(40, 'Lronn', 'Lorem Ipsum Ã©s un text de farciment usat per la indÃºstria de la tipografia i la impremta. Lorem Ipsum ha estat el text estÃ ndard de la indÃºstria des de l''any 1500, quan un impressor desconegut va fer servir una galerada de text i la va mesclar per crear un llibre de mostres tipogrÃ fiques. No nomÃ©s ha sobreviscut cinc segles, sinÃ³ que ha fet el salt cap a la creaciÃ³ de tipus de lletra electrÃ²nics, romanent essencialment sense canvis. Es va popularitzar l''any 1960 amb el llanÃ§ament de fulls Letraset que contenien passatges de Lorem Ipsum, i mÃ©s recentment amb programari d''autoediciÃ³ com Aldus Pagemaker que inclou versions de Lorem Ipsum.', 1, 'pieces/IMGP0088.JPG', 'pieces/medium/IMGP0088.JPG', 'pieces/thumb/IMGP0088.JPG'),
(42, 'Loorrm', 'Lorem Ipsum er rett og slett dummytekst fra og for trykkeindustrien. Lorem Ipsum har vÃ¦rt bransjens standard for dummytekst helt siden 1500-tallet, da en ukjent boktrykker stokket en mengde bokstaver for Ã¥ lage et prÃ¸veeksemplar av en bok. Lorem Ipsum har tÃ¥lt tidens tann usedvanlig godt, og har i tillegg til Ã¥ bestÃ¥ gjennom fem Ã¥rhundrer ogsÃ¥ tÃ¥lt spranget over til elektronisk typografi uten vesentlige endringer. Lorem Ipsum ble gjort allment kjent i 1960-Ã¥rene ved lanseringen av Letraset-ark med avsnitt fra Lorem Ipsum, og senere med sideombrekkingsprogrammet Aldus PageMaker som tok i bruk nettopp Lorem Ipsum for dummytekst.', 1, 'pieces/IMGP0398.JPG', 'pieces/medium/IMGP0398.JPG', 'pieces/thumb/IMGP0398.JPG'),
(44, 'Looroom', '	Lorem Ipsum à¸„à¸·à¸­ à¹€à¸™à¸·à¹‰à¸­à¸«à¸²à¸ˆà¸³à¸¥à¸­à¸‡à¹à¸šà¸šà¹€à¸£à¸µà¸¢à¸šà¹† à¸—à¸µà¹ˆà¹ƒà¸Šà¹‰à¸à¸±à¸™à¹ƒà¸™à¸˜à¸¸à¸£à¸à¸´à¸ˆà¸‡à¸²à¸™à¸žà¸´à¸¡à¸žà¹Œà¸«à¸£à¸·à¸­à¸‡à¸²à¸™à¹€à¸£à¸µà¸¢à¸‡à¸žà¸´à¸¡à¸žà¹Œ à¸¡à¸±à¸™à¹„à¸”à¹‰à¸à¸¥à¸²à¸¢à¸¡à¸²à¹€à¸›à¹‡à¸™à¹€à¸™à¸·à¹‰à¸­à¸«à¸²à¸ˆà¸³à¸¥à¸­à¸‡à¸¡à¸²à¸•à¸£à¸à¸²à¸™à¸‚à¸­à¸‡à¸˜à¸¸à¸£à¸à¸´à¸ˆà¸”à¸±à¸‡à¸à¸¥à¹ˆà¸²à¸§à¸¡à¸²à¸•à¸±à¹‰à¸‡à¹à¸•à¹ˆà¸¨à¸•à¸§à¸£à¸£à¸©à¸—à¸µà¹ˆ 16 à¹€à¸¡à¸·à¹ˆà¸­à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸žà¸´à¸¡à¸žà¹Œà¹‚à¸™à¹€à¸™à¸¡à¹€à¸„à¸£à¸·à¹ˆà¸­à¸‡à¸«à¸™à¸¶à¹ˆà¸‡à¸™à¸³à¸£à¸²à¸‡à¸•à¸±à¸§à¸žà¸´à¸¡à¸žà¹Œà¸¡à¸²à¸ªà¸¥à¸±à¸šà¸ªà¸±à¸šà¸•à¸³à¹à¸«à¸™à¹ˆà¸‡à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£à¹€à¸žà¸·à¹ˆà¸­à¸—à¸³à¸«à¸™à¸±à¸‡à¸ªà¸·à¸­à¸•à¸±à¸§à¸­à¸¢à¹ˆà¸²à¸‡ Lorem Ipsum à¸­à¸¢à¸¹à¹ˆà¸¢à¸‡à¸„à¸‡à¸à¸£à¸°à¸žà¸±à¸™à¸¡à¸²à¹„à¸¡à¹ˆà¹ƒà¸Šà¹ˆà¹à¸„à¹ˆà¹€à¸žà¸µà¸¢à¸‡à¸«à¹‰à¸²à¸¨à¸•à¸§à¸£à¸£à¸© à¹à¸•à¹ˆà¸­à¸¢à¸¹à¹ˆà¸¡à¸²à¸ˆà¸™à¸–à¸¶à¸‡à¸¢à¸¸à¸„à¸—à¸µà¹ˆà¸žà¸¥à¸´à¸à¹‚à¸‰à¸¡à¹€à¸‚à¹‰à¸²à¸ªà¸¹à¹ˆà¸‡à¸²à¸™à¹€à¸£à¸µà¸¢à¸‡à¸žà¸´à¸¡à¸žà¹Œà¸”à¹‰à¸§à¸¢à¸§à¸´à¸˜à¸µà¸—à¸²à¸‡à¸­à¸´à¹€à¸¥à¹‡à¸à¸—à¸£à¸­à¸™à¸´à¸à¸ªà¹Œ à¹à¸¥à¸°à¸¢à¸±à¸‡à¸„à¸‡à¸ªà¸ à¸²à¸žà¹€à¸”à¸´à¸¡à¹„à¸§à¹‰à¸­à¸¢à¹ˆà¸²à¸‡à¹„à¸¡à¹ˆà¸¡à¸µà¸à¸²à¸£à¹€à¸›à¸¥à¸µà¹ˆà¸¢à¸™à¹à¸›à¸¥à¸‡ à¸¡à¸±à¸™à¹„à¸”à¹‰à¸£à¸±à¸šà¸„à¸§à¸²à¸¡à¸™à¸´à¸¢à¸¡à¸¡à¸²à¸à¸‚à¸¶à¹‰à¸™à¹ƒà¸™à¸¢à¸¸à¸„ à¸„.à¸¨. 1960 à¹€à¸¡à¸·à¹ˆà¸­à¹à¸œà¹ˆà¸™ Letraset à¸§à¸²à¸‡à¸ˆà¸³à¸«à¸™à¹ˆà¸²à¸¢à¹‚à¸”à¸¢à¸¡à¸µà¸‚à¹‰à¸­à¸„à¸§à¸²à¸¡à¸šà¸™à¸™à¸±à¹‰à¸™à¹€à¸›à¹‡à¸™ Lorem Ipsum à¹à¸¥à¸°à¸¥à¹ˆà¸²à¸ªà¸¸à¸”à¸à¸§à¹ˆà¸²à¸™à¸±à¹‰à¸™ à¸„à¸·à¸­à¹€à¸¡à¸·à¹ˆà¸­à¸‹à¸­à¸Ÿà¸—à¹Œà¹à¸§à¸£à¹Œà¸à¸²à¸£à¸—à¸³à¸ªà¸·à¹ˆà¸­à¸ªà¸´à¹ˆà¸‡à¸žà¸´à¸¡à¸žà¹Œ (Desktop Publishing) à¸­à¸¢à¹ˆà¸²à¸‡ Aldus PageMaker à¹„à¸”à¹‰à¸£à¸§à¸¡à¹€à¸­à¸² Lorem Ipsum à¹€à¸§à¸­à¸£à¹Œà¸Šà¸±à¹ˆà¸™à¸•à¹ˆà¸²à¸‡à¹† à¹€à¸‚à¹‰à¸²à¹„à¸§à¹‰à¹ƒà¸™à¸‹à¸­à¸Ÿà¸—à¹Œà¹à¸§à¸£à¹Œà¸”à¹‰à¸§à¸¢	', 2, 'pieces/IMGP0417.JPG', 'pieces/medium/IMGP0417.JPG', 'pieces/thumb/IMGP0417.JPG'),
(45, 'Lorem ipsum', 'A Lorem Ipsum egy egyszerÃ» szÃ¶vegrÃ©szlete, szÃ¶vegutÃ¡nzata a betÃ»szedÃµ Ã©s nyomdaiparnak. A Lorem Ipsum az 1500-as Ã©vek Ã³ta standard szÃ¶vegrÃ©szletkÃ©nt szolgÃ¡lt az iparban; mikor egy ismeretlen nyomdÃ¡sz Ã¶sszeÃ¡llÃ­totta a betÃ»kÃ©szletÃ©t Ã©s egy pÃ©lda-kÃ¶nyvet vagy szÃ¶veget nyomott papÃ­rra, ezt hasznÃ¡lta. Nem csak 5 Ã©vszÃ¡zadot Ã©lt tÃºl, de az elektronikus betÃ»kÃ©szleteknÃ©l is vÃ¡ltozatlanul megmaradt. Az 1960-as Ã©vekben nÃ©pszerÃ»sÃ­tettÃ©k a Lorem Ipsum rÃ©szleteket magukbafoglalÃ³ Letraset lapokkal, Ã©s legutÃ³bb softwarekkel mint pÃ©ldÃ¡ul az Aldus Pagemaker.', 1, 'pieces/IMGP0071.JPG', 'pieces/medium/IMGP0071.JPG', 'pieces/thumb/IMGP0071.JPG'),
(46, 'Loremmm', '	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	', 1, 'pieces/IMGP0421.JPG', 'pieces/medium/IMGP0421.JPG', 'pieces/thumb/IMGP0421.JPG'),
(47, 'ghvjds', '	Description	bhjdsgvjkf', 1, 'pieces/IMGP0072.JPG', 'pieces/medium/IMGP0072.JPG', 'pieces/thumb/IMGP0072.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `Subcategory`
--

CREATE TABLE IF NOT EXISTS `Subcategory` (
  `cat_id` tinyint(3) unsigned NOT NULL,
  `subcat_id` tinyint(3) unsigned NOT NULL,
  `subcat_name` varchar(200) NOT NULL,
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Subcategory`
--

INSERT INTO `Subcategory` (`cat_id`, `subcat_id`, `subcat_name`) VALUES
(4, 1, 'poster'),
(4, 2, 'branding'),
(1, 1, 'oeuvres graphiques'),
(1, 2, 'photo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
