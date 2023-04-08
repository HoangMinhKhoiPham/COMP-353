SELECT e.firstName, e.lastName, ic.dateOfInfection, f.facilityName
FROM Employee e
JOIN HasCaught ic ON ic.employeeID = e.ID
JOIN WorksAt wa ON wa.employeeID = e.ID AND wa.endDate IS NULL
JOIN Facilities f ON f.id = wa.facilityID
WHERE ic.dateOfInfection BETWEEN DATE_SUB(NOW(), INTERVAL 2 WEEK) AND NOW() AND employeeRole = 'Doctor'
ORDER BY f.facilityName ASC, e.firstName ASC;