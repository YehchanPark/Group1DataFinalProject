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
                        view: str,
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
                document.getElementById("viewInfo").innerHTML = "In this view, the reservation table is joined with the user table tuple and movie table tuples that is related to the reservation tuple itself. The output will show all three tables and all columns in the respective tables.";
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
                        {"data": "seatNum", title: "seatNum"},
                        {"data": "firstname", title: "firstname"},
                        {"data": "lastname", title: "lastname"},
                        {"data": "email", title: "email"},
                        {"data": "password", title: "password"},
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
            } else if (view == 2) {
                document.getElementById("viewInfo").innerHTML = "In this view, it will list everyone who has paid for a reservation that was more than a reservation made by userid 1. It is grouped by userid.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "userid", title: "userid"},
                        {"data": "firstname", title: "firstname"},
                        {"data": "movieid", title: "movieid"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 3) {
                document.getElementById("viewInfo").innerHTML = "In this view, for each movieid, show the reservations totals that were higher than the average total for that movie specifically. The output would only use movies that have a reservation among them.";
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
            } else if (view == 4) {
                document.getElementById("viewInfo").innerHTML = "The view shows all matches from the user table and the reservation table. The userid should match between the two tables. If the user does not have a reservation, a null would be put into place. The users will be displayed with their respective reservations";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "userid", title: "userid"},
                        {"data": "firstname", title: "firstname"},
                        {"data": "lastname", title: "lastname"},
                        {"data": "email", title: "email"},
                        {"data": "password", title: "password"},
                        {"data": "reservationID", title: "reservationID"},
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
            } else if (view == 5) {
                document.getElementById("viewInfo").innerHTML = "In this view, combination of the sets of the people whose reservation price is greater than all of the prices from the userid 1 and the list of people whose reservation price is greater than the average price of the specific movie.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "userid", title: "userid"},
                        {"data": "firstname", title: "firstname"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 6) {
                document.getElementById("viewInfo").innerHTML = "This view will show the amount of tickets sold from all action movies. It displays the amount of tickets sold by each movie.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "actionTicketsSold", title: "actionTicketsSold"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 7) {
                document.getElementById("viewInfo").innerHTML = "This view will list all of the reservations that are set for the current date. It will show all of the tuples that have the same date as today.";
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
            } else if (view == 8) {
                document.getElementById("viewInfo").innerHTML = "Get the amount of tickets sold by each theatre that has a reservation for them. Theatres without reservations will not show up or have a count.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "ticketsold", title: "ticketsold"},
                        {"data": "movieid", title: "movieid"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 9) {
                document.getElementById("viewInfo").innerHTML = "This view will show the worst performing movie of all the movies that have a reservation. The lowest performing movie is determined by the lowest amount of total ticket sales. The movie id and the number of tickets sold will be displayed.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "worstmovieID", title: "worstmovieID"},
                        {"data": "ticketsSold", title: "ticketsSold"}
                    ],
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ]
                });
            } else if (view == 10) {
                document.getElementById("viewInfo").innerHTML = "This view will show the amount of tickets sold for the day of the movie. It will display all dates that have a ticket sold for it, and the total number of tickets sold for that date.";
                oTblReport.DataTable({
                    "data": oResults,
                    "columns": [
                        {"data": "ticketsSold", title: "ticketsSold"},
                        {"data": "date", title: "date"}
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
    <title>All Views</title>
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
            <li class="nav-item active">
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
<h1>All the views</h1>

<form action="">
    <label for="viewSelect">Select a View: </label><select name="viewSelect" id="viewSelect" onchange="showView(this.value);dis()">
        <option value="">Select a View</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>
</form>
<br>
<p id='viewInfo'></p>
<table id="viewTable" class="display dt-body-center"  width="60%"></table>

</div>


</body>
</html>