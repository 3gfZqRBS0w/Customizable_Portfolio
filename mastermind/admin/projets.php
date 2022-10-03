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

    require_once("../../init.php");

    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]) && ( !$Owner->CheckQRCode() || isset($_SESSION["qrCode"])) )) {
        header('Location: ../../index.php');
}

    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">

<body>

    <?= (Utility::getHeader($config["redirection"]["dashboard"], "Projects", "Add your projects")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Project</h3>
        <?php

        ///// ADD PROJECT 
        // Pour ajouter un projet a la liste déjà existante 
        if (isset($_POST["nameOfProject"]) && isset($_FILES["profilePicture"])) {
            $projetName = $_POST["nameOfProject"];
            $tmpName = $_FILES['profilePicture']['tmp_name'];
            $name = $_FILES['profilePicture']['name'];
            $size = $_FILES['profilePicture']['size'];
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            $error = $_FILES['profilePicture']['error'];
            $ifProjectExists = count(Utility::getData($bdd, $projetName, "tbl_projects"));
            $extensions = ['jpg', 'png', 'jpeg'];
            if ($ifProjectExists < 1) {
                if (in_array($extension, $extensions)) {
                    if ($error == 0) {
                        if ($size <= $config["stockage"]["maxProfileSize"]) {
                            $uniqueName = uniqid('', true);
                            $fileName = $uniqueName . "." . $extension;
                            if (strlen($projetName) > 0 && strlen($projetName) < 30) {
                                if ($Projects->New($projetName, $fileName)) {
                                    move_uploaded_file($tmpName, '../../upload/' . $fileName);
                                    echo ("<p class='notification' style='background-color: green;' >" . $config["translations"]["selected"]["notification"]["projectAdded"] . "</p>");
                                } else {
                                    echo ("<p class='notification' style='background-color: red;' >Already existing project</p>");
                                }   
                            } else {
                                echo ("<p class='notification' style='background-color: red;' >The title must contain maximum 30 characters .</p>");
                            }
                            //older method : Utility::addNewProject($bdd, $projetName, $fileName);
                        } else {
                            echo ("<p class='notification' style='background-color: red;' >" . $config["translations"]["selected"]["notification"]["limitFile"] . "</p>");
                        }
                    } else {
                        echo ("<p class='notification' style='background-color: red;' >" . $config["translations"]["selected"]["phpFileUploadErrors"][$error] . "</p>");
                    }
                } else {
                    echo ("<p class='notification' style='background-color: red;' >" . $config["translations"]["selected"]["notification"]["fileNotRecognized"] . "</p>");
                }
            } else {
                echo ("<p class='notification' style='background-color: red;' >" . $config["translations"]["selected"]["notification"]["projectAlreadyExists"] . "</p>");
            }
        }
        /*
Old version of this part of code 

    $nbOfPicture = Utility::getNumberOfItem($bdd, "tbl_projects");
    $imagePath = "../../project_data/picture/$nbOfPicture.png";
    $projetName = $_POST["nameOfProject"];
    
    //$check = getimagesize($_FILES["profilePicture"]["tmp_name"]);


    if ($check !== false) {
        if (!file_exists($imagePath)) {
            if ($_FILES["profilePicture"]["size"] < 50000) {
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

*/
        //}
        ?>
        <div class="contact-form setting">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="nomProjet">Project name</label>
                    <input id="projetName" placeholder="Nom du projet" value="" type="text" name="nameOfProject" required>

                    <label>Project image</label>
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

// /////////////////////////////////////////REMOVE PROJECT CODE/////////////////////////////////// 
        if (isset($_POST['removeProject'])) {
            echo ("<h3 class='titleOfWebsiteOverview'>Are you sure</h3>

            <div class='contact-form setting'>
            <form method='post' action=''>
            <p>
            <label> Write the name of Project :" . $_POST['removeProject'] . " </label>
            <input name='nameOfProject' type='text' value='I DONT WANT TO DELETE THE PROJECT' required>
            <button name='deleteReallyProject'value='" . $_POST['removeProject'] . "' type='submit'>Submit</button>
            </p>
            
            </form>

            </div>
    
        ");

        } else {

            if (isset($_POST['deleteReallyProject'])) {
                if (isset($_POST['nameOfProject']) && isset($_POST["deleteReallyProject"])) {

                    // If the input of user is correct, delete really project
                    if ($_POST["nameOfProject"] == $_POST["deleteReallyProject"]) {
                        //if (Utility::deleteData($bdd, $_POST["deleteReallyProject"], "tbl_projects")) {
                        if ($Projects->Remove($_POST["deleteReallyProject"])) {
                            echo ("<p class='notification' style='background-color: green;' >Project deleted with success</p>");
                        } else {
                            echo ("<p class='notification' style='background-color: red;' >Unable to delete this project</p>");
                        }
                    } else {
                        echo ("<p class='notification' style='background-color: green;' >Project not deleted</p>");
                    }
                }
            }

// ////////////////////////////////////////////////////////////////////////////////////////////////
            if (!isset($_POST['chooseProject'])) {

                echo ("        
        <h3 class='titleOfWebsiteOverview'>Choose your project</h3>
        <div class='contact-form setting'>
        ");

        if (isset($_POST['saveProject'])) {
            if (isset($_POST['nameOfProject']) && isset($_POST['ProjectContent'])) {
                // Utility::editProjects($bdd, $_POST['nameOfProject'], $_POST['ProjectContent']);
                if ($Projects->Edit($_POST["saveProject"],$_POST['nameOfProject'], $_POST['ProjectContent'])) {
                    echo ("<p class='notification' style='background-color: green;' >Project updating.</p>");
                }
                else {
                    echo ("<p class='notification' style='background-color: red;' >failure of the project update</p>");
                }
            }
        }
                $listOfProjects =  $Projects->GetAllPosts() ; 

                if (count($listOfProjects) > 0) {
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
                    echo ("
                    <p>You have not added any projects to the website</p>
                    ");
                }
            } else {

                $data = $Projects->GetAllPosts();

                //Utility::getData($bdd, $_POST['chooseProject'], "tbl_projects");

                echo ("

        <h3 class='titleOfWebsiteOverview'>Edit " . $data[0]["title"] . "</h3>
        <div class='contact-form setting'>
        
        <form action='' method='post'>
        <label>Project Title</label>
        <input name='nameOfProject' type='text' value='" . $data[0]["title"] . "' required>

           
        
            <label>Change image of this projet (it is optional)</label>
            <input type='file' name='profilePicture'>
            <label>Project Content</label>

        <div class='container'>

            <div class='plain'>
                <textarea name='ProjectContent' data-el='input0'>" . $data[0]["fullTextOfProject"] . "</textarea>
            </div>
            <div class='text'>
                <div data-el='output0'></div>
            </div>

        </div>

        </p>

        <p>
            <button style='margin-bottom: 2vh'name='saveProject' value='".$data[0]["title"]."' type='submit'>Save</button>
            <button value='submit' type='submit'>Cancel</button>
            </p>
        </form>
            <form action='' method='POST'>

            <button style='margin-bottom: 2vh' name='removeProject' value='" . $data[0]["title"] . "' type='submit'>Delete</button>

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