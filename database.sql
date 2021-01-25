DROP TABLE IF EXISTS `checkindb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkindb` (
  `ndx` int(11) NOT NULL AUTO_INCREMENT,
  `callsign` varchar(8) NOT NULL,
  `state` varchar(25) NOT NULL,
  `town` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `county` varchar(25) NOT NULL,
  `grid` varchar(7) NOT NULL,
  `net` varchar(25) NOT NULL,
  `selected` tinyint(1) NOT NULL,
  `lastheard` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ndx`),
  KEY `ndx` (`ndx`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='checkin database'


DROP TABLE IF EXISTS `checkinmain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkinmain` (
  `ndx` int(11) NOT NULL AUTO_INCREMENT,
  `callsign` varchar(8) NOT NULL,
  `state` varchar(25) NOT NULL,
  `town` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `county` varchar(25) NOT NULL,
  `grid` varchar(7) NOT NULL,
  `net` varchar(25) NOT NULL,
  `selected` tinyint(1) NOT NULL,
  `lastheard` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ndx`),
  KEY `ndx` (`ndx`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='checkin database';
