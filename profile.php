<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Question</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<form action="question.html" id="qForm"> <!-- links the html form to the main php code -->


    </fieldset>
    <fieldset class="F1">


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

//finds user information from the provided email. Will change to use session ID's later
$s = "select * from accounts where email = '$email' ";
($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
    $fname = $r['fname'];
    $lname = $r['lname'];
}

echo "Welcome " .$fname ." " .$lname."<br><br>";

//selects all questions for the given user
$s = "select * from questions where owneremail = '$email' ORDER BY createddate DESC ";
($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
    $title = $r[ "title" ];
    $body = $r[ "body"];
    $skills = $r[ "skills"];
    echo "Title: " .$title."<br>";
    echo "Body: " .$body."<br>";
    echo "Skills: " .$skills."<br>";
    echo "<br>";
}
?>
        <button>Click to go to the question page</button> <!-- submit button -->
    </fieldset>
</form>
