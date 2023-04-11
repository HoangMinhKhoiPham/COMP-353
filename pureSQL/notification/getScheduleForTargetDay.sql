create
    definer = vbc353_4@`172.16.0.0/255.240.0.0` procedure getScheduleForDay(IN employeeID int, IN facilityID int,
                                                                            IN targetDay date,
                                                                            OUT scheduleString mediumtext)
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
	SET scheduleString = IFNULL(result, 'No assignment');
END;

