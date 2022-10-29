<?php
session_start();
if (isset($_SESSION['cAdmin'])) {
   $xml=simplexml_load_file("BDXML/utilisateurs.xml");
   $cin=$_SESSION['cAdmin'];
   foreach($xml->utilisateur as $User) {
 
       if ($cin==$User[0]->idU) {
         $nom=$User[0]->nom." ".$User[0]->prenom;
       }

      }  
}
else {
  header('Location:page_Home.php');
  $nom="";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- STYLES CSS -->
        <link rel="stylesheet" href="assetsAdmin/css/styles&accueil.css"> 
        <link rel="stylesheet" href="assetsAdmin/css/catégories.css"> 
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="assetsAdmin/js/liste reservation.js"></script>
        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>Catégories</title>
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
                        <a href="utilisateurs.php" class="nav__link" title="Utilisateurs">
                            <i class='bx bx-id-card nav__icon' ></i>
                            <span class="nav__text">Utilisateurs</span>
                        </a>
                        <a href="catégories.php" class="nav__link active" title="Catégories">
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
                            <p>Dans cet espace vous êtes capable de voir tout les catégories exist, aussi de le supprimer et ajouter.</p>
                           </div>
                       </div>

                       <div class="principal">
                           <div class="barre-test">
                              
                              <a href="Catégories.php" title="Actualiser"><i class="bx bx-refresh refresh"></i></a>
                              <div class="barre-border"></div>   
                           </div> 

                           <div class="list">

                            <!---->
                            <?php
                               $xml=simplexml_load_file("BDXML/Categories.xml");

                                foreach($xml->Categorie as $Cat) {
                                   $id=$Cat[0]->idCat;
                                   $nom=$Cat[0]->nomCat;

                                   echo '<div class="list-item">
                                   <div class="items">
                                       <div class="cat_name">'.$nom.'</div>
                                   </div>
                                   <div class="suppression">
                                      
                                      <a href="SupprimerCategorie.php?idC='.$id.'" title="Supprimer"><i class="bx bx-trash trash"></i></a>
                                   </div>
                           </div> ';
                                }

                            ?>  
                           
                              

                              <!---->
                                         
                           </div>
                       </div>
                       
                   </div>
                   
                   <div class="border_vide"></div>
                   <div class="ajouter_catégorie">
                        <p><ion-icon name="add-outline" class="add"></ion-icon><span>Ajouter un nouveau Catégorie </span></p>
                   </div>
                   <div class="formulaire">
                    <form action="" method="POST">
                       <div class="form_container">
                           <div class="cate_title">
                              <div class="petit_titre">
                                  <span>Nouvel Catégorie</span>
                              </div>
                              <div class="add_cate">
                                 <input type="text" name="cate" id="cate" placeholder="Intitulé de catégorie">
                              </div>
                           </div>
                           <div class="submit">
                               <div class="border_vide_2"></div>
                            <div class="cate_button">
                               <button type="submit" name="btn">Ajouter</button>
                            </div>
                          </div>
                       </div>

                    </form>
                    <?php
                      
                        
                       //$xml=simplexml_load_file("BDXML/categories/Categories.xml");
                    
         if(isset($_POST["btn"])) {
             if(isset($_POST["cate"]) && !empty($_POST["cate"])) {
                            $test=0; 
                            $xml=simplexml_load_file("BDXML/Categories.xml");
                            foreach($xml->Categorie as $Cat) { 
                              $nom=$Cat[0]->nomCat;
                              if (strtolower($nom)==strtolower($_POST["cate"])) {
                                  $test=1;
                                  break;
                              }
                            }

                 if ($test==0) {
                            
                           
                        //compteur
                        if(!file_exists("compteur/cmpCat.txt"))
                        {
                            $fp=fopen("compteur/cmpCat.txt","w");
                            $cp=1;
                            
                        }
                        else{
                            $fp=fopen("compteur/cmpCat.txt","r+");
                            $cp=fgets($fp,255);
                            $cp++;
                        }
                   
                        fseek($fp,0);
                        fputs($fp,$cp);
                        fclose($fp);
                        //

                        $categorie=$xml->addChild('Categorie');
                        $categorie->addChild('idCat',$cp);
                        $categorie->addChild('nomCat',$_POST["cate"]);
                        file_put_contents('BDXML/Categories.xml',$xml->asXml());
                        echo("<meta http-equiv='refresh' content='0'>");

                    }
                    else {
                        echo '<script type="text/javascript">
                        swal({
                              title:"Categorie déjà exist",
                              text:"Vous avez cliqué sur le bouton!",
                              icon:"error"
                                  });
                        </script>';
                    }




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
            $(".ajouter_catégorie").click(function(){
            $(".formulaire").slideToggle("slow");
            });
        });
</script>
</html>