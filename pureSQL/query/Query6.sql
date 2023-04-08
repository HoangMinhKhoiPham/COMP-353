SELECT f.*, count(wa.employeeID) as numberOfEmployees
FROM comp353proj.Facilities f, comp353proj.WorksAt wa
where f.id = wa.facilityID
group by f.id
ORDER BY f.province ASC, f.city ASC, f.facilityType ASC, numberOfEmployees ASC;