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
		$Resto->saverestos($_POST["restoName"],$_POST["grade"],$_POST["comment"],$_SESSION["gender"],$_SESSION["name"],$_POST["food"],$_POST["foodRating"],$_POST["serviceRating"], $_SESSION["userId"]);
		header("Location: restoFEEDBACK.php");
		exit();
	}
 	{
		//$Resto->saveUserRestos($_SESSION["userId"], $_POST["restoId"]);
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
            //oli t�esti t�hi
            $restoNameError = "Sisesta restorani nimi!";
        } else {
            $restoName = $_POST ["restoName"];
        }
    }
    if (isset ($_POST ["comment"])) {
        // oli olemas, ehk keegi vajutas nuppu
        if (empty($_POST ["comment"])) {
            //oli t�esti t�hi
            $commentError = "Sisesta kommentaar!";
        } else {
            $comment = $_POST ["comment"];
        }
    }
	if (isset ($_POST ["serviceRating"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["serviceRating"])) {
			//oli t�esti t�hi
			$serviceRatingError = "Vali hinne!";
		} else {
			$serviceRating = $_POST ["serviceRating"];
		}
	}
	if (isset ($_POST ["foodRating"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["foodRating"])) {
			//oli t�esti t�hi
			$foodRatingError = "Vali hinne!";
		} else {
			$foodRating = $_POST ["foodRating"];
		}
	}
	if (isset ($_POST ["food"])) {
		// oli olemas, ehk keegi vajutas nuppu
		if (empty($_POST ["food"])) {
			//oli t�esti t�hi
			$foodError = "Sisesta toit!";
		} else {
			$food = $_POST ["food"];
		}
	}

    $dropdownrestos=$Resto->getRestosfordropdown();

if (isset ($_POST["dropdownResto"])) {
    // oli olemas, ehk keegi vajutas nuppu
     $restoName = $_POST["dropdownResto"];}


if( isset($_POST["dropdownResto"]) &&
    !empty($_POST["dropdownResto"])
)	{
    $Resto->saveRestosfordropdown($_POST["dropdownResto"]);
    header("Location: restoDATA.php");
    exit();
}


?>
	<?php require("../header.php");?>
	<?php require("../CSS.php");?>
	
	<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
		<ul class="nav navbar-nav">
			<a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
            <li class="nav-item">
                <a class="nav-link" onclick="goBack()"><span class="glyphicon glyphicon-chevron-left"></span> tagasi</a>
            </li>
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




			</form>
		</div>
	</nav>
	<br><br><br>

	<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
	<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
	<span style="float: right" class="img"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

	<br>
	<p style="color: dodgerblue;font-size: 25px" class="text-center"> Tere <?=$_SESSION["name"];?>!</p>

	<br><br>
		<fieldset style="border-bottom-width: 5px;border-top-width: 5px;border-right-width: 0;border-left-width: 0px" class="center">
		<form  method="POST">
            <p class="errors"><?php echo $restoNameError; ?></p>
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Restorani nimi</a>

            <div class="input-group input-group-md">
                <select name="restoName" type="text" class="form-control">
                    <?php

                    $listHtml = "";

                    foreach($dropdownrestos as $d){


                        $listHtml .= "<option value='".$d->restoName."'>".$d->restoName."</option>";

                    }

                    echo $listHtml;

                    ?>
                </select>

                    <span class="input-group-addon">
                        <button type="button" class="btn btn-danger btn-sm center-block" style="padding-bottom: 0px;padding-top: 0px" data-toggle="modal" data-target="#myModal">
                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                </button> 
                    </span>
            </div>

                <!-- Modal -->
                <div style="margin-top: 200px" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>RESTOGURU</center>
                            </div>
                            <div class="modal-body">
                                    <span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Restorani nimi</a>
                                    <input class="form-control" placeholder="Restorani nimi" name="dropdownResto" type="text">
                                    <input class='btn btn-success btn-md center-block' style="width: 300px;height: 50px" type="submit">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
                            </div>
                        </div>
                    </div>
                </div>

            <br>

			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue"> �ldine hinnang restoranile:</a><br>
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
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"></span><a style="color: dodgerblue"> Mida s�in?</a>
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
			
			<input class='btn btn-success btn-lg' style="width: 300px;height: 50px" type="submit">
		</form>
		</fieldset><br>


<?php require("../footer.php");?>