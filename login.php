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
$pass = $_GET["pass"];

//checks to see if the user has valid credentials
function auth($email, $pass){
    global $db;
    $s = "select * from accounts where email = '$email' and password = '$pass'";
    ($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
    $num =mysqli_num_rows($t);
    if ($num==0){ return false;}
    return true;
}

//checks if input data is an empty string and echos the correct statement
function isempty($data,$string){
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

//checks if the email is valid due to constraints.
if (strpos($email, "@") !==false)
    isempty($email, "Email");
else
    redirect("Email is not valid. Please enter a valid email<br>", "login.html");

//checks if the password is valid due to constraints.
if (strlen($pass)<8)
    redirect("Password is too short. Please enter a valid password. Redirecting you to the login page in 10 seconds.<br>", "login.html");
else
    isempty($pass, "Password");

//checks if the user is using valid credentials. If so, logs the user into the profile page.
if (auth($email, $pass) == true)
    redirect("Your credentials are correct. Redirecting you to your profile in 10 seconds.", "profile.html");
else {
    redirect("Your credentials are inncorrect. Please try again. Redirecting you to the login page in 10 seconds.", "login.html");
}


?>