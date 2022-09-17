<?php
session_start();


require_once("../config/basededonnee.php");
require_once("../config/redirection.php");
require_once("../config/recuperation.php");
require_once("../librairies/Utility.php");
require_once("../librairies/Parsedown.php");
require_once("../init.php");

?>



<!DOCTYPE html>
<html lang="en">

<head></head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../styles/main.css">
<link rel="stylesheet" type="text/css" href="../styles/admin.css">
<title>Admin Page</title>
</head>

<body>
  <?php
  if (isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"])) {
    header('Location: admin/dashboard.php');
  } else {
    echo (Utility::getHeader($CheminPageAdminNonConnecte, "ADMIN AREA", "LOGIN PAGE"));
    if (isset($_POST['g-recaptcha-response'])) {

      $secretKey = SECRET_KEY;

      $captcha = $_POST['g-recaptcha-response'];

      $ip = $_SERVER['REMOTE_ADDR'];

      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

      $responseKeys = json_decode(@file_get_contents($url, false), true);

      if ($responseKeys["success"]) {
        if (isset($_POST["password"])) {
          if (!Utility::potentiallyBruteForceAttack($bdd, $ip)) {
            if (hash('sha256', $_POST["password"]) == Utility::getOwnerData($bdd, "secretCode")) {
              echo ("<p class='notification' style='position: absolute;background-color: green;'>Mot de passe correct. redirection dans cinq secondes </p>");
              $_SESSION['codeSecret'] = $_POST["password"];
              Utility::addlog($bdd, 3);
              header("Refresh: 5;url=index.php");
            }
            else {
              echo ("<p class='notification' style='position: absolute;background-color: red;' >Mot de passe incorrect.</p>");
              Utility::addlog($bdd, 2);
            }
          }
            else {
              echo ("<p class='notification' style='position: absolute;background-color: red;' >Trop de tentative</p>");
            }

            // PROBLEME ICI A CORRIGER
          }      else {
            echo ("<p class='notification' style='position: absolute;background-color: orange;' >Captcha incorrect.</p>");
          }
        } 
        else {
          echo ("<p class='notification' style='position: absolute;background-color: orange;' >Captcha incorrect.</p>");
        }
      }
    }
    echo (Utility::getLoginPage()); 



  ?>

</body>


</html>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="../script/app.js"></script>