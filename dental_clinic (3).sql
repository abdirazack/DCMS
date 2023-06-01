-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 08:12 PM
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
-- Stand-in structure for view `appointmentdetails`
-- (See below for the actual view)
--
CREATE TABLE `appointmentdetails` (
`appointment_id` int(11)
,`Type` varchar(50)
,`status` varchar(20)
,`start_date` datetime
,`end_date` datetime
,`patient_id` int(11)
,`patient_first_name` varchar(50)
,`patient_last_name` varchar(50)
,`dentists_id` int(11)
,`dentist_first_name` varchar(255)
,`dentist_last_name` varchar(255)
,`service_id` int(11)
,`services_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `Type`, `status`, `start_date`, `end_date`, `patient_id`, `employee_id`, `service_id`) VALUES
(1, 'Walk-in', 'Pending', '2023-05-30 07:25:00', '2023-05-31 23:29:00', 1, 6, 1),
(3, 'Walk-in', 'Arrived', '2023-05-29 07:34:00', '2023-05-31 23:38:00', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dentalcharts`
--

CREATE TABLE `dentalcharts` (
  `dental_chart_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `chart_image` varchar(200) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `employee_id` int(11) NOT NULL,
  `Specialty` varchar(255) DEFAULT NULL,
  `Qualification` varchar(255) DEFAULT NULL,
  `Experience` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`employee_id`, `Specialty`, `Qualification`, `Experience`) VALUES
(1, 'Extraction', ' BDS and BChD', '5yers'),
(6, 'Fillings', ' BDS', '3 years');

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

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drug_id`, `drug_name`, `drug_description`, `drug_cost`) VALUES
(1, 'DawaZone', ' For allergies', '20.00'),
(3, '2022', ' dsrtgyu', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `gender`, `hire_date`) VALUES
(1, 'Abdirizak', 'Abdi', 'abdirizakomar65@gmail.com', '613324221', 'Mogadishu, Somalia', 'Male', '2023-05-29'),
(5, 'Fatuma', 'Abdi', 'abdirizakomar65@gmail.com', '613324221', 'Mogadishu, Somalia', 'Female', '2023-05-02'),
(6, 'Hanifa', 'Hassan', 'abdirizakomar254@gmail.com', '613324221', 'Mogadishu, Somalia', 'Female', '2023-01-09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_dentist_view`
-- (See below for the actual view)
--
CREATE TABLE `employee_dentist_view` (
`employee_id` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`Specialty` varchar(255)
,`Qualification` varchar(255)
,`Experience` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_login_view`
-- (See below for the actual view)
--
CREATE TABLE `employee_login_view` (
`employee_id` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`role` varchar(7)
,`Username` varchar(255)
,`Password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_stuff_view`
-- (See below for the actual view)
--
CREATE TABLE `employee_stuff_view` (
`employee_id` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`role_name` varchar(255)
,`Experience` varchar(50)
);

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

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment_type`, `manufacturer`, `model`, `purchase_date`, `warranty_information`, `maintenance_schedule`) VALUES
(1, 'Dentist Chair', 'abdi ltd', 'dsf43', '2023-05-07', 'eryitrertrdydh', NULL),
(2, 'Dentist Chair', 'abdi ltd', 'dsf43', '2023-05-07', 'information:', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `Quantity` double NOT NULL,
  `expense_type` enum('purchasing','selling','other') NOT NULL,
  `drug_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `expenses_drug_view`
-- (See below for the actual view)
--
CREATE TABLE `expenses_drug_view` (
`expense_id` int(11)
,`date` date
,`description` varchar(100)
,`amount` decimal(10,2)
,`Quantity` double
,`expense_type` enum('purchasing','selling','other')
,`drug_id` int(11)
,`drug_name` varchar(50)
);

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logincredentials`
--

CREATE TABLE `logincredentials` (
  `employee_id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logincredentials`
--

INSERT INTO `logincredentials` (`employee_id`, `Username`, `Password`) VALUES
(1, 'Abdi', '666'),
(5, 'Fatuma', '111'),
(6, 'hanifa', '123');

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

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medication_id`, `medication_name`, `medication_dosage`, `medication_description`) VALUES
(1, 'DawaZone', 'rfg', ' For sneezing alergies'),
(2, 'Bronze', 'fygh', ' serdt');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `birth_date`, `gender`, `phone_number`, `address`) VALUES
(1, 'Abdirizak', 'Abdi', '2023-05-01', 'Male', '613324221', 'Danwadaagta street, Wadajir District, Mogadishu, Somalia');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_due` double NOT NULL,
  `description` text DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `patient_id`, `amount`, `amount_paid`, `amount_due`, `description`, `date_paid`, `payment_method`) VALUES
(1, 1, 6, 4, 2, 'ersdyhgxh', '2023-06-01', 'EVC+');

-- --------------------------------------------------------

--
-- Stand-in structure for view `payments_patients_view`
-- (See below for the actual view)
--
CREATE TABLE `payments_patients_view` (
`payment_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`amount` double
,`amount_paid` double
,`amount_due` double
,`description` text
,`date_paid` date
,`payment_method` varchar(50)
);

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

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `patient_id`, `medication_id`, `dosage`, `instructions`, `date_prescribed`) VALUES
(1, 1, 1, 'test3', '3X3', '2023-05-02');

-- --------------------------------------------------------

--
-- Stand-in structure for view `prescriptionview`
-- (See below for the actual view)
--
CREATE TABLE `prescriptionview` (
`prescription_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`medication_name` varchar(100)
,`dosage` varchar(100)
,`instruction` text
,`date_prescribed` date
);

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

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedure_id`, `procedure_code`, `procedure_name`, `procedure_price`, `procedure_description`) VALUES
(1, 'DS101', 'EXTRACTION', '21.00', ' TOOTH EXTRACTION');

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
(1, 'Receptionist', 'Register'),
(2, 'Cleaner', 'FEastrhdyfuk');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `Amount` double DEFAULT 0,
  `datePaid` date DEFAULT NULL,
  `SalaryType` varchar(255) DEFAULT NULL,
  `Currency` varchar(50) DEFAULT NULL,
  `PaymentFrequency` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `employee_id`, `Amount`, `datePaid`, `SalaryType`, `Currency`, `PaymentFrequency`) VALUES
(1, 1, 49, '2023-06-07', 'Fixed', 'Dollar', 'Weekly');

-- --------------------------------------------------------

--
-- Stand-in structure for view `salary_employee_view`
-- (See below for the actual view)
--
CREATE TABLE `salary_employee_view` (
`salary_id` int(11)
,`employee_id` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`SalaryType` varchar(255)
,`Currency` varchar(50)
,`PaymentFrequency` varchar(50)
,`Amount` double
,`datePaid` date
);

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
(1, 'test1', 'sdfghf', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `employee_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `Experience` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`employee_id`, `role_id`, `Experience`) VALUES
(5, 1, '2 years');

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
-- Structure for view `appointmentdetails`
--
DROP TABLE IF EXISTS `appointmentdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `appointmentdetails`  AS SELECT `a`.`appointment_id` AS `appointment_id`, `a`.`Type` AS `Type`, `a`.`status` AS `status`, `a`.`start_date` AS `start_date`, `a`.`end_date` AS `end_date`, `p`.`patient_id` AS `patient_id`, `p`.`first_name` AS `patient_first_name`, `p`.`last_name` AS `patient_last_name`, `d`.`employee_id` AS `dentists_id`, `d`.`first_name` AS `dentist_first_name`, `d`.`last_name` AS `dentist_last_name`, `s`.`service_id` AS `service_id`, `s`.`name` AS `services_name` FROM (((`appointments` `a` join `patients` `p` on(`a`.`patient_id` = `p`.`patient_id`)) join `employees` `d` on(`a`.`employee_id` = `d`.`employee_id`)) join `services` `s` on(`a`.`service_id` = `s`.`service_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_dentist_view`
--
DROP TABLE IF EXISTS `employee_dentist_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_dentist_view`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`last_name` AS `last_name`, `d`.`Specialty` AS `Specialty`, `d`.`Qualification` AS `Qualification`, `d`.`Experience` AS `Experience` FROM (`employees` `e` join `dentists` `d` on(`e`.`employee_id` = `d`.`employee_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_login_view`
--
DROP TABLE IF EXISTS `employee_login_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_login_view`  AS SELECT `employees`.`employee_id` AS `employee_id`, `employees`.`first_name` AS `first_name`, `employees`.`last_name` AS `last_name`, CASE WHEN `dentists`.`employee_id` is not null THEN 'Dentist' WHEN `staff`.`employee_id` is not null THEN 'Staff' ELSE NULL END AS `role`, `logincredentials`.`Username` AS `Username`, `logincredentials`.`Password` AS `Password` FROM (((`employees` left join `dentists` on(`employees`.`employee_id` = `dentists`.`employee_id`)) left join `staff` on(`employees`.`employee_id` = `staff`.`employee_id`)) join `logincredentials` on(`employees`.`employee_id` = `logincredentials`.`employee_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_stuff_view`
--
DROP TABLE IF EXISTS `employee_stuff_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_stuff_view`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`last_name` AS `last_name`, `r`.`role_name` AS `role_name`, `s`.`Experience` AS `Experience` FROM ((`employees` `e` join `staff` `s` on(`e`.`employee_id` = `s`.`employee_id`)) join `roles` `r` on(`s`.`role_id` = `r`.`role_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `expenses_drug_view`
--
DROP TABLE IF EXISTS `expenses_drug_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expenses_drug_view`  AS SELECT `e`.`expense_id` AS `expense_id`, `e`.`date` AS `date`, `e`.`description` AS `description`, `e`.`amount` AS `amount`, `e`.`Quantity` AS `Quantity`, `e`.`expense_type` AS `expense_type`, `d`.`drug_id` AS `drug_id`, `d`.`drug_name` AS `drug_name` FROM (`expenses` `e` left join `drugs` `d` on(`e`.`drug_id` = `d`.`drug_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `payments_patients_view`
--
DROP TABLE IF EXISTS `payments_patients_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payments_patients_view`  AS SELECT `p`.`payment_id` AS `payment_id`, `pt`.`first_name` AS `first_name`, `pt`.`last_name` AS `last_name`, `p`.`amount` AS `amount`, `p`.`amount_paid` AS `amount_paid`, `p`.`amount_due` AS `amount_due`, `p`.`description` AS `description`, `p`.`date_paid` AS `date_paid`, `p`.`payment_method` AS `payment_method` FROM (`payments` `p` join `patients` `pt` on(`p`.`patient_id` = `pt`.`patient_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `prescriptionview`
--
DROP TABLE IF EXISTS `prescriptionview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prescriptionview`  AS SELECT `p`.`prescription_id` AS `prescription_id`, `pt`.`first_name` AS `first_name`, `pt`.`last_name` AS `last_name`, `m`.`medication_name` AS `medication_name`, `p`.`dosage` AS `dosage`, `p`.`instructions` AS `instruction`, `p`.`date_prescribed` AS `date_prescribed` FROM ((`prescriptions` `p` join `patients` `pt` on(`p`.`patient_id` = `pt`.`patient_id`)) join `medications` `m` on(`p`.`medication_id` = `m`.`medication_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `salary_employee_view`
--
DROP TABLE IF EXISTS `salary_employee_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salary_employee_view`  AS SELECT `s`.`salary_id` AS `salary_id`, `s`.`employee_id` AS `employee_id`, `e`.`first_name` AS `first_name`, `e`.`last_name` AS `last_name`, `s`.`SalaryType` AS `SalaryType`, `s`.`Currency` AS `Currency`, `s`.`PaymentFrequency` AS `PaymentFrequency`, `s`.`Amount` AS `Amount`, `s`.`datePaid` AS `datePaid` FROM (`salary` `s` join `employees` `e` on(`s`.`employee_id` = `e`.`employee_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `dentalcharts`
--
ALTER TABLE `dentalcharts`
  ADD PRIMARY KEY (`dental_chart_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `logincredentials`
--
ALTER TABLE `logincredentials`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medication_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `medication_id` (`medication_id`);

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
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  ADD PRIMARY KEY (`treatment_plan_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dentalcharts`
--
ALTER TABLE `dentalcharts`
  MODIFY `dental_chart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  MODIFY `treatment_plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `dentalcharts`
--
ALTER TABLE `dentalcharts`
  ADD CONSTRAINT `dentalcharts_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `dentists`
--
ALTER TABLE `dentists`
  ADD CONSTRAINT `dentists_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`drug_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `logincredentials`
--
ALTER TABLE `logincredentials`
  ADD CONSTRAINT `logincredentials_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `treatment_plans`
--
ALTER TABLE `treatment_plans`
  ADD CONSTRAINT `treatment_plans_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
