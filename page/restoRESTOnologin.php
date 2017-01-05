<?php

require("../restoFUNCTIONS.php");
require("../restoEDITFUNCTIONS.php");

if (isset($_GET["logout"])) {

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

$person = $Resto->getSingleRestoData(urldecode($_GET["name"]));
$R = $Resto->getSingleRestoName(urldecode($_GET["name"]));

?>
<?php require("../header.php"); ?>
<?php require("../CSS.php"); ?>

<style>
    table, th, td{
        border: 2px solid dodgerblue;
        margin: 0 auto;
        max-width: 1000px;
    }
    .centered-and-cropped { object-fit: cover }

</style>


<nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
    <ul class="nav navbar-nav">
        <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
        <li class="nav-item active">
            <a class="nav-link" onclick="goBack()"><span class="glyphicon glyphicon-chevron-left"></span> tagasi</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="restoSISSELOGIMINE.php" style="color: maroon"><span class="glyphicon glyphicon-log-in"></span> Logi sisse</a>
        </li>
        <li class="disabled">
            <a class="nav-link"><span class="glyphicon glyphicon-user"></span> Profiil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="restoFEEDBACKnologin.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
        </li>
        <li class="disabled">
            <a class="nav-link"><span class="glyphicon glyphicon-plus"></span> Uus sissekanne</a>
        </li>
    </ul>
    <div class="collapse navbar-collapse">
    </div>
</nav>

<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center><br>
<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
<span style="float: right" class="img"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


<br>
<p style="color: dodgerblue;font-size: 25px" class="text-center"> Tere külaline!</p>
<p style="color: dodgerblue;font-size: 25px" class="text-center"> Oled <b style="color: #1c63ba;font-size: 30px"><?php echo $_GET["name"];?></b> tagasiside lehel</p>


<?php

$html = "<table style='width: 80%' class='table table-striped'>";
$html .= "<tr>";

$idOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $idOrder = "DESC";
}
$restoNameOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $restoNameOrder = "DESC";
}
$gradeOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $gradeOrder = "DESC";
}
$commentOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $commentOrder = "DESC";
}
$genderOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $genderOrder = "DESC";
}
$createdOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $createdOrder = "DESC";
}
$customer_nameOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $customer_nameOrder = "DESC";
}

//$html .= "<th style=\"background-color: lightskyblue\">
//	<center><a href='?q=".$q."&sort=id&order=".$idOrder."'>id</a></center></th>";
//$html .= "<th style=\"background-color: lightblue\">
//						<center><a href='?q=".$q."&sort=restoName&order=".$restoNameOrder."'>restorani nimi</a></center></th>";
$html .= "<th style='background-color: lightskyblue'>
										<center><a href='?q=".$q."&sort=grade&order=".$gradeOrder."'>hinne</a></center></th>";
$html .= "<th style=\"background-color: lightblue\">
										<center><a href='?q=".$q."&sort=comment&order=".$commentOrder."'>kommentaar</a></center></th>";
$html .= "<th style=\"background-color: lightskyblue\">
										<center><a href='?q=".$q."&sort=id&order=".$idOrder."'>toit</a></center></th>";
$html .= "<th style=\"background-color: lightblue\">
										<center><a href='?q=".$q."&sort=id&order=".$idOrder."'>hinnang toidule</a></center></th>";
$html .= "<th style=\"background-color: lightskyblue\">
										<center><a href='?q=".$q."&sort=id&order=".$idOrder."'>hinnang teenindusele</a></center></th>";
$html .= "<th style=\"background-color: lightblue\">
										<center><a href='?q=".$q."&sort=gender&order=".$genderOrder."'>kliendi sugu</a></center></th>";
$html .= "<th style=\"background-color: lightskyblue\">
										<center><a href='?q=".$q."&sort=created&order=".$customer_nameOrder."'>Kliendi nimi</a></center></th>";
$html .= "<th style=\"background-color: lightblue\">
										<center><a href='?q=".$q."&sort=created&order=".$createdOrder."'>loodud</a></center></th>";
$html .= "</tr>";


foreach($person as $P) {
    $html .= "<tr>";
    //$html .= '<td style="background-color: lightblue">'.$r->id."</td>";
    //$html .= '<td style="background-color: lightskyblue">'.$r->restoName."</td>";
    $html .= "<td style='background-color: lightblue'>" . $P->grade . "</td>";
    $html .= '<td style="background-color: lightskyblue">' . $P->comment . "</td>";
    $html .= '<td style="background-color: lightblue">' . $P->food . "</td>";
    $html .= '<td style="background-color: lightskyblue">' . $P->food_rating . "</td>";
    $html .= '<td style="background-color: lightblue">' . $P->service_rating . "</td>";
    $html .= '<td style="background-color: lightskyblue">' . $P->customer_sex . "</td>";
    $html .= '<td style="background-color: lightblue">' . $P->customer_name . "</td>";
    $html .= '<td style="background-color: lightskyblue">' . date('M Y', strtotime($P->created)) . "</td>";
    $html .= "</tr>";

}
$html .= "</Table>";
echo $html;

?>

<?php require("../footer.php");?>
