<?php

include '../rot13_encrypt.php';
include '../AES256.php';

if (
    isset($_POST['fname']) &&
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['token'])
) {

    include "../database.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $token = $_POST['token'];

    $data = "fname=" . $fname . "&uname=" . $uname;

    if ($token !== "ngudirahayu") {
        $em = "Invalid token";
        header("Location: ../index.php?error=$em&$data");
        exit;
    }

    if (empty($fname)) {
        $em = "Full name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else {
        $pass_rot13 = rot13_encrypt($pass);
        $pass_encrypt = openssl_encrypt($pass_rot13, $encryptionMethod, $encryptionKey, 0, $iv);
        $sql = "INSERT INTO users (fname, username, password)
                VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname, $uname, $pass_encrypt]);

        header("Location: ../index.php?success=Your account has been created successfully");
        exit;
    }
} else {
    header("Location: ../index.php?error=error");
    exit;
}
