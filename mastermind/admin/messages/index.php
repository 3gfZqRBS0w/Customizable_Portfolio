<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start();

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require_once("../../../init.php");

    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]) && ( !$Owner->CheckQRCode() || isset($_SESSION["qrCode"])) )) {
            header('Location: ../../../index.php');
    }
    ?>
    <link rel="stylesheet" type="text/css" href="../../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/panel.css">
</head>
<body>

<?php

if (isset($_POST["yesTreatsMessage"])) {
    $Contact->TreatsMessage(true,$_POST["yesTreatsMessage"],$config["recuperation"]["email"],$message[0] ) ;
    header('Location: ../../index.php');
 }
 elseif(isset($_POST["noTreatsMessage"])) {
   $Contact->TreatsMessage(false,$_POST["noTreatsMessage"],NULL,NULL ) ;
   header('Location: ../../index.php');
 }

if ( isset($_POST["checkMessage"]) ) {
    $message = $Contact->GetMessage($_POST['checkMessage']) ;
echo(Utility::getHeader($config["redirection"]["return"], "Mail validation", "")) ; 
    echo(" 
    
    <div class='container'>
     <div>
     <div class='bloc previewArticle' id='bloc1'>   
       <div id='container1'>
        <div style='border: 2px solid; border-radius: 30px; background-color: white; padding: 2rem; ' id='blocTexte1'>
        <p><b>Full Name :</b></p> ".htmlspecialchars($message[0]["fullName"])."
        <p><b>E-Mail :</b></p> ".htmlspecialchars($message[0]["email"])."
        <p><b>Numéro :</b></p> ".htmlspecialchars($message[0]["num"])."
        <p><b>Objet :</b></p> ".htmlspecialchars($message[0]["title"])."
        <p><b>Message :</b></p> ".htmlspecialchars($message[0]["message"])."
         </div>

         <div>
         <form method='post' action=''>
         <button name='yesTreatsMessage' value='".$_POST["checkMessage"]."' id='accepter' type='submit'> <img id='yes' src='../../../assets/yes.png'> </button>
         <button name='noTreatsMessage' value='".$_POST["checkMessage"]."' id='refuser' type='submit'><img id='no' src='../../../assets/no.png'></button>
         </form>
         
         </div>
         </div>     
     </div>
    </div>
    
    
    
    
    ") ; 
} else {
    header('Location: ../../index.php');
}
?>
    
</body>

<script src="../../../script/markdown.js"></script>
<script src="../../../script/app.js"></script>
</html>