insert into Schedule (employeeID, facilityID, shiftStart, shiftEnd) values (65, 8, '2023-12-24T06:00:00', '2023-12-24T16:00:00');
insert into Schedule (employeeID, facilityID, shiftStart, shiftEnd) values (65, 8, '2023-12-24T14:00:00', '2023-12-24T20:00:00');

DELETE FROM Schedule WHERE employeeID = 65 AND facilityID = 8 AND shiftStart = '2023-12-24T06:00:00';

UPDATE Schedule
SET shiftEnd = '2023-12-24T11:00:00'
WHERE employeeID = 65 AND facilityID = 8 AND shiftStart = '2023-12-24T06:00:00';