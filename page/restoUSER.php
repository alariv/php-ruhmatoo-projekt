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

//$Resto->getUserRestos($restos);
?>

<?php require("../header.php");?>
<style>
    .account-wall{
        margin-top: 20px;
        padding: 40px 40px 20px 40px;
        background-color: #e4e0e0;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 2px 2px 100px rgba(0, 0, 0, 0.3);
        border-radius: 30px;
    }
</style>
<nav class="navbar navbar-light bg-faded" style="background-color: rgba(30, 144, 255, 0.33)">
    <ul class="nav navbar-nav">
        <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>
        <li class="nav-item active">
            <a class="nav-link" href="restoDATA.php"><span class="glyphicon glyphicon-chevron-left"></span> tagasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="restoDATA"><span class="glyphicon glyphicon-plus"></span> Uus sissekanne</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
        </li>
    </ul>
    <div class="collapse navbar-collapse">

        <form class="form-inline float-xs-right navbar-right">
            <input class="form-control" style="height: 50px" type="text" placeholder="Otsing">
            <button class="btn btn-primary" style="height: 50px" type="submit"><span class="glyphicon glyphicon-search"></span> Otsi</button>


        </form>
    </div>
</nav>

<br><br>

<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
<span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

<br><br>

<div class="container">

    <div class="row">

        <div class="col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">

            <div class="account-wall">

                <h2>Profiil</h2>

                <a> Sinu unikaalne id : </a><?=$_SESSION["userId"];?><br>
                <a> Email : </a><?=$_SESSION["email"];?><br>
                <a> Nimi : </a><?=$_SESSION["name"];?><br>
                <a> Perekonnanimi : </a><?=$_SESSION["lname"];?><br>
                <a> Vanus : </a><?=$_SESSION["age"];?><br>
                <a> Telefoni number : </a><?=$_SESSION["phonenr"];?><br>

            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">

            <div class="account-wall">

                <h2>Sinu postitused</h2>
                <?php

                $listHtml = "<ul>";

                foreach($restos as $r){


                    $listHtml .= "<li>".$r->interest."</li>";
                }

                $listHtml .= "</ul>";

                echo $listHtml;

                ?>

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

