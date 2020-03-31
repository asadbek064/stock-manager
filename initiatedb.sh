#! /bin/bash

# AUTHOR = "Alain & Asad"

# LICENCE MIT

mysql -u $1 -p$2 <<SETUP_SCHEMA
use stock_manager;
CREATE TABLE IF NOT EXISTS users (ID int(11) AUTO_INCREMENT,
username varchar(255) NOT NULL,
firstName varchar(255) NOT NULL,
lastName varchar(255) NOT NULL,
email varchar(255) NOT NULL,
pwd varchar(255) NOT NULL,
PRIMARY KEY  (ID));
CREATE TABLE IF NOT EXISTS user_stock_alert (ID int(11) AUTO_INCREMENT,
stockName varchar(50) NOT NULL,
targetPrice INT(50) NOT NULL,
PRIMARY KEY  (ID));
CREATE TABLE IF NOT EXISTS stocks (ID int(11) AUTO_INCREMENT,
stockName varchar(50) NOT NULL,
StockSymbol varchar(10) NOT NULL,
stockPrice INT(10) NOT NULL,
PRIMARY KEY  (ID));
SETUP_SCHEMA