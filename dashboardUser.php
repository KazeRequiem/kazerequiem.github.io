<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';

echo "<p>Bienvenue, " . htmlspecialchars($_SESSION["user"]) . "</p>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Liste des entreprises</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
        </tr>

        <?php
        $stmt = $pdo->query("SELECT * FROM entreprises");
        $entreprises = $stmt->fetchAll();
        foreach ($entreprises as $entreprise) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($entreprise["Nom"]) . "</td>";
            echo "<td>" . htmlspecialchars($entreprise["Email"]) . "</td>";
            echo "<td>" . htmlspecialchars($entreprise["Tel"]) . "</td>";
            echo "<td>" . htmlspecialchars($entreprise["Adresse"]) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Ajouter un bouton de déconnexion -->
    <form action="deconnexion.php" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>
