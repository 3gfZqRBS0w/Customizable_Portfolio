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


<body>
    <?= (Utility::getHeader($CheminPageAdminConnecte, "Projects", "Add your projects")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Project</h3>

        <?php

// En cours de développement

          //  if (isset($_POST["submit"])) {
                if (isset($_POST["nameOfProject"]) && isset($_FILES["profilePicture"])) {
        
                    $imageRep = "../../project_data/picture/" ;
                    $projetName = $_POST["nameOfProject"] ; 
                    $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);

                    if ($check !== false) {
                        if (!file_exists($imagePath) ) {
                            if ($_FILES["profilePicture"]["size"] < 500000) {
                                if($_FILES["profilePicture"]["type"] == "image/png") {
                                    if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $imagePath.basename($_FILES["profilePicture"]["name"]))) {
                                        $nbOfPicture = Utility::getNumberOfItem($bdd, "tbl_projects");

                                        
                                        
                                        rename($imagePath, "../../project_data/picture/$nbOfPicture");
                                        Utility::addNewProject($bdd, $projetName,$imagePath);
                                        echo("<p class='notification' style='background-color: green;' >The file was correctly sent</p>") ;
                                    }
                                }
                                else {
                                    echo("<p class='notification' style='background-color: red;' >png only</p>") ;
                                }
                            }
                            else {
                                echo("<p class='notification' style='background-color: red;' >50 MB max.</p>") ;
        
                            }
                        }
                        else {
                            echo("<p class='notification' style='background-color: red;' >Change the name of the file</p>") ;
        
                        }
                    }
                    else {
                        echo("<p class='notification' style='background-color: red;' >format not recognizede</p>") ;
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
        <h3 class="titleOfWebsiteOverview">Edit Project</h3>
        <div class="contact-form setting">
            <form action="" method="post">


                <p>
                    <label for="nomProjet">Nom du projet</label>
                    <select name="projetName">
                        <option>Select your Project</option>
                        <?php
                        $listOfProjects =  Utility::getAllProjectsNames($bdd);


                        foreach ($listOfProjects as $key => $value) {

                            echo ("<option>" . $value["title"] . "</option>");
                        }
                        ?>
                    </select>
                    <label>Change image of this projet</label>
                    <input type="file" name="profilePicture">

                    <label>Project Content</label>

                <div class="container">
                    <div class="plain">
                        <textarea name="ProjectContent" data-el="input0"></textarea>
                    </div>
                    <div class="text">
                        <div data-el="output0"></div>
                    </div>
                </div>

                </p>

                <p>
                    <button value="submit" type="submit">Save</button>
                </p>
            </form>
        </div>

    </div>

</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js'></script>
<script src="../../script/markdown.js"></script>
<script src="../../script/app.js"></script>

</html>