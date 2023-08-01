-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 03:43 PM
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
  `zip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `street`, `city`, `state`, `country`, `zip`) VALUES
(1, 'shibis', 'Mogadishu', 'Banaadir', NULL, NULL),
(2, 'Danwadaagta', 'Mogadishu', 'Banaadir', NULL, NULL),
(3, 'hodan', 'Mogadishu', 'Banaadir', NULL, NULL),
(4, 'Wadajir', 'Mogadishu', 'Banaadir', NULL, NULL),
(5, 'Madino', 'Mogadishu', 'Banaadir', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `addresses_employees_view`
-- (See below for the actual view)
--
CREATE TABLE `addresses_employees_view` (
`employee_id` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`phone` varchar(255)
,`email` varchar(255)
,`role_name` varchar(255)
,`Experience` varchar(50)
,`gender` varchar(20)
,`salary_type` varchar(255)
,`currency` text
,`amount` double
,`hire_date` date
,`street` varchar(255)
,`city` varchar(255)
,`state` varchar(255)
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
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `appointmentdetails`
-- (See below for the actual view)
--
CREATE TABLE `appointmentdetails` (
`appointment_id` int(11)
,`patient_id` int(11)
,`employee_id` int(11)
,`role_id` int(11)
,`service_id` int(11)
,`appointment_type` varchar(50)
,`appointment_status` varchar(20)
,`patient_name` varchar(101)
,`employee_name` varchar(511)
,`employee_role` varchar(255)
,`service_name` varchar(50)
,`service_fee` decimal(10,2)
,`date` date
,`time` time
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
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `Type`, `status`, `date`, `time`, `patient_id`, `employee_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 'walk-in', 'Pending', '2023-07-25', '18:17:10', 3, 2, 'Bro don\'t forget your card', '2023-07-24 06:17:47', '2023-07-29 09:21:22'),
(2, 'Online', 'Approved', '2023-07-30', '01:00:00', 3, 2, 'Do something', '2023-07-29 09:35:57', '2023-07-29 09:50:28'),
(3, 'Walki-In', 'Pending', '2023-07-31', '14:15:00', 3, 1, 'Brudha', '2023-07-29 11:27:23', '2023-07-29 11:27:23'),
(4, 'Online', 'Cancelled', '2023-08-02', '11:45:00', 3, 2, 'WHat!!!', '2023-07-29 11:27:23', '2023-07-29 11:27:37'),
(5, 'Online', 'Pending', '2023-08-05', '09:30:00', 3, 3, 'HEHEHEHEHE', '2023-07-29 11:27:23', '2023-07-29 11:27:42');

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

--
-- Dumping data for table `appointment_services`
--

INSERT INTO `appointment_services` (`appointment_id`, `service`, `created_at`, `updated_at`) VALUES
(1, 'Dental Cleaning', '2023-07-24 06:18:34', '2023-07-24 06:18:34'),
(0, '2,3,4', '2023-07-27 08:49:42', '2023-07-27 08:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_description` text DEFAULT NULL,
  `drug_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `salary_type` varchar(255) NOT NULL DEFAULT 'Monthly',
  `currency` text NOT NULL DEFAULT 'Dollar',
  `amount` double NOT NULL DEFAULT 0,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `role_id`, `experience`, `address`, `gender`, `profile`, `salary_type`, `currency`, `amount`, `hire_date`) VALUES
(2, 'Abdirizak', 'omar', 'Abdi', 'abdirizakomar65@gmail.com', '613324221', 1, '2 years', 1, 'Male', '', 'Monthly', 'Dollar', 1200, '2023-06-12'),
(3, 'farhan', 'omar', 'ali', 'farxan@gmail.com', '614546598', 4, '2 years', 1, 'Male', '', 'Monthly', 'Dollar', 800, '2023-07-20'),
(4, 'Ahmed', 'omar', 'Mukhtar', 'ahmedez@hotmail.com', '0707868481', 2, '2 years', 1, 'Male', '1689748947.php', 'Fixed', 'Dollar', 1000, '2023-07-18');

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
  `maintenance_schedule` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` double NOT NULL,
  `description` varchar(100) NOT NULL,
  `expense_type` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `amount`, `quantity`, `description`, `expense_type`, `date`) VALUES
(4, '10.00', 1, 'fdghdh', 1, '2023-07-07'),
(5, '13.00', 1, 'xfhdfg', 4, '2023-07-12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `expenses_expense_types_view`
-- (See below for the actual view)
--
CREATE TABLE `expenses_expense_types_view` (
`expense_id` int(11)
,`expense_type_id` int(11)
,`description` varchar(100)
,`amount` decimal(10,2)
,`quantity` double
,`date` date
,`expense_type` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `expense_type_id` int(11) NOT NULL,
  `expense_type` varchar(255) DEFAULT NULL,
  `expense_type_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`expense_type_id`, `expense_type`, `expense_type_description`) VALUES
(1, 'water', 'water bill go here'),
(3, 'electricty', 'electricty bill go here'),
(4, 'Traveling', 'travel bill go here');

-- --------------------------------------------------------

--
-- Table structure for table `incometable`
--

CREATE TABLE `incometable` (
  `IncomeID` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `IncomeType` varchar(255) DEFAULT NULL,
  `IncomeAmount` double DEFAULT 0,
  `IncomeAmountPaid` double DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `IncomeDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incometable`
--

INSERT INTO `incometable` (`IncomeID`, `patient_id`, `IncomeType`, `IncomeAmount`, `IncomeAmountPaid`, `discount`, `createdAt`, `IncomeDate`) VALUES
(12, 1, 'Services', 50, 19, 1, '2023-07-17 05:31:35', '2023-07-17'),
(13, 3, 'Services', 20, 10, 0, '2023-07-18 08:24:14', '2023-07-18'),
(14, 2, 'Services', 10, 10, 0, '2023-07-22 06:33:39', '2023-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logincredentials`
--

CREATE TABLE `logincredentials` (
  `employee_id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logincredentials`
--

INSERT INTO `logincredentials` (`employee_id`, `Username`, `Password`, `isAdmin`) VALUES
(2, 'Abdi', '123', 1),
(3, 'fa', '111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `medication_name` varchar(100) DEFAULT NULL,
  `medication_dosage` varchar(100) DEFAULT NULL,
  `medication_description` text DEFAULT NULL
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
  `address` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `phone_number`, `address`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Kamaal', 'Abdirahman', 'Yussuf', '2005-01-01', 'Male', '616347481', '1', 'kool12', 'kool12', '2023-08-01 08:24:34', '2023-08-01 08:32:50'),
(2, 'Stick', 'Abdirahman', 'Man', '2010-06-06', 'Male', '616666666', '1', 'stick4', 'stick4', '2023-08-01 08:24:34', '2023-08-01 08:33:11'),
(3, 'Abdirizak', 'Abdirahman', 'Abdi', '2023-07-11', 'Male', '613324221', '1', 'abdihiga', 'abdihiga', '2023-08-01 08:24:34', '2023-08-01 08:33:30'),
(4, 'Wehliye', 'Sh.Cali', 'Maxamed', '1967-05-16', 'Male', '0619492048', '2', 'wehman', 'denta123', '2023-08-01 08:31:55', '2023-08-01 08:33:37');

--
-- Triggers `patients`
--
DELIMITER $$
CREATE TRIGGER `set_default_username_and_pass` BEFORE INSERT ON `patients` FOR EACH ROW BEGIN
    IF NEW.username IS NULL THEN
        SET NEW.username = CONCAT(SUBSTRING_INDEX(NEW.first_name, ' ', 1), '_', REPLACE(NEW.middle_name, ' ', ''), '_', NEW.last_name);
    END IF;
    
    IF NEW.password IS NULL THEN
        SET NEW.password = 'denta123'; 
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patientservices`
--

CREATE TABLE `patientservices` (
  `patientService_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `cost` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientservices`
--

INSERT INTO `patientservices` (`patientService_id`, `patient_id`, `service_id`, `quantity`, `cost`) VALUES
(55, 1, 2, 1, 50),
(56, 3, 2, 2, 20),
(57, 2, 3, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `patientservicesview`
--

CREATE TABLE `patientservicesview` (
  `patientService_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_name` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_incometable_view`
--

CREATE TABLE `patient_incometable_view` (
  `IncomeID` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `IncomeType` varchar(255) DEFAULT NULL,
  `IncomeAmount` double DEFAULT NULL,
  `IncomeAmountPaid` double DEFAULT NULL,
  `IncomeDate` date DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_service_view`
--

CREATE TABLE `patient_service_view` (
  `patientService_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `Services` bigint(21) DEFAULT NULL,
  `Quantity` bigint(21) DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `medication_id` int(11) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `date_prescribed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptionview`
--

CREATE TABLE `prescriptionview` (
  `prescription_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `medication_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `date_prescribed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` int(11) NOT NULL,
  `procedure_code` varchar(20) DEFAULT NULL,
  `procedure_name` varchar(100) DEFAULT NULL,
  `procedure_price` decimal(10,2) DEFAULT NULL,
  `procedure_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'Dentist', 'dfgsfhgr'),
(2, 'Receptionist', 'FEastrhdyfuk'),
(3, 'Cleaner', 'dfgsfhgr'),
(4, 'Dental Assistant', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `paid_in_full` tinyint(1) DEFAULT NULL,
  `datePaid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `employee_id`, `amount`, `paid_in_full`, `datePaid`) VALUES
(1, 2, 1200, 1, '2023-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `salary_employee_view`
--

CREATE TABLE `salary_employee_view` (
  `salary_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `salary_type` varchar(255) DEFAULT NULL,
  `currency` text DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `datePaid` date DEFAULT NULL,
  `paid_in_full` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `fee`) VALUES
(1, 'Ilig Buuxin', 'fill in teeths', '6.00'),
(2, 'Dental Cleaning', 'Routine cleaning of teeth to remove plaque and tartar', '100.00'),
(3, 'Dental Examination', 'Comprehensive oral examination and assessment', '150.00'),
(4, 'Fillings', 'Restoration of decayed teeth with dental fillings', '200.00'),
(5, 'Dental X-rays', 'Obtaining detailed images of teeth and oral structures', '80.00'),
(6, 'Tooth Extraction', 'Removal of a tooth due to decay or other reasons', '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treatmentplan_patients_view`
--

CREATE TABLE `treatmentplan_patients_view` (
  `treatment_plan_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plans`
--

CREATE TABLE `treatment_plans` (
  `treatment_plan_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `addresses_employees_view`
--
DROP TABLE IF EXISTS `addresses_employees_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_employees_view`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`last_name` AS `last_name`, `e`.`phone` AS `phone`, `e`.`email` AS `email`, `r`.`role_name` AS `role_name`, `e`.`experience` AS `Experience`, `e`.`gender` AS `gender`, `e`.`salary_type` AS `salary_type`, `e`.`currency` AS `currency`, `e`.`amount` AS `amount`, `e`.`hire_date` AS `hire_date`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state` FROM ((`employees` `e` join `addresses` `a` on(`e`.`address` = `a`.`address_id`)) join `roles` `r` on(`e`.`role_id` = `r`.`role_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `addresses_patients_view`
--
DROP TABLE IF EXISTS `addresses_patients_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_patients_view`  AS SELECT `pt`.`patient_id` AS `patient_id`, `pt`.`first_name` AS `first_name`, `pt`.`last_name` AS `last_name`, `pt`.`phone_number` AS `phone_number`, `pt`.`gender` AS `gender`, `pt`.`birth_date` AS `birth_date`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state` FROM (`patients` `pt` join `addresses` `a` on(`pt`.`address` = `a`.`address_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `addresses_supplier_view`
--
DROP TABLE IF EXISTS `addresses_supplier_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `addresses_supplier_view`  AS SELECT `s`.`supplier_id` AS `supplier_id`, `s`.`supplier_name` AS `supplier_name`, `s`.`email` AS `email`, `s`.`phone_number` AS `phone_number`, `a`.`street` AS `street`, `a`.`city` AS `city`, `a`.`state` AS `state` FROM (`suppliers` `s` join `addresses` `a` on(`s`.`address` = `a`.`address_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `appointmentdetails`
--
DROP TABLE IF EXISTS `appointmentdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `appointmentdetails`  AS SELECT `a`.`appointment_id` AS `appointment_id`, `p`.`patient_id` AS `patient_id`, `e`.`employee_id` AS `employee_id`, `r`.`role_id` AS `role_id`, `s`.`service_id` AS `service_id`, `a`.`Type` AS `appointment_type`, `a`.`status` AS `appointment_status`, concat(`p`.`first_name`,' ',`p`.`last_name`) AS `patient_name`, concat(`e`.`first_name`,' ',`e`.`last_name`) AS `employee_name`, `r`.`role_name` AS `employee_role`, `s`.`name` AS `service_name`, `s`.`fee` AS `service_fee`, `a`.`date` AS `date`, `a`.`time` AS `time`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at` FROM (((((`appointments` `a` join `patients` `p` on(`a`.`patient_id` = `p`.`patient_id`)) join `employees` `e` on(`a`.`employee_id` = `e`.`employee_id`)) join `roles` `r` on(`e`.`role_id` = `r`.`role_id`)) join `appointment_services` `aps` on(`a`.`appointment_id` = `aps`.`appointment_id`)) join `services` `s` on(`aps`.`service` = `s`.`name`))  ;

-- --------------------------------------------------------

--
-- Structure for view `expenses_expense_types_view`
--
DROP TABLE IF EXISTS `expenses_expense_types_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expenses_expense_types_view`  AS SELECT `e`.`expense_id` AS `expense_id`, `et`.`expense_type_id` AS `expense_type_id`, `e`.`description` AS `description`, `e`.`amount` AS `amount`, `e`.`quantity` AS `quantity`, `e`.`date` AS `date`, `et`.`expense_type` AS `expense_type` FROM (`expenses` `e` join `expense_types` `et` on(`e`.`expense_type` = `et`.`expense_type_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
