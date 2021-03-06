<?php

class User
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

    function signup ($signupEmail, $signupPassword, $signupName, $signupLName, $signupage, $phonenr, $signupgender){

        //yhendus olemas
        $this->connection = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);

        //kask
        $stmt = $this->connection->prepare("INSERT INTO user_sample (email,password, name, lastname, age, phonenr, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");

        echo $this->connection->error;
        //asendan kysimargid vaartustega
        //iga muutuja kohta 1 taht
        //s tahistab stringi
        //i integer
        //d double/float
        $stmt->bind_param("sssssis", $signupEmail, $signupPassword, $signupName, $signupLName, $signupage, $phonenr, $signupgender);

        if($stmt->execute()){
            header("Location:?passed");
            exit();
        }else {
            header("Location:?failed");
            exit();
        }
    }
    function login($email, $password){

        $error = "";

        $this->connection = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);

        //kask
        $stmt = $this->connection->prepare("
			SELECT id, email, password, gender, name, lastname, age, phonenr, created
			FROM user_sample
			WHERE email=? 
		");

        echo $this->connection->error;

        //asendan kysimargid
        $stmt->bind_param("s", $email);

        //maaran tulpadele muutujad
        $stmt->bind_result($id, $emailfromdatabase, $passwordfromdatabase, $genderfromdb, $namefromdb, $lastnamefromdb, $agefromdb, $phonenrfromdb, $created);
        $stmt->execute();

        if($stmt->fetch()) {
            //oli rida

            //vordlen paroole
            $hash = hash("sha512", $password);
            if($hash == $passwordfromdatabase){

                echo "kasutaja ".$id."logis sisse";

                $_SESSION["userId"]= $id;
                $_SESSION["email"]=$emailfromdatabase;
                $_SESSION["gender"]=$genderfromdb;
                $_SESSION["name"]=$namefromdb;
                $_SESSION["lname"]=$lastnamefromdb;
                $_SESSION["age"]=$agefromdb;
                $_SESSION["phonenr"]=$phonenrfromdb;


                //suunan uuele lehele
                header("location: restoWELCOME.php");


            }else {
                header("Location:?passwd");
                exit();
            }

        }else {
            header("Location:?email");
            exit();
        }

        return $error;
    }




}
?>