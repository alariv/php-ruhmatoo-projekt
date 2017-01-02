<?php

class Resto
{

    //klassi sees saab kasutada
    private $connection;

    //$user=new user(see); jouab siia sulgude vahele
    function __construct($mysqli)
    {

        //klassi sees muutujua kasutamiseks $this->
        //this viitab sellele klassile
        $this->connection = $mysqli;

    }

    function saverestos($restoName, $grade, $comment, $gender, $customerName, $food, $foodRating, $serviceRating, $customerId){


        //yhendus olemas
        //kask
        $stmt = $this->connection->prepare("INSERT INTO restoranid (restoName,grade,food,food_rating,service_rating,comment,customer_sex, customer_id, customer_name) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        echo $this->connection->error;
        //asendan kysimargid vaartustega
        //iga muutuja kohta 1 taht
        //s tahistab stringi
        //i integer
        //d double/float
        $stmt->bind_param("sssssssis", $restoName, $grade, $food, $foodRating, $serviceRating, $comment, $gender, $customerId, $customerName);

        if ($stmt->execute()) {
            echo "salvestamine onnestus ";
        } else {
            echo "ERROR " . $stmt->error;
        }
	}
    function getallrestos($q, $sort, $order){

        $allwoedSort = ["id", "restoName", "grade", "comment", "customer_sex", "customer_name", "created"];


        if (!in_array($sort, $allwoedSort)) {
            //ei ole lubatud tulp
            $sort = "id";

        }
        $orderBy = "ASC";
        if ($order == "DESC") {
            $orderBy = "DESC";
        }
        //echo "sorteerin: ".$sort." ".$orderBy." ";
        //kask

        if ($q != "") {
            $stmt = $this->connection->prepare("SELECT id, restoName, grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created 
                                                FROM restoranid WHERE deleted is NULL AND (restoName LIKE? OR comment LIKE? OR grade LIKE?)
                                                ORDER BY $sort $orderBy");
            $searchWord = "%" . $q . "%";
            $stmt->bind_param("ssssssssss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
        } else {
            $stmt = $this->connection->prepare("SELECT id, restoName, grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created  
                                                FROM restoranid WHERE deleted is NULL ORDER BY $sort $orderBy, restoName");
        }
        echo $this->connection->error;

        $stmt->bind_result($id, $restoName, $grade, $food, $foodRating, $serviceRating, $comment, $gender, $customer_name, $created);
        $stmt->execute();

        $result = array();


        //seni kuni on 1 rida andmeid saada(10rida=10korda)
        while ($stmt->fetch()) {

            $person = new StdClass();
            $person->id = $id;
            $person->restoName = $restoName;
            $person->grade = $grade;
            $person->comment = $comment;
            $person->gender = $gender;
            $person->customerName = $customer_name;
            $person->created = $created;
            $person->food = $food;
            $person->foodRating = $foodRating;
            $person->serviceRating = $serviceRating;


            //echo $color. "<br>";
            array_push($result, $person);

        }
        $stmt->close();
        return $result;
    }
    function saveUserRestos($userId,$restoId){


        //yhendus olemas
        //kask
        $stmt = $this->connection->prepare("INSERT INTO user_restos (user_id, resto_id) 
                                            VALUES (?, ?)");
		
		echo $this->connection->error;
		$stmt->bind_param("ii", $userId, $restoId);
		
		if ($stmt->execute()) {
            echo "salvestamine onnestus ";
        } else {
            echo "ERROR " . $stmt->error;
        }
		
    }
    function getUserRestos(){

        $stmt = $this->connection->prepare("
			SELECT id,restoName,created
            FROM restoranid
            WHERE customer_id=? AND deleted is NULL
		");
        echo $this->connection->error;

        $stmt->bind_param("i",$_SESSION["userId"]);

        $stmt->bind_result($restoId,$restoName,$created);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $r = new StdClass();
            $r->restoId = $restoId;
            $r->restoName = $restoName;
            $r->created = $created;

            array_push($result, $r);
        }

        $stmt->close();

        return $result;
    }
	function getSingleRestoData($id){


        $stmt = $this->connection->prepare("SELECT restoName, grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created FROM restoranid WHERE id=? and deleted is NULL");
        $stmt->bind_param("s", $id);
        $stmt->bind_result($restoName, $grade, $food, $food_rating, $service_rating, $comment, $customer_sex, $customer_name, $created);
        $stmt->execute();

        //tekitan objekti
        $resto = new Stdclass();

        //saime ühe rea andmeid
        if ($stmt->fetch()) {
            // saan siin alles kasutada bind_result muutujaid
            $resto->restoName= $restoName;
            $resto->grade=$grade;
            $resto->food=$food;
            $resto->food_rating=$food_rating;
            $resto->service_rating=$service_rating;
            $resto->comment=$comment;
            $resto->customer_sex=$customer_sex;
            $resto->customer_name=$customer_name;
            $resto->created=$created;
            $resto->id=$id;


        } else {
            // ei saanud rida andmeid kätte
            // sellist id'd ei ole olemas
            // see rida võib olla kustutatud

           header("Location: restoFEEDBACK.php");
           echo "Midagi laks valesti:/";
           exit();
        }

        $stmt->close();

        return ($resto);

    }
    function getSingleRestoName($restoName){


        $stmt = $this->connection->prepare("SELECT grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created FROM restoranid WHERE restoName LIKE ? and deleted is NULL");
        $stmt->bind_param("s", $restoName);
        $stmt->bind_result($grade, $food, $food_rating, $service_rating, $comment, $customer_sex, $customer_name, $created);
        $stmt->execute();

        //tekitan objekti
        $oneresto = new Stdclass();

        //saime ühe rea andmeid
        if ($stmt->fetch()) {
            // saan siin alles kasutada bind_result muutujaid
            $oneresto->grade=$grade;
            $oneresto->food=$food;
            $oneresto->food_rating=$food_rating;
            $oneresto->service_rating=$service_rating;
            $oneresto->comment=$comment;
            $oneresto->customer_sex=$customer_sex;
            $oneresto->customer_name=$customer_name;
            $oneresto->created=$created;


        } else {
            // ei saanud rida andmeid kätte
            // sellist restoName'i ei ole olemas
            // see rida võib olla kustutatud

           header("Location: restoFEEDBACK.php");
            echo "Midagi laks valesti:/";
            //var_dump($oneresto);
            exit();
        }

        $stmt->close();

        return ($oneresto);

    }
    function getFact(){
        $stmt = $this->connection->prepare("
			SELECT fact from resto_facts ORDER BY RAND() LIMIT 1
		");
        echo $this->connection->error;

        $stmt->bind_result($restoFact);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $r = new StdClass();
            $r->restoFact = $restoFact;


            array_push($result, $r);
        }

        $stmt->close();

        return $result;
    }
    function getRestosfordropdown(){

        $stmt = $this->connection->prepare("
                SELECT id,restoName
                FROM resto_restos
            ");
        echo $this->connection->error;

        $stmt->bind_result($restoId,$restoName);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $d = new StdClass();
            $d->restoId = $restoId;
            $d->restoName = $restoName;

            array_push($result, $d);
        }

        $stmt->close();

        return $result;
    }
    function saveRestosfordropdown($restoName){

    echo "siin";
        //yhendus olemas
        //kask
        $stmt = $this->connection->prepare("INSERT INTO resto_restos (restoName) 
                                            VALUES (?)");

        echo $this->connection->error;
        $stmt->bind_param("s", $restoName);

        if ($stmt->execute()) {
            echo "salvestamine onnestus ";
        } else {
            echo "ERROR " . $stmt->error;
        }

    }
}
?>