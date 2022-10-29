<?php  
session_start();  
if(isset($_SESSION['c']))  
{ 
    header("Location:page_Home.php");  
} 
else if(isset($_SESSION['cAdmin'])){
    header("Location:Accueil.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Connexion</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/register_login.css">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    

    <div class="container">
         <div class="sous_container">
             <a href="page_Home.php"><img src="img/logo.png" alt=""></a>
         </div>
         <div class="company_name">
             <span>Sport Store</span>
         </div>

    </div>


    <div class="hero">
        <div class="form_box">
            <div class="button_box">
                <div id="btn"></div>
                <button type="button" id="login_titre" class="toggle_btn">Connexion</button>
                <button type="button" id="register_titre" class="toggle_btn">Register</button>
            </div>
            <!--------formulaire_login-------->
            <form action="Register.php" method="Post" class="input_group" id="login">
                <input type="email" class="input_field" name="Email" id="login_email" placeholder="email">
                <span class="erreur_mail"></span>

                <input type="password" id="login_password" name="Pass" class="input_field log" placeholder="mot de passe">
                <span class="erreur_pass"></span>
                <i class="material-icons visibility1">visibility_off</i>
                <a href="password_forgoten.php"><span id="forgoten">Mot de passe oublié?</span></a>
                <button type="submit" name="signin" class="submit_btn" id="connexion">Connexion</button>
                <!-----check password-->
                
            </form>
            
            <?php
            // session_start();
               $xml=simplexml_load_file("BDXML/utilisateurs.xml");
               $a=1;
   
         if(isset($_POST['signin'])){
               
            if(!empty($_POST['Email']) && !empty($_POST['Pass'])){
                   $gmail=$_POST['Email'];
                   $pass=$_POST['Pass'];
                   $i=0;
                   $f="";
                    foreach($xml->utilisateur as $User) {
  
                         if ( $gmail==$User[0]->gmail &&  $pass==$User[0]->passW) {
                            $i=1;
                            $f=$User[0]->fonction;
                            $cin=$User[0]->idU;
                            break;

                         }
                    }
  
   
                    if ($i==1) {
      
                        if ($f=="client") {
                           $_SESSION['c']="".$cin; 
                           header('Location:page_Home.php');
        
                        }
                        else if($f=="Administrateur"){
                           $_SESSION['cAdmin']="".$cin; 
                           header('Location:Accueil.php');
                        }
                    }
                    else
                    {
                        echo '<script type="text/javascript">
                        swal({
                              title:"Gmail ou Mot de passe pas correct",
                              text:"Vous avez cliqué sur le bouton!",
                              icon:"error"
                                  });
                        </script>';
                    }

           }
           else
           { 
               //header('Location:Register.php');
           }

        }
?>          
        
            <!------formulaire_register------->
            <form action="Register.php" method="Post" class="input_group" id="register">
                <input type="text" name="Nom" class="input_field" id="reg_nom" placeholder="Nom">
                <span class="erreur_nom"></span>
                <input type="text" name="Prenom" id="prenom_reg"  class="input_field" placeholder="Prénom">
                <span class="erreur_prenom"></span>
                <div class="radio-box" id="radio_reg">
                    <label>
                         <input type="radio" name="Sexe" value="Homme">
                         <div class="circle"></div>
                         <span>Homme</span>
                    </label>
                    <label>
                         <input type="radio" name="Sexe" value="Femme">
                         <div class="circle"></div>
                         <span>Femme</span>
                    </label>
                </div>
                <input type="tel" id="tel_reg" name="Tele" class="input_field" placeholder="+(212)">
                <span class="erreur_tel"></span>
                <input type="email" id="email_reg" name="Email" class="input_field" placeholder="email">
                <span class="erreur_mail_reg"></span>
                <input type="password" id="password_reg" name="Pass" class="input_field reg" placeholder="password">
                <span class="erreur_pass_reg"></span>
                <i class="material-icons visibility">visibility_off</i>
                <button type="submit" name="btn" class="submit_btn" id="creer">Créer</button>
            </form>
        </div>
    </div>
    <?php
 

 if(isset($_POST['btn']))
 {
    

    
   //$cin=$_POST['Cin'];
   $nom=$_POST['Nom'];
   $prenom=$_POST['Prenom'];
   $tele=$_POST['Tele'];
   $gmail=$_POST['Email'];
   $pass=$_POST['Pass'];
   $sexe=$_POST['Sexe'];

    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
    $i=0;
    foreach($xml->utilisateur as $User) {
  
      if ( $gmail==$User[0]->gmail || $cin==$User[0]->idU) {
         $i=1;
       }
    }

    if ($i>0) {
        echo '<script type="text/javascript">
        swal({
              title:"Gmail déjà exist",
              text:"Vous avez cliqué sur le bouton!",
              icon:"error"
                  });
        </script>';
    }
    else
    {
         
          //compteur
          if(!file_exists("compteur/cmpUser.txt"))
          {
              $fp=fopen("compteur/cmpUser.txt","w");
              $cp=1;
              
          }
          else{
              $fp=fopen("compteur/cmpUser.txt","r+");
              $cp=fgets($fp,255);
              $cp++;
          }
     
          fseek($fp,0);
          fputs($fp,$cp);
          fclose($fp);
          //
       
        $utilisateur=$xml->addChild('utilisateur');
        $utilisateur->addChild('idU',$cp);
        $utilisateur->addChild('nom',$nom);
        $utilisateur->addChild('prenom',$prenom);
        $utilisateur->addChild('tele',$tele);
        $utilisateur->addChild('sexe',$sexe);
        $utilisateur->addChild('gmail',$gmail);
        $utilisateur->addChild('passW',$pass);
        $utilisateur->addChild('fonction','client');
        $utilisateur->addChild('image','null');
        file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
        echo '<script type="text/javascript">
         swal({
               title:"Bon travail!",
               text:"Vous avez cliqué sur le bouton!",
               icon:"success"
                   });
         </script>';
    
    }
   


}


?>


    <script src="js/login_register.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</body>
</html>