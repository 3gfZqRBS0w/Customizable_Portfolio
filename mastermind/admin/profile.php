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


    <style>

        
        .setting {
            margin-left: 2.5vw;
            margin-right: 2.5vw;

            text-align: center;
        }

        .notification {


            text-align: center;
            position: relative;
            width: 100%;

        }

        .container {
            display: flex;
            justify-content: space-between;
            text-align: left;
        }


        .plain,
        .text {
            flex: 1 0 20rem;
            
            position: relative;
        }

        [data-el="input"] {
            border-width: 1px;
            color: black;
            caret-color: black;
            white-space: break-spaces;
            word-break: break-word;
            resize: vertical;
        }

        [data-el="input"][data-initialized="true"] {
           /*color: transparent;
            resize: none;
            overflow: hidden;*/
        }

        [data-el="highlight"] {
            font-family: inherit;
            line-height: inherit;
            font-size: inherit;
            margin: 0;
            padding: 0;
            white-space: break-spaces;
            word-break: break-word;
        }

        .plain__highlights {
            position: absolute;
            top: 0;
            left: 0;
            width: 90%;
            border: 1px solid transparent;
            pointer-events: none;
        }

        .plain__editor,
        .plain__highlights {
            width: 90%;
            font-size: 1.1rem;
            font-family: monospace;
            margin: 0;
            padding: 0.7rem 1.4ch;
            line-height: 1.313;
        }
         /*-----------*/

         .plain2,
        .text2 {
            flex: 1 0 20rem;
            position: relative;
        }

         [data-el="input2"] {
            border-width: 1px;
            color: black;
            caret-color: black;
            white-space: break-spaces;
            word-break: break-word;
            resize: vertical;
        }

        [data-el="input2"][data-initialized="true"] {
            /*color: transparent;
            resize: none;
            overflow: hidden;*/
        }

        [data-el="highlight2"] {
            font-family: inherit;
            line-height: inherit;
            font-size: inherit;
            margin: 0;
            padding: 0;
            white-space: break-spaces;
            word-break: break-word;
        }

        .plain__highlights2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 90%;
            border: 1px solid transparent;
            pointer-events: none;
        }

        .plain__editor2,
        .plain__highlights2 {
            width: 90%;
            font-size: 1.1rem;
            font-family: monospace;
            margin: 0;
            padding: 0.7rem 1.4ch;
            line-height: 1.313;
        }

        /*---------------------------------*/

        .plain3,
        .text3 {
            flex: 1 0 20rem;
            position: relative;
        }

         [data-el="input3"] {
            border-width: 1px;
            color: black;
            caret-color: black;
            white-space: break-spaces;
            word-break: break-word;
            resize: vertical;
        }

        [data-el="input3"][data-initialized="true"] {
            /*color: transparent;
            resize: none;
            overflow: hidden;*/
        }


        [data-el="highlight3"] {
            font-family: inherit;
            line-height: inherit;
            font-size: inherit;
            margin: 0;
            padding: 0;
            white-space: break-spaces;
            word-break: break-word;
        }

        .plain__highlights3 {
            position: absolute;
            top: 0;
            left: 0;
            width: 90%;
            border: 1px solid transparent;
            pointer-events: none;
        }

        .plain__editor3,
        .plain__highlights3 {
            width: 90%;
            font-size: 1.1rem;
            font-family: monospace;
            margin: 0;
            padding: 0.7rem 1.4ch;
            line-height: 1.313;
        }
    </style>


    <link rel="stylesheet" type="text/css" href="../../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../../styles/admin.css">
    <link rel="stylesheet" type="text/css" href="../../styles/panel.css">
    <title>Setting</title>

</head>

<body>
    <?= (Utility::getHeader($CheminPageAdminConnecte, "Profile", "Customize your profile")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Profile Settings</h3>
        <?php
        if (isset($_POST["lastName"]) && isset($_POST["surName"]) && isset($_POST["nameOfWebsite"]) && isset($_POST["websiteSubtitle"])) {
        }
        ?>
        <div>
            <div class="contact-form setting">
                <form action="" method="post">
                    <p>
                        <label>Profile picture</label>
                        <input type="file" name="profilePicture">
                    </p>
                    <p>

                        <label>Welcome Message</label>
                    <div class="container">
                        <div class="plain">
                            <textarea class="plain__editor" data-el="input"><?= file_get_contents("../../markdown/summary.md") ?></textarea>
                          
                        </div>
                        <div class="text">
                            <div data-el="output"></div>
                        </div>
                    </div>

                    </p>

                    <p>
                        <label>Under the image</label>
                        <div class="container">
                        <div class="plain2">
                            <textarea class="plain__editor2" data-el="input2"><?= file_get_contents("../../markdown/libellePortrait.md") ?></textarea>
    
                        </div>
                        <div class="text2">
                            <div data-el="output2"></div>
                        </div>
                    </div>
                    </p>


                    <p>
                        <label>End Message</label>
                        <div class="container">
                        <div class="plain3">
                            <textarea class="plain__editor3" data-el="input3"><?= file_get_contents("../../markdown/closing_message.md") ?></textarea>
    
                        </div>
                        <div class="text3">
                            <div data-el="output3"></div>
                        </div>
                    </div>
                    </p>

                    <p>
                        <label>Message 4</label>
                        <div class="container">
                        <div class="plain3">
                            <textarea class="plain__editor3" data-el="input3"><?= file_get_contents("../../markdown/closing_message.md") ?></textarea>
    
                        </div>
                        <div class="text3">
                            <div data-el="output3"></div>
                        </div>
                    </div>
                    </p>
                   
                    <p>
                        <button type="submit">Save</button>
                    </p>
                </form>
            </div>



            <div>

            </div>


</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js'></script>
<script src="../../script/markdown.js"></script>
<script src="../../script/app.js"></script>

</html>