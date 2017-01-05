<?php

require("../restoFUNCTIONS.php");

if(isset($_GET["logout"])) {

    session_destroy();

    header("Location: restoSISSELOGIMINE.php");
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

$restos = $Resto->getallrestos($q, $sort, $order);
$distRestoName = $Resto->getdistResto();

?>
<?php require("../header.php");?>
<?php require("../CSS.php");?>
	<style>
		table, th, td{
			border: 2px solid dodgerblue;
			border-collapse: collapse;
			margin: 0 auto;
			max-width: 200px;
		}
		.table-striped>tbody>tr:nth-child(odd)>td,
		.table-striped>tbody>tr:nth-child(odd)>th {
			background-color: lightskyblue; // Choose your own color here
		}
	</style>


	<nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
		<ul class="nav navbar-nav">
			<a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
			<li class="nav-item">
				<a class="nav-link" onclick="goBack()"><span class="glyphicon glyphicon-chevron-left"></span> tagasi</a>
			</li>
            <li class="nav-item active">
                <a class="nav-link" href="restoSISSELOGIMINE.php" style="color: maroon"><span class="glyphicon glyphicon-log-in"></span> Logi sisse</a>
            </li>
            <li class="disabled">
                <a class="nav-link""><span class="glyphicon glyphicon-user"></span> Profiil</a>
            </li>
            <li class="disabled">
                <a class="nav-link"><span class="glyphicon glyphicon-plus"></span> Uus sissekanne</a>
            </li>
		</ul>
		<div class="collapse navbar-collapse">



			</form>
		</div>
	</nav>
	<br><br><br><br><br><br>
	<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
	<span style="float: right" class="img"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


<?php

$html = "<table style='width: 20%' class='table table-striped'>";
$html .= "<tr>";


$restoNameOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
	$restoNameOrder = "DESC";
}

$html .= "<th>
						<center><a style='font-size: 20px' href='?q=".$q."&sort=restoName&order=".$restoNameOrder."'>Restorani nimi</center></th>";


foreach($distRestoName as $P){
	$html .= "<tr>";
	$html .= "<td><center><a href='restoRESTOnologin.php?name=".urlencode($P->distRestoName)."'>$P->distRestoName</a></center></td>";
	$html .= "</tr>";

}
$html .= "</Table>";
echo $html;

?>
<?php require("../footer.php");?>