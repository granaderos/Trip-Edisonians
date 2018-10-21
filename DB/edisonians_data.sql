-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2013 at 07:53 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edisonians_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthdays`
--

CREATE TABLE IF NOT EXISTS `birthdays` (
  `birthday_id` int(11) NOT NULL AUTO_INCREMENT,
  `celebrant` varchar(30) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`birthday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `birthdays`
--

INSERT INTO `birthdays` (`birthday_id`, `celebrant`, `month`, `date`, `year`) VALUES
(20, 'fdg gf gfd', 'January', 1, 2013),
(21, 'Marejean Granaderos Perpinosa', 'February', 2, 1996);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(100) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `network` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `owner`, `contact_number`, `network`) VALUES
(15, 'marejean granaderos perpinosa', '09287654328', 'Smart Buddy'),
(16, 'marejean granaderos perpinosa', '12324567894', 'TM'),
(17, 'grabi gyud imba', '33333333333', 'Others'),
(18, 'Marejean Granaderos Perpinosa', '09107985432', 'Talk ''N Text'),
(19, 'Mariz Inoue T Go', '09482095784', 'Talk ''N Text'),
(20, 'Mariz Inoue T Go', '09068963605', 'TM');

-- --------------------------------------------------------

--
-- Table structure for table `message_center`
--

CREATE TABLE IF NOT EXISTS `message_center` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=321 ;

--
-- Dumping data for table `message_center`
--

INSERT INTO `message_center` (`message_id`, `sender`, `message`) VALUES
(292, 'greg delantar daprosa', 'helu ?? anu a2n??'),
(291, 'greg delantar daprosa', 'hai'),
(290, 'Marejean Granaderos Perpinosa', 'nag-aano kamo ngada?'),
(289, 'Marejean Granaderos Perpinosa', 'hehehe'),
(288, 'Marejean Granaderos Perpinosa', 'hi greg!'),
(287, 'jennilyn ramirez orion', 'fghgdgfh'),
(286, 'jennilyn ramirez orion', 'wew'),
(285, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(284, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(283, 'Marejean Granaderos Perpinosa', 'kean'),
(282, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(281, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(280, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(279, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(278, 'jennilyn ramirez orion', 'asa mn sad ka mag tetris diha dhai??'),
(277, 'Marejean Granaderos Perpinosa', 'Hi jen. tetris ta!'),
(293, 'Marejean Granaderos Perpinosa', 'busy ma?'),
(294, 'Marejean Granaderos Perpinosa', 'ano man tim pinagkaka-abalahan?'),
(295, 'greg delantar daprosa', 'ang program :)'),
(296, 'Marejean Granaderos Perpinosa', 'weh? hehehe. okay na it im program?'),
(297, 'greg delantar daprosa', 'aqn program'),
(298, 'greg delantar daprosa', 'd pa tawon'),
(299, 'Marejean Granaderos Perpinosa', 'patutdo gad kan Sir :D'),
(300, 'greg delantar daprosa', 'hahaha'),
(301, 'Marejean Granaderos Perpinosa', 'Sige na! go ra! :) para matapos na!'),
(302, 'greg delantar daprosa', ':)'),
(303, 'Marejean Granaderos Perpinosa', 'hehehe. smile lang sya oh! :D'),
(304, 'greg delantar daprosa', ':('),
(305, 'Marejean Granaderos Perpinosa', 'greg, pakiana na gad. '),
(306, 'Marejean Granaderos Perpinosa', 'go ra! ayaw kaawod :)'),
(307, 'greg delantar daprosa', 'nyan nlang'),
(308, 'Marejean Granaderos Perpinosa', 'yana na gad. :) ashya it hiya nagsusurvey! :)'),
(309, 'greg delantar daprosa', 'try q lang'),
(310, 'Marejean Granaderos Perpinosa', 'go greg! sige na! ashya ton iya obligation! :)'),
(311, 'jennilyn ramirez orion', 'jean naaa q question, dali na gud anay, heheheheh'),
(312, 'Marejean Granaderos Perpinosa', 'f'),
(313, 'Marejean Granaderos Perpinosa', 'f'),
(314, 'Marejean Granaderos Perpinosa', 'f'),
(315, 'greg delantar daprosa', 'hahah'),
(316, 'greg delantar daprosa', 'hahah'),
(317, 'Marejean Granaderos Perpinosa', 'tawa man?'),
(318, 'Ronalyn Ambot Rufil', 'we'),
(319, 'Mariz Inoue T Go', 'heLLo ?? kEnsa sa inyo ang OL ?? ;)'),
(320, 'Mariz Inoue T Go', 'heLLo ?? kEnsa sa inyo ang OL ?? ;)');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `private_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) DEFAULT NULL,
  `recipient` int(11) DEFAULT NULL,
  `private_message` varchar(1000) DEFAULT NULL,
  `time_sent` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`private_message_id`),
  KEY `link_to_users` (`recipient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `quotes_id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_by` varchar(100) DEFAULT NULL,
  `posted_quotes` varchar(2500) DEFAULT NULL,
  `posted_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`quotes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quotes_id`, `posted_by`, `posted_quotes`, `posted_time`) VALUES
(50, 'ramel kanang kuan', 'What quotes?', 'January 28, 2013&nbsp;2:18 PM'),
(51, 'marejean granaderos perpinosa', 'hgkkkh', 'January 28, 2013&nbsp;6:21 PM'),
(52, 'grabi gyud imba', 'AKO INI!!', 'January 28, 2013&nbsp;6:32 PM'),
(53, 'jun jun jun', 'tss!\n', 'January 28, 2013&nbsp;6:33 PM'),
(54, 'pur pi da', 'hmmmf...gutom na..', 'January 28, 2013&nbsp;6:37 PM'),
(55, 'Marejean Granaderos Perpinosa', 'hahaha. daghay quotes ang gipost!\nPa''no man ma-identify kung quotes ang gipost or di? hehehe', 'January 28, 2013&nbsp;7:53 PM'),
(56, 'jennilyn ramirez orion', 'ayeah!', 'January 29, 2013 9:06 AM'),
(57, 'jennilyn ramirez orion', 'fghfhgf', 'January 29, 2013 9:07 AM'),
(58, 'Marejean Granaderos Perpinosa', 'rygfh', 'January 29, 2013 9:07 AM'),
(59, 'jun jun jun', 'hi!', 'January 29, 2013 9:10 AM'),
(60, 'Marejean Granaderos Perpinosa', 'huhuhu. damo it error!', 'January 29, 2013 10:23 AM'),
(61, 'Marejean Granaderos Perpinosa', 'http://www.allaboutcookies.org/cookies/', 'January 29, 2013 10:56 AM'),
(62, 'Marejean Granaderos Perpinosa', 'http://www.whatarecookies.com/', 'January 29, 2013 10:56 AM'),
(63, 'Marejean Granaderos Perpinosa', 'http://php.net/manual/en/function.setcookie.php', 'January 29, 2013 10:57 AM'),
(64, 'Marejean Granaderos Perpinosa', 'http://www.w3schools.com/php/func_http_setcookie.asp', 'January 29, 2013 10:57 AM'),
(65, 'Marejean Granaderos Perpinosa', 'http://www.w3schools.com/php/func_http_setcookie.asp', 'January 29, 2013 10:57 AM'),
(66, 'Marejean Granaderos Perpinosa', 'http://davidwalsh.name/php-cookies', 'January 29, 2013 10:57 AM'),
(67, 'Marejean Granaderos Perpinosa', 'http://php.about.com/od/learnphp/qt/session_cookie.htm', 'January 29, 2013 10:58 AM'),
(68, 'Marejean Granaderos Perpinosa', 'http://php.about.com/od/learnphp/qt/\nsession_cookie.htm', 'January 29, 2013 10:58 AM'),
(69, 'Marejean Granaderos Perpinosa', 'http://stackoverflow.com/questions/4478805/what-is-difference-between-session-and-cookie-in-php\n', 'January 29, 2013 10:58 AM'),
(70, 'Marejean Granaderos Perpinosa', 'http://www.perlmonks.org/index.pl?node_id=606990', 'January 29, 2013 10:59 AM'),
(71, 'Marejean Granaderos Perpinosa', 'http://www.allaboutcookies.org/cookies/cookies-the-same.html', 'January 29, 2013 10:59 AM'),
(72, 'Marejean Granaderos Perpinosa', 'http://www.roseindia.net/answers/viewqa/JSP-Interview-Questions/12359-Differences-between--session-and--cookie.html', 'January 29, 2013 10:59 AM'),
(73, 'Marejean Granaderos Perpinosa', 'daghan quotes ui! hahaha', 'January 29, 2013 11:09 AM'),
(74, '', 'ere', 'June 3, 2013 7:51 AM'),
(75, '', 'fgvf', 'June 3, 2013 7:52 AM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `log` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `middlename`, `lastname`, `gender`, `age`, `birthdate`, `address`, `username`, `password`, `log`) VALUES
(14, 'mj', 'mj', 'mj', 'on', 16, 'January1, ', 'palo', 'mj', 'mj', 'out'),
(33, 'fdg', 'gf', 'gfd', 'on', 17, 'January 1, 2013', 'edf', 'lkjl', '*85CD9B30BC04882B7D383AD303407B330150A39C', 'out'),
(34, 'Marejean', 'Granaderos', 'Perpinosa', 'on', 17, 'February 2, 1996', 'Balinsasayao', 'granaderos', '*41D74B0BC91AF9594B6A7576DF09795C4D69CE35', 'out');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `link_to_users` FOREIGN KEY (`recipient`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
