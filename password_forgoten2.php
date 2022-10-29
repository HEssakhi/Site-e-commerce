<?php

/*if (!empty($_GET['idU'])) {
    $idUser=$_GET['idU'];
}
else {
    header('Location:password_forgoten.php');
}*/
$idUser=$_GET['idU']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="css/password_forgoten2.css">
</head>
<body>
    <div class="container">
        <div class="title">
                <span>Réinitialiser votre mot de passe</span>
        </div>
           <form action="password_forgoten2.php?idU=<?php echo $idUser; ?>" method="Post">
        <div class="input">
              
            <div class="compte">
                 <?php
                      
            $xml=simplexml_load_file("BDXML/utilisateurs.xml");
            foreach($xml->utilisateur as $User) {
 
                if ($idUser==$User[0]->idU) {
                    
                  $nom=$User[0]->nom." ".$User[0]->prenom;
                  $gmail=$User[0]->gmail;
                  $tele=$User[0]->tele;
                  $image=$User[0]->image;
                  $tel=substr($tele,8,9);
                  $gm=substr($gmail,5,16);
                  
                  if ($image=="null") {
                    echo '<img src="assetsAdmin/images/profile.jpg">';
                  }
                  else {
                    echo '<img src="media/imageU/'.$image.'">';
                  }

                  echo '<span id="nom">'.$nom.'</span>';
                  echo '<span id="text">Utilisateur Sport Store</span>';
 
                }
         
               } 

           ?>
                
                
                
            </div>

            <div class="code">
                <span id="text2">Nous avons envoyé le code par email</span>
                <span id="numero">+*********<?php echo $gm ?></span>
            </div>

        </div>
        <div class="rechercher">
                <a href="password_forgoten.php"><button type="button" id="reset">Annuler</button></a>
                <button type="submit" name="btn" id="submit">Continuer</button>
            </form>
            <?php
              
              if (isset($_POST['btn'])) {


              
                 //$code=substr($tele,3,3).''.substr($nom,2,3).''.substr($gmail,1,2);
                 //Génération Code
                 function codegen($nbChar){
                    return substr(str_shuffle(
                'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1, $nbChar); }
                $code=codegen(8);

                /* $tel='+212'.substr($tele,1,strlen($tele));


                 require $_SERVER['DOCUMENT_ROOT'] . '/Site e-commerce/vendor/autoload.php';
            
                 $MessageBird = new \MessageBird\Client('LXZOgNS6WlKDzsbnddoLy4ere');
                 $Message     = new \MessageBird\Objects\Message();
                 $Message->originator = 'Sport Store';
                 $Message->recipients =array('+212611824963');
                 $Message->body = $code;
                 print_r(json_encode($MessageBird->messages->create($Message)));
                 header('Location:password_forgoten3.php?code='.MD5($code).'&idu='.$idUser);   */
                 include("PHPMailerAutoload.php");
                   $mail=new PHPMailer();
                   $mail->isSMTP();
                   $mail->Host='smtp.gmail.com';
                   $mail->Port=587;
                   $mail->SMTPAuth=true;
                   $mail->SMTPSecure='tls';


                   $mail->Username='';//email pro
                   $mail->Password='';//password

                   $mail->setFrom('sportstorebusiness@gmail.com','Sport Store');
                   // $mail->addAddress($t[1]);
                   $mail->addAddress($gmail);
                   $mail->addReplyTo('sportstorebusiness@gmail.com');
                   $mail->isHTML(true);
                   $mail->Subject='Recuperer le Mot de Passe';
                   //$mail->Body='Le code est :'.$code;
                   $mail->Body='<table border="0" cellpadding="0" cellspacing="0" style="max-width: 602px;width: 100%;border:1px solid #d5d5d5" align="center">
                   <tr>
                       <td style="background-color: #fde148;padding:15px" align="center" valign="middle">
                           <h2 style="margin:0;font-family: sans-serif;font-size:30px;">
                           Salut '.strtoupper($nom).'
                           </h2>
                       </td>
                   </tr>
                  
                   <tr>
                       <td style="background-color: #ffffff;padding:0px 20px" align="center">
                            <h3 style="font-size:25px;font-family: sans-serif;margin:25px 0px 20px">Code pour récupérer le mot de passe : '.$code.'</h3>
                          
                       </td>
                   </tr>
                   <tr>
                       <td align="center" valign="top">
                           <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;background-color: #ffffff;padding:0px 20px 40px">
                               <tr>
                                   <td valign="middle">
                                       <div style="display: block;width:100%;height: 1px;background-color: #d5d5d5;"></div>
                                   </td>
                               </tr>
                               <tr>
                                   <td align="center" valign="middle">
                                       <p style="font-size:16px;font-family: sans-serif;color:#000000;margin:20px 0px">Rester connecté</p>
                                   </td>
                               </tr>
                               <tr>
                                   <td align="center" valign="middle">
                                       <a href="" style="display: inline-block;font-size:14px;color:#ffffff;background-color:#4b69b0;padding:4px 10px;text-decoration: none;border-radius:4px;margin:0px 1px 6px 1px;font-family: sans-serif;">
                                           Facebook
                                       </a>
                                       <a href="" style="display: inline-block;font-size:14px;color:#ffffff;background-color:#e83f3a;padding:4px 10px;text-decoration: none;border-radius:4px;margin:0px 1px 6px 1px;font-family: sans-serif;">
                                           Youtube
                                       </a>
                                       <a href="" style="display: inline-block;font-size:14px;color:#ffffff;background-color:#37b1e1;padding:4px 10px;text-decoration: none;border-radius:4px;margin:0px 1px 6px 1px;font-family: sans-serif;">
                                           Twitter
                                       </a>
                                       <a href="" style="display: inline-block;font-size:14px;color:#ffffff;background-color:#e83f3a;padding:4px 10px;text-decoration: none;border-radius:4px;margin:0px 1px 6px 1px;font-family: sans-serif;">
                                           Google Plus
                                       </a>
                                   </td>
                               </tr>
                               <tr>
                                   <td valign="middle" align="center">
                                       <p style="font-size:14px;color:#444444;font-family: sans-serif;margin:25px 0px 15px">Si vous avez besoin d\'aide, veuillez nous envoyer un courriel à sportstorebuisiness@gmail.com</p>
                                       <h3 style="font-size:20px;font-family: sans-serif;color:#000000;margin:0px">Sport Store</h3>
                                   </td>
                               </tr>
                           </table>
                       </td>
                   </tr>
                 </table>';
                   $mail->send();
                 
                 

                 header('Location:password_forgoten3.php?code='.MD5($code).'&idu='.$idUser);
              }
               




            ?>
        </div>
    </div>
</body>
</html>