<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="style.css">


    <title>Portfolio | LASTNAME FIRSTNAME</title>
</head>

<body>
    <?php require_once("librairies/header.php"); ?>
    <main>
        <div class="bloc" id="bloc1">
            <div id="container1">
                <div id="blocTexte1">
                    <h1>WELCOME MESSAGE </h1>
                    <hr><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel quam elementum pulvinar etiam non quam lacus suspendisse. Ornare massa eget egestas purus. Mauris in aliquam sem fringilla ut morbi tincidunt. Et ultrices neque ornare aenean euismod elementum nisi. Lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Suspendisse faucibus interdum posuere lorem. Facilisis volutpat est velit egestas dui id ornare. At consectetur lorem donec massa sapien faucibus et molestie ac. At lectus urna duis convallis convallis tellus id. Pulvinar mattis nunc sed blandit libero. Varius duis at consectetur lorem donec massa sapien faucibus et. Tristique nulla aliquet enim tortor. Nibh praesent tristique magna sit amet purus gravida quis.<br><br>
                    Consequat mauris nunc congue nisi vitae suscipit tellus mauris. Sapien faucibus et molestie ac feugiat. Lacinia quis vel eros donec ac odio tempor orci. Sit amet cursus sit amet dictum. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Lobortis elementum nibh tellus molestie nunc non blandit massa enim. Sit amet nisl purus in mollis nunc. Sagittis aliquam malesuada bibendum arcu vitae elementum curabitur. Posuere ac ut consequat semper viverra. Felis eget nunc lobortis mattis aliquam faucibus purus in. Etiam tempor orci eu lobortis elementum nibh. Nibh sed pulvinar proin gravida hendrerit. Lectus magna fringilla urna porttitor. Odio aenean sed adipiscing diam donec. Nec ultrices dui sapien eget mi proin sed libero. Eget magna fermentum iaculis eu non diam phasellus vestibulum. Nisi quis eleifend quam adipiscing vitae. Egestas sed tempus urna et pharetra pharetra massa.<br><br>
                    Praesent semper feugiat nibh sed. Ac tortor vitae purus faucibus ornare suspendisse sed. Consequat semper viverra nam libero justo. Dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Consectetur lorem donec massa sapien faucibus et molestie ac feugiat. Sed velit dignissim sodales ut eu sem. Suspendisse in est ante in nibh mauris cursus mattis. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Vitae ultricies leo integer malesuada nunc vel risus commodo. Enim ut tellus elementum sagittis. Nisi quis eleifend quam adipiscing vitae proin. Elementum integer enim neque volutpat ac tincidunt vitae semper. Dignissim convallis aenean et tortor at risus viverra adipiscing.
                    </p>
                </div>
                <div id="monPortrait">
                    <img src="images/portrait.png">
                    <h3 style="text-align: center;">
                        <p>Lorem ipsum dolor</p>
                        <a>➔ LINK 1</a><br>
                        <a>➔ LINK 2</a>
                    </h3>
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
        



        <?php require_once("librairies/footer.php"); ?>

</body>

</html>