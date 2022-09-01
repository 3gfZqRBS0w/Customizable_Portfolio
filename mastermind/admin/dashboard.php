<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

    require_once("../../config/basededonnee.php");
    require_once("../../config/redirection.php");
    require_once("../../config/recuperation.php");
    require_once("../../librairies/Utility.php");
    require_once("../../librairies/Parsedown.php");
    require_once("../../init.php");

    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <title>Dashboard</title>

    <style>

        body {
            background-color: #efebe9;
        }
        .websiteOverview {
            margin-top: 5vh;
            background-color: #e2e2e2;
            margin-left: 2.5vw;
            margin-right: 2.5vw;
            border-radius: 30px;
            width: 95vw;
        }

        .titleOfWebsiteOverview {
            background-color: #E8F1F2;
            box-shadow: 0 4px 2px -2px black;
            align-items: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap; 
        }



        .elementOfWebsiteOverview {
            background: rgb(232,241,242);
            background: linear-gradient(90deg, rgba(232,241,242,1) 0%, rgba(232,241,242,1) 54%, rgba(232,241,242,1) 100%, rgba(255,240,0,1) 100%);
            border-radius: 30px;
            display: flex;
            width: 20vw;
            height: 20vh;
            margin-top: 5vh;
            margin-bottom: 5vh;
           /* border: 1px solid black;*/
            min-width: 250px;
            min-height: 100px;
            justify-content: space-around;
        }

        .elements {

            height: 80%;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        table {
            position: static;
            z-index: -1;
            border-collapse: separate !important;
            /*width: 90%;*/
            border-bottom: 0px solid transparent;
            border-radius: 30px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
      }


      table,th,td {
        padding: 10px;
      }

      th {
    
        text-align: center;
        height: 50px;
      }


        img {
            margin-top: 50%;
            height: 90px;
            width: 90px;
            min-width: 1px;
        }
    </style>
</head>

<body>
    <?php
    echo (Utility::getHeader($CheminPageAdminConnecte, "Dashboard", "Manage your site"));
    ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Website Overview</h3>
        <div class="elements">
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/vu.png"></img>
                </div>

                <div style="margin-top: auto; margin-bottom: auto; text-align: center;">
                    <h1>Visiteurs</h1>
                    <h3>10000</h3>
                </div>


            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/project.png"></img>
                </div>

                <div style="margin-top: auto; margin-bottom: auto; text-align: center;">
                    <h1>Projets</h1>
                    <h3>10000</h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/career.png"></img>
                </div>

                <div style="margin-top: auto; margin-bottom: auto; text-align: center;">
                    <h1>Career</h1>
                    <h3>10000</h3>
                </div>

            </div>
            <div class="elementOfWebsiteOverview">
                <div>
                    <img src="../../images/article.png"></img>
                </div>

                <div style="margin-top: auto; margin-bottom: auto; text-align: center;">
                    <h1>Articles</h1>
                    <h3>10000</h3>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">
<div style="width: 45vw; min-width: 400px;" class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Logs</h3>
    <table>
      <tr>
        <th>Horodatage</th>
        <th>IP</th>
        <th>User-Agent</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>01:36</td>
        <td>10.01.2014</td>
        <td>Mozilla/5.0 (X11; Linux x86_64; rv:104.0)</td>
        <td>Installation du site</td>
      </tr>
      <tr>
      <td>01:36</td>
        <td>10.01.2014</td>
        <td>Mozilla/5.0 (X11; Linux x86_64; rv:104.0)</td>
        <td>Installation du site</td>
      </tr>
    </table>
</div>
 
<div style="width: 45vw; min-width: 400px;" class="websiteOverview">
<h3 class="titleOfWebsiteOverview"> Messages</h3>
<table>
      <tr>
        <th>Nom/Prénom</th>
        <th>Adresse E-Mail</th>
        <th>Messages</th>
        <th>Fichier</th>
      </tr>
      <tr>
        <td>John Doe</td>
        <td>johndoe@jd.com</td>
        <td>Help me bro</td>
        <td>message2.md</td>
      </tr>
      <tr>
      <td>John Doe</td>
        <td>johndoe@jd.com</td>
        <td>Help me bro</td>
        <td>message1.md</td>
      </tr>
    </table>
    </div>
</div>




</body>

<script src="../../script/app.js"></script>

</html>