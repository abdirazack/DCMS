--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `supplier_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
);

-- --------------------------------------------------------
--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `drug_name` varchar(50) NOT NULL,
  `drug_description` text DEFAULT NULL,
  `drug_cost` decimal(10,2) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `equipment_type` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_information` varchar(200) DEFAULT NULL,
  `maintenance_schedule` varchar(200) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `medication_name` varchar(100) DEFAULT NULL,
  `medication_dosage` varchar(100) DEFAULT NULL,
  `medication_description` text DEFAULT NULL
);


-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `procedure_code` varchar(20) DEFAULT NULL,
  `procedure_name` varchar(100) DEFAULT NULL,
  `procedure_price` decimal(10,2) DEFAULT NULL,
  `procedure_description` text DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `Addresses`
--

CREATE TABLE Addresses (
    address_id INT PRIMARY KEY AUTO_INCREMENT,
    street VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    country VARCHAR(255),
    zip VARCHAR(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE Roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(255),
    role_description TEXT
);

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--

CREATE TABLE Employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    address INT,
    gender VARCHAR(20),
    profile VARCHAR(255),
    hire_date DATE,
    FOREIGN KEY (Address) REFERENCES Addresses(address_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `Dentists`
--

CREATE TABLE Dentists (
    employee_id INT PRIMARY KEY,
    Specialty VARCHAR(255),
    Qualification VARCHAR(255),
    Experience VARCHAR(50),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `Stuff`
--

CREATE TABLE Staff (
    employee_id INT PRIMARY KEY ,
    role_id INT,
    Experience VARCHAR(50),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);


-- --------------------------------------------------------
--
-- Table structure for table `LoginCredentials`


CREATE TABLE LoginCredentials (
    employee_id INT PRIMARY KEY,
    Username VARCHAR(255),
    Password VARCHAR(255),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id)
);

-- --------------------------------------------------------

-- 
-- Table structure for table `Payments`
--

CREATE TABLE Payments (
  payment_id INT PRIMARY KEY AUTO_INCREMENT,
  patient_id INT,
  amount DOUBLE DEFAULT 0.0,
  amount_paid DOUBLE DEFAULT 0.0,
  amount_due DOUBLE DEFAULT 0.0,
  description TEXT,
  date_paid DATE,
  payment_method VARCHAR(50),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `Prescriptions`
--

CREATE TABLE Prescriptions (
  prescription_id INT PRIMARY KEY AUTO_INCREMENT,
  patient_id INT,
  medication_id INT,
  dosage VARCHAR(100),
  instructions TEXT,
  date_prescribed DATE,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
  FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `Salary`
--

CREATE TABLE Salary (
    salary_id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT,
    Amount DOUBLE DEFAULT 0.0,
    datePaid DATE,
    SalaryType VARCHAR(255),
    Currency VARCHAR(50),
    PaymentFrequency VARCHAR(50),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id)
);

-- --------------------------------------------------------



--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `Quantity` double NOT NULL,
  `expense_type` enum('purchasing','selling','other') NOT NULL,
  `drug_id` int(11) DEFAULT NULL,
  FOREIGN KEY (drug_id) REFERENCES drugs(drug_id)
);


-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `item_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id)
);


-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plans`
--

CREATE TABLE `treatment_plans` (
  `treatment_plan_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Type` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
  FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
  FOREIGN KEY (service_id) REFERENCES services(service_id)
);


-- --------------------------------------------------------

--
-- Structure for view `appointmentdetails`
--


CREATE  VIEW `appointmentdetails`  
AS 
SELECT 
    `a`.`appointment_id` AS `appointment_id`, 
    `a`.`Type` AS `Type`, 
    `a`.`status` AS `status`, 
    `a`.`start_date` AS `start_date`, 
    `a`.`end_date` AS `end_date`, 
    `p`.`patient_id` AS `patient_id`, 
    `p`.`first_name` AS `patient_first_name`, 
    `p`.`last_name` AS `patient_last_name`, 
    `d`.`employee_id` AS `dentists_id`, 
    `d`.`first_name` AS `dentist_first_name`, 
    `d`.`last_name` AS `dentist_last_name`, 
    `s`.`service_id` AS `service_id`, 
    `s`.`name` AS `services_name` 
    FROM (((`appointments` `a` join `patients` `p` on(`a`.`patient_id` = `p`.`patient_id`)) join `Employees` `d` on(`a`.`employee_id` = `d`.`employee_id`)) join `services` `s` on(`a`.`service_id` = `s`.`service_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `expenses_drug_view`
--
CREATE  VIEW `expenses_drug_view`  
AS 
SELECT 
    `e`.`expense_id` AS `expense_id`, 
    `e`.`date` AS `date`, 
    `e`.`description` AS `description`, 
    `e`.`amount` AS `amount`, 
    `e`.`Quantity` AS `Quantity`, 
    `e`.`expense_type` AS `expense_type`, 
    `d`.`drug_id` AS `drug_id`, 
    `d`.`drug_name` AS `drug_name` 
    FROM (`expenses` `e` left join `drugs` `d` on(`e`.`drug_id` = `d`.`drug_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `expenses_inventory_view`
--
CREATE VIEW `employee_stuff_view`
AS
SELECT 
    `e`.`employee_id` AS `employee_id`, 
    `e`.`first_name` AS `first_name`, 
    `e`.`last_name` AS `last_name`, 
    `R`.`role_name` AS `role_name`,
    `s`.`Experience` AS `Experience` 
    FROM (`Employees` `e` join `Staff` `s` on(`e`.`employee_id` = `s`.`employee_id`) join `Roles` `R` on(`s`.`role_id` = `R`.`role_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_dentist_view`
--

CREATE VIEW `employee_dentist_view`
AS
SELECT 
    `e`.`employee_id` AS `employee_id`, 
    `e`.`first_name` AS `first_name`, 
    `e`.`last_name` AS `last_name`, 
    `d`.`Specialty` AS `Specialty`, 
    `d`.`Qualification` AS `Qualification`, 
    `d`.`Experience` AS `Experience` 
    FROM (`Employees` `e` join `Dentists` `d` on(`e`.`employee_id` = `d`.`employee_id`))  ;

-- --------------------------------------------------------
--
-- Structure for view `employee_Login_view`
--

CREATE VIEW LoginCredentialsView AS
SELECT
    Employees.employee_id,
    Employees.first_name,
    Employees.last_name,
    CASE
        WHEN Dentists.employee_id IS NOT NULL THEN 'Dentist'
        WHEN Staff.employee_id IS NOT NULL THEN 'Staff'
        ELSE NULL
    END AS role,
    LoginCredentials.Username,
    LoginCredentials.Password
FROM
    Employees
LEFT JOIN
    Dentists ON Employees.employee_id = Dentists.employee_id
LEFT JOIN
    Staff ON Employees.employee_id = Staff.employee_id
JOIN
    LoginCredentials ON Employees.employee_id = LoginCredentials.employee_id;

-- --------------------------------------------------------


--
-- Structure for view `PrescriptionView`
--

CREATE VIEW PrescriptionView AS
SELECT
  p.prescription_id AS `prescription_id`,
  pt.first_name AS `first_name`,
  pt.last_name AS `last_name`,
  m.medication_name AS `medication_name`,
  p.dosage AS `dosage`,
  p.instructions AS `instruction`,
  p.date_prescribed AS `date_prescribed`
FROM
  Prescriptions p
  INNER JOIN Patients pt ON p.patient_id = pt.patient_id
  INNER JOIN Medications m ON p.medication_id = m.medication_id;

-- --------------------------------------------------------

--
-- Structure for view `Payments_Patients_View`
--

CREATE VIEW `Payments_Patients_View` AS
SELECT
  p.payment_id AS `payment_id`,
  pt.first_name AS `first_name`,
  pt.last_name AS `last_name`,
  p.amount AS `amount`,
  p.amount_paid AS `amount_paid`,
  p.amount_due AS `amount_due`,
  p.description AS `description`,
  p.date_paid AS `date_paid`,
  p.payment_method AS `payment_method`
FROM
  Payments p
  INNER JOIN Patients pt ON p.patient_id = pt.patient_id;


-- --------------------------------------------------------
--
-- Structure for view `Salar_Employee_View`
--

CREATE VIEW `Salary_Employee_View` AS
SELECT
  s.salary_id AS `salary_id`,
  s.employee_id AS `employee_id`,
  e.first_name AS `first_name`,
  e.last_name AS `last_name`,
  s.SalaryType AS `SalaryType`,
  s.Currency AS `Currency`,
  s.PaymentFrequency AS `PaymentFrequency`,
  s.Amount AS `Amount`,
  s.datePaid AS `datePaid`
FROM
  Salary s
  INNER JOIN Employees e ON s.employee_id = e.employee_id;


-- --------------------------------------------------------

--
-- Structure for view `Invoice_Patients_View`
--

CREATE VIEW `Invoice_Patients_View` AS
SELECT
  i.invoice_id AS `invoice_id`,
  pt.patient_id AS `patient_id`,
  pt.first_name AS `first_name`,
  pt.last_name AS `last_name`,
  i.total_cost AS `total_cost`,
  i.invoice_date AS `invoice_date`,
  i.paid AS `paid`
FROM
  Invoices i
  INNER JOIN Patients pt ON i.patient_id = pt.patient_id;

-- --------------------------------------------------------