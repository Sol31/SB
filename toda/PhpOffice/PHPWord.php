<?php
include ("../../database/connection.php");
// Generate Word document dynamically using PHPWord
require_once 'vendor/autoload.php';
session_start();
$table = $_SESSION['table'];
if (isset($_GET['SBN_NO'])) {
    // Extract row data from POST request
    // Sanitize the input to prevent SQL injection
    $sbn_no = mysqli_real_escape_string($conn, $_GET['SBN_NO']);

    // Fetch the record from the database based on SBN_NO
    $query = "SELECT * FROM $table WHERE SBN_NO = '$sbn_no'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Record found, fetch the data
        $record = mysqli_fetch_assoc($result);
        // Load the Word template
        $templateFile = 'template_directory/franchise_template.docx';
        if (!file_exists($templateFile)) {
            throw new Exception('Template file not found.');
        }
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFile);
        $date = strtotime($record['DATE_OF_RENEWAL']);
        $formattedDate = date('F j, Y', $date);

        // Replace placeholders in the template with row data
        $templateProcessor->setValue('SBN_NO', $record['SBN_NO']);
        $templateProcessor->setValue('NAME', $record['NAME']);
        $templateProcessor->setValue('ADDRESS', $record['ADDRESS']);
        $templateProcessor->setValue('MOTOR_NO', $record['MOTOR_NO']);
        $templateProcessor->setValue('CHASSIS_NO', $record['CHASSIS_NO']);
        $templateProcessor->setValue('PLATE_NO', $record['PLATE_NO']);
        $templateProcessor->setValue('DATE_OF_RENEWAL', $formattedDate);
        $templateProcessor->setValue('MAKE', $record['MAKE']);

        // Save the modified Word document
        $outputFile = sys_get_temp_dir() . '/merged_document.docx';
        $templateProcessor->saveAs($outputFile);

        // Send the modified Word document to the client
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="' . $sbn_no . '.docx"');
        readfile($outputFile);

        // Delete the temporary file
        unlink($outputFile);

        exit;
    }
} else {
    // Invalid request
    echo "Bad Request";
    exit;
}
?>