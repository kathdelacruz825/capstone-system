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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_accounts_parent` */

insert  into `tbl_accounts_parent`(`ID`,`AccountType`,`AccountStatus`,`AccountPending`,`AccountOnlineState`,`AccountID`,`AccountPassword`,`LastName`,`FirstName`,`MiddleName`,`Extname`,`PhoneNumber`,`Email`,`Icon`,`StudentID`,`CreateTime`,`UpdateTime`) values (1,2,1,1,2,'1','1','last name1','first name1','middle name1','ext name1','09876543211','1qwewqe@gmaiul.conm1','','1','2021-2-02 09:48:26 AM','2021-2-02 09:48:26 AM'),(2,2,1,1,2,'11','11','111','11','11','','','','','11','2021-2-02 15:59:05 PM','2021-2-02 15:59:05 PM');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_accounts_student` */

insert  into `tbl_accounts_student`(`ID`,`AccountType`,`AccountStatus`,`AccountPending`,`AccountOnlineState`,`AccountID`,`AccountPassword`,`LastName`,`FirstName`,`MiddleName`,`ExtName`,`PhoneNumber`,`Email`,`Icon`,`YearLevel`,`Course`,`ParentID`,`CreateTime`,`UpdateTime`) values (1,1,1,1,2,'1','1','dela cruz','keanu','tagumasi','jr','09958406050','dkeanu382016@gmail.com','',2,2,'','2021-2-02 09:46:49 AM','2021-2-02 09:46:49 AM'),(2,1,1,1,2,'11','11','1111','111','11','','','','',1,1,'','2021-2-02 15:58:45 PM','2021-2-02 15:58:45 PM');

/*Table structure for table `tbl_announcement` */

DROP TABLE IF EXISTS `tbl_announcement`;

CREATE TABLE `tbl_announcement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` int(11) DEFAULT NULL,
  `Title` varchar(300) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `OnDate` varchar(150) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreatedTime` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_announcement` */

insert  into `tbl_announcement`(`ID`,`Type`,`Title`,`Description`,`OnDate`,`CreatedBy`,`Status`,`CreatedTime`) values (1,1,'test','test test test','02-17-2021 12:00:00 AM',1,1,'2021-2-02 09:47:30 AM');

/*Table structure for table `tbl_announcement_status` */

DROP TABLE IF EXISTS `tbl_announcement_status`;

CREATE TABLE `tbl_announcement_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_announcement_status` */

insert  into `tbl_announcement_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_announcement_type` */

DROP TABLE IF EXISTS `tbl_announcement_type`;

CREATE TABLE `tbl_announcement_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_announcement_type` */

insert  into `tbl_announcement_type`(`ID`,`Type`) values (1,'Examination'),(2,'Class'),(3,'School Activities');

/*Table structure for table `tbl_attendance` */

DROP TABLE IF EXISTS `tbl_attendance`;

CREATE TABLE `tbl_attendance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ScheduleID` int(11) DEFAULT NULL,
  `RemarksID` int(11) DEFAULT NULL,
  `AttendanceDate` varchar(150) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_attendance` */

/*Table structure for table `tbl_attendance_remarks` */

DROP TABLE IF EXISTS `tbl_attendance_remarks`;

CREATE TABLE `tbl_attendance_remarks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Remarks` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_attendance_remarks` */

insert  into `tbl_attendance_remarks`(`ID`,`Remarks`) values (1,'Present'),(2,'Absent'),(3,'Late'),(4,'Excuse');

/*Table structure for table `tbl_course` */

DROP TABLE IF EXISTS `tbl_course`;

CREATE TABLE `tbl_course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` varchar(100) DEFAULT NULL,
  `CourseDescription` varchar(300) DEFAULT NULL,
  `CourseStatus` int(1) DEFAULT 1 COMMENT '1 -active 2-inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_course` */

insert  into `tbl_course`(`ID`,`CourseID`,`CourseDescription`,`CourseStatus`) values (1,'GAS','General Academic Strand',1),(2,'ABM','Accountancy and Business Management',1);

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

insert  into `tbl_grading_period`(`ID`,`Title`,`Status`) values (1,'First',1),(2,'Second',2),(3,'Third',2),(4,'Fourth',2);

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

/*Table structure for table `tbl_record_exam` */

DROP TABLE IF EXISTS `tbl_record_exam`;

CREATE TABLE `tbl_record_exam` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectID` int(11) DEFAULT NULL,
  `GradingPeriodID` int(11) DEFAULT NULL,
  `Score` varchar(20) DEFAULT NULL,
  `OverAllItems` varchar(20) DEFAULT NULL,
  `Remarks` varchar(20) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `SchoolYearID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_record_exam` */

/*Table structure for table `tbl_record_grade` */

DROP TABLE IF EXISTS `tbl_record_grade`;

CREATE TABLE `tbl_record_grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) DEFAULT NULL,
  `SubjectID` int(11) DEFAULT NULL,
  `FirstGrade` varchar(20) DEFAULT NULL,
  `SecondGrade` varchar(20) DEFAULT NULL,
  `ThirdGrade` varchar(20) DEFAULT NULL,
  `FourthGrade` varchar(20) DEFAULT NULL,
  `OverAllGrade` varchar(20) DEFAULT NULL,
  `Remarks` varchar(120) DEFAULT NULL,
  `TeacherID` int(11) DEFAULT NULL,
  `SchoolYearID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_record_grade` */

insert  into `tbl_record_grade`(`ID`,`StudentID`,`SubjectID`,`FirstGrade`,`SecondGrade`,`ThirdGrade`,`FourthGrade`,`OverAllGrade`,`Remarks`,`TeacherID`,`SchoolYearID`) values (1,1,1,'85','0','0','0','21.25','Failed',20210001,NULL);

/*Table structure for table `tbl_record_quiz` */

DROP TABLE IF EXISTS `tbl_record_quiz`;

CREATE TABLE `tbl_record_quiz` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectID` int(11) DEFAULT NULL,
  `GradingPeriod` int(11) DEFAULT NULL,
  `Title` varchar(220) DEFAULT NULL,
  `Description` varchar(220) DEFAULT NULL,
  `Score` varchar(20) DEFAULT NULL,
  `OverAllItems` varchar(20) DEFAULT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `TeacherID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `SchoolYearID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_record_quiz` */

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
  `ScheduleDayID` int(11) DEFAULT NULL COMMENT '1 - mon 2- tues 3- wed 4 -thurs 5-fri 6-sat 7-sun',
  `SubjectID` int(11) DEFAULT NULL,
  `ScheduleTimeStart` varchar(50) DEFAULT NULL,
  `ScheduleTimeEnd` varchar(50) DEFAULT NULL,
  `AccountID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_schedule` */

insert  into `tbl_schedule`(`ID`,`ScheduleDayID`,`SubjectID`,`ScheduleTimeStart`,`ScheduleTimeEnd`,`AccountID`) values (1,1,1,'15:58:45 PM','15:58:45 PM','1'),(2,1,2,'15:58:45 PM','15:58:45 PM','1'),(3,1,3,'15:58:45 PM','15:58:45 PM','1'),(4,1,4,'15:58:45 PM','15:58:45 PM','1'),(5,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_scheduleday` */

DROP TABLE IF EXISTS `tbl_scheduleday`;

CREATE TABLE `tbl_scheduleday` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Day` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_scheduleday` */

insert  into `tbl_scheduleday`(`ID`,`Day`) values (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),(5,'Friday');

/*Table structure for table `tbl_school_year` */

DROP TABLE IF EXISTS `tbl_school_year`;

CREATE TABLE `tbl_school_year` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `YearFrom` varchar(250) DEFAULT NULL,
  `YearTo` varchar(250) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL COMMENT '1-active 2-inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_school_year` */

insert  into `tbl_school_year`(`ID`,`YearFrom`,`YearTo`,`Status`) values (1,'2021','2022',1);

/*Table structure for table `tbl_school_year_status` */

DROP TABLE IF EXISTS `tbl_school_year_status`;

CREATE TABLE `tbl_school_year_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_school_year_status` */

insert  into `tbl_school_year_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_student_grade_record` */

DROP TABLE IF EXISTS `tbl_student_grade_record`;

CREATE TABLE `tbl_student_grade_record` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) DEFAULT NULL,
  `GradeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_student_grade_record` */

/*Table structure for table `tbl_subject` */

DROP TABLE IF EXISTS `tbl_subject`;

CREATE TABLE `tbl_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Status` int(1) DEFAULT 1 COMMENT '1 - active 2- inactive',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_subject` */

insert  into `tbl_subject`(`ID`,`Code`,`Title`,`Description`,`Status`) values (1,'ENG','English','',1),(2,'SCI','Science','',1),(3,'Fil','Filipino','',1),(4,'Math','Mathematics','',1),(5,'AP','Araling Panlipunan','',1),(6,'T.L.E','Technology and Livielihood Education','',1),(7,'MAPEH','Music, Arts, Physical Education and Health ','',1);

/*Table structure for table `tbl_subject_status` */

DROP TABLE IF EXISTS `tbl_subject_status`;

CREATE TABLE `tbl_subject_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_subject_status` */

insert  into `tbl_subject_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

/*Table structure for table `tbl_teacher` */

DROP TABLE IF EXISTS `tbl_teacher`;

CREATE TABLE `tbl_teacher` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` varchar(50) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_teacher` */

insert  into `tbl_teacher`(`ID`,`AccountID`,`Name`,`Position`,`Status`) values (1,'20210001','English Teacher','Teacher-1',1),(2,'20210002','Science Teacher','Prof I',1),(3,'20210003','Filipino Teacher','Teacher 1',1),(4,'20210004','Math Teacher','Teacher II',1),(5,'20210005','AP Teacher','Teacher I',1),(6,'20210006','TLE Teacher','Teacher II',1),(7,'20210007','MAPEH Teacher','Teacher I',1);

/*Table structure for table `tbl_teacher_status` */

DROP TABLE IF EXISTS `tbl_teacher_status`;

CREATE TABLE `tbl_teacher_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_teacher_status` */

insert  into `tbl_teacher_status`(`ID`,`Status`) values (1,'Active'),(2,'Inactive');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_yearlevel` */

insert  into `tbl_yearlevel`(`ID`,`YearLevel`,`YearLevelStatus`) values (1,'Grade 11',1),(2,'Grade 12',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
