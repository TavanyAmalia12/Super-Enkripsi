<!-- reset_password.php -->

<?php
session_start();

include '../rot13_encrypt.php';
include '../AES256.php';

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

    $new_pass_rot13 = rot13_encrypt($new_pass);
    $new_pass_encrypt = openssl_encrypt($new_pass_rot13, $encryptionMethod, $encryptionKey, 0, $iv);
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$new_pass_encrypt, $uname]);

    echo '<script>alert("Password reset successfully. Please log in with your new password.");</script>';

    header("Location: ../login.php");
    exit;

} else {
    header("Location: ../forgot_password.php?error=error");
    exit;
}
?>
