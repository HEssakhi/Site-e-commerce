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
        <link rel="stylesheet" href="assetsAdmin/css/produits.css">
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="assetsAdmin/js/annonce.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>Produits</title>
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
                        <a href="utilisateurs.php" class="nav__link" title="Utilisateurs">
                            <i class='bx bx-id-card nav__icon' ></i>
                            <span class="nav__text">Utilisateurs</span>
                        </a>
                        <a href="catégories.php" class="nav__link" title="Catégories">
                            <i class='bx bx-dialpad nav__icon' ></i>
                            <span class="nav__text">Catégories</span>
                        </a>
                        <a href="produits.php" class="nav__link   active" title="Produits">
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
        <main>
        
            <div class="container">
                <div class="item_wrap">
                    <div class="item">                                                  
                   <div class="xop-section">
                      <div class="tannonce">
                        <img src="assetsAdmin/images/logo.png" alt="">
                        <div class="border1"></div>
                        <span class="nom">Sport</span>
                      </div>
                      <div class="tips">
                          <p>Dans ce espace vous êtes capable de voir tous les produits existe aussi de les supprimer et les d'ajouter.
                      </div> 
                      <div class="principal">
                        <form action="SupprimerProduit.php"  method="Post">
                           <!-- <label class="container-check" onclick="checkall()" >
                                <input type="checkbox" id="check"  name="suppAll" >
                                <span class="checkmark" ></span>
                            </label>-->
                          <div class="border"></div>
                          <button type="submit" title="Supprimer Tout" name="btn"><i class="bx bx-trash trash"></i></button>
                          <a href="produits.php" title="Actualiser"><i class="bx bx-refresh refresh"></i></a>
                   
                      </div>
                         <ul class="xop-grid">
                 

                 
                   
                   <?php
          
          $xml=simplexml_load_file("BDXML/produits.xml");

          foreach($xml->produit as $pro) {
            $id=$pro[0]->idPro;
            $prix=$pro[0]->prix;
            $stock=$pro[0]->stock;
           // $title=$pro[0]->title;
            $marque=$pro[0]->marque;
            $img=$pro[0]->image;
           
           echo '<li>
           <div class="xop-box xop-img-1">                             
               <a href="page_modifier_product.php?idp='.$id.'">
                   <div class="xop-info">
                        <img src="media/imagePro/'.$img.'" alt="">
                        <div class="infos_prod">
                            <span class="name">Stock</span>
                            <span class="price"><span>'.$stock.'</span> Pieces</span>
                        </div>
                   </div>
               </a>
               <label class="container-check single">
                   <input type="Radio" name="idp" value="'.$id.'">
                   <span class="checkmark1"></span>
               </label>
          </div>
      </li>';
              
         }

       ?> 
                    
                       </ul>
        </form>
          
       
             
                       <!---------border----------->
                       <div class="border_vide"></div>
                       <!-------ajouter produit------->
                       <div class="ajouter_produit">
                          <a href="Ajouter_produit.php"> <p><ion-icon name="add-outline" class="add"></ion-icon><span>Ajouter un nouveau produit </span></p></a>
                       </div>
                       
                   </div>
                    </div>
                </div>
            </div>

        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsAdmin/js/main.js"></script>
    <script  src="js/script.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
        $(document).ready(function(){
            $(".ajouter_produit").click(function(){
            $(".formulaire").slideToggle("slow");
            });
        });
    </script>   
</html>