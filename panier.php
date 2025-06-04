<?php
session_start();

$total = 0;
$produits = $_SESSION['panier'] ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mon panier</title>
    <link rel="stylesheet" href="panier.css" />
</head>
<body>

<h1>Mon panier</h1>

<?php if (empty($produits)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $id => $prod): 
            $totalProduit = $prod['prix'] * $prod['quantite'];
            $total += $totalProduit;
        ?>
            <tr>
                <td><?= htmlspecialchars($prod['nom']) ?></td>
                <td><?= number_format($prod['prix'], 2, ',', ' ') ?> €</td>
                <td>
                    <form method="post" action="modifier_quantite.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <button type="submit" name="action" value="moins" <?= ($prod['quantite'] <= 1) ? 'disabled' : '' ?>>-</button>
                    </form>
                    <?= $prod['quantite'] ?>
                    <form method="post" action="modifier_quantite.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <button type="submit" name="action" value="plus">+</button>
                    </form>
                </td>
                <td><?= number_format($totalProduit, 2, ',', ' ') ?> €</td>
                <td>
                    <form method="post" action="retirer_produit.php" onsubmit="return confirm('Supprimer ce produit ?');">
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <button type="submit">Retirer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total général : <?= number_format($total, 2, ',', ' ') ?> €</h3>

<a href="index.php">← Retour à la boutique</a>

<?php endif; ?>

</body>
</html>