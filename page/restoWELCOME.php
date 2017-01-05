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
$Fact = $Resto->getFact();

?>

<?php require("../header.php");?>
<?php require("../CSS.php");?>

    <nav class="navbar navbar-light bg-faded navbar-fixed-top" style="background-color: rgba(30, 144, 255, 0.33)">
        <ul class="nav navbar-nav">
            <a href="#" class="navbar-left"><img src="../logonavbar.jpg" style="width: 175px;px;height:50px;"></a>

        </ul>
    </nav>
	
    <br><br><br><br>
	
    <center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
    <span class="absolute" style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
    <span style="float: right"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-4 col-md-offset-4">

                <center><h1 style="color: dodgerblue"><b>Tere tulemast <?=$_SESSION["name"];?>!</b></h1></center>

                <div class="account-wall">
				
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">
					  Edasi  <i class="fa fa-arrow-right" aria-hidden="true"></i>
					</button>

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
							<a class="btn btn-primary btn-lg btn-block" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate tagasisise</a>
							<a class="btn btn-primary btn-md btn-block" href="restoUSER.php"><span class="glyphicon glyphicon-user"></span> Sinu profiil</a>
							<a class="btn btn-default btn-sm btn-block" style="color: #ff684b" href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logi välja</a><br>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
						  </div>
						</div>
					  </div>
					</div>				
     
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <b><center><text style="color: maroon;font-size: 20px">Kas teadsid?</text></center></b>
            <b><center style="font-size: 20px">
                    <?php
                    foreach($Fact as $R){
                        echo $R->restoFact;
                    } ?>
                </center></b>
        </div>
    </div>




<?php require("../footer.php");?>