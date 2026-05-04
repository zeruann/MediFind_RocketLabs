<?php
require_once '../../02_Actions/GlobalVariables.php';
require_once '../../00_Config/config.php';

if (!$_SESSION['user_id']) {
    http_response_code(403);
    exit;
}

$user_id = $_SESSION['user_id'];

try {

    // ─── 1. Build user UPDATE — password only included if provided ─────────
    $first_name = trim($_POST['first_name'] ?? '');
    $middle_name = trim($_POST['middle_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $birth_date = trim($_POST['birth_date'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $province = trim($_POST['province'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $barangay = trim($_POST['barangay'] ?? '');

    $new_password = trim($_POST['password'] ?? '');

    // ─── 2. Update personal info (matches columns from view_01_users / login) ─
    if (!empty($new_password)) {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt1 = $pdo->prepare("
            UPDATE `01_user_users`
            SET
                First_name    = ?,
                Middle_name   = ?,
                Last_name     = ?,
                Phone         = ?,
                Email         = ?,
                Gender        = ?,
                Birthdate     = ?,
                Password_hash = ?
            WHERE User_ID = ?
        ");
        $stmt1->execute([
            $first_name,
            $middle_name,
            $last_name,
            $phone,
            $email,
            $gender,
            $birth_date,
            $password_hash,
            $user_id
        ]);
    } else {
        $stmt1 = $pdo->prepare("
            UPDATE `01_user_users`
            SET
                First_name  = ?,
                Middle_name = ?,
                Last_name   = ?,
                Phone       = ?,
                Email       = ?,
                Gender      = ?,
                Birthdate   = ?
            WHERE User_ID = ?
        ");
        $stmt1->execute([
            $first_name,
            $middle_name,
            $last_name,
            $phone,
            $email,
            $gender,
            $birth_date,
            $user_id
        ]);
    }

    // ─── 3, 4, 5. IDs come directly from the dropdowns ────────────────
    $province_id = (int) ($_POST['province'] ?? 0);
    $city_id = (int) ($_POST['city'] ?? 0);
    $barangay_id = (int) ($_POST['barangay'] ?? 0);

    // ─── Resolve names for session storage ────────────────────────────
    $pStmt = $pdo->prepare("SELECT Province_Name FROM `06_address_province` WHERE Province_ID = ? LIMIT 1");
    $pStmt->execute([$province_id]);
    $province = $pStmt->fetchColumn() ?: '';

    $cStmt = $pdo->prepare("SELECT City_Name FROM `07_address_city` WHERE City_ID = ? LIMIT 1");
    $cStmt->execute([$city_id]);
    $city = $cStmt->fetchColumn() ?: '';

    $bStmt = $pdo->prepare("SELECT Barangay_Name FROM `08_address_barangay` WHERE Barangay_ID = ? LIMIT 1");
    $bStmt->execute([$barangay_id]);
    $barangay = $bStmt->fetchColumn() ?: '';


    // ─── Resolve names for session storage ────────────────────────────
    $pStmt = $pdo->prepare("SELECT Province_Name FROM `06_address_province` WHERE Province_ID = ? LIMIT 1");
    $pStmt->execute([$province_id]);
    $province = $pStmt->fetchColumn() ?: '';

    $cStmt = $pdo->prepare("SELECT City_Name FROM `07_address_city` WHERE City_ID = ? LIMIT 1");
    $cStmt->execute([$city_id]);
    $city = $cStmt->fetchColumn() ?: '';

    $bStmt = $pdo->prepare("SELECT Barangay_Name FROM `08_address_barangay` WHERE Barangay_ID = ? LIMIT 1");
    $bStmt->execute([$barangay_id]);
    $barangay = $bStmt->fetchColumn() ?: '';


    // ─── 6. Update address — safe UPDATE with JOIN instead of subquery ─────
    // First check if address row exists for this user
    $check_addr = $pdo->prepare("
        SELECT Address_ID FROM `05_address_user_address`
        WHERE User_ID = ?
        LIMIT 1
    ");
    $check_addr->execute([$user_id]);
    $address_id = $check_addr->fetchColumn();

    if ($address_id) {
        // Row exists — update it
        $stmt2 = $pdo->prepare("
            UPDATE `05_address_user_address`
            SET
                Province_ID = ?,
                City_ID     = ?,
                Barangay_ID = ?,
                Street      = ?
            WHERE Address_ID = ?
        ");
        $stmt2->execute([
            $province_id,
            $city_id,
            $barangay_id,
            $street,
            $address_id
        ]);
    } else {
        // No address row yet — insert one
        $stmt2 = $pdo->prepare("
            INSERT INTO `05_address_user_address`
                (User_ID, Province_ID, City_ID, Barangay_ID, Street)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt2->execute([
            $user_id,
            $province_id,
            $city_id,
            $barangay_id,
            $street
        ]);
    }

    // ─── 7. Refresh session — mirrors exactly what login_action.php stores ─
    $_SESSION['fname'] = $first_name;
    $_SESSION['mname'] = $middle_name;
    $_SESSION['lname'] = $last_name;
    $_SESSION['full_name'] = $first_name . ' ' . $middle_name . ' ' . $last_name;
    $_SESSION['Email'] = $email;
    $_SESSION['Phone'] = $phone;
    $_SESSION['Gender'] = $gender;
    $_SESSION['Birthdate'] = $birth_date;
    $_SESSION['Street'] = $street;
    $_SESSION['Barangay_Name'] = $barangay;
    $_SESSION['City_Name'] = $city;
    $_SESSION['Province_Name'] = $province;

    $_SESSION['success'] = "Profile updated successfully.";

    $role = $_SESSION['role_label'] ?? null;

    if ($role === 'System Admin') {
        header('Location: ../../06_SystemAdmin/06_Profile.php?saved=1');

    } elseif ($role === 'Patient/Client') {
        header('Location: ../../04_User/05_Profile.php?saved=1');

    } elseif ($role === 'Pharmacy Admin') {
        header('Location: ../../05_PharmacyAdmin/07_Profile.php?saved=1');
    }

    else {
        header('Location: ../../06_SystemAdmin/06_Profile.php?saved=1'); // fallback
    }

    // } elseif ($role === 'Pharmacy Owner') {
    //     header('Location: ../../04_User/User-Profiles.php?saved=1');
    // } 

    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = "Update failed: " . $e->getMessage();

    $role = $_SESSION['role_label'] ?? null;

    if ($role === 'System Admin') {
        header('Location: ../../06_SystemAdmin/06_Profile.php?saved=1');

    } elseif ($role === 'Patient/Client') {
        header('Location: ../../04_User/05_Profile.php?saved=1');

    } elseif ($role === 'Pharmacy Admin') {
        header('Location: ../../05_PharmacyAdmin/07_Profile.php?saved=1');
    }

    else {
        header('Location: ../../06_SystemAdmin/06_Profile.php?saved=1'); // fallback
    }
    
    // } elseif ($role === 'Pharmacy Owner') {
    //     header('Location: ../../04_User/User-Profiles.php?saved=1');
    // } 

    exit;
}
