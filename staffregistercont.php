<?php
session_start();
include 'dbmanager.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $adminfullname = htmlspecialchars(trim($_POST['fullname']));
    $adminemail = htmlspecialchars(trim($_POST['email']));
    $adminusername = htmlspecialchars(trim($_POST['username']));
    $adminphonenumber = htmlspecialchars(trim($_POST['phone']));
    $adminpassword = htmlspecialchars(trim($_POST['password']));
    $admincpassword = htmlspecialchars(trim($_POST['cpassword']));
    
    // Validation for input fields
    $errors = [];

    // Check if passwords match
    if ($adminpassword !== $admincpassword) {
        $errors[] = "Passwords do not match.";
    }

    // Ensure all fields are filled
    if (empty($adminfullname) || empty($adminemail) || empty($adminusername) || empty($adminphonenumber) || empty($adminpassword) || empty($admincpassword)) {
        $errors[] = "Please fill in all fields.";
    }

    // Check for valid phone number format
    if (!preg_match("/^01\d{8}$/", $adminphonenumber)) {
        $errors[] = "Invalid phone number. Use format: 0111111111.";
    }

    // Check for any errors
    if (empty($errors)) {
        // Do NOT hash the password, insert it as plain text
        // Prepare the SQL statement to insert the new admin record
        $sql = "INSERT INTO admins (adminfullname, adminemail, adminusername, adminphonenumber, adminpassword) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $adminfullname, $adminemail, $adminusername, $adminphonenumber, $adminpassword);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); history.back();</script>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Display validation errors
        $errorMessages = implode("\\n", $errors);
        echo "<script>alert('$errorMessages'); history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); history.back();</script>";
}
?>
