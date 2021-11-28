<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="../css/style1.css" rel="stylesheet">
    <title>Theatre Creation page</title>
</head>
<body>

</body>
</html>
<?php
require 'config.php';
if (isset($_POST['submit'])) {
    session_start();
    $theatreid = $_POST['theatreid'];
    $city = $_POST['city'];
    $query = $connection->prepare("SELECT * FROM theatre WHERE theatreID=:theatreid");
    $query->bindParam("theatreid", $theatreid, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<div id="p1">';
        echo '<p>The theatreid is already in use! Please use another id!</p>';
        echo '<a href="../createTheatre.php">Click here to go back</a>';
        echo '</div>';
    }
    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO theatre(theatreID,city) VALUES (:theatreid,:city)"); //preparing the connection
        $query->bindParam("theatreid", $theatreid, PDO::PARAM_STR);
        $query->bindParam('city', $city, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) { //if successful tell user that the registered successfully
            echo '<div id="p1">';
            echo '<p style="font-weight: bold">Theatre registered successfully! <br>City:'.$city.'</p>';
            echo '<a href="../createTheatre.php">Click here to go back</a>';
            echo '</div>';
        } else { //Else say something went wrong
            echo '<div id="p1">';
            echo '<p style="font-weight: bold">Something went wrong!</p>';
            echo '<a href="../createTheatre.php">Click here to go back</a>';
            echo '</div>';
        }
    }
}



?>
