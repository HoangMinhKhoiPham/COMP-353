--  For a given facility, give the total hours scheduled for every role during a
-- specific period. Results should be displayed in ascending order by role.
use vbc353_4;

select facilityName, sum(hoursScheduled), employeeRole from
    (select facilityID, facilityName, day, hoursScheduled, employeeID from
        (select *, hour(sum(timediff(shiftEnd, shiftStart))) as hoursScheduled, date(shiftEnd) as day
         from Facilities join Schedule S on Facilities.id = S.facilityID group by employeeID, day, facilityName) as allHours
     where day >= date('2023-04-02') and day <= date('2023-04-29')) as hoursInTimeframe
        join Employee E on employeeID = E.ID
where facilityID = 8
group by employeeRole order by employeeRole;

