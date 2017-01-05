<?php
	//votab ja kopeerib faili sisu
	require("../restoFUNCTIONS.php");


	//kas kasutaja on sisse loginud
	if(isset ($_SESSION["userId"])) {
		
		header ("Location: restoWELCOME.php");
		exit();
		
	}
	
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	

	$loginpassword = "";
	$loginpasswordError = "";
	$loginEmail = "";
	$loginemailError = "";
	if (isset($_POST["loginPassword"])){
		
		if (empty($_POST["loginPassword"])){
			
			$loginpasswordError = "Sisesta parool!";
		}
	}
	if (isset($_POST["loginEmail"])){
		
		if (empty($_POST["loginEmail"])){
			
			$loginemailError = "Sisesta e-mail!";
		}
	}

	$error= "";
	//kontrollin et kasutaja taitis valjad ja voib sisse logida
	if( isset($_POST["loginEmail"]) &&
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) &&
		!empty($_POST["loginPassword"])

	)	{
		
		$_POST["loginEmail"] = $Helper->cleanInput($_POST["loginEmail"]);
		$_POST["loginPassword"] = $Helper->cleanInput($_POST["loginPassword"]);
		//login sisse
		$error = $User->login($_POST["loginEmail"],$_POST["loginPassword"]);

	}
	$Fact = $Resto->getFact();
?>
<?php require("../header.php");?>
<?php require("../CSS.php");?>


<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
    <ul class="nav navbar-nav">
        <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
        <li class="nav-item active">
            <a class="nav-link" href="restoSIGNUP.php" style="color: maroon"><span class="glyphicon glyphicon-user"></span> Registreeru</a>
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
			<div class="col-sm-6 col-md-4 col-sm-offset-4 col-md-offset-4">

				<center><h2><b>Logi sisse</b></h2></center>
                <div class="account-wall">
                    <p style="color: lightcoral"><?=$error;?></p>
                    <form method="POST">
                        <p style="color: lightcoral"><?php echo $loginemailError; ?></p>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input class="form-control" placeholder="E-mail" name="loginEmail" type="email">
                        </div>

                            <br>
                        <p style="color: lightcoral"><?php echo $loginpasswordError; ?></p>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <input class="form-control" placeholder="Parool" name="loginPassword" type="password">
                        </div>

                        <br><br>

                        <p class="text-center"><button type="submit" class="btn btn-info">
                                <span class="glyphicon glyphicon-log-in"></span> Logi sisse
                            </button></p>

                    </form>
                </div>
				<center>Pole kasutajat? <a href="restoSIGNUP.php">Registreeru</a></center>
            </div>
			</div>
		</div>


    <div class="container">
        <div class="row">
            <b><center><text style="color: maroon;font-size: 20px">Kas teadsid?</text></center></b>
            <b><center style="font-size: 20px">
                    <?php
                    foreach($Fact as $R){
                     echo $R->restoFact;
                    } ?>
            </center></b>
        </div>
    </div>

<!--<audio controls autoplay loop >
						<source src="intro.mp3" type="audio/mpeg"  >;
					</audio>-->
<?php require("../footer.php");?>
