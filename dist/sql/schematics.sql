
/*
creating the admin table
*/
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4


/*
creating the students table
*/
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4
