/* Tables */
-- ////////////////////////////////////////////////////////////////////////////
-- ////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////// NO REF TABLES
-- ////////////////////////////////////////////////////////////////////////////
-- ////////////////////////////////////////////////////////////////////////////
-- Table structure for `addresses`
CREATE TABLE IF NOT EXISTS addresses (
  address_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  street VARCHAR(255) DEFAULT NULL,
  city VARCHAR(255) DEFAULT NULL,
  state VARCHAR(255) DEFAULT NULL,
  country VARCHAR(255) DEFAULT NULL,
  zip VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `roles`
CREATE TABLE IF NOT EXISTS roles (
  role_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  role_name VARCHAR(255) DEFAULT NULL,
  role_description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `expense_types`
CREATE TABLE IF NOT EXISTS expense_types (
  expense_type_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  expense_type VARCHAR(255) DEFAULT NULL,
  expense_type_description VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `procedures`
CREATE TABLE IF NOT EXISTS procedures (
  procedure_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  procedure_code VARCHAR(20) DEFAULT NULL,
  procedure_name VARCHAR(100) DEFAULT NULL,
  procedure_price DECIMAL(10,2) DEFAULT NULL,
  procedure_description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `drugs`
CREATE TABLE IF NOT EXISTS drugs (
  drug_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  drug_name VARCHAR(50) NOT NULL,
  drug_description TEXT DEFAULT NULL,
  drug_cost DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `equipment`
CREATE TABLE IF NOT EXISTS equipment (
  equipment_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  equipment_type VARCHAR(100) DEFAULT NULL,
  manufacturer VARCHAR(100) DEFAULT NULL,
  model VARCHAR(100) DEFAULT NULL,
  purchase_date DATE DEFAULT NULL,
  warranty_information VARCHAR(200) DEFAULT NULL,
  maintenance_schedule VARCHAR(200) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `medications`
CREATE TABLE IF NOT EXISTS medications (
  medication_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  medication_name VARCHAR(100) DEFAULT NULL,
  medication_dosage VARCHAR(100) DEFAULT NULL,
  medication_description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `services`
CREATE TABLE IF NOT EXISTS services (
  service_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description TEXT DEFAULT NULL,
  fee DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `suppliers`
CREATE TABLE IF NOT EXISTS suppliers (
  supplier_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  supplier_name VARCHAR(100) DEFAULT NULL,
  email VARCHAR(100) DEFAULT NULL,
  phone_number VARCHAR(20) DEFAULT NULL,
  address VARCHAR(200) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ////////////////////////////////////////////////////////////////////////////
-- ////////////////////////////////////////////////////////////////////////////
-- //////////////////////////////////////////////////////////////////////////// REF TABLES
-- ////////////////////////////////////////////////////////////////////////////
-- ////////////////////////////////////////////////////////////////////////////

-- Table structure for `employees`
CREATE TABLE IF NOT EXISTS employees (
  employee_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(255) DEFAULT NULL,
  middle_name VARCHAR(255) DEFAULT NULL,
  last_name VARCHAR(255) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(255) DEFAULT NULL,
  qualification VARCHAR(255) DEFAULT NULL,
  experience VARCHAR(50) DEFAULT NULL,
  address INT(11) DEFAULT NULL,
  gender ENUM('Male', 'Female') DEFAULT NULL,
  profile VARCHAR(255) DEFAULT NULL,
  hire_date DATE DEFAULT NULL,
  birth_date DATE DEFAULT NULL,
  role INT(11) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (role) REFERENCES roles(role_id),
  FOREIGN KEY (address) REFERENCES addresses(address_id)
);

-- Table structure for `patients`
CREATE TABLE IF NOT EXISTS patients (
  patient_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50) DEFAULT NULL,
  last_name VARCHAR(50) NOT NULL,
  birth_date DATE NOT NULL,
  gender ENUM('Male','Female') NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  address INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (address) REFERENCES addresses(address_id)
);

-- Table structure for `appointments`
CREATE TABLE IF NOT EXISTS appointments (
  appointment_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  Type VARCHAR(50) DEFAULT NULL,
  status VARCHAR(20) DEFAULT NULL,
  date DATE DEFAULT NULL,
  time TIME DEFAULT NULL,
  patient_id INT(11) DEFAULT NULL,
  employee_id INT(11) DEFAULT NULL,
  FOREIGN KEY (patient_id) REFERENCES patients (patient_id),
  FOREIGN KEY (employee_id) REFERENCES employees (employee_id),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table structure for `appointment_services`
CREATE TABLE IF NOT EXISTS appointment_services (
  appointment_id INT(11),
  service VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (appointment_id) REFERENCES appointments (appointment_id)
);
