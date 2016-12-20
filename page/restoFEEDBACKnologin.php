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

$person = $Resto->getallrestos($q, $sort, $order);


?>
<?php require("../header.php");?>
<?php require("../CSS.php");?>

    <nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
        <ul class="nav navbar-nav">
            <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
            <li class="nav-item active">
                <a class="nav-link" onclick="goBack()" style="color: maroon"><span class="glyphicon glyphicon-chevron-left"></span> Tagasi</a>
            </li>
            <li class="disabled">
                <a class="nav-link" href="restoUSER.php"><span class="glyphicon glyphicon-user"></span> Sa pole sisse logitud</a>
            </li>
            <li class="disabled">
                <a class="nav-link" href="restoDATA"><span class="glyphicon glyphicon-pencil"></span> Loo uus sissekanne</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse">

            <form class="form-inline float-xs-right pull-right">
                <input class="form-control disabled" disabled="disabled" style="height: 50px;width: 250px" type="text" placeholder="Pead olema sisselogitud, et otsida">
                <button class="btn btn-primary disabled" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


            </form>
        </div>
    </nav>
<?php

				$html = "<table style='width: 100%' class='table table-striped'>";
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

				$html .= "<th style=\"background-color: lightskyblue\">
										<a href='?q=".$q."&sort=id&order=".$idOrder."'>id</a></th>";
				$html .= "<th style=\"background-color: lightblue\">
										<a href='?q=".$q."&sort=restoName&order=".$restoNameOrder."'>restorani nimi</th>";
				$html .= "<th style=\"background-color: lightskyblue\">
										<a href='?q=".$q."&sort=grade&order=".$gradeOrder."'>hinne</th>";
				$html .= "<th style=\"background-color: lightblue\">
										<a href='?q=".$q."&sort=comment&order=".$commentOrder."'>kommentaar</th>";
				$html .= "<th style=\"background-color: lightskyblue\">
										<a href='?q=".$q."&sort=id&order=".$idOrder."'>toit</a></th>";
				$html .= "<th style=\"background-color: lightblue\">
										<a href='?q=".$q."&sort=id&order=".$idOrder."'>hinnang toidule</a></th>";
				$html .= "<th style=\"background-color: lightskyblue\">
										<a href='?q=".$q."&sort=id&order=".$idOrder."'>hinnang teenindusele</a></th>";
				$html .= "<th style=\"background-color: lightblue\">
										<a href='?q=".$q."&sort=gender&order=".$genderOrder."'>kliendi sugu</th>";
				$html .= "<th style=\"background-color: lightskyblue\">
										<a href='?q=".$q."&sort=created&order=".$customer_nameOrder."'>Kliendi nimi</th>";
				$html .= "<th style=\"background-color: lightblue\">
										<a href='?q=".$q."&sort=created&order=".$createdOrder."'>loodud</th>";
				$html .= "</tr>";

				foreach($person as $p){
					$html .= "<tr>";
					$html .= '<td style="background-color: lightblue">'.$p->id."</td>";
					$html .= '<td style="background-color: lightskyblue">'.$p->restoName."</td>";
					$html .= '<td style="background-color: lightblue">'.$p->grade."</td>";
					$html .= '<td style="background-color: lightskyblue">'.$p->comment."</td>";
					$html .= '<td style="background-color: lightblue">'.$p->food."</td>";
					$html .= '<td style="background-color: lightskyblue">'.$p->foodRating."</td>";
					$html .= '<td style="background-color: lightblue">'.$p->serviceRating."</td>";
					$html .= '<td style="background-color: lightskyblue">'.$p->gender."</td>";
					$html .= '<td style="background-color: lightblue">'.$p->customerName."</td>";
					$html .= '<td style="background-color: lightskyblue">'.date('Y', strtotime($p->created))."</td>";
					$html .= "</tr>";

				}
				$html .= "<?Table>";
				echo $html;

				?>






<?php require("../footer.php");?>