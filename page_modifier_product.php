
<?php

session_start();
if (isset($_SESSION['cAdmin'])) {
   //$xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $idUser=$_SESSION['cAdmin'];
   
}
else {
  header('Location:page_Home.php');
  //$nom="";
}



if (empty($_GET['idp'])) {
  header('Location:produits.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier produit</title>
    <!----ce lien est utilisé pour réferencier le nav design-->
    <link rel="stylesheet" href="css/home.css">
    <!------ce lien est utilisé pour referencier le design de product page---------->
    <link rel="stylesheet" href="css/product_modifier.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    

    <!-------retour au page precedente-------->
    <div class="retour">
           <a href="produits.php" class="retour_link">
               <button><ion-icon name="return-up-back-outline" class="arrow"></ion-icon></ion-icon><span class="nom">Retour</span></button>
           </a>
    </div>
    <?php
          $idpro=$_GET['idp'];
          $xml=simplexml_load_file("BDXML/produits.xml");
         
          foreach($xml->produit as $pro) {
            $id=$pro[0]->idPro;
            if ($id==$idpro) {
                $prix=$pro[0]->prix;
                $title=$pro[0]->titre;
                $img=$pro[0]->image;
                $marque=$pro[0]->marque;
                $stock=$pro[0]->stock;
                    
            }
           }
            

        ?>

    <!-----product image and details----->
    <div class="container">
        <!------imgaes slides------>
        <div class="card">
            <div class="images">
                <div class="slider"><img id="big-image" src="media/imagePro/<?php echo $img ?>" alt=""></div>
            </div>
        </div>
       <!------product_informations----->
       <div class="infos_container">
           <div class="prodcut_title"><span><?php echo $title ?></span></div>
           <div class="prodcut_marque"><span><?php echo $marque ?></span></div>
           <div class="border_taille"></div>

           <form action="page_modifier_product.php?idp=<?php echo $idpro ?>" method="Post">
           <!-------------quantite----------->
         <div class="prodcut_quantite">
               <span>Stock :</span>
            <div class="quantite_input">
                 <input type="number" name="stock" value="<?php echo $stock ?>" id="qte_input" min="0">
            </div>
         </div>

         <!------------la taille--------->
         <div class="prodcut_taille">
          <span>Prix :</span>
          <div class="taille_grid">
            <input type="number" name="prix" value="<?php echo $prix ?>" id="prix_input" min="0">
          </div>
      </div>


          <!------ajouter au panier button----->
          <div class="_links">
            <div class="command_button">
              <div class="add_to_command">
                   <button type="submit" name="btn" ><span class="command_titre">Modifier produit</span><ion-icon name="return-up-forward-outline" class="arrow"></ion-icon></button>
              </div>
            </div>
          </div>
       </div>
    </div>
  </form>
         <?php
          
       if (isset($_POST['btn'])) {
         if (!empty($_POST['stock']) && !empty($_POST['prix'])) {
            
           
            $prix=$_POST['prix'];
            $stock=$_POST['stock'];
            if ($prix>=0 && $stock>0) {
               
            foreach($xml->produit as $pro) {
              $id=$pro[0]->idPro;
              if ($id==$idpro) {
                 $pro[0]->prix= $prix;
                 $pro[0]->stock=$stock;
                 break;
                      
              }
             }
             
             
             file_put_contents('BDXML/produits.xml',$xml->asXml());
             echo("<meta http-equiv='refresh' content='0'>");
             echo '<script type="text/javascript">
                  swal({
                        title:"Bein Modifier",
                        text:"Vous avez cliqué sur le bouton!",
                        icon:"success"
                            });
                  </script>';
            }
            else {
              echo '<script type="text/javascript">
              swal({
                    title:"le Stock ou le Prix pas Valide",
                    text:"Vous avez cliqué sur le bouton!",
                    icon:"error"
                        });
              </script>';
            }

                  

              
          }
          else {
            echo '<script type="text/javascript">
                  swal({
                        title:"Entre le Stock et le Prix",
                        text:"Vous avez cliqué sur le bouton!",
                        icon:"error"
                            });
                  </script>';
          }
             
        }





         ?>
    


    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="js/app.js"></script>
</body>
</html>