CREATE DEFINER=`root`@`localhost` PROCEDURE `getScheduleForDay`(
	IN employeeID INT,
    IN facilityID INT,
    IN targetDay DATE,
    OUT scheduleString MEDIUMTEXT
)
BEGIN
	DECLARE result MEDIUMTEXT;
	SELECT
		GROUP_CONCAT(
			DATE_FORMAT(s.shiftStart, '%Y-%m-%d %T'), ' - ', DATE_FORMAT(s.shiftEnd, '%Y-%m-%d %T')
			SEPARATOR '\n\n'
		) INTO result
	FROM
		Schedule s
	WHERE
		s.employeeID = employeeID
        AND s.facilityID = facilityID
        AND CAST(s.shiftStart as DATE) = targetDay
	ORDER BY
		s.shiftStart ASC;
	SET scheduleString = IFNULL(result, "No assignment");
END