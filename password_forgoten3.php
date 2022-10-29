<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="css/password_forgoten3.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="title">
                <span>Entrez le code de sécurité</span>
        </div>
           <form action="password_forgoten3.php?code=<?php echo $_GET['code']; ?>&idu=<?php echo $_GET['idu']; ?>" method="Post">
        <div class="input">
                <span>Vous avez dû recevoir un texto avec un code sur votre gmail. Ce code contient 8 caractères.</span>
                <input type="text" name="cd" placeholder="Entrez le code">
        </div>
        <div class="rechercher">
                <button type="reset" id="reset">Annuler</button>
                <button type="submit" name="btn" id="submit">Continuer</button>
            </form>
            <?php
               if (isset($_POST['btn'])) {
                    
                  if ($_GET['code']==MD5($_POST['cd']) ) {
                    $id=$_GET['idu'];
                    header('Location:editPasswordOublier.php?idU='.$id);
                   }else {
                    echo '<script type="text/javascript">
                    swal({
                          title:"Code pas correct",
                          text:"Vous avez cliqué sur le bouton!",
                          icon:"error"
                              });
                    </script>';
                   }
                   
                

               }

            ?>
        </div>
    </div>
</body>
</html>