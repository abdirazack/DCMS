<?php
require_once '../database/conn.php';

class DatabaseManager {
    public function insert($tableName, $columnValues) {
        global $conn;
        
        // Create the column names string
        $columns = implode(', ', array_keys($columnValues));
        
        // Create the placeholders string
        $placeholders = ':' . implode(', :', array_keys($columnValues));
        
        // Create your SQL query and prepare the statement
        $stmt = $conn->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");
        
        // Bind the values to the placeholders
        foreach ($columnValues as $column => &$value) {
            $stmt->bindParam(':' . $column, $value);
        }
        
        // Execute the statement and return true if successful, false otherwise
        return $stmt->execute();
    }
    
    public function update($tableName, $id, $columnValues) {
        global $conn;
        
        // Create the SET clause for updating the columns
        $setClause = '';
        foreach ($columnValues as $column => $value) {
            $setClause .= "$column = :$column, ";
        }
        $setClause = rtrim($setClause, ', '); // Remove the trailing comma and space
        
        // Create your SQL query and prepare the statement
        $stmt = $conn->prepare("UPDATE $tableName SET $setClause WHERE id = :id");
        
        // Bind the ID value to the placeholder
        $stmt->bindParam(':id', $id);
        
        // Bind the values to the corresponding column placeholders
        foreach ($columnValues as $column => &$value) {
            $stmt->bindParam(':' . $column, $value);
        }
        
        // Execute the statement and return true if successful, false otherwise
        return $stmt->execute();
    }
    
    public function delete($tableName, $id) {
        global $conn;
        
        // Create your SQL query and prepare the statement
        $stmt = $conn->prepare("DELETE FROM $tableName WHERE id = :id");
        
        // Bind the ID value to the placeholder
        $stmt->bindParam(':id', $id);
        
        // Execute the statement and return true if successful, false otherwise
        return $stmt->execute();
    }
}

// Example usage of the DatabaseManager class
$manager = new DatabaseManager();
$tableName = 'your_table_name';
$id = 123; // Example ID to update
$columnValues = [
    'column1' => $value1,
    'column2' => $value2,
    // Add more columns and values as needed
];
$success = $manager->update($tableName, $id, $columnValues);
if ($success) {
    // Update was successful
} else {
    // Update failed
}

$success = $manager->delete($tableName, $id);
if ($success) {
    // Delete was successful
} else {
    // Delete failed
}
?>
