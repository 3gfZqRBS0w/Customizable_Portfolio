<?php
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
  <title>Admin Page</title>
</head>

<body>
<?php
     echo(Utility::getHeader($CheminPageAdminNonConnecte, "ADMIN", "Admin Page")) ;
    ?>
  <div class="blocv2">
    <div class="formConnection">

      <div class="contact-form">

        <form>
          <h1>Page de connexion</h1>

          <p>
            <label>Code Secret </label>
            <input type="text" name="fullname">
          </p>
          <p>
            <button>Soumettre</button>
          </p>
        </form>
      </div>

    </div>
    <div>
      <img src="../images/lampadaire.png">
    </div>
  </div>

  </div>
  <?php
     echo(Utility::getFooter()) ;
    ?>
</body>


</html>