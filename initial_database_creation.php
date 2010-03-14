<?php
include "db.php";

dbConnect();

// create User table
echo('<br />Creating User table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Users (
    id smallint(5) NOT NULL auto_increment,
    username varchar(30) NOT NULL default '',
    password varchar(32) NOT NULL default '',
    PRIMARY KEY (id),
    UNIQUE KEY username (username)
)");

if (!$response)
    echo('User table failed: '.mysql_error());
    
    
// create Drink table
echo('<br />Creating Drink table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Drink (
  name varchar(50) NOT NULL,
  description varchar(400),
  PRIMARY KEY (name)
)");

if (!$response)
    echo('Drink table failed: ' . mysql_error());

// create Bar table
echo('<br />Creating Bar table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Bar (
  name varchar(50) NOT NULL,
  rating int(11) NOT NULL default 8,
  description varchar(400),
  specials varchar(400),
  address varchar(400),
  PRIMARY KEY (name)
)");

if (!$response)
    echo('Bar table failed: ' . mysql_error());

// create Location table
// TODO: Add google map coordinates as a column
echo('<br />Creating Location table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Location (
  address varchar(400) NOT NULL,
  type varchar(20) NOT NULL,
  PRIMARY KEY (address)
);");

if (!$response)
    echo('Location table failed: ' . mysql_error());

// create Event table
echo('<br />Creating Event table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Event (
  id int(11) NOT NULL auto_increment,
  name varchar(50) NOT NULL,
  price int(11) NOT NULL default 0,
  type varchar(20) NOT NULL,
  description varchar(400),
  date TIMESTAMP,
  address varchar(400),
  PRIMARY KEY (id)
);");

if (!$response)
    echo('Event table failed: ' . mysql_error());

// create user table
echo('<br />Creating User table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS User (
  username varchar(100) NOT NULL,
  level int(11) NOT NULL default 0,
  hash varchar(136) NOT NULL default 0,
  email varchar(100) NOT NULL,
  signup_date TIMESTAMP default CURRENT_TIMESTAMP,
  PRIMARY KEY (username)
);");

if (!$response)
    echo('User table failed: ' . mysql_error());

// create Sells table
echo('<br />Creating Sells table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS Sells (
    drinkName varchar(50) NOT NULL,
    barName varchar(50) NOT NULL,
    price int(11) NOT NULL,
    PRIMARY KEY (drinkName, barName)
)");

if (!$response)
    echo('Sells table failed: ' . mysql_error());

/** TODO: Implement FK	
// Adding Foriegn key to Sells
echo('<br />Altering Sells table...<br />');
$response = mysql_query("ALTER TABLE Sells  
	ADD CONSTRAINT FK_Sells  
	FOREIGN KEY (drinkName) REFERENCES Drink(name)  
	FOREIGN KEY (barName) REFERENCES Bar(name) 
	ON UPDATE CASCADE 
	ON DELETE CASCADE; ");

if (!$response)
    echo('Alter Sells table failed: ' . mysql_error());	
**/


// create BarReview table
echo('<br />Creating BarReview table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS BarReview (
    id int(11) NOT NULL auto_increment,
    userName varchar(100) NOT NULL,
    barName varchar(50) NOT NULL,
    approvedByAdmin tinyint(1) default 0,
	rating int(11),
	reviewContent varchar(500),
    ts TIMESTAMP default CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);");

if (!$response)
    echo('BarReview table failed: ' . mysql_error());
	
	// create EventReview table
echo('<br />Creating EventReview table...<br />');
$response = mysql_query("CREATE TABLE IF NOT EXISTS EventReview (
    id int(11) NOT NULL auto_increment,
    userName varchar(100) NOT NULL,
    eventID int(11) NOT NULL,
    approvedByAdmin tinyint(1) default 0,
	rating int(11),
	reviewContent varchar(500),
    ts TIMESTAMP default CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);");

if (!$response)
    echo('EventReview table failed: ' . mysql_error());

?>