<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    if( (empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == '') || $_SESSION['userid']<=9000){
        print '
        <script>
        alert("Please login into an admin account first ");
        setTimeout(function(){
            window.location = "start.html";
        }, 250);
        </script>';

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
    <title>Create A Movie</title>
    <script>
        function setMovie() {
            option = $('#title').val();
            option2 = $('#year').val();
            console.log(option);
            console.log(option2);
            if (option!=""&&option2!="") {
                $(document).ready(function () {
                    $.ajax({
                        type: "GET",
                        url: 'ajax.php',
                        data: {
                            Title: option,
                            year: option2
                        },
                        dataType: 'json',
                        success: function (data) {

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
                        error: function (xhr, status, error) {
                        }
                    })
                })
            } else{
                $('#movieDisplay').append(`Please input a year and name first`);
            }
        }
    </script>
</head>
<body onload="">
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
            <li class="nav-item">
                <a class="nav-link" href="createReservation.php">Make Reservations</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="view.php">Look at database Views</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="table.php">Look at the database tables</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="createTheatre.php">Add Theatres</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="createRoom.php">Add rooms to theatres</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="createMovie.php">Add movies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div id="p2" >
    <div id="p3">
        <p>Create a Movie</p>
        <form action="php/createM.php" id="createM" method="post" name="movie">
            <P>An api will be used to based on inputs to determine information to insert into database. Click the search button to verify its the right movie</P>
            <label class="label" for="title">Enter a Movie Name to insert:</label> <input id="title" name="title"  required type="text"><br>
            <label class="label" for="year">Enter the Year it was made:</label> <input id="year" name="year"  required type="number"><br>
            <label class="label" for="time">Enter the time the movie should start:</label> <input id="time" name="time"  required type="text"><br>
            <input class="button" name="submit" type="submit" value="Submit">
        </form>
    </div>
    <div id="p9">
        <form id="movieDisplay">
            <?php


            ?>
        </form>
        <input class="button" name="search" type="submit" onclick="setMovie()" value="Search">
    </div>

</div>

</body>
</html>