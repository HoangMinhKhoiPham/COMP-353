SELECT f.province, f.facilityName, f.capacity, COUNT(h.employeeID) as infectedCount
FROM Facilities f
LEFT JOIN WorksAt w ON f.id = w.facilityID
LEFT JOIN HasCaught h ON w.employeeID = h.employeeID
WHERE h.dateOfInfection BETWEEN DATE_SUB(NOW(), INTERVAL 2 WEEK) AND NOW()
GROUP BY f.id
ORDER BY f.province, infectedCount