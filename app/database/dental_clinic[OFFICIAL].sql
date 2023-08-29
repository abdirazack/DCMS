-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE roles (
  role_id int(11) PRIMARY KEY AUTO_INCREMENT,
  role_name varchar(255) DEFAULT NULL,
  role_description text DEFAULT NULL
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE addresses (
  address_id int(11) PRIMARY KEY AUTO_INCREMENT,
  street varchar(255) DEFAULT NULL,
  city varchar(255) DEFAULT NULL,
  state varchar(255) DEFAULT NULL,
  country varchar(255) DEFAULT NULL,
  zip varchar(255) DEFAULT NULL
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE medications (
  medication_id int(11) PRIMARY KEY AUTO_INCREMENT,
  medication_name varchar(100) DEFAULT NULL,
  medication_dosage varchar(100) DEFAULT NULL,
  medication_description text DEFAULT NULL
);
-- --------------------------------------------------------
-- --------------------------------------------------------

CREATE TABLE patients (
  patient_id int(11) PRIMARY KEY AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  middle_name varchar(50) DEFAULT NULL,
  last_name varchar(50) NOT NULL,
  birth_date date NOT NULL,
  gender enum('Male','Female') NOT NULL,
  phone_number varchar(20) NOT NULL,
  address int(11) NOT NULL DEFAULT 1,
  username varchar(30) DEFAULT NULL,
  password varchar(50) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

  FOREIGN KEY (address) REFERENCES addresses (address_id)
);


--
-- Triggers patients
--
DELIMITER $$
CREATE TRIGGER set_default_username_and_pass BEFORE INSERT ON patients FOR EACH ROW BEGIN
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
-- --------------------------------------------------------
CREATE TABLE employees (
  employee_id int(11) PRIMARY KEY AUTO_INCREMENT,
  first_name varchar(255) DEFAULT NULL,
  middle_name varchar(50) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  phone varchar(255) DEFAULT NULL,
  role_id int(11) DEFAULT NULL,
  experience varchar(50) DEFAULT NULL,
  address int(11) DEFAULT NULL,
  gender enum('Male','Female') NOT NULL,
  profile varchar(255) DEFAULT NULL,
  salary_type varchar(255) NOT NULL DEFAULT 'Monthly',
  currency text NOT NULL DEFAULT 'Dollar',
  amount double NOT NULL DEFAULT 0,
  hire_date date DEFAULT NULL,

  FOREIGN KEY (address) REFERENCES addresses (address_id),
  FOREIGN KEY (role_id) REFERENCES roles (role_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE appointments (
  appointment_id int(11) PRIMARY KEY AUTO_INCREMENT,
  Type varchar(50) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  date date DEFAULT NULL,
  time time DEFAULT NULL,
  patient_id int(11) DEFAULT NULL,
  employee_id int(11) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  note varchar(255) DEFAULT NULL,
  viewed int(11) NOT NULL DEFAULT 0,
  
  FOREIGN KEY (patient_id) REFERENCES patients (patient_id),
  FOREIGN KEY (employee_id) REFERENCES employees (employee_id)
);



-- --------------------------------------------------------
CREATE TABLE drugs (
  drug_id int(11) PRIMARY KEY AUTO_INCREMENT,
  drug_cost decimal(10,2) NOT NULL,
  drug_quantity int(11) NOT NULL,
  drug_expiry_date date DEFAULT NULL,
  patient_id int(11) DEFAULT NULL,
  employee_id int(11) DEFAULT NULL,
  medication_id int(11) DEFAULT NULL,
  date_prescribed date NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

  
  FOREIGN KEY (patient_id) REFERENCES patients (patient_id),
  FOREIGN KEY (employee_id) REFERENCES employees (employee_id),
  FOREIGN KEY (medication_id) REFERENCES medications (medication_id)
);

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE equipment (
  equipment_id int(11) PRIMARY KEY AUTO_INCREMENT,
  employees_id int(11) NOT NULL DEFAULT 1,
  equipment_type varchar(100) DEFAULT NULL,
  manufacturer varchar(100) DEFAULT NULL,
  model varchar(100) DEFAULT NULL,
  purchase_date date DEFAULT NULL,
  warranty_information varchar(200) DEFAULT NULL,
  maintenance_schedule varchar(200) DEFAULT NULL,

  FOREIGN KEY (employees_id) REFERENCES employees (employee_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE expense_types (
  expense_type_id int(11) PRIMARY KEY AUTO_INCREMENT,
  expense_type varchar(255) DEFAULT NULL,
  expense_type_description varchar(255) NOT NULL
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE expenses (
  expense_id int(11) PRIMARY KEY AUTO_INCREMENT,
  employee_id int(11) NOT NULL,
  amount decimal(10,2) NOT NULL,
  quantity double NOT NULL,
  description varchar(100) NOT NULL,
  expense_type int(11) DEFAULT NULL,
  date date NOT NULL,

  
  FOREIGN KEY (expense_type) REFERENCES expense_types (expense_type_id),
  FOREIGN KEY (employee_id) REFERENCES employees (employee_id)

);

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE incometable (
  IncomeID int(11) PRIMARY KEY AUTO_INCREMENT,
  patient_id int(11) DEFAULT NULL,
  IncomeType varchar(255) DEFAULT NULL,
  IncomeAmount double DEFAULT 0,
  IncomeAmountPaid double DEFAULT 0,
  discount double NOT NULL DEFAULT 0,
  createdAt timestamp NULL DEFAULT current_timestamp(),
  IncomeDate date DEFAULT NULL,

  
  FOREIGN KEY (patient_id) REFERENCES patients (patient_id)
);



-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE logincredentials (
  employee_id int(11) NOT NULL,
  Username varchar(255) DEFAULT NULL,
  Password varchar(255) DEFAULT NULL,
  isAdmin tinyint(1) DEFAULT NULL,

  FOREIGN KEY (employee_id) REFERENCES employees (employee_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE services (
  service_id int(11) PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description text DEFAULT NULL,
  fee decimal(10,2) NOT NULL
);


-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE patientservices (
  patientService_id int(11) PRIMARY KEY AUTO_INCREMENT,
  patient_id int(11) DEFAULT NULL,
  service_id int(11) DEFAULT NULL,
  quantity int(11) DEFAULT 0,
  cost double DEFAULT 0,

  FOREIGN KEY (patient_id) REFERENCES patients (patient_id),
  FOREIGN KEY (service_id) REFERENCES services (service_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE prescriptions (
  prescription_id int(11) PRIMARY KEY AUTO_INCREMENT,
  patient_id int(11) DEFAULT NULL,
  medication_id int(11) DEFAULT NULL,
  instructions text DEFAULT NULL,
  date_prescribed date DEFAULT NULL,

  FOREIGN KEY (patient_id) REFERENCES patients (patient_id),
  FOREIGN KEY (medication_id) REFERENCES medications (medication_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE salary (
  salary_id int(11) PRIMARY KEY AUTO_INCREMENT,
  employee_id int(11) DEFAULT NULL,
  amount double NOT NULL DEFAULT 0,
  paid_in_full tinyint(1) DEFAULT NULL,
  datePaid date DEFAULT NULL,

  FOREIGN KEY (employee_id) REFERENCES employees (employee_id)
);
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE TABLE treatment_plans (
  treatment_plan_id int(11) PRIMARY KEY AUTO_INCREMENT,
  patient_id int(11) DEFAULT NULL,
  start_date date DEFAULT NULL,
  end_date date DEFAULT NULL,
  total_cost decimal(10,2) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,

  FOREIGN KEY (patient_id) REFERENCES patients (patient_id)
);

-- ///////////////////////////////////////////////////////////////////////////////////////////// VIEWS /////////////////////////////////////////////////////////////////////////////////////////////
-- ///////////////////////////////////////////////////////////////////////////////////////////// VIEWS /////////////////////////////////////////////////////////////////////////////////////////////
-- ///////////////////////////////////////////////////////////////////////////////////////////// VIEWS /////////////////////////////////////////////////////////////////////////////////////////////

CREATE VIEW addresses_employees_view  AS SELECT a.address_id AS address, e.employee_id AS employee_id, e.first_name AS first_name, e.middle_name AS middle_name, e.last_name AS last_name, e.phone AS phone, e.email AS email, r.role_name AS role_name, e.experience AS Experience, e.gender AS gender, e.salary_type AS salary_type, e.currency AS currency, e.amount AS amount, e.hire_date AS hire_date, a.street AS street, a.city AS city, a.state AS state, e.profile AS profile FROM ((employees e join addresses a on(e.address = a.address_id)) join roles r on(e.role_id = r.role_id))  ;
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW addresses_patients_view  AS SELECT pt.patient_id AS patient_id, pt.first_name AS first_name, pt.last_name AS last_name, pt.phone_number AS phone_number, pt.gender AS gender, pt.birth_date AS birth_date, a.street AS street, a.city AS city, a.state AS state, pt.created_at AS created_at FROM (patients pt join addresses a on(pt.address = a.address_id))  ;
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW appointmentdetails  AS SELECT a.appointment_id AS appointment_id, a.viewed AS viewed, a.status AS status, p.patient_id AS patient_id, concat(p.first_name,' ',p.last_name) AS patient_name, concat(e.first_name,' ',e.last_name) AS employee_name, a.employee_id AS employee_id, a.date AS date, a.time AS time, a.created_at AS created_at, a.updated_at AS updated_at FROM ((appointments a join patients p on(a.patient_id = p.patient_id)) join employees e on(a.employee_id = e.employee_id))  ;
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW expenses_expense_types_view  AS SELECT e.expense_id AS expense_id, et.expense_type_id AS expense_type_id, e.description AS description, e.amount AS amount, e.quantity AS quantity, e.date AS date, et.expense_type AS expense_type FROM (expenses e join expense_types et on(e.expense_type = et.expense_type_id))  ;
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW incometableview  AS SELECT i.IncomeID AS IncomeID, i.patient_id AS patient_id, i.IncomeType AS IncomeType, i.IncomeAmount AS IncomeAmount, i.IncomeAmountPaid AS IncomeAmountPaid, i.createdAt AS createdAt, i.IncomeDate AS IncomeDate, i.discount AS discount FROM incometable AS i;
-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW logincredentialsview  AS SELECT employees.employee_id AS employee_id, employees.first_name AS first_name, employees.last_name AS last_name, roles.role_name AS role_name, logincredentials.Username AS Username, logincredentials.Password AS Password, logincredentials.isAdmin AS isAdmin FROM ((employees join logincredentials on(employees.employee_id = logincredentials.employee_id)) join roles on(employees.role_id = roles.role_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW patientdrugsview  AS SELECT p.patient_id AS patient_id, p.first_name AS first_name, p.last_name AS last_name, e.employee_id AS employee_id, d.drug_id AS drug_id, d.drug_cost AS drug_cost, d.drug_quantity AS drug_quantity, d.date_prescribed AS date_prescribed, d.drug_expiry_date AS drug_expiry_date, m.medication_name AS medication_name, m.medication_dosage AS medication_dosage FROM (((patients p join drugs d on(p.patient_id = d.patient_id)) join employees e on(d.employee_id = e.employee_id)) join medications m on(d.medication_id = m.medication_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW patientservicesview  AS SELECT patientservices.patientService_id AS patientService_id, patients.patient_id AS patient_id, patients.first_name AS first_name, patients.last_name AS last_name, services.service_id AS service_id, services.name AS service_name, patientservices.quantity AS quantity, patientservices.cost AS cost FROM ((patientservices join patients on(patientservices.patient_id = patients.patient_id)) join services on(patientservices.service_id = services.service_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW patient_drugs_view  AS SELECT p.patient_id AS patient_id, p.first_name AS first_name, p.last_name AS last_name, d.drug_id AS drug_id, sum(d.drug_cost) AS drug_cost, sum(d.drug_quantity) AS drug_quantity, d.date_prescribed AS date_prescribed, d.drug_expiry_date AS drug_expiry_date, count(m.medication_name) AS medication_name, m.medication_dosage AS medication_dosage FROM ((drugs d join patients p on(d.patient_id = p.patient_id)) join medications m on(d.medication_id = m.medication_id)) GROUP BY p.patient_id  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW patient_incometable_view  AS SELECT i.IncomeID AS IncomeID, i.patient_id AS patient_id, i.IncomeType AS IncomeType, i.IncomeAmount AS IncomeAmount, i.IncomeAmountPaid AS IncomeAmountPaid, i.IncomeDate AS IncomeDate, p.first_name AS first_name, p.last_name AS last_name, i.discount AS discount FROM (patients p join incometable i on(p.patient_id = i.patient_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW patient_service_view  AS SELECT patientservices.patientService_id AS patientService_id, patientservices.patient_id AS patient_id, count(patientservices.service_id) AS Services, count(patientservices.quantity) AS Quantity, sum(patientservices.cost) AS Total, p.first_name AS first_name, p.last_name AS last_name FROM (patientservices join patients p on(patientservices.patient_id = p.patient_id)) GROUP BY patientservices.patient_id;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW prescriptionview  AS SELECT p.prescription_id AS prescription_id, pt.first_name AS first_name, p.patient_id AS patient_id, pt.last_name AS last_name, m.medication_name AS medication_name, p.instructions AS instruction, p.date_prescribed AS date_prescribed FROM ((prescriptions p join patients pt on(p.patient_id = pt.patient_id)) join medications m on(p.medication_id = m.medication_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------
CREATE VIEW salary_employee_view  AS SELECT s.salary_id AS salary_id, s.employee_id AS employee_id, e.first_name AS first_name, e.last_name AS last_name, e.salary_type AS salary_type, e.currency AS currency, s.amount AS amount, s.datePaid AS datePaid, s.paid_in_full AS paid_in_full FROM (salary s join employees e on(s.employee_id = e.employee_id))  ;

-- --------------------------------------------------------
-- --------------------------------------------------------

CREATE VIEW treatmentplan_patients_view  AS SELECT tp.treatment_plan_id AS treatment_plan_id, pt.first_name AS first_name, pt.last_name AS last_name, tp.start_date AS start_date, tp.end_date AS end_date, tp.total_cost AS total_cost, tp.status AS status FROM (treatment_plans tp join patients pt on(tp.patient_id = pt.patient_id))  ;


-- ///////////////////////////////////////////////////////////////////////////////////////////// INSERT DATA /////////////////////////////////////////////////////////////////////////////////////////////
-- ///////////////////////////////////////////////////////////////////////////////////////////// INSERT DATA /////////////////////////////////////////////////////////////////////////////////////////////
-- ///////////////////////////////////////////////////////////////////////////////////////////// INSERT DATA /////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO roles (role_id, role_name, role_description) VALUES
(1, 'Dentist', 'The Big Boss'),
(2, 'Receptionist', 'FEastrhdyfuk'),
(3, 'Cleaner', 'dfgsfhgr'),
(4, 'Dental Assistant', 'asd'),
(5, 'Physician', 'He is obviously the physician');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO addresses (address_id, street, city, state, country, zip) VALUES
(1, 'shibis', 'Mogadishu', 'Banaadir', NULL, NULL),
(2, 'Danwadaagta', 'Mogadishu', 'Banaadir', NULL, NULL),
(3, 'hodan', 'Mogadishu', 'Banaadir', NULL, NULL),
(4, 'Wadajir', 'Mogadishu', 'Banaadir', NULL, NULL),
(5, 'Madino', 'Mogadishu', 'Banaadir', NULL, NULL);

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO medications (medication_id, medication_name, medication_dosage, medication_description) VALUES
(1, 'DawaZone', 'DawaZone', ' for Headache'),
(2, 'Lisinopril', '10 mg', 'Blood pressure medication'),
(3, 'Metformin', '500 mg', 'Diabetes medication'),
(4, 'Amlodipine', '5 mg', 'Blood pressure medication'),
(5, 'Atorvastatin', '40 mg', 'Cholesterol medication'),
(6, 'Levothyroxine', '25 mcg', 'Thyroid medication'),
(7, 'Omeprazole', '20 mg', 'Heartburn medication'),
(8, 'Albuterol', '90 mcg/inh', 'Asthma medication'),
(9, 'Losartan', '50 mg', 'Blood pressure medication'),
(10, 'Gabapentin', '300 mg', 'Nerve pain medication'),
(11, 'Hydrochlorothiazide', '12.5 mg', 'Water pill'),
(12, 'Fluticasone', '50 mcg/inh', 'Asthma medication'),
(13, 'Bupropion', '150 mg', 'Antidepressant'),
(14, 'Metoprolol', '50 mg', 'Blood pressure medication'),
(15, 'Pantoprazole', '40 mg', 'Heartburn medication'),
(16, 'Sertraline', '50 mg', 'Antidepressant'),
(17, 'Montelukast', '10 mg', 'Asthma medication'),
(18, 'Furosemide', '40 mg', 'Water pill'),
(19, 'Duloxetine', '30 mg', 'Antidepressant'),
(20, 'Prednisone', '10 mg', 'Steroid'),
(21, 'Tamsulosin', '0.4 mg', 'Enlarged prostate medication'),
(22, 'Cetirizine', '10 mg', 'Antihistamine'),
(23, 'Loratadine', '10 mg', 'Antihistamine'),
(24, 'Trazodone', '50 mg', 'Antidepressant'),
(25, 'Clonidine', '0.1 mg', 'Blood pressure medication'),
(26, 'Esomeprazole', '20 mg', 'Heartburn medication'),
(27, 'Latanoprost', '0.005% eye drops', 'Glaucoma eye drops'),
(28, 'Folic acid', '400 mcg', 'Vitamin supplement'),
(29, 'Omega-3 fish oil', '1000 mg', 'Dietary supplement'),
(30, 'Probiotic', '50 billion CFU', 'Dietary supplement'),
(31, 'Ibuprofen', '200 mg', 'Pain reliever');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO patients (patient_id, first_name, middle_name, last_name, birth_date, gender, phone_number, address, username, password, created_at, updated_at) VALUES
(1, 'Kamaal', 'Abdirahman', 'Yussuf', '2005-01-01', 'Male', '616347481', 1, 'kool12', 'kool12', '2023-08-01 05:24:34', '2023-08-16 18:48:28'),
(2, 'Stick', 'Abdirahman', 'Man', '2010-06-06', 'Male', '616666666', 1, 'stick4', 'stick4', '2023-08-01 05:24:34', '2023-08-01 05:33:11'),
(3, 'Abdirizak', 'Abdirahman', 'Abdi', '2023-07-11', 'Male', '613324221', 1, 'abdihiga', 'abdihiga', '2023-08-01 05:24:34', '2023-08-01 05:33:30'),
(4, 'Wehliye', 'Sh.Cali', 'Maxamed', '1967-05-16', 'Male', '0619492048', 1, 'wehman', 'denta123', '2023-08-01 05:31:55', '2023-08-01 05:33:37'),
(5, 'abdirahman', NULL, 'ali', '2001-09-11', 'Male', '4574575', 1, NULL, 'denta123', '2023-08-02 07:31:44', '2023-08-02 07:31:44'),
(6, 'John', NULL, 'Doe', '1980-01-01', 'Male', '555-1234', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:50:59'),
(7, 'Jane', NULL, 'Doe', '1985-03-15', 'Female', '555-2345', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:03'),
(8, 'Bob', NULL, 'Smith', '1990-05-20', 'Male', '555-3456', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:08'),
(9, 'Sara', NULL, 'Brown', '1992-07-08', 'Female', '555-4567', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:12'),
(10, 'Mike', NULL, 'Jones', '1988-04-11', 'Male', '555-5678', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:18'),
(11, 'Mary', NULL, 'Davis', '1993-09-24', 'Female', '555-6789', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:22'),
(12, 'Tom', NULL, 'Wilson', '1989-11-30', 'Male', '555-7890', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:24'),
(13, 'Jennifer', NULL, 'Moore', '1991-02-14', 'Female', '555-8901', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:32'),
(14, 'James', NULL, 'Taylor', '1994-06-03', 'Male', '555-9012', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:36'),
(15, 'Patricia', NULL, 'White', '1996-08-19', 'Female', '555-0123', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:40'),
(16, 'Michael', NULL, 'Brown', '1977-12-05', 'Male', '555-1234', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:45'),
(17, 'Susan', NULL, 'Miller', '1979-07-19', 'Female', '555-2345', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:51:52'),
(18, 'Robert', NULL, 'Wilson', '1981-03-24', 'Male', '555-3456', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:03'),
(19, 'Linda', NULL, 'Moore', '1983-10-17', 'Female', '555-4567', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:07'),
(20, 'David', NULL, 'Taylor', '1985-06-29', 'Male', '555-5678', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:11'),
(21, 'Elizabeth', NULL, 'Jones', '1987-09-08', 'Female', '555-6789', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:16'),
(22, 'William', NULL, 'Brown', '1988-04-27', 'Male', '555-7890', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:19'),
(23, 'Barbara', NULL, 'Davis', '1990-08-14', 'Female', '555-8901', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:25'),
(25, 'Susan', NULL, 'Wilson', '1993-11-24', 'Female', '555-0123', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:52:35'),
(26, 'Joseph', NULL, 'Moore', '1995-05-10', 'Male', '555-1234', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(27, 'Margaret', NULL, 'Taylor', '1996-12-23', 'Female', '555-2345', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(28, 'Andrew', NULL, 'White', '1998-09-11', 'Male', '555-3456', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(29, 'Sarah', NULL, 'Garcia', '1999-07-05', 'Female', '555-4567', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(30, 'Jacob', NULL, 'Martinez', '2001-03-19', 'Male', '555-5678', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(31, 'Emily', NULL, 'Hernandez', '2002-10-28', 'Female', '555-6789', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(32, 'Daniel', NULL, 'Lopez', '2004-08-08', 'Male', '555-7890', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(33, 'Madison', NULL, 'Gonzales', '2005-05-26', 'Female', '555-8901', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(34, 'Anthony', NULL, 'Rodriguez', '2007-01-14', 'Male', '555-9012', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(35, 'Emma', NULL, 'Martinez', '2008-11-04', 'Female', '555-0123', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(36, 'Joshua', NULL, 'Hernandez', '2010-06-23', 'Male', '555-1234', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(37, 'Olivia', NULL, 'Garcia', '2011-09-10', 'Female', '555-2345', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(38, 'Christopher', NULL, 'Lopez', '2013-03-02', 'Male', '555-3456', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(39, 'Isabella', NULL, 'Rodriguez', '2014-07-21', 'Female', '555-4567', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(40, 'Matthew', NULL, 'Gonzales', '2016-05-05', 'Male', '555-5678', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(41, 'Sophia', NULL, 'Martinez', '2017-12-19', 'Female', '555-6789', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(42, 'Ava', NULL, 'Hernandez', '2019-08-31', 'Female', '555-7890', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(43, 'Mia', NULL, 'Garcia', '2020-04-16', 'Female', '555-8901', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(44, 'Ethan', NULL, 'Lopez', '2022-02-03', 'Male', '555-9012', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(45, 'Riley', NULL, 'Rodriguez', '2023-10-11', 'Female', '555-0123', 1, NULL, 'denta123', '2023-08-10 15:49:31', '2023-08-10 15:49:31'),
(46, 'ahmed', NULL, 'ahmed', '2023-08-15', 'Male', '613324221', 1, NULL, 'denta123', '2023-08-14 06:43:48', '2023-08-14 06:43:48');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO employees (employee_id, first_name, middle_name, last_name, email, phone, role_id, experience, address, gender, profile, salary_type, currency, amount, hire_date) VALUES
(1, 'Abdirizak', 'omar', 'Abdi', 'abdirizakomar65@gmail.com', '613324221', 1, '2 years', 3, 'Male', '1691917557.svg', 'Monthly', 'Dollar', 1200, '2023-06-12'),
(2, 'Abdi', 'omar', 'ali', 'farxan@gmail.com', '614546598', 4, '2 years', 1, 'Male', '1691428414.svg', 'Monthly', 'Dollar', 800, '2023-07-20'),
(3, 'Mohamed', 'Mukhtar', 'Mukhtar', 'ahmedez@hotmail.com', '0707868481', 2, '2 years', 1, 'Male', '1692211522.jpg', 'Fixed', 'Dollar', 1000, '2023-07-18'),
(4, 'John', NULL, 'Doe', 'john.doe@example.com', '123-456-7890', 1, '3 years', 1, 'Male', '', 'Monthly', 'USD', 5000, '2023-08-02'),
(5, 'Jane', NULL, 'Smith', 'jane.smith@example.com', '987-654-3210', 2, '5 years', 2, 'Female', 'profile_image.jpg', 'Monthly', 'USD', 6000, '2023-08-02'),
(6, 'Michael', NULL, 'Johnson', 'michael.johnson@example.com', '555-123-4567', 3, '2 years', 3, 'Male', 'profile_image.jpg', 'Hourly', 'USD', 20, '2023-08-02'),
(7, 'Emily', NULL, 'Williams', 'emily.williams@example.com', '111-222-3333', 4, '1 year', 1, 'Female', 'profile_image.jpg', 'Monthly', 'USD', 4500, '2023-08-02'),
(8, 'Robert', NULL, 'Brown', 'robert.brown@example.com', '444-555-6666', 5, '4 years', 2, 'Male', 'profile_image.jpg', 'Monthly', 'USD', 5500, '2023-08-02'),
(9, 'Jessica', NULL, 'Jones', 'jessica.jones@example.com', '777-888-9999', 1, '2 years', 3, 'Female', 'profile_image.jpg', 'Hourly', 'USD', 18, '2023-08-02'),
(10, 'William', NULL, 'Miller', 'william.miller@example.com', '123-987-4567', 2, '3 years', 1, 'Male', 'profile_image.jpg', 'Monthly', 'USD', 5200, '2023-08-02'),
(11, 'Laura', NULL, 'Davis', 'laura.davis@example.com', '222-111-5555', 3, '5 years', 2, 'Female', 'profile_image.jpg', 'Monthly', 'USD', 6100, '2023-08-02'),
(12, 'Daniel', NULL, 'Wilson', 'daniel.wilson@example.com', '999-555-3333', 4, '2 years', 3, 'Male', 'profile_image.jpg', 'Hourly', 'USD', 21, '2023-08-02');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO appointments (appointment_id, Type, status, date, time, patient_id, employee_id, created_at, updated_at, note, viewed) VALUES
(1, 'Walk-in', 'Cancelled', '2023-08-30', '07:00:00', 3, 1, '2023-08-24 03:17:47', '2023-08-21 07:11:21', 'Bro dont forget your card', 1),
(2, 'Walk-in', 'Cancelled', '2023-01-31', '11:15:00', 3, 1, '2023-08-27 07:38:59', '2023-08-21 07:11:21', '32465789', 1),
(3, 'Walk-in', 'Cancelled', '2023-01-31', '11:15:00', 3, 1, '2023-08-27 07:38:59', '2023-08-21 07:11:21', 'Bul bulo', 1),
(4, 'Online', 'Pending', '2023-08-26', '07:00:00', 3, 1, '2023-08-29 08:27:23', '2023-08-21 07:11:34', 'WHat!!!', 0),
(5, 'Online', 'Cancelled', '2023-08-25', '09:30:00', 3, 1, '2023-08-29 08:27:23', '2023-08-20 06:20:28', 'HEHEHEHEHE', 1),
(6, 'Online', 'Approved', '2023-08-17', '19:41:00', 1, 1, '2023-08-26 18:42:28', '2023-08-19 05:22:07', 'teeth fix it', 1),
(7, 'Online', 'Approved', '2023-08-18', '00:42:00', 1, 1, '2023-08-05 18:46:20', '2023-08-19 05:29:01', 'fix me tooth', 1),
(8, 'Walk-in', 'Cancelled', '2023-08-15', '09:00:00', 1, 1, '2023-08-12 14:06:34', '2023-08-19 05:22:07', 'New patient appointment', 1),
(9, 'Online', 'Approved', '2023-08-16', '14:30:00', 2, 1, '2023-08-12 14:06:34', '2023-08-19 05:22:07', 'Follow-up consultation', 1),
(10, 'Walk-in', 'Approved', '2023-08-21', '09:00:00', 3, 12, '2023-08-12 14:06:34', '2023-08-20 14:43:00', 'Routine checkup', 1),
(11, 'Online', 'Approved', '2023-08-18', '10:15:00', 4, 11, '2023-08-12 14:06:34', '2023-08-19 05:22:07', 'Discussion of test results', 1),
(12, 'Walk-in', 'Approved', '2023-08-22', '09:30:00', 2, 1, '2023-08-21 07:19:26', '2023-08-21 07:19:26', "", 0);

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO drugs (drug_id, drug_cost, drug_quantity, drug_expiry_date, patient_id, employee_id, medication_id, date_prescribed, created_at, updated_at) VALUES
(1, '20.00', 2, '2025-01-01', 1, 2, 2, '2023-08-07', '2023-08-07 15:04:53', '2023-08-07 15:04:53'),
(2, '20.00', 2, '2025-01-01', 1, 2, 2, '2023-08-07', '2023-08-07 15:05:36', '2023-08-07 15:05:36'),
(3, '11.00', 1, '2024-02-14', 3, 2, 10, '2023-08-09', '2023-08-09 07:11:49', '2023-08-09 07:11:49'),
(4, '16.00', 1, '2024-02-21', 3, 2, 9, '0000-00-00', '2023-08-09 07:11:49', '2023-08-09 07:11:49'),
(5, '16.00', 2, '2024-02-20', 3, 2, 27, '0000-00-00', '2023-08-09 07:11:49', '2023-08-09 07:11:49'),
(6, '11.00', 2, '2024-05-21', 5, 2, 29, '2023-08-10', '2023-08-09 07:14:42', '2023-08-09 07:14:42'),
(7, '11.00', 2, '2025-01-09', 5, 2, 23, '2023-08-10', '2023-08-10 13:14:11', '2023-08-10 13:40:10'),
(8, '13.00', 1, '2027-01-01', 1, 2, 29, '2023-08-11', '2023-08-10 13:18:10', '2023-08-10 13:18:10'),
(9, '15.00', 1, '2024-07-10', 2, 2, 2, '2023-08-03', '2023-08-10 15:38:15', '2023-08-10 15:38:15'),
(10, '15.00', 2, '2024-03-25', 2, 2, 3, '2023-08-11', '2023-08-10 15:38:15', '2023-08-10 15:38:15'),
(11, '20.00', 3, '2024-07-18', 14, 3, 30, '2023-08-17', '2023-08-17 13:18:49', '2023-08-17 13:19:52'),
(12, '15.00', 2, '2024-07-18', 14, 3, 28, '2023-08-30', '2023-08-17 13:19:22', '2023-08-17 13:19:33');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO expense_types (expense_type_id, expense_type, expense_type_description) VALUES
(1, 'water', 'water bill go here'),
(3, 'electricty', 'electricty bill go here'),
(4, 'Traveling', 'travel bill go here');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO expenses (expense_id, employee_id, amount, quantity, description, expense_type, date) VALUES
(1, 1, '10.00', 1, 'fdghdh', 1, '2023-07-07'),
(2, 1, '13.00', 1, 'xfhdfg', 4, '2023-07-12'),
(3, 1, '50.00', 1, 'Travel expense', 4, '2023-08-04'),
(4, 1, '50.00', 1, 'Electricity', 3, '2023-08-02'),
(5, 2, '100.00', -1, 'paid', 1, '2023-06-01'),
(6, 2, '52.00', 3, 'for traveling ', 4, '2023-06-23'),
(7, 2, '60.00', 2, '', 3, '2023-07-01'),
(8, 2, '73.00', -3, 'more', 1, '2023-07-01'),
(9, 2, '320.00', 2, '', 3, '2023-08-01'),
(10, 2, '400.00', 5, '', 4, '2023-09-01');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO incometable (IncomeID, patient_id, IncomeType, IncomeAmount, IncomeAmountPaid, discount, createdAt, IncomeDate) VALUES
(1, 1, 'Services', 1000, 999, 1, '2023-07-17 02:31:35', '2023-07-17'),
(2, 3, 'Services', 2032, 1890, 0, '2023-07-18 05:24:14', '2023-07-18'),
(3, 5, 'Services', 51, 49, 1, '2023-08-02 07:32:09', '2023-08-02'),
(4, 2, 'Medications', 42, 0, 0, '2023-08-09 06:54:15', '2023-08-09'),
(5, 2, 'Services', 200, 0, 0, '2023-08-09 06:56:29', '2023-08-09'),
(6, 3, 'Medications', 43, 0, 0, '2023-08-09 07:11:49', '2023-08-09'),
(7, 5, 'Medications', 12, 0, 0, '2023-08-09 07:14:42', '2023-08-09'),
(8, 1, 'Medications', 13, 13, 0, '2023-08-10 13:18:10', '2023-08-10'),
(9, 4, 'Services', 30, 28, 2, '2023-08-10 15:33:55', '2023-08-10'),
(10, 8, 'Services', 100, 100, 0, '2023-08-13 18:58:30', '2023-06-01'),
(11, 7, 'Medication', 50, 50, 0, '2023-08-13 18:58:30', '2023-05-17'),
(12, 14, 'Medications', 35, 33, 2, '2023-08-17 13:18:50', '2023-08-17');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO logincredentials (employee_id, Username, Password, isAdmin) VALUES
(1, 'Abdi', '4848', 1),
(2, 'fa', '123', 1),
(3, 'kool', '8899', 1),
(4, 'pool', '111', 0);

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO services (service_id, name, description, fee) VALUES
(1, 'Ilig Buuxin', 'fill in teeths', '6.00'),
(2, 'Dental Cleaning', 'Routine cleaning of teeth to remove plaque and tartar', '100.00'),
(3, 'Dental Examination', 'Comprehensive oral examination and assessment', '150.00'),
(4, 'Fillings', 'Restoration of decayed teeth with dental fillings', '200.00'),
(5, 'Dental X-rays', 'Obtaining detailed images of teeth and oral structures', '80.00'),
(6, 'Tooth Extraction', 'Removal of a tooth due to decay or other reasons', '250.00');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO patientservices (patientService_id, patient_id, service_id, quantity, cost) VALUES
(1, 1, 2, 1, 50),
(2, 3, 2, 2, 20),
(3, 1, 4, 1, 10),
(4, 5, 4, 1, 10),
(5, 2, 5, 1, 170),
(6, 4, 2, 1, 15),
(7, 4, 6, 2, 15);

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO prescriptions (prescription_id, patient_id, medication_id, instructions, date_prescribed) VALUES
(1, 2, 3, '3X3', '2023-08-09'),
(2, 2, 2, '3X3', '2023-08-18'),
(3, 1, 3, '3X3', '2023-08-18'),
(4, 4, 3, '3X3', '2023-08-15'),
(5, 5, 1, '3X3', '2023-08-04'),
(6, 5, 3, '3X3', '2023-08-11'),
(7, 5, 2, '3X3', '2023-08-17');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO salary (salary_id, employee_id, amount, paid_in_full, datePaid) VALUES
(1, 2, 800, 1, '2023-08-15');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO treatment_plans (treatment_plan_id, patient_id, start_date, end_date, total_cost, status) VALUES
(1, 1, '2023-08-14', '2023-08-15', '30.00', 'Active');

-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



