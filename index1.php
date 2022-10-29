
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

$se=$_GET["se"];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produit</title>

<link rel="stylesheet" href="css/home.css">

<link rel="stylesheet" href="css/page_homme.css">

<link rel="stylesheet" href="css/pagination_product.css">



<!--Jquery-->
<script type="text/javascript" src="js/JQuery3.3.1.js"></script>

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

<!-----------barre de recherche---------->

<section class="search_section">
	<div class="barre_container">
		  <div class="serch_homme_text">
			  <span id="bienvenue">Bienvenue Chez nous Clients</span>
			  <span id="personne_sexe"><span><?php if ($se=="Produit") { echo "Touts ".$se."s"; } else {echo $se;} ?></span></span>
		  </div>
			  <!----boite de recherche--->
	  <div class="boite_recherche">
		<div class="form">
			<form action="index1.php?se=<?php echo $se ?>" method="POST">
			  <select  id="category_list" size="1" name="cate"> 
				 <option selected hidden value="null">Categorie</option>
                 <?php
                      $xml=simplexml_load_file("BDXML/Categories.xml");

                      foreach($xml->Categorie as $Cat) {
                        $id=$Cat[0]->idCat;
                        $nom=$Cat[0]->nomCat;
                        echo "<option value=$id>$nom</option>";
                       }

                     ?>
			<!--	 <option value="Shoes">Shoes</option>
				 <option value="Gloves">Gloves</option>
				 <option value="Socks">Socks</option>-->
			  </select>
			<input type="text"  id="search_input" placeholder="Entre Marque" name="marque">
			<button type="submit" id="button_recherche" name="btn"><ion-icon name="search-outline" class="search_icon"></ion-icon></button>
		</div> 
        <div class="search_by_price">
            <input type="number" name="min" id="max_price" placeholder="Prix min" min="0">
            <input type="number" name="max" id="min_price" placeholder="Prix max" min="0">
          </form>
        </div>
	  </div>
   </div>
</section>

<!------------le nombre des resultats----------->
<section class="number_result">
        <?php
         //compteur nomer pro
         $cmp=0; 
         $xml=simplexml_load_file("BDXML/produits.xml");
            if ($se!="Produit") {

                foreach($xml->produit as $pro) {
                 if ($pro[0]->sexe==$se) {
                    if (isset($_POST["btn"])) {
                        //chaque filter 
                        if (isset($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                            
                               $mar=$_POST["marque"];
                                if (strtolower($pro[0]->marque)==strtolower($mar)) { 
                                   
                                    $cmp++;
                             
                                } 
                         }
                         if ($_POST["cate"]!="null" && empty($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"])) {
                            
                            $cate=$_POST["cate"];
                             if ($pro[0]->idCat==$cate) {
                                $cmp++;
                             } 
                         }
                         if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                            
                            $min=$_POST["min"];
                            $max=$_POST["max"];
                            $pr=$pro[0]->prix;
                             if ($pr>=$min && $pr<=$max) {
                                $cmp++;
                             } 
                         }
                         //deux filter
                         if (isset($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                            
                            $min=$_POST["min"];
                            $max=$_POST["max"];
                            $mar=$_POST["marque"];
                            $pr=$pro[0]->prix;
                             if ($pr>=$min && $pr<=$max && strtolower($pro[0]->marque)==strtolower($mar)) {
                                $cmp++;
                             } 
                         }
                         if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]!="null") {
                            
                            $min=$_POST["min"];
                            $max=$_POST["max"];
                            $cate=$_POST["cate"];
                            $pr=$pro[0]->prix;
                             if ($pr>=$min && $pr<=$max && $pro[0]->idCat==$cate) {
                                $cmp++;
                             } 
                         }
                         if(isset($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]!="null") {
                            
                           
                            $mar=$_POST["marque"];
                            $cate=$_POST["cate"];
                            
                             if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate) {  
                                $cmp++;
                             } 
                         }
                         //trois
                         if(!empty($_POST["marque"]) &&  !empty($_POST["min"]) && !empty($_POST["max"]) && $_POST["cate"]!="null") {
                            
                            $min=$_POST["min"];
                            $max=$_POST["max"];
                            $mar=$_POST["marque"];
                            $cate=$_POST["cate"];
                            $pr=$pro[0]->prix;
                             if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate && $pr>=$min && $pr<=$max) {  
                                $cmp++;
                             } 
                         }
                         if(empty($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                            
                            $cmp++;
                        
                         }
    
    
                   
                    }
                    else
                    {
                        $cmp++;
                    }
                  
                } //sexe 
               
              }//for
            }//pas produit

            else {
                foreach($xml->produit as $pro) {
                   
                       if (isset($_POST["btn"])) {
                           //chaque filter 
                           if (isset($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                               
                                  $mar=$_POST["marque"];
                                   if (strtolower($pro[0]->marque)==strtolower($mar)) { 
                                      
                                       $cmp++;
                                
                                   } 
                            }
                            if ($_POST["cate"]!="null" && empty($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"])) {
                               
                               $cate=$_POST["cate"];
                                if ($pro[0]->idCat==$cate) {
                                   $cmp++;
                                } 
                            }
                            if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                               
                               $min=$_POST["min"];
                               $max=$_POST["max"];
                               $pr=$pro[0]->prix;
                                if ($pr>=$min && $pr<=$max) {
                                   $cmp++;
                                } 
                            }
                            //deux filter
                            if (isset($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                               
                               $min=$_POST["min"];
                               $max=$_POST["max"];
                               $mar=$_POST["marque"];
                               $pr=$pro[0]->prix;
                                if ($pr>=$min && $pr<=$max && strtolower($pro[0]->marque)==strtolower($mar)) {
                                   $cmp++;
                                } 
                            }
                            if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]!="null") {
                               
                               $min=$_POST["min"];
                               $max=$_POST["max"];
                               $cate=$_POST["cate"];
                               $pr=$pro[0]->prix;
                                if ($pr>=$min && $pr<=$max && $pro[0]->idCat==$cate) {
                                   $cmp++;
                                } 
                            }
                            if(isset($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]!="null") {
                               
                              
                               $mar=$_POST["marque"];
                               $cate=$_POST["cate"];
                               
                                if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate) {  
                                   $cmp++;
                                } 
                            }
                            //trois
                            if(!empty($_POST["marque"]) &&  !empty($_POST["min"]) && !empty($_POST["max"]) && $_POST["cate"]!="null") {
                               
                               $min=$_POST["min"];
                               $max=$_POST["max"];
                               $mar=$_POST["marque"];
                               $cate=$_POST["cate"];
                               $pr=$pro[0]->prix;
                                if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate && $pr>=$min && $pr<=$max) {  
                                   $cmp++;
                                } 
                            }
                            if(empty($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                               
                               $cmp++;
                           
                            }
       
       
                      
                       }
                       else
                       {
                           $cmp++;
                       }
                 
                  
                 }//for
               
            }
          
        ?>

	<div class="result">
		<span> <?php echo $cmp; ?> Produit</span>
	</div>
	<div class="border_result"></div>
</section>

<!--<div class="container">
		slider------------------->
	<!--<ul id="autoWidth" class="cs-hidden">
	   
       
               
	   </ul>
</div>1------------------------------>




<!-----------nouvelle partie----------->
<section class="gallery">
	<div class="container">
		<div class="gallery-items">

			
			
                 
        <?php
      
      //$cat=simplexml_load_file("BDXML/categories/Categories.xml");
      function afficher($p)
      { 
        $cat=simplexml_load_file("BDXML/Categories.xml");  
        $id=$p->idPro;
        $prix=$p->prix;
        $title=$p->titre;
        $img=$p->image;

        $c="";
        $idc=$p->idCat;
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

       /* echo '<li class="item-a">
               <a href="page_product_details.php?idpro='.$id.'">
                <!--slider-box-->
               <div class="box">
                 <div class="image_produit">
                   <img src="media/imagePro/'.$img.'">
                 </div>
               <div class="border"></div>
                <!--details-->
               <div class="details">
                  <span class="cate">'.$c.'</span>
                  <span class="nom_produit">'.$title.'</span>
                  <span class="prix">'.$prix.'MAD</span>
               </div>
             </div>
              </a>
              </li>';*/

              echo '<a href="page_product_details.php?idpro='.$id.'">
              <div class="item_link">
                 <img src="media/imagePro/'.$img.'" alt="gallery" />
                 <div class="caption">
                    <p id="cate">'.$c.'</p>
                    <p id="titre">'.$title.'</p>
                    <p id="prix">'.$prix.' <span>MAD</span></p>
                 </div>
              </div>
           </a>';


      }
    if ($se!="Produit") {
        
    
      foreach($xml->produit as $pro) {
            //par sexe
         if ($pro[0]->sexe==$se) {
             
            if (isset($_POST["btn"])) {
                //chaque filter 
                if (isset($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                    
                       $mar=$_POST["marque"];
                        if (strtolower($pro[0]->marque)==strtolower($mar)) { 
                           
                       $p=$pro[0];
                       afficher($p);
                     
                        } 
                 }
                 if ($_POST["cate"]!="null" && empty($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"])) {
                    
                    $cate=$_POST["cate"];
                     if ($pro[0]->idCat==$cate) {
                      $p=$pro[0];
                      afficher($p);
                     } 
                 }
                 if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                    
                    $min=$_POST["min"];
                    $max=$_POST["max"];
                    $pr=$pro[0]->prix;
                     if ($pr>=$min && $pr<=$max) {
                        
                     //
                    $p=$pro[0];
                    afficher($p);
                  
                     //
                     } 
                 }
                 //deux filter
                 if (isset($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                    
                    $min=$_POST["min"];
                    $max=$_POST["max"];
                    $mar=$_POST["marque"];
                    $pr=$pro[0]->prix;
                     if ($pr>=$min && $pr<=$max && strtolower($pro[0]->marque)==strtolower($mar)) {
                        
                     //
                    $p=$pro[0];
                    afficher($p);
                  
                     //
                     } 
                 }
                 if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]!="null") {
                    
                    $min=$_POST["min"];
                    $max=$_POST["max"];
                    $cate=$_POST["cate"];
                    $pr=$pro[0]->prix;
                     if ($pr>=$min && $pr<=$max && $pro[0]->idCat==$cate) {
                        
                     //
                    $p=$pro[0];
                    afficher($p);
                  
                     //
                     } 
                 }
                 if(isset($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]!="null") {
                    
                   
                    $mar=$_POST["marque"];
                    $cate=$_POST["cate"];
                    
                     if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate) {  
                     //
                    $p=$pro[0];
                    afficher($p);
                     //
                     } 
                 }
                 //trois
                 if(!empty($_POST["marque"]) &&  !empty($_POST["min"]) && !empty($_POST["max"]) && $_POST["cate"]!="null") {
                    
                    $min=$_POST["min"];
                    $max=$_POST["max"];
                    $mar=$_POST["marque"];
                    $cate=$_POST["cate"];
                    $pr=$pro[0]->prix;
                     if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate && $pr>=$min && $pr<=$max) {  
                     //
                    $p=$pro[0];
                    afficher($p);
                     //
                     } 
                 }
                 if(empty($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                    
                    $p=$pro[0];
                    afficher($p);
                
                 }


           
            }
            else {
                //par sexe seulement (affichage seulement)
                $p=$pro[0];
                afficher($p);
                }  
        
             }//sexe
          }//for global

        }//pas produit(enf,ho,,fem)

        else {//produit 

            foreach($xml->produit as $pro) {

             
            if (isset($_POST["btn"])) {
                
                 //chaque filter 
                 if (isset($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                    
                    $mar=$_POST["marque"];
                     if (strtolower($pro[0]->marque)==strtolower($mar)) { 
                        
                    $p=$pro[0];
                    afficher($p);
                  
                     } 
              }
              if ($_POST["cate"]!="null" && empty($_POST["marque"]) && empty($_POST["min"]) && empty($_POST["max"])) {
                 
                 $cate=$_POST["cate"];
                  if ($pro[0]->idCat==$cate) {
                   $p=$pro[0];
                   afficher($p);
                  } 
              }
              if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                 
                 $min=$_POST["min"];
                 $max=$_POST["max"];
                 $pr=$pro[0]->prix;
                  if ($pr>=$min && $pr<=$max) {
                     
                  //
                 $p=$pro[0];
                 afficher($p);
               
                  //
                  } 
              }
              //deux filter
              if (isset($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]=="null") {
                 
                 $min=$_POST["min"];
                 $max=$_POST["max"];
                 $mar=$_POST["marque"];
                 $pr=$pro[0]->prix;
                  if ($pr>=$min && $pr<=$max && strtolower($pro[0]->marque)==strtolower($mar)) {
                     
                  //
                 $p=$pro[0];
                 afficher($p);
               
                  //
                  } 
              }
              if (empty($_POST["marque"]) &&  isset($_POST["min"]) && isset($_POST["max"]) && $_POST["cate"]!="null") {
                 
                 $min=$_POST["min"];
                 $max=$_POST["max"];
                 $cate=$_POST["cate"];
                 $pr=$pro[0]->prix;
                  if ($pr>=$min && $pr<=$max && $pro[0]->idCat==$cate) {
                     
                  //
                 $p=$pro[0];
                 afficher($p);
               
                  //
                  } 
              }
              if(isset($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]!="null") {
                 
                
                 $mar=$_POST["marque"];
                 $cate=$_POST["cate"];
                 
                  if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate) {  
                  //
                 $p=$pro[0];
                 afficher($p);
                  //
                  } 
              }
              //trois
              if(!empty($_POST["marque"]) &&  !empty($_POST["min"]) && !empty($_POST["max"]) && $_POST["cate"]!="null") {
                 
                 $min=$_POST["min"];
                 $max=$_POST["max"];
                 $mar=$_POST["marque"];
                 $cate=$_POST["cate"];
                 $pr=$pro[0]->prix;
                  if (strtolower($pro[0]->marque)==strtolower($mar) && $pro[0]->idCat==$cate && $pr>=$min && $pr<=$max) {  
                  //
                 $p=$pro[0];
                 afficher($p);
                  //
                  } 
              }
              if(empty($_POST["marque"]) &&  empty($_POST["min"]) && empty($_POST["max"]) && $_POST["cate"]=="null") {
                 
                 $p=$pro[0];
                 afficher($p);
             
              }


            }
            else{
                //affichage seulement  
                $p=$pro[0];
                afficher($p);
              }
                    
           }//for globale 2

        
        }

 
   ?>


	

		</div>

		
		<div class="pagination">
			<div class="prev">Préc</div>
			<div class="page">Page <span class="page-num"></span></div>
			<div class="next">Suiv</div>
		</div>
	</div>
</section>
<!----------fin de nouvelle partie---------->
	

 <!----------------footer---------------->
  
 
 <footer>

	<div class="package">
	  
	   <div class="package_logo">
		 
		 <img src="img/logo.png" alt="" class="footer_logo">
	   </div>

	  
	   <div class="package_elm">
			  <a href="" class="elm_link">Gérer les Données</a>
			  <a href="" class="elm_link">Centre de traitement des données personnelles</a>
			  <a href="" class="elm_link">Cookies</a>
			  <a href="" class="elm_link">Avis de confidentialité</a>
			  <a href="" class="elm_link">Conditions d'utilisation</a>
	   </div>
	</div>
</footer>











<script src="js/pagination_product.js" type="text/javascript"></script>

<script src="js/script.js" type="text/javascript"></script>
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
