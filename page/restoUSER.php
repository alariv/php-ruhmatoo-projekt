<?php
require("../restoFUNCTIONS.php");

if(!isset ($_SESSION["userId"])) {

    header("Location: restoSISSELOGIMINE.php");
    exit();
}
if (isset($_GET["logout"])) {

    session_destroy();
    header("Location: restoSISSELOGIMINE.php");
    exit();
}
if (isset ($_POST ["image"])) {
    // oli olemas, ehk keegi vajutas nuppu
    if (empty($_POST ["image"])) {
        //oli tõesti tühi
        $imageError = "pead sisestama URL-i!";
    } else {
        $image = $_POST ["image"];
    }
}
if(isset($_GET["r"])){
    //kui otsib siis votame otsisona aadressirealt
    $r = $_GET["r"];
}else {
    //otsisona tyhi
    $r="";
}
$restos = $Resto->getUserRestos($r);


//$Resto->getUserRestos($restos);
?>

<?php require("../header.php");?>
<?php require("../CSS.php");?>

<style>
table, th, td{
		border: 0px solid dodgerblue;
		border-collapse: collapse;
		margin-left: -0%;
	}
	th, td{
		padding: 5px;
	}
</style>

<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
    <ul class="nav navbar-nav">
        <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
        <li class="nav-item active">
            <a class="nav-link" onclick="goBack()"><span class="glyphicon glyphicon-chevron-left"></span> tagasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?logout=1" style="color: maroon"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="restoDATA"><span class="glyphicon glyphicon-plus"></span> Uus sissekanne</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
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

<br><br>

<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">

            <div class="account-wall">

                <h2>Profiil</h2>

                <center><h3 style="color: dodgerblue"> #<?=$_SESSION["userId"];?></h3></center><br>
                <text style="color: dodgerblue"> Email :</text><text style="float: right"><?=$_SESSION["email"];?></text><br>
                <text style="color: dodgerblue"> Eesnimi :</text><text style="float: right"> <?=$_SESSION["name"];?></text><br>
                <text style="color: dodgerblue"> Perekonnanimi :</text><text style="float: right"> <?=$_SESSION["lname"];?></text><br>
                <text style="color: dodgerblue"> Vanus :</text><text style="float: right"> <?=$_SESSION["age"];?></text><br>
                <text style="color: dodgerblue"> Telefoni number :</text><text style="float: right"> <?=$_SESSION["phonenr"];?></text><br>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">

            <div class="account-wall">

                <h2>Sinu postitused</h2>
                <?php
                $html = "<table>";

                $html .= "<tr>";
                    //$html .= "<th>restoid</th>";
                    $html .= "<th style='color: dodgerblue'>Restorani nimi</th>";
                $html .= "</tr>";


                foreach($restos as $R){

                    $html .= "<tr>";
                        //$html .= "<td>".$R->restoId."</td>";
                        $html .= "<td>".$R->restoName."</td>";
						$html .= "<td style=padding: 0px'><a class='btn btn-outline-danger btn-md' href='restoEDIT.php?id=".$R->restoId."'>
						<span style='color:red;' class='glyphicon glyphicon-edit'></span></a></td>";
                    $html .= "</tr>";
				}
                $html .= "</table>";

                echo $html;?>

            </div>
        </div>
    </div>
</div>





<!--<form>
        <h2 class="text-center">Pildi aadress</h2>
<fieldset style="width: 300px; margin: 0 auto">
        <a class="text-center"><input class="text-center form-control" style="width: 300px" type="url" name="image" placeholder="Sisesta pildi URL"></a>
    <input class="form-control" type="submit" value="save">
</fieldset></form>




<?php require("../footer.php");?>

