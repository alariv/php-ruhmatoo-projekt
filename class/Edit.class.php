<?php

class Edit
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

    
    function updateResto($id, $grade, $food_rating, $service_rating, $comment){

        $stmt = $this->connection->prepare("UPDATE restoranid SET grade=?, food_rating=?, service_rating=?, comment=? WHERE id=? and deleted is NULL");
        $stmt->bind_param("iiisi", $grade, $food_rating, $service_rating, $comment, $id);

        // kas õnnestus salvestada
        if ($stmt->execute()) {
            // õnnestus
            echo "salvestus õnnestus!";
        }

        $stmt->close();

    }
    function deleteResto($deleted){

        $stmt = $this->connection->prepare("UPDATE restoranid SET deleted=NOW() WHERE id=? and deleted is NULL");
        $stmt->bind_param("i", $deleted);

        // kas õnnestus eemaldada
        if ($stmt->execute()) {
            // õnnestus
            echo "eemaldamine õnnestus!";
        }

        $stmt->close();

    }
}
?>