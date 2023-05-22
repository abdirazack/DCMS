CREATE TABLE Staff (
  staff_id INT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  role VARCHAR(50),
  phone_number VARCHAR(20),
  email_address VARCHAR(100)
);

CREATE TABLE Suppliers (
  supplier_id INT PRIMARY KEY,
  supplier_name VARCHAR(100),
  contact_name VARCHAR(100),
  email VARCHAR(100),
  phone_number VARCHAR(20),
  address VARCHAR(200)
);

CREATE TABLE Services (
  service_id INT PRIMARY KEY,
  service_name VARCHAR(100),
  description TEXT,
  price DECIMAL(10,2)
);

CREATE TABLE Equipment (
  equipment_id INT PRIMARY KEY,
  equipment_type VARCHAR(100),
  manufacturer VARCHAR(100),
  model VARCHAR(100),
  purchase_date DATE,
  warranty_information VARCHAR(200),
  maintenance_schedule VARCHAR(200)
);

CREATE TABLE Inventory (
  inventory_id INT PRIMARY KEY,
  item_name VARCHAR(100),
  description TEXT,
  unit_cost DECIMAL(10,2),
  quantity INT,
  supplier_id INT,
  FOREIGN KEY (supplier_id) REFERENCES Suppliers(supplier_id)
);

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

CREATE TABLE Procedures (
  procedure_id INT PRIMARY KEY,
  procedure_code VARCHAR(20),
  procedure_name VARCHAR(100),
  procedure_price DECIMAL(10,2),
  procedure_description TEXT
);

CREATE TABLE Dentists (
  dentist_id INT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  specialty VARCHAR(100),
  phone_number VARCHAR(20),
  email_address VARCHAR(100)
);

CREATE TABLE Medications (
  medication_id INT PRIMARY KEY,
  medication_code VARCHAR(20),
  medication_name VARCHAR(100),
  medication_dosage VARCHAR(100),
  medication_description TEXT
);

CREATE TABLE Appointments (
  appointment_id INT PRIMARY KEY,
  appointment_date DATE,
  appointment_time TIME,
  patient_id INT,
  dentist_id INT,
  procedure_id INT,
  status VARCHAR(20),
  Type VARCHAR(50),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
  FOREIGN KEY (dentist_id) REFERENCES Dentists(dentist_id),
  FOREIGN KEY (procedure_id) REFERENCES Procedures(procedure_id)
);

CREATE TABLE Treatment_Plans (
  treatment_plan_id INT PRIMARY KEY,
  patient_id INT,
  start_date DATE,
  end_date DATE,
  total_cost DECIMAL(10,2),
  status VARCHAR(20),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

CREATE TABLE Payments (
  payment_id INT PRIMARY KEY,
  patient_id INT,
  amount_paid DECIMAL(10,2),
  date_paid DATE,
  payment_method VARCHAR(50),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

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

CREATE TABLE DentalCharts (
  dental_chart_id INT PRIMARY KEY,
  patient_id INT,
  chart_image VARCHAR(200),
  date_created DATE,
  date_modified DATE,
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);

Create Table Login (
  username VARCHAR(100) PRIMARY KEY,
  password VARCHAR(100),
  role VARCHAR(50),
  staff_id INT,
   patient_id INT,
  FOREIGN KEY (staff_id) REFERENCES Staff(staff_id),
  FOREIGN KEY (patient_id) REFERENCES Patients(patient_id)
);