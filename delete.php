<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';

try{
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];
    
        $stmt = $pdo->prepare("DELETE FROM entreprises WHERE id = :id");
        $stmt->execute([':id' => $id]);


        $_SESSION["messageDelete"] = "✅ Entreprise suprimée avec succès.";
        header("Location: dashboardAdmin.php");
        exit();
    }
}
catch(PDOException $e) {
    echo "Erreur". $e->getMessage();
}
?>
