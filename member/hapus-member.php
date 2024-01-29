<?php
session_start();
include '../database.php';

    if (isset($_GET['id_member'])) {

        $id_member = $_GET['id_member'];

        $Hapus = "DELETE FROM member WHERE id_member = :id_member";
        $stmt = $conn->prepare($Hapus);
        $stmt->bindParam(':id_member', $id_member);

        if ($stmt->execute()) {
            header("Location: ../form-view-member.php");
            exit;
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }
    } else {
        echo "Parameter username tidak ditemukan.";
    }
?>
