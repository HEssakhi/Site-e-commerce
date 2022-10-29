<?php
session_start();
 if (isset($_SESSION['c'])) {
    $xml=simplexml_load_file("BDXML/utilisateurs.xml");
    $cin=$_SESSION['c'];
    foreach($xml->utilisateur as $User) {
  
        if ($cin==$User[0]->idU) {
          $nom=$User[0]->nom." ".$User[0]->prenom;
          $image=$User[0]->image;
        }

       }  
}
else {
   header('Location:Register.php');
   $nom="";
}

if(isset($_SESSION['cAdmin'])) {
    header('Location:Accueil.php'); 
}

if (!empty($_GET['idcmd']) && !empty($_GET['mon'])) {
    $idcmd=$_GET['idcmd'];
    $montant=$_GET['mon']+49;
}
else {
    header('Location:Accueil.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal</title>
    <link rel="stylesheet" href="css/paypal.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
    <div class="pay_container">
        <div class="pay_title">
            <span>Chère client</span>
            <span id="user_name"><?php echo $nom; ?></span>
        </div>
        <div class="description">
            <span>Nous vous informer que vous avez choisi le service paypal tant que mode de paiement,
                pour ce faire voyez chère client de suivre les étapes suivants.
            </span>
        </div>
        <div class="pay_montant">
       
            <span id="tit">Montant total:</span>
            <span id="mont"><?php echo $montant; ?> MAD</span>
        </div>

        <!--------------div vide---------->

        <div  id="paypal-button-container">
            
        </div>
    </div>
     <!-- Add the checkout buttons, set up the order and approve the order -->
     <script src="https://www.paypal.com/sdk/js?client-id=ASfKRmLvJMcFnoJFcYwukmtEpBuhyeZ5skyAPyzfro5AZffolg9NITaUxCr43tpQ6rvFUD2vQwbq9H4i&disable-funding=card"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
     <script>

var val=<?php echo $montant; ?>;
paypal.Buttons({
  createOrder: function(data, actions) {
    return actions.order.create({
      purchase_units: [{
        amount: {
          value: val/10
        }
      }]
    });
  },
  onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
      alert('Transaction réalisée par ' + details.payer.name.given_name);

      window.location.replace("modifierPay.php?idcmd=<?php echo $idcmd; ?>");
        
    
    });
  }
}).render('#paypal-button-container'); // Display payment options on your web page
</script>

</body>
</html>