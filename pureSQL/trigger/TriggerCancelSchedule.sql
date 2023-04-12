DELIMITER $$

CREATE TRIGGER Cancel_Schedule_Trigger
AFTER INSERT ON HasCaught
FOR EACH ROW
BEGIN 
	DECLARE done INT DEFAULT FALSE;
    DECLARE ids INT;
    DECLARE cur CURSOR FOR SELECT emailID FROM logTable WHERE emailID NOT IN (SELECT emailID FROM EmailDetail);
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	INSERT INTO logTable SELECT null, f.facilityName, e.email, SUBSTRING("One of your colleagues
that you have worked with in the past two weeks have been infected with COVID-19",1,80) AS email, 'Warning' AS Subject, CURDATE() AS date FROM Employee e, Schedule s, Facilities f 
WHERE f.id = s.facilityID AND e.ID = s.employeeID AND employeeID != NEW.employeeID AND (employeeRole = 'Nurse' OR employeeRole = 'Doctor')
AND s.facilityID = (SELECT facilityID FROM WorksAt WHERE employeeID = NEW.employeeID AND endDate is NULL)  
AND (CAST(s.shiftStart AS DATE) in (SELECT CAST(shiftStart AS DATE) FROM Schedule WHERE employeeID = NEW.employeeID AND ((CAST(shiftStart as DATE) >= (NEW.dateOfInfection - INTERVAL 14 DAY)) AND CAST(shiftStart as DATE) <= NEW.dateOfInfection)));
		OPEN cur;
        ins_loop: LOOP
            FETCH cur INTO ids;
            IF done THEN
                LEAVE ins_loop;
            END IF;
            INSERT INTO EmailDetail(emailID, dateSent, emailBody) VALUES (ids, CURDATE(), "One of your colleagues that you have worked with in the past two weeks have been infected with COVID-19");
        END LOOP;
    CLOSE cur;
    DELETE FROM Schedule s WHERE (CAST(s.shiftStart AS DATE) >= NEW.dateOfInfection AND CAST(s.shiftStart AS DATE) <= (NEW.dateOfInfection + INTERVAL 14 DAY)) AND NEW.employeeID = s.employeeID;
	
END$$
DELIMITER ;