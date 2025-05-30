<?php
// db.php : connexion a la base de données
$hostname = 'localhost';               // Mon server MysQL
$dbname = 'projet';              // Nom de la base de données
$user = 'root';                 // Utilisateur Mysql
$password = '';             // Mot de passe de MySQL qui est vide par défaut
try{
    // création d'une instance PDO pour se connecter à la base de données
    $pdo = new PDO ( "mysql:host=$hostname;dbname=$dbname;charset=utf8", $user, $password);
    // Mode exxception pour que je puisse corrrectement gérer les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si une erreur se produit, elle sera affichée ici
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>