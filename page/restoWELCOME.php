<?php

if(isset($_GET["logout"])) {

    session_destroy();

    header("Location: restoSISSELOGIMINE.php");
    exit();
}

?>

<?php require("../header.php");?>

<style>
    .account-wall {
        margin-top: 20px;
        padding: 40px 40px 20px 40px;
        background-color: #e4e0e0;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 2px 2px 100px rgba(0, 0, 0, 0.3);
        border-radius: 30px;
    }
</style>

    <nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
        <ul class="nav navbar-nav">
            <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>

        </ul>
    </nav>
    <br><br><br><br>
    <center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
    <span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
    <span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-4 col-md-offset-4">

                <center><h1 style="color: dodgerblue"><b>Tere tulemast!</b></h1></center>

                <div class="account-wall">

                   <a class="btn btn-elegant btn-lg btn-block" href="restoFEEDBACK.php">Kasutajate tagasisise</a>
                    <a class="btn btn-elegant btn-md btn-block" href="restoUSER.php">Sinu profiil</a>
                    <a class="btn btn-elegant btn-sm btn-block" href="?logout=1.php">Logi välja</a><br>
                    <button type="button" class="btn btn-elegant">Elegant</button>
                    <button type="button" class="btn btn-outline-primary waves-effect">Primary</button>
                    <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>



                </div>
            </div>
        </div>
    </div>








<?php require("../header.php");?>