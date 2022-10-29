<?php
session_start();


function modif_qte($ref_article, $qte,$taille)
{

    
    $nb_articles = count($_SESSION['panier']['id']);
    $ajoute = false;
    $ta=$_POST["ta"];
    $qt=$_POST["qt"];
    $tab=array();

    $a=false;

    
    for($i = 0; $i < $nb_articles; $i++)
    {
        if($_SESSION['panier']['id'][$i]==$ref_article && $_SESSION['panier']['taille'][$i]!=$ta)
        {
           $tab[]=$_SESSION['panier']['taille'][$i];
        }
    }

    
    for($i = 0; $i < count($tab); $i++)
    {
        if($tab[$i]==$taille)
        {
           $a=true;
        }
    }
     

   if ($a==false) {
       
   
    for($i = 0; $i < $nb_articles; $i++)
    {
        if($_SESSION['panier']['id'][$i]==$ref_article && $_SESSION['panier']['taille'][$i]==$ta && $_SESSION['panier']['qte'][$i]==$qt)
        {
            $_SESSION['panier']['qte'][$i] = $qte;
            $_SESSION['panier']['taille'][$i] = $taille;
            $ajoute = true;
        }
    }

   }
    return $ajoute;
}

//
function modif_qte1($ref_article, $qte,$taille)
{

    $nb_articles = count($_SESSION['panier']['id']);
    
    $ajoute = false;
     
    for($i = 0; $i < $nb_articles; $i++)
    {
        if($_SESSION['panier']['id'][$i]==$ref_article)
        {
            $_SESSION['panier']['qte'][$i] = $qte;
            $_SESSION['panier']['taille'][$i] = $taille;
            $ajoute = true;
        }
    }
    return $ajoute;
}
//

function supprim_article($ref_article,$taille)
{
    
    $suppression = false;
   
    $panier_tmp = array("id"=>array(),"qte"=>array(),"taille"=>array(),"prix"=>array());
    
    $nb_articles = count($_SESSION['panier']['id']);
    
    for($i = 0; $i < $nb_articles; $i++)
    {
       
        if($_SESSION['panier']['id'][$i] != $ref_article || $_SESSION['panier']['taille'][$i]!=$taille)
        {
            array_push($panier_tmp['id'],$_SESSION['panier']['id'][$i]);
            array_push($panier_tmp['qte'],$_SESSION['panier']['qte'][$i]);
            array_push($panier_tmp['taille'],$_SESSION['panier']['taille'][$i]);
            array_push($panier_tmp['prix'],$_SESSION['panier']['prix'][$i]);
        }
    }
    
    $_SESSION['panier'] = $panier_tmp;
    
    unset($panier_tmp);
    $suppression = true;
    return $suppression;
}
function vider_panier()
{
    $vide = false;
    unset($_SESSION['panier']);
    if(!isset($_SESSION['panier']))
    {
        $vide = true;
    }
    return $vide;
}



 if (isset($_POST["supprimer"])) {
    $vider = vider_panier();
    header('Location:page_panier.php');
 }
 else if(isset($_POST["commander"])) {

    if (isset($_SESSION['c']) && !empty($_POST["adresse"]) && !empty($_POST["codep"]) && !empty($_POST["ville"]) && isset($_POST["modep"]) && !empty($_POST["modep"])) {
       // header('Location:page_panier.php');
     if(isset($_SESSION['panier']))
       { 
        //compteur cmd
        if(!file_exists("compteur/cmpCmd.txt"))
        {
            $fp=fopen("compteur/cmpCmd.txt","w");
            $cp=1;
            
        }
        else{
            $fp=fopen("compteur/cmpCmd.txt","r+");
            $cp=fgets($fp,255);
            $cp++;
        }
   
        fseek($fp,0);
        fputs($fp,$cp);
        fclose($fp);
        //
        //compteur liv
        if(!file_exists("compteur/cmpLiv.txt"))
        {
            $fp2=fopen("compteur/cmpLiv.txt","w");
            $cp2=1;
            
        }
        else{
            $fp2=fopen("compteur/cmpLiv.txt","r+");
            $cp2=fgets($fp2,255);
            $cp2++;
        }
   
        fseek($fp2,0);
        fputs($fp2,$cp2);
        fclose($fp2);
        //

        
       $xml=simplexml_load_file("BDXML/commandes.xml");
       $commande=$xml->addChild('commande');
       $commande->addChild('NumCmd',$cp);
       $commande->addChild('idU',$_SESSION['c']);
       $commande->addChild('dateCmd',date("d/m/Y"));
       $commande->addChild('etat',"en cours");

        
       $nb_articles = count($_SESSION['panier']['id']);
       
       for($i = 0; $i < $nb_articles; $i++)
          {
             $id=$_SESSION['panier']['id'][$i];
             $qte=$_SESSION['panier']['qte'][$i];
             $ta=$_SESSION['panier']['taille'][$i];

             $pro=$commande->addChild('Pro');
             $pro->addChild('idPro',$id);
             $pro->addChild('qte',$qte);
             $pro->addChild('taille',$ta);

        
          }
          $commande->addChild('paiement',"non");
          file_put_contents('BDXML/commandes.xml',$xml->asXml());

          //ajouter liv
          $xml1=simplexml_load_file("BDXML/livraisons.xml");
          $livraison=$xml1->addChild('livraison');
          $livraison->addChild('idLiv',$cp2);
          $livraison->addChild('idCmd',$cp);
          $livraison->addChild('dateL',"null");
          $livraison->addChild('addresse',$_POST["adresse"]);
          $livraison->addChild('codepostal',$_POST["codep"]);
          $livraison->addChild('ville',$_POST["ville"]);
          $livraison->addChild('etat',"null");
          file_put_contents('BDXML/livraisons.xml',$xml1->asXml());
          //

          
          //calcule
         
            $montant=0;
           $nb_articles = count($_SESSION['panier']['id']);
           
           for($i = 0; $i < $nb_articles; $i++)
              {      
                 $montant += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
              }
        
            $vider = vider_panier();
          //
          if ($_POST["modep"]=="pay") {
            header('Location:paiement.php?idcmd='.$cp.'&mon='.$montant);
          }
          else {
            header('Location:commandes_Cl.php');
          }
          
          //
        }//session panier
        else {
            header('Location:infos_liv.php');
        }

    }
    else {
       
     /*   if(isset($_SESSION['panier']))
         { 
           header('Location:Register.php');
         }
         else {*/
            header('Location:infos_liv.php');
         //}
    }
 }


///////////////////////////////////////////////
if (isset($_POST["retirer"])) {

    $reference = $_POST["id"];
    $tai=$_POST["ta"];
    $retrait = supprim_article($reference,$tai);
    $nb_articles = count($_SESSION['panier']['id']);
    if ($nb_articles==0) {
       
        $vider = vider_panier();
    }
    header('Location:page_panier.php');
}
else if (isset($_POST["modifie"])) {

    $xml=simplexml_load_file("BDXML/produits.xml");

    foreach($xml->produit as $pro) {
        $id=$pro[0]->idPro;
        if ($id==$_POST["id"]) {
            $stock=$pro[0]->stock;
        }
    }

    
    if (($_POST["qte"]>0 && $_POST["qte"]<=$stock) && !empty($_POST["qte"])) {

       if (verif_panier($_POST["id"],$_POST["taille"])) {

                 $id_art =$_POST["id"];
                 $nouvelle_qte = $_POST["qte"];
                 $nouvelle_taille = $_POST["taille"];
                 $modifier = modif_qte($id_art,$nouvelle_qte,$nouvelle_taille);
        }
        else {

            $modifier = modif_qte1($id_art,$nouvelle_qte,$nouvelle_taille);
        }
                          
    }
    header('Location:page_panier.php');

    

}


//fonction virefier


function verif_panier($ref_article,$taille)
            {
                /* On initialise la variable de retour */
                $present = false;
                /* On vérifie les numéros de références des articles et on compare avec l'article à vérifier */
                if( count($_SESSION['panier']['id']) > 0 && array_search($ref_article,$_SESSION['panier']['id']) !== false)
                {
                  $nb_articles = count($_SESSION['panier']['id']);
                  $tab=array();
                  for($i = 0; $i < $nb_articles; $i++)
                     {
                       if ($_SESSION['panier']['id'][$i]==$ref_article) {
                          $tab[]=$_SESSION['panier']['taille'][$i];
                       }
                     }

                  for ($j=0; $j < count($tab); $j++) { 

                          if ($_POST['ta']==$tab[$j]) {
                            $present = true;
                           }
                     }  

                }
              
                return $present;
            } 











?>