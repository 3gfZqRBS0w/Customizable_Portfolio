




<header>
  <div id="head">
    <h1 id="titre">Page d'administration</h1><br>
  </div>
</header>


<nav class="navPortfolio">
      <?php
      require("../config/redirection.php");

      foreach ($CheminPageAdminNonConnecte as $key => $value) {
        echo ("<a  href='" . $value . "' class='nav-link' aria-current='page'>" . $key . "</a>");
      }
      ?>
</nav>
