<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <title>Petits prix</title>
</head>
<?php include 'navbar.php'; ?>
<body>
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