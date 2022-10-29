
<?php

//fetch_comment.php

$output = '';

//////////////

 //affichage
 $xml1=simplexml_load_file("BDXML/commentaires.xml");
 $idpro=$_POST['idpro'];
 
 $xml2=simplexml_load_file("BDXML/utilisateurs.xml");

  //
  $tab=array();
 foreach($xml2->utilisateur as $User) {
   $tab[]=$User[0]->idU.",".$User[0]->nom." ".$User[0]->prenom.",".$User[0]->image;
 } 
  // 


 $nomu="";
 $ta=array();
 foreach($xml1->commentaire as $cmt) {
   $idp=$cmt[0]->idPro;
   
   if ($idp==$idpro) {
     $idu=$cmt[0]->idU;     
     $cmmt=$cmt[0]->cmt;
     $dt=$cmt[0]->date;
     
     $ta=array();
     for ($i=0; $i < count($tab); $i++) { 
       $ta=explode(",",$tab[$i]);
       if ($idu==$ta[0]) {
          $nomu=$ta[1];
          $image=$ta[2];
       }
      }

       /// image

    if ($image=="null") {
     $a='<img src="img/profile.jpg"  alt="">';
    }
    else {
      $a='<img src="media/imageU/'.$image.'"  alt="">';
    }
    ///

    $output .= '<div class="read_comment">
     <div class="comment_writer">
       '.$a.'
       <div class="writer_infos">
         <span id="name">'.$nomu.'</span>
         <span id="time">'.$dt.'</span>
       </div>
     </div>
     <div class="comment_content">
       <span>
       '.$cmmt.'
       </span>
     </div>
      </div>';

     }


  
   }

/////////////

echo $output;




?>