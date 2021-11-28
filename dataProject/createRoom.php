
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
    <title>Create Room</title>
    <script>
    function setRoomMin(val){
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
                    $('#roomid').empty();
                    $("#roomid").prop( "disabled", false );
                    $("#theatreSelect option[value='']").attr("disabled","disabled");
                    $(document).ready(function() {
                        $("input").attr({
                            "min" : result.length+1         // values (or variables) here
                        });
                        $("#roomid").val(result.length+1);
                    })
                },
                error: function(xhr, status, error) {
                }
            })
        })


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
            <li class="nav-item active">
                <a class="nav-link" href="createRoom.php">Add rooms to theatres</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="createMovie.php">Add movies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div id="p4" >
    <p>Create a Room for a theatre</p>
        <form action="php/createR.php" id="makeRoom" method="post" name="makeRoom">
            <?php
            include_once('php/config.php');
            $sql="SELECT * from theatre";
            print "<label class='label' for='theatreid'>For what theatre would you like to create a room?</label> <select id='theatreid' name='theatreid' onchange='setRoomMin(this.value);' required=''>";
            print "<option value=''</option><br>";
            foreach ($connection->query($sql) as $row) {
                print "<option value=".$row['theatreID'].">"."Theatre ".$row['theatreID']." In ".$row['city']."</option>"."<br>";
            }
            print "</select><br>";

            ?>

            <label class="label" for="roomid">What will the Room ID be</label> <input id="roomid" name="roomid"  required type="number" disabled ><br>
            <input class="button" name="submit" type="submit" value="Submit">
        </form>



</div>

</body>
</html>