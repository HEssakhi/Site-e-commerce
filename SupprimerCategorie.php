<?php
  
    

       if (!empty($_GET["idC"]) && isset($_GET["idC"])) {
        $idC=$_GET["idC"];
        $xml=simplexml_load_file("BDXML/Categories.xml");
        $xml1=simplexml_load_file("BDXML/produits.xml");
        $index=0;
        $i=0; 
        $tab=array(); 

        foreach($xml->Categorie as $Cat) {
           if ($idC==$Cat[0]->idCat) {
            $index=$i;
          }
          $i++;
        } 
        unset($xml->Categorie[$index]);
        file_put_contents('BDXML/Categories.xml',$xml->asXml());
        //supp PRODUIT
        foreach($xml1->produit as $pro) {
            if ($idC==$pro[0]->idCat) {
                $tab[]=$pro[0]->idCat;
              }
        }
        for ($j=0; $j < count($tab); $j++) { 
            $index1=0;
            $i1=0;  
            foreach($xml1->produit as $pro) {
            
                if ($idC==$pro[0]->idCat) {
                    $index1=$i1;
                }
                $i1++;
            }
            unset($xml1->produit[$index1]);
            file_put_contents('BDXML/produits.xml',$xml1->asXml());
            
        }
        //







        header('Location:Catégories.php');



       }
       else {
        header('Location:Catégories.php');   
       }


  




?>