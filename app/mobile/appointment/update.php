<?php
$file1 = '../../controller/dbmanager.php';
$file2 = './app/controller/dbmanager.php';

function require_file($file1, $file2) {
    if (file_exists($file1)) {
        require_once $file1;
    } elseif (file_exists($file2)) {
        require_once $file2;
    } else {
        $response = [
            'success' => false,
            'message' => 'Required file not found.',
        ];
        echo json_encode($response);
        die('Required file not found.');
    }
}


require_file($file1, $file2);
// Assuming the DatabaseManager class is defined in conn.php
$manager = new DatabaseManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableName = $_POST['tableName'];
    $id = $_POST['id'];
    $columnValues = $_POST;
    unset($columnValues['tableName']);
    unset($columnValues['id']);

    $success = $manager->update($tableName, $id, $columnValues);

    if ($success) {
        // Update was successful
        $response = [
            'success' => true,
            'message' => 'Data updated successfully',
        ];
    } else {
        // Update failed
        $response = [
            'success' => false,
            'message' => 'Failed to update data',
        ];
    }

    echo json_encode($response);
}
?>
