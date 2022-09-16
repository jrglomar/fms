-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 03:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_ranks`
--

CREATE TABLE `academic_ranks` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_ranks`
--

INSERT INTO `academic_ranks` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('260bbc2f-3310-49a3-b8d7-6d9a51f404e0', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Professor', 'Professor'),
('2e7e0dc1-c10d-4eb8-97a5-7c016281808e', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Assistant Professor', 'Assistant Professor'),
('c77357e3-66a5-4f67-8b41-4cc6bc19ef7a', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Instructor', 'Instructor'),
('fad81358-af96-4bdc-8227-9359782b2edb', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Associate Professor', 'Associate Professor');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memorandum_file_directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agenda` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `is_required` tinyint(1) DEFAULT NULL,
  `activity_type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `memorandum_file_directory`, `location`, `description`, `agenda`, `status`, `start_datetime`, `end_datetime`, `is_required`, `activity_type_id`) VALUES
('00d972b0-f337-4ed2-b067-7d919965b7ed', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'Re-opening of the Online Application for Graduation', NULL, 'Via Zoom/Facebook Live', 'Re-opening of the Online Application for Graduation', NULL, 'Pending', '2022-09-27 00:00:00', '2022-11-01 23:59:00', NULL, '2d4b3709-145c-4302-a9de-f782fcbceba7'),
('3baf620f-a237-464e-8b79-3b6abb385101', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'November Flag Raising Ceremony', NULL, 'Via Zoom/Facebook Live', 'November 2022 Flag Raising Ceremony', NULL, 'Pending', '2022-11-07 00:00:00', '2022-11-07 00:00:00', NULL, '9c7ea8df-50ff-4b0a-8efd-118a3d8baee5'),
('79200655-bc28-42a3-ac4b-030eba8cd5b8', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'September Flag Raising Ceremony', NULL, 'Via Zoom/Facebook Live', 'September Flag Raising Ceremony', NULL, 'Pending', '2022-09-05 08:00:00', '2022-09-05 09:00:00', NULL, '9c7ea8df-50ff-4b0a-8efd-118a3d8baee5');

-- --------------------------------------------------------

--
-- Table structure for table `activity_attendance_required_faculty_lists`
--

CREATE TABLE `activity_attendance_required_faculty_lists` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `attendance_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_attendance_submitted_files`
--

CREATE TABLE `activity_attendance_submitted_files` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link_directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aa_faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_types`
--

INSERT INTO `activity_types` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`, `category`) VALUES
('2d4b3709-145c-4302-a9de-f782fcbceba7', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Flag Raising Ceremony', NULL, 'Activity'),
('9c7ea8df-50ff-4b0a-8efd-118a3d8baee5', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Faculty Meeting', NULL, 'Meeting');

-- --------------------------------------------------------

--
-- Table structure for table `class_attendances`
--

CREATE TABLE `class_attendances` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_class` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Submitted',
  `proof_of_attendance_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_schedule_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_attendances`
--

INSERT INTO `class_attendances` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `date_of_class`, `start_time`, `end_time`, `status`, `proof_of_attendance_link`, `proof_of_attendance_file`, `proof_of_attendance_file_name`, `remarks`, `checked_by`, `faculty_id`, `class_schedule_id`) VALUES
('1f5e5de3-86b4-4a88-afbb-bbf2440aa6f7', '2022-07-28 11:14:35', '2022-07-28 15:49:33', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', '2022-07-18', '16:00:00', '19:00:00', 'Declined', NULL, 'uploads/class_proof_of_attendance/12d3a5c7f9d4a77a6ef6e5d6754d110a.jpg', 'IG-220728-234933.jpg', NULL, 'cb3662c3-239a-423b-a4c5-839ce3a2d42d', '4b6b9410-3191-47e1-8504-c9ae4d070d6c', 'b70d441c-dcf0-4daa-b6a8-9d71e0f86444'),
('7a673c53-1afb-443d-91b4-90223cd95e0b', '2022-07-28 15:47:15', '2022-07-28 15:47:15', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', NULL, '2022-07-22', '07:00:00', '13:00:00', 'Submitted', NULL, 'uploads/class_proof_of_attendance/5c13d658ca6322b96357b5da43a2b7e7.jpg', 'IG-220728-234715.jpg', NULL, NULL, '4b6b9410-3191-47e1-8504-c9ae4d070d6c', '0ecf0e16-340f-4b74-94d4-6eeddadbff88'),
('946a35d9-214e-4106-a67d-5f621ab5cc1c', '2022-07-28 12:45:56', '2022-07-28 15:46:55', NULL, 'bc118579-e632-4221-9521-f5f40aee62d6', 'bc118579-e632-4221-9521-f5f40aee62d6', '2022-07-20', '07:00:00', '10:00:00', 'Approved', NULL, 'uploads/class_proof_of_attendance/15149337dd26089d41a293598cae090a.jpg', 'BB-220728-234655.jpg', NULL, 'cb3662c3-239a-423b-a4c5-839ce3a2d42d', '5d230a37-7717-47c1-b8a9-c2b55229d2d1', '2d551896-d3ce-42f4-be3b-3f4d8bedd291'),
('be221912-f283-471a-a11c-3d1dffa2c40b', '2022-07-28 10:58:42', '2022-07-28 15:49:41', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', '2022-07-04', '16:00:00', '19:00:00', 'For Revision', NULL, 'uploads/class_proof_of_attendance/4959d6f721325c3d9a63b2edf64d583e.jpg', 'IG-220728-234941.jpg', 'asvd', 'cb3662c3-239a-423b-a4c5-839ce3a2d42d', '4b6b9410-3191-47e1-8504-c9ae4d070d6c', 'b70d441c-dcf0-4daa-b6a8-9d71e0f86444'),
('ff2fba77-675b-44e2-a01a-eecee19e9af5', '2022-07-28 12:47:36', '2022-07-28 15:46:43', NULL, 'bc118579-e632-4221-9521-f5f40aee62d6', 'bc118579-e632-4221-9521-f5f40aee62d6', '2022-07-27', '07:00:00', '10:00:00', 'Submitted', NULL, 'uploads/class_proof_of_attendance/f74b60de72af7b9875c16e964b2cecd2.jpg', 'BB-220728-234643.jpg', NULL, NULL, '5d230a37-7717-47c1-b8a9-c2b55229d2d1', '2d551896-d3ce-42f4-be3b-3f4d8bedd291');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedules`
--

CREATE TABLE `class_schedules` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `room_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_offering_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Research Professor', 'Research Professor'),
('fdd1cd40-1da3-4773-81c7-6be2131a73f2', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Faculty Extensionist', 'Faculty Extensionist');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hire_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_rank_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `image`, `salutation`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `birthplace`, `hire_date`, `phone_number`, `province`, `city`, `barangay`, `street`, `house_number`, `user_id`, `faculty_type_id`, `academic_rank_id`, `designation_id`, `specialization_id`) VALUES
('3a5358f3-f0ab-4654-8cac-5c1282a81ff8', '2022-06-22 08:33:28', '2022-06-22 08:33:28', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'images/faculty_images/9a5cc9db88de7e58b82c30333e1d7a4b.png', 'Mr.', 'John Raven', 'Tamang', 'Glomar', 'Male', '1999-11-16', 'Quezon City', '2022-05-01', '09398718861', 'Bicol', 'Quezon City', 'Commonwealth', 'Adarna', 'Lot 13', 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', '00515f7c-b267-4f4e-870e-5cc9a9e84a43', 'c77357e3-66a5-4f67-8b41-4cc6bc19ef7a', 'fdd1cd40-1da3-4773-81c7-6be2131a73f2', 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8'),
('4b6b9410-3191-47e1-8504-c9ae4d070d6c', '2022-07-18 20:23:00', '2022-07-28 16:05:18', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', NULL, '', 'Irynne', NULL, 'Gatchalian', 'Female', '1999-11-16', 'Quezon City', '2022-05-01', '09398718861', 'Bicol', 'Quezon City', 'Commonwealth', 'Adarna', 'Lot 13', 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', '7fab7e70-8bc4-4384-881f-654b40e19cf3', '260bbc2f-3310-49a3-b8d7-6d9a51f404e0', 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8'),
('5d230a37-7717-47c1-b8a9-c2b55229d2d1', '2022-07-18 20:23:00', '2022-07-18 20:23:00', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, NULL, '', 'Berna', NULL, 'Bulawit', 'Female', '1999-11-16', 'Quezon City', '2022-05-01', '09398718861', 'Bicol', 'Quezon City', 'Commonwealth', 'Adarna', 'Lot 13', 'bc118579-e632-4221-9521-f5f40aee62d6', '7fab7e70-8bc4-4384-881f-654b40e19cf3', '2e7e0dc1-c10d-4eb8-97a5-7c016281808e', 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', 'ddf1cd40-1da3-4773-81d7-6be2131a73e2'),
('9f45a93a-09eb-47f6-b4bb-1f2d0db9727a', '2022-07-29 01:30:21', '2022-07-29 01:30:21', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, NULL, 'Mr.', 'Director', NULL, 'Account', 'Male', '1990-05-29', 'Test', '2022-07-13', '09398718869', 'Test', 'Test', 'Test', 'Test', 'Test', '2a3d8f03-02b3-4ad7-b909-cc701acd33dc', '000267aa-d29c-4e91-afd6-0f68a5d86f4a', '260bbc2f-3310-49a3-b8d7-6d9a51f404e0', 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8'),
('cb3662c3-239a-423b-a4c5-839ce3a2d42d', '2022-07-28 10:58:09', '2022-07-28 10:58:09', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, NULL, 'Mr.', 'John Raven', NULL, 'Glomar', 'Male', '1999-11-16', 'Quezon City', '2022-07-21', '09398718869', 'Bicol', 'Quezon City', 'Commonwealth', 'Adarna', 'Lot 13', 'a475ed1c-85a4-47b5-a97a-86bcfb8235d9', '000267aa-d29c-4e91-afd6-0f68a5d86f4a', '260bbc2f-3310-49a3-b8d7-6d9a51f404e0', 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', 'dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8'),
('d7376448-3059-4a0e-b48b-16a0dc00fd78', '2022-07-18 20:23:00', '2022-07-18 20:23:00', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, NULL, 'Ms.', 'Acad', NULL, 'Head', 'Female', '1999-11-16', 'Quezon City', '2022-05-01', '09398718861', 'Bicol', 'Quezon City', 'Commonwealth', 'Adarna', 'Lot 13', '2cb47788-c907-4196-8960-9b26fa699ec4', '000267aa-d29c-4e91-afd6-0f68a5d86f4a', '260bbc2f-3310-49a3-b8d7-6d9a51f404e0', 'dc7c6ba9-da51-4c2d-aacc-43c8f13b6af8', 'ddf1cd40-1da3-4773-81d7-6be2131a73e2');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_education_profiles`
--

CREATE TABLE `faculty_education_profiles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_attendance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_programs`
--

CREATE TABLE `faculty_programs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_types`
--

CREATE TABLE `faculty_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculty_types`
--

INSERT INTO `faculty_types` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('000267aa-d29c-4e91-afd6-0f68a5d86f4a', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Regular', 'Regular'),
('00515f7c-b267-4f4e-870e-5cc9a9e84a43', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Part time', 'Part time'),
('7fab7e70-8bc4-4384-881f-654b40e19cf3', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Temporary', 'Temporary');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `agenda` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_required` tinyint(1) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `meeting_types_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `location`, `date`, `start_time`, `end_time`, `agenda`, `description`, `is_required`, `status`, `meeting_types_id`) VALUES
('68110ff8-0593-400d-bb22-767c4eccfbb5', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'Individual Problem-Solving Meeting', 'Google Meet: https://meet.google.com/sbi-ckpu-jfe', '2022-11-07', '13:30:00', '16:00:00', 'Problem Analysis – Why Is the problem occurring?', 'Plan for students whose needs (academic/social-emotional/behavioral) are intensive or not making progress given supplemental support', NULL, 'Pending', '4b66aad3-36e8-4eea-b75d-52b3864797b0'),
('749108a8-ef45-4f6b-bb61-283d32cfb939', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'Polytechnic University of the Philippines – Quezon City Branch Faculty Meeting', 'Via Zoom/Facebook Live', '2022-11-04', '13:30:00', '16:00:00', 'Dean’s Update', 'To improve internal communication within the Faculty and give you timely access to information that is significant and valuable to you, the Dean\'s monthly update was developed.', NULL, 'Pending', '40fed866-6a6e-42eb-b863-636653d6de1f'),
('fd371efa-9b5c-4970-9ff3-4cbfbcf3d29d', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'Polytechnic University of the Philippines – Quezon City Branch, Information Technology Faculty Decision Making Meeting', 'Faceboo Live', '2022-11-18', '13:30:00', '16:00:00', 'Address the problem in the IT field by deciding whether to terminate the contract', 'In order to make the jump from brainstorming potential solutions for solving a problem to evaluating and selecting the best solution, group members need to make decisions. The group holds a vote on a particular issue following a period of discussion. The majority wins.', NULL, 'Pending', '40fed866-6a6e-42eb-b863-636653d6de1f');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendance_required_faculty_lists`
--

CREATE TABLE `meeting_attendance_required_faculty_lists` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `attendance_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_submitted_proof_of_attendances`
--

CREATE TABLE `meeting_submitted_proof_of_attendances` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file_directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_attendance_file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marf_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_types`
--

CREATE TABLE `meeting_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_types`
--

INSERT INTO `meeting_types` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('04cfd446-4b29-4b12-ad30-b1e84313957a', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Decision Making', NULL),
('3463651f-882c-497c-bbc4-7285b0fb897e', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Information Sharing', NULL),
('40fed866-6a6e-42eb-b863-636653d6de1f', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Status Update', NULL),
('4b66aad3-36e8-4eea-b75d-52b3864797b0', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Innovation Meetings', NULL),
('9931ad4e-1f61-4d85-852d-43b240012e48', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Team Building', NULL),
('9ee1b2c2-25c9-4c07-9028-c431f0a6658b', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Problem Solving', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_09_083422_create_faculty_types_table', 1),
(4, '2019_06_09_084621_create_academic_ranks_table', 1),
(5, '2019_06_09_085043_create_designations_table', 1),
(6, '2019_06_09_191216_create_specializations_table', 1),
(7, '2019_06_09_191548_create_programs_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_06_01_040651_create_faculties_table', 1),
(11, '2022_06_01_090242_create_observations_table', 1),
(12, '2022_06_01_105230_create_activity_types_table', 1),
(13, '2022_06_01_180207_create_requirement_bins_table', 1),
(14, '2022_06_02_051849_create_requirement_types_table', 1),
(15, '2022_06_02_052618_create_requirement_list_types_table', 1),
(16, '2022_06_02_052718_create_requirement_required_faculty_lists_table', 1),
(17, '2022_06_02_052755_create_activities_table', 1),
(18, '2022_06_02_052807_create_submitted_requirement_folders_table', 1),
(19, '2022_06_02_052831_create_submitted_requirements_table', 1),
(20, '2022_06_02_064835_create_activity_attendance_required_faculty_lists_table', 1),
(21, '2022_06_03_091129_create_roles_table', 1),
(22, '2022_06_03_091358_create_rooms_table', 1),
(23, '2022_06_03_092240_create_user_roles_table', 1),
(24, '2022_06_03_101436_create_class_schedules_table', 1),
(25, '2022_06_06_050129_create_meeting_types_table', 1),
(26, '2022_06_06_052427_create_meetings_table', 1),
(27, '2022_06_06_054149_create_meeting_attendance_required_faculty_lists_table', 1),
(28, '2022_07_13_064843_create_meeting_submitted_proof_of_attendances_table', 1),
(29, '2022_07_13_082348_create_activity_attendance_submitted_files_table', 1),
(30, '2022_07_25_191637_create_faculty_education_profiles_table', 1),
(31, '2022_07_27_235505_create_class_attendances_table', 1),
(32, '2022_07_28_134507_create_faculty_programs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `observations`
--

CREATE TABLE `observations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_observation` datetime NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `proof_of_observation_file_directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_observation_file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_schedule_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `observations`
--

INSERT INTO `observations` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `date_of_observation`, `remarks`, `status`, `proof_of_observation_file_directory`, `proof_of_observation_file_link`, `faculty_id`, `class_schedule_id`) VALUES
('4bdf298c-8cff-4682-9b2f-9de2f671ba45', '2022-07-28 11:11:17', '2022-07-28 11:11:17', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, '2022-08-15 16:00:00', NULL, 'Pending', NULL, NULL, NULL, 'b70d441c-dcf0-4daa-b6a8-9d71e0f86444'),
('5dc842e4-e909-4c81-9d2a-628e352efc29', '2022-07-28 11:12:51', '2022-07-28 11:12:51', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, '2022-08-08 16:00:00', NULL, 'Pending', NULL, NULL, '4b6b9410-3191-47e1-8504-c9ae4d070d6c', 'b70d441c-dcf0-4daa-b6a8-9d71e0f86444'),
('77652a86-1602-4a6b-b312-5ecb675428df', '2022-07-28 11:05:33', '2022-07-28 11:05:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, '2022-08-01 16:00:00', NULL, 'Pending', NULL, NULL, NULL, 'b70d441c-dcf0-4daa-b6a8-9d71e0f86444');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(46, 'App\\Models\\User', 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', 'myapptoken', '450d121068048b0306a5248229bcb2a3c130d867e86a247b6f79a1d2ddcaaaad', '[\"*\"]', NULL, '2022-07-29 01:45:57', '2022-07-29 01:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('adf1ac40-1df3-4773-81d7-6bb2131c73f2', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Gen Ed', 'Gen Ed'),
('dd7a6fa9-dd61-4c2d-acbd-43o8c13d7af8', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'BSBA - HRM', 'BSBA - HRM');

-- --------------------------------------------------------

--
-- Table structure for table `requirement_bins`
--

CREATE TABLE `requirement_bins` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirement_bins`
--

INSERT INTO `requirement_bins` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`, `deadline`, `status`) VALUES
('022185f3-84fe-432c-a9fa-c69e7a6be8fd', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'November Flag Raising Ceremony Attendance Form', 'Answer an attendance form that contains a person\'s name and their attendance information. To find out who was there that day, managers, supervisors, or teachers might look at the attendance sheet.', '2022-11-07 08:00:00', 'On Going'),
('5f82c12b-6ca9-444b-bd10-b967949f3094', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'Getting Started with Interview Preparation – Free online Course in Simplilearn', 'Please print or take screenshot of your Certificates in completing the course of “Getting Started with Interview Preparation”. A submission bin will be uploaded in your google classroom.', '2022-11-30 17:00:00', 'On Going'),
('c28aa3ac-3ff5-49df-aaa3-fa145aa21f89', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', NULL, 'PUP Socioeconomic Survey', 'Please answer the PUP Socioeconomic Survey on or before July 1, 2022 12:00nn. You may access the survey in your SIS account. Thank you.', '2022-11-30 17:00:00', 'On Going');

-- --------------------------------------------------------

--
-- Table structure for table `requirement_list_types`
--

CREATE TABLE `requirement_list_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_bin_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirement_required_faculty_lists`
--

CREATE TABLE `requirement_required_faculty_lists` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submission_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_bin_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirement_types`
--

CREATE TABLE `requirement_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirement_types`
--

INSERT INTO `requirement_types` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('89c87eb3-2604-49fe-8023-cd39ed3294ae', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Class Masterlist', NULL),
('9934756d-1198-4013-b9db-7bece59fdcd3', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Proof of Meeting/Activity Attendance', NULL),
('f2be5628-3a7e-4a6b-9d56-e0efca1fd9b6', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Memo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('3a5358f3-f0ab-4654-8cac-5c1282a81ff8', '2022-06-22 08:33:28', '2022-06-22 08:33:28', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Admin', NULL),
('8a59b958-f421-4fd7-b6e7-9dca0678f42a', '2022-07-29 01:30:40', '2022-07-29 01:30:40', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Director', NULL),
('b386fdb9-5197-4ac2-b198-6384323af036', '2022-06-22 08:33:28', '2022-06-22 08:33:28', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Faculty', NULL),
('d2a81b5a-0228-48e2-8ccc-1a4820e26fa9', '2022-06-22 08:33:28', '2022-06-22 08:33:28', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Academic Head', NULL),
('da39b66a-9fcb-405f-a79e-60defd788ea8', '2022-06-22 08:33:28', '2022-06-22 08:33:28', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Checker', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `title`, `description`) VALUES
('dc7c6fa9-da61-4c2d-adbc-43o8f13b7af8', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Human Resource Management', 'Human Resource Management'),
('ddf1cd40-1da3-4773-81d7-6be2131a73e2', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'Guidance and Counseling/ Psychology', 'Guidance and Counseling/ Psychology');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_requirements`
--

CREATE TABLE `submitted_requirements` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_link_directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rr_faculty_list_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submitted_requirement_folders`
--

CREATE TABLE `submitted_requirement_folders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_bin_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `deleted_at`, `email`, `email_verified_at`, `password`, `remember_token`, `status`) VALUES
('1ad2f282-a7a6-482e-a234-bc400ae08ad7', '2022-07-28 16:48:10', '2022-07-28 16:48:10', NULL, 'jrglomar016@gmail.com', NULL, '$2y$10$iPvI5bgc89d4E1vBq2V42uCjRhu1Hw5Ez4gKfT7P8pOHDD2i4Fmmy', NULL, 'Inactive'),
('2a3d8f03-02b3-4ad7-b909-cc701acd33dc', '2022-07-29 01:29:35', '2022-07-29 01:30:28', NULL, 'director@pupqc.com', NULL, '$2y$10$K68ESKWEftyI2w2P5ny5t.8BLDp6h7ug83q6x13KvED6HjRSEf8C6', NULL, 'Active'),
('2cb47788-c907-4196-8960-9b26fa699ec4', '2022-06-22 08:25:03', '2022-06-22 08:25:03', NULL, 'acadhead@pupqc.com', NULL, '$2y$10$Q/qHqE6UUA.G8G.tw5CIMOKXhhuKK7XjYLC7StJTk1ObvzMH0oHla', NULL, 'Active'),
('a475ed1c-85a4-47b5-a97a-86bcfb8235d9', '2022-07-28 10:57:30', '2022-07-28 10:57:35', NULL, 'checker@pupqc.com', NULL, '$2y$10$03fYtG8arG2aoLDk8Q2x6edmum8aTZ8kxzxlQWtddhJRYKHkrHEDm', NULL, 'Active'),
('aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', '2022-06-22 08:25:03', '2022-06-22 08:25:03', NULL, 'faculty@pupqc.com', NULL, '$2y$10$iVA6SsXelzaMdMxgIHlHWOLqrhl4wIzt5hu8SkTd6cJBpsn6lLeFG', NULL, 'Active'),
('b1fda120-82ae-49d3-811d-b3c9d5d747a1', '2022-06-22 08:25:03', '2022-06-22 08:25:03', NULL, 'admin@pupqc.com', NULL, '$2y$10$/9JCPJ0l5nm8seLw8wodS.4AUnt/X/wElupT5CZ5fbu4zye9mGQ26', NULL, 'Active'),
('bc118579-e632-4221-9521-f5f40aee62d6', '2022-06-22 08:25:03', '2022-06-22 08:25:03', NULL, 'faculty2@pupqc.com', NULL, '$2y$10$46SzJuLLFG/ADxFnlFY.6OPSL.IkxfYCF0WS9ns7ak.L4Ike6ylFu', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `user_id`, `role_id`) VALUES
('18a70600-9935-4bd7-893a-b024b83a0d0e', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9'),
('18ddb132-16e6-4c04-9e91-d676174a03c0', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, '2cb47788-c907-4196-8960-9b26fa699ec4', 'd2a81b5a-0228-48e2-8ccc-1a4820e26fa9'),
('3892b07d-aec6-4ce5-88e1-41486c5f69ab', '2022-07-28 16:03:36', '2022-07-28 16:05:18', '2022-07-28 16:05:18', 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', 'b386fdb9-5197-4ac2-b198-6384323af036'),
('9e405692-479b-4c42-bc7a-5773ed78d6a9', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'bc118579-e632-4221-9521-f5f40aee62d6', 'b386fdb9-5197-4ac2-b198-6384323af036'),
('a784319f-58a4-42c5-8040-c9f5e86de0e0', '2022-07-28 16:05:18', '2022-07-28 16:05:18', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', 'b386fdb9-5197-4ac2-b198-6384323af036'),
('aa946a41-0c49-44e2-9e71-c4f08684d6c3', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', 'da39b66a-9fcb-405f-a79e-60defd788ea8'),
('bd6fda6e-d77d-421d-93b6-69523112f523', '2022-06-22 08:33:33', '2022-07-28 16:03:36', '2022-07-28 16:03:36', 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'aeed01a8-0e42-4c45-bdf1-90b3bc8e7027', 'b386fdb9-5197-4ac2-b198-6384323af036'),
('be758724-7f8e-40dd-a110-e5c399a49597', '2022-07-29 01:30:51', '2022-07-29 01:30:51', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, '2a3d8f03-02b3-4ad7-b909-cc701acd33dc', '8a59b958-f421-4fd7-b6e7-9dca0678f42a'),
('d0ac98f5-4bab-4da8-b3fa-3a477db27391', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', '3a5358f3-f0ab-4654-8cac-5c1282a81ff8'),
('e9812fc8-86c0-4636-b835-fb5b2df24ae8', '2022-07-28 10:57:36', '2022-07-28 10:57:36', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'a475ed1c-85a4-47b5-a97a-86bcfb8235d9', 'da39b66a-9fcb-405f-a79e-60defd788ea8'),
('f7db17f9-7ba1-410e-b6a5-4ca112268835', '2022-06-22 08:33:33', '2022-06-22 08:33:33', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', NULL, 'b1fda120-82ae-49d3-811d-b3c9d5d747a1', 'b386fdb9-5197-4ac2-b198-6384323af036');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_ranks`
--
ALTER TABLE `academic_ranks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_ranks_created_by_foreign` (`created_by`),
  ADD KEY `academic_ranks_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_created_by_foreign` (`created_by`),
  ADD KEY `activities_updated_by_foreign` (`updated_by`),
  ADD KEY `activities_activity_type_id_foreign` (`activity_type_id`);

--
-- Indexes for table `activity_attendance_required_faculty_lists`
--
ALTER TABLE `activity_attendance_required_faculty_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_attendance_required_faculty_lists_created_by_foreign` (`created_by`),
  ADD KEY `activity_attendance_required_faculty_lists_updated_by_foreign` (`updated_by`),
  ADD KEY `activity_attendance_required_faculty_lists_activity_id_foreign` (`activity_id`),
  ADD KEY `activity_attendance_required_faculty_lists_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `activity_attendance_submitted_files`
--
ALTER TABLE `activity_attendance_submitted_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_attendance_submitted_files_created_by_foreign` (`created_by`),
  ADD KEY `activity_attendance_submitted_files_updated_by_foreign` (`updated_by`),
  ADD KEY `activity_attendance_submitted_files_aa_faculty_id_foreign` (`aa_faculty_id`);

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_types_created_by_foreign` (`created_by`),
  ADD KEY `activity_types_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `class_attendances`
--
ALTER TABLE `class_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_attendances_created_by_foreign` (`created_by`),
  ADD KEY `class_attendances_updated_by_foreign` (`updated_by`),
  ADD KEY `class_attendances_checked_by_foreign` (`checked_by`),
  ADD KEY `class_attendances_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_schedules_created_by_foreign` (`created_by`),
  ADD KEY `class_schedules_updated_by_foreign` (`updated_by`),
  ADD KEY `class_schedules_room_id_foreign` (`room_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_created_by_foreign` (`created_by`),
  ADD KEY `designations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculties_created_by_foreign` (`created_by`),
  ADD KEY `faculties_updated_by_foreign` (`updated_by`),
  ADD KEY `faculties_user_id_foreign` (`user_id`),
  ADD KEY `faculties_faculty_type_id_foreign` (`faculty_type_id`),
  ADD KEY `faculties_academic_rank_id_foreign` (`academic_rank_id`),
  ADD KEY `faculties_designation_id_foreign` (`designation_id`),
  ADD KEY `faculties_specialization_id_foreign` (`specialization_id`);

--
-- Indexes for table `faculty_education_profiles`
--
ALTER TABLE `faculty_education_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_education_profiles_created_by_foreign` (`created_by`),
  ADD KEY `faculty_education_profiles_updated_by_foreign` (`updated_by`),
  ADD KEY `faculty_education_profiles_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `faculty_programs`
--
ALTER TABLE `faculty_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_programs_created_by_foreign` (`created_by`),
  ADD KEY `faculty_programs_updated_by_foreign` (`updated_by`),
  ADD KEY `faculty_programs_program_id_foreign` (`program_id`),
  ADD KEY `faculty_programs_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `faculty_types`
--
ALTER TABLE `faculty_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_types_created_by_foreign` (`created_by`),
  ADD KEY `faculty_types_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_created_by_foreign` (`created_by`),
  ADD KEY `meetings_updated_by_foreign` (`updated_by`),
  ADD KEY `meetings_meeting_types_id_foreign` (`meeting_types_id`);

--
-- Indexes for table `meeting_attendance_required_faculty_lists`
--
ALTER TABLE `meeting_attendance_required_faculty_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_attendance_required_faculty_lists_created_by_foreign` (`created_by`),
  ADD KEY `meeting_attendance_required_faculty_lists_updated_by_foreign` (`updated_by`),
  ADD KEY `meeting_attendance_required_faculty_lists_faculty_id_foreign` (`faculty_id`),
  ADD KEY `meeting_attendance_required_faculty_lists_meeting_id_foreign` (`meeting_id`);

--
-- Indexes for table `meeting_submitted_proof_of_attendances`
--
ALTER TABLE `meeting_submitted_proof_of_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_submitted_proof_of_attendances_created_by_foreign` (`created_by`),
  ADD KEY `meeting_submitted_proof_of_attendances_updated_by_foreign` (`updated_by`),
  ADD KEY `meeting_submitted_proof_of_attendances_marf_id_foreign` (`marf_id`);

--
-- Indexes for table `meeting_types`
--
ALTER TABLE `meeting_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_types_created_by_foreign` (`created_by`),
  ADD KEY `meeting_types_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `observations_created_by_foreign` (`created_by`),
  ADD KEY `observations_updated_by_foreign` (`updated_by`),
  ADD KEY `observations_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_created_by_foreign` (`created_by`),
  ADD KEY `programs_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `requirement_bins`
--
ALTER TABLE `requirement_bins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement_bins_created_by_foreign` (`created_by`),
  ADD KEY `requirement_bins_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `requirement_list_types`
--
ALTER TABLE `requirement_list_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement_list_types_created_by_foreign` (`created_by`),
  ADD KEY `requirement_list_types_updated_by_foreign` (`updated_by`),
  ADD KEY `requirement_list_types_requirement_bin_id_foreign` (`requirement_bin_id`),
  ADD KEY `requirement_list_types_requirement_type_id_foreign` (`requirement_type_id`);

--
-- Indexes for table `requirement_required_faculty_lists`
--
ALTER TABLE `requirement_required_faculty_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement_required_faculty_lists_created_by_foreign` (`created_by`),
  ADD KEY `requirement_required_faculty_lists_updated_by_foreign` (`updated_by`),
  ADD KEY `requirement_required_faculty_lists_requirement_bin_id_foreign` (`requirement_bin_id`),
  ADD KEY `requirement_required_faculty_lists_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `requirement_types`
--
ALTER TABLE `requirement_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement_types_created_by_foreign` (`created_by`),
  ADD KEY `requirement_types_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_created_by_foreign` (`created_by`),
  ADD KEY `rooms_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specializations_created_by_foreign` (`created_by`),
  ADD KEY `specializations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `submitted_requirements`
--
ALTER TABLE `submitted_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_requirements_created_by_foreign` (`created_by`),
  ADD KEY `submitted_requirements_updated_by_foreign` (`updated_by`),
  ADD KEY `submitted_requirements_rr_faculty_list_id_foreign` (`rr_faculty_list_id`);

--
-- Indexes for table `submitted_requirement_folders`
--
ALTER TABLE `submitted_requirement_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_requirement_folders_created_by_foreign` (`created_by`),
  ADD KEY `submitted_requirement_folders_updated_by_foreign` (`updated_by`),
  ADD KEY `submitted_requirement_folders_requirement_bin_id_foreign` (`requirement_bin_id`),
  ADD KEY `submitted_requirement_folders_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_created_by_foreign` (`created_by`),
  ADD KEY `user_roles_updated_by_foreign` (`updated_by`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_ranks`
--
ALTER TABLE `academic_ranks`
  ADD CONSTRAINT `academic_ranks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `academic_ranks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_activity_type_id_foreign` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`id`),
  ADD CONSTRAINT `activities_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activities_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_attendance_required_faculty_lists`
--
ALTER TABLE `activity_attendance_required_faculty_lists`
  ADD CONSTRAINT `activity_attendance_required_faculty_lists_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `activity_attendance_required_faculty_lists_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_attendance_required_faculty_lists_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `activity_attendance_required_faculty_lists_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_attendance_submitted_files`
--
ALTER TABLE `activity_attendance_submitted_files`
  ADD CONSTRAINT `activity_attendance_submitted_files_aa_faculty_id_foreign` FOREIGN KEY (`aa_faculty_id`) REFERENCES `activity_attendance_required_faculty_lists` (`id`),
  ADD CONSTRAINT `activity_attendance_submitted_files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_attendance_submitted_files_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD CONSTRAINT `activity_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_attendances`
--
ALTER TABLE `class_attendances`
  ADD CONSTRAINT `class_attendances_checked_by_foreign` FOREIGN KEY (`checked_by`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `class_attendances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_attendances_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_attendances_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD CONSTRAINT `class_schedules_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_schedules_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `class_schedules_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `designations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_academic_rank_id_foreign` FOREIGN KEY (`academic_rank_id`) REFERENCES `academic_ranks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_faculty_type_id_foreign` FOREIGN KEY (`faculty_type_id`) REFERENCES `faculty_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_education_profiles`
--
ALTER TABLE `faculty_education_profiles`
  ADD CONSTRAINT `faculty_education_profiles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_education_profiles_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_education_profiles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_programs`
--
ALTER TABLE `faculty_programs`
  ADD CONSTRAINT `faculty_programs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_programs_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `faculty_programs_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`),
  ADD CONSTRAINT `faculty_programs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_types`
--
ALTER TABLE `faculty_types`
  ADD CONSTRAINT `faculty_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meetings_meeting_types_id_foreign` FOREIGN KEY (`meeting_types_id`) REFERENCES `meeting_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meetings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_attendance_required_faculty_lists`
--
ALTER TABLE `meeting_attendance_required_faculty_lists`
  ADD CONSTRAINT `meeting_attendance_required_faculty_lists_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_attendance_required_faculty_lists_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_attendance_required_faculty_lists_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_attendance_required_faculty_lists_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_submitted_proof_of_attendances`
--
ALTER TABLE `meeting_submitted_proof_of_attendances`
  ADD CONSTRAINT `meeting_submitted_proof_of_attendances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_submitted_proof_of_attendances_marf_id_foreign` FOREIGN KEY (`marf_id`) REFERENCES `meeting_attendance_required_faculty_lists` (`id`),
  ADD CONSTRAINT `meeting_submitted_proof_of_attendances_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_types`
--
ALTER TABLE `meeting_types`
  ADD CONSTRAINT `meeting_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `observations`
--
ALTER TABLE `observations`
  ADD CONSTRAINT `observations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `observations_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `observations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirement_bins`
--
ALTER TABLE `requirement_bins`
  ADD CONSTRAINT `requirement_bins_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requirement_bins_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirement_list_types`
--
ALTER TABLE `requirement_list_types`
  ADD CONSTRAINT `requirement_list_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requirement_list_types_requirement_bin_id_foreign` FOREIGN KEY (`requirement_bin_id`) REFERENCES `requirement_bins` (`id`),
  ADD CONSTRAINT `requirement_list_types_requirement_type_id_foreign` FOREIGN KEY (`requirement_type_id`) REFERENCES `requirement_types` (`id`),
  ADD CONSTRAINT `requirement_list_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirement_required_faculty_lists`
--
ALTER TABLE `requirement_required_faculty_lists`
  ADD CONSTRAINT `requirement_required_faculty_lists_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requirement_required_faculty_lists_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `requirement_required_faculty_lists_requirement_bin_id_foreign` FOREIGN KEY (`requirement_bin_id`) REFERENCES `requirement_bins` (`id`),
  ADD CONSTRAINT `requirement_required_faculty_lists_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirement_types`
--
ALTER TABLE `requirement_types`
  ADD CONSTRAINT `requirement_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requirement_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specializations`
--
ALTER TABLE `specializations`
  ADD CONSTRAINT `specializations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specializations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submitted_requirements`
--
ALTER TABLE `submitted_requirements`
  ADD CONSTRAINT `submitted_requirements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitted_requirements_rr_faculty_list_id_foreign` FOREIGN KEY (`rr_faculty_list_id`) REFERENCES `requirement_required_faculty_lists` (`id`),
  ADD CONSTRAINT `submitted_requirements_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submitted_requirement_folders`
--
ALTER TABLE `submitted_requirement_folders`
  ADD CONSTRAINT `submitted_requirement_folders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitted_requirement_folders_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `submitted_requirement_folders_requirement_bin_id_foreign` FOREIGN KEY (`requirement_bin_id`) REFERENCES `requirement_bins` (`id`),
  ADD CONSTRAINT `submitted_requirement_folders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
