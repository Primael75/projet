<?php
session_start();

// === Gestion des actions (AJOUT / RETRAIT / SUPPRESSION / VIDAGE) === //
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if (isset($_SESSION['panier'][$id])) {
        if ($action === 'increment') {
            if ($_SESSION['panier'][$id]['quantite'] < $_SESSION['panier'][$id]['stock']) {
                $_SESSION['panier'][$id]['quantite']++;
            } else {
                $_SESSION['message_stock'] = "Quantité maximale atteinte pour ce produit.";
            }
        } elseif ($action === 'decrement') {
            if ($_SESSION['panier'][$id]['quantite'] > 1) {
                $_SESSION['panier'][$id]['quantite']--;
            } else {
                unset($_SESSION['panier'][$id]);
            }
        } elseif ($action === 'supprimer') {
            unset($_SESSION['panier'][$id]);
        }
    }

    header('Location: panier.php');
    exit();
}

if (isset($_POST['vider_panier'])) {
    unset($_SESSION['panier']);
    header('Location: panier.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre panier | Maelfleur</title>
    <link rel="stylesheet" href="panier.css">
</head>
<body>

<a href="index.php" class="retour-accueil">← Retour à l'accueil</a>

<main>
    <h1>Votre panier</h1>

    <?php if (isset($_SESSION['message_stock'])): ?>
        <div class="message-erreur"><?= htmlspecialchars($_SESSION['message_stock']) ?></div>
        <?php unset($_SESSION['message_stock']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['panier'])): ?>
        <table class="table-panier">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_general = 0;
                foreach ($_SESSION['panier'] as $id => $produit):
                    $total = $produit['prix'] * $produit['quantite'];
                    $total_general += $total;
                ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($produit['image_url']) ?>" width="60" height="60" alt="Image du produit"></td>
                        <td><?= htmlspecialchars($produit['nom']) ?></td>
                        <td><?= number_format($produit['prix'], 2) ?> €</td>
                        <td>
                            <a href="panier.php?id=<?= $id ?>&action=decrement">−</a>
                            <?= $produit['quantite'] ?>
                            <a href="panier.php?id=<?= $id ?>&action=increment">+</a>
                        </td>
                        <td><?= number_format($total, 2) ?> €</td>
                        <td>
                            <a href="panier.php?id=<?= $id ?>&action=supprimer" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total général : <?= number_format($total_general, 2) ?> €</h2>

        <form method="post" action="panier.php">
            <button type="submit" name="vider_panier" onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">🗑 Vider le panier</button>
        </form>

    <?php else: ?>
        <p class="panier-vide">🛒 Votre panier est vide.</p>
    <?php endif; ?>
</main>

</body>
</html>