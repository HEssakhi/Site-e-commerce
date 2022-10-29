<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assetsAdmin/css/edit password.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    
</head>
<body>
    <header>
        <nav>
        <div class="first">
          <div class="title">
              <a href="#">
                   <div class="logo">Sport Store</div>
                   <div class="compte">Compte</div>
              </a>
          </div>
          <div class="back-container">
              <div class="back">
                  <div class="icon"><a href="#"><i class='bx bx-chevron-left-circle' ></i></a></div>
                  <div class="phrase">Mot de passe</div>
              </div>
          </div>
      </div>
    </nav>
    </header>

    <main>
      <div class="second">
          <div class="text">
              <div class="text-one">Choisissez un mot de passe sécurisé et ne le réutilisez pas pour d'autres comptes.</div>
              <div class="text-two">Si vous modifiez ce mot de passe, vous serez déconnecté de tous vos appareils, y compris votre téléphone. Vous devrez saisir le nouveau mot de passe sur tous ces appareils.</div>
          </div>
      </div>
      <div class="third">
          <div class="form">
              <form action="Modifier.php" method="Post" id="change_pass">
              <div class="input">
                <input type="password" name="pass" id="password" class="form-control1" placeholder="Nouveau mot de passe">
                <label for="password">Nouveau mot de passe</label>
                <div class="visible"><i class="material-icons visibility">visibility_off</i></div> 
                <span class="erreur_pass1">dggeg</span>
              </div>
              
              <div class="titre">
                 <div class="titre-one">Niveau de sécurité du mot de passe : </div> 
                 <div class="titre-two">Utilisez au moins 8 caractères. Ne choisissez pas un mot de passe que vous utilisez déjà sur un autre site, ni un mot de passe trop évident, tel que le nom de votre animal de compagnie. </div>
              </div>
              <div class="input input-two" id="input-two">
                <input type="password" name="passconfirmer" id="password" class="form-control2" placeholder="Confirmer le nouveau mot de pass">
                <label for="password">Confirmer le nouveau mot de pass</label> 
                <div class="visible"><i class="material-icons visibility" id="visibility1">visibility_off</i></div> 
                <span class="erreur_pass2">dggeg</span>
             </div>
              <div class="validation">
                 <button type="submit" name="OkPass">modifier le mot de passe</button>
              </div>
              </form>
          </div>
      </div>
    </main>

    <script src="assetsAdmin/js/visibility.js"></script>  
</body>
</html>