<?php
session_start();
 if (isset($_SESSION['cAdmin'])) {

    $c=$_SESSION['cAdmin'];
     
}
else {
    header('Location:page_Home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsAdmin/css/styles&accueil.css"> 
        <link rel="stylesheet" href="assetsAdmin/css/utilisateurs.css"> 
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="assetsAdmin/js/liste reservation.js"></script>
        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>Utilisateurs</title>
    </head>
    <body id="body">

     
        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                    
                    <a href="Accueil.php" class="nav__logo">
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
                        <a href="utilisateurs.php" class="nav__link  active" title="Utilisateurs">
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
                        <a href="liste_livraison.php" class="nav__link">
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
                            <p>Dans cet espace vous êtes capable de voir tout les utilisateurs aussi de les supprimer et d'ajouter.</p>
                           </div>
                       </div>
                       <div class="principal">
                           <div class="barre-test">
                           
                            <!--  <a href="SupprimerTout.php?cin=" title="Supprimer Tout"><i class="bx bx-trash trash"></i></a>-->
                              <a href="utilisateurs.php" title="Actualiser"><i class="bx bx-refresh refresh"></i></a>
                              <div class="barre-border"></div>
                              
                           </div> 

                           <div class="list">



                              <?php
                                    
                                    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
                                  
                                    foreach($xml->utilisateur as $User) {
                                         
                                        $cin=$User[0]->idU;
                                        if ($c!=$cin) {
                                            $nomp=$User[0]->prenom." ".$User[0]->nom;
                                            $fonction=$User[0]->fonction;
                                            $sexe=$User[0]->sexe;
                                            $gmail=$User[0]->gmail;
                                            
                                            echo ' <div class="list-item">
                                            <a href="Infos_utilisateurs.php?idUser='.$cin.'">
                                                <div class="items">
                                                    <div class="name">'.$nomp.'</div>
                                                    <div class="profession">'.$fonction.'</div>
                                                    <div class="personne-sexe sexe">'.$sexe.'</div>
                                                </div>
                                                <div class="suppression">
                                                   
                                                   <a href="SupprimerUser.php?cin='.$cin.'" title="Supprimer"><i class="bx bx-trash trash"></i></a>
                                                </div>
                                            </a>
                                          </div> ';
                                        }
                                       

                                      
                                    }


                              ?>



                              
                              

                           </div>
                       </div>
                       
                   </div>
                   <div class="border_vide"></div>
                   <div class="ajouter_user">
                        <p><ion-icon name="add-outline" class="add"></ion-icon><span>Ajouter un nouveau utilisateur </span></p>
                   </div>
                   <div class="formulaire">
                    <form action="utilisateurs.php" method="Post">
                       <div class="form_container">
                           <div class="nom_prenom_title">
                              <div class="petit_titre">
                                  <span>Profil</span>
                              </div>
                              <div class="nom_prenom">
                                 <input type="text" name="Nom" id="nom" placeholder="Nom">
                                 <input type="text" name="Prenom" id="prenom" placeholder="Prénom">
                                 <input type="tel" name="Tele" id="telephone" placeholder="+212">
                                 <select name="Sexe" id="sexe">
                                     <option selected hidden value="null">Sexe</option>
                                     <option value="Homme">Homme</option>
                                     <option value="Femme">Femme</option>
                                 </select>
                                <select name="profession" id="profession">
                                    <option selected hidden value="null">Profession</option>
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="client">client</option>
                                </select>
                              </div>
                           </div>
                           <div class="corrdones">
                               <div class="petit_titre">
                                  <span>Coordonnées</span>
                               </div>
                               <div class="nom_prenom">
                                <input type="email" name="Email" id="mail" placeholder="Email">
                                <input type="password" name="Pass" id="mot_de_passe" placeholder="Mot de passe">
                             </div>
                           </div>
                           <div class="submit">
                               <div class="border_vide_2"></div>
                            <div class="nom_prenom">
                               <button type="submit" name="btn">Ajouter</button>
                            </div>
                          </div>
                       </div>

                    </form>
                    <?php
                    if(isset($_POST['btn']))
                    {
                        if (!empty($_POST['Sexe']) && !empty($_POST['profession']) && !empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Tele']) && !empty($_POST['Email']) && !empty($_POST['Pass'])) {
                            
                        
                        $nom=$_POST['Nom'];
                        $prenom=$_POST['Prenom'];
                        $tele=$_POST['Tele'];
                        $gmail=$_POST['Email'];
                        $pass=$_POST['Pass'];
                        $sexe=$_POST['Sexe'];
                        $fonction=$_POST['profession'];
                        $i=0;
                        foreach($xml->utilisateur as $User) {
  
                            if ( $gmail==$User[0]->gmail) {
                               $i=1;
                             }
                        }
                      

                        
                     
                        if ($i==1) {
                            echo '<script type="text/javascript">
                            swal({
                                  title:"CIN ou Gmail déjà exist",
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
                            $utilisateur->addChild('fonction',$fonction);
                            $utilisateur->addChild('image',"null");
                            file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
                            echo("<meta http-equiv='refresh' content='0'>");
                            echo '<script type="text/javascript">
                             swal({
                                   title:"Bon travail!",
                                   text:"Vous avez cliqué sur le bouton!",
                                   icon:"success"
                                       });
                             </script>';
                        
                        }







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