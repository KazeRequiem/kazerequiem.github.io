<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une entreprise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ajouter une entreprise</h2>

    <form action="saisieInfosAjouter.php" method="POST">
        <label for="Nom">Nom entreprise :</label>
        <input type="text" id="Nom" name="Nom" required>
        <br>
        <label for="Email">Email entreprise :</label>
        <input type="email" id="Email" name="Email" required>
        <br>
        <label for="Tel">Téléphone entreprise :</label>
        <input type="tel" id="Tel" name="Tel" required>
        <br>
        <label for="Adresse">Adresse entreprise :</label>
        <input type="text" id="Adresse" name="Adresse" required>
        <br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
