<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

require_once("../../config/basededonnee.php") ;
require_once("../../config/redirection.php") ;
require_once("../../config/recuperation.php") ;
require_once("../../librairies/Utility.php") ;
require_once("../../librairies/Parsedown.php") ; 
require_once("../../init.php");

?>
  <link rel="stylesheet" type="text/css" href="../../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <title>Setting</title>

    <style>
        .container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.breadcrumb {
  padding: 8px 15px;
  margin-bottom: 20px;
  list-style: none;
  background-color: #f5f5f5;
  border-radius: 4px;
}

.breadcrumb > .active {
  color: #777;
}
    </style>
</head>
<body>
    <?php
    echo(Utility::getHeader($CheminPageAdminConnecte, "Settings", "Manage Your Settings")) ;
    ?>
    <div class="container">
      <ol class="breadcrumb">
        <li class="active">Basic Setting</li>
      </ol>
    </div>
    <p>Nothing...</p>
</body>

<script src="../../script/app.js"></script>
</html>
