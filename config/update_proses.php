<?php
session_start();
include 'connection.php';

if (isset($_POST['update']) && isset($_SESSION['idUser'])) {
    $idUser       = $_SESSION['idUser'];
    $username     = $_POST['username'];
    $beratBadan   = $_POST['beratBadan'];
    $tinggiBadan  = $_POST['tinggiBadan'];
    $golongan     = $_POST['golonganDarah'];

    try {
        $sql = "UPDATE users SET 
                username = :username, 
                beratBadan = :berat, 
                tinggiBadan = :tinggi, 
                golonganDarah = :golongan 
                WHERE idUser = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':berat', $beratBadan);
        $stmt->bindParam(':tinggi', $tinggiBadan);
        $stmt->bindParam(':golongan', $golongan);
        $stmt->bindParam(':id', $idUser);

        if ($stmt->execute()) {
            // Update session jika nama berubah
            $_SESSION['username'] = $username;
            echo "<script>alert('Profil berhasil diperbarui!'); window.location='../profil_user.php';</script>";
        }
    } catch(PDOException $e) {
        die("Gagal update: " . $e->getMessage());
    }
} else {
    header("Location: ../profile.php");
}
?>