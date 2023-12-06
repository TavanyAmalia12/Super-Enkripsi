<!-- reset_password.php -->

<?php
session_start();

if (isset($_POST['uname']) &&
    isset($_POST['new_pass']) &&
    isset($_POST['token'])) {

    include "../database.php";

    $uname = $_POST['uname'];
    $new_pass = $_POST['new_pass'];
    $token = $_POST['token'];

    $data = "uname=" . $uname;

    if ($token !== "ngudirahayu") {
        $em = "Invalid token";
        header("Location: ../forgot_password.php?error=$em&$data");
        exit;
    }

    if (empty($new_pass)) {
        $em = "New password is required";
        header("Location: ../forgot_password.php?error=$em&$data");
        exit;
    }

    $hashed_password = password_hash($new_pass, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$hashed_password, $uname]);

    // Display success alert using JavaScript
    echo '<script>alert("Password reset successfully. Please log in with your new password.");</script>';

    header("Location: ../login.php");
    exit;

} else {
    header("Location: ../forgot_password.php?error=error");
    exit;
}
?>
