
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $check=false;
    session_start();
    if( (empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == '')){
        print '
        <script>
        alert("Please login first");
        setTimeout(function(){
            window.location = "start.html";
        }, 500);
        </script>';

    }
    if ($_SESSION['userid']>=9000){
        $check=true;
    }
    ?>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"><!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/style1.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Reservations</title>
    <script>
        function setRoom(val) {
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: 'ajax.php',
                    data: {
                        theatreid: val,
                    },
                    dataType: 'json',
                    success: function(result) {
                        var data = new Array();
                        $('#roomType').empty();
                        for (var i = 0; i < result.length; i++) {
                            $('#roomType').append(`<option value="${result[i]}">${result[i]}</option>`);
                        }
                    },
                    error: function(xhr, status, error) {
                    }
                })
            })
        }
        function dateGet() {
            //var today = new Date();
            //today.setDate(today.getDate() + 86400000);
            //today=today.toLocaleDateString("fr-CA");
            var today = new Date((new Date()).valueOf() + 1000*3600*24).toLocaleDateString("fr-CA");
            document.getElementsByName("date")[0].setAttribute("min", today);
        }
        function setMovie(val) {
            console.log(val);
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: 'ajax.php',
                    data: {
                        movieID: val,
                    },
                    dataType: 'json',
                    success: function(data) {

                        console.log(data['Poster'])
                        $('#movieDisplay').empty();

                        $('#movieDisplay').append(`<img src="${data['Poster']}"/>
<hr/>
Title: <strong>"${data['Title']}"</strong><br/>
Year: "${data['Year']}"<br/>
Genre: "${data['Genre']}"<br/>
Actors : "${data['Actors']}"<br/>
Plot: "${data['Plot']}"<br/>
IMDB Rating: <strong>"${data['imdbRating']}"</strong> / Votes ("${data['imdbVotes']}")<br/>`);
                    },
                    error: function(xhr, status, error) {
                    }
                })
            })
        }
        function updateSub() {
                var total = $('#seats').val()*12;
                $('#totalPrice').text(`Total Price = $${total}`);
                $('#PRICE').val(total)
        }
    </script>
</head>
<body onload="dateGet();updateSub()">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js">
</script>
<nav class="navbar sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Movie DBMS</a> <button class="navbar-toggler" data-target="#collapsingNavbar" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Start Page</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="createReservation.php">Make Reservations</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?php if(!$check){ echo "disabled";}?>" href="view.php">Look at database Views</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(!$check){ echo "disabled";}?>" href="table.php">Look at the database tables</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?php if(!$check){ echo "disabled";}?> " href="createTheatre.php">Add Theatres</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?php if(!$check){ echo "disabled";}?>" href="createRoom.php">Add rooms to theatres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(!$check){ echo "disabled";}?>" href="createMovie.php">Add movies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div id="p2" >

<div id="p3">
    <p>Create a Reservation</p>
    <form action="php/book.php" id="book2" method="post" name="book">
        <?php
        include_once('php/config.php');
        $sql="SELECT * from theatre";
        print "<label class='label' for='theatre'>What theatre?</label> <select id='theatreSelect' name='theatre' onchange='setRoom(this.value);' required=''>";
        foreach ($connection->query($sql) as $row) {
            print "<option value=".$row['theatreID'].">"."Theatre ".$row['theatreID']." In ".$row['city']."</option>"."<br>";
        }
        print "</select><br>";

        $sql="SELECT movies.title,movies.movieid from movies";
        print "<label class='label' for='Movie'>What movie?</label><select id='showType' name='Movie' onchange='setMovie(this.value)' required=''>";
        foreach ($connection->query($sql) as $row) {
            print "<option value=".$row['movieid'].">".$row['title']."</option>"."\n";
        }
        print "</select><br>";
        $sql="SELECT room.roomid from room WHERE theatreid=1";
        print "<label class='label' for='roomNum'>What room?</label><select id='roomType' name='roomNum' onchange='' required=''>";
        foreach ($connection->query($sql) as $row) {
            print "<option value=".$row['roomid'].">".$row['roomid']."</option>"."\n";
        }
        print "</select><br>";

        if($check) {
            $sql="SELECT users.userid,users.email from users";
            print "<label class='label' for='userNum'>What user?</label><select id='userNum' name='userNum' onchange='' required=''>";
            foreach ($connection->query($sql) as $row) {
                if($row['userid'] < 9000){
                print "<option value=".$row['userid'].">".$row['email']."</option>"."\n";
                }
            }
            print "</select><br>";
        }
        ?>

        <label class="label" for="date">Date</label> <input id="date" name="date"  required type="date"><br>
            <label class="label" for="seats">Number of tickets :</label> <select id="seats" name='seats' onchange="updateSub()" required="">
                <option value="1">
                    1
                </option>
                <option value="2">
                    2
                </option>
                <option value="3">
                    3
                </option>
                <option value="4">
                    4
                </option>
            </select><br>
            <p id="totalPrice"></p><input id="PRICE" name="Price" type="hidden" value="">
        <label class="label" for="rowNum">Row Num</label> <input id="rowNum" name="rowNum"  required type="number"><br>
            <input class="button" name="submit" type="submit" value="Submit">
    </form>
</div>
<div id="p9">
<form id="movieDisplay">
<?php

$movieTitle="Dune";
$url = "https://www.omdbapi.com/?t=".urlencode($movieTitle)."&y=2021&apikey=12fe6ebe";

// Set the curl URL option
$curl_data= file_get_contents($url);

// Decode JSON into PHP array
$data = json_decode($curl_data,true);

echo '
<img src="'.$data['Poster'].'"/>
<hr/>
Title: <strong>'.$data['Title'].'</strong><br/>
Year: '.$data['Year'].'<br/>
Genre: '.$data['Genre'].'<br/>
Actors : '.$data['Actors'].'<br/>
Plot: '.$data['Plot'].'<br/>
IMDB Rating: <strong>'.$data['imdbRating'].'</strong> / Votes ('.$data['imdbVotes'].')<br/>
';
?>
</div>

</div>

</form>
</body>
</html>