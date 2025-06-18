<?php 
//get 



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <title>Bouquets de mariage</title>
</head>
<?php include 'navbar.php'; ?>
<body>
    <main>
        <?php include 'hero_mariage.php'; ?>
        <?php
         require 'db.php';                /*le require au lieu de include permet de s'assurer que le fichier est bien inclus, sinon le script s'arrête  ce qui est une bonne pratique pour les fichiers essentiels*/
            $sql = "SELECT * FROM produits WHERE categorie_id IN ( 3) ORDER BY nom ASC "; // Requête pour récupérer tous les produits mise dans la variable $sql parce que je peux l'utiliser plusieurs fois et que c'est plus lisible et je peux la modifier facilement si besoin
            $stmt = $pdo->query($sql); // Exécution de la requête et stockage du résultat dans un objet PDOStatement nommé $stmt
            $fleurs = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les produits sous forme de tableau associatif
        ?>
        <section class="fleurs-section">
            <h1>Nos Bouquets de mariage</h1>

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
                        <form method ="post" action="ajouter_panier.php"> <!-- La méthode POST est utilisée pour envoyer les données du formulaire de manière sécurisée parceque les données ne s'affichent pas dans l'URL grace a cette methode;; La partie action dit au navigateur que lorsqu'on clique sur le bouton les données seront envoyées a ce fichier PHP qui traitera l'ajout au panier -->
                            <input type="hidden" name="fleur_id" value="<?php echo $fleur['id']; ?>">
                            <input type="hidden" name="fleur_image" value="<?php echo htmlspecialchars($fleur['image_url']); ?>"> <!-- On utilise des champs cachés pour envoyer les données du produit au script d'ajout au panier -->
                            <input type="hidden" name="fleur_nom" value="<?php echo htmlspecialchars($fleur['nom']); ?>">
                            <input type="hidden" name="fleur_prix" value="<?php echo $fleur['prix']; ?>">
                            <button type="submit" class="btn-ajouter-panier">Ajouter au panier</button>
                        </form>
                    </div>
                 <?php endforeach; ?>
            </div>
        </section>

    </main>
  
    
</body>
<?php include 'footer.php'; ?>
</html>