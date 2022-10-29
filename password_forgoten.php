<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="css/password_forgoten.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="title">
                <span>Retrouvez votre compte</span>
        </div>
           <form action="password_forgoten.php" method="Post">
        <div class="input">
                <span>Veuillez saisir votre adresse e-mail pour rechercher votre compte.</span>
                <input type="email" name="Email" placeholder="adresse email">
        </div>
        <div class="rechercher">
               <a href="Register.php"><button type="button" id="reset">Annuler</button></a>
                <button type="submit" name="btn" id="submit">Rechercher</button>
            </form>
            <?php
                
                $xml=simplexml_load_file("BDXML/utilisateurs.xml");
                $a=1;
    
          if(isset($_POST['btn'])){
                
             if(!empty($_POST['Email']) ){
                    $gmail=$_POST['Email'];
                    
                    $i=0;
               
                     foreach($xml->utilisateur as $User) {
   
                          if ( $gmail==$User[0]->gmail) {
                             $i=1;
                             $idUser=$User[0]->idU;
                             break;
 
                          }
                     }
   
    
                     if ($i==1) {
                        header('Location:password_forgoten2.php?idU='.$idUser);
                     }
                     else{

                        echo '<script type="text/javascript">
                        swal({
                              title:"Gmail pas correct",
                              text:"Vous avez cliqué sur le bouton!",
                              icon:"error"
                                  });
                        </script>';
                     }

                    }
                }

            ?>


        </div>
    </div>
</body>
</html>