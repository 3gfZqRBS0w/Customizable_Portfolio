



<header>
  <div id="head">
    <h1 id="titre">SITE TITLE</h1><br>
    <b><p>SITE SUBTITLE</p></b>
  </div>
</header>


<nav class="navPortfolio">
      <?php
      require("config/redirection.php");

      foreach ($CheminPage as $key => $value) {
        echo ("<a  href='" . $value . "' class='nav-link' aria-current='page'>" . $key . "</a>");
      }
      ?>
</nav>