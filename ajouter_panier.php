<?php
session_start();
require 'db.php'; // Connexion à ta base de données via PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie que toutes les données nécessaires sont présentes
    if (
        isset($_POST['fleur_id'], $_POST['fleur_nom'], $_POST['fleur_prix'], $_POST['fleur_image'])
    ) {
        // Récupération des données du formulaire
        $id = (int)$_POST['fleur_id'];
        $nom = $_POST['fleur_nom'];
        $prix = (float)$_POST['fleur_prix'];
        $image = $_POST['fleur_image'];

        // 🔍 Requête SQL pour récupérer le stock réel du produit
        $stmt = $pdo->prepare("SELECT stock FROM produits WHERE id = ?");
        $stmt->execute([$id]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produit) {
            $_SESSION['message_stock'] = "Produit introuvable.";
            header('Location: panier.php');
            exit();
        }

        $stock_reel = (int)$produit['stock'];

        // ✅ Initialiser le panier s'il n'existe pas
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        return var_dump($_SESSION['panier']); // Pour déboguer, à retirer en production
        
        // 🛒 Si le produit est déjà dans le panier
        if (isset($_SESSION['panier'][$id])) {
            if ($_SESSION['panier'][$id]['quantite'] < $stock_reel) {
                $_SESSION['panier'][$id]['quantite']++;
            } else {
                $_SESSION['message_stock'] = "Quantité maximale atteinte pour le produit : " . htmlspecialchars($nom);
            }
        } else {
            // ➕ Si le produit n'est pas encore dans le panier
            $_SESSION['panier'][$id] = [
                'nom' => $nom,
                'prix' => $prix,
                'quantite' => 1,
                'image_url' => $image,
                'stock' => $stock_reel // Enregistre le stock réel en session
            ];
        }

        // ✅ Redirige vers l'accueil après traitement
        header('Location: index.php');
        exit();
    } else {
        // En cas de formulaire incomplet
        header('Location: panier.php?erreur=Formulaire invalide');
        exit();
    }
}