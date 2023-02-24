<?php
include('server.php');
session_start();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

$sql = "INSERT INTO userlogin (firstname, lastname, email)
VALUES ('$firstname', '$lastname', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    $_SESSION["insert_success"] = 'successfully';

    header('Location: Register.php');  


  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>