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


?>

<?php require("../header.php");?>
    <style>
        .red {
            max-width: 500px;
            color: red;
            margin: 0 auto;
        }.green{
             max-width: 500px;
             color: green;
             margin: 0 auto;
        }.title{
             font-size: 70px;
             max-width: 500px;
             color: green;
             margin: 0 auto;
        }.backout{
            font-size:30px;
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


        <span class='btn-danger btn-sm' style="float: right"><a style="color: white" href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a></span>

<br><br>

<center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
<span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


    <h1 class="text-center" style="font-size: 70px;color: dodgerblue">Sinu profiil</h1>
    <br><br>
    <h1 class="text-center" style="color: maroon">Vabandame!</h1>
    <br><br>
    <p class="text-center" style="color: maroon;font-size: large;;">Hetkel käivad arendustööd Teie profiili paremaks muutmiseks.</p>

    <br><br><br><br><br><br><br><br><br><br>

    <h2 class="text-center" style="color: maroon">TÄNAME KANNATLIKKUSE EEST!</h2>

<br><br><br>


<form>
        <h2 class="text-center">Pildi aadress</h2>
<fieldset style="width: 300px; margin: 0 auto">
        <a class="text-center"><input class="text-center form-control" style="width: 300px" type="url" name="image" placeholder="Sisesta pildi URL"></a>
    <input class="form-control" type="submit" value="save">
</fieldset></form>




<?php require("../footer.php");?>

