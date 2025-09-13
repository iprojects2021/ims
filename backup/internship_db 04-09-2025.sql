-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 03:06 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `outcome` varchar(255) DEFAULT NULL,
  `expected_start_date` date DEFAULT NULL,
  `expected_due_date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` text,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `mobile`, `email`, `project`, `outcome`, `expected_start_date`, `expected_due_date`, `type`, `status`, `notes`, `createddate`, `amount`, `duration`, `fullname`, `github`) VALUES
(113, '1234567890', 'rohit@gmail.com', 'Internship & Live Project Support', 'f', '2025-09-01', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 10:23:42', '? 8000/-', '6 Months', 'rohit verma', 'https://github.com/'),
(114, '1234567890', 'rohit@gmail.com', 'Internship & Live Project Support', 'f', '2025-09-01', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 10:30:26', '? 8000/-', '6 Months', 'rohit verma', 'https://github.com/'),
(115, '452152461235', 'om@gmail.com', 'Internship & Live Project Support', 'h', '2025-09-16', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 11:35:37', '? 8000/-', '6 Months', 'sachin', 'https://github.com/'),
(116, '452152461235', 'om@gmail.com', 'Internship & Live Project Support', 'gggggg', '2025-10-01', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 11:51:13', '? 8000/-', '6 Months', 'new', 'https://github.com/'),
(117, 'd', 'h@gmail.com', 'Internship & Live Project Support', 'h', '2025-09-16', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 12:06:52', '? 8000/-', '6 Months', 'new', 'https://github.com/'),
(118, '1234567890', 'om@gmail.com', 'Internship & Live Project Support', 'f', '2025-09-15', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 12:17:46', '? 8000/-', '6 Months', 'sachin', ''),
(119, 'g', 'g@gmail.com', 'Internship & Live Project Support', 'dddddddddddddddddddd', '2025-09-23', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 13:11:27', '? 8000/-', '6 Months', 'g', ''),
(120, 'g', 'g@gmail.com', 'Internship & Live Project Support', 'dddddddddddddddddddd', '2025-09-23', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 13:12:04', '? 8000/-', '6 Months', 'g', ''),
(121, '6', 'k@gmail.com', 'Internship & Live Project Support', 'd', '2025-09-24', NULL, 'Elite', 'Submitted', NULL, '2025-09-01 13:26:17', '? 8000/-', '6 Months', 'k', ''),
(122, '123', 'om@gmail.com', 'Internship & Live Project Support', 'test', '2025-09-16', NULL, 'Elite', 'Submitted', NULL, '2025-09-02 06:51:43', '? 8000/-', '6 Months', 'om sharma', ''),
(123, '1234567890', 'sachin@gmail.com', 'Internship & Live Project Support', 'test', '2025-09-16', NULL, 'Advanced', 'Submitted', NULL, '2025-09-02 07:45:28', '?3,000/-', '1 Month', 'sachin sharma', ''),
(124, '123', 'om@gmaiil.com', 'Internship & Live Project Support', 'd', '2025-09-23', NULL, 'Advanced', 'Submitted', NULL, '2025-09-02 08:22:41', '?3,000/-', '1 Month', 'om sharma', '');

-- --------------------------------------------------------

--
-- Table structure for table `application_steps`
--

CREATE TABLE `application_steps` (
  `step_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_steps`
--

INSERT INTO `application_steps` (`step_id`, `program_id`, `description`, `sort_order`) VALUES
(1, 1, 'Online application form', 1),
(2, 1, 'Basic PHP coding test (30 mins)', 2),
(3, 1, 'Technical interview with senior developer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `daily_schedules`
--

CREATE TABLE `daily_schedules` (
  `schedule_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `activity` text NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_schedules`
--

INSERT INTO `daily_schedules` (`schedule_id`, `program_id`, `time`, `activity`, `sort_order`) VALUES
(1, 1, '9:30 AM', 'Daily standup call with team', 1),
(2, 1, '10 AM - 12 PM', 'Project development time', 2),
(3, 1, '2 PM - 3 PM', 'Mentor session/code review', 3),
(4, 1, '3 PM - 5 PM', 'Independent work/learning', 4);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `education_level` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `remark` text,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `studentid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `education_level`, `file_path`, `remark`, `uploaded_at`, `studentid`, `status`) VALUES
(86, '10th', 'uploads/1755852356_test.pdf', 'test', '2025-08-22 08:45:56', 10, 'uploaded'),
(87, 'Graduation', 'uploads/1756562990_test.pdf', 'test', '2025-08-30 14:09:50', 10, 'uploaded');

-- --------------------------------------------------------

--
-- Table structure for table `eligibility_requirements`
--

CREATE TABLE `eligibility_requirements` (
  `requirement_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_mandatory` tinyint(1) DEFAULT '1',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eligibility_requirements`
--

INSERT INTO `eligibility_requirements` (`requirement_id`, `program_id`, `description`, `is_mandatory`, `sort_order`) VALUES
(1, 1, 'Basic PHP/HTML knowledge', 1, 1),
(2, 1, 'Familiarity with Git version control', 1, 2),
(3, 1, 'Personal laptop with VS Code installed', 1, 3),
(4, 1, 'Portfolio/GitHub profile (optional)', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `referralid` int(11) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `enrollmentdate` date DEFAULT NULL,
  `fee_paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `referralid`, `program`, `enrollmentdate`, `fee_paid`) VALUES
(4, 8, 'TFFFFFFFF', '2025-08-26', '0.00'),
(5, 8, 'F', '2025-08-26', '0.00'),
(6, 12, 'test', '2025-08-26', '0.00'),
(7, 12, 'test', '2025-08-26', '0.00'),
(8, 16, 'f', '2025-08-26', '0.00'),
(9, 12, 'test', '2025-08-28', '0.00'),
(10, 8, 'Internship & Live Project Support', '2025-09-01', '0.00'),
(11, 8, 'Internship & Live Project Support', '2025-09-01', '0.00'),
(12, 8, 'Internship & Live Project Support', '2025-09-01', '0.00'),
(13, 8, 'Internship & Live Project Support', '2025-09-01', '0.00'),
(14, 8, 'Internship & Live Project Support', '2025-09-01', '0.00'),
(15, 8, 'Internship & Live Project Support', '2025-09-01', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intern_task_progress`
--

CREATE TABLE `intern_task_progress` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `status` enum('not started','in progress','completed') DEFAULT 'not started',
  `submitted_on` date DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learning_outcomes`
--

CREATE TABLE `learning_outcomes` (
  `outcome_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_technical` tinyint(1) DEFAULT '1',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learning_outcomes`
--

INSERT INTO `learning_outcomes` (`outcome_id`, `program_id`, `description`, `is_technical`, `sort_order`) VALUES
(1, 1, 'Core PHP + OOP concepts', 1, 1),
(2, 1, 'Laravel framework fundamentals', 1, 2),
(3, 1, 'REST API development', 1, 3),
(4, 1, 'Agile workflow experience', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mentorship_details`
--

CREATE TABLE `mentorship_details` (
  `mentorship_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `resources_provided` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mentorship_details`
--

INSERT INTO `mentorship_details` (`mentorship_id`, `program_id`, `description`, `frequency`, `format`, `resources_provided`) VALUES
(1, 1, 'Weekly code reviews and 1:1 feedback sessions', 'Weekly', '1:1', 'Udemy PHP courses, Laravel documentation access');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `referralid` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `status` enum('Pending','Completed','Failed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentverification`
--

CREATE TABLE `paymentverification` (
  `PaymentVerificationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PaymentID` varchar(50) DEFAULT NULL,
  `BankRRN` varchar(50) DEFAULT NULL,
  `OrderID` varchar(50) DEFAULT NULL,
  `InvoiceID` varchar(50) DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `AmountPaid` decimal(15,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Notes` text,
  `Refund` varchar(22) DEFAULT NULL,
  `VerifiedBy` varchar(100) DEFAULT NULL,
  `VerificationStatus` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `VerificationDate` datetime DEFAULT NULL,
  `VerifyNotes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentverification`
--

INSERT INTO `paymentverification` (`PaymentVerificationID`, `UserID`, `PaymentID`, `BankRRN`, `OrderID`, `InvoiceID`, `PaymentMethod`, `Email`, `Phone`, `AmountPaid`, `Status`, `Notes`, `Refund`, `VerifiedBy`, `VerificationStatus`, `CreateDate`, `VerificationDate`, `VerifyNotes`) VALUES
(267, 13, 'pay_RCLkAWcY3Luw0G', '12345', '1234', '1234', 'g', 'om@gmail.com', '12333555445', '1.00', 'Success', 'ggggggggggggggggggg', 'No', 'admin', 'Pending', '2025-09-03 00:00:00', '2025-10-03 00:00:00', 'ggggggg');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `detailed_description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_remote` tinyint(1) DEFAULT '1',
  `location` varchar(100) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `stipend_amount` decimal(10,2) DEFAULT NULL,
  `stipend_currency` varchar(3) DEFAULT 'USD',
  `is_paid` tinyint(1) DEFAULT '0',
  `application_deadline` datetime DEFAULT NULL,
  `max_applicants` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `title`, `slug`, `short_description`, `detailed_description`, `duration`, `start_date`, `end_date`, `is_remote`, `location`, `timezone`, `stipend_amount`, `stipend_currency`, `is_paid`, `application_deadline`, `max_applicants`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PHP Development Internship', 'php-development-internship', '3-month remote internship to build real PHP projects with mentorship', 'This intensive program provides hands-on experience with PHP, Laravel, and MySQL while working on live projects. Perfect for aspiring backend developers.', '3 months', '2024-07-15', NULL, 1, NULL, NULL, '10000.00', 'USD', 1, '2024-06-30 23:59:59', 20, 1, '2025-08-14 05:50:59', '2025-08-14 05:50:59'),
(2, 'test', 'test', 'test', 'test', 'test', '2025-08-14', NULL, 1, 'pune', NULL, '5000.00', 'INR', 0, '2025-08-15 00:00:00', 10, 1, '2025-08-14 08:13:13', '2025-08-14 08:13:13'),
(5, 'WEB', 'WEB', 'WEB', 'WEB', '3 MONTS', '2025-08-14', NULL, 1, 'MUMBAI', 'IST', '10000.00', 'INR', 1, '2025-08-14 00:00:00', 30, 1, '2025-08-14 08:16:30', '2025-08-14 08:16:30'),
(6, 'WEB1', 'WEB1', 'WEB', 'WEB', '3 MONTS', '2025-08-14', NULL, 1, 'MUMBAI', 'IST', '10000.00', 'INR', 1, '2025-08-14 00:00:00', 30, 1, '2025-08-14 08:18:17', '2025-08-14 08:18:17'),
(7, 'php', 'php', 'php', 'php', '3 MONTS', '2025-08-14', NULL, 1, 'pune', 'IST', '10000.00', 'INR', 1, '2025-08-13 00:00:00', 10, 1, '2025-08-14 08:22:24', '2025-08-14 08:22:24'),
(8, 'final', 'final', 'final', 'final', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'pune', 'IST', '50000.00', 'INR', 1, '2025-08-14 00:00:00', 10, 1, '2025-08-14 08:27:55', '2025-08-14 08:27:55'),
(9, 'html', 'html', 'html', 'html', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'MUMBAI', 'IST', '10000.00', 'INR', 1, '2025-08-14 00:00:00', 20, 1, '2025-08-14 08:30:22', '2025-08-14 08:30:22'),
(10, 'css', 'css', 'css', 'css', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'MUMBAI', 'IST', '50000.00', 'INR', 1, '2025-08-14 00:00:00', 20, 1, '2025-08-14 08:38:53', '2025-08-14 08:38:53'),
(11, 'java', 'java', 'java', 'java', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'pune', 'IST', '5000.00', 'INR', 1, '2025-08-14 00:00:00', 100, 1, '2025-08-14 12:46:26', '2025-08-14 12:46:26'),
(12, 'javascript', 'javascript', 'javascript', 'javascript', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'pune', 'IST', '5000.00', 'INR', 1, '2025-08-14 00:00:00', 70, 1, '2025-08-14 12:54:34', '2025-08-14 12:54:34'),
(13, 'web development', 'web development', 'test', 'test', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'pune', 'IST', '10000.00', 'INR', 1, '2025-08-14 00:00:00', 10, 1, '2025-08-14 13:02:15', '2025-08-14 13:02:15'),
(14, 'f', 'f', 'f', 'f', '5', '2025-08-26', '2025-08-27', 1, 'pune', 'IST', '5000.00', 'INR', 1, '2025-08-26 00:00:00', 1, 1, '2025-08-26 05:44:04', '2025-08-26 05:44:04'),
(15, 'newtest', 'newtest', 'newtest', 'new test', '10 months', '2025-09-03', '2025-09-03', 0, 'pune', 'IST', '10000.00', 'INR', 0, '2025-09-17 00:00:00', 11, 1, '2025-09-03 06:03:38', '2025-09-03 06:03:38'),
(16, 'GGGGGG', 'GGGGGGG', 'GGGGGGGG', 'GGGGGGGGGG', '10 months', '2025-09-02', '2025-10-11', 1, 'pune', 'IST', '1111111.00', 'INR', 1, '2025-09-04 00:00:00', 111, 1, '2025-09-03 06:08:14', '2025-09-03 06:08:14'),
(17, 'finaltest', 'finaltest', 'finaltest', 'final test', '5 months', '2025-09-03', '2025-09-03', 0, 'pune', 'IST', '10000.00', 'INR', 0, '2025-09-23 00:00:00', 111111111, 1, '2025-09-03 06:11:27', '2025-09-03 06:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `programs1`
--

CREATE TABLE `programs1` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `duration` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program_categories`
--

CREATE TABLE `program_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_categories`
--

INSERT INTO `program_categories` (`category_id`, `name`, `description`, `created_at`) VALUES
(1, 'Web Development', NULL, '2025-08-14 05:50:59'),
(2, 'Backend Programming', NULL, '2025-08-14 05:50:59'),
(3, 'Open Source', NULL, '2025-08-14 05:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `program_category_map`
--

CREATE TABLE `program_category_map` (
  `program_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_category_map`
--

INSERT INTO `program_category_map` (`program_id`, `category_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `program_faqs`
--

CREATE TABLE `program_faqs` (
  `faq_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_faqs`
--

INSERT INTO `program_faqs` (`faq_id`, `program_id`, `question`, `answer`, `sort_order`) VALUES
(1, 1, 'Is this internship remote?', 'Yes, this is a fully remote position with flexible hours', 1),
(2, 1, 'Can beginners apply?', 'Yes! We accept motivated learners with basic programming knowledge', 2);

-- --------------------------------------------------------

--
-- Table structure for table `program_media`
--

CREATE TABLE `program_media` (
  `media_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `media_type` enum('image','video','document') NOT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_media`
--

INSERT INTO `program_media` (`media_id`, `program_id`, `url`, `alt_text`, `media_type`, `sort_order`) VALUES
(1, 1, 'https://example.com/images/php-internship.jpg', 'Team working on PHP project', 'image', 0),
(2, 1, 'https://example.com/videos/overview.mp4', 'Program overview video', 'video', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_perks`
--

CREATE TABLE `program_perks` (
  `perk_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_perks`
--

INSERT INTO `program_perks` (`perk_id`, `program_id`, `description`, `icon`, `sort_order`) VALUES
(1, 1, '?10K/month stipend + performance bonus', 'money-bill-wave', 1),
(2, 1, 'Certificate of completion', 'certificate', 2),
(3, 1, 'Letter of recommendation for top performers', 'envelope', 3);

-- --------------------------------------------------------

--
-- Table structure for table `program_responsibilities`
--

CREATE TABLE `program_responsibilities` (
  `responsibility_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_responsibilities`
--

INSERT INTO `program_responsibilities` (`responsibility_id`, `program_id`, `description`, `sort_order`) VALUES
(1, 1, 'Develop and maintain PHP-based web applications', 1),
(2, 1, 'Debug and optimize existing Laravel codebases', 2),
(3, 1, 'Integrate MySQL databases with PHP applications', 3),
(4, 1, 'Collaborate with frontend developers using Git', 4);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `referred_email` varchar(150) DEFAULT NULL,
  `referred_phone` varchar(20) DEFAULT NULL,
  `status` enum('Pending','Enrolled','Paid') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `userid`, `referred_email`, `referred_phone`, `status`, `created_at`) VALUES
(8, 20, 'rohit@gmail.com', 'null', 'Enrolled', '2025-08-25 11:53:17'),
(12, 20, 'k1@gmail.com', 'null', 'Enrolled', '2025-08-25 12:37:18'),
(16, 20, 'o@gmail.com', 'null', 'Enrolled', '2025-08-26 13:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `document_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `is_optional` tinyint(1) DEFAULT '0',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `required_documents`
--

INSERT INTO `required_documents` (`document_id`, `program_id`, `name`, `description`, `is_optional`, `sort_order`) VALUES
(1, 1, 'Resume', 'PDF format preferred', 0, 0),
(2, 1, 'Cover Letter', 'Explain why you want this internship', 0, 0),
(3, 1, 'GitHub Profile', 'Optional but recommended', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sample_projects`
--

CREATE TABLE `sample_projects` (
  `project_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_projects`
--

INSERT INTO `sample_projects` (`project_id`, `program_id`, `title`, `description`, `technologies`, `sort_order`) VALUES
(1, 1, 'Hotel Booking System', 'Build a full-stack reservation system with user authentication', 'PHP, Laravel, MySQL', 1),
(2, 1, 'API Migration', 'Convert legacy SOAP API to RESTful endpoints', 'PHP, Postman', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `referral_code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) DEFAULT 'Open',
  `assignedto` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `studentid`, `subject`, `message`, `status`, `assignedto`, `filename`, `createdate`, `createdby`) VALUES
(15, 10, 'hello', 'system problem', 'New', NULL, '1755601154_test.pdf', '2025-08-19 16:29:14', 10),
(16, 11, 'ok', 'ok', 'New', NULL, NULL, '2025-08-20 14:41:26', 11),
(17, 10, 'ff', 'ff', 'New', NULL, '1755767616_test.pdf', '2025-08-21 14:43:36', 10),
(18, 10, 'fffffffffffffffffffffffff', 'kkkkkkkkkkkkkk', 'New', NULL, NULL, '2025-08-21 14:44:07', 10),
(19, 10, 'new', 'new', 'New', NULL, '1756534248_test.pdf', '2025-08-30 11:40:48', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomment`
--

CREATE TABLE `ticketcomment` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `message` text,
  `filename` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketcomment`
--

INSERT INTO `ticketcomment` (`id`, `ticketid`, `message`, `filename`, `createdate`, `createdby`) VALUES
(46, 15, 'ok', NULL, '2025-08-19 16:29:59', '13'),
(47, 15, 'check', NULL, '2025-08-19 16:31:31', '13'),
(48, 15, 'solved', NULL, '2025-08-19 16:34:56', '13'),
(49, 15, 'test', NULL, '2025-08-19 17:10:49', '13'),
(50, 15, 'kkk', NULL, '2025-08-20 12:29:21', '13'),
(51, 15, 'g', NULL, '2025-08-20 15:12:13', '13'),
(52, 15, 'ok', NULL, '2025-08-20 15:14:09', '13'),
(53, 15, 'lllllllllllllllllllllllll', NULL, '2025-08-20 15:14:32', '13'),
(54, 15, 'yes', NULL, '2025-08-20 15:17:43', '13'),
(55, 15, 'f', NULL, '2025-08-20 18:00:46', '13'),
(56, 15, 'h', NULL, '2025-08-21 13:09:22', '13'),
(57, 15, 'j', NULL, '2025-08-21 13:22:24', '13'),
(58, 16, 'j', NULL, '2025-08-21 13:23:10', '13'),
(59, 15, 'h', NULL, '2025-08-21 14:49:03', '10'),
(60, 15, 'new', NULL, '2025-08-21 14:53:06', '10'),
(61, 15, 'g', NULL, '2025-08-21 15:02:30', '10'),
(62, 15, 'h', NULL, '2025-08-21 15:03:23', '10'),
(63, 15, 'f', NULL, '2025-08-25 10:19:43', '13'),
(64, 0, 'ggggggggg', NULL, '2025-08-25 10:34:33', '13'),
(65, 0, 'f', NULL, '2025-08-25 10:35:32', '13'),
(66, 0, 'f', NULL, '2025-08-25 10:36:09', '13'),
(67, 0, 'f', NULL, '2025-08-25 10:41:09', '13'),
(68, 0, 'fff', NULL, '2025-08-25 10:43:18', '13'),
(69, 0, 'f', NULL, '2025-08-25 10:47:07', '13'),
(70, 17, 'j', NULL, '2025-08-25 10:48:07', '13'),
(71, 17, 'f', NULL, '2025-08-25 11:01:54', '13'),
(72, 17, 'y', NULL, '2025-08-25 11:10:43', '13'),
(73, 0, 'kk', NULL, '2025-08-25 11:14:37', '13'),
(74, 15, 'kkkkkkkkkkkkkkkkkk', NULL, '2025-08-25 11:15:17', '13'),
(75, 17, 'best', NULL, '2025-08-25 11:30:21', '13'),
(76, 17, 'f', NULL, '2025-08-25 11:31:04', '13'),
(77, 15, 'test', NULL, '2025-08-26 11:11:44', '13');

-- --------------------------------------------------------

--
-- Table structure for table `ticketstatushistory`
--

CREATE TABLE `ticketstatushistory` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `changed_by` int(11) NOT NULL,
  `previous_status` varchar(50) NOT NULL,
  `new_status` varchar(50) NOT NULL,
  `comment` text,
  `changed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketstatushistory`
--

INSERT INTO `ticketstatushistory` (`id`, `ticketid`, `changed_by`, `previous_status`, `new_status`, `comment`, `changed_at`) VALUES
(61, 15, 13, '', 'New', 'g', '2025-08-20 09:42:26'),
(62, 15, 13, '', 'New', 'ok', '2025-08-20 09:43:51'),
(63, 15, 13, '', 'New', 'g', '2025-08-20 09:46:24'),
(64, 15, 13, '', 'In-Progress', 'g', '2025-08-20 09:47:21'),
(65, 15, 13, '', 'New', 'h', '2025-08-20 12:29:41'),
(66, 15, 13, '', 'New', 'g', '2025-08-20 12:30:52'),
(67, 15, 13, '', 'In-Progress', 'h', '2025-08-21 07:39:36'),
(68, 15, 13, '', 'New', 'h', '2025-08-21 07:45:47'),
(69, 15, 13, '', 'Close', 'j', '2025-08-21 07:46:40'),
(70, 16, 13, '', 'New', 'j', '2025-08-21 07:47:17'),
(71, 15, 13, '', 'New', 'k', '2025-08-21 07:52:17'),
(72, 16, 13, '', 'New', 'g', '2025-08-21 07:52:57'),
(73, 15, 13, '', 'In-Progress', '', '2025-08-26 05:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `userattendance`
--

CREATE TABLE `userattendance` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `logintime` datetime DEFAULT NULL,
  `logouttime` datetime DEFAULT NULL,
  `notes` text,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userattendance`
--

INSERT INTO `userattendance` (`id`, `userid`, `logintime`, `logouttime`, `notes`, `createdat`) VALUES
(18, 10, '2025-09-04 18:31:17', '2025-09-04 18:35:07', NULL, '2025-09-04 13:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `userdaytracker`
--

CREATE TABLE `userdaytracker` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `notes` text,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userhourlytracker`
--

CREATE TABLE `userhourlytracker` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `notes` text,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userhourlytracker`
--

INSERT INTO `userhourlytracker` (`id`, `userid`, `start_time`, `end_time`, `notes`, `createdate`) VALUES
(62, 10, '21:31', '18:35', 'hh', '2025-09-04 13:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `college` varchar(150) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `resumepath` varchar(45) DEFAULT NULL,
  `skills` varchar(300) DEFAULT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `experience` varchar(20) DEFAULT NULL,
  `referredby` varchar(50) DEFAULT NULL,
  `refercode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `contact`, `college`, `course`, `role`, `resumepath`, `skills`, `image_path`, `experience`, `referredby`, `refercode`) VALUES
(4, 'Nandini Ahire', 'ahirenandini3354@gmail.com', '$2y$10$7qIg0SNAWAV/un5./XkqkedjEKCm/yfkurZQqOviQSdcNywgP.YGm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'xyz', 'xyz@gmail.com', '$2y$10$sFCRCTa07xJcAWa4sjIdz.795/2JDw8drgtlWvWVm76gTP9g4dSte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Nandini Ahire', 'ahirenandini354@gmail.com', '$2y$10$OAxVYvyyq0sBrE2OrbyXh.emTtRVgarxanorHvIF4jhPzbqxK/sKm', '1234567891', 'DAVV', 'B.E/IT', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'asf', 'asdf@gmail.com', '$2y$10$k6a8ARnBrb.PVNFu453fVOIibO/g7N/4Vl.cLPFVxZ0eIlQ87cS1.', '123123123123', '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '123', '123@gmail.com', '$2y$10$UAvh2HCujDHi/e6VEIF7xecgb.PQB1VfbOZWxlbZUOiA13ZxoiWzW', '123', '123', '123', 'admin', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Sachin Choudhary', 'sachinchoudhary2129@gmail.com', '$2y$10$pkRCj4Rd6Q6PUwKiRPY/eOChatlgfat/GMK4dNRAeD.ulfbE9Q5t2', '123123123123', 'Mumbai University', 'BE', NULL, '../upload/resume/1753720757.pdf', NULL, NULL, NULL, NULL, NULL),
(10, 'om sharma ', 'om@gmail.com', '$2y$10$0ztwhIZSffUAsVYX/9CaOuFCo/z.cmfdmqwsyZ1L3w/gnnzsGZG0.', '9845162500', 'Pune university', 'BE CSE', 'student', '../upload/resume/1754644039.pdf', 'HTML, CSS,JAVA', '', '4years experience', NULL, NULL),
(11, 'ram pawar', 'ram@gmail.com', '$2y$10$4HiCeUpDxnIwh8vPOmR0Z.wGHQIJ20Joh4UV6lcoAKt76w36fgcv6', '7896456781', 'coep', 'IT', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'admin', 'admin@admin.com', '$2y$10$J8ZKwIpWSW5s8sC7Mgrd3.JOEf/zQvc/YHfHbUGK3wSK2haGVDWjC', '4512545785', 'c', 'c', 'admin', NULL, '', NULL, '1', NULL, NULL),
(14, 'raj sharama', 'raj@gmail.com', '$2y$10$/fLX.0EtVjbTxmHvS6v7MuoVAPwOBmNeWM1B4HQd4pT4C7Se.fg52', '45215685254', 'c', 'c', 'student', '../upload/resume/1755582225.pdf', '', NULL, '1', NULL, NULL),
(15, 'rohit pawar', 'rohit@gmail.com', '$2y$10$dyIlq32PEOOHNNBIYiLUL.HYf8PqEUwSyamvEMHWEhxH90RJKbBr2', '45215685254', 'd', 'd', 'student', NULL, '', NULL, '3', NULL, NULL),
(16, 'admin', 'admin@gmail.com', '$2y$10$HhPC.r4bTvnCS.NfpbiIgOYnQcwr33VvFS5s2n3zsLaKuK2gGZ3sS', '4444515512', 'v', 'v', 'admin', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'sanket pawar', 'sanket@gmail.com', '$2y$10$qikfH75Gxk1Vg00Ctou8u.SAoLWUD9cq9/dhVQyHgkBZGSSDfUk5G', '4565245654', 'f', 'f', 'student', NULL, '', NULL, '', 'ddddddddddddddddddddddddddddd', 'SANKET-6H5I01'),
(21, 'raj sharama', 'raj1@gmail.com', '$2y$10$rHcXQFNxINuxu.sQ/doyfO/a6xaTLthfQq4Bes15TQQWGSZNKUz.G', '4565245654', 'd', 'd', 'student', NULL, NULL, NULL, NULL, 'd', 'RAJ-ON8URC'),
(22, 'ss verma', 'ss@gmail.com', '$2y$10$9L.i3msdr6dT5UPe5ebdp.ZEgM.rKBqVgUW84lxNiOBtooKy75fjy', '4565245654', 'ttttttt', 'tttttttttttt', 'student', NULL, NULL, NULL, NULL, '', 'SS-62OMWH'),
(23, 'kk', 'kk@gmail.com', '$2y$10$wbPa1L46mPKNYL7t8Tmst.blCWY8FRCPEK4OUox4OLUq0dazlURKS', '4565245654', 'd', 'd', 'student', NULL, NULL, NULL, NULL, 'SS-62OMWH', 'KK-GOAFWX'),
(24, 'k k', 'k@gmail.com', '$2y$10$9d0UBDT2ZZ7Y/0uSOwvQLe.XcQtbQ8lTYQ36BakE/JT04VL810M5i', '4545145125', 'k', 'k', 'student', NULL, NULL, NULL, NULL, 'k', 'K-QP3JMO'),
(25, 'ggg gg', 'g@gmail.com', '$2y$10$I4APLvqGlm4WXmLSNoNPFOa2BguhdgintWzfSM/dd6KbqDPHtijeu', '4545145125', 'd', 'd', 'student', NULL, NULL, NULL, NULL, '', 'GGG-14UQ6F'),
(26, 'f f', 'f@gmail.com', '$2y$10$F1vGc2RTaLuWSQqvMNPUI.BKUBYIH65lQWGvMvgLiecas9jxxvDXq', '4545145125', 'g', 'g', 'student', NULL, NULL, NULL, NULL, '', 'F-6N9FSD'),
(27, 'll ll', 'll@gmail.com', '$2y$10$1o/Qs/7OwGppxB0MgIETVufFuYd31DG372rUA6KrKgB.dXYsn0fSu', '4545145125', 'f', 'f', 'student', NULL, NULL, NULL, NULL, '', 'LL-3IY4XD'),
(28, 'gg', 'gg@gmail.com', '$2y$10$0acQYkFy8DpF2Hx1i1FpF.24yYg8te7BFiljjCzuSxcVQCLAMss6K', '4545145125', 'd', 'd', 'student', NULL, NULL, NULL, NULL, '', 'GG-O681FG'),
(29, 'sd gg', 'd@gmail.com', '$2y$10$CFzHD6FizT5xkbe7o91mM.DMf7saSNehrIC4rncouqfycG5ngRBYS', '4545145125', 's', 'd', 'student', NULL, NULL, NULL, NULL, '', 'SD-KGOSY3'),
(30, 'p s', 'p@gmail.com', '$2y$10$2HC0Kujdxy43S6kENKU3JO7pEhQ0HmCQAoif7eyeM8K77A51slICy', '4545145125', 'k', 'l', 'student', NULL, NULL, NULL, NULL, 'l', 'P-F74XBY'),
(31, 'mm m', 'm@gmail.com', '$2y$10$wKhdmRQJwt2Mq.o0i6y/3ukubsdllXo5WDDIxjlu1r5MH3aFrcY8S', '4545145125', 'd', 'd', 'student', NULL, NULL, NULL, NULL, '', 'MM-HBQNZV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_steps`
--
ALTER TABLE `application_steps`
  ADD PRIMARY KEY (`step_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `daily_schedules`
--
ALTER TABLE `daily_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  ADD PRIMARY KEY (`requirement_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referralid` (`referralid`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `intern_task_progress`
--
ALTER TABLE `intern_task_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `learning_outcomes`
--
ALTER TABLE `learning_outcomes`
  ADD PRIMARY KEY (`outcome_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `mentorship_details`
--
ALTER TABLE `mentorship_details`
  ADD PRIMARY KEY (`mentorship_id`),
  ADD UNIQUE KEY `program_id` (`program_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referralid` (`referralid`);

--
-- Indexes for table `paymentverification`
--
ALTER TABLE `paymentverification`
  ADD PRIMARY KEY (`PaymentVerificationID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `application_deadline` (`application_deadline`);

--
-- Indexes for table `programs1`
--
ALTER TABLE `programs1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `program_categories`
--
ALTER TABLE `program_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `program_category_map`
--
ALTER TABLE `program_category_map`
  ADD PRIMARY KEY (`program_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `program_faqs`
--
ALTER TABLE `program_faqs`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `program_media`
--
ALTER TABLE `program_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `program_perks`
--
ALTER TABLE `program_perks`
  ADD PRIMARY KEY (`perk_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `program_responsibilities`
--
ALTER TABLE `program_responsibilities`
  ADD PRIMARY KEY (`responsibility_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `sample_projects`
--
ALTER TABLE `sample_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `referral_code` (`referral_code`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketstatushistory`
--
ALTER TABLE `ticketstatushistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticketid`),
  ADD KEY `changed_by` (`changed_by`);

--
-- Indexes for table `userattendance`
--
ALTER TABLE `userattendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `userdaytracker`
--
ALTER TABLE `userdaytracker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `userhourlytracker`
--
ALTER TABLE `userhourlytracker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `application_steps`
--
ALTER TABLE `application_steps`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daily_schedules`
--
ALTER TABLE `daily_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intern_task_progress`
--
ALTER TABLE `intern_task_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learning_outcomes`
--
ALTER TABLE `learning_outcomes`
  MODIFY `outcome_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mentorship_details`
--
ALTER TABLE `mentorship_details`
  MODIFY `mentorship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentverification`
--
ALTER TABLE `paymentverification`
  MODIFY `PaymentVerificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `programs1`
--
ALTER TABLE `programs1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_categories`
--
ALTER TABLE `program_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_faqs`
--
ALTER TABLE `program_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_media`
--
ALTER TABLE `program_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_perks`
--
ALTER TABLE `program_perks`
  MODIFY `perk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_responsibilities`
--
ALTER TABLE `program_responsibilities`
  MODIFY `responsibility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sample_projects`
--
ALTER TABLE `sample_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `ticketstatushistory`
--
ALTER TABLE `ticketstatushistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `userattendance`
--
ALTER TABLE `userattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userdaytracker`
--
ALTER TABLE `userdaytracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userhourlytracker`
--
ALTER TABLE `userhourlytracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_steps`
--
ALTER TABLE `application_steps`
  ADD CONSTRAINT `application_steps_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_schedules`
--
ALTER TABLE `daily_schedules`
  ADD CONSTRAINT `daily_schedules_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  ADD CONSTRAINT `eligibility_requirements_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`referralid`) REFERENCES `referrals` (`id`);

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `interns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `intern_task_progress`
--
ALTER TABLE `intern_task_progress`
  ADD CONSTRAINT `intern_task_progress_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `intern_task_progress_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `learning_outcomes`
--
ALTER TABLE `learning_outcomes`
  ADD CONSTRAINT `learning_outcomes_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `mentorship_details`
--
ALTER TABLE `mentorship_details`
  ADD CONSTRAINT `mentorship_details_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`referralid`) REFERENCES `referrals` (`id`);

--
-- Constraints for table `programs1`
--
ALTER TABLE `programs1`
  ADD CONSTRAINT `programs1_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `program_category_map`
--
ALTER TABLE `program_category_map`
  ADD CONSTRAINT `program_category_map_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_category_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `program_categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `program_faqs`
--
ALTER TABLE `program_faqs`
  ADD CONSTRAINT `program_faqs_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `program_media`
--
ALTER TABLE `program_media`
  ADD CONSTRAINT `program_media_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `program_perks`
--
ALTER TABLE `program_perks`
  ADD CONSTRAINT `program_perks_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `program_responsibilities`
--
ALTER TABLE `program_responsibilities`
  ADD CONSTRAINT `program_responsibilities_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD CONSTRAINT `required_documents_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `sample_projects`
--
ALTER TABLE `sample_projects`
  ADD CONSTRAINT `sample_projects_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs1` (`id`);

--
-- Constraints for table `ticketstatushistory`
--
ALTER TABLE `ticketstatushistory`
  ADD CONSTRAINT `ticketstatushistory_ibfk_1` FOREIGN KEY (`ticketid`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `ticketstatushistory_ibfk_2` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `userattendance`
--
ALTER TABLE `userattendance`
  ADD CONSTRAINT `userattendance_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `userdaytracker`
--
ALTER TABLE `userdaytracker`
  ADD CONSTRAINT `userdaytracker_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `userhourlytracker`
--
ALTER TABLE `userhourlytracker`
  ADD CONSTRAINT `userhourlytracker_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
