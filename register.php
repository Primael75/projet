<?php
session_start();
require 'db.php'; // connexion à la base de données

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    // Validation de base
    if (empty($nom) || empty($email) || empty($mot_de_passe) || empty($confirmation)) {
        $erreurs[] = "Tous les champs sont obligatoires.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email n'est pas valide.";
    }

    if ($mot_de_passe !== $confirmation) {
        $erreurs[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérification email existant
    $stmt = $pdo->prepare("SELECT id FROM `user` WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $erreurs[] = "Cet email est déjà utilisé.";
    }

    // S'il n'y a pas d’erreurs, on insère
    if (empty($erreurs)) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO `user` (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $mot_de_passe_hash]);

        $_SESSION['message'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
  <!-- Bouton retour à l'accueil -->
<div class="retour-accueil">
    <a href="index.php">← Retour à l’accueil</a>
</div>
    <h1>Créer un compte</h1>

    <?php if (!empty($erreurs)): ?>
        <div class="erreurs">
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Nom :
            <input type="text" name="nom" required>
        </label><br>

        <label>Email :
            <input type="email" name="email" required>
        </label><br>

        <label>Mot de passe :
            <input type="password" name="mot_de_passe" required>
        </label><br>

        <label>Confirmer le mot de passe :
            <input type="password" name="confirmation" required>
        </label><br>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
</html>