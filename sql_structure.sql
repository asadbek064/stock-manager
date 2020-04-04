
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id), 
    
    username VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL
    
) ENGINE=INNODB;

CREATE TABLE user_stock_alert (
    order_id INT AUTO_INCREMENT,
    PRIMARY KEY(id),
    users_id INT,
    INDEX par_ind (users_id),
    FOREIGN KEY (users_id)REFERENCES users(id)ON DELETE CASCADE,
    
    stockName VARCHAR(255) NOT NULL,
    targetPrice DOUBLE,
    ifGTRtarget BOOLEAN,
    ifLStarget BOOLEAN,
    isCompleted BOOLEAN
    
) ENGINE=INNODB;