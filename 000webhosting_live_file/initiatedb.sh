#! /bin/bash

# AUTHOR = "Alain & Asad"

# LICENCE MIT

# run this scrip to prepare for the database schema.
# you will need pass in the username and password
# you mysql user access

mysql -u $1 -p$2 <<SETUP_SCHEMA
use stock_manager;
CREATE TABLE users(
username_ID INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
firstName VARCHAR(255) NOT NULL,
lastName VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
pwd VARCHAR(255) NOT NULL
); 
CREATE TABLE user_stock_alert(
order_id INT AUTO_INCREMENT PRIMARY KEY,
username_id INT,
stockName VARCHAR(255) NOT NULL,
targetPrice DOUBLE,
ifGTRtarget BOOLEAN,
ifLStarget BOOLEAN,
isCompleted BOOLEAN,
FOREIGN KEY(username_id) REFERENCES users(username_ID));
CREATE TABLE IF NOT EXISTS stocks (ID int(11) AUTO_INCREMENT,
stockName varchar(50) NOT NULL,
StockSymbol varchar(10) NOT NULL,
stockPrice INT(10) NOT NULL,
PRIMARY KEY  (ID));
CREATE TABLE IF NOT EXISTS stock_list (
description VARCHAR(255) NOT NULL,
symbol VARCHAR(255) NOT NULL);
SETUP_SCHEMA