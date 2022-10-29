
<?php

//add_comment.php


$error = '';
$comment_name = '';
$comment_content = '';


if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 /////

 $xml1=simplexml_load_file("BDXML/commentaires.xml");


             
                //compteur
          if(!file_exists("compteur/cmpCmt.txt"))
          {
              $fp=fopen("compteur/cmpCmt.txt","w");
              $cp=1;
              
          }
          else{
              $fp=fopen("compteur/cmpCmt.txt","r+");
              $cp=fgets($fp,255);
              $cp++;
          }
     
          fseek($fp,0);
          fputs($fp,$cp);
          fclose($fp);
          //

            $commentaire=$xml1->addChild('commentaire');
            $commentaire->addChild('idCmt',$cp);
            $commentaire->addChild('cmt',$comment_content);
            $commentaire->addChild('idU',$_POST["idU"]);
            $commentaire->addChild('idPro',$_POST["idpro"]);
            $commentaire->addChild('date',date("d/m/Y"));
            file_put_contents('BDXML/commentaires.xml',$xml1->asXml());  
           // echo("<meta http-equiv='refresh' content='0'>");
 
 /////

 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>