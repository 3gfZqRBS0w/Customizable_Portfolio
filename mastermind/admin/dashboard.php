<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

    session_start();

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once("../../init.php");
    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]) && ( !$Owner->CheckQRCode() || isset($_SESSION["qrCode"])) )) {
        header('Location: ../../index.php');
        exit;
}

    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">
    <title>Dashboard</title>


</head>

<body>
    <?= Utility::getHeader($config["redirection"]["dashboard"],  "Dashboard", "Manage your site") ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview"><?= $config["translations"]["selected"]["dashboard"]["websiteOverview"] ?></h3>
        <div class="elements">
            <div class="elementOfWebsiteOverview">
                <div>
                    <img class="panelImg" src="../../assets/vu.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1><?= $config["translations"]["selected"]["dashboard"]["visitor"] ?></h1>
                    <h3><?=$Logs->GetNumberOfVisitors()?></h3>
                </div>
            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img class="panelImg" src="../../assets/project.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1><?= $config["translations"]["selected"]["dashboard"]["projects"] ?></h1>
                    <h3><?= $Projects->GetPostNumber()?></h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img class="panelImg" src="../../assets/career.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1><?= $config["translations"]["selected"]["dashboard"]["career"] ?></h1>
                    <h3><?=$Carrier->GetPostNumber()?></h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img class="panelImg" src="../../assets/article.png"></img>
                </div>

                <div class="childelementOfWebsiteOverview">
                    <h1><?= $config["translations"]["selected"]["dashboard"]["articles"] ?></h1>
                    <h3><?=$Articles->GetPostNumber()?></h3>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div style="width: 45vw; min-width: 400px;" class="websiteOverview">
            <h3 class="titleOfWebsiteOverview"><?=$config["translations"]["selected"]["dashboard"]["latestLogs"]?></h3>
            <div class="tbl-content">
                <table>
                    <tr>
                        <th><?= $config["translations"]["selected"]["tab_logs"]["timestamp"] ?></th>
                        <th>IP</th>
                        <th><?= $config["translations"]["selected"]["tab_logs"]["userAgent"] ?></th>
                        <th><?= $config["translations"]["selected"]["tab_logs"]["action"] ?></th>
                    </tr>
                    <?php
                    $logs = $Logs->GetLogs() ; 
                    foreach ($logs as $key => $value) {
                        echo ("
    <tr>
        <td>" . $value["timestamp"] . "</td>
        <td>" . $value["ipAddress"] . "</td>
        <td>" . $value["userAgent"] . "</td>
        <td>" . $config["translations"]["selected"]["logs"][$value["actionid_fk"]] . "</td>
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
                        <th>Numéro de Téléphone</th>
                        <th>Objet</th>
                        <th>Check</th>
                    </tr>
                    
                    <?php
                    $messages = $Contact->GetAllMessages() ;

                    foreach ($messages as $key => $value) {
                        echo ("
    <tr>
        <td>" . $value["fullName"] . "</td>
        <td>" . $value["email"] . "</td>
        <td>" . $value["num"] . "</td>
        <td>" . $value["title"] . "</td>
        <td><form action='messages/index.php' method='post' ><button type='submit' name='checkMessage' value='".$value["id"]."'  class='check'>Check</button></form></td>
      </tr>
        ");
                    }

                    ?>

                   
                </table>
            </div>
        </div>
    </div>




</body>

<script src="../../script/app.js"></script>

</html>