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
if (isset ($_POST ["signupage"])) {
            // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST ["signupgender"])) {
                    //oli tõesti tühi
        $signupgenderError = "Vali sugu!";
    } else {

        $signupgender = $_POST ["signupgender"];
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

    $signupEmail = $Helper->cleanInput($signupEmail);
    $password = $Helper->cleanInput($password);
    $User->signup($signupEmail, $password, $signupName, $signupLName, $signupage, $phonenr, $signupgender);

}

?>
<?php require("../header.php");?>
<?php require("../CSS.php");?>
	

<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
	<ul class="nav navbar-nav">
		<a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
		<li class="nav-item active">
			<a class="nav-link" href="restoSISSELOGIMINE.php" style="color: maroon"><span class="glyphicon glyphicon-log-in"></span> Logi sisse</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="restoFEEDBACKnologin.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
		</li>
	</ul>
	<div class="collapse navbar-collapse">

		<form class="form-inline float-xs-right pull-right">
			<input class="form-control" style="height: 50px" type="text" placeholder="Otsing">
			<button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


		</form>
	</div>
</nav>
<br><br><br>
<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
<span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-5 col-sm-offset-2 col-md-offset-3">

        <center><h1><b>Loo kasutaja</b></h1></center>

            <div class="account-wall">

            <form method="POST">
                <p style="color: lightcoral"> Kohustuslikud väljad </p>


                <p style="color: lightcoral"><?php echo $signupNameError; ?></p>
                <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span style="color: lightcoral" class="fa fa-quote-left" ></span>
                            </span>
                    <input class="form-control" placeholder="Eesnimi" name="signupName" type="text"  value = "<?=$signupName;?>">
                </div>

                <p style="color: lightcoral"><?php echo $signupLNameError; ?></p>
                <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span style="color: lightcoral" class="fa fa-quote-right"></span>
                            </span>
                    <input class="form-control" placeholder="Perekonnanimi" name="signupLName" type="text" value = "<?=$signupLName;?>">
                </div>

                <p style="color: lightcoral"><?php echo $signupEmailError; ?></p>
                <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span style="color: lightcoral" class="glyphicon glyphicon-envelope"></span>
                            </span>
                    <input class="form-control" placeholder="E-mail" name="signupEmail" type="email"  value = "<?=$signupEmail;?>">
                </div>

                <p style="color: lightcoral"><?php echo $signupPasswordError; ?></p>

                <div class="input-group-vertical">
                    <div class="input-group input-group-md">
                                <span class="input-group-addon">
                                    <span style="color: lightcoral" class="glyphicon glyphicon-lock"></span>
                                </span>
                        <input class="form-control" placeholder="Parool" name="signupPassword" type="password">
                        <span class="input-group-addon">
                                    <span style="color: lightcoral" class="glyphicon glyphicon-lock"></span>
                                </span>
                        <input class="form-control" placeholder="Korda parooli" name="signupPassword2" type="password">
                    </div>


                <p style="color: lightcoral"><?php echo $signupageError; ?></p>
                <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span style="color: lightcoral" class="glyphicon glyphicon-font"></span>
                            </span>
                    <input  class="form-control" placeholder="Vanus" name="signupage" type="text"  value = "<?=$signupage;?>">
                </div>

                <p style="color: lightcoral"></p>
                <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span class="fa fa-phone"></span>
                            </span>
                    <input class="form-control" placeholder="telefoni number" name="phonenr" type="number">
                </div>

                <p style="color: lightcoral"><?php echo $signupgenderError; ?></p><a style="color: dodgerblue">
                <br>

                <div class="container">
                    <div>
                        <input id="mees" name="signupgender" type="radio" class="with-font" value="Mees" checked>
                        <label for="mees" style="color: #333333">Olen mees</label>
                    </div>
                    <div>
                        <input id="naine" name="signupgender" type="radio" class="with-font" value="Naine">
                        <label for="naine" style="color: #333333">Olen naine</label>
                    </div>
                </div>


                <p style="color: dodgerblue">Soovin RestoGuru soovitusi e-mailile</p>


                <div class="container">
                    <div>
                        <input id="jah" name="Olen RestoGuru" type="radio" class="with-font" checked>
                        <label for="jah" style="color: #333333">Jah</label>
                    </div>
                    <div>
                        <input id="ei" name="Olen RestoGuru"type="radio" class="with-font">
                        <label for="ei" style="color: #333333">Ei</label>
                    </div>
                </div>

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