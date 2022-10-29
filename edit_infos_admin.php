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
        <link rel="stylesheet" href="assetsAdmin/css/edit_infos_admin.css">
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 


        <!-- BOX ICONS CSS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <title>Modifier inormations</title>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    </head>
    <body id="body">
    <!-------------------------------modals----------------------->
        <!---modal popup-pour le nom et prenom-->
 <div class="modal" id="modal-wrapper">
	<form action="Modifier.php" method="Post" id="form">
		<div class="form-group">
			<div class="titre">Modifier le nom</div>
			 <div class="f1">
			<input type="text" name="firstName" id="firstName" class="form-control" placeholder="Nom">
			<label for="firstName">Nom</label>
			 </div>
             <span id="erreur_prenom"></span>
			 <div class="f2">
			<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Prénom">
			<label for="lastName">Prénom</label>
			</div>
            <span id="erreur_nom"></span>
			<div class="imgcontainer">
				<span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp"><i class='bx bx-plus' ></i></span>
			</div>
			<div class="but">
			   <input type="reset" value="Annuler" onclick="document.getElementById('modal-wrapper').style.display='none'">
			   <input type="submit" value="Ok"  name="OkNom" id="update">
			</div>
		</div>
	</form>
</div>
<!---------------------------end modal popup pour le nom-->

<!--------modal popup pour le sexe---->
<div class="modal-sexe" id="modal-wrapper-sexe">
	<form action="Modifier.php" method="Post" >
		<div class="form-box">
			<div class="titre">Modifier le Sexe</div>
		 <div class="form-radio">
				<label>
					 <input type="radio" checked name="sexe" value="Homme">
					 <div class="circle"></div>
					 <span>Homme</span>
				</label>
				<label id="rad_2">
					 <input type="radio" name="sexe" value="Femme">
					 <div class="circle"></div>
					 <span>Femme</span>
				</label>
		 </div>
			<div class="imgcontainersexe">
				<span onclick="document.getElementById('modal-wrapper-sexe').style.display='none'" class="closesexe" title="Close PopUp"><i class='bx bx-plus' ></i></span>
			</div>
			<div class="butsexe">
			   <input type="reset" value="Annuler" onclick="document.getElementById('modal-wrapper-sexe').style.display='none'">
			   <input type="submit" value="Ok" id="update" name="OkSexe">
			</div>
		</div>
	</form>
</div>
<!--------end modal popup pour le sexe---->

<!--------modal popup pour l'email---->
<div class="modal-email" id="modal-wrapper-email">
	<form action="Modifier.php" method="Post"  id="form_email">
		<div class="form-group5">
			<div class="titre">Modifier Adresse e-mail</div>
			 <div class="f5">
			<input type="text" name="email" id="email" class="form-control" placeholder="@exemple.com">
			<label for="email">Adresse e-mail</label>
			 </div>
             <span id="erreur_email"></span>
			<div class="imgcontainer5">
				<span onclick="document.getElementById('modal-wrapper-email').style.display='none'" class="close5" title="Close PopUp"><i class='bx bx-plus' ></i></span>
			</div>
			<div class="but5">
			   <input type="reset" value="Annuler" onclick="document.getElementById('modal-wrapper-email').style.display='none'">
			   <input type="submit" value="Ok" name="Okemail" id="update">
			</div>
		</div>
	</form>
</div>
<!--------end modal popup pour l'email---->

<!--------modal popup pour le numéro de telephone---->
<div class="modal-tel" id="modal-wrapper-tel">
	<form action="Modifier.php" method="Post" id="form_tel">
		<div class="form-group3">
			<div class="titre">Modifier le N° de téléphone</div>
			 <div class="f4">
			<input type="tel" name="tel" id="tel" class="form-control" placeholder="(+212)___">
			<label for="tel">Téléphone</label>
			 </div>
             <span id="erreur_tel"></span>
			<div class="imgcontainer3">
				<span onclick="document.getElementById('modal-wrapper-tel').style.display='none'" class="close3" title="Close PopUp"><i class='bx bx-plus' ></i></span>
			</div>
			<div class="but3">
			   <input type="reset" value="Annuler" onclick="document.getElementById('modal-wrapper-tel').style.display='none'">
			   <input type="submit" value="Ok" name="OkTel" id="update">
			</div>
		</div>
	</form>
</div>
<!--------end modal popup pour le numéro de telephone---->
<!-------------------------------------end modals------------------------>
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
                        
                        <a href="edit_infos_admin.php" class="nav__link  active">
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
        <?php

            foreach($xml->utilisateur as $User) {
 
                if ($idUser==$User[0]->idU) {
                    
                  $nom=$User[0]->nom." ".$User[0]->prenom;
                  $sexe=$User[0]->sexe;
                  $gmail=$User[0]->gmail;
                  $tele=$User[0]->tele;
                  $image=$User[0]->image;
 
                }
         
               } 



        ?>
        <main id="main">
            <section class="infos">
              <h2 id="infos-text" >Informations personnelles</h2>  
              <p id="titre">
                Informations de base d'administrateur <?php echo $nom; ?> (nom, photo, etc.)
             </p>
             <div class="infos-container">
                 <h3>Profil</h3>

                  <div class="profil-img">
                       <form action="Modifier.php" method="Post" enctype="multipart/form-data">
                       <div class="qws">photo</div>
                       <div class="anwser" id="remarque">Personnalisez votre compte en ajoutant une photo</div>
                        <div id="validation"> 
                            <button type="submit" class="btn" id="val" name="OkImage">Valider</button> 
                            <button type="reset" class="btn" id="reset">Annuler</button> 
                        </div>    
                       <div class="pro-img">
                           <div class="photo">
                               <?php
                                  if ($image=="null") {
                                      echo '<img src="assets/images/profile.jpg"  id="profiledisplay" onclick="triggerclick()">';
                                  }
                                  else {
                                       echo '<img src="media/imageU/'.$image.'"  id="profiledisplay" onclick="triggerclick()">';
                                  }

                               ?>
                               
                            </div> 
                           <i class='bx bx-image-add' ></i>
                           <input type="file" name="photo" onchange="displayimage(this)" id="profileimage" accept="image/*">
                       </div>
                      </form>

                  </div>
                  <div class="profil-infos">
                    <div class="qws">nom</div>
                     <div class="answer" ><?php echo $nom; ?></div>
                     <a href="#" class="edit"><i class='bx bx-pencil nav__icon'  onclick="document.getElementById('modal-wrapper').style.display='block'" ></i></a>
                 </div>
                 <div class="profil-infos">
                    <div class="qws">SEXE</div>
                     <div class="answer" ><?php echo $sexe; ?></div>
                     <a href="#" class="edit"><i class='bx bx-pencil nav__icon'  onclick="document.getElementById('modal-wrapper-sexe').style.display='block'" ></i></a>
                 </div>
                 <div class="profil-infos">
                    <div class="qws">MOT DE PASSE</div>
                     <div class="answer" >*******</div>
                     <a href="editPassword1.php" class="edit"><i class='bx bx-pencil nav__icon' ></i></a>
                 </div>
             </div>
            <div class="infos-container">
                <h3>Coordonnées</h3>  
                <div class="profil-infos">
                    <div class="qws">ADRESSES E-MAIL</div>
                     <div class="answer"><?php echo $gmail; ?></div>
                     <a href="#" class="edit"><i class='bx bx-pencil nav__icon'  onclick="document.getElementById('modal-wrapper-email').style.display='block'" ></i></a>
                </div>
                <div class="profil-infos">
                    <div class="qws">Téléphone</div>
                     <div class="answer"><?php echo $tele; ?></div>
                     <a href="#" class="edit"><i class='bx bx-pencil nav__icon'  onclick="document.getElementById('modal-wrapper-tel').style.display='block'" ></i></a>
                </div>
            </div>
            </section>
           
        </main>
        
    </body>
    <!-- MAIN JS -->
    <script src="assetsAdmin/js/main.js"></script>
    <script src="assetsAdmin/js/edit_infos_admin.js"></script>


</html>