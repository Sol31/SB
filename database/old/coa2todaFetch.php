<?php
    include("connection.php");

// Define your query
$query = "SELECT * FROM co2toda_2024 WHERE 1=1"; // Initial query

// Count total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM co2toda_2024";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Handle search parameters
if(isset($_POST['search']) && !empty($_POST['search']['value'])) {
    $search = $_POST['search']['value'];
    $query .= " AND (";
    $query .= " `SBN_NO` LIKE '%" . $search . "%'";
    $query .= " OR `NAME` LIKE '%" . $search . "%'";
    $query .= " OR `ADDRESS` LIKE '%" . $search . "%'";
    $query .= " OR `MOTOR_NO` LIKE '%" . $search . "%'";
    $query .= " OR `CHASSIS_NO` LIKE '%" . $search . "%'";
    $query .= " OR `PLATE_NO` LIKE '%" . $search . "%'";
    $query .= " OR `DATE_OF_RENEWAL` LIKE '%" . $search . "%'";
    $query .= " )";
}

// Handle sorting
if(isset($_POST['order']) && isset($_POST['order'][0])) {
    $orderColumnIndex = $_POST['order'][0]['column'];
    $orderColumnName = $_POST['columns'][$orderColumnIndex]['data'];
    $orderDirection = $_POST['order'][0]['dir'];
    $query .= " ORDER BY `" . $orderColumnName . "` " . $orderDirection;
}

// Handle limit
if(isset($_POST['start']) && isset($_POST['length'])) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $query .= " LIMIT " . $start . ", " . $length;
}

// Define your query
// $query = "SELECT * FROM co2toda_2024";

// Execute query
$result = $conn->query($query);

// Fetch data and encode to JSON
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON response
echo json_encode(array(
    "data" => $data,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords
    ));
?>
