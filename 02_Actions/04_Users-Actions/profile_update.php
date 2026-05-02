<?php
require_once '../02_Actions/GlobalVariables.php';
require_once '../00_Config/config.php';

if (!$_SESSION['user_id']) {
    http_response_code(403);
    exit;
}

$user_id = $_SESSION['user_id'];

// Only update columns that exist in 01_user_users
// 1. Update user info
$stmt1 = $pdo->prepare("
    UPDATE `01_user_users` SET
        First_name  = ?,
        Middle_name = ?,
        Last_name   = ?,
        Phone       = ?,
        Email       = ?
    WHERE User_ID = ?
");
$stmt1->execute([
    $_POST['first_name'],
    $_POST['middle_name'],
    $_POST['last_name'],
    $_POST['phone'],
    $_POST['email'],
    $user_id
]);

// 2. Update address (raw table, not view — views can't be updated)
$stmt2 = $pdo->prepare("
    UPDATE `05_address_user_address` SET
        Province_ID  = ?,
        City_ID      = ?,
        Barangay_ID  = ?,
        Street       = ?
    WHERE User_ID = ?
");
$stmt2->execute([
    $_POST['province_id'],
    $_POST['city_id'],
    $_POST['barangay_id'],
    $_POST['street'],
    $user_id
]);

// Update session to reflect changes
$_SESSION['full_name'] = $_POST['first_name'] . ' ' . $_POST['last_name'];
$_SESSION['Email']     = $_POST['email'];
$_SESSION['Phone']     = $_POST['phone'];

header('Location: ../04_User/05_Profile.php?saved=1');
exit;