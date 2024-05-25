<?php
include ("connection.php");
if (isset($_POST['submit'])) {
    $sbn = $_POST['sbn'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $motor = $_POST['motor'];
    $chassis = $_POST['chassis'];
    $plateNum = $_POST['plate'];
    $dateRenew = $_POST['dateRenew'];
    $make = $_POST['make'];

    $table = $_POST['toda'];

    if (empty($sbn) || empty($name) || empty($address) || empty($motor) || empty($chassis) || empty($dateRenew) || empty($make)) {
        echo '<script>
            alert ("All field must be filled");
            </script>';
        return;
    }

    

    // Assuming $connection is your mysqli database connection object
    $query = mysqli_query($conn, "INSERT INTO " . $table . "toda_2024 (SBN_NO, NAME, ADDRESS, MOTOR_NO, CHASSIS_NO, PLATE_NO, DATE_OF_RENEWAL, MAKE) 
                            values('$sbn', '$name', '$address', '$motor', '$chassis', '$plateNum', '$dateRenew', '$make')");

    if(!empty($query)) {
        echo '<script>
            alert ("Successful registered");
            </script>';
        return;
    }
}
?>