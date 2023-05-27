--supplier table
CREATE TABLE Suppliers (
  supplier_id INT PRIMARY KEY,
  supplier_name VARCHAR(100),
  email VARCHAR(100),
  phone_number VARCHAR(20),
  address VARCHAR(200)
);

--Employees table
CREATE TABLE Employees (
    EmployeeID INT PRIMARY KEY,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Email VARCHAR(255),
    Phone VARCHAR(255),
    Address VARCHAR(255),
    HireDate DATE
);

--services table
CREATE TABLE Services (
  service_id INT PRIMARY KEY,
  service_name VARCHAR(100),
  description TEXT,
  price DECIMAL(10,2)
);


--Procedure table
CREATE TABLE Procedures (
  procedure_id INT PRIMARY KEY,
  procedure_code VARCHAR(20),
  procedure_name VARCHAR(100),
  procedure_price DECIMAL(10,2),
  procedure_description TEXT
);

--equipment table
CREATE TABLE Equipment (
  equipment_id INT PRIMARY KEY,
  equipment_type VARCHAR(100),
  manufacturer VARCHAR(100),
  model VARCHAR(100),
  purchase_date DATE,
  warranty_information VARCHAR(200),
  maintenance_schedule VARCHAR(200)
);


--Patients table
CREATE TABLE Patients (
  patient_id INT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  date_of_birth DATE,
  address VARCHAR(200),
  phone_number VARCHAR(20),
  email_address VARCHAR(100),
  profile_photo VARCHAR(255),
  username VARCHAR(200),
  password VARCHAR(255)
);




--Medications table
CREATE TABLE Medications (
  medication_id INT PRIMARY KEY,
  medication_name VARCHAR(100),
  medication_dosage VARCHAR(100),
  medication_description TEXT
);

--Inventory table
CREATE TABLE Inventory (
  inventory_id INT PRIMARY KEY AUTO_INCREMENT,
  item_name VARCHAR(100),
  description TEXT,
  unit_cost DECIMAL(10,2),
  quantity INT,
  supplier_id INT,
  FOREIGN KEY (supplier_id) REFERENCES Suppliers(supplier_id)
);


--Appointments table
CREATE TABLE Appointments (
  appointment_id INT PRIMARY KEY,
  Type VARCHAR(50),
  status VARCHAR(20),
  appointment_date DATE,
  appointment_time TIME,
  patient_id INT,
  dentist_id INT,
  service_id INT,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
  FOREIGN KEY (dentist_id) REFERENCES Dentists(dentist_id),
  FOREIGN KEY (service_id) REFERENCES Services(service_id)
);

--Treatment Plans table
CREATE TABLE Treatment_Plans (
  treatment_plan_id INT PRIMARY KEY,
  patient_id INT,
  start_date DATE,
  end_date DATE,
  total_cost DECIMAL(10,2),
  status VARCHAR(20),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

--Payments table
CREATE TABLE Payments (
  payment_id INT PRIMARY KEY,
  patient_id INT,
  amount_paid DECIMAL(10,2),
  description TEXT,
  date_paid DATE,
  payment_method VARCHAR(50),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

--Prescriptions table
CREATE TABLE Prescriptions (
  prescription_id INT PRIMARY KEY,
  patient_id INT,
  medication_id INT,
  dosage VARCHAR(100),
  instructions TEXT,
  date_prescribed DATE,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
  FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);

CREATE TABLE Invoices (
  invoice_id INT PRIMARY KEY,
  patient_id INT,
  invoice_date DATE,
  total_cost DECIMAL(10,2),
  paid BOOLEAN,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

--Dental Charts table
CREATE TABLE DentalCharts (
  dental_chart_id INT PRIMARY KEY,
  patient_id INT,
  tooth_number VARCHAR(20),
  tooth_condition VARCHAR(20),
  tooth_surface VARCHAR(20),
  date_created DATE,
  date_modified DATE,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

--Create Salary table
CREATE TABLE Salary (
    EmployeeID INT PRIMARY KEY,
    Amount DECIMAL(10, 2),
    EffectiveDate DATE,
    SalaryType VARCHAR(255),
    Currency VARCHAR(50),
    PaymentFrequency VARCHAR(50),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
);


--////////////////////////////////////////////////////////////////////////////////////////////

--Denstists table
CREATE TABLE Dentists (
    EmployeeID INT PRIMARY KEY,
    Specialty VARCHAR(255),
    Qualification VARCHAR(255),
    Experience VARCHAR(50),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
);

-- staff table
CREATE TABLE Staff (
    EmployeeID INT PRIMARY KEY,
    Role VARCHAR(255),
    Experience VARCHAR(50),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
);

--Login Credentials table
CREATE TABLE LoginCredentials (
    EmployeeID INT PRIMARY KEY,
    Username VARCHAR(255),
    Password VARCHAR(255),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
);


CREATE VIEW AppointmentDetails 
AS 
SELECT 
A.appointment_id, 
A.Type, 
A.status, 
A.appointment_date, 
A.appointment_time, 
P.patient_id as patient_id, 
P.first_name AS patient_first_name, 
P.last_name AS patient_last_name,
 D.dentist_id AS dentists_id, 
 D.first_name AS dentist_first_name, 
 D.last_name AS dentist_last_name, 
 S.service_id AS service_id, 
 S.name AS services_name 
 FROM Appointments A 
      JOIN Patients P 
      ON A.patient_id = P.patient_id 
      JOIN Dentists D 
      ON A.dentist_id = D.dentist_id 
      JOIN Services S 
      ON A.service_id = S.service_id;