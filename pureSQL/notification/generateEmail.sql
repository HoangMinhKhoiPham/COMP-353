create
    definer = vbc353_4@`172.16.0.0/255.240.0.0` procedure generateEmail(IN employeeID int, IN facilityID int,
                                                                        IN today date, OUT emailTitle varchar(255),
                                                                        OUT emailBody mediumtext)
BEGIN
DECLARE schedule1Day MEDIUMTEXT;
DECLARE schedule2Day MEDIUMTEXT;
DECLARE schedule3Day MEDIUMTEXT;
DECLARE schedule4Day MEDIUMTEXT;
DECLARE schedule5Day MEDIUMTEXT;
DECLARE schedule6Day MEDIUMTEXT;
DECLARE schedule7Day MEDIUMTEXT;


CALL getScheduleForDay(employeeID, facilityID, today + 1,  schedule1Day);
CALL getScheduleForDay(employeeID, facilityID, today + 2,  schedule2Day);
CALL getScheduleForDay(employeeID, facilityID, today + 3,  schedule3Day);
CALL getScheduleForDay(employeeID, facilityID, today + 4,  schedule4Day);
CALL getScheduleForDay(employeeID, facilityID, today + 5,  schedule5Day);
CALL getScheduleForDay(employeeID, facilityID, today + 6,  schedule6Day);
CALL getScheduleForDay(employeeID, facilityID, today + 7,  schedule7Day);

SET emailTitle = CONCAT(
	(SELECT facilityName FROM Facilities WHERE facilityID = id),
	' for ',
	DAYNAME(today + 1),
    ' ',
	DATE_FORMAT(today + 1,'%m/%d/%Y'),
    ' to ',
    DAYNAME(today + 7),
    ' ',
    DATE_FORMAT(today + 7,'%m/%d/%Y')
);


SET emailBody = CONCAT(
	'Hello ', (SELECT CONCAT(firstName, ' ', lastName, ' - ', email) FROM Employee WHERE id = employeeID), ',\n',
    (SELECT CONCAT('Your schedule for ', facilityName, ' (', address, ') is:\n') FROM Facilities WHERE id = facilityID),
    DAYNAME(today + 1), '\n', CAST(schedule1Day AS CHAR), '\n\n',
    DAYNAME(today + 2), '\n', CAST(schedule2Day AS CHAR), '\n\n',
    DAYNAME(today + 3), '\n', CAST(schedule3Day AS CHAR), '\n\n',
    DAYNAME(today + 4), '\n', CAST(schedule4Day AS CHAR), '\n\n',
    DAYNAME(today + 5), '\n', CAST(schedule5Day AS CHAR), '\n\n',
    DAYNAME(today + 6), '\n', CAST(schedule6Day AS CHAR), '\n\n',
    DAYNAME(today + 7), '\n', CAST(schedule7Day AS CHAR), '\n\n'
);
-- SET emailBody = @schedule1Day;
END;

