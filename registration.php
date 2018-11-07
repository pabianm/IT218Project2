<?php
//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

//gets the input data and creates a variable
$fname = $_GET["fname"];
$lname = $_GET["lname"];
$bday = $_GET["bday"];
$email = $_GET["email"];
$pass = $_GET["pass"];

function isempty($data,$string){
    //checks if input data is an empty string and echos the correct statement
    if (empty($data))
        echo $string." is empty. Please enter a valid ".$string."<br>";
    else
        echo $string.": ".$data."<br>";
}

//checks validity of the data
isempty($fname, "First name");
isempty($lname, "Last name");
isempty($bday, "Birthday");

if (strpos($email, "@") !==false)
    isempty($email, "Email");
else
    echo "Email is not valid. Please enter a valid email<br>";

if (strlen($pass)<8)
    echo "Password is too short. Please enter a valid password.<br>";
else
    isempty($pass, "Password");
?>