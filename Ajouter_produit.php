<?php
session_start();
if (isset($_SESSION['cAdmin'])) {
   $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $idUser=$_SESSION['cAdmin'];
   
}
else {
  header('Location:page_Home.php');
  //$nom="";
}
?>

<!DOCTYPE html>
<html>
<title>Ajouter produit</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assetsAdmin/css/ajouter annonce.css">    

<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script> 
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<body>

  <!-- Grid -->
  <form id="msform" action="Ajouter_produit.php" method="Post" enctype="multipart/form-data">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Commencez par l’essentiel</li>
    <li >Décrivez-nous votre produit</li>
    <li>Photos</li>
  </ul>
  <!-- fieldsets -->

  <!----------slide 1-------->
 <fieldset id="field1">
    <div class="title">
      <h2 class="fs-title">Caractérestiques générales</h2>
      <div class="minititle">
        <img src="assetsAdmin/images/warning.svg" alt=""><h3 class="fs-subtitle">les champs avec (<span>*</span>) sont obligatoires</h3>
        <img src="assetsAdmin/images/welcome.png" alt="" class="principal">
      </div>
    </div>
    <div class="container">
      <div class="input-box">
        <label for="adresse" class="adresse"><span>*</span> Intitulé de produit</label>
          <input type="text" id="adresse" name="title" placeholder="Intitulé de produit" required>
      </div>
    </div>
    <div class="container">
       <div class="select-box" id="type-bien">   
          <label for="bien" class="bien"><span>*</span>Catégorie</label>
          <select id="bien" name="cate" required onchange="copie()">
              <option value="null" selected disabled hidden>--Catégorie--</option>
              <?php
                                           $xml=simplexml_load_file("BDXML/Categories.xml");

                                             foreach($xml->Categorie as $Cat) {
                                                $id=$Cat[0]->idCat;
                                                $nom=$Cat[0]->nomCat;
                                                echo "<option value=$id>$nom</option>";
                                              }

                                        ?>
          </select>
       </div>
    </div>

    <div class="container">
       <div class="select-box">   
        <label for="Transaction" class="Transact"><span>*</span> Sexe</label>
               <select id="Transaction" name="sexe" required >
                     <option value="null" selected disabled hidden>--CHOISISSEZ--</option>
                     <option value="homme">Homme</option>
                     <option value="femme">Femme</option>
                     <option value="enfant">enfant</option>
               </select>
      </div>
    </div>
    <div class="container">
        <div class="select-box ville">   
             <label for="Ville" class="ville"><span>*</span> Taille</label>
             <select name="taille[]" required multiple size="1">
                    <option value="null" selected disabled hidden>--Tapez la Ville--</option>
                                    <option value="XL">XL</option>
                                    <option value="S">S</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="XS">XS</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="Unique">Unique</option>
             </select>
        </div>
   </div>
    <input type="button" name="next" class="next action-button" value="Continuer" />
  </fieldset>
  <!-------------end slide 1------------>
  <!---------------slide 2----------------->
<fieldset class="details">
 
    <div class="title">
      <h2 class="fs-title" id="titlefield3">Déscription du produit</h2>
    </div>
    <section class="part2" id="part2">
        <div class="container3" id="container3">
          <div class="input-box">
            <label for="tit-annonce" class="tit-annonce"><span>*</span> Intitulé de la marque</label>
            <input type="text" id="tit-annonce" name="marque" placeholder="Titre de l'annonce" required class="req">
          </div>
          <div class="input-box">
            <label for="tit-annonce" class="nbr_pièce">Nombre de pièce</label>
            <input type="number" name="stock" id="tit-annonce" placeholder="Dhs">
          </div>
          <div class="input-box price">
            <label for="tit-annonce" class="prix">Prix</label>
            <input type="number" name="prix" id="tit-annonce" placeholder="Dhs">
          </div>
        </div>
    </section>
        <input type="button" name="previous" class="previous action-button" value="Retour" id="but1" />
        <input type="button" name="next" class="next action-button" value="Continuer" id="but2"/>

  </fieldset> 

 <fieldset id="last">
      <div class="title">
            <h2 class="fs-title" id="titlelast">Photos</h2>
      </div>
      <div class="note">
        Photos (1 maximum)
      </div>
        <div class="upload-img">     
                <div class="pro-img">
                  <div class="photo"><img src="assetsAdmin/images/upload.png"  id="profiledisplay3" onclick="triggerclick3()">
                    <i class='bx bx-x-circle delete3'></i>
                  </div> 
                  
                  <input type="file" name="photo" onchange="displayimage3(this)" id="profileimage3" accept="image/*">
                </div>
        </div>
             <input type="button" name="previous" class="previous action-button" value="Retour" id="but5" />
             <input type="submit" name="btn"  class="submit action-button" value="Déposer" id="but4" />
  </fieldset>
</form>   
<?php
                           
                           if(isset($_POST['btn']))
                           {
                               if (!empty($_FILES["photo"]) && isset($_FILES["photo"]) && !empty($_POST['taille']) && !empty($_POST['sexe']) && !empty($_POST['cate']) && !empty($_POST['title']) && !empty($_POST['stock']) && !empty($_POST['prix']) && !empty($_POST['marque']) ) {
                              
                               //!empty($_POST['cate']) && isset($_FILES["photo"]) &&

                            $xml=simplexml_load_file("BDXML/produits.xml");

                                                  //compteur
                                                  if(!file_exists("compteur/cmpPro.txt"))
                                                  {
                                                      $fp=fopen("compteur/cmpPro.txt","w");
                                                      $cp=1;
                                                      
                                                  }
                                                  else{
                                                      $fp=fopen("compteur/cmpPro.txt","r+");
                                                      $cp=fgets($fp,255);
                                                      $cp++;
                                                  }
                                             
                                                  fseek($fp,0);
                                                  fputs($fp,$cp);
                                                  fclose($fp);
        
                                                  //

                                

                               $title=$_POST['title'];
                               $cate=$_POST['cate'];
                               $stock=$_POST['stock'];
                               $prix=$_POST['prix'];
                               $sexe=$_POST['sexe'];
                               $marque=$_POST['marque'];
                               $tabtaille=$_POST['taille'];
                               
                               $produit=$xml->addChild('produit');
                               $produit->addChild('idPro',$cp);
                               $produit->addChild('titre',$title);
                               $produit->addChild('prix',$prix);
                               $produit->addChild('idCat',$cate);
                               $produit->addChild('sexe',$sexe);

                               $produit->addChild('stock',$stock);
                               $produit->addChild('marque',$marque);
                               for ($i=0; $i < count($tabtaille); $i++) { 
                                $produit->addChild('taille',$tabtaille[$i]);
                               }
                               /////image

                              
                            
                                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png", "gif" => "image/gif");
                                    $filename = $_FILES["photo"]["name"];
                                    $filetype = $_FILES["photo"]["type"];
                                    $filesize = $_FILES["photo"]["size"];
                              
                                    // Vérifie l'extension du fichier
                                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                    if(!array_key_exists($ext, $allowed))
                                    {
                                        echo '<script type="text/javascript">
                                        swal({
                                              title:"Erreur : Veuillez sélectionner un format de fichier valide.",
                                              text:"Vous avez cliqué sur le bouton!",
                                              icon:"error"
                                                  });
                                        </script>';
                                        die();
                                    } 
                              
                                    // Vérifie la taille du fichier - 5Mo maximum
                                    $maxsize = 5 * 1024 * 1024;
                                    if($filesize > $maxsize)
                                    {
                                        echo '<script type="text/javascript">
                                        swal({
                                              title:"Error: La taille du fichier est supérieure à la limite autorisée.",
                                              text:"Vous avez cliqué sur le bouton!",
                                              icon:"error"
                                                  });
                                        </script>';
                                        die();
                                    } 
                              
                                    // Vérifie le type MIME du fichier
                                    if(in_array($filetype, $allowed)){
                                        
                                            move_uploaded_file($_FILES["photo"]["tmp_name"], "media/imagePro/".$title."".$cp.".".substr($_FILES["photo"]["type"],6,strlen($_FILES["photo"]["type"])));
                                            //echo "Votre fichier a été téléchargé avec succès.";
                                            $img=$title."".$cp.".".substr($_FILES["photo"]["type"],6,strlen($_FILES["photo"]["type"]));
                                    } else{
                                        echo '<script type="text/javascript">
                                        swal({
                                              title:"Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.",
                                              text:"Vous avez cliqué sur le bouton!",
                                              icon:"error"
                                                  });
                                        </script>';
                                        
                                    }
                               /////image

                               $produit->addChild('image',$img);
                               file_put_contents('BDXML/produits.xml',$xml->asXml());
                               //echo("<meta http-equiv='refresh' content='0'>");
                               echo '<script type="text/javascript">
                               swal({
                                     title:"Bon travail!",
                                     text:"Vous avez cliqué sur le bouton!",
                                     icon:"success"
                                         });
                               </script>';




                            }
                            else {
                                echo '<script type="text/javascript">
                                swal({
                                      title:"Remplier tout les champe",
                                      text:"Vous avez cliqué sur le bouton!",
                                      icon:"error"
                                          });
                                </script>';
                            }

                      }




                        ?>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

    <script src="assetsAdmin/js/ajouter annonce.js"></script>
    <script src="assetsAdmin/js/visibility.js"></script> 
   <script>
     $('#txt-annonce').keyup(function(){
    $('.word-counter').text(this.value.replace(/ /g,'').length+'/4000');
     })
   </script>
</body>
</html>
















 
