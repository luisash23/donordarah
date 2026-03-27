<?php
session_start();
include 'connection.php';

// --- LOGIKA LOGIN ---
if (isset($_POST['login'])) {
    $email_input = $_POST['email'];
    $pass_input  = $_POST['password'];

    try {
        $query = "SELECT * FROM users WHERE gmail = :email LIMIT 1";
        $stmt  = $conn->prepare($query);
        $stmt->bindParam(':email', $email_input);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && $pass_input === $user['password']) {
            $_SESSION['login']        = true;
            $_SESSION['idUser']       = $user['idUser'];
            $_SESSION['username']     = $user['username'];
            header("Location: ../dashboard.php");
            exit;
        } else {
            echo "<script>alert('Email atau Password salah!'); window.location='../login.php';</script>";
            exit;
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// --- LOGIKA REGISTER ---
if (isset($_POST['register'])) {
    $username     = $_POST['nama_depan'] . " " . $_POST['nama_belakang'];
    $gmail        = $_POST['gmail'];
    $beratBadan   = $_POST['beratBadan'];
    $tinggiBadan  = $_POST['tinggiBadan'];
    $golongan     = $_POST['golonganDarah'];
    $password     = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($password !== $confirm_pass) {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.history.back();</script>";
        exit;
    }

    try {
        $sql = "INSERT INTO users (username, gmail, tinggiBadan, beratBadan, golonganDarah, password) 
                VALUES (:username, :gmail, :tinggi, :berat, :golongan, :password)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':gmail', $gmail);
        $stmt->bindParam(':tinggi', $tinggiBadan);
        $stmt->bindParam(':berat', $beratBadan);
        $stmt->bindParam(':golongan', $golongan);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo "<script>alert('Pendaftaran Berhasil!'); window.location='../login.php';</script>";
            exit;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}