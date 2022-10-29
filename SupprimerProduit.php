<?php
if (isset($_POST["btn"])) {
    

if (!empty($_POST["idp"]) && isset($_POST["idp"])) {
    $idp=$_POST["idp"];
    $index=0;
    $i=0; 
    $tab=array();
    $xml=simplexml_load_file("BDXML/produits.xml");
    $xml1=simplexml_load_file("BDXML/commandes.xml");

          foreach($xml->produit as $pro) {
            if ($idp==$pro[0]->idPro) {
                $index=$i;
              }
            $i++;
          }
          unset($xml->produit[$index]);
          file_put_contents('BDXML/produits.xml',$xml->asXml());

          //supp commande
        /*  $c=$xml1->commande;
          foreach($c->Pro as $pro) {
            
            if ($idp==$pro->idPro) {
                $tab[]=$pro->idPro;
              }
        }
   
        for ($j=0; $j < count($tab); $j++) { 
            $index1=0;
            $i1=0;  
            foreach($c->Pro as $pro) {
                  
                if ($idp==$pro->idPro) {
                    $index1=$i1;
                }
                $i1++;
            }
            unset($xml1->commande->Pro[$index1]);
            file_put_contents('BDXML/commandes/commandes.xml',$xml1->asXml());
            
        }*/
        //


         header('Location:produits.php');
 }
   else {
    header('Location:produits.php');
  }

}
else {
    header('Location:produits.php');
}
?>