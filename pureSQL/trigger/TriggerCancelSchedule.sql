DELIMITER $$

CREATE TRIGGER Cancel_Schedule_Trigger
AFTER INSERT ON HasCaught
FOR EACH ROW
BEGIN
    INSERT INTO logTable SELECT null, f.facilityName, e.email, "One of your colleagues
that you have worked with in the past two weeks have been infected with COVID-19" AS email, 'Warning' AS Subject, CURDATE() AS date FROM Employee e, Schedule s, Facilities f 
WHERE f.ID = s.facilityID AND e.ID = s.employeeID AND employeeID != NEW.employeeID AND (employeeRole = 'Nurse' OR employeeRole = 'Doctor')
AND s.facilityID = (SELECT facilityID FROM WorksAt WHERE employeeID = NEW.employeeID AND endDate is NULL)  
AND (CAST(s.shiftStart AS DATE) in (SELECT CAST(shiftStart AS DATE) FROM Schedule WHERE employeeID = NEW.employeeID AND ((CAST(shiftStart as DATE) >= (NEW.dateOfInfection - INTERVAL 14 DAY)) AND CAST(shiftStart as DATE) <= NEW.dateOfInfection))); 
    
    DELETE FROM Schedule s WHERE ((CAST(s.shiftStart AS DATE) >= NEW.dateOfInfection AND CAST(s.shiftStart AS DATE) <= (NEW.dateOfInfection + INTERVAL 14 DAY))) AND NEW.employeeID = s.employeeID;
	
END$$
DELIMITER ;