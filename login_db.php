<?php
session_start();
include('server.php');

if (isset($_POST['username'])) {
    $sql = "SELECT  firstname, lastname,email,password FROM myuser";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $user_fname = $row['firstname'];
            $user_lname = $row['lastname'];
            $user_email = $row['email'];
            $user_password = $row['password'];
        }

        if ($user_password == $_POST['password']) {
            $_SESSION['myapp_user'] = $user_email;
            $_SESSION['myapp_fname'] = $user_fname;
            $_SESSION['myapp_lname'] = $user_lname;
            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "0 results";
    }
} else {
    header("Location: login.php ");
}
