<?php

session_start();
if (isset($_SESSION['cAdmin'])) {
    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   
   $idUser=$_SESSION['cAdmin'];

   if(isset($_POST['OkImage']))
     {

        /////image
         
          foreach($xml->utilisateur as $User) {
  
             if ($idUser==$User[0]->idU) {
              $nom=$User[0]->nom."".$User[0]->prenom;
            }
         }  
        

                                                    
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png", "gif" => "image/gif");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
  
        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed))
        {
            header('Location:edit_infos_admin.php');
        } 
  
        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize)
        {
            header('Location:edit_infos_admin.php');
        } 
  
        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            
                move_uploaded_file($_FILES["photo"]["tmp_name"], "media/imageU/".$nom."".$idUser.".".substr($_FILES["photo"]["type"],6,strlen($_FILES["photo"]["type"])));
                //echo "Votre fichier a été téléchargé avec succès.";
                $img=$nom."".$idUser.".".substr($_FILES["photo"]["type"],6,strlen($_FILES["photo"]["type"]));

               
                     foreach($xml->utilisateur as $User) {
                        $id=$User->idU;
                        if ($id==$idUser) {
                            $User->image=$img;
                            break;
                        }
                    }
                        
                        
                    file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
                    header('Location:edit_infos_admin.php');
        } else{
            header('Location:edit_infos_admin.php'); 
        }
        /////image





      }
      else {
        header('Location:edit_infos_admin.php');
       }
      
     if(isset($_POST['OkNom']))
        {
              
               
               $nom=$_POST['firstName'];
               $prenom=$_POST['lastName'];

               foreach($xml->utilisateur as $User) {
                $id=$User->idU;
                if ($id==$idUser) {
                    $User->nom=$nom;
                    $User->prenom=$prenom;
                    break;
                  }
               }
                
                
            file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
            header('Location:edit_infos_admin.php');
 
          
        }
        else {
          header('Location:edit_infos_admin.php');
         }

        if(isset($_POST['OkSexe']))
            {
               
               $sexe=$_POST['sexe'];
               foreach($xml->utilisateur as $User) {
                $id=$User->idU;
                if ($id==$idUser) {
                    $User->sexe=$sexe;
                    break;
                  }
               }
                
                
            file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
            header('Location:edit_infos_admin.php');
 
  
          
            } 
            else{
              header('Location:edit_infos_admin.php');
             }


            if(isset($_POST['Okemail']))
            {
              
               $email=$_POST['email'];
               $i=0;

               foreach($xml->utilisateur as $User) {
                $id=$User->idU;
                $g=$User->gmail;
                if ($id!=$idUser && $g==$email) {
                    $i=$i+1;
                  }
               }
              
               if ($i==0) {
                foreach($xml->utilisateur as $User) {
                    $id=$User->idU;
                    if ($id==$idUser) {
                        $User->gmail=$email;
                        break;
                      }
                   }
                    
                    
                file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
                unset($_SESSION['cAdmin']);
                header('Location:Register.php');
               }else {
                header('Location:edit_infos_admin.php');
               }
               
              
 
                
          
             }
             else {
              header('Location:edit_infos_admin.php');
             }


             if(isset($_POST['OkTel']))
            {
             
               $Tel=$_POST['tel'];

              

               foreach($xml->utilisateur as $User) {
                $id=$User->idU;
                if ($id==$idUser) {
                    $User->tele=$Tel;
                    break;
                  }
               }
                
                
            file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
            header('Location:edit_infos_admin.php');
 
                
          
            }
            else {
              header('Location:edit_infos_admin.php');
             }


            
            if(isset($_POST['OkPass']))
             {
             
               $pass=$_POST['pass'];
               $passConf=$_POST['passconfirmer'];
 
                
                if ($pass==$passConf && strlen($pass)>=8) {
                    foreach($xml->utilisateur as $User) {
                        $id=$User->idU;
                        if ($id==$idUser) {
                            $User->passW=$pass;
                            break;
                          }
                       }
                        
                        
                    file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
                    unset($_SESSION['cAdmin']);
                    header('Location:Register.php');
                  }
                  else{header('Location:editPassword2.php');}
                  
              }
              else {
                header('Location:edit_infos_admin.php');
               }
              
           
           
      

















}//session
else {
  header('Location:page_Home.php');
 
}













?>