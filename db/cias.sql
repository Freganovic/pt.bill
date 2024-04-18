-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 05:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `body`
--

CREATE TABLE `body` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(256) NOT NULL,
  `mars` varchar(256) NOT NULL,
  `bom` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(256) NOT NULL,
  `wo` varchar(256) NOT NULL,
  `io` varchar(256) NOT NULL,
  `status` enum('complete','pending') NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `tanggal_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `body`
--

INSERT INTO `body` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`, `tanggal_out`) VALUES
(3, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 1, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(4, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 1, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(5, '2024-02-19', 'Body Part A_5B', '1_0258_A_1', '10', 1, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(6, '2024-02-20', 'Neck Part A_5B', '1_0258_A_1', '10', 1, '13A', 'W23-1', 'O', 'complete', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `body2`
--

CREATE TABLE `body2` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(256) DEFAULT NULL,
  `mars` varchar(256) DEFAULT NULL,
  `bom` varchar(256) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `mesin` varchar(256) DEFAULT NULL,
  `wo` varchar(256) DEFAULT NULL,
  `io` varchar(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'panding',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `body2`
--

INSERT INTO `body2` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`, `tanggal_out`) VALUES
(1, '2024-02-20 09:00:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(2, '2024-02-20 13:28:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `body3`
--

CREATE TABLE `body3` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mars` varchar(255) NOT NULL,
  `bom` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `wo` varchar(255) NOT NULL,
  `io` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `body3`
--

INSERT INTO `body3` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-20', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bottom`
--

CREATE TABLE `bottom` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(256) NOT NULL,
  `mars` varchar(256) NOT NULL,
  `bom` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(256) NOT NULL,
  `wo` varchar(256) NOT NULL,
  `io` varchar(256) NOT NULL,
  `status` enum('complete','pending') NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `tanggal_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bottom`
--

INSERT INTO `bottom` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`, `tanggal_out`) VALUES
(1, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(3, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(4, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bottom2`
--

CREATE TABLE `bottom2` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(256) DEFAULT NULL,
  `mars` varchar(256) DEFAULT NULL,
  `bom` varchar(256) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `mesin` varchar(256) DEFAULT NULL,
  `wo` varchar(256) DEFAULT NULL,
  `io` varchar(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bottom2`
--

INSERT INTO `bottom2` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-20 13:34:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0),
(2, '2024-02-20 13:42:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bottom3`
--

CREATE TABLE `bottom3` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mars` varchar(255) NOT NULL,
  `bom` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `wo` varchar(255) NOT NULL,
  `io` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bottom3`
--

INSERT INTO `bottom3` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-20', 'bottom part A2', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0),
(2, '2024-02-20', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `head`
--

CREATE TABLE `head` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `mars` varchar(255) DEFAULT NULL,
  `bom` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `mesin` varchar(255) DEFAULT NULL,
  `wo` varchar(255) DEFAULT NULL,
  `io` varchar(1) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `head`
--

INSERT INTO `head` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-21', 'Die Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inner`
--

CREATE TABLE `inner` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mars` varchar(255) NOT NULL,
  `bom` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `wo` varchar(255) NOT NULL,
  `io` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inner`
--

INSERT INTO `inner` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-20', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `moll`
--

CREATE TABLE `moll` (
  `id` int(11) NOT NULL,
  `neck` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `bottom` varchar(255) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `neck`
--

CREATE TABLE `neck` (
  `id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `mars` varchar(255) DEFAULT NULL,
  `bom` varchar(255) DEFAULT NULL,
  `qty` varchar(11) DEFAULT NULL,
  `mesin` varchar(255) DEFAULT NULL,
  `wo` varchar(255) DEFAULT NULL,
  `io` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `tanggal_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `neck`
--

INSERT INTO `neck` (`id`, `isDeleted`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `tanggal_out`) VALUES
(14, 0, '2024-02-19 09:45:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'B', '13A', 'W23-1', 'O', 'complete', '2024-02-20'),
(17, 0, '2024-02-19 10:15:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'A', '13A', 'W23-1', 'O', 'complete', '2024-02-20'),
(25, 0, '2024-02-19 22:20:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'A', '13A', 'W23-1', 'O', 'complete', '2024-02-20'),
(26, 0, '2024-02-20 11:38:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'A', '13A', 'W23-1', 'O', 'complete', NULL),
(27, 0, '2024-02-20 11:44:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'A', '13A', 'W23-1', 'O', 'complete', NULL),
(28, 0, '2024-02-20 12:53:00', 'Neck Part A_5B', '1_0258_A_1', '10', 'A', '13A', 'W23-1', 'O', 'complete', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `neck2`
--

CREATE TABLE `neck2` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(256) NOT NULL,
  `mars` varchar(256) NOT NULL,
  `bom` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(256) NOT NULL,
  `wo` varchar(256) NOT NULL,
  `io` varchar(256) NOT NULL,
  `status` enum('complete','pending') NOT NULL DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `tanggal_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `neck2`
--

INSERT INTO `neck2` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`, `tanggal_out`) VALUES
(1, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(2, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL),
(3, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'I', 'pending', 0, NULL),
(4, '2024-02-19', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'I', 'pending', 0, NULL),
(5, '2024-02-20', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `neck3`
--

CREATE TABLE `neck3` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama` varchar(256) NOT NULL,
  `mars` varchar(256) NOT NULL,
  `bom` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(256) NOT NULL,
  `wo` varchar(256) NOT NULL,
  `io` varchar(1) NOT NULL,
  `status` varchar(20) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `neck3`
--

INSERT INTO `neck3` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-20 14:14:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0),
(2, '2024-02-20 16:37:00', 'Neck Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0),
(3, '2024-02-20 16:54:00', 'blowpintip', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0),
(4, '2024-02-21 11:22:00', 'Blowpin Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'I', 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE `pin` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mars` varchar(255) NOT NULL,
  `bom` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `wo` varchar(255) NOT NULL,
  `io` varchar(1) NOT NULL,
  `status` varchar(50) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pin`
--

INSERT INTO `pin` (`id`, `tanggal`, `nama`, `mars`, `bom`, `qty`, `mesin`, `wo`, `io`, `status`, `isDeleted`) VALUES
(1, '2024-02-21 09:50:00', 'PIN Part A_5B', '1_0258_A_1', '10', 0, '13A', 'W23-1', 'O', 'complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `bom` varchar(255) DEFAULT NULL,
  `wo` varchar(255) DEFAULT NULL,
  `njt` varchar(255) DEFAULT NULL,
  `mars` varchar(255) DEFAULT NULL,
  `wb` varchar(255) DEFAULT NULL,
  `qyt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `bom`, `wo`, `njt`, `mars`, `wb`, `qyt`) VALUES
(1, '14', 'W23-1', 'A', '1_0258_A_1', 'Milling Manual', '10'),
(2, '12', 'goal', 'truk', 'klaa', 't12', '14A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_matrix`
--

CREATE TABLE `tbl_access_matrix` (
  `id` int(11) NOT NULL,
  `access` text DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_access_matrix`
--

INSERT INTO `tbl_access_matrix` (`id`, `access`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, '[{\"module\":\"Task\",\"total_access\":0,\"list\":1,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":1,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 12, 0, 1, '2022-06-17 21:01:02', 1, '2022-06-18 20:50:58'),
(2, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 11, 0, 1, '2024-02-15 08:41:54', NULL, NULL),
(3, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 5, 0, 1, '2024-02-15 09:07:15', NULL, NULL),
(4, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 2, 0, 1, '2024-02-16 02:57:04', 1, '2024-02-16 02:57:15'),
(5, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 3, 0, 1, '2024-02-16 09:30:02', NULL, NULL),
(6, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 13, 0, 1, '2024-02-16 17:45:04', 1, '2024-02-16 18:25:06'),
(7, '[{\"module\":\"Task\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":0,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 1, 0, 1, '2024-02-19 10:35:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 99.0.4844.84', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', 'Windows 7', '2022-04-04 22:19:07'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:33:45'),
(3, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:35:50'),
(4, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:36:25'),
(5, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:06:57'),
(6, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:08:21'),
(7, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:16:40'),
(8, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:17:26'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:30:21'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:30:39'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 23:49:29'),
(12, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:41:39'),
(13, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:42:38'),
(14, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:51:18'),
(15, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:54:04'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 02:15:01'),
(17, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:52:14'),
(18, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:53:41'),
(19, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:55:24'),
(20, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:57:25'),
(21, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-19 00:21:13'),
(22, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-16 08:34:44'),
(23, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-16 08:57:38'),
(24, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-16 08:58:34'),
(25, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-16 08:58:57'),
(26, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-16 09:18:14'),
(27, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-17 10:58:23'),
(28, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-17 16:09:58'),
(29, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-18 12:37:52'),
(30, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 08:26:49'),
(31, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 09:20:19'),
(32, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 09:23:24'),
(33, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 10:34:29'),
(34, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 10:37:12'),
(35, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 10:38:28'),
(36, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 20:32:13'),
(37, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 20:48:09'),
(38, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-19 20:49:14'),
(39, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 08:32:14'),
(40, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 10:23:07'),
(41, 10, '{\"role\":\"3\",\"roleText\":\"Employee\",\"name\":\"Employee\",\"isAdmin\":\"2\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 10:23:30'),
(42, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 10:28:57'),
(43, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 14:28:01'),
(44, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-20 17:52:13'),
(45, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 121.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Windows 10', '2024-02-21 08:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`, `status`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'System Administrator', 1, 0, 0, '2021-01-21 00:00:00', 1, '2022-06-17 20:21:46'),
(2, 'Manager', 1, 0, 0, '2021-01-13 00:00:00', NULL, NULL),
(3, 'Employee', 1, 0, 0, '2021-01-13 00:00:00', 1, '2021-01-22 18:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 2,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isAdmin`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6Y28WIo2Oz.p8xsEMYcCmuvvijXZU8.sRT3737ix.vN1CwGs3NJk6', 'System Administrator', '9890098900', 1, 1, 0, 0, '2015-07-01 18:56:49', 1, '2021-06-01 16:17:08'),
(2, 'manager@example.com', '$2y$10$bbiUxE89umKxiZZ1Kqql3eU9FQpSzAmzyBVSfdHbceeew6DDu/Daa', 'Manager', '9890098900', 2, 2, 0, 1, '2016-12-09 17:49:56', 1, '2024-02-16 02:58:26'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', '9890098900', 3, 0, 1, 1, '2016-12-09 17:50:22', 1, '2019-11-09 18:13:17'),
(9, 'employee2@example.com', '$2y$10$DBnqnZDQMNW3GASPNJQ2RubfqG1WNupMBP4HKwHYRKQNHgA65Nhly', 'Employee2', '9890098900', 3, 0, 1, 1, '2019-03-26 11:40:50', 1, '2019-11-09 18:12:13'),
(10, 'employee@example.com', '$2y$10$OCFRKfOqrEaJrd7J6d7UFe3jiOZ2cLI/pDokyV9r2zku5Ffws11ja', 'Employee', '7410852000', 3, 2, 0, 1, '2020-02-01 19:36:41', 1, '2024-02-20 10:22:41'),
(12, 'email@example.com', '$2y$10$CGJsY/FZMn8L4.JfO.ZojOwbK9RUCQSx4dnqU1NgkO3ffq26i0WDG', 'From', '8520741000', 3, 0, 1, 1, '2021-01-15 13:42:11', 1, '2024-02-15 07:55:46'),
(14, 'pml6@example.com', '$2y$10$VGwjdpcWYGfWe.ED4wlE8.B/0OOdKNaqvvSOaPbkZA.EMsbiyZIkG', 'Pml6', '7410852000', 12, 2, 1, 1, '2022-06-16 22:05:15', 1, '2024-02-15 07:55:36'),
(15, 'sapri12@gmail.com', '$2y$10$DUkLSD5/nM1l0n05GUWzNOGhwTMwxupB0mWxFHVZY98XujsUVYv76', 'Sapri', '3121105381', 3, 2, 1, 1, '2024-02-16 17:51:49', 1, '2024-02-16 17:51:53'),
(16, 'sapri12@gmail.com', '$2y$10$Y7xmdy9MtPMOGtxPAfl0yu40Gn3VfUfGOS/0VEneN32X.rpwkVAQS', 'Sapri', '3121105381', 3, 2, 1, 1, '2024-02-16 18:03:48', 1, '2024-02-16 18:04:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body`
--
ALTER TABLE `body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `body2`
--
ALTER TABLE `body2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `body3`
--
ALTER TABLE `body3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottom`
--
ALTER TABLE `bottom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottom2`
--
ALTER TABLE `bottom2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottom3`
--
ALTER TABLE `bottom3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inner`
--
ALTER TABLE `inner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moll`
--
ALTER TABLE `moll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neck`
--
ALTER TABLE `neck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neck2`
--
ALTER TABLE `neck2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neck3`
--
ALTER TABLE `neck3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_access_matrix`
--
ALTER TABLE `tbl_access_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body`
--
ALTER TABLE `body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `body2`
--
ALTER TABLE `body2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `body3`
--
ALTER TABLE `body3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bottom`
--
ALTER TABLE `bottom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bottom2`
--
ALTER TABLE `bottom2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bottom3`
--
ALTER TABLE `bottom3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `head`
--
ALTER TABLE `head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inner`
--
ALTER TABLE `inner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `moll`
--
ALTER TABLE `moll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `neck`
--
ALTER TABLE `neck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `neck2`
--
ALTER TABLE `neck2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `neck3`
--
ALTER TABLE `neck3`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pin`
--
ALTER TABLE `pin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_access_matrix`
--
ALTER TABLE `tbl_access_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
