<?php
session_start(); // Démarre la session pour pouvoir utiliser les variables de session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si le formulaire a été soumis
    if (isset($_POST['fleur_id']) && isset($_POST['fleur_nom']) && isset($_POST['fleur_prix'])) {
        // Récupère les données du formulaire   
        $id= $_POST['fleur_id'];
        $nom = $_POST['fleur_nom'];
        $prix = $_POST['fleur_prix'];

        // Vérifie si le panier existe dans la session, sinon l'initialise ce qui permet à l'utilisateur d'ajouter des éléments a un panier déja existant la raison pour laquelle on a ouvert une session
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Ajoute le produit au panier ou mettre a jour la quantité si le produit est déjà dans le panier
        // Ici, on utilise l'ID du produit comme clé dans le tableau de session pour éviter les doublons
       if(isset($_SESSION['panier'][$id])) {
            // Si le produit est déjà dans le panier, on incrémente la quantité
            $_SESSION['panier'][$id]['quantite']++;
        } else {
            // Sinon, on ajoute le produit avec une quantité de 1
            $_SESSION['panier'][$id] = [
                'nom' => $nom,
                'prix' => $prix,
                'quantite' => 1
            ];
        }
    }else{
    
    // Redirige vers la page du panier ou une autre page de confirmation si les champs attendus ne sont pas renseignés
    header('Location: panier.php?erreur=Formulaire invalide'); // Redirection vers la page panier.php avec un message d'erreur si le formulaire est invalide
    exit();
    }

}
header( 'Location: index.php'); // Redirige vers la page d'accueil après l'ajout au panier
exit(); // Termine le script pour éviter d'exécuter du code supplémentaire