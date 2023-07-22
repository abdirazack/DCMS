-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 01:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `street`, `city`, `state`, `country`, `zip`, `created_at`, `updated_at`) VALUES
(1, 'Makka Al-Mukarrama', 'Mogadishu', 'Benadir', 'Somalia', '1893-28', '2023-07-19 08:31:58', '2023-07-19 08:31:58'),
(2, 'Vint Uno', 'Mogadishu', 'Benadir', 'Somalia', '8923-23', '2023-07-19 08:31:58', '2023-07-19 08:31:58'),
(3, 'Alto Jubba', 'Mogadishu', 'Benadir', 'Somalia', '8922-42', '2023-07-19 08:31:58', '2023-07-19 08:31:58'),
(4, 'K.P.P', 'Mogadishu', 'Benadir', 'Somalia', '3278-34', '2023-07-19 08:31:58', '2023-07-19 08:31:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `addresses_employees_view`
-- (See below for the actual view)
--
CREATE TABLE `addresses_employees_view` (
`employee_id` int(11)
,`first_name` varchar(255)
,`middle_name` varchar(255)
,`last_name` varchar(255)
,`phone` varchar(255)
,`email` varchar(255)
,`role_name` varchar(255)
,`Experience` varchar(50)
,`Qualification` varchar(255)
,`gender` enum('Male','Female')
,`profile` varchar(255)
,`hire_date` date
,`birth_date` date
,`street` varchar(255)
,`city` varchar(255)
,`state` varchar(255)
,`country` varchar(255)
,`zip` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `addresses_patients_view`
-- (See below for the actual view)
--
CREATE TABLE `addresses_patients_view` (
`patient_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`phone_number` varchar(20)
,`gender` enum('Male','Female')
,`birth_date` date
,`street` varchar(255)
,`city` varchar(255)
,`state` varchar(255)
,`country` varchar(255)
,`zip` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `addresses_supplier_view`
-- (See below for the actual view)
--
CREATE TABLE `addresses_supplier_view` (
`supplier_id` int(11)
,`supplier_name` varchar(100)
,`email` varchar(100)
,`phone_number` varchar(20)
,`street` varchar(255)
,`city` varchar(255)
,`state` varchar(255)
,`country` varchar(255)
,`zip` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `Type`, `status`, `date`, `time`, `patient_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'Walk-in', 'Scheduled', '2023-07-19', '13:00:00', 4, 4, '2023-07-19 08:20:34', '2023-07-19 11:01:35'),
(2, 'Online', 'Cancelled', '2023-07-21', '11:15:00', 5, 3, '2023-07-20 07:38:43', '2023-07-20 09:05:03'),
(3, 'Online', 'Approved', '2023-07-19', '14:00:00', 2, 2, '2023-07-20 09:24:53', '2023-07-20 09:24:53'),
(4, 'Online', 'Pending', '2023-07-19', '10:09:00', 3, 3, '2023-07-22 10:00:00', '2023-07-22 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services`
--

CREATE TABLE `appointment_services` (
  `appointment_id` int(11) DEFAULT NULL,
  `service` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_description` text DEFAULT NULL,
  `drug_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `qualification`, `experience`, `address`, `gender`, `profile`, `hire_date`, `birth_date`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Maxamed', 'Cabdullaah', 'Afrax', 'mo.afrax@gmail.com', '0618368285', 'BcD', '4 years exp', 4, 'Male', 'ioqweiohqw.jpg', '2023-07-05', '1994-10-19', 2, '2023-07-19 08:25:42', '2023-07-19 08:32:33'),
(2, 'Cumar', 'Jaamac', 'Cismaan', 'omar289@gmail.com', '0618376381', 'DcD', '2 years exp', 2, 'Male', '8932jds.jpg', '2023-07-10', '1997-04-19', 2, '2023-07-19 08:43:02', '2023-07-19 08:43:02'),
(3, 'Cabdulle', 'Axmed', 'Wehliye', 'cab.wehliye@gmail.com', '0615092423', 'BcD', '16 years exp', 1, 'Male', '8239hjs.jpg', '2017-07-20', '1972-02-18', 2, '2023-07-19 08:43:02', '2023-07-19 08:43:02'),
(4, 'Farxiya', 'Cali', 'Axmed', 'farha129@gmail.com', '0614928492', 'BcD', '1 year exp', 3, 'Female', 'jihkwenui.jpg', '2023-06-13', '1999-08-11', 4, '2023-07-19 08:43:02', '2023-07-19 08:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_type` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_information` varchar(200) DEFAULT NULL,
  `maintenance_schedule` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `expense_type_id` int(11) NOT NULL,
  `expense_type` varchar(255) DEFAULT NULL,
  `expense_type_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `medication_name` varchar(100) DEFAULT NULL,
  `medication_dosage` varchar(100) DEFAULT NULL,
  `medication_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Robert', 'Doe', '1990-05-15', 'Male', '+1234567890', 1, '2023-07-19 08:49:03', '2023-07-19 08:49:03'),
(2, 'Jane', 'Marie', 'Smith', '1985-11-28', 'Female', '+9876543210', 2, '2023-07-19 08:49:03', '2023-07-19 08:49:03'),
(3, 'Michael', 'Andrew', 'Johnson', '1978-08-10', 'Male', '+4567891230', 3, '2023-07-19 08:49:03', '2023-07-19 08:49:03'),
(4, 'Emily', 'Rose', 'Williams', '1995-02-20', 'Female', '+7891234560', 4, '2023-07-19 08:49:03', '2023-07-19 08:49:03'),
(5, 'William', 'James', 'Brown', '1982-07-03', 'Male', '+3456789120', 1, '2023-07-19 08:49:03', '2023-07-19 08:49:03'),
(6, 'Olivia', 'Grace', 'Miller', '1998-12-12', 'Female', '+9081723456', 2, '2023-07-19 08:49:03', '2023-07-19 08:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` int(11) NOT NULL,
  `procedure_code` varchar(20) DEFAULT NULL,
  `procedure_name` varchar(100) DEFAULT NULL,
  `procedure_price` decimal(10,2) DEFAULT NULL,
  `procedure_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'this is a test', '2023-07-19 08:28:12', '2023-07-19 08:28:12'),
(2, 'Dentist', 'this is the dentist', '2023-07-19 08:28:12', '2023-07-19 08:28:12'),
(3, 'Cashier', 'this is the cashier', '2023-07-19 08:28:12', '2023-07-19 08:28:12'),
(4, 'Dental_Assistant', 'this is the dental assistant', '2023-07-19 08:28:12', '2023-07-19 08:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `addresses_employees_view`
--
DROP TABLE IF EXISTS `addresses_employees_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_employees_view`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`middle_name` AS `middle_name`, `e`.`last_name` AS `last_name`, `e`.`phone` AS `phone`, `e`.`email` AS `email`, `r`.`role_name` AS `role_name`, `e`.`experience` AS `Experience`, `e`.`qualification` AS `Qualification`, `e`.`gender` AS `gender`, `e`.`profile` AS `profile`, `e`.`hire_date` AS `hire_date`, `e`.`birth_date` AS `birth_date`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state`, `a`.`country` AS `country`, `a`.`zip` AS `zip`, `e`.`created_at` AS `created_at`, `e`.`updated_at` AS `updated_at` FROM ((`employees` `e` join `addresses` `a` on(`e`.`address` = `a`.`address_id`)) join `roles` `r` on(`e`.`role` = `r`.`role_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `addresses_patients_view`
--
DROP TABLE IF EXISTS `addresses_patients_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_patients_view`  AS SELECT `pt`.`patient_id` AS `patient_id`, `pt`.`first_name` AS `first_name`, `pt`.`last_name` AS `last_name`, `pt`.`phone_number` AS `phone_number`, `pt`.`gender` AS `gender`, `pt`.`birth_date` AS `birth_date`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state`, `a`.`country` AS `country`, `a`.`zip` AS `zip`, `pt`.`created_at` AS `created_at`, `pt`.`updated_at` AS `updated_at` FROM (`patients` `pt` join `addresses` `a` on(`pt`.`address` = `a`.`address_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `addresses_supplier_view`
--
DROP TABLE IF EXISTS `addresses_supplier_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_supplier_view`  AS SELECT `s`.`supplier_id` AS `supplier_id`, `s`.`supplier_name` AS `supplier_name`, `s`.`email` AS `email`, `s`.`phone_number` AS `phone_number`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state`, `a`.`country` AS `country`, `a`.`zip` AS `zip`, `s`.`created_at` AS `created_at`, `s`.`updated_at` AS `updated_at` FROM (`suppliers` `s` join `addresses` `a` on(`s`.`address` = `a`.`address_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `appointment_services`
--
ALTER TABLE `appointment_services`
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `role` (`role`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`expense_type_id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medication_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `expense_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `appointment_services`
--
ALTER TABLE `appointment_services`
  ADD CONSTRAINT `appointment_services_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`address`) REFERENCES `addresses` (`address_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`address`) REFERENCES `addresses` (`address_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
