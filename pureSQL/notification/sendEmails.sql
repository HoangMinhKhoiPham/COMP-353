create
    definer = vbc353_4@`172.16.0.0/255.240.0.0` procedure sendEmails()
BEGIN
	DECLARE today DATE DEFAULT curdate();
	DECLARE done INT DEFAULT FALSE;
    DECLARE emailTitle VARCHAR(150);
    DECLARE emailBody MEDIUMTEXT;
	DECLARE employeeID, facilityID INT;
	DECLARE cursorElement CURSOR FOR
		SELECT DISTINCT s.employeeID, s.facilityID FROM Schedule s WHERE CAST(s.shiftStart as DATE) >= (today + INTERVAL 1 DAY) AND CAST(s.shiftStart as DATE) <= (today + INTERVAL 7 DAY);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN cursorElement;
	loop_start:
	LOOP FETCH cursorElement INTO employeeID, facilityID;
		IF done THEN LEAVE loop_start; END IF;				
		CALL generateEmail(employeeID, facilityID, today, emailTitle, emailBody);
        
		INSERT INTO logTable(sender, receiver, email, subject, date) values ((SELECT facilityName FROM Facilities WHERE id = facilityID), (SELECT email FROM Employee WHERE id = employeeID), SUBSTRING(emailBody, 1 , 80), emailTitle, today);
        INSERT INTO EmailDetail(emailID, dateSent, emailBody) values ((SELECT last_insert_id()), today, emailBody);
	END
    
	LOOP loop_start;
	CLOSE cursorElement;
END;

