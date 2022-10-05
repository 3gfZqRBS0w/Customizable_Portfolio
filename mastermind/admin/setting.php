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
    <?=(Utility::getHeader($config["redirection"]["dashboard"], "Settings", "Manage Your Settings")) ?>

    <div class="websiteOverview">
        <h3 class="titleOfWebsiteOverview">Panel Settings</h3>
        <?php
        if ( isset($_POST["lastName"]) && isset($_POST["surName"]) && isset($_POST["nameOfWebsite"]) && isset($_POST["websiteSubtitle"]) )
        {
            Utility::addlog($bdd,5) ;
            $lastName = $_POST["lastName"];
            $surName = $_POST["surName"];
            $nameOfWebsite = $_POST["nameOfWebsite"];
            $websiteSubtitle = $_POST["websiteSubtitle"];
        
            echo("<p class='notification' style='background-color: green;' >Setting updating.</p>") ;
            Utility::setOwnerData($bdd, $lastName ,$surName, $nameOfWebsite, $websiteSubtitle) ; 
            
        }
        ?>


<div>
    <div class="contact-form setting">
        <form action="" method="post">
            <p>
                <label>Last Name</label>
                <input value="<?=Utility::getOwnerData($bdd, "lastName")?>" type="text" name="lastName" required> 
            </p>
            <p>
                <label>Surname</label>
                <input value="<?=Utility::getOwnerData($bdd, "surName")?>" type="text" name="surName" required>
            </p>

            <p>
                <label>Name of Website</label>
                <input value="<?=Utility::getOwnerData($bdd, "nameOfWebsite")?>" type="text" name="nameOfWebsite" required>
            </p>
            <p>
               <label>Website Subtitle</label> 
               <input value="<?=Utility::getOwnerData($bdd, "websiteSubtitble")?>" type="text" name="websiteSubtitle" required>
            </p>

            <p>
                <button type="submit">Save</button>
            </p>
        </form>
    </div>
    </div>
    </div>

    <?php



if (!$Owner->CheckQRCode()) {

   

    $otp->setLabel("Customizable_Portfolio") ;
    $chr = $otp->getProvisioningUri() ;
    $link = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=".$chr;

    echo("
    
    
    <div class='websiteOverview'>
    <h3 class='titleOfWebsiteOverview'>2FA Setup</h3>") ;

    if (isset($_POST['qrCode'])) {
        $attempt = $_POST['qrCode'];
        if (strlen($attempt) == 6) {
            if ($otp->verify($attempt)) {
                $Owner->ActiveCheckQRCode() ;
                header('Location: ../deconnexion.php');

            }
            else {
                echo("<p class='notification' style='background-color: red;' >Mauvais code</p>") ;
            }
        }
        else {
            echo("<p class='notification' style='background-color: orange;' >La taille ne correspond pas</p>") ;
        }
    }


    echo("
    
    
    <div class='contact-form setting'>
        <form action='' method='post'>
        <p>
                <label>Connect your authentificator app<br>Using an authentificator app like Google Authentificator, Authy or Duo, scan the QR code. It will display 6 code which you need to enter below</label>
                
            </p>
            <div class='container'>
                <div>
                <p>To activate the double authentication please write the code you get by scanning this QR CODE</p>

                <label>Code</label>
                <input minlength='6' maxlength='6' value='000000' type='text' placeholder='QRCODE' name='qrCode' required>
                <label>Secret Message for reset 2FA</label>
                ".$Owner->GetQRSecret()."
                </div>



                <div>
                <img id='qrcode' src='$link'_urlalt=''>
                </div>
            </div>
            <p>
            <button type='submit'>Save</button>
        </p>
        </form>
    </div>
</div>
    
    ") ; 
}
else {
    echo("

        
    <div class='websiteOverview'>
    <h3 class='titleOfWebsiteOverview'>2FA Setup</h3>
    
    <div class='contact-form setting'>
        <form action='' method='post'>
        <p>
                <label>2FA</label>
                
            </p>
            <div class='container'>
                <div>
                <p>To disable dual authentication you must enter the secret key</p>

                <label>Code</label>
                <input minlength='1' maxlength='255' type='text' placeholder='QRCODE' name='qrCode' required>
                </div>
            </div>
            <p>
            <button type='submit'>Save</button>
        </p>
        </form>
    </div>
</div>
    
    ") ; 

}
 ?>

</body>

<script src="../../script/app.js"></script>
</html>
