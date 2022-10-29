
<?php

$idcmd=$_GET['idcmd'];

$xml=simplexml_load_file("BDXML/commandes.xml");
foreach($xml->commande as $cmd) {
   $num=$cmd->NumCmd;
   if ($num==$idcmd) {
       $cmd->paiement="oui";
       break;
   }
}

file_put_contents('BDXML/commandes.xml',$xml->asXml());
header('Location:commandes_Cl.php');



?>