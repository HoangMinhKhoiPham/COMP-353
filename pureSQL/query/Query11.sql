SELECT employeeID FROM Schedule WHERE (shiftStart >= (CURDATE() - INTERVAL 14 DAY) AND (shiftStart <= CURDATE())); 

