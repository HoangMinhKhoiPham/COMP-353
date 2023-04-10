-- For a given employee, get the details of all the schedules she/he has been
-- scheduled during a specific period of time. Details include facility name, day
-- of the year, start time and end time. Results should be displayed sorted in
-- ascending order by facility name, then by day of the year, the by start time

use vbc353_4;

select facilityName, Date(shiftStart) as Day, time(shiftStart) as start_time, time(shiftEnd) as end_time
from Facilities join Schedule S on Facilities.id = S.facilityID
where employeeID = 6 and date(shiftStart) >= date('2023-04-02') and date(shiftEnd) <= date('2023-04-29')
order by facilityName, Day, start_time;

-- parameters are passed in the where clause
-- Given employee is to be set there and the dates should make use of a calendar input