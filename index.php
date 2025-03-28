<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php
    session_start();
    if (isset($_SESSION['erreur'])) {
        echo '<p style="color: red;">'.htmlspecialchars($_SESSION['erreur']).'</p>';
        unset($_SESSION['erreur']);
    }
    ?>
    <form action="login.php" method="POST">
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <br>
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required>
        <br>
        <button type="submit">Connexion</button>
    </form>
</body>
</html>