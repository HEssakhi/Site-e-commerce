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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsAdmin/css/styles&accueil.css"> 
        <link rel="stylesheet" href="assetsAdmin/css/list_livraison.css"> 
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="assetsAdmin/js/liste reservation.js"></script>
        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <title>Livraison</title>
    </head>
    <body id="body">

     
        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                       
                    <a href="acceuil.html" class="nav__logo">
                        <img src="assetsAdmin/images/logo.png" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Sport</span>
                    </a>
    
                    <div class="nav__toggle" id="nav-toggle">
                        <i class='bx bx-chevron-right'></i>
                    </div>
    
                    <ul class="nav__list">
                        <a href="Accueil.php" class="nav__link" title="Accueil">
                            <i class='bx bx-grid-alt nav__icon'></i>
                            <span class="nav__text">Accueil</span>
                        </a>
                        <a href="utilisateurs.php" class="nav__link" title="Utilisateurs">
                            <i class='bx bx-id-card nav__icon' ></i>
                            <span class="nav__text">Utilisateurs</span>
                        </a>
                        <a href="catégories.php" class="nav__link" title="Catégories">
                            <i class='bx bx-dialpad nav__icon' ></i>
                            <span class="nav__text">Catégories</span>
                        </a>
                        <a href="produits.php" class="nav__link" title="Produits">
                            <i class='bx bx-poll nav__icon'></i>
                            <span class="nav__text">Produits</span>
                        </a> 
                        <a href="commandes.php" class="nav__link" title="Commandes">
                            <i class='bx bx-cart nav__icon' ></i>
                            <span class="nav__text">Commandes</span>
                        </a>  
                        
                        <a href="edit_infos_admin.php" class="nav__link">
                            <i class='bx bx-notepad nav__icon' ></i>
                            <span class="nav__text">Êdit infos</span>
                        </a>   
                        <a href="liste_livraison.php" class="nav__link active">
                            <i class='bx bx-package nav__icon' ></i>
                            <span class="nav__text">Commandes livre</span>
                        </a>           
                    </ul>
                </div>
                <a href="logout.php" class="nav__link" id="nav-link-close">           
                    <i class='bx bx-log-out-circle nav__icon'></i>
                    <span class="nav__text">Déconnexion</span>
                </a>
            </nav>
        </div>
        <main>
           <section class="container">
                   <div class="container-wrap">
                       <div class="reservation-text">
                           <div class="logo-name">
                                <img src="assetsAdmin/images/logo.png">
                                <div class="border"></div>
                                <span class="site-nom">Sport</span>
                           </div>
                           <div class="tips">
                            <p>Dans cet espace vous êtes capable de voir et consulter tout les commandes que vous avez éffectuer.</p>
                           </div>
                       </div>
                       <div class="principal">
                           <div class="barre-test">
                           
                              <a href="liste_livraison.php" title="Actualiser"><i class="bx bx-refresh refresh"></i></a>
                              <div class="barre-border"></div>
                            <!--  <a href="#" title="Chercher" ><i class="bx bx-search-alt search" id="search"></i></a>
                                  <div class="chercher">
                                     <form action="catégories.php>" method="Post" >
                                      <button type="submit" title="Chercher" name="btn"><i class="bx bx-search-alt-2"></i></button>
                                      <input type="date" name="dt">
                                     </form>    
                                  </div>-->
                                 <a href="#" title="Annuler" id="close"><i class="bx bx-plus close"></i></a>
                           </div> 

                        <div class="commandes_cont">  

                           <?php
                             
                             $xml=simplexml_load_file("BDXML/commandes.xml");     
                             
                             $l=simplexml_load_file("BDXML/livraisons.xml");

                             foreach($l->livraison as $liv) {

                                if ($liv->dateL!="null") {
                                    $idcmd=$liv->idCmd;
                                    $datel=$liv->dateL;
                                    if ($liv->etat=="null") {
                                        $etat="en cours";
                                    }
                                    else {
                                        $etat=$liv->etat;
                                    }
                                   

                           ?>
                          

                           <div class="list">
                               <div class="list-item">
                                <a href="">
                                    <div class="items">
                                        <div class="name">N° de commande:<span><?php echo $idcmd ; ?></span></div>
                                        <div class="profession">Date Livraison:<span> <?php echo $datel ; ?></span></div>
                                        <div class="personne-sexe sexe">Etat de Livraison:<span> <?php echo $etat ; ?></span></div>
                                    </div>
                                </a>
                              </div>                     
                           </div>
                           <?php
                           }
                        }
                        ?>

                          


                       

                        </div> 

                        <!-------modifier l'etat------->
                        <div class="border_vide"></div>
                        <div class="ajouter_user">
                             <p><ion-icon name="create-outline"></ion-icon><span>Modifier l'état de livraison</span></p>
                        </div>

                        <div class="formulaire">
                            <form action="" method="POST">
                               <div class="form_container">
                                   <div class="nom_prenom_title">
                                      <div class="petit_titre">
                                          <span>Etat</span>
                                      </div>
                                      <div class="nom_prenom">
                                        <!-- <input type="text" name="idc" id="nom" placeholder="Nom">-->
                                         <select name="idc"  id="nom">
                                            <option value="null" selected disabled hidden>N° de commande</option>
                                            <?php

                                                foreach($l->livraison as $liv) {
                                                    
                                                    //$liv->dateL<date("d/m/Y") &&
                                                    if ($liv->etat=="null" && $liv->dateL!="null") {
                                                        //$liv->etat=$etat;
                                                        echo '<option value="'.$liv->idCmd.'">'.$liv->idCmd.'</option>';
                                                    }
                                                 }

                                            ?>
                                            
                                        </select>
                                        <select name="etat" id="etat">
                                            <option value="null" selected disabled hidden>Etat de livraison</option>
                                            <option value="Arrivé">Arrivé</option>
                                        </select>
                                      </div>
                                   </div>
                                   <div class="submit">
                                       <div class="border_vide_2"></div>
                                    <div class="nom_prenom">
                                       <button type="submit" name="btn">Modifier</button>
                                    </div>
                                  </div>
                               </div>
        
                            </form>
                            <?php
                             // $xml=simplexml_load_file("BDXML/commandes/commandes.xml");
                             if (isset($_POST['btn'])) {
                                if (!empty($_POST['idc']) && !empty($_POST['etat']) ) {
                                 $idc=$_POST['idc'];
                                 $etat=$_POST['etat'];
                                 $i=0;
                                foreach($l->livraison as $liv) {

                                    if ($liv->idCmd==$idc) {
                                        $liv->etat=$etat;
                                        $i=1;
                                    }
                                 }

                                 if ($i==1) {

                                     
                                    file_put_contents('BDXML/livraisons.xml',$l->asXml());
                                    //envoi msg
                                    $u=simplexml_load_file("BDXML/Utilisateurs.xml");
                                    $tab=array();
                                    //tout users
                                    foreach($u->utilisateur as $User) {
 
                                         $tab[]=$User[0]->idU.",".$User[0]->gmail.",".$User[0]->nom." ".$User[0]->prenom;
                                       
                                     }

                                     //recupere les produit
                                     $p=simplexml_load_file("BDXML/produits.xml");
                                     $tab4=array();
                                     foreach($p->produit as $pro) {
                                        $tab4[]=$pro[0]->idPro.",".$pro[0]->titre.",".$pro[0]->prix.",".$pro[0]->image;
                                     }
                                     //
                                     $a='';
                                     $image=array();
                                     foreach($xml->commande as $cmd) {
                   
                                        if ($cmd[0]->NumCmd==$idc) {
                                           
                                           //produit
                                           for ($i=0; $i < $cmd[0]->count()-5; $i++) { 
                                               $id=$cmd[0]->Pro[$i]->idPro;
                                               
                                               $ta=array();
                                               for ($j=0; $j < count($tab4); $j++) {
                                                $ta=explode(",",$tab4[$j]);
                                                $idpro=$cmd[0]->Pro[$i]->idPro;
                                                if ($ta[0]==$idpro) {
                                                    $title=$ta[1];
                                                    $prix=$ta[2];
                                                    $img=$ta[3];
                                                    //$montant+=$prix*$qte;
                                                 }
                        
                                               }//produit

                                                //espace
                                                if (($i+1)%2==0) {
                                                    $a=$a.'<td style="display: inline-block;max-width:20px;width: 100%">
                                                    &nbsp;</td>';
                                                }


                                               $a=$a.'<td style="display: inline-block;max-width:270px;width: 100%" align="center">
                                               <img src="cid:BAN'.$i.'" alt="problem" style="max-width: 268px;width: 100%;border:1px solid #d5d5d5">
                                               <h2 style="margin:10px 0px;font-family: sans-serif;font-size:20px;color:#000000">'.$title.'</h2>
                                               <p style="margin:0;font-size:16px;color:#444444; margin-bottom:20px"></p>
                                               </td>';
                                               $image[]='/media/imagePro/'.$img.','.'BAN'.$i;
                                              
                                            

                                            }
                                         }
                                    }

                                    ///

                       




                                    //virefier users
                                    foreach($xml->commande as $cmd) {

                                        if ($cmd->NumCmd==$idc) {

                                            $idu=$cmd->idU;
                                            $t=array();
                                            for ($j=0; $j < count($tab); $j++) { 
                                                $t=explode(",",$tab[$j]);
                                                if ($t[0]==$idu) {

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
                                                    $mail->addAddress($t[1]);
                                                    $mail->addReplyTo('sportstorebusiness@gmail.com');
                                                    $mail->isHTML(true);
                                                    $mail->Subject='Etat de votre commande';
                                                   // $mail->Body='<h1>Salut '.$t[2].' Votre commande est Arrivée</h1>';
                                                    $mail->Body='<table border="0" cellpadding="0" cellspacing="0" style="max-width: 602px;width: 100%;border:1px solid #d5d5d5" align="center">
                                                    <tr>
                                                        <td style="background-color: #fde148;padding:15px" align="center" valign="middle">
                                                            <h2 style="margin:0;font-family: sans-serif;font-size:30px;">
                                                            Salut '.strtoupper($t[2]).'
                                                            </h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:100px 30px;background-image: url("https://i10.dainikbhaskar.com/thumbnails/730x548/web2images/www.bhaskar.com/2016/11/24/evoke_socks-4_1479993435.jpg");background-size: cover;background-position: center;" align="center" valign="middle">
                                                            <h1 style="color:#ffffff;font-family: sans-serif;text-shadow:1px 1px #444444;margin:20px 0px">The Perfect Way to Style in 2020</h1>
                                                            <a href="http://localhost/Site e-commerce/page_Home.php" style="display: inline-block;background-color: #fde148;text-decoration: none;padding:12px 30px;text-decoration: none;font-family: sans-serif;font-weight: bold;color:#000000;margin-bottom:15px;border-radius: 5px">ACHETER UNE NOUVELLE COLLECTION ICI </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #ffffff;padding:0px 20px" align="center">
                                                             <h3 style="font-size:25px;font-family: sans-serif;margin:25px 0px 20px">Votre commande est Arrivée</h3>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" align="middle">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;background-color: #ffffff;padding: 20px; text-align: center;">
                                                               <tr>
                                                                   '.$a.'
                                                 
                                                               </tr>
                                                            </table>
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
                                                  $img1=array();
                                                  for ($j=0; $j < count($image); $j++) {
                                                    $img1=explode(',',$image[$j]);
                                                    $mail->AddEmbeddedImage(dirname(__FILE__) .  $img1[0], $img1[1]);

                                                  }
                                                   
                                                    $mail->send();

                                                    
                                                    
                                                }
                                            }
                                           
                                        }

                                    }
                                    echo("<meta http-equiv='refresh' content='0'>");
                                    





                                 }
                                     
                                
                                
                                }
                             


                             }
                            ?>
                              
                          </div>
                       </div>
                       
                   </div>
            </section>

             <!------------------in case if there is no records-----------------
             <div class="container-vide">
                <div class="image">
                    <p>
                        <span>Désolé ! aucun reservation effectués existe pour le moment.</span>   <br>
                        Déposez votre annonce gratuitement sur Inhouse aujourd'hui 
                    </p>
                </div>
             
            </div>-->
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsAdmin/js/main.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="assetsAdmin/js/annonce.js"></script>

    <!--------------script de formulaire----------->
    <script>
        $(document).ready(function(){
            $(".ajouter_user").click(function(){
            $(".formulaire").slideToggle("slow");
            });
        });
</script>
</html>