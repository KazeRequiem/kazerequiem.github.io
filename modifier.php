<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

require 'database.php';
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    
    $stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entreprise) {
        echo "Entreprise non trouvée.";
        exit();
    }
} else {
    echo "ID invalide.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une entreprise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Modifier une entreprise</h2>

    <form action="saisieInfosModifier.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <label for="Nom">Nom entreprise :</label>
        <input type="text" id="Nom" name="Nom" value="<?= htmlspecialchars($entreprise['Nom']) ?>" required>
        <br>

        <label for="Email">Email entreprise :</label>
        <input type="email" id="Email" name="Email" value="<?= htmlspecialchars($entreprise['Email']) ?>" required>
        <br>

        <label for="Tel">Téléphone entreprise :</label>
        <input type="tel" id="Tel" name="Tel" value="<?= htmlspecialchars($entreprise['Tel']) ?>" required>
        <br>

        <label for="Adresse">Adresse entreprise :</label>
        <input type="text" id="Adresse" name="Adresse" value="<?= htmlspecialchars($entreprise['Adresse']) ?>" required>
        <br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
