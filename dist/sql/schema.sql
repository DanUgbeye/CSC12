CREATE DATABASE /*!32312 IF NOT EXISTS*/`csc12` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `csc12`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`email`) values 
(1,'deedee','e10adc3949ba59abbe56e057f20f883e','deedee@g.com');

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `matric_no` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `middle_name` text DEFAULT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `nationality` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `lga` text DEFAULT NULL,
  `level` text DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `students` */

insert  into `students`(`id`,`matric_no`,`surname`,`first_name`,`middle_name`,`dob`,`nationality`,`state`,`lga`,`level`,`pin`) values 
(1,'17/184145032TR','Ugbeye','Daniel','Amajuoritse','2001-01-23','Nigerian','Delta','Warri-south','300','000000000000'),
(2,'17/184145016TR','Iyoriobhe','Wisdom','Ose','2001-12-03','Nigerian','Edo','Benin','300','000000000000');
