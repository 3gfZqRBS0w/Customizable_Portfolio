<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

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
    <style>
        .projetPreview {
            width: 90vw;
            height: 12.5vh;
            margin-top: 2.5vh;
            border: 1px solid black;
        }
    </style>


<body>
    <?= (Utility::getHeader($CheminPageAdminConnecte, "Projects", "Add your projects")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Project</h3>

        <?php

        // En cours de développement

        //  if (isset($_POST["submit"])) {
        if (isset($_POST["nameOfProject"]) && isset($_FILES["profilePicture"])) {

            $nbOfPicture = Utility::getNumberOfItem($bdd, "tbl_projects");
            $imagePath = "../../project_data/picture/$nbOfPicture.png";
            $projetName = $_POST["nameOfProject"];
            $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);

            if ($check !== false) {
                if (!file_exists($imagePath)) {
                    if ($_FILES["profilePicture"]["size"] < 500000) {
                        if ($_FILES["profilePicture"]["type"] == "image/png") {
                            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $imagePath)) {

                                Utility::addNewProject($bdd, $projetName, $imagePath);
                                echo ("<p class='notification' style='background-color: green;' >Project Added</p>");
                            }
                        } else {
                            echo ("<p class='notification' style='background-color: red;' >png only</p>");
                        }
                    } else {
                        echo ("<p class='notification' style='background-color: red;' >50 MB max.</p>");
                    }
                } else {
                    echo ("<p class='notification' style='background-color: red;' >Change the name of the file</p>

                            ");
                }
            } else {
                echo ("<p class='notification' style='background-color: red;' >format not recognizede</p>");
            }
        }
        //}
        ?>


        <div class="contact-form setting">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="nomProjet">Nom du projet</label>
                    <input id="projetName" placeholder="Nom du projet" value="" type="text" name="nameOfProject" required>

                    <label>Image du projet</label>
                    <input type="file" name="profilePicture" required>
                </p>

                <p>
                    <button value="submit" type="submit">Save</button>
                </p>
            </form>
        </div>
    </div>


    <div class="websiteOverview">

        <?php


        if (isset($_POST['removeProject'])) {
            echo ("<h3 class='titleOfWebsiteOverview'>Are you sure</h3>

            <div class='contact-form setting'>
            <form method='post' action=''>
            <p>
            <label> Write the name of Project :" .$_POST['removeProject'] . " </label>
            <input name='nameOfProject' type='text' value='I DONT WANT TO DELETE THE PROJECT' required>
            <button name='deleteReallyProject'value='".$_POST['removeProject']."' type='submit'>Submit</button>
            </p>
            
            </form>

            </div>
    
        ");
        } 
        else {

            if (isset($_POST['deleteReallyProject'])) {
                if (isset($_POST['nameOfProject']) && isset($_POST["deleteReallyProject"])) {
                    if ( $_POST["nameOfProject"] == $_POST["deleteReallyProject"] ) {

                        echo ("<p class='notification' style='background-color: green;' >Project deleted with success</p>");
                        Utility::deleteProjects($bdd,$_POST["deleteReallyProject"]) ; 
                    }
                    else {
                        echo ("<p class='notification' style='background-color: green;' >Project not deleted</p>");
                    }
                }
            }


            if (!isset($_POST['chooseProject'])) {

                echo ("        
        <h3 class='titleOfWebsiteOverview'>Choose your project</h3>
        <div class='contact-form setting'>
        ");

                if (isset($_POST['saveProject'])) {
                    if (isset($_POST['nameOfProject']) && isset($_POST['ProjectContent'])) {
                        Utility::editProjects($bdd, $_POST['nameOfProject'], $_POST['ProjectContent']);
                        echo ("<p class='notification' style='background-color: green;' >Project updating.</p>");
                        
                    }
                }
                $listOfProjects =  Utility::getAllProjectsNames($bdd);

                foreach ($listOfProjects as $projet) {
                    echo ("
            <form action='' method='POST'>
             <div class='projetPreview'>
              <p>" . $projet["title"] . "</p>
              <button name='chooseProject'value='" . $projet["title"] . "' type='submit'>Edit</button>
             </div> 
            </form>
            ");
                }
            } else {

                $dataOfProjects = Utility::getProjectData($bdd, $_POST['chooseProject']);

                echo ("

        <h3 class='titleOfWebsiteOverview'>Edit " . $dataOfProjects["title"] . "</h3>
        <div class='contact-form setting'>
        
        <form action='' method='post'>
        <label>Project Title</label>
        <input name='nameOfProject' type='text' value='" . $dataOfProjects["title"] . "' required>

           
        
            <label>Change image of this projet (it is optional)</label>
            <input type='file' name='profilePicture'>
            <label>Project Content</label>

        <div class='container'>

            <div class='plain'>
                <textarea name='ProjectContent' data-el='input0'>" . $dataOfProjects["textPath"] . "</textarea>
            </div>
            <div class='text'>
                <div data-el='output0'></div>
            </div>

        </div>

        </p>

        <p>
            <button style='margin-bottom: 2vh'name='saveProject' value='" . $dataOfProjects["title"] . "' type='submit'>Save</button>
            <button value='submit' type='submit'>Cancel</button>
            </p>
        </form>
            <form action='' method='POST'>

            <button style='margin-bottom: 2vh' name='removeProject' value='" . $dataOfProjects["title"] . "' type='submit'>Delete</button>

            </form>
        
    ");
            }
        }




        ?>





    </div>

    </div>

</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js'></script>
<script src="../../script/markdown.js"></script>
<script src="../../script/app.js"></script>

</html>