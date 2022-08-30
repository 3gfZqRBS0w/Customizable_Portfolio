<?php
    require_once("config/basededonnee.php") ;
    require_once("config/redirection.php") ;
    require_once("config/recuperation.php") ;
    require_once("librairies/Parsedown.php") ; 
    require_once("librairies/Utility.php") ;


require_once("init.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/main.css">


    <title>Portfolio | <?=Utility::getValueOfPrimaryData($bdd, "lastName")?> <?=Utility::getValueOfPrimaryData($bdd, "surName")?></title>
</head>

<body>
    <?php
    session_start(); 
    if (isset($_SESSION["codeSecret"])) {
        echo(Utility::getHeader($PortfolioAdmin, Utility::getValueOfPrimaryData($bdd, "nameOfWebsite"), Utility::getValueOfPrimaryData($bdd, "websiteSubtitble"))) ;
    }
    else {
        echo(Utility::getHeader($Portfolio, Utility::getValueOfPrimaryData($bdd, "nameOfWebsite"), Utility::getValueOfPrimaryData($bdd, "websiteSubtitble"))) ;
    }
     
    ?>
    <main>
        <div class="bloc" id="bloc1">
            <div id="container1">
                <div id="blocTexte1">
                  <?php
                   echo(Utility::ExtractHTMLFromMarkDownFile($bdd, "summaryPath")) ; 
                  ?>
                </div>
                <div id="monPortrait">
                    <img src=<?php echo(Utility::getValueOfPrimaryData($bdd, "profilePath")) ?>>
                    <?php
                   echo(Utility::ExtractHTMLFromMarkDownFile($bdd, "libellePortrait")) ; 
                  ?>
                </div>
            </div>
        </div>
        <div style="padding-top:10vh; background: #E8F1F2;" >
         <hr id="separationCategories">
        </div>
        
        <div class="bloc" id="bloc2">
            <div>
                <h2>My school career</h2>
                <hr><br>
                <div class="w3-container">
                    <div class="zigzag-timeline__item">
                        <div>

                        </div>
                        <h3>School #1</h3>
                        <div class="zigzag-timeline__milestone">Future</div>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed</p>
                        <p>20XX - 20XX</p>
                    </div>

                    <div class="zigzag-timeline__item">
                        <h3>School #2</h3>
                        <div class="zigzag-timeline__milestone">20XX</div>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed </p>
                        <p>20XX - 20XX</p>
                        <p>Obtention du diplome avec la mention ASSEZ BIEN</p>
                    </div>
                </div>
            </div>

            <div>
                <h2>My professional experiences</h2>
                <hr><br>
                <div class="w3-container">
                    <div class="zigzag-timeline__item">
                        <h3>Internship #1 - Job</h3>
                        <p>Company</p>
                        <p>Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed </p>
                        <div class="zigzag-timeline__milestone">Future</div>
                        <p>XX XXX au XX XXX 20XX</p>
                        <a class='nav-link' href="index.php">Rapport de Stage</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bloc" id="bloc3">
            <div class="categoryTitle">
                <h2>My latest projects  </h2>
                <hr style="width: 80%;">
            </div>

            <div class="container1">
                <a href="google.fr">
                    <img class="previewProject" id="element" src="images/web.jpg" alt="image inconnu">
                </a>
                <a href="google.fr">
                    <img class="previewProject" id="element" src="images/web.jpg" alt="image inconnu">
                </a>

                <a href="google.fr">
                    <img class="previewProject" id="element" src="images/web.jpg" alt="image inconnu">
                </a>
            </div>
        </div>
        </div>


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
        <div class="bloc" id="bloc5">
            <div class="categoryTitle">
                <h2>My latest articles</h2>
                <hr style="width: 80%;">
            </div>
            <div class="veilleTechnologique">
                <div class="articleVeille">
                    <h3><a>➔ Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet mattis vulputate enim nulla. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Vestibulum lectus mauris ultrices eros in. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque. Ornare suspendisse sed nisi lacus sed. Nullam eget felis eget nunc lobortis. Augue mauris augue neque gravida in fermentum et sollicitudin ac. Euismod elementum nisi quis eleifend. Id faucibus nisl tincidunt eget nullam. Purus gravida quis blandit turpis cursus in hac habitasse platea. Aliquam etiam erat velit scelerisque. Tellus elementum sagittis vitae et leo duis ut diam quam. Dui faucibus in ornare quam. Iaculis at erat pellentesque adipiscing commodo elit.</p>
                </div>

                <div class="articleVeille">
                    <h3><a>➔ Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet mattis vulputate enim nulla. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Vestibulum lectus mauris ultrices eros in. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque. Ornare suspendisse sed nisi lacus sed. Nullam eget felis eget nunc lobortis. Augue mauris augue neque gravida in fermentum et sollicitudin ac. Euismod elementum nisi quis eleifend. Id faucibus nisl tincidunt eget nullam. Purus gravida quis blandit turpis cursus in hac habitasse platea. Aliquam etiam erat velit scelerisque. Tellus elementum sagittis vitae et leo duis ut diam quam. Dui faucibus in ornare quam. Iaculis at erat pellentesque adipiscing commodo elit.</p>
                </div>
            </div>
        </div>

        <div class="bloc" id="bloc5">
            <div class="categoryTitle">
                <h2>Me contacter</h2>
                <hr style="width: 80%;">
            </div>

            <div class="content">


<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <form action="">
            <p>
                <label>Nom/Prénom</label>
                <input type="text" name="fullname">
            </p>
            <p>
                <label>Adresse E-Mail</label>
                <input type="email" name="email">
            </p>
            <p>
                <label>Numéro de Téléphone</label>
                <input type="tel" name="phone">
            </p>
            <p>
                <label>Objet</label>
                <input type="text" name="affair">
            </p>
            <p class="block">
               <label>Message</label> 
                <textarea name="message" rows="3"></textarea>
            </p>
            <p class="block">
                <button>Soumettre</button>
            </p>
        </form>
    </div>
    <div class="contact-info">
        <h2>TITLE</h2>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <ul>
            <li>➔ mail@mail.com</li>
        </ul>
    </div>
</div>

</div>
        </div>
        



        <?php
        echo(Utility::getFooter() ) ; 
        ?>

</body>

</html>

<script src="script/app.js"></script>