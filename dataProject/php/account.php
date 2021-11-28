<?php
require 'config.php';
if (isset($_POST['login'])) { //checking if the user did click login
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password']; //Getting user inputted info
    $query = $connection->prepare("SELECT * FROM users WHERE email=:email"); //preparing the connection
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC); //getting the row where the email address is
    if (!$result) { //if the email does not exist or done wrong, Output this
        echo '<p>Email entered is wrong or not in database!</p>';
        echo '<a href="../start.html">Click here to go back</a>';
    } else { //if that email exists
        if ($password==$result['password']) { //If the password is right do this
            $_SESSION['userLogin'] = "Loggedin";
            $_SESSION['email'] = $result['email'];
            $_SESSION['userid'] = $result['userid'];
            header("Location: ../index.html");
		    exit;
        } else { //if the password is not right tell the user
            echo '<p>Invalid password entered!</p>';
            echo '<a href="../start.html">Click here to go back</a>';
        }
    }
}
if (isset($_POST['reg'])) { //checking if the user did  click submit
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName']; //Getting user inputted info
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = $connection->prepare("SELECT * FROM users WHERE email=:email"); //preparing the connection
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) { //if the email is already in the table, output a message to the user
        echo '<p>The email address is already registered! Please use another email!</p>';
        echo '<a href="../start.html">Click here to go back</a>';
    }
    if ($query->rowCount() == 0) { //if the user not already in the database allow them to continue
        $query = $connection->prepare("SELECT * FROM users");
        $query->execute();
        $userid=($query->rowCount())+1;
        $query = $connection->prepare("INSERT INTO users(userid,firstname,lastname,email,password) VALUES (:userid,:firstname,:lastname,:email,:password)"); //preparing the connection
        $query->bindParam('userid', $userid, PDO::PARAM_STR);
        $query->bindParam('firstname', $firstname, PDO::PARAM_STR);
        $query->bindParam('lastname', $lastname, PDO::PARAM_STR);
        $query->bindParam('password', $password, PDO::PARAM_STR);
        $query->bindParam('email', $email, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) { //if successful tell user that the registered successfully
            echo '<p style="font-weight: bold">You registered successfully! <br>Email:'.$email.'</p>';
            echo '<a href="../start.html">Click here to continue</a>';
        } else { //Else say something went wrong
            echo '<p style="font-weight: bold">Something went wrong!</p>';
            echo '<a href="../start.html">Click here to go back</a>';
        }
    }
}
?>