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
    $foodRating = "";
    $foodRatingError = "";
    $serviceRating = "";
    $serviceRatingError = "";
	$food = "";
	$foodError = "";
	//kontrollin et valjad poleks tyhjad
	if( isset($_POST["restoName"]) &&
		isset($_POST["comment"]) &&
		!empty($_POST["restoName"]) &&
		!empty($_POST["comment"])
	)	{

		$Resto->saverestos($_POST["restoName"],$_POST["grade"],$_POST["comment"],$_SESSION["gender"],$_SESSION["name"],$_POST["food"],$_POST["foodRating"],$_POST["serviceRating"]);
		header("Location: restoFEEDBACK.php");
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
	if (isset ($_POST ["serviceRating"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["serviceRating"])) {
			//oli tõesti tühi
			$serviceRatingError = "Vali hinne!";
		} else {
			$serviceRating = $_POST ["serviceRating"];
		}
	}
	if (isset ($_POST ["foodRating"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["foodRating"])) {
			//oli tõesti tühi
			$foodRatingError = "Vali hinne!";
		} else {
			$foodRating = $_POST ["foodRating"];
		}
	}
	if (isset ($_POST ["food"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["food"])) {
			//oli tõesti tühi
			$foodError = "Sisesta toit!";
		} else {
			$food = $_POST ["food"];
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
				.img{
					position:fixed right;
				}
				div.stars {
					width: 270px;
					display: inline-block;
				}
				input.star { display: none; }
				label.star {
					float: right;
					padding: 10px;
					font-size: 36px;
					color: #444;
					transition: all .2s;
				}
				input.star:checked ~ label.star:before {
					content: '\f005';
					color: #FD4;
					transition: all .25s;
				}
				input.star-5:checked ~ label.star:before {
					color: #FE7;
					text-shadow: 0 0 20px #952;
				}
				input.star-1:checked ~ label.star:before { color: #ff0008; }
				input.star-2:checked ~ label.star:before { color: #ff5200; }
				input.star-3:checked ~ label.star:before { color: #ff9007; }
				input.star-4:checked ~ label.star:before { color: #ffc533; }
				label.star:hover { transform: rotate(-72deg) scale(1.2); }
				label.star:before {
					content: '\f006';
					font-family: FontAwesome;
				}


			</style>
	<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
		<ul class="nav navbar-nav">
			<a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
			<li class="nav-item">
				<a class="nav-link" href="?logout=1" style="color: maroon"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="restoUSER.php"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION["name"];?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
			</li>
		</ul>
		<div class="collapse navbar-collapse">

			<form class="form-inline float-xs-right pull-right">
				<input class="form-control" style="height: 50px;color: dodgerblue;" type="text" name="q" placeholder="Otsing" value="<?=$q;?>">
				<button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


			</form>
		</div>
	</nav>
	<br><br>

	<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
	<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
	<span style="float: right" class="img"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

	<br>
	<p style="color: dodgerblue;font-size: 25px" class="text-center"> Tere <?=$_SESSION["name"];?>!</p>

	<br><br>
		<fieldset style="border-bottom-width: 5px;border-top-width: 5px;border-right-width: 0;border-left-width: 0px" class="center">
		<form  method="POST">
            <p class="errors"><?php echo $restoNameError; ?></p>
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Nimi</a>
			<input class="form-control" placeholder="Restorani nimi" name="restoName" type="text">
			<br>

			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue"> Üldine hinnang restoranile:</a><br>
			<div class="stars">

					<input class="star star-5" id="grade-5" type="radio" value="5" name="grade">
					<label class="star star-5" for="grade-5"></label>
					<input class="star star-4" id="grade-4" type="radio" value="4" name="grade">
					<label class="star star-4" for="grade-4"></label>
					<input class="star star-3" id="grade-3" type="radio" value="3" name="grade">
					<label class="star star-3" for="grade-3"></label>
					<input class="star star-2" id="grade-2" type="radio" value="2" name="grade">
					<label class="star star-2" for="grade-2"></label>
					<input class="star star-1" id="grade-1" type="radio" value="1" name="grade">
					<label class="star star-1" for="grade-1"></label>

			</div><br>


			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Mida sõin?</a>
			<input class="form-control" placeholder="Toit" name="food" type="text">
			<br>

			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue"> Hinnang teenindusele:</a><br>
			<div class="stars">

					<input class="star star-5" id="serviceRating-5" type="radio" value="5" name="serviceRating">
					<label class="star star-5" for="serviceRating-5"></label>
					<input class="star star-4" id="serviceRating-4" type="radio" value="4" name="serviceRating">
					<label class="star star-4" for="serviceRating-4"></label>
					<input class="star star-3" id="serviceRating-3" type="radio" value="3" name="serviceRating">
					<label class="star star-3" for="serviceRating-3"></label>
					<input class="star star-2" id="serviceRating-2" type="radio" value="2" name="serviceRating">
					<label class="star star-2" for="serviceRating-2"></label>
					<input class="star star-1" id="serviceRating-1" type="radio" value="1" name="serviceRating">
					<label class="star star-1" for="serviceRating-1"></label>

			</div><br>

			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue"> Hinnang toidule:</a><br>
			<div class="stars">

					<input class="star star-5" id="foodRating-5" type="radio" value="5" name="foodRating">
					<label class="star star-5" for="foodRating-5"></label>
					<input class="star star-4" id="foodRating-4" type="radio" value="4" name="foodRating">
					<label class="star star-4" for="foodRating-4"></label>
					<input class="star star-3" id="foodRating-3" type="radio" value="3" name="foodRating">
					<label class="star star-3" for="foodRating-3"></label>
					<input class="star star-2" id="foodRating-2" type="radio" value="2" name="foodRating">
					<label class="star star-2" for="foodRating-2"></label>
					<input class="star star-1" id="foodRating-1" type="radio" value="1" name="foodRating">
					<label class="star star-1" for="foodRating-1"></label>

			</div><br>

            <p class="errors"><?php echo $commentError; ?></p>
			<div class="form-group">
				<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span>
				<a for="comment" style="color: dodgerblue">Kommentaar:</a>
				<textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Kommentaar"></textarea>
			</div>
			
			<br>
			
			<input class='btn-success btn-lg' style="width: 300px;height: 50px" type="submit">
			<button type="button" class='btn btn-elegant btn-lg'>

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