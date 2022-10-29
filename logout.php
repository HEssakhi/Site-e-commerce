<?php

session_start();

 if (isset($_SESSION['c'])) {
     
     unset($_SESSION['c']);
     

    // header('Location:Register.php');
     echo "<script>location.href='page_Home.php'</script>";
 }
 else
 {

//header('Location:Register.php');
 echo "<script>location.href='page_Home.php'</script>";


 }
 //admin
 if (isset($_SESSION['cAdmin'])) {
     
    unset($_SESSION['cAdmin']);
    

   // header('Location:Register.php');
    echo "<script>location.href='page_Home.php'</script>";
}
else
{

//header('Location:Register.php');
echo "<script>location.href='page_Home.php'</script>";


}







?>