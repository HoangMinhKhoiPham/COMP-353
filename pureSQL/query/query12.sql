--  For a given facility, give the total hours scheduled for every role during a
-- specific period. Results should be displayed in ascending order by role.

use vbc353_4;

select sum(hoursWorked), employeeRole from
    (select facilityID, facilityName, hour(sum(timediff(shiftEnd, shiftStart))) as hoursWorked, employeeID
    from Facilities join Schedule S on Facilities.id = S.facilityID
    group by employeeID, facilityName) as scheduledHour
    join Employee E on employeeID = E.ID
where facilityID = 8
group by employeeRole order by employeeRole

-- give facility is in dropdown and parameter is passed in the where clause