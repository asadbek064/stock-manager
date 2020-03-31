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
    FOREIGN KEY(username_id) REFERENCES users(username_ID)
);