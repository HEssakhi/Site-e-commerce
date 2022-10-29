<?php
session_start();
if (isset($_SESSION['c'])) {
   $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $idUser=$_SESSION['c'];
   foreach($xml->utilisateur as $User) {
 
    if ($idUser==$User[0]->idU) {
        
      $nom=$User[0]->nom." ".$User[0]->prenom;
      $gmail=$User[0]->gmail;

    }

   } 
   
}
else {
  header('Location:page_Home.php');
  //$nom="";
}
if (isset($_SESSION['cAdmin'])) {
   header('Location:Accueil.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assetsAdmin/css/password.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
   <div class="general">
       <div class="sitelogo"><img src="assetsAdmin/images/logo.png" alt="website logo"></div>
       <div class="username"><label><?php echo $nom; ?></label></div>
       <div class="usermail"><label><?php echo $gmail; ?></label></div>
       <p>Pour continuer, veuillez confirmer votre identité</p>
       <form action="editPasswordC1.php" method="Post">
        <div class="password">
            <input type="password" name="Pass" id="firstName" class="form-control" placeholder="Saisissez votre mot de passe">
            <div class="text"><label for="firstName">Saisissez votre mot de passe</label></div>
        </div>
        <div class="but"><input type="submit" value="Suivant" name="btn"></div>
       </form>
       <?php

       if (isset($_POST['btn'])) {
           
       
         
         if(!empty($_POST['Pass'])){

            
            $pass=$_POST['Pass'];
            $i=0;
            //$f="";
            foreach($xml->utilisateur as $User) {
           
             if ( $gmail==$User[0]->gmail &&  $pass==$User[0]->passW) {
                //header('Location:edit password2.html');
                $i=1;
                break;
              }
             }
             if ($i==0) {
                echo '<script type="text/javascript">
                swal({
                      title:"Mot de Passe Incorrect",
                      text:"Vous avez cliqué sur le bouton!",
                      icon:"error"
                          });
                </script>';
             }else {
                header('Location:editPasswordC2.php');
             }
         


          }

        }


       ?>
   </div> 
   
</body>
</html>