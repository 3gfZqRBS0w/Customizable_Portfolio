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
<?= (Utility::getHeader($config["redirection"]["dashboard"], "Skills", "Showcase your skills")) ?>


    
    <div class="websiteOverview">
    <!-- Pour rajouter des types de carrières -->
        <h3 class="titleOfWebsiteOverview">Add Skill Type</h3>
        <?php
        if (isset($_POST["carrierType"])) {
            $SkillsType = $_POST["carrierType"];

            if (strlen($SkillsType) > 0 && strlen($SkillsType) < 30) {
                if ($Skills->New($SkillsType)) {
                    echo ("<p class='notification' style='background-color: green;' >Skill Type added</p>");
                } else {
                    echo ("<p class='notification' style='background-color: red;' >Already existing Skill Type</p>");
                }
            } else {
                echo ("<p class='notification' style='background-color: red;' >The title must contain maximum 30 characters .</p>");
            }
        }
        ?>
        <div class="contact-form setting">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <label for="carrierTypeTitle">Skill Type Title</label>
                    <input name="carrierType" id="carrierTypeTitle" placeholder="Skill Type Title" required>
                </p>


                <p>
                    <button value="submit" type="submit">Save</button>
                </p>
            </form>
        </div>

    </div>

    <div class="websiteOverview">

        <?php

// Pour choisir son type de carrière
        if (isset($_POST["chooseCarrierType"])) 
        {
            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Skill</h3>
    <div class='contact-form setting'>");

            $data =  $Skills->GetSkills()->GetAllSkills($Skills->GetSkillTypeIDByTitle($_POST["chooseCarrierType"]));

            if (count($data) <= 0) {
                echo ("<p>
        Il n'y a aucune carrière associé a ce type
        </p>");
            } else {

                
                foreach ($data as $post) {
                    echo ("
        <form action='' method='POST'>
         <div class='projetPreview'>
          <p>" . htmlspecialchars($post["title"]) . "</p>
          <button name='editSkill'value='" . htmlspecialchars($post["title"]) . "' type='submit'>Edit</button>
         </div> 
        </form>
        ");
                }
            }
            $id = $Skills->GetSkillTypeIDByTitle($_POST["chooseCarrierType"]) ;
    
            echo ("<form action='' method='POST'>

            <label>Action sur les types de carrières</label>
    <p>
    <button name='AddSkill'value='" . $_POST["chooseCarrierType"] . "' type='submit'>Add Skill</button>
    </p>

    <p>
     <button name='deleteType'value='" . $_POST["chooseCarrierType"] . "' type='submit'>Delete Skill Type</button>
    </p>

    <p>
    <button type='submit'>CANCEL</button>
    </p>
    </form>");
        }

        // Pour ajouter des événements de carrières
        elseif (isset($_POST["AddSkill"])) 
        {
            echo ("<h3 class='titleOfWebsiteOverview'>Add Skill Event</h3>");
            if (isset($_POST["titleSkill"]) && $_POST["competenceLevel"]) {
                if ($Skills->GetSkills()->New($_POST["titleSkill"],$_POST["competenceLevel"] ,$_POST["AddSkill"])) {
                    echo ("<p class='notification' style='background-color: green;' >Skill Added.</p>");
                }
                else {
                    echo ("<p class='notification' style='background-color: red;' >Skill not Added</p>");
                }

            }

            $id = $Skills->GetSkillTypeIDByTitle($_POST["AddSkill"]) ;

            echo ("
            <div class='contact-form setting'>
             <form method='post' action=''>
             <p>
              <label>Titre</label>
              <input name='titleSkill' placeholder='Title of Skill' type='text' required>
            </p>
            <p>
            <label>Compétence Level</label>
              <input name='competenceLevel' placeholder='competenceLevel' type='number' min='-1' max='100' required>
            </p>

                <p>
                <button name='AddSkill' value='" . htmlspecialchars($Skills->GetSkillTypeIDByTitle($_POST["AddSkill"])) . "' type='submit'>Add</button>
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
        }
        elseif( isset($_POST['editSkill'])) {

            $data = $Skills->GetSkills()->getPost($_POST['editSkill']);

            echo ("<h3 class='titleOfWebsiteOverview'>Edit " . $data[0]["title"] . " </h3>");
            if (isset($_POST["newTitle"]) && isset($_POST['skillPercentage'])) {
               
                
                $res = $Skills->GetSkills()->Edit($_POST['editSkill'],$_POST["newTitle"], $_POST["skillPercentage"]) ;

                if ( $_POST['newTitle'] != $_POST['editSkill']) {
                    
                    $data = $Skills->GetSkills()->getPost($_POST["newTitle"]);
                    $_POST['editSkill'] = $_POST['newTitle'] ;

                }
                
                
                if ($res) {
                    echo ("<p class='notification' style='background-color: green;' >Career Update</p>");
                    
                } else {
                    echo ("<p class='notification' style='background-color: red;' >failure of the career update</p>");
                }
            }

            $data = $Skills->GetSkills()->getPost($_POST['editSkill']);
            
            echo("    
    <div class='contact-form setting'>
    
    <form action='' method='post'>
    
    <P>
    <label>Skill Title</label>
    <input name='newTitle' type='text' value='" . htmlspecialchars($data[0]["title"]) . "' required>
    </P>

    <p>
    <label>Skill Percentage</label>
    <input name='skillPercentage' placeholder='-1 if you do not want to display the percentages' type='number' min='-1' max='100' value='".htmlspecialchars($data[0]["Percentage"])."' required> 
    
    </p>

    <p>
    <button style='margin-bottom: 2vh' name='editSkill' value='" . htmlspecialchars($data[0]["title"]) . "' type='submit'>Save</button>
    </p>
    
        
     
    </form>
<form method='post' action=''>
<p>
<button value='submit' type='submit'>Cancel</button>
</p>
  
</form> 
    




        <form action='' method='POST'>

        <button style='margin-bottom: 2vh' name='deleteCarrierEvent' value='" . htmlspecialchars($data[0]["title"]) . "' type='submit'>Delete</button>

        </form>
");


        }

        elseif (isset($_POST["deleteType"])){

            echo ("<h3 class='titleOfWebsiteOverview'>Are you sure</h3>

            <div class='contact-form setting'>
            <form method='post' action=''>
            <p>
            <label> Write the name of Project :" . $_POST['deleteType'] . " </label>
            <input name='nameOfSkillType' type='text' value='I DONT WANT TO DELETE THE PROJECT' required>
            </p>
            <p>
            <button name='reallyDeleteCarrierType'value='" . htmlspecialchars($_POST['deleteType']) . "' type='submit'>Submit</button>
            </p>
            
            </form>

            </div>
    
        ");

        }

        elseif (isset($_POST["deleteCarrierEvent"])){

            echo ("<h3 class='titleOfWebsiteOverview'>Are you sure</h3>

            <div class='contact-form setting'>
            <form method='post' action=''>
            <p>
            <label> Write the name of Project :" . $_POST['deleteCarrierEvent'] . " </label>
            <input name='nameOfSkillEvent' type='text' value='I DONT WANT TO DELETE THE Carrier Event' required>
            </p>
            <p>
            <button name='reallyDeleteCarrierEvent'value='" . htmlspecialchars($_POST['deleteCarrierEvent']) . "' type='submit'>Submit</button>
            </p>
            
            </form>

            </div>
    
        ");

        }
        // Pour choisir un type de carrières
       else {

            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Skill Type</h3>
<div class='contact-form setting'>");

            if (isset($_POST['saveArticle'])) 
            {
                if (isset($_POST['skillPercentage']) && $_POST['newTitle']) {
                    if ($Skills->Edit($_POST['saveArticle'], $_POST['newTitle'], $_POST['skillPercentage'])) {
                        echo ("<p class='notification' style='background-color: green;' >Article update.</p>");
                    } else {
                        echo ("<p class='notification' style='background-color: red;' >failure of the article update</p>");
                    }
                }
            } 
            else 
            {
                if (isset($_POST['reallyDeleteCarrierType']) && isset($_POST['nameOfSkillType'])) {
                    if ($_POST['reallyDeleteCarrierType'] == $_POST['nameOfSkillType']) {
                        if ($Skills->Remove($_POST['reallyDeleteCarrierType'])) {
                            echo ("<p class='notification' style='background-color: green;' >Project deleted with success</p>");
                        }
                        else {
                            echo ("<p class='notification' style='background-color: red;' >Unable to delete this project</p>");
                        }
                    }
                    else {
                        echo ("<p class='notification' style='background-color: green;' >Project not deleted</p>");
                    }
                }
                else {
                    if (isset($_POST['reallyDeleteCarrierEvent']) && isset( $_POST['nameOfSkillEvent'])) {
                        if($_POST['reallyDeleteCarrierEvent'] == $_POST['nameOfSkillEvent']) {
                            if ($Skills->GetSkills()->Remove($_POST['reallyDeleteCarrierEvent'])) {
                                echo ("<p class='notification' style='background-color: green;' >Project deleted with success</p>");
                            }
                            else {
                                echo ("<p class='notification' style='background-color: red;' >Unable to delete this project</p>");
                            }
                        }
                        else {
                            echo ("<p class='notification' style='background-color: green;' >Project not deleted</p>");
                        }  
                    }
                }
               
            }
        


            $data =  $Skills->GetAllPosts();



            if (count($data) > 0) {
                foreach ($data as $post) {
                    echo ("
        <form action='' method='POST'>
         <div class='projetPreview'>
          <p>" . $post["title"] . "</p>
          <button name='chooseCarrierType' value='" . htmlspecialchars($post["title"]) . "' type='submit'>Edit</button>
         </div> 
        </form>
        ");
                }
            } else {
                echo ("
            <p>You have not added any article to the website</p>
            ");
            }
        
        }
    



        ?>
    </div>
    </div>







    <script src="../../script/app.js"></script>

</html>