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

//redirects a user to the url with a delay
function redirect ($message, $url) {
    echo "$message";
    header ("refresh: 10;  url=$url");	//sends refresh http header to browser
    exit();
}

//checks validity of the data
isempty($fname, "First name");
isempty($lname, "Last name");
isempty($bday, "Birthday");

//checks if the email is valid due to constraints.
if (strpos($email, "@") !==false)
    isempty($email, "Email");
else
    redirect("Email is not valid. Please enter a valid email. Redirecting you to the registration page in 10 seconds.<br>", "registration.html");

//checks if the password is valid due to constraints.
if (strlen($pass)<8)
    redirect("Password is too short. Please enter a valid password. Redirecting you to the registration page in 10 seconds.<br>", "registration.html");
else
    isempty($pass, "Password");

//inserts data into the table
$s = "insert into accounts values ( id , '$email', '$fname', '$lname', '$bday', '$pass' ) ";
($t = mysqli_query($db, $s1 ) ) or die (mysqli_error($db));
redirect ("Successfully registered. Redirecting to your profile.", "profile.html");
?>
