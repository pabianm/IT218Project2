<?php
//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

//gets the input data and creates a variable
$qName = $_GET["qName"];
$qBody = $_GET["qBody"];
$qSkills = $_GET["qSkills"];


function isempty($data,$string){
    //checks if input data is an empty string and echos the correct statement
    if (empty($data))
        echo $string." is empty. Please enter a valid ".$string."<br>";
    else
        echo $string.": ".$data."<br>";
}

//checks validity of the data
if (strlen($qName)<3)
    echo "Name is too short. Needs to be more than 3 characters.<br>";
else
    isempty($qName, "Name");

if (strlen($qBody)>500)
    echo "Body is too long. Needs to be less than 500 characters.<br>";
else
    isempty($qBody, "Body");


//checks if skills is empty, creates array, and echos
$qSkills = explode(',', $qSkills);
if (empty($qSkills))
    echo "Please add more than two skills<br>";
else
    if (count($qSkills)<2)
        echo "Please add more than two skills<br>";
    else
        echo "Skills: ".implode(",",$qSkills);






?>