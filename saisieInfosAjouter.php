<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $Nom = $_POST["Nom"];
        $Email = $_POST["Email"];
        $Tel = $_POST["Tel"];
        $Adresse = $_POST["Adresse"];
    
        $stmt = $pdo->prepare("INSERT INTO entreprises (Nom, Email, Tel, Adresse) VALUES (:Nom, :Email, :Tel, :Adresse)");
        $stmt->execute([':Nom' => $Nom, ':Email' => $Email, ':Tel' => $Tel, ':Adresse' => $Adresse]);
    }
    catch(PDOException $e)
    {
        echo "". $e->getMessage();
    }
    $_SESSION["messageAjout"] = "✅ Entreprise ajoutée avec succès.";
    header("Location: dashboardAdmin.php");
    exit();
}
