<?php

$host = 'localhost';
$dbname = 'prositcookie';
$username = 'root';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8", 
        $username, 
        ''
    );
    
    // Configuration supplémentaire
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>