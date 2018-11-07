<?php
//include statement(s)
include ("account.php");

//boiler plate text for connecting to mysqli
$db = mysqli_connect($hostname, $username, $password, $project);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
mysqli_select_db($db, $project );

//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

//gets the input data and creates a variable
$email = $_GET["email"];
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

//redirects a user to the url with a delay
function redirect ($message, $url) {
    echo "$message";
    header ("refresh: 10;  url=$url");	//sends refresh http header to browser
    exit();
}

//checks validity of the data
if (strlen($qName)<3)
    redirect("Name is too short. Needs to be more than 3 characters.<br>","question.html");
else
    isempty($qName, "Name");

if (strlen($qBody)>500)
    redirect("Body is too long. Needs to be less than 500 characters.<br>", "question,html");
else
    isempty($qBody, "Body");


//checks if skills is empty, creates array, and echos
$qSkills = explode(',', $qSkills);
if (empty($qSkills))
    redirect("Please add more than two skills<br>", "question.html");
else
    if (count($qSkills)<2)
        redirect("Please add more than two skills<br>", "question.html");
    else
        echo "Skills: ".implode(", ",$qSkills). "<br>";

//finds user information from the provided email. Will change to use session ID's later
$s = "select * from accounts where email = '$email' ";
($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
    $ownerid = $r[ "id" ];

}

$qSkills = implode(", ",$qSkills);

//inserts data into the table
$s = "insert into questions values ( id , '$email', '$ownerid', NOW(),'$qName', '$qBody', '$qSkills', 0 ) ";
($t = mysqli_query($db, $s ) ) or die (mysqli_error($db));
redirect ("Successfully registered. Redirecting to your profile.", "profile.php?email=".$email);




?>