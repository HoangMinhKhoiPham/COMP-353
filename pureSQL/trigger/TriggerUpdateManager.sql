DELIMITER $$
CREATE TRIGGER update_manager
AFTER UPDATE ON WorksAt
FOR EACH ROW
BEGIN
     IF NEW.endDate IS NOT NULL AND EXISTS(SELECT * FROM Facilities WHERE Facilities.managerID = NEW.employeeID) THEN
        UPDATE Facilities SET managerID = NULL WHERE id IN (SELECT f.id 
            FROM (SELECT * FROM Facilities) AS f 
            WHERE NEW.employeeID = f.managerID
);
    END IF;
END$$
DELIMITER ;