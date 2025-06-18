<?php
session_start();
require 'db.php'; // connexion à la base

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (empty($email) || empty($mot_de_passe)) {
        $erreurs[] = "Tous les champs sont obligatoires.";
    } else {
        // Vérifie si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
            $_SESSION['message'] = "Bienvenue " . htmlspecialchars($utilisateur['nom']) . " !";

            // Redirection vers la page d'accueil ou dashboard
            header("Location: index.php");
            exit();
        } else {
            $erreurs[] = "Identifiants incorrects.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Bouton retour à l'accueil -->
<div class="retour-accueil">
    <a href="index.php">← Retour à l’accueil</a>
</div>
    <h1>Se connecter</h1>

    <?php if (!empty($erreurs)): ?>
        <div class="erreurs">
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="message">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Email :
            <input type="email" name="email" required>
        </label><br>

        <label>Mot de passe :
            <input type="password" name="mot_de_passe" required>
        </label><br>

        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
</body>
</html>