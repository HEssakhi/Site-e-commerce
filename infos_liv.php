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
   header('Location:Register.php');
   $nom="";
}

if(isset($_SESSION['cAdmin'])) {
    header('Location:Accueil.php'); 
 }
 if(!isset($_SESSION['panier']))
 { 
    header('Location:page_panier.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur livraison</title>
    <link rel="stylesheet" href="css/infos_liv.css">
</head>
<body>


    <div class="the_container">
    <div class="container">
        <div class="title">
                <span>Informations sur Livraison</span>
        </div>
           <form action="MisAjourPanier.php" method="Post">
        <div class="input">
                <span>Veuillez saisir votre adresse et le nom de votre ville aussi le code postal.</span>
                <input type="text" name="adresse" placeholder="adresse">
              <div class="select-box">
                <select required  name="ville">
                    <option value= "null" selected disabled hidden id="title_combo">Choisir une Ville</option>
                    <option value="Laayoune">Laayoune</option>
                    <option value="Fes">Fes</option>
                    <option value="Rabat">Rabat</option>
                    <option value="CasaBlanca">CasaBlanca</option>
                    <option value="Tanger">Tanger</option>
                    <option value="Agadir">Agadir</option>
                    <option value="Dakhla">Dakhla</option>
                    <option value="Meknes">Meknes</option>
                    
                
                </select>
                <input type="tel" name="codep" placeholder="Code postal" id="postal">
              </div> 
              
              <div class="paiement">
                  <span>Mode de paiement</span>
              </div>

              
              <div class="radio-box" id="radio_reg">
                    <label>
                         <input type="radio" name="modep" value="rem">
                         <div class="circle"></div>
                         <span>Paiement contre remboursement</span>
                    </label>
                    <label>
                         <input type="radio" name="modep" value="pay" checked>
                         <div class="circle"></div>
                         <span>Paiement en ligne (PayPal)</span>
                    </label>
             </div>
                
        </div>
        <div class="rechercher">
                <a href="page_panier.php"><button type="button" id="reset">Annuler</button></a>
                <button type="submit"  name="commander" id="submit">Valider</button> 
        </div>
    </form>
    </div>

    <!------------infos-supplimentaires-------->

<div class="container2">  
    <div class="montant">
        <div class="mon_title">
            <span>Montant payé</span>
        </div>
        <div class="border2"></div>
         <?php
           if(isset($_SESSION['panier']))
           {  
               $montant=0;
           $nb_articles = count($_SESSION['panier']['id']);
           
           for($i = 0; $i < $nb_articles; $i++)
              {      
                 $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
              }
            }


        ?>
        <div class="mon_details">
            <div>
               <span class="mtn">Prix de Commande:</span><span class="mtn_rep"><?php echo $montant; ?></span> 
            </div>
            <div>
                <span class="mtn">Prix de Livraison:</span><span class="mtn_rep">49</span> 
             </div>
             <div>
                <span class="mtn total">Montant Total:</span><span class="mtn_rep total2"><?php echo $montant+49; ?></span> 
             </div>
        </div>
    </div>
    <!------note-->
    <div class="note">
        <span>Je vous informer monsieur que la livraison sera avec le distributeur
               Amana, donc soyez prét pour recevoir une message à ce propos.
        </span>
        <img src="img/amana.svg" alt="">
    </div>
</div>  
</div>
</body>
</html>