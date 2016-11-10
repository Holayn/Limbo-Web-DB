#Create and populate a database for limbo
#Authors: Kai Wong, Wendy Ni, Jae Kyoung Lee (LJ)
#Version 0.0.01 alpha   09/30/2016

#Drop database if limbo already exists
DROP DATABASE IF EXISTS limbo_db;
CREATE DATABASE limbo_db;
USE limbo_db;

#Creates users table
CREATE TABLE IF NOT EXISTS users (
	user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	first_name TEXT NOT NULL,
	last_name TEXT NOT NULL,
	email VARCHAR(40) UNIQUE NOT NULL,
	pass TEXT NOT NULL,
	reg_date DATETIME NOT NULL
);

#Populate users table with user
INSERT INTO users (first_name, email, pass)
	VALUES ("admin", "jae.lee2@marist.edu" , "gaze11e"),
		   ("Jon", "jon.snow@got.com" , "W1nt3r"),
		   ("Snow", "snow.jon@got.com" , "1sc0m1ng");
	
#Create loststuff table
CREATE TABLE IF NOT EXISTS loststuff (
	id INT PRIMARY KEY AUTO_INCREMENT,
	item_name TEXT NOT NULL,
	description TEXT NOT NULL,
	location_name TEXT NOT NULL,
	#room TEXT,
	lost_date DATETIME NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	owner_name TEXT,
	status SET('Lost') NOT NULL
);

#Create foundstuff table
CREATE TABLE IF NOT EXISTS foundstuff (
	id INT PRIMARY KEY AUTO_INCREMENT,
	finder_name TEXT,
	phone_number CHAR(10) NOT NULL,
	email VARCHAR(40) UNIQUE NOT NULL,
	item_name TEXT NOT NULL,
	description TEXT NOT NULL,
	location_name TEXT NOT NULL,
	#room TEXT,
	found_date DATETIME NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	status SET('Found', 'Claimed') NOT NULL
);

#Create locations table
CREATE TABLE IF NOT EXISTS locations (
	id INT PRIMARY KEY AUTO_INCREMENT,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	name TEXT NOT NULL
);

#Populate locations table with all buildings on campus
INSERT INTO locations (create_date, update_date, name)
	VALUES  (NOW(), NOW(), "Byrne House"),
			(NOW(), NOW(), "Cannavino Library"),
			(NOW(), NOW(), "Champagnat Hall"),
			(NOW(), NOW(), "Chapel"),
			(NOW(), NOW(), "Cornell Boathouse"),
			(NOW(), NOW(), "Donnelly Hall"),
			(NOW(), NOW(), "Dyson Center"),
			(NOW(), NOW(), "Fern Tor"),
			(NOW(), NOW(), "Fontaine Hall"),
			(NOW(), NOW(), "Foy Townhouses"),
			(NOW(), NOW(), "Lower Fulton Street Townhouses"),
			(NOW(), NOW(), "Upper Fulton Street Townhouses"),
			(NOW(), NOW(), "Greystone Hall"),
			(NOW(), NOW(), "Hancock Center"),
			(NOW(), NOW(), "Kieran Gatehouse"),
			(NOW(), NOW(), "Kirk House"),
			(NOW(), NOW(), "Leo Hall"),
			(NOW(), NOW(), "Longview Park"),
			(NOW(), NOW(), "Lowell Thomas Communication Center"),
			(NOW(), NOW(), "Lower Townhouses"),
			(NOW(), NOW(), "Upper Townhouses"),
			(NOW(), NOW(), "Marian Hall"),
			(NOW(), NOW(), "Marist Boathouse"),
			(NOW(), NOW(), "McCann Center"),
			(NOW(), NOW(), "Mid-Rise Hall"),
			(NOW(), NOW(), "North Campus Housing Complex"),
			(NOW(), NOW(), "St. Ann's Hermitage"),
			(NOW(), NOW(), "St. Peter's"),
			(NOW(), NOW(), "Science and Allied Health Building"),
			(NOW(), NOW(), "Sheahan Hall"),
			(NOW(), NOW(), "Steel Plant Studios and Gallery"),
			(NOW(), NOW(), "Murray Student Center/Music Building"),
			(NOW(), NOW(), "Lower West Cedar Townhouses"),
			(NOW(), NOW(), "Upper West Cedar Townhouse");
			
INSERT INTO loststuff(item_name, description, location_name, lost_date, create_date, update_date, owner_name, status)
	VALUES  ("Sunglasses", "Black shiny Ray-Ban sunglasses", "Hancock Center" , '2016-03-25', NOW() , NOW(), "Cool Joe", "Lost"),
			("Bag", "Red Chanel leather bag", "Marist Boathouse", '2016-02-14', NOW() , NOW(), "Lucy" , "Lost"),
			("Bottle", "White bottle with Marist logo", "St. Peter's", '2016-01-18', NOW() , NOW(), "Snoopy" , "Lost");
			
INSERT INTO foundstuff(finder_name, phone_number, email, item_name, description, location_name, found_date, create_date, update_date, status)
	VALUES  ("Tyrell", "8455462884", "ty@gmail.com", "Phone", "Rose Gold iPhone 6 Plus with clear case", "Marist Boathouse", '2016-03-15', NOW(), NOW(), "Found"),
			("Smith", "2156242147", "smith@gmail.com", "Phone", "White Galaxy Notes 7", "Sheahan Hall", '2016-03-21', NOW(), NOW(), "Found"),
			("Eliot", "8456212015", "eli@gmail.com", "Slippers", "Green slippers", "Leo Hall", '2016-04-17', NOW(), NOW(), "Found");
	
