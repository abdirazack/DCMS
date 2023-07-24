
/* Views */

-- addresses_employees_view
CREATE VIEW `addresses_employees_view` AS
SELECT 
    `e`.`employee_id` AS `employee_id`,
    `e`.`first_name` AS `first_name`,
    `e`.`middle_name` AS `middle_name`,
    `e`.`last_name` AS `last_name`,
    `e`.`phone` AS `phone`,
    `e`.`email` AS `email`,
    `r`.`role_name` AS `role_name`,
    `e`.`experience` AS `Experience`,
    `e`.`qualification` AS `Qualification`,
    `e`.`gender` AS `gender`,
    `e`.`profile` AS `profile`,
    `e`.`hire_date` AS `hire_date`,
    `e`.`birth_date` AS `birth_date`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state`,
    `a`.`country` AS `country`,
    `a`.`zip` AS `zip`,
    `e`.`created_at` AS `created_at`,
    `e`.`updated_at` AS `updated_at`
FROM 
    ((`employees` `e` 
    JOIN `addresses` `a` ON(`e`.`address` = `a`.`address_id`)) 
    JOIN `roles` `r` ON(`e`.`role` = `r`.`role_id`));

-- addresses_patients_view
CREATE VIEW `addresses_patients_view` AS
SELECT 
    `pt`.`patient_id` AS `patient_id`,
    `pt`.`first_name` AS `first_name`,
    `pt`.`last_name` AS `last_name`,
    `pt`.`phone_number` AS `phone_number`,
    `pt`.`gender` AS `gender`,
    `pt`.`birth_date` AS `birth_date`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state`,
    `a`.`country` AS `country`,
    `a`.`zip` AS `zip`,
    `pt`.`created_at` AS `created_at`,
    `pt`.`updated_at` AS `updated_at`
FROM 
    (`patients` `pt` 
    JOIN `addresses` `a` ON(`pt`.`address` = `a`.`address_id`));

-- addresses_supplier_view
CREATE VIEW `addresses_supplier_view` AS 
SELECT 
    `s`.`supplier_id` AS `supplier_id`,
    `s`.`supplier_name` AS `supplier_name`,
    `s`.`email` AS `email`,
    `s`.`phone_number` AS `phone_number`,
    `a`.`street` AS `street`,
    `a`.`city` AS `city`,
    `a`.`state` AS `state`,
    `a`.`country` AS `country`,
    `a`.`zip` AS `zip`,
    `s`.`created_at` AS `created_at`,
    `s`.`updated_at` AS `updated_at`
FROM 
    (`suppliers` `s` 
    JOIN `addresses` `a` ON(`s`.`address` = `a`.`address_id`));

-- appointmentdetails
CREATE VIEW appointmentdetails AS
SELECT
  a.appointment_id, 
  p.patient_id,
  e.employee_id,
  r.role_id,
  s.service_id,
  a.type AS appointment_type,
  a.status AS appointment_status,
  CONCAT(p.first_name, ' ', p.last_name) AS patient_name,
  CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
  r.role_name AS employee_role,
  s.name AS service_name, 
  s.fee AS service_fee,
  a.date,
  a.time,
  a.created_at,
  a.updated_at
FROM appointments a
JOIN patients p ON a.patient_id = p.patient_id
JOIN employees e ON a.employee_id = e.employee_id
JOIN roles r ON e.role_id = r.role_id 
JOIN appointment_services aps ON a.appointment_id = aps.appointment_id
JOIN services s ON aps.service = s.name;

-- expenses_expense_types_view
CREATE VIEW `expenses_expense_types_view` AS
SELECT 
    `e`.`expense_id` AS `expense_id`,
    `et`.`expense_type_id` AS `expense_type_id`,
    `e`.`description` AS `description`,
    `e`.`amount` AS `amount`,
    `e`.`quantity` AS `quantity`,
    `e`.`date` AS `date`,
    `et`.`expense_type` AS `expense_type`,
    `e`.`created_at` AS `created_at`,
    `e`.`updated_at` AS `updated_at`
FROM 
    (`expenses` `e` 
    JOIN `expense_types` `et` ON(`e`.`expense_type` = `et`.`expense_type_id`));

-- incometableview
CREATE VIEW `incometableview` AS
SELECT 
    `incometable`.`IncomeID` AS `IncomeID`,
    `incometable`.`patient_id` AS `patient_id`,
    `incometable`.`IncomeType` AS `IncomeType`,
    `incometable`.`IncomeAmount` AS `IncomeAmount`,
    `incometable`.`IncomeAmountPaid` AS `IncomeAmountPaid`,
    `incometable`.`discount` AS `discount`,
    `incometable`.`createdAt` AS `createdAt`,
    `incometable`.`IncomeDate` AS `IncomeDate`
FROM 
    `incometable`;

-- logincredentialsview
CREATE VIEW `logincredentialsview` AS
SELECT 
    `employees`.`employee_id` AS `employee_id`,
    `employees`.`first_name` AS `first_name`,
    `employees`.`middle_name` AS `middle_name`,
    `employees`.`last_name` AS `last_name`,
    `roles`.`role_name` AS `role_name`,
    `logincredentials`.`Username` AS `Username`,
    `logincredentials`.`Password` AS `Password`,
    `logincredentials`.`isAdmin` AS `isAdmin`,
    `employees`.`created_at` AS `created_at`,
    `employees`.`updated_at` AS `updated_at`
FROM 
    ((`employees` 
    JOIN `logincredentials` ON(`employees`.`employee_id` = `logincredentials`.`employee_id`)) 
    JOIN `roles` ON(`employees`.`role` = `roles`.`role_id`));

-- patientservicesview
CREATE VIEW `patientservicesview` AS
SELECT 
    `patientservices`.`patientService_id` AS `patientService_id`,
    `patients`.`patient_id` AS `patient_id`,
    `patients`.`first_name` AS `first_name`,
    `patients`.`last_name` AS `last_name`,
    `services`.`service_id` AS `service_id`,
    `services`.`name` AS `service_name`,
    `patientservices`.`quantity` AS `quantity`,
    `patientservices`.`cost` AS `cost`,
    `patientservices`.`discount` AS `discount`,
    `patientservices`.`createdAt` AS `createdAt`
FROM 
    ((`patientservices` 
    JOIN `patients` ON(`patientservices`.`patient_id` = `patients`.`patient_id`)) 
    JOIN `services` ON(`patientservices`.`service_id` = `services`.`service_id`));

-- prescriptionview
CREATE VIEW `prescriptionview` AS
SELECT 
    `prescription`.`prescription_id` AS `prescription_id`,
    `patients`.`patient_id` AS `patient_id`,
    `patients`.`first_name` AS `first_name`,
    `patients`.`last_name` AS `last_name`,
    `doctors`.`employee_id` AS `doctor_id`,
    `doctors`.`first_name` AS `doctor_first_name`,
    `doctors`.`last_name` AS `doctor_last_name`,
    `prescription`.`diagnosis` AS `diagnosis`,
    `prescription`.`medication` AS `medication`,
    `prescription`.`instructions` AS `instructions`,
    `prescription`.`issue_date` AS `issue_date`,
    `prescription`.`created_at` AS `created_at`
FROM 
    ((`prescription` 
    JOIN `patients` ON(`prescription`.`patient_id` = `patients`.`patient_id`)) 
    JOIN `employees` `doctors` ON(`prescription`.`doctor_id` = `doctors`.`employee_id`));

-- procedureview
CREATE VIEW `procedureview` AS
SELECT 
    `procedures`.`procedure_id` AS `procedure_id`,
    `procedures`.`procedure_code` AS `procedure_code`,
    `procedures`.`procedure_name` AS `procedure_name`,
    `procedures`.`procedure_price` AS `procedure_price`,
    `procedures`.`procedure_description` AS `procedure_description`,
    `procedures`.`created_at` AS `created_at`,
    `procedures`.`updated_at` AS `updated_at`
FROM 
    `procedures`;

-- servicesview
CREATE VIEW `servicesview` AS
SELECT 
    `services`.`service_id` AS `service_id`,
    `services`.`name` AS `name`,
    `services`.`description` AS `description`,
    `services`.`fee` AS `fee`,
    `services`.`created_at` AS `created_at`,
    `services`.`updated_at` AS `updated_at`
FROM 
    `services`;

-- suppliersaddressview
CREATE VIEW `suppliersaddressview` AS
SELECT 
    `suppliers`.`supplier_id` AS `supplier_id`,
    `suppliers`.`supplier_name` AS `supplier_name`,
    `suppliers`.`email` AS `email`,
    `suppliers`.`phone_number` AS `phone_number`,
    `addresses`.`street` AS `street`,
    `addresses`.`city` AS `city`,
    `addresses`.`state` AS `state`,
    `addresses`.`country` AS `country`,
    `addresses`.`zip` AS `zip`,
    `suppliers`.`created_at` AS `created_at`,
    `suppliers`.`updated_at` AS `updated_at`
FROM 
    (`suppliers` 
    JOIN `addresses` ON(`suppliers`.`address` = `addresses`.`address_id`));

-- total_expense_per_type_view
CREATE VIEW `total_expense_per_type_view` AS
SELECT 
    `expense_types`.`expense_type` AS `expense_type`,
    SUM(`expenses`.`amount`) AS `total_amount`
FROM 
    (`expenses` 
    JOIN `expense_types` ON(`expenses`.`expense_type` = `expense_types`.`expense_type_id`))
GROUP BY 
    `expenses`.`expense_type`;

-- total_income_per_patient_view
CREATE VIEW `total_income_per_patient_view` AS
SELECT 
    `incometable`.`patient_id` AS `patient_id`,
    SUM(`incometable`.`IncomeAmount`) AS `total_income`
FROM 
    `incometable`
GROUP BY 
    `incometable`.`patient_id`;
