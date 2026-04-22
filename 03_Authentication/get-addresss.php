<?php
// ============================================================
//  get_address.php  (place in 00_Config/)
//  AJAX endpoint — returns cities, barangays, or streets as JSON
//  depending on ?type= and ?id= query params
// ============================================================

include_once 'config.php';
header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$id   = intval($_GET['id'] ?? 0);

// Validate inputs
if (!$id || !in_array($type, ['city', 'barangay', 'street'])) {
    echo json_encode([]);
    exit;
}

switch ($type) {

    case 'city':
        $sql        = "SELECT City_ID, City_Name 
                       FROM Address_City 
                       WHERE Province_ID = ? 
                       ORDER BY City_Name";
        $value_key  = 'City_ID';
        $label_key  = 'City_Name';
        break;

    case 'barangay':
        $sql        = "SELECT Barangay_ID, Barangay_Name 
                       FROM Address_Barangay 
                       WHERE City_ID = ? 
                       ORDER BY Barangay_Name";
        $value_key  = 'Barangay_ID';
        $label_key  = 'Barangay_Name';
        break;

    case 'street':
        // Note: column is "Stree_Name" (typo in original schema — update if fixed)
        $sql        = "SELECT Street_ID, Stree_Name 
                       FROM Address_Street 
                       WHERE Barangay_ID = ? 
                       ORDER BY Stree_Name";
        $value_key  = 'Street_ID';
        $label_key  = 'Stree_Name';
        break;

    default:
        echo json_encode([]);
        exit;
}

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([]);
    exit;
}

$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id'   => $row[$value_key],
        'name' => $row[$label_key],
    ];
}

echo json_encode($data);

$stmt->close();
$conn->close();
?>