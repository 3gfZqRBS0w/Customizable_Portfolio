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
    <title>Setting</title>

</head>

<body>
    <?= (Utility::getHeader($config["redirection"]["dashboard"], "Profile", "Customize your profile")) ?>
    <div class="websiteOverview">
    <h3 class="titleOfWebsiteOverview">Changing the profile image</h3>
    <?php
        if (isset($_POST["newPicture"]) && isset($_FILES['profilePicture'])) {
            $tmpName = $_FILES['profilePicture']['tmp_name'];
            $name = $_FILES['profilePicture']['name'];
            $size = $_FILES['profilePicture']['size'];
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            $error = $_FILES['profilePicture']['error'];
           $extensions = ['png'];
           if (in_array($extension, $extensions)) {
            if ($error == 0) {
                if ($size <= $config["stockage"]["maxProfileSize"]) {
                    $uniqueName = uniqid('', true);
                    $fileName = $uniqueName . "." . $extension;
                    if (!$Owner->IsDefaultProfilePath()) {
                        unlink("../../".$Owner->GetProfilePath()) ;
                    }
                    move_uploaded_file($tmpName, '../../upload/' . $fileName);
                    $Owner->SetProfilePath('upload/'.$fileName) ;
                    echo("<p class='notification' style='background-color: green;' >Profil updated</p>") ;
                }
                else {
                    echo ("<p class='notification' style='background-color: red;' >Picture to big</p>");
                }
            }
            else {
                echo ("<p class='notification' style='background-color: red;' >ERROR</p>");
            }
           }
           else {
            echo ("<p class='notification' style='background-color: red;' >PNG ONLY</p>");
           }

        }
    
    ?>
        <div class="contact-form setting">
            <form action="" method="post" enctype="multipart/form-data">
                <p>
                    <input type="file" name="profilePicture" required>
                </p>
                <p>
                    <button name="newPicture" type="submit">Save</button>
                </p>
            </form>
        </div>

    </div>




    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Profile Settings</h3>
        <?php
        if (isset($_POST["welcomeMessage"]) && isset($_POST["UnderImage"]) && isset($_POST["EndMessage"])) {

            Utility::addlog($bdd,7) ;

            file_put_contents("../../" . Utility::SUMMARY_PATH, $_POST["welcomeMessage"], LOCK_EX);
            file_put_contents("../../" . Utility::LIBELLE_PORTRAIT_PATH, $_POST["UnderImage"], LOCK_EX);
            file_put_contents("../../" . Utility::CLOSING_MESSAGE_PATH, $_POST["EndMessage"], LOCK_EX); 
            echo("<p class='notification' style='background-color: green;' >Profile updated</p>") ;

 

            
        }
        ?>
        <div>
            <div class="contact-form setting">
                <form action="" method="post">


                    <p>
                        <label>Welcome Message</label>
                    <div class="container">
                        <div class="plain">
                            <textarea name="welcomeMessage" data-el="input0"><?= file_get_contents("../../".Utility::SUMMARY_PATH) ?></textarea>
                        </div>
                        <div class="text">
                            <div data-el="output0"></div>
                        </div>
                    </div>

                    </p>



                    <p>
                        <label>Under the image</label>
                    <div class="container">
                        <div class="plain">
                            <textarea name="UnderImage" data-el="input1"><?=file_get_contents("../../". Utility::LIBELLE_PORTRAIT_PATH)?></textarea>
                        </div>
                        
                        <div id="monPortrait">
                            <img class="imagePreview" src=<?="../../".$Owner->GetProfilePath()?>>
                            <div class="text">
                                <div data-el="output1"></div>
                            </div>
                        </div>
                        
                        
                    </div>
                    </p>



                    <p>
                        <label>End Message</label>
                    <div class="container">
                        <div class="plain">
                            <textarea name="EndMessage" data-el="input2"><?= file_get_contents("../../".Utility::CLOSING_MESSAGE_PATH) ?></textarea>
                        </div>


                        
                        <div class="text">
                            <div data-el="output2"></div>
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