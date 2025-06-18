
     <!-- Barre de navigation -->
     <div class="bg-green-sauge py-2 border-bottom " style ="height: 80px; position: relative;">
        <div class="container h-100 d-flex align-items-center justify-content-between flex-wrap">
            <!-- Liens à gauche -->

            <div>
                <a href="#" class="text-dark me-3">Questions fréquentes</a>
                <a href="#" class="text-dark me-3">Entreprises</a>
                <a href="#" class="text-dark me-3">Contacts</a> 
            
            </div>
          
            <!-- Icônes centreées -->
             <div class="d-flex gap-3">
                <a href="register.php" class="text-dark"><i class="fa-solid fa-user"></i></a>
                <a href="#" class="text-dark"><i class="fa-solid fa-truck"></i></a>
             

                <a  href="panier.php" class="text-dark position-relative">
                <i class="fa-solid fa-shopping-cart fs-5"></i>
                <?php 
                        // Afficher le nombre d'articles dans le panier
                        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {

                            $nb_articles = 0;
                            foreach ($_SESSION['panier'] as $article) {
                                if (isset($article['quantite'])) {
                                    $nb_articles += $article['quantite'];
                                }
                            }
                            ?>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $nb_articles; ?>
                                            </span>

                            <?php

                        } 
                    ?>
                
                </a>
             </div>
               <!--logo au centre-->
            <a href="#" class="position-absolute start-50 top-50" style="transform: translate(-55%, -50%); height: 100%;">
                <img src="logo\logo.jpg" alt="Logo" class="rounded-circle" style="height:80px;">
            </a>
        </div>
    </div> 

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
                        <li><a class="dropdown-item " href="occasions.php?id=anniv">Anniversaire</a></li>
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