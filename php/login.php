<?php
session_start();

include '../rot13_encrypt.php';
include '../AES256.php';

if (isset($_POST['uname']) &&
    isset($_POST['pass'])) {

    include "../database.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=".$uname;

    if (empty($uname)){
        $em = "Username is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else if (empty($pass)){
        $em="Password is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    }
    else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);

        if ($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            
            $username = $user['username'];
            $password = $user['password'];
            $fname = $user['fname'];
            $id = $user['id'];

            if($username === $uname){
                $pass_rot13 = rot13_encrypt($pass);
                $pass_aes = openssl_encrypt($pass_rot13, $encryptionMethod, $encryptionKey, 0, $iv);
                if($pass_aes === $password){
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;

                    header("Location: ../form-view-member.php");
                    exit;

                } else {
                    $em = "Incorrect username or password";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                }

            } else {
                $em = "Incorrect username or password";
                header("Location: ../login.php?error=$em&$data");
                exit;
            }
            
        } else {
            $em = "Incorrect username or password";
            header("Location: ../login.php?error=$em&$data");                
            exit;
        }
    }

} else {
    header("Location: ../login.php?error=error");
    exit;
}
?>