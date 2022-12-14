<!--
        <div class="bloc" id="bloc2">
            <div>
                <h2>My school career</h2>
                <hr><br>
                <div class="w3-container">
                    <div class="experience">
                        <h3>School #1</h3>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed</p>
                        <p>20XX - 20XX</p>
                    </div>

                    <div class="experience">
                        <h3>School #2</h3>
                        <div>20XX</div>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed </p>
                        <p>20XX - 20XX</p>
                    </div>
                </div>
            </div>

            <div>
                <h2>My professional experiences</h2>
                <hr><br>
                <div class="w3-container">
                    <div class="experience">
                        <h3>Internship #1 - Job</h3>
                        <p>Company</p>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed </p>
                        <p>XX XXX au XX XXX 20XX</p>
                    </div>
                </div>
            </div>
        </div>
-->


<?php


require_once(__DIR__ . "/init.php");
/*
$abc = $otp->create();
echo "The OTP secret is: {$abc->getSecret()}\n";    
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/main.css">

    <title>Portfolio | <?= Utility::getOwnerData($bdd, "lastName") ?> <?= Utility::getOwnerData($bdd, "surName") ?></title>
</head>


<body>

    <?php
    session_start();


    if (isset($_SESSION["codeSecret"]) && Utility::IsValidPassword($bdd, $_SESSION["codeSecret"]) && ($Owner->CheckQRCode() || isset($_SESSION["qrCode"]))) {
        echo (Utility::getHeader($config["redirection"]["admin"], Utility::getOwnerData($bdd, "nameOfWebsite"), Utility::getOwnerData($bdd, "websiteSubtitble")));
    } else {
        echo (Utility::getHeader($config["redirection"]["default"], Utility::getOwnerData($bdd, "nameOfWebsite"), Utility::getOwnerData($bdd, "websiteSubtitble")));
    }

    if ( isset($_POST['fullname']) && ( isset($_POST['email']) || isset($_POST['phone']) ) && isset($_POST['objet']) && isset($_POST['message']) ) {
        if ( $Logs->IsPotentiallyBruteForceAttackForContactForm($_SERVER['REMOTE_ADDR'])) {
            if ($Contact->New($_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['objet'],$_POST['message'], $Logs->AddLog(27))) {
                echo ("<p class='notification' style='background-color: green;' >Le message a ??t?? envoy??</p>");
            }
            else {
                echo ("<p class='notification' style='background-color: red;' >V??rifier ce que vous avez entr??e</p>");
            }
        }
        else {
            echo ("<p class='notification' style='background-color: orange;' >Nombre de soumission maximum</p>");
        }
    }
 


    ?>
    <main>
        <div class="bloc" id="bloc1">
            <div id="container1">
                <div id="blocTexte1">
                    <?= $Parsedown->text(file_get_contents(Utility::SUMMARY_PATH)) ?>
                </div>
                <div id="monPortrait">
                    <img id="profile" src=<?=$Owner->GetProfilePath()?>>
                    <?=$Parsedown->text(file_get_contents(Utility::LIBELLE_PORTRAIT_PATH))?>
                </div>
            </div>
        </div>
        <div style="padding-top:10vh; background: #E8F1F2;">
            <hr id="separationCategories">
</div>
<div class="bloc" id="bloc2">
        <?php

         foreach($Carrier->GetAllPosts() as $key => $value ) {

            echo("<div><h2>".$value["title"]."</h2><br><hr><br><div>");

            foreach($Carrier->GetEvent()->GetAllCarrierEvents($value["id"]) as $key => $value ) {

                echo("<details>
                <summary class='summary'>
                <div>".$value["title"]."</div>
                <div>".substr($value["startDate"],0,4 )."-".substr($value["endDate"],0,4 )."</div>
                </summary>") ;


                echo("
                <div class='description'>
                ".$value["eventText"]."
                </div>
            </details>") ;

            }
            
            
            echo("
            </div>
            </div>
            ") ;

         }
        ?>
</div>



        <!--

        
            <div>
                <h2>My school career</h2>
                <hr><br>
                <div>
                    <details>
                        <summary>School #1</summary>
                        <div class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione adipisci illum error, hic expedita numquam impedit explicabo vitae iure quae vero autem quia quibusdam tempora atque harum perferendis praesentium dolor!</p>
                        </div>
                    </details>
                    <details>
                        <summary>School #2</summary>
                        <div class="description">
                            <p>Consequuntur earum pariatur dolorem repellat temporibus ducimus sunt suscipit repudiandae cupiditate in accusantium recusandae tempora sint eligendi, perferendis aspernatur architecto voluptas laborum adipisci neque voluptates consequatur. </p>
                        </div>
                    </details>
                    <details>
                        <summary>School #3</summary>
                        <div class="description">
                            <p>Tenetur, ex delectus, perferendis aperiam voluptatem consequuntur molestiae ratione rerum vitae ab modi, minus placeat quis dignissimos. Dolorem quaerat odit, iusto laboriosam possimus, in architecto aliquam commodi sapiente saepe sequi at eligendi hic reprehenderit repellendus quos!</p>
                        </div>
                    </details>
                </div>
            </div>
            <div>
                <h2>My professional experiences</h2>
                <hr><br>
                <div >
                    <details>
                        <summary>School #1</summary>
                        <div class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione adipisci illum error, hic expedita numquam impedit explicabo vitae iure quae vero autem quia quibusdam tempora atque harum perferendis praesentium dolor!</p>
                        </div>
                    </details>
                    <details>
                        <summary>School #2</summary>
                        <div class="description">
                            <p>Consequuntur earum pariatur dolorem repellat temporibus ducimus sunt suscipit repudiandae cupiditate in accusantium recusandae tempora sint eligendi, perferendis aspernatur architecto voluptas laborum adipisci neque voluptates consequatur. </p>
                        </div>
                    </details>
                    <details>
                        <summary>School #3</summary>
                        <div class="description">
                            <p>Tenetur, ex delectus, perferendis aperiam voluptatem consequuntur molestiae ratione rerum vitae ab modi, minus placeat quis dignissimos. Dolorem quaerat odit, iusto laboriosam possimus, in architecto aliquam commodi sapiente saepe sequi at eligendi hic reprehenderit repellendus quos!</p>
                        </div>
                    </details>
                </div>
            </div>
        </div>

-->


        <?php
       // $allProjects = Utility::getAllData($bdd, "tbl_projects");

       $allProjects = $Projects->GetAllPosts() ;
        $i = 0;
        if (count($allProjects) > 0) {
            echo ("<div class='bloc' id='bloc3'>
                <div class='categoryTitle'>
                    <h2><a href='projets.php'>My latest projects (click to see all projects)</a></h2>
                    <hr style='width: 80%;'>
                </div>
                <div class='container1'>");

            foreach ($allProjects as $value) {
                if ($i < 3) {
                    Utility::displayPreviewProject($value["title"], "upload/" . $value["photoName"]);
                    $i++;
                }
            }
            echo (" </div>
            </div>
            </div>");
        }
        ?>

        <div class="bloc" id="bloc3">
            <?php
            $allSkills = $Skills->GetAllPosts() ;
            ?>
        </div>
        </div>


        <?php
        $allSkill = $Skills->GetAllPosts() ;
        if ( count($allSkill) > 0 ) {
            echo("<div class='bloc' id='bloc4'>
            <div class='categoryTitle'>
                    <h2>My skills and qualifications</h2>
                    <hr style='width: 80%;'>
                </div>
                <div class='blocOfSkills'>
                
            ") ;
            foreach($allSkill as $value) {
                echo("<div class='blocOfSkill'> <ul class='competenceList'>".$value["title"]."<hr>") ;
                foreach($Skills->GetSkills()->GetAllAssociatedSkill($value["id"]) as $skill) {
    
                    echo("
                    
                    <li>".$skill["title"]);
                    
                    if ( $skill["activationPercentage"] ) {
                        echo("
                        <div class='skillBar'>
                            <div style=' width:".$skill["Percentage"]."%' class='intoSkillBar'>
                                <div class='growUp'>".$skill["Percentage"]."%</div>
                            </div>
                        </div>
                    
            ") ;
                    }
             
    
                    echo("</li>") ; 
    
    
                }
                echo("</ul></div>") ;
            }
            echo("</div>") ;
        } 
        ?>
 

        <!--
        <div class="bloc" id="bloc4">
            <div class="categoryTitle">
                <h2>My skills and qualifications</h2>
                <hr style="width: 80%;">
            </div>
            <div class="blocOfSkills">
                <div class="blocOfSkill">
                    <h3>Competence List #1</h3>
                    <hr>
                    <ul class="competenceList">
                        <li>Competence #1
                            <div class="skillBar">
                                <div style="width: 90%;" class="intoSkillBar">
                                    <div class="growUp">90 %</div>
                                </div>
                            </div>
                        </li>
                        <li>Competence #2
                            <div class="skillBar">
                                <div style="width: 80%;" class="intoSkillBar">
                                    <div class="growUp">80 %</div>
                                </div>
                            </div>
                        </li>
                        <li>Competence #3
                            <div class="skillBar">
                                <div style="width: 60%;" class="intoSkillBar">
                                    <div class="growUp">60 %</div>
                                </div>
                            </div>
                        </li>
                        <li>Competence #4
                            <div class="skillBar">
                                <div style="width: 50%;" class="intoSkillBar">
                                    <div style="background-color: yellow;" class="growUp">50 %</div>
                                </div>
                            </div>
                        </li>

                        <li>Competence #5
                            <div class="skillBar">
                                <div style="width: 30%;" class="intoSkillBar">
                                    <div style="background-color: red;" class="growUp">30 %</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="blocOfSkill">
                    <h3> Competence List #2</h3>
                    <hr>
                    <ul class="competenceList">
                        <li>Competence #1
                            <div class="skillBar">
                                <div style="width: 70%;" class="intoSkillBar">
                                    <div class="growUp">70 %</div>
                                </div>
                            </div>
                        </li>
                        <li>Competence #2
                            <div class="skillBar">
                                <div style="width: 40%;" class="intoSkillBar">
                                    <div style="background-color: yellow;" class="growUp">40 %</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="blocOfSkill">
                    <h3>Competence List #3</h3>
                    <hr>
                    <ul class="competenceList">
                        <li>Competence #1
                            <div class="skillBar">
                                <div style="width: 60%;" class="intoSkillBar">
                                    <div class="growUp">60 %</div>
                                </div>
                            </div>
                        </li>
                        <ul class="competenceList">
                            <li>Competence #2
                                <div class="skillBar">
                                    <div style="width: 50%;" class="intoSkillBar">
                                        <div style="background-color: yellow;" class="growUp">50 %</div>
                                    </div>
                                </div>
                            </li>
                            </li>
                            <li>Competence #3
                                <div class="skillBar">
                                    <div style="width: 40%;" class="intoSkillBar">
                                        <div style="background-color: yellow;" class="growUp">40 %</div>
                                    </div>
                                </div>
                            </li>
                            <li>Competence #4
                                <div class="skillBar">
                                    <div style="width: 30%;" class="intoSkillBar">
                                        <div style="background-color: red;" class="growUp">30 %</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                </div>

                <div class="blocOfSkill">
                    <h3>Other skill</h3>
                    <hr>
                    <ul>
                        <li>Other skill #1</li>
                        <li>Other skill #2</li>
                        <li>Other skill #3 </li>
                        <li>Other skill #4</li>
                    </ul>
                </div>
            </div>

        </div>

    -->
 
      


        <?php

        $allArticle = $Articles->GetAllPosts();


        if (count($allArticle) > 0) {
            echo ("<div class='bloc' id='bloc5'>
            <div class='categoryTitle'>
                <h2><a href='articles.php'>My latest articles</a></h2>
                <hr style='width: 80%;'>
            </div>
            <div class='veilleTechnologique'>");
            $i = 0;

            foreach ($allArticle as $Article) {
                if ($i < 3) {
                    Utility::displayPreviewArticle($Article["title"], $Article["fullTextOfArticles"]);

                    $i++;
                } else {
                    break;
                }
            }


            echo ("</div>
            </div>");
        }
        ?>

        <!--
                <div class="articleVeille">
                    <h3><a>??? Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet mattis vulputate enim nulla. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Vestibulum lectus mauris ultrices eros in. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque. Ornare suspendisse sed nisi lacus sed. Nullam eget felis eget nunc lobortis. Augue mauris augue neque gravida in fermentum et sollicitudin ac. Euismod elementum nisi quis eleifend. Id faucibus nisl tincidunt eget nullam. Purus gravida quis blandit turpis cursus in hac habitasse platea. Aliquam etiam erat velit scelerisque. Tellus elementum sagittis vitae et leo duis ut diam quam. Dui faucibus in ornare quam. Iaculis at erat pellentesque adipiscing commodo elit.</p>
                </div>
            
        -->


        <div class="bloc" id="bloc5">
            <div class="categoryTitle">
                <h2>Me contacter</h2>
                <hr style="width: 80%;">
            </div>

            <div class="content">


                <div class="contact-wrapper animated bounceInUp">
                    <div class="contact-form">
                        <form action="" method="POST">
                            <p>
                                <label>Nom/Pr??nom</label>
                                <input type="text" name="fullname">
                            </p>
                            <p>
                                <label>Adresse E-Mail</label>
                                <input  type="email" name="email">
                            </p>
                            <p>
                                <label>Num??ro de T??l??phone</label>
                                <input type="tel" name="phone">
                            </p>
                            <p>
                                <label>Objet</label>
                                <input type="text" name="objet">
                            </p>
                            <p class="block">
                                <label>Message</label>
                                <textarea name="message" rows="3"></textarea>
                            </p>
                            <p class="block">
                                <button name="contact" type="submit">Soumettre</button>
                            </p>
                        </form>
                    </div>
                    <div class="contact-info">
                        <h2>TITLE</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <ul>
                            <li>??? mail@mail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <?php
        echo (Utility::getFooter());
        ?>

</body>

</html>

<script src="script/app.js"></script>