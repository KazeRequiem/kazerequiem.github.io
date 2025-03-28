<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';

echo "<p>Bienvenue, " . htmlspecialchars($_SESSION["admin"]) . "</p>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Liste des entreprises</h2>

    <!-- Bouton Ajouter -->
    <a href="ajouter.php">
        <button>Ajouter une entreprise</button>
    </a>

    <?php
    if (isset($_SESSION['messageAjout'])) {
        echo '<p style="color: green;">'.htmlspecialchars($_SESSION['messageAjout']).'</p>';
        unset($_SESSION['messageAjout']);
    }

    if (isset($_SESSION['messageModif'])) {
        echo '<p style="color: green;">'.htmlspecialchars($_SESSION['messageModif']).'</p>';
        unset($_SESSION['messageModif']);
    }

    if (isset($_SESSION['messageDelete'])) {
        echo '<p style="color: green;">'.htmlspecialchars($_SESSION['messageDelete']).'</p>';
        unset($_SESSION['messageDelete']);
    }
    ?>

    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th>
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
            echo "<td>";
            echo "<a href='modifier.php?id=" . $entreprise["id"] . "'><button>Modifier</button></a> ";
            echo "<a href='delete.php?id=" . $entreprise["id"] . "' onclick='return confirm(\"Voulez-vous vraiment supprimer cette entreprise ?\");'><button>Supprimer</button></a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <form action="deconnexion.php" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>
