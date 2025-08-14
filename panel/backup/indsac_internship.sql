-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2025 at 03:12 PM
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
-- Database: `indsac_internship`
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
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `mobile`, `email`, `project`, `outcome`, `expected_start_date`, `expected_due_date`, `type`, `status`, `notes`, `createddate`) VALUES
(19, '7635476543', 'om@gmail.com', 'test', 'test', NULL, '2025-08-12', 'Professional Training Program\r\n  ', 'Approved', NULL, '2025-08-13 13:07:45'),
(23, '7635476543', 'om@gmail.com', 'test', 'test', NULL, '2025-08-12', 'Internship & Live Project Support\r\n  ', 'Waitlisted', NULL, '2025-08-14 04:43:22'),
(24, '7635476543', 'om@gmail.com', 'test', 'test', NULL, '2025-08-12', 'Interview & Career Preparation\r\n  ', 'Submitted', NULL, '2025-08-13 13:51:22');

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
(13, 'web development', 'web development', 'test', 'test', '3 MONTS', '2025-08-14', '2025-08-14', 1, 'pune', 'IST', '10000.00', 'INR', 1, '2025-08-14 00:00:00', 10, 1, '2025-08-14 13:02:15', '2025-08-14 13:02:15');

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
  `experience` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `contact`, `college`, `course`, `role`, `resumepath`, `skills`, `image_path`, `experience`) VALUES
(4, 'Nandini Ahire', 'ahirenandini3354@gmail.com', '$2y$10$7qIg0SNAWAV/un5./XkqkedjEKCm/yfkurZQqOviQSdcNywgP.YGm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'xyz', 'xyz@gmail.com', '$2y$10$sFCRCTa07xJcAWa4sjIdz.795/2JDw8drgtlWvWVm76gTP9g4dSte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Nandini Ahire', 'ahirenandini354@gmail.com', '$2y$10$OAxVYvyyq0sBrE2OrbyXh.emTtRVgarxanorHvIF4jhPzbqxK/sKm', '1234567891', 'DAVV', 'B.E/IT', NULL, NULL, NULL, NULL, NULL),
(7, 'asf', 'asdf@gmail.com', '$2y$10$k6a8ARnBrb.PVNFu453fVOIibO/g7N/4Vl.cLPFVxZ0eIlQ87cS1.', '123123123123', '123', '123', NULL, NULL, NULL, NULL, NULL),
(8, '123', '123@gmail.com', '$2y$10$UAvh2HCujDHi/e6VEIF7xecgb.PQB1VfbOZWxlbZUOiA13ZxoiWzW', '123', '123', '123', 'admin', NULL, NULL, NULL, NULL),
(9, 'Sachin Choudhary', 'sachinchoudhary2129@gmail.com', '$2y$10$pkRCj4Rd6Q6PUwKiRPY/eOChatlgfat/GMK4dNRAeD.ulfbE9Q5t2', '123123123123', 'Mumbai University', 'BE', NULL, '../upload/resume/1753720757.pdf', NULL, NULL, NULL),
(10, 'om sharma ', 'om@gmail.com', '$2y$10$0ztwhIZSffUAsVYX/9CaOuFCo/z.cmfdmqwsyZ1L3w/gnnzsGZG0.', '9845162500', 'Pune university', 'BE CSE', 'software developer', '../upload/resume/1754644039.pdf', 'HTML, CSS,JAVA', '', '9years experience'),
(11, 'ram pawar', 'ram@gmail.com', '$2y$10$4HiCeUpDxnIwh8vPOmR0Z.wGHQIJ20Joh4UV6lcoAKt76w36fgcv6', '7896456781', 'coep', 'IT', NULL, NULL, NULL, NULL, NULL),
(12, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'admin', 'admin@admin.com', '$2y$10$J8ZKwIpWSW5s8sC7Mgrd3.JOEf/zQvc/YHfHbUGK3wSK2haGVDWjC', '4512545785', 'c', 'c', 'admin', NULL, NULL, NULL, NULL);

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
-- Indexes for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  ADD PRIMARY KEY (`requirement_id`),
  ADD KEY `program_id` (`program_id`,`sort_order`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- AUTO_INCREMENT for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
