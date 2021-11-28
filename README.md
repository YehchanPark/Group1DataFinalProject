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