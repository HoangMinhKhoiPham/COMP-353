SELECT e.firstName, e.lastName, e.city, count(wa.facilityID) as numberOfFacilitiesWorkedAt
FROM Employee e
INNER JOIN WorksAt wa ON e.ID = wa.employeeID
INNER JOIN Facilities f ON wa.facilityID = f.id
WHERE e.employeeRole = 'Doctor' and f.province = 'Quebec' and wa.endDate IS NULL
GROUP BY e.ID, e.firstName, e.lastName, e.city
