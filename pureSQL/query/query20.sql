-- On Sunday of every week, for every employee working in every facility, the system
-- should automatically send an email to every employee indicating the schedule of the
-- employee in the facility for the coming week. The subject of the email should include the
-- facility name, and the dates covered by the schedule. A subject example: “CLSC
-- Outremont Schedule for Monday 20-Feb-2023 to Sunday 26-Feb-2023”. The email body
-- should include the facility name, the address of the facility, the employee’s first-name,
-- last-name, email address, and details of the schedule for the coming week. Details include
-- day of the week, start time and end time. The body of the message should also include an
-- entry for every day of the week followed by the starting hour and end hour for that day. A
-- message “No Assignment” is displayed if the employee is not scheduled for that specific
-- entry.

-- A log table is stored in the database that contains information of every email generated by
-- the system. The log includes date of the email, the sender of the email (name of the
-- facility), the receiver of the email, the subject of the email, and the first 80 characters of
-- the body of the email.

use vbc353_4;
select employeeID, firstName, lastName, email, facilityName, Day, start_time, end_time from
    (select employeeID, Date(shiftStart) as Day, time(shiftStart) as start_time, time(shiftEnd) as end_time, facilityName
    from Facilities join Schedule S on Facilities.id = S.facilityID
    -- where date(shiftStart) >= date('2023-04-02') and date(shiftEnd) <= date('2023-04-29')
    ) as  week
join Employee E on employeeID = E.ID order by employeeID, Day

-- set the where clause as the week to come
-- query data then for each email, send a msg formatted as required