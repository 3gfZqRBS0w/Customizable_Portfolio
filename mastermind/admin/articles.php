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
    <?= (Utility::getHeader($config["redirection"]["dashboard"], "Article", "Publish your article")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Add Article</h3>
        <?php


        if (isset($_POST["articleTitle"])) {
            $articleTitle = $_POST["articleTitle"];
    
            if (strlen($articleTitle) > 0 && strlen($articleTitle) < 255) {
                if ($Articles->New($articleTitle)) {
                    echo ("<p class='notification' style='background-color: green;' >Article added</p>");
                }
                else {
                    echo ("<p class='notification' style='background-color: green;' >Already existing article</p>");

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
                                if ($Articles->Remove($_POST["deleteReallyProject"])) {
                                    echo ("<p class='notification' style='background-color: green;' >Project deleted with success</p>");
                                } else {
                                    echo ("<p class='notification' style='background-color: red;' >Unable to delete this project</p>");
                                }
                            } else {
                                echo ("<p class='notification' style='background-color: green;' >Project not deleted</p>");
                            }
                        }
                    }

                    if (!isset($_POST['chooseProject'])) {

                        echo("<h3 class='titleOfWebsiteOverview'>Choose your article</h3>
                        <div class='contact-form setting'>") ; 
                    
                        if (isset($_POST['saveArticle'])) {
                            if (isset($_POST['articleContent']) && $_POST['newTitle']) {
                                if ($Articles->Edit($_POST['saveArticle'],$_POST['newTitle'],$_POST['articleContent'] )) {
                                    echo ("<p class='notification' style='background-color: green;' >Article update.</p>");
                                }
                                else {
                                    echo ("<p class='notification' style='background-color: red;' >failure of the article update</p>");
                                }
                            }
                        }
                    
                    
                                $data =  $Articles->GetAllPosts();
                    
                              
                    
                                    if (count($data) > 0) {
                                        foreach ($data as $post) {
                                            echo ("
                                <form action='' method='POST'>
                                 <div class='projetPreview'>
                                  <p>" . $post["title"] . "</p>
                                  <button name='chooseProject'value='" . htmlspecialchars($post["title"]) . "' type='submit'>Edit</button>
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
                    
                                   // $data = Utility::getData($bdd, $_POST['chooseProject'], "tbl_articles");
                    
                                   $data = $Articles->getPost($_POST['chooseProject']) ;
                                    echo ("
                    
                                    <h3 class='titleOfWebsiteOverview'>Edit ".$data[0]["title"]." </h3>
                    
                            
                            <div class='contact-form setting'>
                            
                            <form action='' method='post'>
                            <label>Project Title</label>
                            <input name='newTitle' type='text' value='" . htmlspecialchars($data[0]["title"]) . "' required>
                                <label>Article Content</label>
                    
                            <div class='container'>
                    
                                <div class='plain'>
                                    <textarea name='articleContent' data-el='input0'>" . htmlspecialchars($data[0]["fullTextOfArticles"]) . "</textarea>
                                </div>
                                <div class='text'>
                                    <div data-el='output0'></div>
                                </div>
                    
                            </div>
                    
                            </p>
                    
                            <p>
                                <button style='margin-bottom: 2vh' name='saveArticle' value='" . htmlspecialchars($data[0]["title"]) . "' type='submit'>Save</button>
                                <button value='submit' type='submit'>Cancel</button>
                                </p>
                            </form>
                                <form action='' method='POST'>
                    
                                <button style='margin-bottom: 2vh' name='removeProject' value='" . htmlspecialchars($data[0]["title"]) . "' type='submit'>Delete</button>
                    
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