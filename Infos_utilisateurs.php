<?php
session_start();
if (isset($_SESSION['cAdmin'])) {
   $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $idUser=$_GET['idUser'];
   
}
else {
  header('Location:page_Home.php');
  //$nom="";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsAdmin/css/styles&accueil.css"> 
        <link rel="stylesheet" href="assetsAdmin/css/infos_utilisateurs.css"> 
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
                    <a href="Accueil.php" class="nav__link" title="Accueil">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Accueil</span>
                        </a>
                        <a href="utilisateurs.php" class="nav__link active" title="Utilisateurs">
                            <i class='bx bx-id-card nav__icon' ></i>
                            <span class="nav__text">Utilisateurs</span>
                        </a>
                        <a href="catégories.php" class="nav__link" title="Catégories">
                            <i class='bx bx-dialpad nav__icon' ></i>
                            <span class="nav__text">Catégories</span>
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
                            <span class="nav__text">Êdit infos</span>
                        </a>    
                        <a href="liste_livraison.php" class="nav__link">
                            <i class='bx bx-package nav__icon' ></i>
                            <span class="nav__text">Commandes livre</span>
                        </a>              
                    </ul>
                </div>
                <a href="logout.php" class="nav__link" id="nav-link-close">           
                    <i class='bx bx-log-out-circle nav__icon'></i>
                    <span class="nav__text">Déconnexion</span>
                </a>
            </nav>
        </div>

        <?php

            foreach($xml->utilisateur as $User) {
 
                if ($idUser==$User[0]->idU) {
                    
                  $nom=$User[0]->nom." ".$User[0]->prenom;
                  $sexe=$User[0]->sexe;
                  $gmail=$User[0]->gmail;
                  $tele=$User[0]->tele;
                  $image=$User[0]->image;
                  $fonction=$User[0]->fonction;
 
                }
         
            } 



        ?>
        <main>
            <section class="infos">
              <h2 id="infos-text" >Informations personnelles</h2>  
              <p id="titre">
                Informations de base utilisées sur les services Sport Store (nom, photo, etc.)
             </p>
             <div class="infos-container">
                 <h3>Profil</h3>

                  <div class="profil-img">
                       <div class="qws">photo</div>
                       <div class="anwser" >Personnalisez votre compte en ajoutant une photo</div>
                      <div class="photo">
                        <?php
                                  if ($image=="null") {
                                      echo '<img src="assets/images/profile.jpg"  alt="">';
                                  }
                                  else {
                                       echo '<img src="media/imageU/'.$image.'"  alt="">';
                                  }

                        ?>
                         
                
                      </div> 

                  </div>
                 
                  <div class="profil-infos">
                    <div class="qws">nom</div>
                     <div class="answer" id="nom"><?php echo $nom; ?></div>
                  </div>
                  <div class="profil-infos">
                    <div class="qws">SEXE</div>
                     <div class="answer" id="sexe"><?php echo $sexe; ?></div>
                  </div>
                  <div class="profil-infos">
                    <div class="qws">rôle</div>
                     <div class="answer" id="pass"><?php echo $fonction; ?></div>
                  </div>
             </div>

            <div class="infos-container">
                <h3>Coordonnées</h3>  
                <div class="profil-infos">
                    <div class="qws">ADRESSES E-MAIL</div>
                     <div class="answer" id="email"><?php echo $gmail; ?></div>
                </div>
                <div class="profil-infos">
                    <div class="qws">Téléphone</div>
                     <div class="answer" id="tel"><?php echo $tele; ?></div>
                </div>
            </div>  
            </section>
           
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsAdmin/js/main.js"></script>
</html>