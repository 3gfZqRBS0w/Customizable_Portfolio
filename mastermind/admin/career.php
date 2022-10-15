
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
    <!-- Pour rajouter des types de carrières -->
        <h3 class="titleOfWebsiteOverview">Add Carrier Type</h3>
        <?php
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
        </div>Carrier-Event

    </div>

    <div class="websiteOverview">

        <?php

// Pour choisir son type de carrière
        if (isset($_POST["chooseCarrierType"])) 
        {
            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Event</h3>
    <div class='contact-form setting'>");

            $data =  $Carrier->GetEvent()->GetAllCarrierEvents($Carrier->GetCarrierTypeIDByTitle($_POST["chooseCarrierType"]));

            if (count($data) <= 0) {
                echo ("<p>
        Il n'y a aucune carrière associé a ce type
        </p>");
            } else {

                
                foreach ($data as $post) {
                    echo ("
        <form action='' method='POST'>
         <div class='projetPreview'>
          <p>" . $post["title"] . "</p>
          <button name='editCareerEvent'value='" . $post["title"] . "' type='submit'>Edit</button>
         </div> 
        </form>
        ");
                }
            }
            $id = $Carrier->GetCarrierTypeIDByTitle($_POST["chooseCarrierType"]) ;
    
            echo ("<form action='' method='POST'>

            <label>Action sur les types de carrières</label>
    <p>
    <button name='AddCareerEvent'value='" . $_POST["chooseCarrierType"] . "' type='submit'>Add Career Event</button>
    </p>

    <p>
     <button name='deleteCarrierType'value='" . $_POST["chooseCarrierType"] . "' type='submit'>Delete Career Type</button>
    </p>

    <p>
    <button type='submit'>CANCEL</button>
    </p>
    </form>");
        }

        // Pour ajouter des événements de carrières
        elseif (isset($_POST["AddCareerEvent"])) 
        {
            echo ("<h3 class='titleOfWebsiteOverview'>Add Carreer Event</h3>");
            if (isset($_POST["startDate"]) && $_POST["endDate"] && $_POST["titleEvent"]) {
                if ($Carrier->GetEvent()->New($_POST["titleEvent"], $_POST["startDate"], $_POST["endDate"], $Carrier->GetCarrierTypeIDByTitle($_POST["AddCareerEvent"]))) {
                    echo ("<p class='notification' style='background-color: green;' >Career Added.</p>");
                }
                else {
                    echo ("<p class='notification' style='background-color: red;' >Career not Added</p>");
                }

            }

            $id = $Carrier->GetCarrierTypeIDByTitle($_POST["AddCareerEvent"]) ;

            echo ("
            <div class='contact-form setting'>
             <form method='post' action=''>
             <p>
              <label>Titre</label>
              <input name='titleEvent' placeholder='Title of Event' type='text' required>
            </p>
            <div style='display: flex; justify-content: space-evenly;'>
              <div style='width: 30%;'>
                <label for='start'>Start date</label>
                 <input type='date' id='start' name='startDate' required>
                 </div>
                 <div style='width: 30%;'>
                  <label for='end'>End date</label>
                  <input type='date' id='end' name='endDate' required>
                 </div>
                 </div>
                <p>
                <button name='AddCareerEvent' value='" . $_POST["AddCareerEvent"] . "' type='submit'>Add</button>
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

        // Pour configurer les événements de carrières 
        elseif( isset($_POST['editCareerEvent'])) {



            $data = $Carrier->GetEvent()->getPost($_POST['editCareerEvent']);

            echo ("<h3 class='titleOfWebsiteOverview'>Edit " . $data[0]["title"] . " </h3>");


            

            if (isset($_POST["careerContent"]) && isset($_POST["startDate"]) && isset($_POST["endDate"]) && isset($_POST["newTitle"])) {
               
                
                $res = $Carrier->GetEvent()->Edit($_POST['editCareerEvent'],$_POST["newTitle"],$_POST["careerContent"], $_POST["startDate"], $_POST["endDate"]) ;

                if ( $_POST['newTitle'] != $_POST['editCareerEvent']) {
                    $_POST['editCareerEvent'] = $_POST['newTitle'] ;
                    $data = $Carrier->GetEvent()->getPost($_POST['editCareerEvent']);

                }
                
            
                if ($res) {
                    echo ("<p class='notification' style='background-color: green;' >Career Update</p>");
                    
                } else {
                    echo ("<p class='notification' style='background-color: red;' >failure of the career update</p>");
                }
            }
            
            echo("    
    <div class='contact-form setting'>
    
    <form action='' method='post'>
    <label>Career Event Title</label>
    <input name='newTitle' type='text' value='" . $data[0]["title"] . "' required>
        <label>Article Content</label>

    <div class='container'>

        <div class='plain'>
            <textarea name='careerContent' data-el='input0'>" . $data[0]["eventText"] . "</textarea>
        </div>
        <div class='text'>
            <div data-el='output0'></div>
        </div>

    </div>

    <div style='display: flex; justify-content: space-evenly;'>
    <div style='width: 30%;'>
      <label for='start'>Start date</label>
       <input type='date' value='" . $data[0]["startDate"] . "' id='start' name='startDate' required>
       </div>
       <div style='width: 30%;'>
        <label for='end'>End date</label>
        <input value='" . $data[0]["endDate"] ."' type='date' id='end' name='endDate' required>
       </div>
       </div>
    
    

    </p>

    <p>
        <button style='margin-bottom: 2vh' name='editCareerEvent' value='" . $data[0]["title"] . "' type='submit'>Save</button>
        <button value='submit' type='submit'>Cancel</button>
        </p>
    </form>
        <form action='' method='POST'>

        <button style='margin-bottom: 2vh' name='deleteCarrierEvent' value='" . $data[0]["title"] . "' type='submit'>Delete</button>

        </form>
");


        }

        elseif (isset($_POST["deleteCarrierType"])){

            echo ("<h3 class='titleOfWebsiteOverview'>Are you sure</h3>

            <div class='contact-form setting'>
            <form method='post' action=''>
            <p>
            <label> Write the name of Project :" . $_POST['deleteCarrierType'] . " </label>
            <input name='nameOfCarreerType' type='text' value='I DONT WANT TO DELETE THE PROJECT' required>
            </p>
            <p>
            <button name='reallyDeleteCarrierType'value='" . $_POST['deleteCarrierType'] . "' type='submit'>Submit</button>
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
            <input name='nameOfCarreerEvent' type='text' value='I DONT WANT TO DELETE THE Carrier Event' required>
            </p>
            <p>
            <button name='reallyDeleteCarrierEvent'value='" . $_POST['deleteCarrierEvent'] . "' type='submit'>Submit</button>
            </p>
            
            </form>

            </div>
    
        ");

        }
        // Pour choisir un type de carrières
       else {

            echo ("<h3 class='titleOfWebsiteOverview'>Choose your Career Type</h3>
<div class='contact-form setting'>");

            if (isset($_POST['saveArticle'])) 
            {
                if (isset($_POST['articleContent']) && $_POST['newTitle']) {
                    if ($Carrier->Edit($_POST['saveArticle'], $_POST['newTitle'], $_POST['articleContent'])) {
                        echo ("<p class='notification' style='background-color: green;' >Article update.</p>");
                    } else {
                        echo ("<p class='notification' style='background-color: red;' >failure of the article update</p>");
                    }
                }
            } 
            else 
            {
                if (isset($_POST['reallyDeleteCarrierType']) && isset($_POST['nameOfCarreerType'])) {
                    if ($_POST['reallyDeleteCarrierType'] == $_POST['nameOfCarreerType']) {
                        if ($Carrier->Remove($_POST['reallyDeleteCarrierType'])) {
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
                    if (isset($_POST['reallyDeleteCarrierEvent']) && isset( $_POST['nameOfCarreerEvent'])) {
                        if($_POST['reallyDeleteCarrierEvent'] == $_POST['nameOfCarreerEvent']) {
                            if ($Carrier->GetEvent()->Remove($_POST['reallyDeleteCarrierEvent'])) {
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
        


            $data =  $Carrier->GetAllPosts();



            if (count($data) > 0) {
                foreach ($data as $post) {
                    echo ("
        <form action='' method='POST'>
         <div class='projetPreview'>
          <p>" . $post["title"] . "</p>
          <button name='chooseCarrierType'value='" . $post["title"] . "' type='submit'>Edit</button>
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