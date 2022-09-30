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

    if (!(isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]))) {
        header('Location: ../index.php');
        //die("<h1><b>Vous n'êtes pas connecté !</b></h1>") ;

    }
    ?>
    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">

<body>
    <?= (Utility::getHeader($config["redirection"]["dashboard"], "Article", "Publish your article")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Article</h3>
        <?php
        if (isset($_POST["articleTitle"])) {
            $articleTitle = $_POST["articleTitle"];
            if (strlen($articleTitle) > 0 && strlen($articleTitle) < 50) {
                Utility::addNewArticle($bdd, $articleTitle);
                echo ("<p class='notification' style='background-color: green;' >Article added</p>");
                // success
            } else {
                echo ("<p class='notification' style='background-color: red;' >The title must contain maximum 50 characters .</p>");
            }
        }
        ?>

        <div class="contact-form setting">

            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="articleTitle">Article title</label>

                    <input id="articleTitle" placeholder="Nom de l'article" value="" type="text" name="articleTitle" required>
                </p>

                <p>
                    <button value="submit" type="submit">Save</button>
                </p>

            </form>
        </div>


    </div>

    <div class="websiteOverview">
        
            <?php
            $listOfProjects =  Utility::getAllNames($bdd, "tbl_articles");


            if (!isset($_POST['chooseProject'])) {
                if (count($listOfProjects) > 0) {
                    foreach ($listOfProjects as $projet) {
                        echo ("

                        <h3 class='titleOfWebsiteOverview'>Choose your article</h3>
        <div class='contact-form setting'>
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
                <p>You have not added any article to the website</p>
                ");
                }
            } else {

                $dataOfProjects = Utility::getData($bdd, $_POST['chooseProject'], "tbl_articles");

                echo ("

                <h3 class='titleOfWebsiteOverview'>Edit ".$dataOfProjects[0]["title"]." </h3>

        
        <div class='contact-form setting'>
        
        <form action='' method='post'>
        <label>Project Title</label>
        <input name='nameOfProject' type='text' value='" . $dataOfProjects[0]["title"] . "' required>
            <label>Article Content</label>

        <div class='container'>

            <div class='plain'>
                <textarea name='ProjectContent' data-el='input0'>" . $dataOfProjects[0]["fullTextOfArticles"] . "</textarea>
            </div>
            <div class='text'>
                <div data-el='output0'></div>
            </div>

        </div>

        </p>

        <p>
            <button style='margin-bottom: 2vh'name='saveProject' value='" . $dataOfProjects[0]["title"] . "' type='submit'>Save</button>
            <button value='submit' type='submit'>Cancel</button>
            </p>
        </form>
            <form action='' method='POST'>

            <button style='margin-bottom: 2vh' name='removeProject' value='" . $dataOfProjects[0]["title"] . "' type='submit'>Delete</button>

            </form>
        
    ");
                
            }


            ?>
        </div>
    </div>

</body>

<script src="../../script/app.js"></script>

</html>