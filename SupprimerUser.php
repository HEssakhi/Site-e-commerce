<?php
        if (!empty($_GET["cin"]) && isset($_GET["cin"])) {
            $cin=$_GET["cin"];
            $xml=simplexml_load_file("BDXML/utilisateurs.xml");
            $xml1=simplexml_load_file("BDXML/commandes.xml");
            $index=0;
            $i=0; 
            
            $tab=array();                   
            foreach($xml->utilisateur as $User) {
                
                if ($cin==$User[0]->idU) {
                    $index=$i;
                  }
                $i++;
            }
            unset($xml->utilisateur[$index]);
            file_put_contents('BDXML/utilisateurs.xml',$xml->asXml());
            //supp commande
            foreach($xml1->commande as $cmd) {
                
                if ($cin==$cmd[0]->idU) {
                    $tab[]=$cmd[0]->NumCmd;
                  }
            }
       
            for ($j=0; $j < count($tab); $j++) { 
                $index1=0;
                $i1=0;  
                foreach($xml1->commande as $cmd) {
                
                    if ($cin==$cmd[0]->idU) {
                        $index1=$i1;
                    }
                    $i1++;
                }
                unset($xml1->commande[$index1]);
                file_put_contents('BDXML/commandes.xml',$xml1->asXml());
                
            }
            //
            
            
            header('Location:utilisateurs.php');
        }
        else {
            header('Location:utilisateurs.php');
        }
        
       











?>