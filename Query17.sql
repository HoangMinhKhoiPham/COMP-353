SELECT e.firstName, e.lastName, e.dateOfBirth, e.employeeRole, e.email, MIN(w.startDate) AS firstDayOfWork, SUM(TIMESTAMPDIFF(HOUR, s.shiftStart, s.shiftEnd)) AS totalScheduledHours
FROM Employee e
JOIN WorksAt w ON e.ID = w.employeeID
JOIN Schedule s ON e.ID = s.employeeID AND w.facilityID = s.facilityID
WHERE e.employeeRole IN ('Nurse', 'Doctor') AND e.ID NOT IN (
    SELECT employeeID FROM HasCaught)
GROUP BY e.ID
ORDER BY e.employeeRole, e.firstName, e.lastName;