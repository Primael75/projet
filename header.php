<!--header.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maelfleur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
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
                <a href="#" class="text-dark"><i class="fa-solid fa-user"></i></a>
                <a href="#" class="text-dark"><i class="fa-solid fa-truck"></i></a>
                <a href="panier.php" class="text-dark position-relative"><i class="fa-solid fa-shopping-cart fs-5"></i>
                <span class="position-absolute top-70
                 start-100 translate-middle-x badge rounded-pill bg-danger">2</span>
                </a>
             </div>
               <!--logo au centre-->
            <a href="#" class="position-absolute start-50 top-50" style="transform: translate(-55%, -50%); height: 100%;">
                <img src="logo\logo.jpg" alt="Logo" class="rounded-circle" style="height:80px;">
            </a>
        </div>
    </div>
    
</body>
</html>