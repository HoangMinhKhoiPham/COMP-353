-- Get details of the nurse(s) or the doctor(s) who are currently working and has
-- been infected by COVID-19 at least three times. Details include first-name,
-- last-name, first day of work as a nurse or as a doctor, role (nurse/doctor), date
-- of birth, email address, and total number of hours scheduled. Results should
-- be displayed sorted in ascending order by role, then by first name, then by last
-- name.

use vbc353_4;

select * from (
    select firstName, lastName, firstDay, employeeRole, dateOfBirth, email, hour(sum(timediff(shiftEnd, shiftStart))) as hoursWorked from
        (select ID, firstName, lastName, min(startDate) as firstDay, employeeRole, dateOfBirth, email from
            (select * from
                (select * from
                    (select employeeID, count(*) as timesInfected from HasCaught group by employeeID) as HC -- (select employeeID, count(*) as timesInfected from HasCaught  where infectionID = 1 group by employeeID) as HC
                    where timesInfected >= 3) as infectedOver3
                join Employee E on employeeID = E.ID) as EmpMatched
        join WorksAt on EmpMatched.employeeID = EmpMatched.ID group by EmpMatched.employeeID) as EmployeeAndHours
    join Schedule on employeeID = EmployeeAndHours.ID group by employeeID) as finalTable
where employeeRole in ('Doctor', 'Nurse')
order by employeeRole, firstName, lastName;

-- No params
-- our COVID-19 type is infectionID = 1.