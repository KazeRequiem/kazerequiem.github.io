<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $pseudo = $_POST["pseudo"];
        $motDePasse = $_POST["motDePasse"];
    
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo AND motDePasse = :motDePasse AND statutAdmin = 1");
        $stmt->execute([':pseudo' => $pseudo,':motDePasse' => $motDePasse]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($stmt->rowCount() > 0) {
            $_SESSION["admin"] = $utilisateur["pseudo"];
            header("Location: dashboardAdmin.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo AND motDePasse = :motDePasse AND statutAdmin = 0");
        $stmt->execute([':pseudo' => $pseudo,':motDePasse' => $motDePasse]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            $_SESSION["user"] = $utilisateur["pseudo"];
            header("Location: dashboardUser.php");
            exit();
        }

        $_SESSION['erreur'] = "❌ Pseudo ou mot de passe incorrect.";
        header("Location: index.php");
        exit();
    }
    catch(PDOException $e) {
        echo "". $e->getMessage();
    }
    
}
?>