<?php
session_start();
if (isset($_SESSION['cAdmin'])) {
   $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $cin=$_SESSION['cAdmin'];
   foreach($xml->utilisateur as $User) {
 
       if ($cin==$User[0]->idU) {
         $nom=$User[0]->nom." ".$User[0]->prenom;
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
        <link rel="stylesheet" href="assetsClient/css/utilisateurs.css"> 
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="assetsAdmin/js/liste reservation.js"></script>
        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <title>Commandes</title>
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
                    <a href="Accueil.php" class="nav__link" title="Accueil">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Accueil</span>
                        </a>
                        <a href="utilisateurs.php" class="nav__link" title="Utilisateurs">
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
                        <a href="commandes.php" class="nav__link active" title="Commandes">
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
        <main>
           <section class="container">
                   <div class="container-wrap">
                       <div class="reservation-text">
                           <div class="logo-name">
                                <img src="assetsClient/images/logo.png">
                                <div class="border"></div>
                                <span class="site-nom">Sport</span>
                           </div>
                           <div class="tips">
                            <p>Dans cet espace vous êtes capable de voir et consulter tout les commandes que vous avez éffectuer.</p>
                           </div>
                       </div>
                       <div class="principal">
                           <div class="barre-test">
                           
                              <a href="commandes.php" title="Actualiser"><i class="bx bx-refresh refresh"></i></a>
                              <div class="barre-border"></div>
                               <!-- <a href="#" title="Chercher" ><i class="bx bx-search-alt search" id="search"></i></a>
                                 <div class="chercher">
                                     <form action="" method="Post" >
                                     <button type="submit" title="Chercher" name="btn"><i class="bx bx-search-alt-2"></i></button>
                                      <input type="date" name="dt">
                                     </form>    
                                  </div>-->
                                 <a href="#" title="Annuler" id="close"><i class="bx bx-plus close"></i></a>
                           </div> 

                        <div class="commandes_cont">  
                           
                        <?php
                                   
                             
                                  

                                   $xml=simplexml_load_file("BDXML/commandes.xml");
                                   
                                   
                                   $u=simplexml_load_file("BDXML/Utilisateurs.xml");
                                   $p=simplexml_load_file("BDXML/produits.xml");
                                   //user
                                   $tab=array();
                                   foreach($u->utilisateur as $User) {

                                        $tab[]=$User[0]->idU.",".$User[0]->nom." ".$User[0]->prenom;
                                      
                                    }
                                    //produit
                                    $tab1=array();
                                    foreach($p->produit as $pro) {

                                        $tab1[]=$pro[0]->idPro.",".$pro[0]->prix;
                                      
                                    }


                                 
                                   foreach($xml->commande as $cmd) {
                                       $montant=0;
                                       $num=$cmd->NumCmd;
                                       $date=$cmd->dateCmd;
                                       $etat=$cmd->etat;
                                       $cin=$cmd->idU;
                                       $pr=$cmd->Pro;
                                       


                                       $t=array();
                                       $nom="";
                                       for ($i=0; $i < count($tab); $i++) { 
                                           $t=explode(",",$tab[$i]);
                                           if ($t[0]==$cin) {
                                               $nom=$t[1];
                                               break;
                                           }
                                       }
                                      //pro
                                       $t1=array();
                                       
                                      foreach($pr as $prod) {
                                          $idpro=$prod->idPro;
                                          $qte=$prod->qte;

                                       for ($i=0; $i < count($tab1); $i++) { 
                                           $t1=explode(",",$tab1[$i]);
                                           if ($t1[0]==$idpro) {
                                               $montant+=$t1[1]*$qte;
                                               
                                           }
                                       }
                                    }


                                      
                                    echo ' <div class="list">
                                    <div class="list-item">
                                     <a href="page_valider_commande.php?idcmd='.$num.'">
                                         <div class="items">
                                             <div class="name"><span>'.$nom.'</span></div>
                                             <div class="profession">Date commande:<span> '.$date.'</span></div>
                                             <div class="personne-sexe sexe">Etat de commande:<span> '.$etat.'</span></div>
                                         </div>
                                     </a>
                                   </div>                     
                                </div>';


                                      $nom="";
                                    

                                   }


                               ?>

                          


                       

                        </div> 
                       </div>
                       
                   </div>
            </section>

             <!------------------in case if there is no records-----------------
             <div class="container-vide">
                <div class="image">
                    <p>
                        <span>Désolé ! aucun reservation effectués existe pour le moment.</span>   <br>
                        Déposez votre annonce gratuitement sur Inhouse aujourd'hui 
                    </p>
                </div>
             
            </div>-->
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsClient/js/main.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="assetsClient/js/annonce.js"></script>

    <!--------------script de formulaire----------->
    <script>
        $(document).ready(function(){
            $(".ajouter_user").click(function(){
            $(".formulaire").slideToggle("slow");
            });
        });
</script>
</html>