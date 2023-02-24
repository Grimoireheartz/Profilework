<?php
include('server.php');
session_start();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$userid = $_POST['userid'];

$sql = "UPDATE userlogin SET firstname='$firstname',lastname='$lastname',email='$email' WHERE id='$userid'";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";

    // $_SESSION["insert_success"] = 'successfully';

    header('Location: index.php');  


  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
