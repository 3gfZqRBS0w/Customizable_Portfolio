<!DOCTYPE html>
<html lang="en">

<!--xr9Zk[ej.epfNx.!np(0QyMLe-yWsSFi5fTPjQi[Cp]ILccZWmGqcwsVCEKyUTL]NMKnb]gK1uH?0C)fPOTtm-6.1piX-HPLY[upwrvm1j.Q5ym0qwqN]TLrD6y*?Ty5-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

session_start();

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once("../../config/basededonnee.php");
    require_once("../../config/redirection.php");
    require_once("../../config/recuperation.php");
    require_once("../../librairies/Utility.php");
    require_once("../../librairies/Parsedown.php");
    require_once("../../init.php");
    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]))) {
        header('Location: ../index.php');
        //die("<h1><b>Vous n'êtes pas connecté !</b></h1>") ;
        
    }


    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">
    <title>Dashboard</title>


</head>

<body>
    <?= Utility::getHeader($CheminPageAdminConnecte, "Dashboard", "Manage your site") ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Website Overview</h3>
        <div class="elements">
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/vu.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1>Visiteurs</h1>
                    <h3>10000</h3>
                </div>
            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/project.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1>Projets</h1>
                    <h3><?= Utility::getNumberOfItem($bdd, "tbl_projects") ?></h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/career.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1>Career</h1>
                    <h3><?= Utility::getNumberOfItem($bdd, "tbl_careers") ?></h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/article.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1>Articles</h1>
                    <h3><?= Utility::getNumberOfItem($bdd, "tbl_articles") ?></h3>
                </div>

            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div style="width: 45vw; min-width: 400px;" class="websiteOverview">
            <h3 class="titleOfWebsiteOverview">Latest Logs</h3>
            <div class="tbl-content"> 
            <table >
                <tr>
                    <th>Horodatage</th>
                    <th>IP</th>
                    <th>User-Agent</th>
                    <th>Action</th>
                </tr>
                <?php
                $logs = Utility::getlogs($bdd);
                foreach ($logs as $key => $value) {
                    echo ("
    <tr>
        <td>" . $value["horodatage"] . "</td>
        <td>" . $value["addr_ip"] . "</td>
        <td>" . $value["user_agent"] . "</td>
        <td>" . $value["titre_action"] . "</td>
      </tr>
        ");
                }
                ?>
            </table>
            </div>
        </div>

        <div style="width: 45vw; min-width: 400px;" class="websiteOverview">
            <h3 class="titleOfWebsiteOverview">Latest posts</h3>
            <div class="tbl-content"> 
            <table>
                <tr>
                    <th>Nom/Prénom</th>
                    <th>Adresse E-Mail</th>
                    <th>Objet</th>
                    <th>Message</th>
                </tr>
                <tr>
                    <td>Lombrès</td>
                    <td>lombres@protonmail.com</td>
                    <td>Bienvenue dans votre espace d'administration</td>
                    <td>help.md</td>
                </tr>
                <tr>
                    <td>Lombrès</td>
                    <td>lombres@protonmail.com</td>
                    <td>Bienvenue dans votre espace d'administration</td>
                    <td>help.md</td>
                </tr>
                <tr>
                    <td>Lombrès</td>
                    <td>lombres@protonmail.com</td>
                    <td>Bienvenue dans votre espace d'administration</td>
                    <td>help.md</td>
                </tr>
                <tr>
                    <td>Lombrès</td>
                    <td>lombres@protonmail.com</td>
                    <td>Bienvenue dans votre espace d'administration</td>
                    <td>help.md</td>
                </tr>

            </table>
            </div>
        </div>
    </div>




</body>

<script src="../../script/app.js"></script>

</html>