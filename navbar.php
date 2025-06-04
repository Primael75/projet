<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maelfleur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="bg-light " style ="height: 50px; position: relative;">
        <div class="container h-100">
            <div class="d-flex align-items-center h-100">
                <div class="flex-fill text-center"><a href="index.php" class= "text-dark">Accueil</a></div>
                <div class="flex-fill text-center"><a href="livraison_express.php" class= "text-dark">Livraison express</a></div>
                <!--Menu déroulant occasions-->
                <div class="dropdown flex-fill text-center">
                    <a class="text-dark dropdown-toggle text-decoration-none" href="#" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
                        Occasions
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item " href="anniversaire.php">Anniversaire</a></li>
                        <li><a class="dropdown-item " href="mariage.php">Mariage</a></li>
                        <li><a class="dropdown-item " href="naissance.php">Naissance</a></li>
                        <li><a class="dropdown-item " href="fete_des_meres.php">Fête des mères</a></li>
                        <li><a class="dropdown-item " href="fete_pere.php">Fête des pères</a></li>
                    </ul>
                </div>
            

                <div class="flex-fill text-center"><a href="petits_prix.php" class="text-dark"> Petits prix</a></div>
                <div class="flex-fill text-center"><a href="deuil.php" class="text-dark"> Deuil</a></div>
                <div class="dropdown flex-fill text-center">
                    <a class="text-dark dropdown-toggle text-decoration-none" href="#" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
                       Bouquets
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item " href="rose_classique.php">Roses classiques</a></li>
                        <li><a class="dropdown-item " href="rose_spéciales.php">Roses spéciales</a></li>
                        <li><a class="dropdown-item " href="bouquets_automne.php">Automnes</a></li>
                        <li><a class="dropdown-item " href="deuil.php">Deuil</a></li>
                    </ul>
                </div>
                <div class="flex-fill text-center"><a href="#" class="text-dark">Cadeaux</a></div> 
            </div>
        </div>
    </div>
    <!--Boostrap JS(nécéssaire pour le dropdown menu) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>