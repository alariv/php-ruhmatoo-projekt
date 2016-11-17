<?php
	require("../restoFUNCTIONS.php");

	if(!isset ($_SESSION["userId"])) {
		
		header("Location: restoSISSELOGIMINE.php");
		exit();
	}
	if(isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: restoSISSELOGIMINE.php");
		exit();
	}


	
	$restoName = "";
	$grade = "";
	$comment= "";
	$customer_sex = "";
	$person = "";
    $restoNameError = "";
    $commentError = "";
	//kontrollin et valjad poleks tyhjad
	if( isset($_POST["restoName"]) &&
		isset($_POST["comment"]) &&
		!empty($_POST["restoName"]) &&
		!empty($_POST["comment"])
	)	{

		$Resto->saverestos($_POST["restoName"],$_POST["grade"],$_POST["comment"],$_SESSION["gender"],$_SESSION["name"]);
		//header("Location: restoFEEDBACK.php");
		exit();
	}

		if(isset($_GET["q"])){
			//kui otsib siis votame otsisona aadressirealt
			$q = $_GET["q"];
		}else {
			//otsisona tyhi
			$q="";
		}

		$sort="id";
		$order="ASC";
		if(isset($_GET["sort"]) && isset($_GET["order"])){
			$sort = $_GET["sort"];
			$order = $_GET["order"];
		}

		$person = $Resto->getallrestos($q, $sort, $order);

    if (isset ($_POST ["restoName"])) {
        // oli olemas, ehk keegi vajutas nuppu
        if (empty($_POST ["restoName"])) {
            //oli tõesti tühi
            $restoNameError = "Sisesta restorani nimi!";
        } else {
            $restoName = $_POST ["restoName"];
        }
    }
    if (isset ($_POST ["comment"])) {
        // oli olemas, ehk keegi vajutas nuppu
        if (empty($_POST ["comment"])) {
            //oli tõesti tühi
            $commentError = "Sisesta kommentaar!";
        } else {
            $comment = $_POST ["comment"];
        }
    }



//echo"<pre>";
		//var_dump($person);
		//echo"</pre>";


?>
	<?php require("../header.php");?>
			
			<style>
                .errors {
                    max-width: 150px;
                    color:red;
                }
				table, th, td{
					border: 2px solid dodgerblue;
					border-collapse: collapse;
					margin: 0 auto;
				}
				th, td{
					padding: 10px;
				}
				.center{
					margin: 0 auto;
					max-width: 300px;
				}
				.feedback{
					float:left;
				}

			</style>
	<nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
		<ul class="nav navbar-nav">
			<a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
			<li class="nav-item">
				<a class="nav-link" href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="restoUSER.php"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION["name"];?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
			</li>
		</ul>
		<div class="collapse navbar-collapse">

			<form class="form-inline float-xs-right navbar-right">
				<input class="form-control" style="height: 50px;color: dodgerblue;" type="text" name="q" placeholder="Otsing" value="<?=$q;?>">
				<button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


			</form>
		</div>
	</nav>

	<span class='btn-danger btn-sm' style="float: right"><a style="color: white" href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a></span>

	<br><br>

	<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
	<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
	<span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

	<br>
	<p style="color: dodgerblue;font-size: 25px" class="text-center"> Tere <?=$_SESSION["name"];?>!</p>

	<br><br>
		<fieldset style="border-bottom-width: 5px;border-top-width: 5px;border-right-width: 0;border-left-width: 0px" class="center">
		<form  method="POST">
            <p class="errors"><?php echo $restoNameError; ?></p>
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Nimi</a>
			<input class="form-control" placeholder="Restorani nimi" name="restoName" type="text">
			
			<br><span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue"> Hinnang:</a>
					<input type="radio" name="grade" value="1">1</input>
					<input type="radio" name="grade" value="2">2</input>
					<input type="radio" name="grade" value="3">3</input>
					<input type="radio" name="grade" value="4">4</input>
					<input type="radio" name="grade" value="5" checked>5</input>
			
			<br>
            <p class="errors"><?php echo $commentError; ?></p>
			<div class="form-group">
				<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>
				<a for="comment" style="color: dodgerblue">Kommentaar:</a>
				<textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Kommentaar"></textarea>
			</div>
			
			<br>
			
			<input class='btn-success btn-lg' style="width: 300px;height: 50px" type="submit">
		
		</form>

		</fieldset><br>

<h1 style="color: dodgerblue;margin: 0 auto;max-width: 370px;font-size: 38px">Kasutajate tagasiside</h1><br>
	<fieldset style="border-width: 0px;margin: 0 auto;max-width: 370px">
	<form>
		<input class="form-control" style="color: dodgerblue" name="q"  placeholder="Otsi restoranide, hinnete või kommentaari järgi" value="<?=$q;?>"><br>
		<p class="text-center"><button type="submit" class="btn btn-info" style="width: 370px">
			<span class="glyphicon glyphicon-search"></span> Search
		</button></p>
	</form>
	</fieldset>
	<br><br>
	<fieldset style="border-bottom-width: 15px;border-top-width: 15px;border-right-width: 0;border-left-width: 0px">
<?php
	foreach($person as $P){
			if($P->grade=="1"){
				echo '<h3 class="feedback" style="color:red;font-size: 22px">'.$P->restoName.'</h3>';
			}
			if($P->grade=="2"){
				echo '<h3 class="feedback" style="color:crimson;font-size: 27px">'.$P->restoName.'</h3>';
			}
			if($P->grade=="3"){
				echo '<h3 class="feedback" style="color:blueviolet;font-size: 32px">'.$P->restoName.'</h3>';
			}
			if($P->grade=="4"){
				echo '<h3 class="feedback" style="color:slateblue;font-size: 37px">'.$P->restoName.'</h3>';
			}
			if($P->grade=="5"){
				echo '<h3 class="feedback" style="color:dodgerblue;font-size: 42px">'.$P->restoName.'</h3>';
		}
		
	}
?></fieldset><br><br><br><br><br><br><br><br><br><br><br><br>
<!--<audio controls autoplay loop >
    <source src="firstrain.mp3" type="audio/mpeg"  >;
</audio>-->
<?php require("../footer.php");?>