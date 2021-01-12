/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.4.14-MariaDB : Database - db_studentportal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_studentportal` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_studentportal`;

/*Table structure for table `tbl_account_pending` */

DROP TABLE IF EXISTS `tbl_account_pending`;

CREATE TABLE `tbl_account_pending` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountPending` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_account_pending` */

insert  into `tbl_account_pending`(`ID`,`AccountPending`) values (1,'Approved'),(2,'Pending'),(3,'Rejected');

/*Table structure for table `tbl_account_status` */

DROP TABLE IF EXISTS `tbl_account_status`;

CREATE TABLE `tbl_account_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountStatus` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_account_status` */

insert  into `tbl_account_status`(`ID`,`AccountStatus`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_account_type` */

DROP TABLE IF EXISTS `tbl_account_type`;

CREATE TABLE `tbl_account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AccountType` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_account_type` */

insert  into `tbl_account_type`(`id`,`AccountType`) values (1,'Student'),(2,'Parent');

/*Table structure for table `tbl_accounts_admin` */

DROP TABLE IF EXISTS `tbl_accounts_admin`;

CREATE TABLE `tbl_accounts_admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountStatus` int(1) DEFAULT 1 COMMENT '1 - active 2 - inactive',
  `AccountID` int(11) DEFAULT NULL,
  `AccountName` varchar(50) DEFAULT NULL,
  `AccountPassword` varbinary(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `ExtName` varchar(50) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_accounts_admin` */

insert  into `tbl_accounts_admin`(`ID`,`AccountStatus`,`AccountID`,`AccountName`,`AccountPassword`,`LastName`,`FirstName`,`MiddleName`,`ExtName`,`Role`) values (1,1,1,'keanu','keanu','dela cruz','keanu','tagumasi',NULL,NULL),(2,1,2,'1','1','test','test','test',NULL,NULL);

/*Table structure for table `tbl_accounts_parent` */

DROP TABLE IF EXISTS `tbl_accounts_parent`;

CREATE TABLE `tbl_accounts_parent` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountType` int(1) DEFAULT 2 COMMENT '1 - student 2- parent',
  `AccountStatus` int(1) DEFAULT 2 COMMENT '1 - active  2 -inactive',
  `AccountPending` int(1) DEFAULT 2 COMMENT '1 - Approved 2 - pending',
  `AccountOnlineState` int(1) DEFAULT 2 COMMENT '1 - online 2 - offline',
  `AccountID` varchar(50) DEFAULT NULL,
  `AccountPassword` varchar(50) DEFAULT NULL,
  `LastName` varchar(80) DEFAULT NULL,
  `FirstName` varchar(80) DEFAULT NULL,
  `MiddleName` varchar(80) DEFAULT NULL,
  `Extname` varchar(80) DEFAULT NULL,
  `PhoneNumber` varchar(80) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `Icon` text DEFAULT NULL,
  `StudentID` varchar(50) DEFAULT NULL,
  `CreateTime` varchar(80) DEFAULT NULL,
  `UpdateTime` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_accounts_parent` */

insert  into `tbl_accounts_parent`(`ID`,`AccountType`,`AccountStatus`,`AccountPending`,`AccountOnlineState`,`AccountID`,`AccountPassword`,`LastName`,`FirstName`,`MiddleName`,`Extname`,`PhoneNumber`,`Email`,`Icon`,`StudentID`,`CreateTime`,`UpdateTime`) values (1,2,1,2,2,'1','1','dela cruz','keanu','tagumasi','Sr','0987654321','dk@gmail.com','','1201358','2020-12-07 13:50:03 PM','2020-12-07 13:50:03 PM');

/*Table structure for table `tbl_accounts_student` */

DROP TABLE IF EXISTS `tbl_accounts_student`;

CREATE TABLE `tbl_accounts_student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountType` int(1) NOT NULL DEFAULT 1 COMMENT '1 - student 2- parent',
  `AccountStatus` int(1) NOT NULL DEFAULT 2 COMMENT '1 - active  2 -inactive',
  `AccountPending` int(1) NOT NULL DEFAULT 2 COMMENT '1 - Approved 2 - pending 3- denied',
  `AccountOnlineState` int(1) NOT NULL DEFAULT 2 COMMENT '1 - online 2 - offline',
  `AccountID` varchar(50) NOT NULL,
  `AccountPassword` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `ExtName` varchar(50) NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Icon` text NOT NULL,
  `YearLevel` int(11) NOT NULL DEFAULT 1 COMMENT 'refer tbl_yearlevel',
  `Course` int(11) NOT NULL DEFAULT 1 COMMENT 'refer tbl_course',
  `ParentID` varchar(50) NOT NULL,
  `CreateTime` varchar(200) NOT NULL,
  `UpdateTime` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_accounts_student` */

insert  into `tbl_accounts_student`(`ID`,`AccountType`,`AccountStatus`,`AccountPending`,`AccountOnlineState`,`AccountID`,`AccountPassword`,`LastName`,`FirstName`,`MiddleName`,`ExtName`,`PhoneNumber`,`Email`,`Icon`,`YearLevel`,`Course`,`ParentID`,`CreateTime`,`UpdateTime`) values (1,1,1,1,2,'1','1','dela cruz','keanu','tagumasi','','0987654321','me@gmail.com','data:image/jpeg;base64,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',4,1,'','2021-1-09 20:06:23 PM','2021-1-09 20:06:23 PM'),(2,1,1,2,2,'313101','1111','qweqw','qweqw','qwe','','','','',10,5,'','2021-1-11 17:32:10 PM','2021-1-11 17:32:10 PM'),(3,1,1,2,2,'313231','qwe','qwe','qwe','qwe','','','','',1,1,'','2021-1-11 18:13:44 PM','2021-1-11 18:13:44 PM');

/*Table structure for table `tbl_course` */

DROP TABLE IF EXISTS `tbl_course`;

CREATE TABLE `tbl_course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` varchar(100) DEFAULT NULL,
  `CourseDescription` varchar(300) DEFAULT NULL,
  `CourseStatus` int(1) DEFAULT 1 COMMENT '1 -active 2-inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_course` */

insert  into `tbl_course`(`ID`,`CourseID`,`CourseDescription`,`CourseStatus`) values (1,'GAS','General Academic Strand',1),(2,'ABM','Accountancy AND Business Management',1),(3,'ABS','Abstract Bully School',1),(4,'CBN','College Bonanza Network',1),(5,'GGWP','Good Game Well Played',1);

/*Table structure for table `tbl_course_status` */

DROP TABLE IF EXISTS `tbl_course_status`;

CREATE TABLE `tbl_course_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_course_status` */

insert  into `tbl_course_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_grading_period` */

DROP TABLE IF EXISTS `tbl_grading_period`;

CREATE TABLE `tbl_grading_period` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_grading_period` */

insert  into `tbl_grading_period`(`ID`,`Title`,`Status`) values (1,'First',1),(2,'Second',1),(3,'Third',1),(4,'Fourth',1);

/*Table structure for table `tbl_grading_period_status` */

DROP TABLE IF EXISTS `tbl_grading_period_status`;

CREATE TABLE `tbl_grading_period_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_grading_period_status` */

insert  into `tbl_grading_period_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_message` */

DROP TABLE IF EXISTS `tbl_message`;

CREATE TABLE `tbl_message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserID` int(11) DEFAULT NULL,
  `FromUserID` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` int(1) DEFAULT NULL COMMENT '1 - recieve 2 - not recieve',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_message` */

insert  into `tbl_message`(`ID`,`ToUserID`,`FromUserID`,`Message`,`TimeStamp`,`Status`) values (1,1,2,'qweqweqweqweqw','2020-12-03 23:35:53',1);

/*Table structure for table `tbl_sample` */

DROP TABLE IF EXISTS `tbl_sample`;

CREATE TABLE `tbl_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_sample` */

insert  into `tbl_sample`(`id`,`name`,`age`) values (1,'keanu',24);

/*Table structure for table `tbl_schedule` */

DROP TABLE IF EXISTS `tbl_schedule`;

CREATE TABLE `tbl_schedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(20) DEFAULT NULL,
  `ScheduleDayID` int(11) DEFAULT NULL COMMENT '1 - mon 2- tues 3- wed 4 -thurs 5-fri 6-sat 7-sun',
  `ScheduleTimeStart` varchar(50) DEFAULT NULL,
  `ScheduleTimeEnd` varchar(50) DEFAULT NULL,
  `ScheduleDate` varchar(200) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `CreateTime` varchar(200) DEFAULT NULL,
  `UpdateTime` varchar(200) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_schedule` */

/*Table structure for table `tbl_scheduleday` */

DROP TABLE IF EXISTS `tbl_scheduleday`;

CREATE TABLE `tbl_scheduleday` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DcheduleDay` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_scheduleday` */

insert  into `tbl_scheduleday`(`ID`,`DcheduleDay`) values (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),(5,'Friday'),(6,'Saturday'),(7,'Sunday');

/*Table structure for table `tbl_since_year` */

DROP TABLE IF EXISTS `tbl_since_year`;

CREATE TABLE `tbl_since_year` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `YearFrom` varchar(250) DEFAULT NULL,
  `YearTo` varchar(250) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL COMMENT '1-active 2-inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_since_year` */

insert  into `tbl_since_year`(`ID`,`YearFrom`,`YearTo`,`Status`) values (1,'2021-01-01','2022-01-01',1);

/*Table structure for table `tbl_since_year_status` */

DROP TABLE IF EXISTS `tbl_since_year_status`;

CREATE TABLE `tbl_since_year_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_since_year_status` */

insert  into `tbl_since_year_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_subject` */

DROP TABLE IF EXISTS `tbl_subject`;

CREATE TABLE `tbl_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Status` int(1) DEFAULT 1 COMMENT '1 - active 2- inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_subject` */

insert  into `tbl_subject`(`ID`,`Code`,`Title`,`Description`,`Status`) values (1,'SCI','Science',NULL,1),(2,'Eng','English',NULL,1),(3,'MAPEH','MAPEH',NULL,1),(4,'Fil','Filipino',NULL,1),(5,'Math','Mathematics','1',1),(6,'aaa','aa','asd',2),(7,'test1Code','test1Title','testDescription',1),(8,'test2Code12','test2Title12','test2Description12',1);

/*Table structure for table `tbl_subject_status` */

DROP TABLE IF EXISTS `tbl_subject_status`;

CREATE TABLE `tbl_subject_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_subject_status` */

insert  into `tbl_subject_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_year_level_status` */

DROP TABLE IF EXISTS `tbl_year_level_status`;

CREATE TABLE `tbl_year_level_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_year_level_status` */

insert  into `tbl_year_level_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_yearlevel` */

DROP TABLE IF EXISTS `tbl_yearlevel`;

CREATE TABLE `tbl_yearlevel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `YearLevel` varchar(120) DEFAULT NULL,
  `YearLevelStatus` int(1) DEFAULT 1 COMMENT '1 - active 0 - inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_yearlevel` */

insert  into `tbl_yearlevel`(`ID`,`YearLevel`,`YearLevelStatus`) values (1,'First Year',1),(2,'Second Year',1),(3,'Third Year',1),(4,'Fourth Year',1),(5,'Grade 7',1),(6,'Grade 8',2),(7,'Grade 9',1),(8,'Grade 10',1),(9,'Grade 11',1),(10,'Grade 12',1),(11,'Grade 12',2),(12,'First Year1',2),(13,'1111',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
