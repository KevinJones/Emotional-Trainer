CREATE TABLE IF NOT EXISTS `images` (
  `imgid` int(15) NOT NULL auto_increment,
  `order` int(4) NOT NULL default '0',
  `title` varchar(127) default NULL,
  PRIMARY KEY  (`imgid`)
)