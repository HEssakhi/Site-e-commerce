<?php
session_start();
 if (isset($_SESSION['cAdmin'])) {
    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
    $cin=$_SESSION['cAdmin'];
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsAdmin/css/styles&accueil.css">
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <title>Administrateur</title>
    </head>
    <body id="body">
         


        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                   
                    <a href="Accueil.php" class="nav__logo">
                       
                        <img src="assetsAdmin/images/logo.png" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Sport</span>
                    </a>
    
                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-right'></i>
                    </div>
    
                    <ul class="nav__list">
                        <a href="Accueil.php" class="nav__link active" title="Accueil">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Accueil</span>
                        </a>
                        <a href="utilisateurs.php" class="nav__link" title="Utilisateurs">
                            <i class='bx bx-id-card nav__icon' ></i>
                            <span class="nav__text">Utilisateurs</span>
                        </a>
                        <a href="cat??gories.php" class="nav__link" title="Cat??gories">
                            <i class='bx bx-dialpad nav__icon' ></i>
                            <span class="nav__text">Cat??gories</span>
                        </a>
                        <a href="produits.php" class="nav__link" title="Produits">
                            <i class='bx bx-poll nav__icon'></i>
                            <span class="nav__text">Produits</span>
                        </a> 
                        <a href="commandes.php" class="nav__link" title="Commandes">
                            <i class='bx bx-cart nav__icon' ></i>
                            <span class="nav__text">Commandes</span>
                        </a>  
                        
                        <a href="edit_infos_admin.php" class="nav__link">
                            <i class='bx bx-notepad nav__icon' ></i>
                            <span class="nav__text">??dit infos</span>
                        </a>   
                        <a href="liste_livraison.php" class="nav__link">
                            <i class='bx bx-package nav__icon' ></i>
                            <span class="nav__text">Commandes livre</span>
                        </a>           
                    </ul>
                </div>
                <a href="logout.php" class="nav__link" id="nav-link-close">           
                    <i class='bx bx-log-out-circle nav__icon'></i>
                    <span class="nav__text">D??connexion</span>
                </a>
            </nav>
        </div>
        <main>
            <section class="first">
      
                      <?php
                                if ($image=="null") {
                                    echo '<img src="assetsAdmin/images/profile.jpg">';
                                }
                                else {
                                    echo '<img src="media/imageU/'.$image.'">';
                                }

                        ?>


              

              <h2 id="text-body" ><?php echo $nom; ?></h2>  
              <p id="titre">
                  G??rez les utilisateurs, produits aussi les cat??gories, ainsi que la confidentialit?? et la s??curit?? de vos
                  donn??es pour profiter au mieux des services Sport Store
             </p>
             <div class="img-body"></div>
             <div class="notify">
                <p id="notify-titre">
                    Vous seul pouvez voir votre activit??. Nous vous recommandons de v??rifier ??galement vos
                    param??tres, la recherche ou tout autre service Sport store que vous utilisez r??guli??rement.
                    Sport store prot??ge la confidentialit?? et la s??curit?? de vos donn??es.
                </p> 
                <img src="assetsAdmin/images/img3.png" id="notify-img">
             </div>
             
            </section>
           
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsAdmin/js/main.js"></script>
</html>