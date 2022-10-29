
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
$idcmd=$_GET['idcmd'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate order</title>
     <!----ce lien est utilisé pour réferencier le nav design-->
    <link rel="stylesheet" href="css/home.css">
    <!------ce lien est utilisé pour referencier le design de validate order page---------->
    <link rel="stylesheet" href="css/validate_order2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

   

    <!------------------------------>
<section class="first">

    <!-------------------->
    <div class="order_review">
        <div class="products">
            <div class="review_title">
                 <span>Description de la commande</span>
            </div>
            <div class="border_"></div>
            <div class="description">
               <?php
                  $xml=simplexml_load_file("BDXML/commandes.xml");
                  $p=simplexml_load_file("BDXML/produits.xml");
                  $l=simplexml_load_file("BDXML/livraisons.xml");
                  $tab=array();

                  //
                  $datel="";
                  $etat="";
                  $duree="";
                  //produit
                  foreach($p->produit as $pro) {
                     $tab[]=$pro[0]->idPro.",".$pro[0]->titre.",".$pro[0]->prix.",".$pro[0]->image;
                  }
                  //livraisons
                  $tab1=array();
                  foreach($l->livraison as $liv) {
                    $tab1[]=$liv[0]->idCmd.",".$liv[0]->dateL.",".$liv[0]->etat;
                  }


                  //
                  $montant=0;
                  foreach($xml->commande as $cmd) {
                   
                    if ($cmd[0]->NumCmd==$idcmd) {
                        //Mode de paiement
                        $pay=$cmd->paiement;
                        if ($pay=="oui") {
                            $p="paypal";
                        }else {
                            $p="C.remboursement";
                        }

                       //livraison
                       $ta1=array();
                       for ($j=0; $j < count($tab1); $j++) {
                         $ta1=explode(",",$tab1[$j]);
                         if ($ta1[0]==$idcmd) {
                             if ($ta1[1]!="null" && $ta1[2]!="null") {
                                $datel=$ta1[1];
                                $etat=$ta1[2];
                                $duree="10-15 jours";
                             }

                             else if ($ta1[1]!="null") {
                                $datel=$ta1[1];
                                $etat="";
                                $duree="10-15 jours";
                             }
                             
                         }

                       }

                       //produit
                       for ($i=0; $i < $cmd[0]->count()-5; $i++) { 
                           $id=$cmd[0]->Pro[$i]->idPro;
                           $qte=$cmd[0]->Pro[$i]->qte;
                           $taille=$cmd[0]->Pro[$i]->taille;
                           
                           $ta=array();
                           for ($j=0; $j < count($tab); $j++) {
                            $ta=explode(",",$tab[$j]);
                            $idpro=$cmd[0]->Pro[$i]->idPro;
                            if ($ta[0]==$idpro) {
                                $title=$ta[1];
                                $prix=$ta[2];
                                $img=$ta[3];
                                $montant+=$prix*$qte;
                             }
    
                           }//produit
                       
                 ?>
                <div class="produit_items">
                     <div class="product-img">
                         <img src="media/imagePro/<?php echo $img ?>" alt="">
                     </div>
                     <div class="product-details">
                         <div class="product_name">
                             <span><?php echo $title ?></span>
                         </div>
                         <div class="details">
                             <div class="price">
                                 <span>Prix :<span> <?php echo $prix ?> MAD</span></span>
                             </div>
                             <div class="size">
                                 <span>Taille : <span><?php echo $taille ?></span></span>
                             </div>
                             <div class="quantite">
                                 <span>Quantité : <span><?php echo $qte ?></span></span>
                             </div>
                         </div>
                     </div>
                 </div> 
                <?php       
                      }//info commende
                    }//test idcmd
                  
                  }



               ?>
                
               

           
 
            </div>
        </div>


        <div class="liv_total">
                <div class="livraison">
                      <div class="liv_title">
                          <span>Information sur Livraison</span>
                      </div>
                      <div class="border_ border2 bliv"></div>
                      <div class="liv_details">
                          <span class="qst">Date de Livraison: <span><?php echo $datel ?></span></span>
                          <span class="qst">Etat: <span><?php echo $etat ?></span></span>
                          <span class="qst">Durée: <span><?php echo $duree ?> </span></span>
                      </div>
                </div>

                <div class="montant">
                    <div class="mon_title">
                        <span>Montant payé</span>
                    </div>
                    <div class="border_ border2"></div>
                    <div class="mon_details">
                        <div>
                           <span class="mtn">Prix de Commande:</span><span class="mtn_rep"><?php echo $montant ?> MAD</span> 
                        </div>
                        <div>
                            <span class="mtn">Prix de Livraison:</span><span class="mtn_rep">49 MAD</span> 
                         </div>
                         <div>
                            <span class="mtn">Montant Total:</span><span class="mtn_rep"><?php echo ($montant+49) ?> MAD</span> 
                         </div>
                         <div>
                            <span class="mtn">Mode de paiement:</span><span class="mtn_rep"><?php echo $p ?></span> 
                         </div>
                    </div>
                </div>
        </div>
        
    </div>
    </div>
</section> 
    



<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="js/app.js"></script>

<script>
            $(document).ready(function(){
                $(".ajouter_infos").click(function(){
                $(".formulaire").slideToggle("slow");
                });
            });
</script>
</body>
</html>