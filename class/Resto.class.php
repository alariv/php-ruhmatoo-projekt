<?php

class Resto
{

    //klassi sees saab kasutada
    private $connection;

    //$user=new user(see); jouab siia sulgude vahele
    function __construct($mysqli){

        //klassi sees muutujua kasutamiseks $this->
        //this viitab sellele klassile
        $this->connection=$mysqli;

    }


function saverestos($restoName, $grade, $comment, $gender, $customerName, $food, $foodRating, $serviceRating){


    //yhendus olemas
    //kask
    $stmt =$this->connection->prepare("INSERT INTO restoranid (restoName,grade,food,food_rating,service_rating,comment,customer_sex, customer_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    echo $this->connection->error;
    //asendan kysimargid vaartustega
    //iga muutuja kohta 1 taht
    //s tahistab stringi
    //i integer
    //d double/float
    $stmt->bind_param("ssssssss", $restoName, $grade, $food, $foodRating, $serviceRating, $comment, $gender, $customerName);

    if($stmt->execute()){
        echo "salvestamine onnestus ";
    }else {
        echo"ERROR ".$stmt->error;
    }



}

function getallrestos($q, $sort, $order){

    $allwoedSort = ["id","restoName","grade","comment","customer_sex", "customer_name","created"];


    if(!in_array($sort,$allwoedSort)){
        //ei ole lubatud tulp
        $sort="id";

    }
    $orderBy = "ASC";
    if($order == "DESC"){
        $orderBy = "DESC";
    }
    //echo "sorteerin: ".$sort." ".$orderBy." ";
    //kask

    if($q!="") {
        $stmt = $this->connection->prepare("SELECT id, restoName, grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created 
                                            FROM restoranid WHERE deleted is NULL AND (restoName LIKE? OR comment LIKE? OR grade LIKE?)
                                            ORDER BY $sort $orderBy");
        $searchWord="%".$q."%";
        $stmt->bind_param("ssssssssss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
    }else{
        $stmt = $this->connection->prepare("SELECT id, restoName, grade, food, food_rating, service_rating, comment, customer_sex, customer_name, created  FROM restoranid WHERE deleted is NULL
                                            ORDER BY $sort $orderBy");
    }
    echo $this->connection->error;

    $stmt->bind_result($id, $restoName, $grade, $food, $foodRating, $serviceRating, $comment, $gender, $customer_name, $created);
    $stmt->execute();

    $result = array();


    //seni kuni on 1 rida andmeid saada(10rida=10korda)
    while($stmt->fetch()){

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

function getUserRestos($r){
        if($r!="") {
            $stmt = $this->connection->prepare("SELECT id, restoName, food, created 
                                                FROM restoranid WHERE deleted is NULL AND id=?)");
            $stmt->bind_param("ssss");
        }else{
            $stmt = $this->connection->prepare("SELECT id, restoName, food, created 
                                                FROM restoranid WHERE deleted is NULL");
        }
        echo $this->connection->error;

        $stmt->bind_result($id, $restoName, $food, $created);
        $stmt->execute();

        $result = array();


        //seni kuni on 1 rida andmeid saada(10rida=10korda)
        while($stmt->fetch()){

            $restos = new StdClass();
            $restos->id = $id;
            $restos->restoName = $restoName;
            $restos->created = $created;
            $restos->food = $food;


            //echo $color. "<br>";
            array_push($result, $restos);

        }
        $stmt->close();
        return $result;
    }

}
?>