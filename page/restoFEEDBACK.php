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
</style>


    <nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
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
                <a class="nav-link" href="restoDATA">Loo uus sissekanne</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="restoRESTO">(lisasin prgu et saaks restoranide lehele)</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse">

            <form class="form-inline float-xs-right pull-right">
                <input class="form-control" style="height: 50px" type="text" placeholder="Otsing">
                <button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


            </form>
        </div>
    </nav>
	<p style="max-width: 230px" class="center-block">
	<select class="selectpicker form-control" data-style="btn-danger"  data-live-search="true">
  <option data="McDonalds">McDonalds</option>
  <option data="City Marina">City Marina</option>
  <option href="restoRESTO.php?id=.$P->id">Noa</option>
  <option data="Noa"><? foreach($person as $P){$html .= "<a href=restoRESTO.php?id=".$P->id.">$P->restoName</a>";?></option>
</select></p>

<?php

$html = "<table style='width: 100%'>";
$html .= "<tr>";

//$idOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    //$idOrder = "DESC";
//}
$restoNameOrder= "ASC";
if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
    $restoNameOrder = "DESC";
}
//$gradeOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
//    $gradeOrder = "DESC";
//}
//$commentOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
//    $commentOrder = "DESC";
//}
//$genderOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
//    $genderOrder = "DESC";
//}
//$createdOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
//    $createdOrder = "DESC";
//}
//$customer_nameOrder= "ASC";
//if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
//    $customer_nameOrder = "DESC";
//}

//$html .= "<th style=\"background-color: lightskyblue\">
//						<a href='?q=".$q."&sort=id&order=".$idOrder."'>id</a></th>";
$html .= "<th style=\"background-color: lightblue\">
						<center><a href='?q=".$q."&sort=restoName&order=".$restoNameOrder."'>restorani nimi</center></th>";
//$html .= "<th style=\"background-color: lightskyblue\">
//						<a href='?q=".$q."&sort=grade&order=".$gradeOrder."'>hinne</th>";
//$html .= "<th style=\"background-color: lightblue\">
//						<a href='?q=".$q."&sort=comment&order=".$commentOrder."'>kommentaar</th>";
//$html .= "<th style=\"background-color: lightskyblue\">
//						<a href='?q=".$q."&sort=gender&order=".$genderOrder."'>kliendi sugu</th>";
//$html .= "<th style=\"background-color: lightblue\">
//						<a href='?q=".$q."&sort=created&order=".$customer_nameOrder."'>Kliendi nimi</th>";
//$html .= "<th style=\"background-color: lightskyblue\">
//						<a href='?q=".$q."&sort=created&order=".$createdOrder."'>loodud</th>";
//$html .= "<th style='background-color: lightblue'></th>";
//$html .= "</tr>";

foreach($person as $P){
    $html .= "<tr>";
    //$html .= '<td style="background-color: lightblue">'.$P->id."</td>";
    $html .= "<td style='background-color: lightskyblue'><center><a href=restoRESTO.php?id=".$P->id.">$P->restoName</a></center></td>";
    //$html .= '<td style="background-color: lightblue">'.$P->grade."</td>";
    //$html .= '<td style="background-color: lightskyblue">'.$P->comment."</td>";
    //$html .= '<td style="background-color: lightblue">'.$P->gender."</td>";
    //$html .= '<td style="background-color: lightskyblue">'.$P->customerName."</td>";
    //$html .= '<td style="background-color: lightblue">'.date('Y', strtotime($P->created))."</td>";
    //$html .= "<td style='background-color: lightskyblue;padding: 0px'><a class='btn btn-outline-danger btn-md' href='restoEDIT.php?id=".$P->id."'>
    //    <span style='color:red;' class='glyphicon glyphicon-edit'></span></a></td>";
    $html .= "</tr>";

}
$html .= "<?Table>";
echo $html;

?>






<?php require("../footer.php");?>