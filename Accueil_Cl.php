<?php
session_start();
 if (isset($_SESSION['c'])) {
    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
    $cin=$_SESSION['c'];
    foreach($xml->utilisateur as $User) {
  
        if ($cin==$User[0]->idU) {
          $nom=$User[0]->nom." ".$User[0]->prenom;
          $image=$User[0]->image;
        }

       }  
}
else {
   header('Location:page_Home.php');
   $nom="";
}

if (isset($_SESSION['cAdmin'])) {
    header('Location:Accueil.php'); 
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsClient/css/styles&accueil.css">
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <title>Client</title>
    </head>
    <body id="body">
         


        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                   
                    <a href="page_Home.php" class="nav__logo">
                       
                        <img src="assetsClient/images/logo.png" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Sport</span>
                    </a>
    
                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-right'></i>
                    </div>
    
                    <ul class="nav__list">
                        <a href="Accueil_Cl.php" class="nav__link active" title="Accueil">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Accueil</span>
                        </a>
                        <a href="commandes_Cl.php" class="nav__link" title="Commandes">
                            <i class='bx bx-dialpad nav__icon' ></i>
                            <span class="nav__text">Commandes</span>
                        </a>  
                        
                        <a href="edit_infos_client.php" class="nav__link" title="Modifier informations">
                            <i class='bx bx-notepad nav__icon' ></i>
                            <span class="nav__text">Êdit infos</span>
                        </a>
                    </ul>
                </div>
                <a href="logout.php" class="nav__link" id="nav-link-close">           
                    <i class='bx bx-log-out-circle nav__icon'></i>
                    <span class="nav__text">Déconnexion</span>
                </a>
            </nav>
        </div>
        <main>
            <section class="first">
                
                        <?php
                                if ($image=="null") {
                                    echo '<img src="assetsClient/images/profile.jpg">';
                                }
                                else {
                                    echo '<img src="media/imageU/'.$image.'">';
                                }

                        ?>

              <h2 id="text-body" ><?php echo $nom; ?></h2>  
              <p id="titre">
                Dans cette espace, vous étes capable de gérer votre compte Sport Store, votre commandes aussi votre panier.
             </p>
             <div class="img-body"></div>
             <div class="notify">
                <p id="notify-titre">
                    Vous seul pouvez voir votre activité. Nous vous recommandons de vérifier également vos
                    paramètres, la recherche ou tout autre service Sport store que vous utilisez régulièrement.
                    Sport store protège la confidentialité et la sécurité de vos données.
                </p> 
                <img src="assetsClient/images/img3.png" id="notify-img">
             </div>
             
            </section>
           
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsClient/js/main.js"></script>
</html>