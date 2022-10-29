<?php
session_start();
$xml=simplexml_load_file("BDXML/utilisateurs.xml");
   
   
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
       else {
        $_SESSION['cGesti']="".$cin; 
        header('Location:Accueil_G.php');
       }


      
   }
   else
   {
      
    header('Location:Register.php');
   
   }

 }
 else{ header('Location:Register.php');}


?>






