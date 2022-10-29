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
    <title>Géstion panier</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/page_panier.css">
    <link rel="stylesheet" href="css/validate_order.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
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
        </div>
    </div>

    <!-----------listes des commandes--------->
    <section class="liste_orders">
        <?php
        if(isset($_SESSION['panier']))
            {  
              $nb_articles = count($_SESSION['panier']['id']);
               if ($nb_articles>0) {
        ?>
    
        <div class="orders_container">
        <?php
                 
                 $montant=0;
          
                      # code...
                 
                 
                 for($i = 0; $i < $nb_articles; $i++)
                    {
                       $id=$_SESSION['panier']['id'][$i];
                       $qte=$_SESSION['panier']['qte'][$i];
                       $ta=$_SESSION['panier']['taille'][$i];
                       $prix=$_SESSION['panier']['prix'][$i];
                       $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];

                       $xml=simplexml_load_file("BDXML/produits.xml");

                       foreach($xml->produit as $pro) {
                        $idpro=$pro[0]->idPro;
                        if ($id==$idpro) {
                            $title=$pro[0]->titre;
                            $img=$pro[0]->image;

                            $t=array();
                            for ($j=0; $j < $pro[0]->count()-8; $j++) { 
                                $t[]=$pro[0]->taille[$j];
                            } 
                        }

                       }
            
        
          ?>      
            
        <div class="description">
            <div class="product-img">
                <img src="media/imagePro/<?php echo $img ?>" alt="">
            </div>
            <div class="product-details">
                <form action="MisAjourPanier.php" method="POST">
                <div class="nom_product">
                    <span><?php  echo $title;  ?></span>
                </div>
                <div class="price">
                    <span>Prix : <span><?php  echo $prix;  ?> MAD</span></span>
                </div>
                <div class="taille_container">
                    <div class="size_defined">
                      <span id="size_span">Taille : <span></span></span>  
                    </div>
                        
                        <select name="taille" id="taille_mod" name="taille">
                             
                        <?php
                         
                         for ($c=0; $c< count($t); $c++) { 
                            $val=$t[$c];
                            if ($ta==$val) {
                                echo "<option selected value=$val>$val</option>";
                            }
                            else {
                                echo "<option value=$val>$val</option>";
                            }
                            
                            
                         }
              
                   ?>
                           
                        </select>
                </div>
                <div class="quantite">
                    <div class="quantite_defined">
                        <span id="all">Quantité : <span></span></span>
                    </div>
                    <div class="quantite_change">
                        <?php
                            $xml=simplexml_load_file("BDXML/produits.xml");

                            foreach($xml->produit as $pro) {
                                $idpro=$pro[0]->idPro;
                                if ($id==$idpro) {
                                    $stock=$pro[0]->stock;
                                }
                            }
                        ?>
                        <input type="number" value="<?php  echo $qte;  ?>" name="qte" id="qte" max="<?php  echo $stock;  ?>">
                        <input type="hidden" value="<?php  echo $id;  ?>" name="id" >
                        <input type="hidden" value="<?php  echo $ta;  ?>" name="ta" >
                        <input type="hidden" value="<?php  echo $qte;  ?>" name="qt" >
                    </div>
                </div>
            </div>
            <div class="retirer_valider">
                  <div class="retirer">
                            <button type="submit" name="retirer"><ion-icon name="trash-outline" class="trash"></ion-icon><span class="supp">Retirer</span></button>
                  </div>
                  <div class="ajouter">
                            <button type="submit" name="modifie"><ion-icon name="checkmark-outline" class="check"></ion-icon><span class="val">Modifier</span></button>
                  </div>
                </form>
            </div>
        </div>
        <?php
                 }   
                
        ?>
        <!--------------------->
        </div>
        
        <div class="border_orders"></div>

        <div class="validate_all_total">
            <div class="validate_all">
              
                  
                <form action="MisAjourPanier.php" method="post">
                    <a href="infos_liv.php"> <button type="button">Commander</button></a>
                    <button type="submit" name="supprimer" id="supprimer">Vider</button>
                </form>
            </div>
            <div class="total_all_price">
                <span id="max">Total :<span> <?php echo  $montant; ?> MAD</span></span>
            </div>
        </div>
        
    
    <?php
        }
       
     }
     else{

        echo '<div class="panier_vide">
        <img src="img/cart_vide.png" alt="">
        <a href="page_Home.php"><span>Ajouter au panier</span><ion-icon name="arrow-redo-outline" class="arrow"></ion-icon></a> 
      </div>';

    }
    ?>
              
  </section>

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