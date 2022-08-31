<?php
session_start();


require_once("../config/basededonnee.php") ;
require_once("../config/redirection.php") ;
require_once("../config/recuperation.php") ;
require_once("../librairies/Utility.php") ;
require_once("../librairies/Parsedown.php") ; 
require_once("../init.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/admin.css">

  <style>
        .notification {
      

      text-align: center;
      position: absolute;
      width: 100vw;

    }
  </style>
  <title>Admin Page</title>
</head>

<body>
<?php
     
// jmvB6sQ*yPjdBZS(1P1xkeuhq7XFiytFNF*4)G)bQh*WgY.E0KgiMXo]d9Z[nQ[M4vL.n.TiGiFC8)9jnV4.1-2QW66gwf-CttnEU-NSVWH*YUJNPXTf6UK[*RJMvx[( password
     if (isset($_SESSION["codeSecret"])) {
      header('Location: admin/dashboard.php');
     }
     else {
      echo(Utility::getHeader($CheminPageAdminNonConnecte, "ADMIN AREA", "LOGIN PAGE")) ; 
      if ( isset($_POST["password"]) ) {
        if (hash('sha256', $_POST["password"]) == Utility::getValueOfPrimaryData($bdd, "secretCode") ) {
          echo("<p class='notification' style='background-color: green;'>Mot de passe correct. redirection dans cinq secondes </p>") ; 
          $_SESSION['codeSecret'] = $_POST["password"]  ;
          header("Refresh: 5;url=index.php");
        }
        else {
          echo("<p class='notification' style='background-color: red;' >Mot de passe incorrect.</p>") ;
        }
        
       }
       echo(Utility::getLoginPage()) ;
     }


    ?>

</body>


</html>

<script src="../script/app.js"></script>

