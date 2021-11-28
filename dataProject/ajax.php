<?php /** @noinspection ALL */
header("Content-Type:application/json");
require "php/config.php";

if (isset($_GET['view']) && $_GET['view']!="") {
    $sql = "";

    $view = $_GET['view'];
    switch ($view) {
        case 1 :
            $sql = "SELECT * from finalproject.reservation LEFT JOIN finalproject.users on finalproject.reservation.userid=finalproject.users.userid LEFT JOIN finalproject.movies on finalproject.reservation.movieid=finalproject.movies.movieid;";
            break;
        case 2 :
            $sql = "SELECT  finalproject.reservation.userid,finalproject.users.firstname,finalproject.reservation.movieid
FROM finalproject.reservation,finalproject.users
WHERE finalproject.reservation.price > all (select  finalproject.reservation.price
										FROM finalproject.reservation
										WHERE userid=1) AND finalproject.reservation.userid=finalproject.users.userid
Group by finalproject.reservation.userid;";
            break;
        case 3 :
            $sql = "SELECT *
FROM finalproject.reservation As outerquery
WHERE outerquery.price > ( SELECT avg(finalproject.reservation.price)
								FROM finalproject.reservation
								WHERE outerquery.movieid=finalproject.reservation.movieid
								              );";
            break;
        case 4 :
            $sql = "SELECT * 
FROM finalproject.users
LEFT JOIN finalproject.reservation ON finalproject.users.userid = finalproject.reservation.userid
UNION
SELECT * 
FROM finalproject.users
RIGHT JOIN finalproject.reservation ON finalproject.users.userid = finalproject.reservation.userid;";
            break;
        case 5 :
            $sql = "SELECT finalproject.reservation.userid, finalproject.users.firstname
FROM finalproject.reservation , finalproject.users
WHERE (finalproject.reservation.price > all (select  finalproject.reservation.price FROM finalproject.reservation WHERE userid=1)) and finalproject.reservation.userid=finalproject.users.userid
UNION
SELECT outerquery.userid, finalproject.users.firstname
FROM finalproject.reservation As outerquery , finalproject.users
WHERE (outerquery.price > ( SELECT avg(finalproject.reservation.price)
								FROM finalproject.reservation
								WHERE outerquery.movieid=finalproject.reservation.movieid
								              ) ) and outerquery.userid=finalproject.users.userid;";
            break;
        case 6 :
            $sql = "SELECT sum(finalproject.reservation.amountSeats) as actionTicketsSold
FROM finalproject.reservation,finalproject.movies
WHERE finalproject.reservation.movieid=finalproject.movies.movieID AND finalproject.movies.genre like '%Action%';
";
            break;
        case 7 :
            $sql = "SELECT *
FROM finalproject.reservation
where finalproject.reservation.purchasedate>=CURDATE();
";
            break;
        case 8 :
            $sql = "SELECT sum(finalproject.reservation.amountSeats) as ticketsold,  finalproject.reservation.movieid
FROM finalproject.reservation
group by finalproject.reservation.movieid;
";
            break;
        case 9 :
            $sql = "SELECT finalproject.reservation.movieid as worstmovieID, sum(finalproject.reservation.amountSeats) as ticketsSold
FROM finalproject.reservation
group by finalproject.reservation.movieid
order by sum(finalproject.reservation.amountSeats) ASC
limit 1;";
            break;
        case 10 :
            $sql = "SELECT sum(finalproject.reservation.amountSeats) as ticketsSold, finalproject.reservation.purchasedate as date
FROM finalproject.reservation
group by finalproject.reservation.purchasedate;";
            break;
    }

    $query = $connection->prepare($sql);
    $query->execute();
    $data = array();
    if ($query->execute()) {
        while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
            $data = $row;
        }
    }

    if (!empty($data)) {
        header("Access-Control-Allow-Origin: *");//this allows cors
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode('');
    }

}

elseif (isset($_GET['theatreid']) && $_GET['theatreid']!="") {
    $theatre= $_GET['theatreid'];
    $query = $connection->prepare("SELECT room.roomid from room WHERE theatreid=:theatreid");
    $query->bindParam("theatreid", $theatre, PDO::PARAM_STR);
    $query->execute();
    $data = array();
    foreach($query->fetchall() as $row) {
        $data[]=$row["roomid"];
    }
    echo json_encode($data);
}
else if (isset($_GET['year']) && $_GET['year']!="") {
    $movieTitle=$_GET['Title'];
    $year=$_GET['year'];
    $url = "https://www.omdbapi.com/?t=".urlencode($movieTitle)."&y=".$year."&apikey=12fe6ebe";
    $curl_data= file_get_contents($url);
    echo $curl_data;
}

else if (isset($_GET['movieID']) && $_GET['movieID']!="") {
    $movieid=$_GET['movieID'];
    $url = "https://www.omdbapi.com/?i=tt".$movieid."&apikey=12fe6ebe";
    $curl_data= file_get_contents($url);
    echo $curl_data;
}
else if (isset($_GET['table']) && $_GET['table']!="") {
    $sql = "";

    $table = $_GET['table'];
    switch ($table) {
        case 1 :
            $sql = "SELECT * FROM theatre";break;
        case 2 :
            $sql = "SELECT * FROM room";break;
        case 3 :
            $sql = "SELECT * FROM movies";break;
        case 4 :
            $sql = "SELECT * FROM users";break;
        case 5 :
            $sql = "SELECT * FROM reservation";break;
    }
    $query = $connection->prepare($sql);
    $query->execute();
    $data = array();
    if ($query->execute()) {
        while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
            $data = $row;
        }
    }

    if (!empty($data)) {
        header("Access-Control-Allow-Origin: *");//this allows cors
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode('');
    }
}

?>