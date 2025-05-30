<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deuil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'navbar.php'; ?>
    <main>
        <?php include 'hero_deuil.php'; ?>
        <?php
         require 'db.php';                /*le require au lieu de include permet de s'assurer que le fichier est bien inclus, sinon le script s'arrête  ce qui est une bonne pratique pour les fichiers essentiels*/
            $sql = "SELECT * FROM produits WHERE categorie_id=4"; // Requête pour récupérer tous les produits mise dans la variable $sql parce que je peux l'utiliser plusieurs fois et que c'est plus lisible et je peux la modifier facilement si besoin
            $stmt = $pdo->query($sql); // Exécution de la requête et stockage du résultat dans un objet PDOStatement nommé $stmt
            $fleurs = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les produits sous forme de tableau associatif
        ?>
        <section class="fleurs-section">
            <h1>Fleurs pour deuil</h1>

            <div class="grille-fleurs">
                <?php foreach ($fleurs as $fleur): ?>
                    <div class="fleur">
                        <img src="<?php echo htmlspecialchars($fleur['image_url']); ?>" alt="<?php echo htmlspecialchars($fleur['nom']); ?>" >  <!-- htmlspecialchars() permet d'échapper les caractères spéciaux pour éviter les attaques XSS-->
                        <h2><?php echo htmlspecialchars($fleur['nom']); ?></h2>
                        <p><?php echo htmlspecialchars($fleur['description']); ?></p>
                        <div class="prix">
                            <?= number_format($fleur['prix'], 2) ?> €  <!--number_format() permet de formater le prix avec deux décimales et une virgule comme séparateur décimal-->
                       </div>
                       <div class="stock">
                        <?php if ($fleur['stock'] > 0): ?>
                            <span class="disponible">En stock</span>
                        <?php else: ?>
                            <span class="indisponible">Indisponible</span>
                        <?php endif; ?>
                        </div>
                    </div>
                 <?php endforeach; ?>
            </div>
        </section>

    </main>
    <?php include 'footer.php'; ?>
    
</body>
</html>