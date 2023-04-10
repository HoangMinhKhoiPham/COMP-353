DELIMITER $$

CREATE TRIGGER WorksAtTrigger
AFTER INSERT ON WorksAt
FOR EACH ROW
BEGIN
    IF NEW.facilityID IN (SELECT facilityID FROM (SELECT facilityID, capacity FROM facilities, worksat WHERE ID = facilityID AND endDate IS null GROUP BY facilityID, capacity HAVING COUNT(employeeID) > capacity) as TEMP) THEN
        SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Excess Capacity';
    END IF;
END$$

DELIMITER ;
