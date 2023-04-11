DELIMITER $$
CREATE TRIGGER Different_Interval_Of_Time_Trigger
BEFORE INSERT ON WorksAt
FOR EACH ROW
BEGIN
    IF NEW.employeeID IN (SELECT employeeID FROM WorksAt WHERE NEW.employeeID = employeeID AND (NEW.startDate >= startDate OR NEW.startDate < startDate) AND endDate IS NULL) THEN
        SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Time Interval Overlap';
    END IF;
END$$
DELIMITER ;

