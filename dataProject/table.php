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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="css/style1.css" rel="stylesheet">
    <script>
        check = 0;

        function showView(str) {
            $(document).ready(function () {
                $.ajax({
                    type: "GET",
                    url: 'ajax.php',
                    data: {
                        table: str,
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.length);
                        if (result.length == 0) {
                            console.log("result has 0 length");
                            if (check > 0) {
                                $('#viewTable').DataTable().clear().destroy();
                                $('#viewTable').empty();
                                $('#viewTable' + " tbody").empty();
                                $('#viewTable' + " thead").empty();
                                check=0;
                            }
                            document.getElementById("viewInfo").innerHTML = "";
                            $( "#viewInfo" ).append("Query results in 0 rows" );
                            return;
                        }

                        LoadCurrentReport(result, str)


                    },
                    error: function (xhr, status, error) {
                        console.log("I am in error");
                        if (check > 0) {
                            $('#viewTable').DataTable().clear().destroy();
                            $('#viewTable').empty();
                            $('#viewTable' + " tbody").empty();
                            $('#viewTable' + " thead").empty();
                        }
                        $('#viewInfo').clear();
                        $('#viewInfo').append( "\n Query results in 0 rows" );
                        console.error(xhr);
                    }
                })
            })
        }

        function LoadCurrentReport(oResults, view) {
            if (check > 0) {
                $('#viewTable').DataTable().clear().destroy();
                $('#viewTable').empty();
                $('#viewTable' + " tbody").empty();
                $('#viewTable' + " thead").empty();
            }
            check = 1;
            //

            var oTblReport = $("#viewTable")

            if (view == 1) {
                document.getElementById("viewInfo").innerHTML = "This is the theatre table. Will show tuples of theatre ids and corresponding citys";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "theatreID", title: "theatreID"},
                        {"data": "city", title: "city"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 2) {
                document.getElementById("viewInfo").innerHTML = "This is the rooms table. Will show  tuples of rooms and corresponding theatre ids";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "roomid", title: "roomid"},
                        {"data": "theatreid", title: "theatreid"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 3) {
                document.getElementById("viewInfo").innerHTML = "This is the movie table. Will shows tuples of movies information .";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "movieID", title: "movieID"},
                        {"data": "title", title: "title"},
                        {"data": "genre", title: "genre"},
                        {"data": "running_time", title: "running_time"},
                        {"data": "start_time", title: "start_time"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 4) {
                document.getElementById("viewInfo").innerHTML = "This is the user table. Will show tuples of user information";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "userid", title: "userid"},
                        {"data": "firstname", title: "firstname"},
                        {"data": "lastname", title: "lastname"},
                        {"data": "email", title: "email"},
                        {"data": "password", title: "password"},
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 5) {
                document.getElementById("viewInfo").innerHTML = "This is the reservation table. Will show tuples of reservations .";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "reservationID", title: "reservationID"},
                        {"data": "userid", title: "userid"},
                        {"data": "roomid", title: "roomid"},
                        {"data": "theatreid", title: "theatreid"},
                        {"data": "movieid", title: "movieid"},
                        {"data": "purchasedate", title: "purchasedate"},
                        {"data": "amountSeats", title: "amountSeats"},
                        {"data": "price", title: "price"},
                        {"data": "seatNum", title: "seatNum"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            }
        }

        function dis() {
            document.getElementById("viewSelect").options[0].disabled = true;
        }
    </script>
    <title>All Tables</title>
</head>
<body>
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
            <li class="nav-item active ">
                <a class="nav-link" href="table.php">Look at the database tables</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="createTheatre.php">Add Theatres</a>
            </li>
            <li class="nav-item ">
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
<div id="p7">
    <h1>All the tables</h1>

    <form action="">
        <label for="viewSelect">Select a Table: </label><select name="viewSelect" id="viewSelect" onchange="showView(this.value);dis()">
            <option value="">Select a Table</option>
            <option value="1">Theatre</option>
            <option value="2">Room</option>
            <option value="3">Movies</option>
            <option value="4">Users</option>
            <option value="5">Reservation</option>
        </select>
    </form>
    <br>
    <p id='viewInfo'></p>
    <table id="viewTable" class="display dt-body-center"  width="60%"></table>

</div>


</body>
</html>