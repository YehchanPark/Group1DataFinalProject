
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="../css/style1.css" rel="stylesheet">
    <title>Booking page PHP</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

</body>
</html>
<?php
require 'config.php';
session_start();
if (isset($_POST['submit'])) { //checking if the user did  click submit
    if(isset($_POST['userNum'])){
        $userid=$_POST['userNum'];
        $query = $connection->prepare("SELECT * FROM users WHERE userid=:userid");//preparing the connection
        $query->bindParam("userid", $userid, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $email = $result['email'];
    } else {
        $userid = $_SESSION['userid'];
        $email= $_SESSION['email'];
    }
    $roomid = $_POST['roomNum'];
    $theatreid = $_POST['theatre'];
    $movieid = $_POST['Movie'];
    $purchasedate = $_POST['date'];
    $seats= $_POST['seats'];
    $price= $_POST['Price'];;
    $seatNum= $_POST['rowNum'];

    if ($userid>=9000) {
        echo '<div id="p1">';
        echo '<p>Admin should not make reservations for themselves</p>';
        echo '<a href="../index.html">Click here to go the home page</a>';
        echo '</div>';
    } else { //if the user not already in the database allow them to continue
        $query = $connection->prepare("INSERT INTO reservation(userid,roomid,theatreid,movieid,purchasedate,amountSeats,price,seatNum) VALUES (:userid,:roomid,:theatreid,:movieid,:purchasedate,:seats,:price,:seatNum)"); //preparing the connection
        $query->bindParam('userid', $userid, PDO::PARAM_STR);
        $query->bindParam('roomid', $roomid, PDO::PARAM_STR);
        $query->bindParam('theatreid', $theatreid, PDO::PARAM_STR);
        $query->bindParam('movieid', $movieid, PDO::PARAM_STR);
        $query->bindParam('purchasedate', $purchasedate, PDO::PARAM_STR);
        $query->bindParam('seats', $seats, PDO::PARAM_STR);
        $query->bindParam("price", $price, PDO::PARAM_STR);
        $query->bindParam("seatNum", $seatNum, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) { //if successful tell user that the registered successfully
            $result = $query->fetch(PDO::FETCH_ASSOC);
            echo  '<div id="p1">';
            echo '<p>You booked successfully</p>';
            echo '<p ">Login Using ' . $email . ' to check your reservations</p>';
            echo '<p>Please bring $' . $price . ' to the door to pay for your ticket(s).</p>';
            $query = $connection->prepare("SELECT movies.start_time FROM movies WHERE movieid=:movieid ");
            $query->bindParam("movieid",$movieid,PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch();
            echo '<p>The shows starts at ' .$result['start_time'] .'.</p>';
            echo '<a href="../createReservation.php">Click here to go to the home page</a>';
            echo '</div>';
        } else { //Else say something went wrong
            echo  '<div id="p1">';
            echo '<p id="p1">Something went wrong!</p>';
            echo '<a href="../createReservation.php">Click here to go the home page</a>';
            echo '</div>';
        }
    }

}

?>