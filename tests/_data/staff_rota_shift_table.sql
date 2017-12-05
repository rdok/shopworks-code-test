--
-- Table structure for table `rota_slot_staff`
--

CREATE TABLE IF NOT EXISTS `rota_slot_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rotaid` int(11) NOT NULL,
  `daynumber` tinyint(4) NOT NULL,
  `staffid` int(11) DEFAULT NULL,
  `slottype` varchar(20) NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `workhours` float(4,2) NOT NULL,
  `premiumminutes` int(4) DEFAULT NULL,
  `roletypeid` int(11) DEFAULT NULL,
  `freeminutes` int(4) DEFAULT NULL,
  `seniorcashierminutes` int(4) DEFAULT NULL,
  `splitshifttimes` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rotaid` (`rotaid`,`staffid`),
  KEY `daynumber` (`daynumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=283626 ;