<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petits prix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'navbar.php'; ?>
    <main>
        <?php include 'hero_petits_prix.php'; ?>
        <?php
         require 'db.php';                /*le require au lieu de include permet de s'assurer que le fichier est bien inclus, sinon le script s'arrête  ce qui est une bonne pratique pour les fichiers essentiels*/
            // Vérification du paramètre de tri dans l'URL
            $tri = isset($_GET['tri']) ? $_GET['tri'] : 'asc'; // Si le paramètre tri est défini dans l'URL, on l'utilise, sinon on utilise 'asc' par défaut
            // Construction de la requête SQL en fonction du paramètre de tri
            if ($tri === 'desc') {
                $sql = "SELECT * FROM produits WHERE categorie_id NOT IN (4) AND (prix < 70) ORDER BY prix DESC"; // Requête pour récupérer tous les produits triés par prix décroissant
            } else {
                $sql = "SELECT * FROM produits WHERE categorie_id NOT IN (4) AND (prix < 70) ORDER BY prix ASC"; // Requête pour récupérer tous les produits triés par prix croissant
            } 
            
            $stmt = $pdo->query($sql); // Exécution de la requête et stockage du résultat dans un objet PDOStatement nommé $stmt
            $fleurs = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les produits sous forme de tableau associatif
        ?>
        <section class="fleurs-section">
            <h1>Nos bouquets</h1>
             
            <div class="tri-prix-boutons">
                <a href="?tri=asc" class="btn-tri <?=(isset($_GET['tri']) && $_GET['tri'] === 'asc') ? 'active' : '' ?>">Prix croissant</a>  <!-- l'URL contient un paramètre tri qui permet de trier les produits par prix croissant ou décroissant. La classe active est ajoutée si le paramètre tri est égal à asc ou desc, ce qui permet de mettre en évidence le bouton sélectionné -->
                <a href="?tri=desc" class="btn-tri <?=(isset($_GET['tri']) && $_GET['tri'] === 'desc') ? 'active' : '' ?>">Prix décroissant</a>  <!-- l'URL contient un paramètre tri definit grace a ?tri lorsqu'on clique sur le lien la page se  recharge et la requête SQL est exécutée en fonction de la nouvelle URL qui permet de trier les produits par prix croissant ou décroissant. La classe active est ajoutée si le paramètre tri est égal à asc ou desc, ce qui permet de mettre en évidence le bouton sélectionné -->
            </div>

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