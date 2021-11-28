<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="../css/style1.css" rel="stylesheet">
    <title>Movie Creation page</title>
</head>
<body>

</body>
</html>
<?php
require 'config.php';
if (isset($_POST['submit'])) {
    session_start();
    $title = $_POST['title'];
    $year = $_POST['year'];
    $time = $_POST['time'];
    $url = "https://www.omdbapi.com/?t=".urlencode($title)."&y=".$year."&apikey=12fe6ebe";
    $curl_data= file_get_contents($url);
    $data = json_decode($curl_data,true);
    if ($data['Response']!="False") {
        $id = preg_replace('~\D~', '', $data['imdbID']);

        $query = $connection->prepare("SELECT * FROM movies WHERE movieID=:id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<div id="p1">';
            echo '<p>The Movie is already in the database!</p>';
            echo '<a href="../createMovie.php">Click here to go back</a>';
            echo '</div>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO movies(movieID,title,genre,running_time,start_time) VALUES (:id,:title,:genre,:runtime,:starttime)"); //preparing the connection
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->bindParam('title', $data['Title'], PDO::PARAM_STR);
            $query->bindParam("genre", $data['Genre'], PDO::PARAM_STR);
            $query->bindParam('runtime', $data['Runtime'], PDO::PARAM_STR);
            $query->bindParam('starttime', $time, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) { //if successful tell user that the registered successfully
                echo '<div id="p1">';
                echo '<p style="font-weight: bold">Movied added successfully! <br>Name:' . $data['Title'] . '</p>';
                echo '<a href="../createMovie.php">Click here to go back</a>';
                echo '</div>';
            } else { //Else say something went wrong
                echo '<div id="p1">';
                echo '<p style="font-weight: bold">Something went wrong!</p>';
                echo '<a href="../createMovie.php">Click here to go back</a>';
                echo '</div>';
            }
        }
    } else{
        echo '<div id="p1">';
        echo '<p>Please enter a valid movie!</p>';
        echo '<a href="../createMovie.php">Click here to go back</a>';
        echo '</div>';
    }
}



?>
