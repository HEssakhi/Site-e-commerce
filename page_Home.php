
<?php
session_start();
 if (isset($_SESSION['c'])) {
    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
    $cin=$_SESSION['c'];
    foreach($xml->utilisateur as $User) {
  
        if ($cin==$User[0]->idU) {
          $nom=$User[0]->nom." ".$User[0]->prenom;
        }

       }  
}
else {
    $nom="";
   
}

$nb_articles=0;
if(isset($_SESSION['panier']))
    {
      $nb_articles = count($_SESSION['panier']['id']);
 }

 //

 if (isset($_SESSION['cAdmin'])) {
   header('Location:Accueil.php'); 
}

 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
    
   
    <title>Accueil</title>
</head>
<body>
    <div class="header_container">
       <!----header / logo/ text-->
       <div class="the_all_header">
       <header>
          <nav id="navbar">
              <div class="logo_website">
                <a href="page_Home.php"><img src="img/logo.png" alt="" id="logo"></ion-icon></a>
              </div>
              <div class="accueil_elements">
                 <div class="titre_elm">
                      <a href="index1.php?se=homme" class="person">homme</a>
                      <a href="index1.php?se=femme" class="person">femme</a>
                      <a href="index1.php?se=enfant" class="person">enfant</a>
                      <a href="index1.php?se=Produit" id="second_link">Produit</a>
                      
                 </div>

                 <div class="login">
                     
                    <span><?php echo $nom ?></span>
                    <?php
                        if ($nom) {
                           echo '<ion-icon name="person-circle-outline" id="icon_login"></ion-icon>';      
                        }
                        else {
                           echo '<a href="Register.php"><ion-icon name="person-circle-outline" id="icon_login1"></ion-icon></a>';
                        }
                      
                       
                    ?>
                    
                 </div>

              </div>
          </nav>
          
          <div class="options_container">
            <div class="flech"></div>
            <div class="options">
                <a href="Accueil_Cl.php" class="compte"><span>Profile</span></a>
                <a href="logout.php" class="log_out"><span>Déconnexion</span></a>
            </div>
         </div>
       </header>

        <!-----border -->
       <div class="border_line"></div>

       <!----boite de recherche--->
        <div class="boite_recherche">
           <div class="vide"></div>
           <div class="form">
               <form action="">
                 <select  id="category_list" size="1"> 
                 <option selected hidden>Categorie</option>
                     <?php
                      $xml=simplexml_load_file("BDXML/Categories.xml");

                      foreach($xml->Categorie as $Cat) {
                        $id=$Cat[0]->idCat;
                        $nom=$Cat[0]->nomCat;
                        echo "<option value=$id>$nom</option>";
                       }

                     ?>
                <!--    <option selected hidden>Categorie</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Gloves">Gloves</option>
                    <option value="Socks">Socks</option>-->
                 </select>
               <input type="text" name="" id="search_input" placeholder="Rechercher">
               <button type="submit" id="button_recherche"><ion-icon name="search-outline" class="search_icon"></ion-icon></button>
              </form>
           </div>
           <div class="cart">
              
              <a href="page_panier.php"><ion-icon name="cart-outline" id="cart_icon"></ion-icon></a> 
              <span class="product_cmpt"><?php echo $nb_articles;?></span>
           </div>  
       </div>
       </div>
       <div class="background_images">
              <div class="first_pack"></div>
              <div class="second_pack">
                  <div class="second_pack_first"></div>
                  <div class="second_pack_second"></div>
              </div>
       </div>
    </div>

    <!--categorie-->
    <div class="feature_heading">
       <h2>Categories</h2>
    </div>



    
    <ul id="autoWidth" class="cs-hidden">
    <?php
        $xml=simplexml_load_file("BDXML/Categories.xml");
        $i=1;
        foreach($xml->Categorie as $Cat) {
          $id=$Cat[0]->idCat;
          $nom=$Cat[0]->nomCat;
          if ($i>5) {
              break;
          }
          else {
            echo '<li class="item">
            <!--feature box-->
               <div class="feature_box">
                  <a href="#">
                     <img src="img/img'.$i.'.jfif" />
                  </a>
               </div>
               <!----description----->
               <span>'.$nom.'</span>
           </li>';
          }
         $i++;
        }
    ?>
    </ul>
    <!-------------------new arrivage----------------->

    <section class="new_arrivage">
      <!---heading------->
      <div class="arrival_heading">
         <strong>NOUVEAUTÉS</strong>
         <p></p>
      </div>

      <!---------product container-------->
      <ul class="product_container">
          <?php
          
             $xml=simplexml_load_file("BDXML/produits.xml");
             $cat=simplexml_load_file("BDXML/Categories.xml");
             $j=1;
             foreach($xml->produit as $pro) {
               $id=$pro[0]->idPro;
               $prix=$pro[0]->prix;
               $title=$pro[0]->titre;
               $img=$pro[0]->image;

               $c="";
               $idc=$pro[0]->idCat;
               $tab=array();
         
               foreach($cat->Categorie as $Catt) {
                    $tab[]=$Catt[0]->idCat.",".$Catt[0]->nomCat;

                }
                $t=array();
                for ($i=0; $i < count($tab) ; $i++) { 
                    $t=explode(",",$tab[$i]);
                    if($idc==$t[0]){

                        $c=$t[1];
                        break;
                        
                    }    
                }
                if ($j>12) {
                  break;
                 } 
                 else {
                  echo '<div class="product_box">
                  <!-------img------>
                  <div class="product_img">
                      <!------add_cart------>
                   <a href="page_product_details.php?idpro='.$id.'" class="add_cart">
                     <ion-icon name="pricetags-outline"></ion-icon>
                   </a>
      
                     <img src="media/imagePro/'.$img.'" />
                   </div>
                  <!-----details------>
                  <div class="product_details">
                     <span class="p_categorie">'.$c.'</span>
                     <a href="page_product_details.php?idpro='.$id.'" class="p_name">'.$title.'</a>
                     <span class="p_price">'.$prix.'MAD</span>
                  </div>
               </div>';
                 }
                 $j++;

    
            }

          ?>
        
         
      </ul>
    </section>

    <!-----------------nouvelle partie------------------->

    
    <div class = "product-collection">
      <div class = "container_prd">
          <div class = "product-collection-wrapper">
              <!-- product col left -->
              <div class = "product-col-left flex">
                  <div class = "product-col-content">
                      <h2 class = "sm-title">Chaussures de Hommes </h2>
                      <h2 class = "md-title" id="discount">Nouvelle Collection</h2>
                      <button type = "button" class = "btn-dark">Acheter</button>
                  </div>
              </div>

              <!-- product col right -->
              <div class = "product-col-right">
                  <div class = "product-col-r-top flex">
                      <div class = "product-col-content">
                          
                          <h2 class = "md-title">AU-DELÀ DU SPORT</h2>
                          <p class = "text-light">Voici le nouveau drop TIRO21 pour femmes. Passe au niveau supérieur, sur le terrain et en dehors.</p>
                          <button type = "button" class = "btn-dark">Acheter</button>
                      </div>
                  </div>

                  <div class = "product-col-r-bottom">
                      <!-- left -->
                      <div class = "flex">
                          <div class = "product-col-content">
                              <h2 class = "md-title" id="discount">Liquidité de 50%</h2>
                              <button type = "button" class = "btn-dark">Acheter</button>
                          </div>
                      </div>
                      <!-- right -->
                      <div class = "flex">
                          <div class = "product-col-content">
                              <h2 class = "md-title" id="discount">Meilleurs ventes</h2>
                              <button type = "button" class = "btn-dark">Acheter</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-----------------fin nouvelle partie------------->

    <!--------------inscription phase---------->

    <section class="login_redirect">
       <!------titre------>
         <div class="login_redirect_titre">
                <span class="redirect_titre">Inscris-toi pour recevoir nos dernières actus</span>
         </div>

         <!------inscription button------->
         <div class="login_redirect_button">
             <a href="Register.php">
                <button><span class="nom">S-inscrire maintenant</span><ion-icon name="return-up-forward-outline" class="arrow"></ion-icon></button>
             </a>
         </div>
    </section>

    <!------------categorie descriptif-------->
    <section class="cate_descriptif">
       <!------produits------>
       <div class="list list_produits">
           <span class="list_produits title">
              Produits
           </span>
           <div class="produit items">
                <a href="#">Vetements</a>
                <a href="#">Accessoires</a>
                <a href="#">Chaussures</a>
           </div>
       </div>

       <!---------sports---------->
       <div class="list list_sports">
           <span class="list_sports title">
               sports
           </span>
           <div class="sports items">
              <a href="#">Football</a>
              <a href="#">Basketball</a>
              <a href="#">Golf</a>
           </div>
       </div>

       <!-------Assistance---->
       <div class="list assistance">
          <span class="assistance title">
            Assistance
          </span>
          <div class="assistance items">
            <a href="#">aide</a>
            <a href="#">livraison</a>
            <a href="#">retour <span id="exception">et</span>  remboursement</a>
         </div>
       </div>

       <!--------informations d'entreprise------->
       <div class="list nous_propos">
         <span class="nous_propos_2 title">
            Informations d'entreprise
          </span>
          <div class="nous_propos items">
            <a href="#">qui <span id="exception">sommes-nous?</span></a>
            <a href="#">Emploi</a>
            <a href="#">Presse</a>
         </div>
       </div>
    </section>

      <!----------------footer------------------>
    
   <footer>

       <div class="package">
          <!------------logo of the website----->
          <div class="package_logo">
              <img src="img/logo.png" alt="" class="footer_logo">
          </div>

          <!----------the package elements title and links-------->
          <div class="package_elm">
                 <a href="" class="elm_link">Gérer les Données</a>
                 <a href="" class="elm_link">Centre de traitement des données personnelles</a>
                 <a href="" class="elm_link">Cookies</a>
                 <a href="" class="elm_link">Avis de confidentialité</a>
                 <a href="" class="elm_link">Conditions d'utilisation</a>
          </div>
       </div>
   </footer>












    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
      $(document).ready(function(){
             $("#icon_login").click(function(){
             $(".options_container").toggle();
             });
      });
   </script>
</body>
</html>