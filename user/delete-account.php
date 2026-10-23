<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $uid = $_SESSION['ocasuid'];

    // Verify password before deletion
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbluser WHERE ID=:uid AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Delete all notes belonging to this user
        $deleteNotes = $dbh->prepare("DELETE FROM tblnotes WHERE UserID=:uid");
        $deleteNotes->bindParam(':uid', $uid, PDO::PARAM_STR);
        $deleteNotes->execute();

        // Delete the user account
        $deleteUser = $dbh->prepare("DELETE FROM tbluser WHERE ID=:uid");
        $deleteUser->bindParam(':uid', $uid, PDO::PARAM_STR);
        $deleteUser->execute();

        // Destroy session and redirect to homepage
        session_destroy();
        echo '<script>alert("Your account has been permanently deleted."); window.location.href="../index.php";</script>';
        exit();
    } else {
        echo '<script>alert("Incorrect password. Account deletion cancelled."); window.location.href="setting.php";</script>';
        exit();
    }
} else {
    header('location:setting.php');
    exit();
}
?>
