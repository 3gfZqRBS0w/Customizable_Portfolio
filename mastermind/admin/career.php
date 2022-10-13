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
    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]) && (!$Owner->CheckQRCode() || isset($_SESSION["qrCode"])))) {
        header('Location: ../../index.php');
    }
    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">

<body>
    <?= (Utility::getHeader($config["redirection"]["dashboard"], "Career", "Inform your career")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Carrier Type</h3>
        <?php

        // FOR INSERT CARRIER TYPE IN DATABASES 
        if (isset($_POST["carrierType"])) {
            $carrierType = $_POST["carrierType"];

            if (strlen($carrierType) > 0 && strlen($carrierType) < 30) {
                if ($Carrier->New($carrierType)) {
                    echo ("<p class='notification' style='background-color: green;' >Carrier Type added</p>");
                } else {
                    echo ("<p class='notification' style='background-color: green;' >Already existing Carrier Type</p>");
                }
                // Utility::addNewArticle($bdd, $articleTitle);
            } else {
                echo ("<p class='notification' style='background-color: red;' >The title must contain maximum 30 characters .</p>");
            }
        }
        ?>
        <div class="contact-form setting">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="carrierTypeTitle">Carrier Type Title</label>
                    <input name="carrierType" id="carrierTypeTitle" placeholder="Carrier Type Title" required>
                </p>


                <p>
                    <button value="submit" type="submit">Save</button>
                </p>
            </form>
        </div>

    </div>

    <div class="websiteOverview">

        <?php


        if (isset($_POST["chooseCarrier"])) {


            $id = $Carrier->GetCarrierTypeIDByTitle($_POST["chooseCarrier"]) ;

            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Event</h3>
    <div class='contact-form setting'>");

            $data =  $CarrierEvent->GetAllCarrierEvents($Carrier->GetCarrierTypeIDByTitle($_POST["chooseCarrier"]));

            if (count($data) <= 0) {
                echo ("<p>
        Il n'y a aucune carrière associé a ce type
        </p>");
            } else {

                /*
        foreach ($data as $post) {
            // A compléter


        }*/
            }

            echo ("<form action='' method='POST'>
    <p>
    <button name='AddCareerEvent'value='" . $_POST["chooseCarrier"] . "' type='submit'>Add Career Event</button>
    </p>

    <p>
    <button type='submit'>CANCEL</button>
    </p>
    </form>");
        } elseif (isset($_POST["AddCareerEvent"])) {
            echo ("<h3 class='titleOfWebsiteOverview'>Add Carreer Event</h3>");
            if (isset($_POST["start"]) && $_POST["end"] && $_POST["titleEvent"]) {

            }

echo("
<div class='contact-form setting'>
<form method='post' action=''>
<p>
<label>Titre</label>
<input name='titleEvent' placeholder='Title of Event' type='text' required>
</p>

<div style='display: flex; justify-content: space-evenly;'>
<div style='width: 30%;'>
<label for='start'>Start date</label>
<input type='date' id='start' name='startDate'>
</div>
<div style='width: 30%;'>
<label for='end'>End date</label>
<input type='date' id='end' name='endDate'>
</div>

</div>

<p>
<button name='AddCareerEvent' value='$id' type='submit'>Add</button>
</p>



</div>
</form>

<div class='contact-form setting'>
<form method='post' action=''>

<p>
<button value='submit' type='submit'>Cancel</button>
</p>

</form>
</div>   


</div>



");
        } elseif (!isset($_POST['chooseProjectType'])) {

            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Career Type</h3>
<div class='contact-form setting'>");

            if (isset($_POST['saveArticle'])) {
                if (isset($_POST['articleContent']) && $_POST['newTitle']) {
                    if ($Carrier->Edit($_POST['saveArticle'], $_POST['newTitle'], $_POST['articleContent'])) {
                        echo ("<p class='notification' style='background-color: green;' >Article update.</p>");
                    } else {
                        echo ("<p class='notification' style='background-color: red;' >failure of the article update</p>");
                    }
                }
            }


            $data =  $Carrier->GetAllPosts();



            if (count($data) > 0) {
                foreach ($data as $post) {
                    echo ("
        <form action='' method='POST'>
         <div class='projetPreview'>
          <p>" . $post["title"] . "</p>
          <button name='chooseCarrier'value='" . $post["title"] . "' type='submit'>Edit</button>
         </div> 
        </form>
        ");
                }
            } else {
                echo ("
            <p>You have not added any article to the website</p>
            ");
            }
        } else {

            $data = $Carrier->getPost($_POST['chooseProjectType']);
            echo ("

            <h3 class='titleOfWebsiteOverview'>Edit " . $data[0]["title"] . " </h3>

    
    <div class='contact-form setting'>
    
    <form action='' method='post'>
    <label>Project Title</label>
    <input name='newTitle' type='text' value='" . $data[0]["title"] . "' required>
        <label>Article Content</label>

    <div class='container'>

        <div class='plain'>
            <textarea name='articleContent' data-el='input0'>" . $data[0]["fullTextOfArticles"] . "</textarea>
        </div>
        <div class='text'>
            <div data-el='output0'></div>
        </div>

    </div>

    </p>

    <p>
        <button style='margin-bottom: 2vh' name='saveArticle' value='" . $data[0]["title"] . "' type='submit'>Save</button>
        <button value='submit' type='submit'>Cancel</button>
        </p>
    </form>
        <form action='' method='POST'>

        <button style='margin-bottom: 2vh' name='removeProject' value='" . $data[0]["title"] . "' type='submit'>Delete</button>

        </form>
");
        }



        ?>
    </div>
    </div>







    <script src="../../script/app.js"></script>

</html>