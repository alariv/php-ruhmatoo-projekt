<?php
require("../restoFUNCTIONS.php");
require("../restoEDITFUNCTIONS.php");

if(!isset ($_SESSION["userId"])) {

    header("Location: restoSISSELOGIMINE.php");
    exit();
}
if(isset($_GET["delete"])){


    $Edit->deleteResto($Helper->cleanInput($_GET["id"]));
    $Edit->deleteRestofromdropdown(urldecode($_GET["name"]));
    header("Location: restoUSER.php");

    exit();
}

//kas kasutaja uuendab andmeid
if(isset($_POST["update"])){

    $Edit->updateResto($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["grade"]),
                        $Helper->cleanInput($_POST["food_rating"]), $Helper->cleanInput($_POST["service_rating"]),
                        $Helper->cleanInput($_POST["comment"]));

   header("Location: restoUSER.php?id=".$_POST["id"]."&success=true");
    exit();

}
if(isset($_GET["logout"])) {

    session_destroy();

    header("Location: restoSISSELOGIMINE.php");
    exit();
}

//saadan kaasa id
$P = $Resto->getSingleRestoData($_GET["id"]);
//var_dump($P);

?>
<?php require("../header.php");?>
<?php require("../CSS.php");?>

<style>
    .btn span.glyphicon {
        opacity: 0;
    }
    .btn.active span.glyphicon {
        opacity: 1;
        color: white;
    }
    .btn-1 {
        background: rgba(255, 0, 0, 0.7);
        color: #ffffff;
    }.btn-2 {
        background: rgba(220, 54, 193, 0.71);
        color: #ffffff;
    }.btn-3 {
        background: rgba(138, 43, 226, 0.71);
        color: #ffffff;
    }.btn-4 {
        background: rgba(73, 114, 203, 0.71);
        color: #ffffff;
    }.btn-5 {
        background: rgba(30, 144, 255, 0.7);
        color: #ffffff;
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
                <a class="nav-link" href="restoUSER.php"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION["name"];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="restoFEEDBACK.php"><span class="glyphicon glyphicon-th-list"></span> Kasutajate Tagasiside</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse">
            
        </div>
    </nav>

	<br><br><br>
    <center><img src="../logo.jpg" alt="logo" style="width:500px;height:140px;"></center>
	<span style="float: left"> <img src="../fork.jpg" alt="fork" style="width:75px;height:750px;"></span>
	<span style="float: right" class="img"> <img src="../knife.jpg" alt="knife" style="width:75px;height:750px;"></span>


<center><h2 style="color: dodgerblue;font-size: 50px">Sinu sissekanne</h2></center>




					
					
<form class="ccenter" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    <input type="hidden" name="id" value="<?=$_GET["id"];?>" >
    <center><label for="restoName" >Restorani nimi:    </label><br>
    <b style="font-size:30px;color:dodgerblue"><?php echo $P->restoName;?></b><br>

    <label>Hinne restoranile:</label><br>
    <?php if($P->grade=="1"){
        echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->grade.'</b> 2 3 4 5</b>';
    }
    if($P->grade=="2"){
        echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">'.$P->grade.'</b> 3 4 5</b>';
    }
    if($P->grade=="3"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->grade.'</b> 4 5</b>';
    }
    if($P->grade=="4"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->grade.'</b> 5</b>';
    }
    if($P->grade=="5"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->grade.'</b></b>';
    }?>
    <br><br>

    <label>Hinne toidule:</label><br>
    <?php if($P->food_rating=="1"){
        echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->food_rating.'</b> 2 3 4 5</b>';
    }
    if($P->food_rating=="2"){
        echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">' .$P->food_rating.'</b> 3 4 5</b>';
    }
    if($P->food_rating=="3"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->food_rating.'</b> 4 5</b>';
    }
    if($P->food_rating=="4"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->food_rating.'</b> 5</b>';
    }
    if($P->food_rating=="5"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->food_rating.'</b></b>';
    }?>
    <br><br>

    <label>Hinne teenindusele:</label><br>
    <?php if($P->service_rating=="1"){
        echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->service_rating.'</b> 2 3 4 5</b>';
    }
    if($P->service_rating=="2"){
        echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">'.$P->service_rating.'</b> 3 4 5</b>';
    }
    if($P->service_rating=="3"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->service_rating.'</b> 4 5</b>';
    }
    if($P->service_rating=="4"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->service_rating.'</b> 5</b>';
    }
    if($P->service_rating=="5"){
        echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->service_rating.'</b></b>';
    }?>

    </center>
<!-- Button trigger modal -->
					<button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModal">
					  Muuda sissekannet  <i class="fa fa-arrow-right" aria-hidden="true"></i>
					</button>
<br><br>
<p class="text-center"><a class='btn-danger btn-lg' href="?id=<?=$_GET["id"];?>&name=<?=urlencode($_GET["name"]);?>&delete=true"><span class="glyphicon glyphicon-trash"></span></a></p>
<!-- Modal -->
					<div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
							<center><b style="font-size:30px;color:dodgerblue"><?php echo $P->restoName;?></b></center>
						  </div>
						  <div class="modal-body">
							<form class="ccenter" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
							<input type="hidden" name="id" value="<?=$_GET["id"];?>" >
							<label style="color: rgb(118,118,118)">Senised hinded:</label><br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Restoranile:</label>
                                <?php if($P->grade=="1"){
                                    echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->grade.'</b> 2 3 4 5</b>';
                                }
                                if($P->grade=="2"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">'.$P->grade.'</b> 3 4 5</b>';
                                }
                                if($P->grade=="3"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->grade.'</b> 4 5</b>';
                                }
                                if($P->grade=="4"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->grade.'</b> 5</b>';
                                }
                                if($P->grade=="5"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->grade.'</b></b>';
                                }?>
                                <br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Toidule:</label>
                                <?php if($P->food_rating=="1"){
                                    echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->food_rating.'</b> 2 3 4 5</b>';
                                }
                                if($P->food_rating=="2"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">' .$P->food_rating.'</b> 3 4 5</b>';
                                }
                                if($P->food_rating=="3"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->food_rating.'</b> 4 5</b>';
                                }
                                if($P->food_rating=="4"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->food_rating.'</b> 5</b>';
                                }
                                if($P->food_rating=="5"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->food_rating.'</b></b>';
                                }?>
                                <br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Teenindusele:</label>
                                <?php if($P->service_rating=="1"){
                                    echo '<b style="color: #9c9898;font-size: 25px"><b style="color:red;font-size:40px">'.$P->service_rating.'</b> 2 3 4 5</b>';
                                }
                                if($P->service_rating=="2"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 <b style="color:#dc36c1;font-size:40px">'.$P->service_rating.'</b> 3 4 5</b>';
                                }
                                if($P->service_rating=="3"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 <b style="color:blueviolet;font-size:40px">'.$P->service_rating.'</b> 4 5</b>';
                                }
                                if($P->service_rating=="4"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 <b style="color:#4972cb;font-size:40px">' .$P->service_rating.'</b> 5</b>';
                                }
                                if($P->service_rating=="5"){
                                    echo '<b style="color: #9c9898;font-size: 25px">1 2 3 4 <b style="color:dodgerblue;font-size:40px">'.$P->service_rating.'</b></b>';
                                }?>
								<br><br><br>

								<label style="color: dodgerblue">Uued hinded:</label><br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Restoranile:</label>
								<?php if($P->grade=="1"){
									echo '<input type="radio" name="grade" value="1" checked><b style="color: red;font-size:24px">1 </b>';
									echo '<input type="radio" name="grade" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
									echo '<input type="radio" name="grade" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
									echo '<input type="radio" name="grade" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
									echo '<input type="radio" name="grade" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
								}
								if($P->grade=="2"){
									echo '<input type="radio" name="grade" value="1" ><b style="color: red;font-size:24px">1 </b>';
									echo '<input type="radio" name="grade" value="2" checked><b style="color: #dc36c1;font-size:24px">2 </b>';
									echo '<input type="radio" name="grade" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
									echo '<input type="radio" name="grade" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
									echo '<input type="radio" name="grade" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
								}
								if($P->grade=="3"){
									echo '<input type="radio" name="grade" value="1" ><b style="color: red;font-size:24px">1  </b>';
									echo '<input type="radio" name="grade" value="2" ><b style="color: #dc36c1;font-size:24px">2  </b>';
									echo '<input type="radio" name="grade" value="3" checked><b style="color: blueviolet;font-size:24px">3 </b>';
									echo '<input type="radio" name="grade" value="4" ><b style="color: #4972cb;font-size:24px">4  </b>';
									echo '<input type="radio" name="grade" value="5" ><b style="color: dodgerblue;font-size:24px">5  </b>';
								}
								if($P->grade=="4"){
									echo '<input type="radio" name="grade" value="1" ><b style="color: red;font-size:24px">1 </b>';
									echo '<input type="radio" name="grade" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
									echo '<input type="radio" name="grade" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
									echo '<input type="radio" name="grade" value="4" checked><b style="color: #4972cb;font-size:24px">4 </b>';
									echo '<input type="radio" name="grade" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
								}
								if($P->grade=="5"){
									echo '<input type="radio" name="grade" value="1" ><b style="color: red;font-size:24px">1 </b>';
									echo '<input type="radio" name="grade" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
									echo '<input type="radio" name="grade" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
									echo '<input type="radio" name="grade" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
									echo '<input type="radio" name="grade" value="5" checked><b style="color: dodgerblue;font-size:24px">5 </b>';
								}?>
                                <br><br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Toidule:</label>
                                <?php if($P->food_rating=="1"){
                                    echo '<input type="radio" name="food_rating" value="1" checked><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="food_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="food_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="food_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="food_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->food_rating=="2"){
                                    echo '<input type="radio" name="food_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="food_rating" value="2" checked><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="food_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="food_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="food_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->food_rating=="3"){
                                    echo '<input type="radio" name="food_rating" value="1" ><b style="color: red;font-size:24px">1  </b>';
                                    echo '<input type="radio" name="food_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2  </b>';
                                    echo '<input type="radio" name="food_rating" value="3" checked><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="food_rating" value="4" ><b style="color: #4972cb;font-size:24px">4  </b>';
                                    echo '<input type="radio" name="food_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5  </b>';
                                }
                                if($P->food_rating=="4"){
                                    echo '<input type="radio" name="food_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="food_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="food_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="food_rating" value="4" checked><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="food_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->food_rating=="5"){
                                    echo '<input type="radio" name="food_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="food_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="food_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="food_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="food_rating" value="5" checked><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }?>
                                <br><br>
                                <label style="font-size: 18px;color: rgb(118,118,118)">Teenindusele:</label>
                                <?php if($P->service_rating=="1"){
                                    echo '<input type="radio" name="service_rating" value="1" checked><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="service_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="service_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="service_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="service_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->service_rating=="2"){
                                    echo '<input type="radio" name="service_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="service_rating" value="2" checked><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="service_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="service_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="service_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->service_rating=="3"){
                                    echo '<input type="radio" name="service_rating" value="1" ><b style="color: red;font-size:24px">1  </b>';
                                    echo '<input type="radio" name="service_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2  </b>';
                                    echo '<input type="radio" name="service_rating" value="3" checked><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="service_rating" value="4" ><b style="color: #4972cb;font-size:24px">4  </b>';
                                    echo '<input type="radio" name="service_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5  </b>';
                                }
                                if($P->service_rating=="4"){
                                    echo '<input type="radio" name="service_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="service_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="service_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="service_rating" value="4" checked><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="service_rating" value="5" ><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }
                                if($P->service_rating=="5"){
                                    echo '<input type="radio" name="service_rating" value="1" ><b style="color: red;font-size:24px">1 </b>';
                                    echo '<input type="radio" name="service_rating" value="2" ><b style="color: #dc36c1;font-size:24px">2 </b>';
                                    echo '<input type="radio" name="service_rating" value="3" ><b style="color: blueviolet;font-size:24px">3 </b>';
                                    echo '<input type="radio" name="service_rating" value="4" ><b style="color: #4972cb;font-size:24px">4 </b>';
                                    echo '<input type="radio" name="service_rating" value="5" checked><b style="color: dodgerblue;font-size:24px">5 </b>';
                                }?>
								

								<br><br>
								<div class="form-group">
									<label for="comment">Kommentaar:</label>
									<b><textarea style="font-size: 20px" class="form-control" rows="5" id="comment" name="comment"><?=$P->comment;?></textarea></b>
								</div><br><br>

								<p class="text-center"><button type="submit" name="update" value="Salvesta" class="btn-warning btn-lg " style="width: 150px">
								<span class="glyphicon glyphicon"></span>Salvesta</button></p>
							</form>

							<br><br>
							<p class="text-center"><a class='btn-danger btn-lg' href="?id=<?=$_GET["id"];?>&name=<?=urlencode($_GET["name"]);?>&delete=true"><span class="glyphicon glyphicon-trash"></span></a></p>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tühista</button>
						  </div>
						</div>
					  </div>
					</div>



<?php require("../footer.php");?>