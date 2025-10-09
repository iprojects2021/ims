-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 05:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `notes` text DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `paymentverificationid` int(22) NOT NULL,
  `mentorid` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `application`
--


-- --------------------------------------------------------

--
-- Table structure for table `applicationstatus`
--

CREATE TABLE `applicationstatus` (
  `id` int(11) NOT NULL,
  `applicationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `oldstatus` varchar(100) DEFAULT NULL,
  `newstatus` varchar(100) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicationstatus`
--


-- --------------------------------------------------------

--
-- Table structure for table `application_steps`
--

CREATE TABLE `application_steps` (
  `step_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `application_steps`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `daily_schedules`
--


-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `education_level` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `studentid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `documents`
--


-- --------------------------------------------------------

--
-- Table structure for table `eligibility_requirements`
--

CREATE TABLE `eligibility_requirements` (
  `requirement_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_mandatory` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `eligibility_requirements`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `enrollments`
--

-- --------------------------------------------------------

--
-- Table structure for table `innovationideas`
--

CREATE TABLE `innovationideas` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `technology` varchar(255) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `links` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `submitted_at` datetime DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `views_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `innovationideas`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_outcomes`
--

CREATE TABLE `learning_outcomes` (
  `outcome_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_technical` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `learning_outcomes`
--


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
  `resources_provided` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mentorship_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `userid` varchar(22) NOT NULL,
  `menu_item` varchar(255) NOT NULL,
  `isread` tinyint(1) DEFAULT 0,
  `message` text DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--


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
  `Notes` text DEFAULT NULL,
  `Refund` varchar(22) DEFAULT NULL,
  `VerifiedBy` varchar(100) DEFAULT NULL,
  `VerificationStatus` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT current_timestamp(),
  `VerificationDate` datetime DEFAULT NULL,
  `VerifyNotes` text DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `applicationid` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paymentverification`
--

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `detailed_description` text DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `start_date` varchar(100) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_remote` tinyint(1) DEFAULT 1,
  `location` varchar(100) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `stipend_amount` decimal(10,2) DEFAULT NULL,
  `stipend_currency` varchar(3) DEFAULT 'USD',
  `is_paid` tinyint(1) DEFAULT 0,
  `application_deadline` varchar(100) DEFAULT NULL,
  `max_applicants` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `SuperProgram` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `programtype` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `mentorid` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `programs`
--

-- --------------------------------------------------------

--
-- Table structure for table `programs1`
--

CREATE TABLE `programs1` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_categories`
--

CREATE TABLE `program_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_category_map`
--

CREATE TABLE `program_category_map` (
  `program_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_category_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_faqs`
--

CREATE TABLE `program_faqs` (
  `faq_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_faqs`
--


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
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_media`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_perks`
--

CREATE TABLE `program_perks` (
  `perk_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_perks`
--


-- --------------------------------------------------------

--
-- Table structure for table `program_responsibilities`
--

CREATE TABLE `program_responsibilities` (
  `responsibility_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_responsibilities`
--


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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `referrals`
--


-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `document_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_optional` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `required_documents`
--


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
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sample_projects`
--


-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `data` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sessions`
--

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `studentid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `mentor_feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `assignedto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `taskcommit`
--

CREATE TABLE `taskcommit` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `createdate` datetime DEFAULT current_timestamp(),
  `createdby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `taskcommit`
--
-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taskstatushistory`
--

CREATE TABLE `taskstatushistory` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `changed_by` int(11) NOT NULL,
  `previous_status` varchar(50) NOT NULL,
  `new_status` varchar(50) NOT NULL,
  `comment` text DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `taskstatushistory`
--

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
  `createdate` datetime DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomment`
--

CREATE TABLE `ticketcomment` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT current_timestamp(),
  `createdby` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticketcomment`
--

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
  `comment` text DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticketstatushistory`
--

-- --------------------------------------------------------

--
-- Table structure for table `userattendance`
--

CREATE TABLE `userattendance` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `logintime` datetime DEFAULT NULL,
  `logouttime` datetime DEFAULT NULL,
  `test` text DEFAULT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdaytracker`
--

CREATE TABLE `userdaytracker` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userdaytracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `userhourlytracker`
--

CREATE TABLE `userhourlytracker` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userhourlytracker`
--

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
  `refercode` varchar(50) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
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
-- Indexes for table `innovationideas`
--
ALTER TABLE `innovationideas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `referral_code` (`referral_code`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskcommit`
--
ALTER TABLE `taskcommit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `taskstatushistory`
--
ALTER TABLE `taskstatushistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_taskid` (`taskid`),
  ADD KEY `idx_changed_by` (`changed_by`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `eligibility_requirements`
--
ALTER TABLE `eligibility_requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `innovationideas`
--
ALTER TABLE `innovationideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paymentverification`
--
ALTER TABLE `paymentverification`
  MODIFY `PaymentVerificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `taskcommit`
--
ALTER TABLE `taskcommit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taskstatushistory`
--
ALTER TABLE `taskstatushistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `ticketstatushistory`
--
ALTER TABLE `ticketstatushistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `userattendance`
--
ALTER TABLE `userattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `userdaytracker`
--
ALTER TABLE `userdaytracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userhourlytracker`
--
ALTER TABLE `userhourlytracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
