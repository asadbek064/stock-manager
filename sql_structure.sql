CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_stock_alert` (
  `order_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `stockName` varchar(255) NOT NULL,
  `targetPrice` double DEFAULT NULL,
  `ifGTRtarget` tinyint(1) DEFAULT NULL,
  `ifLStarget` tinyint(1) DEFAULT NULL,
  `isCompleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `user_stock_alert`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `userID` (`userID`);

ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_stock_alert`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_stock_alert`
  ADD CONSTRAINT `user_stock_alert_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;
