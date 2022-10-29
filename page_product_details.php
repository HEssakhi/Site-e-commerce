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

 if (isset($_SESSION['cAdmin'])) {
  header('Location:Accueil.php'); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!----ce lien est utilisé pour réferencier le nav design-->
    <link rel="stylesheet" href="css/home.css">
    <!------ce lien est utilisé pour referencier le design de product page---------->
    <link rel="stylesheet" href="css/product_details.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    
</head>
<body>
    
    <!-------header_phase------>
<div class="header_container">
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
</div>

    <!-------retour au page precedente-------->
    <div class="retour">
           <a href="page_Home.php" class="retour_link">
               <button><ion-icon name="return-up-back-outline" class="arrow"></ion-icon></ion-icon><span class="nom">Accueil</span></button>
           </a>
    </div>

    <!-----product image and details----->
    <div class="container">
        <!------imgaes slides------>
        <?php
          $idpro=$_GET['idpro'];
          $xml=simplexml_load_file("BDXML/produits.xml");
         // $cat=simplexml_load_file("BDXML/categories/Categories.xml");
          //$i=1;
          foreach($xml->produit as $pro) {
            $id=$pro[0]->idPro;
            if ($id==$idpro) {
                $prix=$pro[0]->prix;
                $title=$pro[0]->titre;
                $img=$pro[0]->image;
                $marque=$pro[0]->marque;
                $sexe=$pro[0]->sexe;
                $stock=$pro[0]->stock;
                $t=array();
                for ($i=0; $i < $pro[0]->count()-8; $i++) { 
                    $t[]=$pro[0]->taille[$i];
                }     
            }
        }
            

        ?>
        <div class="card">
            <div class="images">
                <div class="slider"><img id="big-image" src="media/imagePro/<?php echo $img ?>" alt=""></div>
                <div id="img-slider" class="img-slider">
                    <div class="imgs"><img id="img1" src="media/imagePro/<?php echo $img ?>" alt=""></div>
                  <!--  <div class="imgs"><img id="img2" src="BDXML/produits/image/<?php echo $img ?>" alt=""></div>
                    <div class="imgs"><img id="img3" src="BDXML/produits/image/<?php echo $img ?>" alt=""></div>
                    <div class="imgs"><img id="img4" src="BDXML/produits/image/<?php echo $img ?>" alt=""></div>-->
                </div>
            </div>
        </div>
       <!------product_informations----->
       <div class="infos_container">
           <div class="prodcut_title"><span><?php echo $title."-".$marque." ".$sexe ?></span></div>
           <div class="prodcut_price"><span><?php echo $prix ?> MAD</span></div>
           <div class="border_taille"></div>

           <!------------la taille--------->
           <div class="prodcut_taille">
               <span>Taille :</span>
               <div class="taille_grid">
               <form action="page_product_details.php?idpro=<?php echo $idpro; ?>" method="POST">
               <select  id="category_list"  name="taille"> 
                     
                     <option selected hidden value="null">Choisissez</option>
                
                   <?php
                         
                         for ($i=0; $i < count($t); $i++) { 
                            $val=$t[$i];
                         
                            echo "<option value=$val>$val</option>";
                            
                         }
              
                   ?>

                       
                </select>  
                

               </div>
           </div>

           <!-------------quantite----------->
         <div class="prodcut_quantite">
               <span>Quantite :</span>
            <div class="quantite_input">
                 <input type="number" name="qte" id="qte_input" min="0" max="<?php echo $stock; ?>">
            </div>
         </div>

          <!------ajouter au panier button----->
          <div class="_links">
            <div class="command_button">
              <div class="add_to_command">
              <button type="submit" name="btn"><span class="command_titre">Ajouter au panier</span><ion-icon name="return-up-forward-outline" class="arrow"></ion-icon></button>
              </form>
              </div>
            </div>
             
          </div>
       </div>
    </div>
     <?php
        if (isset($_POST["btn"])) {
          
         

           if(!isset($_SESSION['panier']))
            {
             /* Initialisation du panier */
             $_SESSION['panier'] = array();
             /* Subdivision du panier */
             $_SESSION['panier']['id'] = array();
             $_SESSION['panier']['qte'] = array();
             $_SESSION['panier']['taille'] = array();
             $_SESSION['panier']['prix'] = array();
            }
              
            function verif_panier($ref_article,$taille)
            {
                /* On initialise la variable de retour */
                $present = false;
              

                /* On vérifie les numéros de références des articles et on compare avec l'article à vérifier */
                if( count($_SESSION['panier']['id']) > 0 && array_search($ref_article,$_SESSION['panier']['id']) !== false)
                {
                  $nb_articles = count($_SESSION['panier']['id']);
       
                  for($i = 0; $i < $nb_articles; $i++)
                     {
                       if ($_SESSION['panier']['id'][$i]==$ref_article) {
                          $t=$_SESSION['panier']['taille'][$i];break;
                       }
                     }

                     if ($taille!=$t) {
                      $present = false;
                     }
                     else {
                      $present = true;
                     }
                    
                }
              
                return $present;
            } 
               
            if(!empty($_POST["qte"]) && $_POST["taille"]!="null")
            {

          

               if (!verif_panier($idpro,$_POST["taille"])) {
                 

                if ($_POST["qte"]>0 && $_POST["qte"]<=$stock) {

                foreach($xml->produit as $pro) {
                  $id=$pro[0]->idPro;
                  if ($id==$idpro) {
                      $p=0+$pro[0]->prix;
                  }
                }
                 array_push($_SESSION['panier']['id'],$idpro);
                 array_push($_SESSION['panier']['qte'],$_POST["qte"]);
                 array_push($_SESSION['panier']['taille'],$_POST["taille"]);
                 array_push($_SESSION['panier']['prix'],$p);
                 header("Refresh:0; url=page_product_details.php");  
                 //echo '<script type="text/javascript">window.location.reload();</script>';
                 echo("<meta http-equiv='refresh' content='0'>");
                }
                 else {
                  echo '<script type="text/javascript">
                  swal({
                        title:"la Quantité pas Valide",
                        text:"Vous avez cliqué sur le bouton!",
                        icon:"error"
                            });
                  </script>'; 
                }

               }
               else {

               // $nb_articles = count($_SESSION['panier']['id']);
    
               // $ajoute = false;
                 
                for($i = 0; $i < $nb_articles; $i++)
                {
                    if($_SESSION['panier']['id'][$i]==$idpro && $_SESSION['panier']['taille'][$i]==$_POST["taille"])
                    {
                        $_SESSION['panier']['qte'][$i] =$_SESSION['panier']['qte'][$i] + $_POST["qte"];
                        
                    }
                }
                //+qte
                /*echo '<script type="text/javascript">
                swal({
                      title:"le Produit déjà exist dans le panier",
                      text:"Vous avez cliqué sur le bouton!",
                      icon:"error"
                          });
                </script>';*/


               }
                  
              
             

              
           }//verifier
            else {
              echo '<script type="text/javascript">
              swal({
                    title:"Entre la Quantité et la Taille",
                    text:"Vous avez cliqué sur le bouton!",
                    icon:"error"
                        });
              </script>';
             
            }



       }             


     ?>

      <!----------commentaire--------->


    <div class="comment_container">
      <div class="first_title">
        <strong>Commentaire</strong>
      </div>
      
      <div class="comment_list">
      <?php if (isset($_SESSION['c'])) {   ?>
        <div class="second_title">
          <span>Ecrire votre point de vue</span>
        </div>
        <div class="write_comment">
          <form action="page_product_details.php?idpro=<?php echo $idpro ?>" method="Post" id="comment_form">
            
             <input type="text" name="comment_content" id="comment_content" placeholder="votre commentaire ici">
             <input type="hidden" name="idU" id="idU" value="<?php echo $cin;  ?>" />
             <input type="hidden" name="idpro" id="idpro" value="<?php echo $idpro;  ?>" />
             <button type="submit" name="submit" id="submit">Envoyer</button>
            
          </form>
        </div>
        <?php  } ?>

       
        

        

        <!-----les commentaires---->
        
        <div id="display_comment"></div>
        <!------fin des commentaires-->
      </div>
    </div>

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
            <div class="product items">
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
    <script src="js/app.js"></script>
    <script>
      $(document).ready(function(){
             $("#icon_login").click(function(){
             $(".options_container").toggle();
             });
      });
   </script>
</body>
</html>
<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
    // $('#comment_message').html(data.error);
     $('#idpro').val('<?php echo $idpro ?>');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:'idpro=' + <?php echo $idpro ?>,
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

});
</script>