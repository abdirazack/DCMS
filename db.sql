CREATE DATABASE dental_clinic;

USE dental_clinic;

CREATE TABLE patients (
  patient_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  birth_date DATE NOT NULL,
  gender ENUM('Male', 'Female', 'Other') NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL,
  PRIMARY KEY (patient_id)
);

CREATE TABLE appointments (
  appointment_id INT NOT NULL AUTO_INCREMENT,
  patient_id INT NOT NULL,
  date DATETIME NOT NULL,
  service VARCHAR(50) NOT NULL,
  fee DECIMAL(10, 2) NOT NULL,
  notes TEXT,
  PRIMARY KEY (appointment_id),
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

CREATE TABLE services (
  service_id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description TEXT,
  fee DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (service_id)
);
  
CREATE TABLE payments (
  payment_id INT NOT NULL AUTO_INCREMENT,
  appointment_id INT NOT NULL,
  date DATETIME NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  method ENUM('Cash', 'Credit Card', 'Debit Card', 'Online Payment') NOT NULL,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id)
);

CREATE TABLE staff (
  staff_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL,
  PRIMARY KEY (staff_id)
);

CREATE TABLE expenses (
  expense_id INT NOT NULL AUTO_INCREMENT,
  date DATE NOT NULL,
  description VARCHAR(100) NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (expense_id)
);

CREATE TABLE salary (
  salary_id INT NOT NULL AUTO_INCREMENT,
  staff_id INT NOT NULL,
  date DATE NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (salary_id),
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
);

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password CHAR(32) NOT NULL,
  user_type ENUM('Admin', 'Staff', 'Patient') NOT NULL,
  PRIMARY KEY (user_id)
);