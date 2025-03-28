<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && is_numeric($_POST["id"])) {
    try {
        $id = $_POST["id"];
        $Nom = $_POST["Nom"];
        $Email = $_POST["Email"];
        $Tel = $_POST["Tel"];
        $Adresse = $_POST["Adresse"];
    
        $stmt = $pdo->prepare("UPDATE entreprises SET Nom = :Nom, Email = :Email, Tel = :Tel, Adresse = :Adresse WHERE id = :id");
        $stmt->execute([
            ':id' => $id,
            ':Nom' => $Nom,
            ':Email' => $Email,
            ':Tel' => $Tel,
            ':Adresse' => $Adresse
        ]);

        $_SESSION["messageModif"] = "✅ Entreprise modifiée avec succès.";
        header("Location: dashboardAdmin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    $_SESSION["messageModif"] = "❌ Erreur lors de la modification.";
    header("Location: dashboardAdmin.php");
    exit();
}
?>