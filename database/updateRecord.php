<?php
include("connection.php");
session_start();
$table = $_SESSION['table'];
$tables = str_replace("_2024", "", $table);
    if (isset($_POST['update'])) {
        $sbn = $_POST['sbn']; // Use the hidden input for SBN_NO
        $name = $_POST['name'];
        $address = $_POST['address'];
        $motor = $_POST['motor'];
        $chassis = $_POST['chassis'];
        $plateNum = $_POST['plate'];
        $dateRenew = $_POST['dateRenew'];
        $make = $_POST['make'];
    
        if (empty($sbn) || empty($name) || empty($address) || empty($motor) || empty($chassis) || empty($dateRenew) || empty($make)) {
                $_SESSION['error_message'] = "All field must be filled";
                header("Location: editRecord.php?SBN_NO=".$sbn."");
            return;
        }
    
        // Assuming $connection is your mysqli database connection object
        $query = mysqli_query($conn, "
            UPDATE $table 
            SET NAME = '$name', ADDRESS = '$address', MOTOR_NO = '$motor', CHASSIS_NO = '$chassis', PLATE_NO = '$plateNum', DATE_OF_RENEWAL = '$dateRenew', MAKE = '$make' 
            WHERE SBN_NO = '$sbn'
        ");
    
        if ($query) {
            $_SESSION['error_message'] = "Record updated successfully";
            header("Location: ../toda/".$tables.".php?table=".$table."");
        } else {
            echo '<script>
                alert ("Error updating record: ' . mysqli_error($conn) . '");
                </script>';
        }
    }
?>