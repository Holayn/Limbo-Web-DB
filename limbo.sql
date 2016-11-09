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
DROP TABLE IF EXISTS loststuff;
CREATE TABLE IF NOT EXISTS loststuff (
	id INT PRIMARY KEY AUTO_INCREMENT,
	item_name TEXT NOT NULL,
	description TEXT NOT NULL,
	location_name TEXT NOT NULL,
	lost_date DATETIME NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	owner_name TEXT NOT NULL
);

#Create foundstuff table
DROP TABLE IF EXISTS foundstuff;
CREATE TABLE IF NOT EXISTS foundstuff (
	id INT PRIMARY KEY AUTO_INCREMENT,
	finder_name TEXT NOT NULL,
	phone_number CHAR(10),
	email TEXT NOT NULL,
	item_name TEXT NOT NULL,
	description TEXT NOT NULL,
	location_name TEXT NOT NULL,
	found_date DATETIME NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL
);

#Create locations table
DROP TABLE IF EXISTS locations;
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

INSERT INTO foundstuff(finder_name, phone_number, email, item_name, description, location_name, found_date)
	VALUES ("KAI", "8888888888", "kwwong15@punahou.edu", "Horse", "A stallion", "Hancock Center", "2016-04-16");