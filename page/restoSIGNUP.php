<?php
require("../restoFUNCTIONS.php");

$signupEmailError = "";
$signupPassword2 = "";
$signupPasswordError = "";
$signupError = "";
$signupEmail = "";
$signupage = "";
$signupageError = "";
$phonenr = "";
$signupgender = "";
$signupgenderError = "";
$signupName = "";
$signupNameError = "";
$signupLName = "";
$signupLNameError = "";

//kas on üldse olemas
if (isset ($_POST ["signupEmail"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST ["signupEmail"])) {
        //oli tõesti tühi
        $signupEmailError = "Sisesta E-mail!";
    } else {

        $signupEmail = $_POST ["signupEmail"];

    }

}
//kas on üldse olemas
if (isset ($_POST["signupName"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST["signupName"])) {
        //oli tõesti tühi
        $signupNameError = "Sisesta eesnimi!";
    } else {

        $signupName = $_POST["signupName"];

    }

}
//kas on üldse olemas
if (isset ($_POST["signupLName"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST["signupLName"])) {
        //oli tõesti tühi
        $signupLNameError = "Sisesta perekonnanimi!";
    } else {

        $signupLName = $_POST["signupLName"];

    }

}
if (isset ($_POST ["phonenr"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST ["phonenr"])) {
        //oli tõesti tühi
        $phonenrError = "Sisesta telefoni number!";
    } else {

        $phonenr = $_POST ["phonenr"];

    }

}
if (isset ($_POST ["signupage"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST ["signupage"])) {
        //oli tõesti tühi
        $signupageError = "Sisesta vanus!";
    } else {

        $signupage = $_POST ["signupage"];

    }

}

//kas on üldse olemas
if (isset ($_POST["signupPassword"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST["signupPassword"])) {
        //oli tõesti tühi
        $signupPasswordError = "Sisesta parool!";

    } else {
        //oli midagi, ei olnud tühi
        //kas pikkust vähemalt 8

        if (strlen($_POST["signupPassword"]) < 8 ) {

            $signupPasswordError = "Parool peab olema vähemalt 8 tähemärki pikk";

        }
    }
}
if (isset ($_POST ["signupPassword"]) or (isset($_POST ["signupPassword2"]))) {
    if (empty($_POST ["signupPassword"]) or (empty($_POST ["signupPassword2"]))) {
        //oli tõesti tühi
        $signupPasswordError = "Sisesta Parool 2 korda!";
    } elseif (($_POST ["signupPassword"]) != ($_POST ["signupPassword2"])) {
        $signupPasswordError = "Paroolid ei ühti!";
    } else {

        $signupPassword = $_POST ["signupPassword"];

    }
}

//tean yhtegi viga ei olnud
if( empty($signupEmailError)&&
    empty($signupPasswordError)&&
    empty($signupNameError)&&
    empty($signupLNameError)&&
    isset($_POST["signupPassword"])&&
    isset($_POST["signupEmail"])&&
    isset($_POST["signupName"])&&
    isset($_POST["signupLName"])&&
    isset($_POST["signupage"])&&
    isset($_POST["signupgender"])&&
    isset($_POST["phonenr"])

)
{

    echo "SALVESTAN...<br>";
    //echo "email: ".$signupEmail."<br>";
    $password = hash ("sha512", $_POST["signupPassword"]);
    //echo "parool: ".$_POST["signupPassword"]."<br>";
    //echo "parooli rasi: ".$password."<br>";
    //echo "vanus: ".$signupage."<br>";
    //echo "nimi: ".$signupName." ".$signupLName."<br>";
    //echo "sugu: ".$signupgender."<br>";
    //echo "telefoni number: ".$phonenr."<br>";

    $signupEmail = cleanInput($signupEmail);
    $password = cleanInput($password);
    $User->signup($signupEmail, $password, $signupName, $signupLName, $signupage, $phonenr, $signupgender);

}

?>
<?php require("../header.php");?>

    <style>
        .account-wall{
            margin-top: 20px;
            padding: 40px 40px 20px 40px;
            background-color: #e4e0e0;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 2px 2px 100px rgba(0, 0, 0, 0.3);
            border-radius: 30px;
        }
    </style>

    <nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
        <ul class="nav navbar-nav">
            <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
            <li class="nav-item active">
                <a class="nav-link" href="restoSISSELOGIMINE.php"><span class="glyphicon glyphicon-log-in"></span> Logi sisse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="restoFEEDBACKnologin.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse">

            <form class="form-inline float-xs-right navbar-right">
                <input class="form-control" style="height: 50px" type="text" placeholder="Otsing">
                <button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


            </form>
        </div>
    </nav>

    <center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
    <span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
    <span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-4 col-sm-offset-4 col-md-offset-4">

        <center><h1><b>Loo kasutaja</b></h1></center>

            <div class="account-wall">

            <form method="POST">
                <p style="color:maroon;"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Kohustuslikud väljad </p>


                <p style="color: lightcoral"><?php echo $signupNameError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Eesnimi</a><br>
                <input class="form-control" placeholder="Eesnimi" name="signupName" type="text"  value = "<?=$signupName;?>">

                <p style="color: lightcoral"><?php echo $signupLNameError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Perekonnanimi</a><br>
                <input class="form-control" placeholder="Perekonnanimi" name="signupLName" type="text" value = "<?=$signupLName;?>">

                <p style="color: lightcoral"><?php echo $signupEmailError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>E-mail</a><br>
                <input class="form-control" placeholder="E-mail" name="signupEmail" type="email"  value = "<?=$signupEmail;?>">

                <p style="color: lightcoral"><?php echo $signupPasswordError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Parool</a><br>
                <input class="form-control" placeholder="Parool" name="signupPassword" type="password"><br>
                <input class="form-control" placeholder="Korda parooli" name="signupPassword2" type="password">

                <p style="color: lightcoral"><?php echo $signupageError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Vanus</a>
                <input  class="form-control" placeholder="Vanus" name="signupage" type="text"  value = "<?=$signupage;?>">

                <p style="color: lightcoral"></p><a style="color: dodgerblue">Telefoni number</a>
                <input class="form-control" placeholder="telefoni number" name="phonenr" type="number">

                <p style="color: lightcoral"><?php echo $signupgenderError; ?></p><a style="color: dodgerblue"><span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>Sugu</a>
                <br>
                <input type="radio" name="signupgender" value="Mees"  checked> Mees
                <input type="radio" name="signupgender" value="Naine"> Naine
                <br><br>


                <a style="color: dodgerblue">Soovin RestoGuru soovitusi e-mailile</a>
                <br>
                Jah<input name="Olen RestoGuru" type="radio" checked>&nbsp&nbsp&nbsp&nbsp
                <input name="Olen RestoGuru" type="radio">Ei

                <br><br>

                <p class="text-center"><button type="submit" class="btn btn-success">Loo kasutaja
                        <span class="glyphicon glyphicon-check"></span>
                    </button></p>

                <br>


                <!--<audio controls autoplay loop >
                    <source src="intro.mp3" type="audio/mpeg"  >;
                </audio>-->



            </form>
            </div>
        </div>
    </div>
</div>

<?php require("../footer.php");?>