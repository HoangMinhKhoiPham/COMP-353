SELECT 
    firstName, lastName, startDate, dateOfBirth, email
FROM
    (SELECT 
        e.firstName, e.lastName, w.startDate, e.dateOfBirth, e.email,
            SUM(TIMEDIFF(s.shiftEnd, s.shiftStart)) AS hours
    FROM
        Employee e, WorksAt w, Schedule s
    WHERE
        e.ID = w.employeeID AND w.employeeID = s.employeeID AND e.employeeRole = 'Nurse'
    GROUP BY e.firstName , e.lastName , w.startDate , e.dateOfBirth , e.email) AS nurse_total_hours
WHERE
    hours = (SELECT 
            MAX(hours)
        FROM
            (SELECT 
                e.ID, SUM(TIMEDIFF(s.shiftEnd, s.shiftStart)) AS hours
            FROM
                Employee e, Schedule s
            WHERE
                e.ID = s.employeeID
                    AND e.employeeRole = 'Nurse'
            GROUP BY e.ID) AS hoursList);