# **Group 1 Data Management Final Project**

## Detailed Installation Guide

### Installing The Program:

#### Moving the download to your server:

NOTE: For the purpose of this we will be using WAMP as our server. The Process should be similar for other servers.
1. First, download the dataProject folder from our Github.
2. Locate the WAMP folder on your system and open it.
![Directory image showing the folders](/installationImages/directory.JPG)
3. Place and extract the downloaded dataProject folder and place it in the WWW folder.

#### Installing the database:
NOTE: For this we will be using phpmyadmin to install the database. Other tools such as SqLite or MySQl workbench can be used instead. Phpmyadmin should exist on your server regardless of if you choose WAMP or not.

1. Run WAMP
2. In the browser of your choice type into the address bar [http://localhost/phpmyadmin/index.php](http://localhost/phpmyadmin/index.php)
![URL needed to locate index.php](/installationImages/url.JPG)
3. Login into phpmyadmin, the default username is root and the password is empty (Leave the field blank).
![Login page using MySQL server and login credentials](/installationImages/login.JPG)
4. Click the import tab in the middle of the page
![Import tab shown to be 6 tabs from the left](/installationImages/adminImport.JPG)
5. Download or Locate the SQL file inside the dataProject folder you downloaded earlier. It is in the SQL to Create Database folder.
6. Click the browse button and select the SQL file you downloaded/located earlier.
![Import using the choose file button](/installationImages/importSQL.JPG)
7. Scroll down the page and click the GO button on the bottom right. The schema should be automatically created and the table should be prefilled with sample data.

#### Configuring the database:
1. Open the dataProject folder inside your server
2. Open the php folder
3. Open config.php
4. Change the username/password in the define section. By default ‘user’ as root and password as ‘’ should work.
![Shows where the password is saved by default](/installationImages/passwordSaved.JPG)

### Using The Program
NOTE: There are two types of users. To access the whole program please use the admin account. Login: admin@email.ca Password: admin
To start using the program open start.html in your server. If are you using WAMP its
http://localhost/dataProject/start.html
![URL to start the program](/installationImages/urlStart.JPG)

### Start.html
This is the starting page of the website. Use this to create an account or login into the website. Remember if you create a new account it will be a regular account and can only access the reservation page. To see all the pages login as an admin.

### Index.html
This is the landing page for the website. Showcases the websites features. Use it to navigate to the other pages.

### createReservation.php
Use this page to create and insert a reservation into the database. Select a theatre then a movie select a room, then the date, the number of tickets, and finally the row number. If you are a regular user the id user for the reservation is your id, but if you're an admin the page is different and you can select what user you want to register for. The page on right dynamically updates with the movie you select, and displays the relevant information about the movie. We used the OMDB API to accomplish this.
![Reservation Page showing the UI](/installationImages/reservation.JPG)

### View.php
This page displays the created SQL views from Phase and displays them in a tabular format. It also displays a description of the view. The user can select what view they want to see. We used the Datatables JS library to display the tables.
![Views page showing the ui](/installationImages/view.JPG)

### Table.php
This page displays the tables in the database so the administrator can view the database without having to use another program. The user can select what table they want to view. It also displays the tables using the Datatables JS library.
![Table page showing the ui](/installationImages/table.JPG)


### createTheatre.php
This page allows the administrator to add another theatre location to the database. They need to select a theatre idand location. The theatre id must be unique, if a repeat id is used the user will be notified and the insertion will be rejected.\
![Showing the create theatre inputs](/installationImages/theatreCreate.JPG)

### createRoom.php
This page allows the administrator to add rooms to a theatre in the database. They need to select the theatre they want to add to and input a room id. The room id will automatically be set to the minimum available theatre id. The room id must be unique, if a repeat id is used the user will be notified and the insertion will be rejected.
![Showing the create room inputs](/installationImages/createRoom.JPG)

### createMovie.php
This page allows the administrator to news movies to the database. They need to input the movie title and the year it was made, from there they can search for the movie. If the movie is the one they desired then they input the time the movie should start. . The Movie id must be unique, if a repeat id is used the user will be notified and the insertion will be rejected. To search for the movies and get its corresponding information, the IMDB database is used, to access the database the OMDB api is used.
![Showing the create movie inputs](/installationImages/createMovie.JPG)

### Logout.php
Log the user out of the website.
