/* Tables */

/* Address */


CREATE TABLE `addresses` (
 `address_id` int(11) NOT NULL AUTO_INCREMENT,
 `street` varchar(255) DEFAULT NULL,
 `city` varchar(255) DEFAULT NULL,
 `state` varchar(255) DEFAULT NULL,
 `country` varchar(255) DEFAULT NULL,
 `zip` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* roles	 */


CREATE TABLE `roles` (
 `role_id` int(11) NOT NULL AUTO_INCREMENT,
 `role_name` varchar(255) DEFAULT NULL,
 `role_description` text DEFAULT NULL,
 PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* expense_types	 */


CREATE TABLE `expense_types` (
 `expense_type_id` int(11) NOT NULL AUTO_INCREMENT,
 `expense_type` varchar(255) DEFAULT NULL,
 `expense_type_description` varchar(255) NOT NULL,
 PRIMARY KEY (`expense_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

/* procedures	 */


CREATE TABLE `procedures` (
 `procedure_id` int(11) NOT NULL AUTO_INCREMENT,
 `procedure_code` varchar(20) DEFAULT NULL,
 `procedure_name` varchar(100) DEFAULT NULL,
 `procedure_price` decimal(10,2) DEFAULT NULL,
 `procedure_description` text DEFAULT NULL,
 PRIMARY KEY (`procedure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* drugs	 */

CREATE TABLE `drugs` (
 `drug_id` int(11) NOT NULL AUTO_INCREMENT,
 `drug_name` varchar(50) NOT NULL,
 `drug_description` text DEFAULT NULL,
 `drug_cost` decimal(10,2) NOT NULL,
 PRIMARY KEY (`drug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* equipment	 */

CREATE TABLE `equipment` (
 `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
 `equipment_type` varchar(100) DEFAULT NULL,
 `manufacturer` varchar(100) DEFAULT NULL,
 `model` varchar(100) DEFAULT NULL,
 `purchase_date` date DEFAULT NULL,
 `warranty_information` varchar(200) DEFAULT NULL,
 `maintenance_schedule` varchar(200) DEFAULT NULL,
 PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* medications	 */


CREATE TABLE `medications` (
 `medication_id` int(11) NOT NULL AUTO_INCREMENT,
 `medication_name` varchar(100) DEFAULT NULL,
 `medication_dosage` varchar(100) DEFAULT NULL,
 `medication_description` text DEFAULT NULL,
 PRIMARY KEY (`medication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* services	 */


CREATE TABLE `services` (
 `service_id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(50) NOT NULL,
 `description` text DEFAULT NULL,
 `fee` decimal(10,2) NOT NULL,
 PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



/* suppliers	 */


CREATE TABLE `suppliers` (
 `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
 `supplier_name` varchar(100) DEFAULT NULL,
 `email` varchar(100) DEFAULT NULL,
 `phone_number` varchar(20) DEFAULT NULL,
 `address` varchar(200) DEFAULT NULL,
 PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* patients	 */


CREATE TABLE `patients` (
 `patient_id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(50) NOT NULL,
 `last_name` varchar(50) NOT NULL,
 `birth_date` date NOT NULL,
 `gender` enum('Male','Female','Other') NOT NULL,
 `phone_number` varchar(20) NOT NULL,
 `address` varchar(255) NOT NULL,
 PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* appointments	 */


CREATE TABLE `appointments` (
 `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
 `Type` varchar(50) DEFAULT NULL,
 `status` varchar(20) DEFAULT NULL,
 `date` date DEFAULT NULL,
 `time` time DEFAULT NULL,
 `patient_id` int(11) DEFAULT NULL,
 `employee_id` int(11) DEFAULT NULL,
 `service_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`appointment_id`),
 KEY `patient_id` (`patient_id`),
 KEY `employee_id` (`employee_id`),
 KEY `service_id` (`service_id`),
 CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
 CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
 CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci




/* employees	 */

CREATE TABLE `employees` (
 `employee_id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) DEFAULT NULL,
 `last_name` varchar(255) DEFAULT NULL,
 `email` varchar(255) DEFAULT NULL,
 `phone` varchar(255) DEFAULT NULL,
 `role_id` int(11) DEFAULT NULL,
 `qualification` varchar(255) DEFAULT NULL,
 `experience` varchar(50) DEFAULT NULL,
 `address` int(11) DEFAULT NULL,
 `gender` varchar(20) DEFAULT NULL,
 `profile` varchar(255) DEFAULT NULL,
 `hire_date` date DEFAULT NULL,
 PRIMARY KEY (`employee_id`),
 KEY `address` (`address`),
 KEY `role_id` (`role_id`),
 CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`address`) REFERENCES `addresses` (`address_id`),
 CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



/* expenses	 */

CREATE TABLE `expenses` (
 `expense_id` int(11) NOT NULL AUTO_INCREMENT,
 `amount` decimal(10,2) NOT NULL,
 `quantity` double NOT NULL,
 `description` varchar(100) NOT NULL,
 `expense_type` int(11) DEFAULT NULL,
 `date` date NOT NULL,
 PRIMARY KEY (`expense_id`),
 KEY `expense_type` (`expense_type`),
 CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`expense_type`) REFERENCES `expense_types` (`expense_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci




/* incometable	 */


CREATE TABLE `incometable` (
 `IncomeID` int(11) NOT NULL AUTO_INCREMENT,
 `patient_id` int(11) DEFAULT NULL,
 `IncomeType` varchar(255) DEFAULT NULL,
 `IncomeAmount` double DEFAULT 0,
 `IncomeAmountPaid` double DEFAULT 0,
 `discount` double NOT NULL DEFAULT 0,
 `createdAt` timestamp NULL DEFAULT current_timestamp(),
 `IncomeDate` date DEFAULT NULL,
 PRIMARY KEY (`IncomeID`),
 KEY `patient_id` (`patient_id`),
 CONSTRAINT `incometable_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



/* inventory	 */


CREATE TABLE `inventory` (
 `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
 `item_name` varchar(100) DEFAULT NULL,
 `description` text DEFAULT NULL,
 `unit_cost` decimal(10,2) DEFAULT NULL,
 `quantity` int(11) DEFAULT NULL,
 `supplier_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`inventory_id`),
 KEY `supplier_id` (`supplier_id`),
 CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* logincredentials	 */


CREATE TABLE `logincredentials` (
 `employee_id` int(11) NOT NULL,
 `Username` varchar(255) DEFAULT NULL,
 `Password` varchar(255) DEFAULT NULL,
 `isAdmin` tinyint(1) DEFAULT NULL,
 PRIMARY KEY (`employee_id`),
 CONSTRAINT `logincredentials_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci



/* patientservices	 */


CREATE TABLE `patientservices` (
 `patientService_id` int(11) NOT NULL AUTO_INCREMENT,
 `patient_id` int(11) DEFAULT NULL,
 `service_id` int(11) DEFAULT NULL,
 `quantity` int(11) DEFAULT 0,
 `cost` double DEFAULT 0,
 PRIMARY KEY (`patientService_id`),
 KEY `patient_id` (`patient_id`),
 KEY `service_id` (`service_id`),
 CONSTRAINT `patientservices_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
 CONSTRAINT `patientservices_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* prescriptions	 */


CREATE TABLE `prescriptions` (
 `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
 `patient_id` int(11) DEFAULT NULL,
 `medication_id` int(11) DEFAULT NULL,
 `dosage` varchar(100) DEFAULT NULL,
 `instructions` text DEFAULT NULL,
 `date_prescribed` date DEFAULT NULL,
 PRIMARY KEY (`prescription_id`),
 KEY `patient_id` (`patient_id`),
 KEY `medication_id` (`medication_id`),
 CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`),
 CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

/* salary	 */



CREATE TABLE `salary` (
 `salary_id` int(11) NOT NULL AUTO_INCREMENT,
 `employee_id` int(11) DEFAULT NULL,
 `Amount` double DEFAULT 0,
 `datePaid` date DEFAULT NULL,
 `SalaryType` varchar(255) DEFAULT NULL,
 `Currency` varchar(50) DEFAULT NULL,
 `PaymentFrequency` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`salary_id`),
 KEY `employee_id` (`employee_id`),
 CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


/* treatment_plans	 */



CREATE TABLE `treatment_plans` (
 `treatment_plan_id` int(11) NOT NULL AUTO_INCREMENT,
 `patient_id` int(11) DEFAULT NULL,
 `start_date` date DEFAULT NULL,
 `end_date` date DEFAULT NULL,
 `total_cost` decimal(10,2) DEFAULT NULL,
 `status` varchar(20) DEFAULT NULL,
 PRIMARY KEY (`treatment_plan_id`),
 KEY `patient_id` (`patient_id`),
 CONSTRAINT `treatment_plans_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ciViews



/* View	 */



/* addresses_employees_view	 */

CREATE  VIEW `addresses_employees_view` 
AS 
select 
    `e`.`employee_id` AS `employee_id`,
    `e`.`first_name` AS `first_name`,
    `e`.`last_name` AS `last_name`,
    `e`.`phone` AS `phone`,
    `e`.`email` AS `email`,
    `r`.`role_name` AS `role_name`,
    `e`.`experience` AS `Experience`,
    `e`.`qualification` AS `Qualification`,
    `e`.`gender` AS `gender`,
    `e`.`hire_date` AS `hire_date`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state` 
from ((`employees` `e` join `addresses` `a` on(`e`.`address` = `a`.`address_id`)) join `roles` `r` on(`e`.`role_id` = `r`.`role_id`))

/* addresses_patients_view	 */

CREATE  VIEW `addresses_patients_view` 
AS 
select 
    `pt`.`patient_id` AS `patient_id`,
    `pt`.`first_name` AS `first_name`,
    `pt`.`last_name` AS `last_name`,
    `pt`.`phone_number` AS `phone_number`,
    `pt`.`gender` AS `gender`,
    `pt`.`birth_date` AS `birth_date`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state` 
from (`patients` `pt` join `addresses` `a` on(`pt`.`address` = `a`.`address_id`))

/* addresses_supplier_view	 */

CREATE  VIEW `addresses_supplier_view` 
AS 
select 
    `s`.`supplier_id` AS `supplier_id`,
    `s`.`supplier_name` AS `supplier_name`,
    `s`.`email` AS `email`,
    `s`.`phone_number` AS `phone_number`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state` 
from (`suppliers` `s` join `addresses` `a` on(`s`.`address` = `a`.`address_id`))

/* appointmentdetails	 */

CREATE  VIEW `appointmentdetails` 
AS 
select 
    `a`.`appointment_id` AS `appointment_id`,
    `a`.`Type` AS `Type`,`a`.`status` AS `status`,
    `a`.`date` AS `date`,
    `a`.`time` AS `time`,
    `p`.`patient_id` AS `patient_id`,
    `p`.`first_name` AS `patient_first_name`,
    `p`.`last_name` AS `patient_last_name`,
    `d`.`employee_id` AS `employee_id`,
    `d`.`first_name` AS `employee_first_name`,
    `d`.`last_name` AS `employee_last_name`,
    `s`.`service_id` AS `service_id`,`s`.`name` AS `services_name` 
from (((`appointments` `a` join `patients` `p` on(`a`.`patient_id` = `p`.`patient_id`)) join `employees` `d` on(`a`.`employee_id` = `d`.`employee_id`)) join `services` `s` on(`a`.`service_id` = `s`.`service_id`))

/* expenses_expense_types_view	 */

CREATE  VIEW `expenses_expense_types_view` 
AS 
select 
    `e`.`expense_id` AS `expense_id`,
    `et`.`expense_type_id` AS `expense_type_id`,
    `e`.`description` AS `description`,
    `e`.`amount` AS `amount`,
    `e`.`quantity` AS `quantity`,
    `e`.`date` AS `date`,
    `et`.`expense_type` AS `expense_type` 
from (`expenses` `e` join `expense_types` `et` on(`e`.`expense_type` = `et`.`expense_type_id`))

/* incometableview	 */

CREATE  VIEW `incometableview` 
AS
select 
    `incometable`.`IncomeID` AS `IncomeID`,
    `incometable`.`patient_id` AS `patient_id`,
    `incometable`.`IncomeType` AS `IncomeType`,
    `incometable`.`IncomeAmount` AS `IncomeAmount`,
    `incometable`.`IncomeAmountPaid` AS `IncomeAmountPaid`,
    `incometable`.`createdAt` AS `createdAt`,
    `incometable`.`IncomeDate` AS `IncomeDate`,
    `incometable`.`discount` AS `discount` 
from `incometable`

/* logincredentialsview	 */

CREATE  VIEW `logincredentialsview` 
AS 
select 
    `employees`.`employee_id` AS `employee_id`,
    `employees`.`first_name` AS `first_name`,
    `employees`.`last_name` AS `last_name`,
    `roles`.`role_name` AS `role_name`,
    `logincredentials`.`Username` AS `Username`,
    `logincredentials`.`Password` AS `Password`,`
    logincredentials`.`isAdmin` AS `isAdmin` 
from ((`employees` join `logincredentials` on(`employees`.`employee_id` = `logincredentials`.`employee_id`)) join `roles` on(`employees`.`role_id` = `roles`.`role_id`))

/* patientservicesview	 */

CREATE  VIEW `patientservicesview` 
AS 
select 
    `patientservices`.`patientService_id` AS `patientService_id`,
    `patients`.`patient_id` AS `patient_id`,
    `patients`.`first_name` AS `first_name`,
    `patients`.`last_name` AS `last_name`,
    `services`.`service_id` AS `service_id`,
    `services`.`name` AS `service_name`,
    `patientservices`.`quantity` AS `quantity`,
    `patientservices`.`cost` AS `cost` 
from ((`patientservices` join `patients` on(`patientservices`.`patient_id` = `patients`.`patient_id`)) join `services` on(`patientservices`.`service_id` = `services`.`service_id`))

/* patient_incometable_view	 */

CREATE  VIEW `patient_incometable_view` 
AS 
select 
    `i`.`IncomeID` AS `IncomeID`,
    `i`.`patient_id` AS `patient_id`,
    `i`.`IncomeType` AS `IncomeType`,
    `i`.`IncomeAmount` AS `IncomeAmount`,
    `i`.`IncomeAmountPaid` AS `IncomeAmountPaid`,
    `i`.`IncomeDate` AS `IncomeDate`,
    `p`.`first_name` AS `first_name`,
    `p`.`last_name` AS `last_name`,
    `i`.`discount` AS `discount` 
from (`patients` `p` join `incometable` `i` on(`p`.`patient_id` = `i`.`patient_id`))

/* patient_service_view	 */

CREATE  VIEW `patient_service_view` 
AS 
select 
    `patientservices`.`patientService_id` AS `patientService_id`,
    `patientservices`.`patient_id` AS `patient_id`,
    count(`patientservices`.`service_id`) AS `Services`,
    count(`patientservices`.`quantity`) AS `Quantity`,
    sum(`patientservices`.`cost`) AS `Total`,
    `p`.`first_name` AS `first_name`,
    `p`.`last_name` AS `last_name` 
from (`patientservices` join `patients` `p` on(`patientservices`.`patient_id` = `p`.`patient_id`)) group by `patientservices`.`patient_id`


/* prescriptionview	 */

CREATE  VIEW `prescriptionview` 
AS 
select 
    `p`.`prescription_id` AS `prescription_id`,
    `pt`.`first_name` AS `first_name`,
    `pt`.`last_name` AS `last_name`,
    `m`.`medication_name` AS `medication_name`,
    `p`.`dosage` AS `dosage`,
    `p`.`instructions` AS `instruction`,
    `p`.`date_prescribed` AS `date_prescribed` 
from ((`prescriptions` `p` join `patients` `pt` on(`p`.`patient_id` = `pt`.`patient_id`)) join `medications` `m` on(`p`.`medication_id` = `m`.`medication_id`))


/* salary_employee_view	 */

CREATE  VIEW `salary_employee_view` 
AS 
select 
    `s`.`salary_id` AS `salary_id`,
    `s`.`employee_id` AS `employee_id`,
    `e`.`first_name` AS `first_name`,
    `e`.`last_name` AS `last_name`,
    `s`.`SalaryType` AS `SalaryType`,
    `s`.`Currency` AS `Currency`,
    `s`.`PaymentFrequency` AS `PaymentFrequency`,
    `s`.`Amount` AS `Amount`,
    `s`.`datePaid` AS `datePaid` 
from (`salary` `s` join `employees` `e` on(`s`.`employee_id` = `e`.`employee_id`))


/* treatmentplan_patients_view	 */

CREATE  VIEW `treatmentplan_patients_view` 
AS 
select 
    `tp`.`treatment_plan_id` AS `treatment_plan_id`,
    `pt`.`first_name` AS `first_name`,
    `pt`.`last_name` AS `last_name`,
    `tp`.`start_date` AS `start_date`,
    `tp`.`end_date` AS `end_date`,
    `tp`.`total_cost` AS `total_cost`,
    `tp`.`status` AS `status` 
from (`treatment_plans` `tp` join `patients` `pt` on(`tp`.`patient_id` = `pt`.`patient_id`))